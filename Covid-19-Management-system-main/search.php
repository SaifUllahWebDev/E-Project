<?php
include ("db.php");


// Get city from AJAX request
$city = $_POST['city'];

// Query to search hospitals by city
$sql = "SELECT * FROM hospitals WHERE location LIKE ?";
$stmt = $conn->prepare($sql);
$search_city = "%$city%";
$stmt->bind_param("s", $search_city);
$stmt->execute();
$result = $stmt->get_result();

// Display results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='result-item'>";
        echo "<h3>" . $row['hospital_name'] . "</h3>";
        echo "<p><strong>Address:</strong> " . $row['location'] . "</p>";
        
        echo "</div>";
    }
} else {
    echo "<p>No hospitals found for the specified city.</p>";
}

// Close connection
$stmt->close();
$conn->close();
?>
