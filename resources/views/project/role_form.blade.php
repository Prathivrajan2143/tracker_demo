<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .option-group { margin-top: 10px; }
        .option-item { margin-bottom: 5px; }
    </style>
</head>
<body>
@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif
<h1>Dynamic Form</h1>
<form id="dynamic-form" action="{{ route('submit.role.form') }}" method="POST">
    @csrf

    <!-- Project Select Option -->
    <div class="form-group">
        <label for="project">Project:</label>
        <select id="project" name="project_id" required>
            <option value="">Select Project</option>
            @foreach($project_data as $project_name => $project_id)
            <option value="{{ $project_id }}">{{ $project_name }}</option>
            @endforeach
            <!-- Add more roles as needed -->
        </select>
    </div>

    <!-- Roles Select Option -->
    <div class="form-group">
        <label for="role">Role:</label>
        <select id="role" name="role_id" required>
            <option value="">Select Role</option>
            @foreach($roles_data as $role)
            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
            @endforeach
            <!-- Add more roles as needed -->
        </select>
    </div>

    <!-- Dynamic Text Boxes -->
    <div id="text-boxes-container">
        <!-- Text boxes will be added here dynamically -->
    </div>
    
    <button type="button" id="add-text-box">Add Text Box</button>
    <button type="submit">Submit</button>
</form>

<script>
    $(document).ready(function() {
        let textBoxCount = 0;

        $('#add-text-box').click(function() {
            textBoxCount++;

            // Create a new text box with a select for data types and options
            const newTextBox = `
                <div class="form-group" id="text-box-${textBoxCount}">
                    <label for="text-${textBoxCount}">Text Box ${textBoxCount}:</label>
                    <input type="text" id="text-${textBoxCount}" name="text_boxes[${textBoxCount}][value]" placeholder="Enter value" required>
                    
                    <label for="data-type-${textBoxCount}">Data Type:</label>
                    <select id="data-type-${textBoxCount}" name="text_boxes[${textBoxCount}][data_type]" required>
                        <option value="">Select Data Type</option>
                        <option value="string">String</option>
                        <option value="number">Number</option>
                        <option value="email">Email</option>
                        <option value="date">Date</option>
                        <option value="dropdown">Dropdown</option>
                        <!-- Add more data types as needed -->
                    </select>
                    
                    <div class="options-container" id="options-container-${textBoxCount}" style="display: none;">
                        <div class="option-group" id="option-group-${textBoxCount}">
                            <label for="options-${textBoxCount}">Options:</label>
                            <div id="options-list-${textBoxCount}">
                                <div class="option-item">
                                    <input type="text" name="text_boxes[${textBoxCount}][options][]" placeholder="Enter option">
                                    <button type="button" onclick="removeOption(${textBoxCount}, this)">Remove Option</button>
                                </div>
                            </div>
                            <button type="button" onclick="addOption(${textBoxCount})">Add Option</button>
                        </div>
                    </div>
                    
                    <button type="button" onclick="removeTextBox(${textBoxCount})">Remove</button>
                </div>
            `;

            $('#text-boxes-container').append(newTextBox);

            // Add event listener to the newly added data type dropdown
            $(`#data-type-${textBoxCount}`).change(function() {
                handleDataTypeChange(textBoxCount);
            });
        });

        // Handle changes in the data type dropdown
        function handleDataTypeChange(id) {
            const dataType = $(`#data-type-${id}`).val();
            const optionsContainer = $(`#options-container-${id}`);

            if (dataType === 'dropdown') {
                optionsContainer.show();
            } else {
                optionsContainer.hide();
            }
        }

        // Initialize existing text boxes' data type handlers
        $('select[id^="data-type-"]').each(function() {
            const id = $(this).attr('id').split('-').pop();
            handleDataTypeChange(id);
        });
    });

    function removeTextBox(id) {
        $(`#text-box-${id}`).remove();
    }

    function addOption(textBoxId) {
        const optionsList = $(`#options-list-${textBoxId}`);
        const optionCount = optionsList.children().length + 1;
        const newOption = `
            <div class="option-item">
                <input type="text" name="text_boxes[${textBoxId}][options][]" placeholder="Enter option">
                <button type="button" onclick="removeOption(${textBoxId}, this)">Remove Option</button>
            </div>
        `;
        optionsList.append(newOption);
    }

    function removeOption(textBoxId, button) {
        $(button).closest('.option-item').remove();
    }
</script>
</body>
</html>
