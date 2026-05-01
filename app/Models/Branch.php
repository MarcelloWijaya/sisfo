<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'branches';

    protected $fillable = ['name', 'owner_name', 'email', 'phone', 'address', 'is_active', 'created_by', 'updated_by'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relasi
    public function students()
    {
        return $this->hasMany(Student::class, 'branch_id');
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'branch_id');
    }

    public function classes()
    {
        return $this->hasMany(Classes::class, 'branch_id');
    }

    public function branchFees()
    {
        return $this->hasMany(BranchFee::class, 'branch_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'branch_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'branch_id');
    }
}
