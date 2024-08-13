<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // Specify the table name if it differs from the default 'clients'
    protected $table = 'clients'; // Note the table name is 'client' based on your migration

    // Specify which attributes are mass assignable
    protected $fillable = [
        'client_code',
        'client_name',
    ];

    // Optionally, specify which attributes should be hidden (e.g., for arrays or JSON responses)
    protected $hidden = [];

    // Define the relationship
    public function projects()
    {
        return $this->hasMany(Project::class, 'id');
    }

}
