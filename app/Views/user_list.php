<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX CRUD with CodeIgniter</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">User List</h1>

    <button class="btn btn-primary" id="addUserBtn">Add New User</button>

    <!-- Table to display users -->
    <table class="table table-bordered mt-4" id="userTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</div>

<!-- Modal for Adding/Editing User -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <input type="hidden" id="userId">
                    <button type="submit" class="btn btn-primary" id="submitBtn">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    loadUsers();


    $("#addUserBtn").on('click', function() {
        $("#userModal").modal('show');
        $("#userForm")[0].reset();
        $("#userId").val('');
        $("#submitBtn").text('Create');
    });

    $("#userForm").on('submit', function(e) {
        e.preventDefault();

        var userId = $('#userId').val();
        var name = $('#name').val();
        var email = $('#email').val();
        var url = userId ? '/user/update/' + userId : '/user/store';

        $.ajax({
            url: url,
            method: 'POST',
            data: { name: name, email: email },
            success: function(response) {
                alert(response.message);
                $("#userModal").modal('hide');
                loadUsers();
            }
        });
    });

    
    $(document).on('click', '.editBtn', function() {
        var userId = $(this).data('id');

        $.ajax({
            url: '/user/edit/' + userId,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    var user = response.user;
                    $("#userId").val(user.id);
                    $("#name").val(user.name);
                    $("#email").val(user.email);
                    $("#submitBtn").text('Update');
                    $("#userModal").modal('show');
                } else {
                    alert("Error fetching user data");
                }
            }
        });
    });

    
    $(document).on('click', '.deleteBtn', function() {
        var userId = $(this).data('id');

        if (confirm('Are you sure you want to delete this user?')) {
            $.ajax({
                url: '/user/delete/' + userId,
                method: 'POST',
                success: function(response) {
                    alert(response.message);
                    loadUsers();
                }
            });
        }
    });


    function loadUsers() {
        $.ajax({
            url: '/user/fetchAll',
            method: 'GET',
            success: function(response) {
                var usersHtml = '';
                $.each(response.users, function(index, user) {
                    usersHtml += '<tr>';
                    usersHtml += '<td>' + user.id + '</td>';
                    usersHtml += '<td>' + user.name + '</td>';
                    usersHtml += '<td>' + user.email + '</td>';
                    usersHtml += '<td><button class="btn btn-warning editBtn" data-id="' + user.id + '">Edit</button> ';
                    usersHtml += '<button class="btn btn-danger deleteBtn" data-id="' + user.id + '">Delete</button></td>';
                    usersHtml += '</tr>';
                });
                $('#userTable tbody').html(usersHtml);
            }
        });
    }
});
</script>

</body>
</html>
