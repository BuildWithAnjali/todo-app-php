<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    $sql = "DELETE FROM todos WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Task deleted successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error deleting task'); window.location.href='index.php';</script>";
    }
} else {
    header("Location: index.php");
}
?>
