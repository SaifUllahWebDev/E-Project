<?php
require('/xampp/htdocs/E-Project/db.php');

// Fetch all hospital details
$sql = "SELECT * FROM hospital_user";
$result = $conn->query($sql);

// Handle status updates
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hospital_id = $_POST['hospital_id'];
    $status = $_POST['status'];

    $update_sql = "UPDATE hospital_user SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("si", $status, $hospital_id);

    if ($stmt->execute()) {
        echo "Hospital status updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Refresh the page
    header("Location: admin_hospital_details.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Hospital Details</title>
    <link rel="stylesheet" href="CSS/hospital_detail.css">
</head>
<body>
    <h1>Hospital Details</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Hospital Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Location</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['hospital_name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['location'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td>
                    <form method='POST' style='display:inline-block;'>
                        <input type='hidden' name='hospital_id' value='" . $row['id'] . "'>
                        <button type='submit' name='status' value='Approved'>Approve</button>
                        <button type='submit' name='status' value='Rejected'>Reject</button>
                    </form>
                </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No hospitals found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
