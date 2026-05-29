<?php

namespace App\Http\Controllers\Director;

use App\Http\Controllers\Controller;
use App\Models\BranchPricing;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchPricingController extends Controller
{
    public function index(Request $request)
    {
        $branchId = Auth::user()->branch_id;

        // Jika tidak punya branch, coba cari branch pertama (fallback)
        if (!$branchId) {
            $branch = Branch::first();
            if ($branch) {
                $branchId = $branch->id;
                Auth::user()->update(['branch_id' => $branchId]);
            } else {
                abort(403, 'Anda tidak memiliki cabang yang ditugaskan.');
            }
        }

        $branches = Branch::where('status', 'active')->get();

        $query = BranchPricing::with('branch')->where('branch_id', $branchId);

        if ($request->filled('academic_year')) {
            $query->where('academic_year', $request->academic_year);
        }

        if ($request->filled('payment_type')) {
            $query->where('payment_type', $request->payment_type);
        }

        $pricings = $query->orderBy('academic_year', 'desc')->paginate(15);

        $academicYears = $this->getAcademicYears();
        $paymentTypes = $this->getPaymentTypes();

        return view('branch-pricings.index', compact('pricings', 'branches', 'academicYears', 'paymentTypes'));
    }

    public function edit(BranchPricing $branchPricing)
    {
        $branchId = Auth::user()->branch_id;

        if ($branchPricing->branch_id != $branchId) {
            abort(403, 'Anda tidak memiliki akses ke pricing cabang ini.');
        }

        $branches = Branch::where('status', 'active')->get();
        $academicYears = $this->getAcademicYears();
        $paymentTypes = $this->getPaymentTypes();
        $isDirector = true;

        return view('branch-pricings.edit', compact('branchPricing', 'branches', 'academicYears', 'paymentTypes', 'isDirector'));
    }

    public function update(Request $request, BranchPricing $branchPricing)
    {
        $branchId = Auth::user()->branch_id;

        if ($branchPricing->branch_id != $branchId) {
            abort(403, 'Anda tidak memiliki akses ke pricing cabang ini.');
        }

        $request->validate([
            'course_fee' => 'nullable|integer|min:0',
            'equipment_fee' => 'nullable|integer|min:0',
            'registration_fee' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
        ]);

        $branchPricing->update([
            'course_fee' => $request->course_fee,
            'equipment_fee' => $request->equipment_fee,
            'registration_fee' => $request->registration_fee,
            'description' => $request->description,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('director.pricing.show', $branchPricing)->with('success', __('all.pricing_updated'));
    }

    public function show(BranchPricing $branchPricing)
    {
        $branchId = Auth::user()->branch_id;

        if ($branchId && $branchPricing->branch_id != $branchId) {
            abort(403, 'Anda tidak memiliki akses ke pricing cabang ini.');
        }

        $branchPricing->load('branch');
        $isDirector = true;

        return view('branch-pricings.show', compact('branchPricing', 'isDirector'));
    }

    private function getAcademicYears()
    {
        $currentYear = date('Y');
        $years = [];

        for ($i = -2; $i <= 2; $i++) {
            $year = $currentYear + $i;
            $years[$year . '/' . ($year + 1)] = $year . '/' . ($year + 1);
        }

        return $years;
    }

    private function getPaymentTypes()
    {
        return [
            'monthly' => 'Monthly',
            'quarterly' => 'Quarterly',
            'semester' => 'Semester',
            'yearly' => 'Yearly',
        ];
    }
}
