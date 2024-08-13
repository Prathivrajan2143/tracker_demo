<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        
        $users = User::get();
        $clients = Client::get();
        $roles = Role::get();
        $projects = Project::get();

        return view('dashboard')->with(compact('users', 'clients', 'roles', 'projects'));
    }
}
