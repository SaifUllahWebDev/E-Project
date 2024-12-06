<?php
require('/xampp/htdocs/E-Project/db.php');

if (isset($_GET['id'])) {
    $appointmentId = $_GET['id'];

    // Fetch appointment details
    $sql = "SELECT * FROM appointment WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointmentId);
    $stmt->execute();
    $result = $stmt->get_result();
    $appointment = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_name = $_POST['patient_name'];
    $phone_number = $_POST['phone_number'];
    $allergy = $_POST['allergy'];
    $vaccination_name = $_POST['vaccination_name'];
    $appointment_date = $_POST['appointment_date'];
    $status = $_POST['status'];

    // Update appointment details
    $sql = "UPDATE appointment SET patient_name = ?, phone_number = ?, allergy = ?, vaccination_name = ?, appointment_date = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $patient_name, $phone_number, $allergy, $vaccination_name, $appointment_date, $status, $appointmentId);

    if ($stmt->execute()) {
        header("Location: admin_appointments.php");
    } else {
        echo "Error updating appointment: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment</title>
</head>
<body>
    <h1>Edit Appointment</h1>
    <form method="POST">
        Patient Name: <input type="text" name="patient_name" value="<?= $appointment['patient_name']; ?>"><br>
        Phone Number: <input type="text" name="phone_number" value="<?= $appointment['phone_number']; ?>"><br>
        Allergy: <input type="text" name="allergy" value="<?= $appointment['allergy']; ?>"><br>
        Vaccination Name: <input type="text" name="vaccination_name" value="<?= $appointment['vaccination_name']; ?>"><br>
        Appointment Date: <input type="date" name="appointment_date" value="<?= $appointment['appointment_date']; ?>"><br>
        Status: 
        <select name="status">
            <option <?= $appointment['status'] === 'Pending' ? 'selected' : ''; ?>>Pending</option>
            <option <?= $appointment['status'] === 'Completed' ? 'selected' : ''; ?>>Completed</option>
            <option <?= $appointment['status'] === 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
        </select><br>
        <button type="submit">Update Appointment</button>
    </form>
</body>
</html>
