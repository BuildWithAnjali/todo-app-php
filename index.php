<?php
include 'db.php';
session_start();

$editMode = false;
$editTask = "";
$editId = "";

if (isset($_GET['edit'])) {
    $editId = (int)$_GET['edit'];
    $result = $conn->query("SELECT * FROM todos WHERE id = $editId");
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $editTask = $row['task'];
        $editMode = true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>ToDo App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h3>📝 My ToDo List</h3>
                </div>
                <div class="card-body">

                    <!-- Add or Edit Task Form -->
                    <?php if ($editMode): ?>
                        <form action="update.php" method="POST" class="d-flex mb-4">
                            <input type="hidden" name="id" value="<?= $editId ?>">
                            <input type="text" name="task" class="form-control me-2" value="<?= htmlspecialchars($editTask) ?>" required>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="index.php" class="btn btn-secondary ms-2">Cancel</a>
                        </form>
                    <?php else: ?>
                        <form action="add.php" method="POST" class="d-flex mb-4">
                            <input type="text" name="task" class="form-control me-2" placeholder="Enter new task..." required>
                            <button type="submit" class="btn btn-success">Add</button>
                        </form>
                    <?php endif; ?>

                    <!-- Pending Tasks -->
                    <h5>📌 Pending Tasks</h5>
                    <ul class="list-group mb-4">
                        <?php
                        $pending = $conn->query("SELECT * FROM todos WHERE status='pending' ORDER BY id DESC");
                        if ($pending->num_rows > 0) {
                            while ($row = $pending->fetch_assoc()) {
                                echo "
                                <li class='list-group-item d-flex justify-content-between align-items-center'>
                                    {$row['task']}
                                    <div>
                                        <a href='index.php?edit={$row['id']}' class='btn btn-sm btn-outline-warning me-1'>Edit</a>
                                        <a href='complete.php?id={$row['id']}' class='btn btn-sm btn-outline-primary me-1'>Complete</a>
                                        <a href='delete.php?id={$row['id']}' class='btn btn-sm btn-outline-danger'>Delete</a>
                                    </div>
                                </li>";
                            }
                        } else {
                            echo "<li class='list-group-item text-muted'>No pending tasks.</li>";
                        }
                        ?>
                    </ul>

                    <!-- Completed Tasks -->
                    <h5>✅ Completed Tasks</h5>
                    <ul class="list-group">
                        <?php
                        $completed = $conn->query("SELECT * FROM todos WHERE status='completed' ORDER BY id DESC");
                        if ($completed->num_rows > 0) {
                            while ($row = $completed->fetch_assoc()) {
                                echo "
                                <li class='list-group-item d-flex justify-content-between align-items-center'>
                                    <s>{$row['task']}</s>
                                    <div>
                                        <a href='index.php?edit={$row['id']}' class='btn btn-sm btn-outline-warning me-1'>Edit</a>
                                        <a href='delete.php?id={$row['id']}' class='btn btn-sm btn-outline-danger'>Delete</a>
                                    </div>
                                </li>";
                            }
                        } else {
                            echo "<li class='list-group-item text-muted'>No completed tasks.</li>";
                        }
                        ?>
                    </ul>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
