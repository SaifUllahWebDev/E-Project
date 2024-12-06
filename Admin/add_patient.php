<?php
require('/xampp/htdocs/E-Project/db.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_name = $_POST['patient_name'];
    $phone_number = $_POST['phone_number'];
    $dob = $_POST['dob'];
    $allergy = $_POST['allergy'];
    $age = $_POST['age'];
    $medicine_prescribed = $_POST['medicine_prescribed'];
    $vaccination_status = $_POST['vaccination_status'];
    $corona_result = $_POST['corona_result'];

    $sql = "INSERT INTO patient (patient_name, phone_number, dob, allergy, age, medicine_prescribed, vaccination_status, corona_result) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssisss",
        $patient_name,
        $phone_number,
        $dob,
        $allergy,
        $age,
        $medicine_prescribed,
        $vaccination_status,
        $corona_result
    );

    if ($stmt->execute()) {
        echo "<script>alert('Patient added successfully!'); window.location.href='Admin_panel.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Patient</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: auto;
            background: white;
            padding: 20px;
            margin-top: 50px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin: 10px 0 5px;
        }
        input, select {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Patient</h1>
        <form method="POST">
            <label for="patient_name">Patient Name</label>
            <input type="text" id="patient_name" name="patient_name" required>

            <label for="phone_number">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" required>

            <label for="dob">Date of Birth</label>
            <input type="date" id="dob" name="dob" required>

            <label for="allergy">Allergy</label>
            <input type="text" id="allergy" name="allergy">

            <label for="age">Age</label>
            <input type="number" id="age" name="age" required>

            <label for="medicine_prescribed">Medicine Prescribed</label>
            <input type="text" id="medicine_prescribed" name="medicine_prescribed">

            <label for="vaccination_status">Vaccination Status</label>
            <select id="vaccination_status" name="vaccination_status">
                <option value="Pending">Pending</option>
                <option value="Done">Done</option>
            </select>

            <label for="corona_result">Corona Result</label>
            <select id="corona_result" name="corona_result">
                <option value="Negative">Negative</option>
                <option value="Positive">Positive</option>
            </select>

            <button type="submit">Add Patient</button>
        </form>
    </div>
</body>
</html>
