<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    // Specify the table name if it differs from the default 'roles'
    protected $table = 'roles'; // Note the table name is 'roles' based on your migration

    // Specify which attributes are mass assignable
    protected $fillable = [
        'role_name',
        'description',
        'order_by',
    ];

    // Optionally, if you want to cast order_by to a specific type, e.g., integer:
    protected $casts = [
        'order_by' => 'integer',
    ];

    
    public function dynamicroleform(): HasMany
    {
        return $this->hasMany(DynamicRoleForm::class, 'id');
    }

}
