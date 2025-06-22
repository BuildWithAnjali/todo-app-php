<?php
include 'db.php';
session_start();

if (isset($_POST['id']) && isset($_POST['task'])) {
    $id = (int)$_POST['id'];
    $task = $conn->real_escape_string($_POST['task']);

    if (trim($task) === "") {
        $_SESSION['message'] = "Task cannot be empty!";
        $_SESSION['type'] = "warning";
        header("Location: index.php");
        exit;
    }

    $sql = "UPDATE todos SET task = '$task' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Task updated successfully!";
        $_SESSION['type'] = "primary";
    } else {
        $_SESSION['message'] = "Error updating task!";
        $_SESSION['type'] = "danger";
    }
}

header("Location: index.php");
?>
