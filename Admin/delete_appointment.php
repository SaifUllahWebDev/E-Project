<?php
require('/xampp/htdocs/E-Project/db.php');

if (isset($_GET['id'])) {
    $appointmentId = $_GET['id'];

    $sql = "DELETE FROM appointment WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointmentId);

    if ($stmt->execute()) {
        header("Location: admin_appointments.php");
    } else {
        echo "Error deleting appointment: " . $conn->error;
    }
}
?>
