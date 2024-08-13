<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DynamicRoleForm extends Model
{
    use HasFactory;
    
    // Specify the table name if it differs from the default 'role_form'
    protected $table = 'role_form'; // Note the table name is 'role_form' based on your migration

    // Specify which attributes are mass assignable
    protected $fillable = ['project_id', 'role_id', 'form_data'];

    protected $casts = [
        'form_data' => 'array', // Ensure form_data is cast to array
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(project::class, 'project_id');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(role::class, 'role_id');
    }
}

