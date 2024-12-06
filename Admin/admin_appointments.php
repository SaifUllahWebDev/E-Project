<?php
require('/xampp/htdocs/E-Project/db.php'); // Database connection

// Fetch appointments
$sql = "SELECT * FROM appointment ORDER BY appointment_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Appointments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #333;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .btn {
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .edit-btn {
            background-color: #4CAF50;
            color: white;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Admin Panel - Appointments</h1>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Patient Name</th>
                <th>Phone Number</th>
                <th>Allergy</th>
                <th>Vaccination Name</th>
                <th>Appointment Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['patient_name']; ?></td>
                    <td><?= $row['phone_number']; ?></td>
                    <td><?= $row['allergy']; ?></td>
                    <td><?= $row['vaccination_name']; ?></td>
                    <td><?= $row['appointment_date']; ?></td>
                    <td><?= $row['status']; ?></td>
                    <td>
                        <button class="btn edit-btn" onclick="editAppointment(<?= $row['id']; ?>)">Edit</button>
                        <button class="btn delete-btn" onclick="deleteAppointment(<?= $row['id']; ?>)">Delete</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No appointments found.</p>
    <?php endif; ?>

    <script>
        function editAppointment(appointmentId) {
            window.location.href = `edit_appointment.php?id=${appointmentId}`;
        }
        function deleteAppointment(appointmentId) {
            const confirmDelete = confirm("Are you sure you want to delete this appointment?");
            if (confirmDelete) {
                window.location.href = `delete_appointment.php?id=${appointmentId}`;
            }
        }
    </script>
</body>
</html>
