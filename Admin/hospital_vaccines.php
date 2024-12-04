<?php
require('/xampp/htdocs/E-Project/db.php');

// Get the hospital ID from the URL
$hospital_id = $_GET['hospital_id'];

// Fetch hospital details
$hospital_sql = "SELECT hospital_name FROM hospitals WHERE id = ?";
$stmt = $conn->prepare($hospital_sql);
$stmt->bind_param("i", $hospital_id);
$stmt->execute();
$hospital_result = $stmt->get_result();
$hospital = $hospital_result->fetch_assoc();

// Fetch vaccines for the hospital
$vaccine_sql = "SELECT vaccine_name, availability_count FROM vaccine_availability WHERE hospital_id = ?";
$stmt = $conn->prepare($vaccine_sql);
$stmt->bind_param("i", $hospital_id);
$stmt->execute();
$vaccine_result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccines Available</title>
    <link rel="stylesheet" href="CSS/hospital_vaccine.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            margin: auto;
            margin-top: 20px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        table th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Vaccines at <?php echo htmlspecialchars($hospital['hospital_name']); ?></h1>
        <?php
        if ($vaccine_result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Vaccine Name</th><th>Availability Count</th></tr>";
            while ($row = $vaccine_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['vaccine_name'] . "</td>";
                echo "<td>" . $row['availability_count'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='text-align: center;'>No vaccines available for this hospital.</p>";
        }
        ?>
    </div>
</body>
</html>
