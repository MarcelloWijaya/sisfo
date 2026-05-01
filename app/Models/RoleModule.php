<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleModule extends Model
{
    protected $table = 'role_modules';

    protected $fillable = ['role_id', 'module_id', 'created_by', 'updated_by'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
}
