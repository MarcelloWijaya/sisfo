<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    public function center()
    {
        return $this->belongsTo(Center::class); // Assuming 'center' is a related model
    }
}
