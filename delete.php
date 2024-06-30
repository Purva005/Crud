<?php
include "config.php";

$id = $_GET['id'];

$sql = "DELETE FROM `table@1` WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    header("Location: view.php");
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
