<?php
require('/xampp/htdocs/E-Project/db.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM patient WHERE id=$id";

    if ($conn->query($sql)) {
        echo 'success';  // Send success message to AJAX
    } else {
        echo 'Error: ' . $conn->error;  // Send error message to AJAX
    }
}
?>
