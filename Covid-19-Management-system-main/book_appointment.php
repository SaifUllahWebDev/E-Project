<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            display: flex;
            flex-direction: row;
            min-height: 100vh;
            background-color: #f5f5f5;
        }

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
            font-weight: 500;
        }

        .sidebar a {
            text-decoration: none;
            color: white;
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 5px;
            display: block;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #34495e;
        }

        .main-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .form-container {
            width: 100%;
            max-width: 500px;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 500;
            color: #333;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #555;
        }

        .input-group input,
        .input-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #2980b9;
        }

        .success-message,
        .error-message {
            text-align: center;
            font-weight: 500;
            margin-top: 20px;
        }

        .success-message {
            color: green;
        }

        .error-message {
            color: red;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        
        <a href="index.html">Search Vaccination </a>
        <a href="book_appointment.php">Request for COVID-19 Test</a>
        <a href="display_report.php">Vaccination Report</a>
        <a href="book_appointment.php">Book Hospital Appointment</a>
        <a href="checkappointments.php">My Appointment</a>
        
        
    </div>

    <div class="main-content">
        <div class="form-container">
            <h2>Book Your Appointment</h2>
            <form method="POST" action="">
                <div class="input-group">
                    <label for="patient_name">Patient Name:</label>
                    <input type="text" id="patient_name" name="patient_name" required>
                </div>

                <div class="input-group">
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" id="phone_number" name="phone_number" required>
                </div>

                <div class="input-group">
                    <label for="hospital_id">Hospital Name:</label>
                    <select id="hospital_id" name="hospital_id" required>
                        <option value="">Select Hospital</option>
                        <?php
                        require("db.php");
                        $hospitalQuery = "SELECT id, hospital_name FROM hospitals";
                        $hospitalResult = $conn->query($hospitalQuery);
                        if ($hospitalResult && $hospitalResult->num_rows > 0) {
                            while ($row = $hospitalResult->fetch_assoc()) {
                                echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['hospital_name']) . "</option>";
                            }
                        } else {
                            echo "<option value=''>No hospitals available</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="input-group">
                    <label for="allergy">Allergy:</label>
                    <input type="text" id="allergy" name="allergy">
                </div>

                <div class="input-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="dob" required>
                </div>
                        
                <div class="input-group">
                    <label for="vaccination_name">Vaccination Name:</label>
                    <input type="text" id="vaccination_name" name="vaccination_name" required placeholder="Enter vaccine name">
                </div>
                
                <div class="input-group">
                    <label for="appointment_date">Appointment Date:</label>
                    <input type="date" id="appointment_date" name="appointment_date" required>
                </div>

               

                <button type="submit" class="submit-btn">Book Appointment</button>

            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $patient_name = $_POST['patient_name'];
                $phone_number = $_POST['phone_number'];
                $hospital_id = $_POST['hospital_id'];
                $allergy = $_POST['allergy'];
                $dob = $_POST['dob'];
                $vaccination_name = $_POST['vaccination_name'];
                $appointment_date = $_POST['appointment_date'];

                $sql = "INSERT INTO appointments (patient_name, phone_number, hospital_id, allergy, dob, vaccination_name, appointment_date, status) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending')";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssissss", $patient_name, $phone_number, $hospital_id, $allergy, $dob, $vaccination_name, $appointment_date);

                if ($stmt->execute()) {
                    echo "<p class='success-message'>Your appointment has been booked successfully! Please wait for approval.</p>";
                } else {
                    echo "<p class='error-message'>Error: " . $stmt->error . "</p>";
                }

                $stmt->close();
                $conn->close();
            }
            ?>
        </div>
    </div>
</body>

</html>
