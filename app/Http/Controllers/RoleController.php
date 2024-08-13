<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function storeRole(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

         // Create a new user
         Role::create([
            'role_name' => $request->input('role_name'),
            'description' => $request->input('description'),
        ]);

        // Redirect or return a response
        return redirect()->back()->with('success', 'Role added successfully!');
    }
}
