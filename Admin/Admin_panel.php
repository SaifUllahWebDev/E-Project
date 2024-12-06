<?php
require('/xampp/htdocs/E-Project/db.php');

// Fetch total number of patients
$total_patients_sql = "SELECT COUNT(*) as total_patients FROM patient";
$total_patients_result = $conn->query($total_patients_sql);
$total_patients = $total_patients_result->fetch_assoc()['total_patients'];

// Fetch patient details
$patients_sql = "SELECT * FROM patient";
$patients_result = $conn->query($patients_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            margin: auto;
            overflow: hidden;
        }

        .dashboard {
            background: #4CAF50;
            color: white;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: white;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background: #f4f4f4;
        }

        table tr:hover {
            background: #f1f1f1;
        }

        h1, h2 {
            text-align: center;
        }

        .action-btn {
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            border: none;
            color: white;
        }

        .edit-btn {
            background-color: #4CAF50;
        }

        .delete-btn {
            background-color: #f44336;
        }

        .add-btn {
            display: inline-block;
            margin: 20px 0;
            padding: 10px 20px;
            background: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .add-btn:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Panel</h1>
        <div class="dashboard">
            <h2>Total Patients: <?= $total_patients ?></h2>
        </div>

        <h2>Patient Details</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Patient Name</th>
                <th>Phone Number</th>
                <th>Date of Birth</th>
                <th>Allergy</th>
                <th>Age</th>
                <th>Medicine Prescribed</th>
                <th>Vaccination Status</th>
                <th>Corona Result</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $patients_result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['patient_name']) ?></td>
                    <td><?= htmlspecialchars($row['phone_number']) ?></td>
                    <td><?= htmlspecialchars($row['dob']) ?></td>
                    <td><?= htmlspecialchars($row['allergy']) ?></td>
                    <td><?= htmlspecialchars($row['age']) ?></td>
                    <td><?= htmlspecialchars($row['medicine_prescribed'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($row['vaccination_status'] ?? 'Pending') ?></td>
                    <td><?= htmlspecialchars($row['corona_result'] ?? 'Unknown') ?></td>
                    <td>
                        <button class="action-btn edit-btn" onclick="editPatient(<?= $row['id'] ?>)">Edit</button>
                        <button class="action-btn delete-btn" onclick="deletePatient(<?= $row['id'] ?>)">Delete</button>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <a href="add_patient.php" class="add-btn">Add New Patient</a>
    </div>

    <script>
        function editPatient(id) {
            // Redirect to edit page
            window.location.href = `edit_patient.php?id=${id}`;
        }

        function deletePatient(id) {
            if (confirm("Are you sure you want to delete this patient?")) {
                // Redirect to delete handler
                window.location.href = `delete_patient.php?id=${id}`;
            }
        }
    </script>
</body>
</html>
