<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vaccine</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General Body Styles */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
            margin: 10px 0;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background-color: #34495e;
        }

        .sidebar a.active {
            background-color: #1abc9c;
        }

        /* Main Content Area */
        .main-content {
            flex-grow: 1;
            padding: 30px;
        }

        .main-content h2 {
            margin-bottom: 20px;
        }

        form {
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
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
    <!-- Sidebar Section -->
    <div class="sidebar">
        <h2>Doctor Panel</h2>
        <a href="Appointment.php"><i class="fas fa-calendar-check"></i> Appointments</a>
        <a href="patient.php"><i class="fas fa-user-injured"></i> Patients</a>
        <a href="patient_manage.php"><i class="fas fa-users-cog"></i> Manage Patients</a>
        <a href="add_vaccine.php" class="active"><i class="fas fa-syringe"></i> Add Vaccine</a>
        <a href="check_vaccine.php" class=""><i class="fas fa-syringe"></i> Check Vaccine</a>
    </div>

    <!-- Main Content Section -->
    <div class="main-content">
        <h2>Add Vaccine</h2>
        <form method="POST" action="add_vaccine.php">
            

            <div class="form-group">
                <label for="hospital_name">Hospital Name:</label>
                <input type="text" id="hospital_name" name="hospital_name" required>
            </div>

            <div class="form-group">
                <label for="vaccine_name">Vaccine Name:</label>
                <input type="text" id="vaccine_name" name="vaccine_name" required>
            </div>

            <div class="form-group">
                <label for="availability_status">Availability Status:</label>
                <select id="availability_status" name="availability_status" required>
                    <option value="">Select Status</option>
                    <option value="Available">Available</option>
                    <option value="Unavailable">Unavailable</option>
                </select>
            </div>

            <div class="form-group">
                <label for="availability_count">Availability Count:</label>
                <input type="number" id="availability_count" name="availability_count" min="0" required>
            </div>

            <div class="form-group">
                <button type="submit">Add Vaccine</button>
            </div>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Retrieve form data
                
                $hospital_name = $_POST['hospital_name'];
                $vaccine_name = $_POST['vaccine_name'];
                $availability_status = $_POST['availability_status'];
                $availability_count = $_POST['availability_count'];

                // Database connection
                require("db.php");

                // Insert data into the vaccine_availability table
                $sql = "INSERT INTO vaccine_availability ( hospital_name, vaccine_name, availability_status, availability_count) 
                        VALUES ( ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssi", $hospital_name, $vaccine_name, $availability_status, $availability_count);

                if ($stmt->execute()) {
                    echo "<p class='success-message'>Vaccine added successfully!</p>";
                } else {
                    echo "<p class='error-message'>Error: " . $stmt->error . "</p>";
                }

                $stmt->close();
                $conn->close();
            }
            ?>
        </form>
    </div>
</body>

</html>
