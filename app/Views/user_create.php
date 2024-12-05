<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($user) ? 'Edit User' : 'Create New User' ?></title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="text-center mb-4"><?= isset($user) ? 'Edit User' : 'Create New User' ?></h1>

            <form action="<?= isset($user) ? '/user/update/' . $user['id'] : '/user/store' ?>" method="post" class="border p-4 shadow-sm rounded">
        

                <!-- Name Field -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        class="form-control" 
                        value="<?= isset($user) ? $user['name'] : '' ?>" 
                        placeholder="Enter your name" 
                        required
                    >
                </div>

                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        class="form-control" 
                        value="<?= isset($user) ? $user['email'] : '' ?>" 
                        placeholder="Enter your email" 
                        required
                    >
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-between">
                    <a href="/user" class="btn btn-secondary">Back to User List</a>
                    <button type="submit" class="btn btn-primary">
                        <?= isset($user) ? 'Update' : 'Create' ?> User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
