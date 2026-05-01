<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ['name', 'created_by', 'updated_by'];

    public function roleModules()
    {
        return $this->hasMany(RoleModule::class, 'module_id');
    }
}
