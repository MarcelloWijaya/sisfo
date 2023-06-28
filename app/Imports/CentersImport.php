<?php

namespace App\Imports;

use App\Models\Center;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CentersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Center([
            'name' => $row[0],
            'owner' => $row[1],
            'address' => $row[2],
            'phone_number' => $row[3],
            'email' => $row[4],
        ]);
    }
}
