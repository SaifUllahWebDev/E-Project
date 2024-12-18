<?php
include('db.php');

// Fetch data from the database
$sql = "SELECT id, patient_name, phone_number, hospital_name, appointment_date, allergy, dob, vaccination_name, status FROM appointment";
$result = $conn->query($sql);

$appointments = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointment</title>
    <link rel="stylesheet" href="responsive-sidebar-dark-light-main\assets\css\styles.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
        }

        .navbar {
            width: 250px;
            background: #333;
            color: #fff;
            position: fixed;
            height: 100%;
            padding-top: 20px;
        }

        .navbar a {
            text-decoration: none;
            color: #fff;
            display: block;
            padding: 10px 20px;
            transition: background 0.3s;
        }

        .navbar a:hover {
            background: #575757;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
            background-color: #f9f9f9;
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .no-data {
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="navbar">
    <a href="index.html">Search Vaccination </a>
        <a href="book_appointment.php">Request for COVID-19 Test</a>
        <a href="display_report.php">Vaccination Report</a>
        <a href="book_appointment.php">Book Hospital Appointment</a>
        <a href="checkappointments.php">My Appointment</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container">
            <h1>My Appointment</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient Name</th>
                        <th>Contact</th>
                        <th>Hospital Name</th>
                        <th>Appointment Date</th>
                        <th>Allergy</th>
                        <th>Date of Birth</th>
                        <th>Vaccine</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($appointments)): ?>
                        <?php foreach ($appointments as $appointment): ?>
                            <tr>
                                <td><?= htmlspecialchars($appointment['id']) ?></td>
                                <td><?= htmlspecialchars($appointment['patient_name']) ?></td>
                                <td><?= htmlspecialchars($appointment['phone_number']) ?></td>
                                <td><?= htmlspecialchars($appointment['hospital_name']) ?></td>
                                <td><?= htmlspecialchars($appointment['appointment_date']) ?></td>
                                <td><?= htmlspecialchars($appointment['allergy']) ?></td>
                                <td><?= htmlspecialchars($appointment['dob']) ?></td>
                                <td><?= htmlspecialchars($appointment['vaccination_name']) ?></td>
                                <td><?= htmlspecialchars($appointment['status']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="no-data">No Appointments Found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="responsive-sidebar-dark-light-main\assets\js\main.js"></script>
</body>
</html>
