<?php
include('db.php');

// Fetch data from the "patient" table
$query = "SELECT id, patient_name, phone_number, dob, allergy, age, medicine_prescribed, vaccination_status, corona_result FROM patient";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Records</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            display: flex;
            background: #f4f4f9;
        }

        /* Vertical Navbar */
        .sidebar {
            width: 240px;
            height: 100vh;
            background: #007bff;
            color: white;
            display: flex;
            flex-direction: column;
            position: fixed;
            padding-top: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 22px;
        }

        .sidebar a {
            color: white;
            padding: 15px;
            text-decoration: none;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #0056b3;
        }

        .container {
            margin-left: 240px; /* Space for the sidebar */
            padding: 20px;
            flex-grow: 1;
            background: #fff;
            border-radius: 8px;
            max-width: 90%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        .btn-export {
            padding: 8px 16px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-export:hover {
            background: #218838;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
<a href="index.html">Search Vaccination </a>
        <a href="book_appointment.php">Request for COVID-19 Test</a>
        <a href="display_report.php">Vaccination Report</a>
        <a href="book_appointment.php">Book Hospital Appointment</a>
        <a href="checkappointments.php">My Appointment</a>
</div>

<!-- Main Content -->
<div class="container">
    <h1>Patient Records</h1>
    <table>
        <thead>
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
                <th>Export</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['patient_name']) ?></td>
                        <td><?= htmlspecialchars($row['phone_number']) ?></td>
                        <td><?= htmlspecialchars($row['dob']) ?></td>
                        <td><?= htmlspecialchars($row['allergy']) ?></td>
                        <td><?= htmlspecialchars($row['age']) ?></td>
                        <td><?= htmlspecialchars($row['medicine_prescribed']) ?></td>
                        <td><?= htmlspecialchars($row['vaccination_status']) ?></td>
                        <td><?= htmlspecialchars($row['corona_result']) ?></td>
                        <td>
                            <button class="btn-export" onclick="exportToPDF(<?= htmlspecialchars(json_encode($row)) ?>)">Export</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">No records found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
    function exportToPDF(rowData) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Add content to PDF
        doc.text(`Patient Name: ${rowData.patient_name}`, 10, 10);
        doc.text(`Phone Number: ${rowData.phone_number}`, 10, 20);
        doc.text(`Date of Birth: ${rowData.dob}`, 10, 30);
        doc.text(`Allergy: ${rowData.allergy}`, 10, 40);
        doc.text(`Age: ${rowData.age}`, 10, 50);
        doc.text(`Medicine Prescribed: ${rowData.medicine_prescribed}`, 10, 60);
        doc.text(`Vaccination Status: ${rowData.vaccination_status}`, 10, 70);
        doc.text(`Corona Result: ${rowData.corona_result}`, 10, 80);

        // Save the PDF
        doc.save(`${rowData.patient_name}_report.pdf`);
    }
</script>
</body>
</html>
