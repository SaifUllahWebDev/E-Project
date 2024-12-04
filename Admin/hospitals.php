<?php
require('/xampp/htdocs/E-Project/db.php');

// Fetch all hospitals
$sql = "SELECT * FROM hospitals";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospitals List</title>
    <link rel="stylesheet" href="CSS/hospital.css">
</head>
<body>
    <div class="container">
        <h1>Hospitals</h1>
        <?php
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Hospital Name</th><th>Location</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><a href='hospital_vaccines.php?hospital_id=" . $row['id'] . "'>" . $row['hospital_name'] . "</a></td>";
                echo "<td>" . $row['location'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='text-align: center;'>No hospitals found.</p>";
        }
        ?>
    </div>
</body>
</html>
