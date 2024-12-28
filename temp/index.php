<?php
// Include the Controller file
require_once '../Controllers/PlataformaController.php';

$controller = new PlataformaController();

// Handle the different actions based on the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create_Nombre'])) {
        // Create a new platform
        $controller->create($_POST['create_Nombre']);
    } elseif (isset($_POST['update_Nombre']) && isset($_POST['update_ID'])) {
        // Update an existing platform
        $controller->update($_POST['update_ID'], $_POST['update_Nombre']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_ID'])) {
    // Handle delete
    $controller->delete($_GET['delete_ID']);
}

// Fetch all platforms for display
$platforms = $controller->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta Nombre="viewport" content="wIDth=device-wIDth, initial-scale=1.0">
    <title>Plataforma Management</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ03vLfxvL2BfNjPj2+dN/8y76A5zG7PHwVgLgP4smH04zxrs8e6EJ3XYI9J" crossorigin="anonymous">
    <style>
        body {
            padding: 20px;
        }
        .container {
            max-wIDth: 800px;
        }
    </style>
</head>
<body>
    <div class="container">
    <h1 class="mb-4">Plataforma Management</h1>

    <!-- Create Platform Form -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Create a New Platform</h5>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="create_name" class="form-label">Platform Name</label>
                    <input type="text" class="form-control" id="create_name" name="create_name" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Platform</button>
            </form>
        </div>
    </div>

        <!-- List of Platforms -->
        <h3>Platform List</h3>
        <?php if (count($platforms) > 0): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($platforms as $platform): ?>
                        <tr>
                            <td><?php echo $platform['id']; ?></td>
                            <td><?php echo $platform['name']; ?></td>
                            <td>
                                <!-- Edit Button (Update) -->
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" 
                                        data-ID="<?php echo $platform['id']; ?>" data-Nombre="<?php echo $platform['name']; ?>">Edit</button>
                                
                                <!-- Delete Button -->
                                <a href="?delete_ID=<?php echo $platform['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No platforms found.</p>
        <?php endif; ?>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Platform</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="">
                            <input type="hidden" id="update_id" name="update_id">
                            <div class="mb-3">
                                <label for="update_name" class="form-label">Platform Name</label>
                                <input type="text" class="form-control" id="update_name" name="update_name" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Platform</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
