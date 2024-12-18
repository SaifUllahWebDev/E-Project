<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vaccine</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            width: 400px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #3498db;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        .form-group button:hover {
            background-color: #2980b9;
        }

        .success-message {
            text-align: center;
            color: green;
            margin-top: 20px;
        }

        .error-message {
            text-align: center;
            color: red;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <form method="POST" action="edit_vaccine.php">
        <h2>Edit Vaccine</h2>

        <?php
        require("db.php");

        // Get vaccine ID from URL
        if (isset($_GET['id'])) {
            $vaccine_id = $_GET['id'];

            // Fetch vaccine data
            $query = "SELECT * FROM vaccine_availability WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $vaccine_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $vaccine = $result->fetch_assoc();
            } else {
                echo "<p class='error-message'>Vaccine not found.</p>";
                exit();
            }

            $stmt->close();
        } else {
            echo "<p class='error-message'>Invalid request.</p>";
            exit();
        }

        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $vaccine_name = $_POST['vaccine_name'];
            $availability_status = $_POST['availability_status'];
            $availability_count = $_POST['availability_count'];
            $hospital_id = $_POST['hospital_id'];

            // Update vaccine details
            $updateQuery = "UPDATE vaccine_availability 
                            SET vaccine_name = ?, availability_status = ?, availability_count = ?, hospital_id = ? 
                            WHERE id = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("ssiii", $vaccine_name, $availability_status, $availability_count, $hospital_id, $vaccine_id);

            if ($stmt->execute()) {
                echo "<p class='success-message'>Vaccine updated successfully!</p>";
                // Refresh vaccine data
                header("Refresh:2; url=check_vaccine.php");
                exit();
            } else {
                echo "<p class='error-message'>Error updating vaccine: " . $stmt->error . "</p>";
            }

            $stmt->close();
        }

        $conn->close();
        ?>

        <div class="form-group">
            <label for="hospital_id">Hospital ID:</label>
            <input type="number" id="hospital_id" name="hospital_id" value="<?= htmlspecialchars($vaccine['hospital_id']) ?>" required>
        </div>

        <div class="form-group">
            <label for="vaccine_name">Vaccine Name:</label>
            <input type="text" id="vaccine_name" name="vaccine_name" value="<?= htmlspecialchars($vaccine['vaccine_name']) ?>" required>
        </div>

        <div class="form-group">
            <label for="availability_status">Availability Status:</label>
            <select id="availability_status" name="availability_status" required>
                <option value="Available" <?= $vaccine['availability_status'] == 'Available' ? 'selected' : '' ?>>Available</option>
                <option value="Unavailable" <?= $vaccine['availability_status'] == 'Unavailable' ? 'selected' : '' ?>>Unavailable</option>
            </select>
        </div>

        <div class="form-group">
            <label for="availability_count">Availability Count:</label>
            <input type="number" id="availability_count" name="availability_count" value="<?= htmlspecialchars($vaccine['availability_count']) ?>" min="0" required>
        </div>

        <div class="form-group">
            <button type="submit">Update Vaccine</button>
        </div>
    </form>
</body>

</html>
