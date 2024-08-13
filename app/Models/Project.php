<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    // Define the inverse relationship
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function dynamicroleform(): HasMany
    {
        return $this->hasMany(DynamicRoleForm::class, 'id');
    }
    
}
