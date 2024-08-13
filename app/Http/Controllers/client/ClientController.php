<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function storeClient(Request $request)
    {
        $request->validate([
            'client_code' => 'required|integer|unique:clients',
            'client_name' => 'required|string',
        ]);

        // Create a new client
        Client::create([
            'client_code' => $request->input('client_code'),
            'client_name' => $request->input('client_name'),
        ]);

        // Redirect or return a response
        return redirect()->back()->with('success', 'Client added successfully!');
    }
}
