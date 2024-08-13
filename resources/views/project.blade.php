<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Create New Project</h1>
 <!-- Check for success message in session -->
 @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
        <form action="{{ route('add.project') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="client_name">Client Name:</label>
                <select class="form-control" id="client_name" name="client_name" required>
                    <option value="">Select Client</option>
                @foreach($clients as $clientName => $clientId)
                    <option value="{{ $clientId }}">{{ $clientName }}</option>
                @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="project_name">Project Name:</label>
                <input type="text" class="form-control" id="project_name" name="project_name" value="{{ $projectName ?? 'Auto-generated' }}">
            </div>
            
            <div class="form-group">
                <label for="project_code">Project Code:</label>
                <input type="text" class="form-control" id="project_code" name="project_code" value="{{ $projectCode ?? 'Auto-generated' }}">
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
