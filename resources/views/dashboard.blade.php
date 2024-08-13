<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Blade Modal Example</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS (optional) -->
    <style>
        .modal-form {
            padding: 20px;
        }
    </style>
</head>
<body>

 <!-- Check for success message in session -->
 @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-5">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
            Add User
        </button>
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addClientModal">
            Add Client
        </button>
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addRoleModal">
            Add Role
        </button>
        <a href="{{ route('show.project') }}"><button class="btn btn-success">Add Project</button></a>

        <a href="{{ route('show.role.form') }}"><button class="btn btn-success">Create Form</button></a>

        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#assignUserModal">
            Assign User
        </button>
    </div>
    @include('dashboard_files/add_files')
    @include('dashboard_files/table_datas')

    

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
