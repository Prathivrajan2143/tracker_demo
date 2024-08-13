<?php

namespace App\Http\Controllers\project;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\DynamicRoleForm;
use App\Models\Project;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{

    public function showproject()
    {
        $projectName = $this->generateProjectName();
        $projectCode = $this->generateProjectCode();
        $clients = $this->getClients();

        return view('project', compact('projectName', 'projectCode', 'clients'));
    }
    
    private function generateProjectName()
    {
        // Simple example of generating a project name
        return 'Project-' . strtoupper(uniqid());
    }
    
    private function generateProjectCode()
    {
        // Simple example of generating a project code
        return 'CODE-' . strtoupper(uniqid());
    }
    
    private function getClients()
    {
        //Fetch clients from the DB.
        return Client::pluck('id', 'client_name');
    }

    public function storeproject(Request $request)
    { 
        $project = new Project();
        $project->client_id = $request->client_name;
        $project->project_name = $request->project_name;
        $project->project_code = $request->project_name;
        $project->save();

        return redirect()->back()->with('success', 'Project Created Successfully');
    }

    public function showRoleForm()
    {
        $roles = Role::get();
        $project = Project::pluck('id', 'project_name');
        
        return view('project/role_form')->with(['roles_data' => $roles, 'project_data' => $project]);
    }

    public function storeRoleForm(Request $request)
    {
        // Capture all request data
        $data = $request->except('_token', 'project_id', 'role_id');
        
        // Ensure the form_data is an array
        $formData = [
            'data' => $data,
        ];

        $validator = Validator::make($request->all(), [
            'project_id' => 'required|integer',
            'role_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) use ($request) {
                    $exists = DB::table('role_form')
                        ->where('project_id', $request->input('project_id'))
                        ->where('role_id', $value)
                        ->exists();
                        
                    if ($exists) {
                        $fail('The combination of project ID and role ID already exists.');
                    }
                },
            ],
        ]);
    
        if ($validator->fails()) {
            // return redirect()->back()->withErrors($validator)->withInput();
            return 'The combination of project ID and role ID already exists.';
        }

        // Store the data
        DynamicRoleForm::create([
            'project_id' => $request->project_id,
            'role_id' => $request->role_id,
            'form_data' => $formData,
        ]);
        
        return redirect()->back()->with('success', 'Form Saved Successfully');
    }
}
