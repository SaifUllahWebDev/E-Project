<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Vaccines</title>
    <style>
        /* Global Styles */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #333333;
            color: white;
            display: flex;
            flex-direction: column;
            position: fixed;
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            border-bottom: 1px solid #333333;
        }

        .sidebar-menu {
            list-style-type: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
        }

        .sidebar-menu li {
            
        }

        .sidebar-menu a {
            display: block;
            padding: 15px 20px;
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        .sidebar-menu a:hover {
            background-color: #2980b9;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        table th {
            background-color: #333333;
            color: white;
        }

        .action-buttons button {
            padding: 8px 12px;
            margin: 0 5px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
        }

        .edit-btn {
            background-color: #27ae60;
            color: white;
        }

        .edit-btn:hover {
            background-color: #219150;
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">Doctor Panel</div>
        <ul class="sidebar-menu">
            <li><a href="doctor_panel.php">Dashboard</a></li>
            <li><a href="add_vaccine.php">Add Vaccine</a></li>
            <li><a href="check_vaccine.php">Check Vaccines</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h1>Check Vaccines</h1>
        <table>
            <thead>
                <tr>
                    <th>Hospital ID</th>
                    <th>Vaccine Name</th>
                    <th>Availability Status</th>
                    <th>Availability Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require("/xampp/htdocs/E-Project/db.php");

                // Fetch vaccine data
                $query = "SELECT * FROM vaccine_availability";
                $result = $conn->query($query);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['hospital_id']) . "</td>
                                <td>" . htmlspecialchars($row['vaccine_name']) . "</td>
                                <td>" . htmlspecialchars($row['availability_status']) . "</td>
                                <td>" . htmlspecialchars($row['availability_count']) . "</td>
                                <td class='action-buttons'>
                                    <a href='edit_vaccine.php?id=" . $row['hospital_id'] . "'><button class='edit-btn'>Edit</button></a>
                                    <form method='POST' style='display:inline;' onsubmit='return confirm(\"Are you sure you want to delete this vaccine?\")'>
                                        <input type='hidden' name='delete_id' value='" . $row['hospital_id'] . "'>
                                        <button type='submit' class='delete-btn'>Delete</button>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No vaccines found</td></tr>";
                }

                // Handle delete request
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
                    $delete_id = $_POST['delete_id'];

                    // Delete query
                    $deleteQuery = "DELETE FROM vaccine_availability WHERE hospital_id = ?";
                    $stmt = $conn->prepare($deleteQuery);
                    $stmt->bind_param("i", $delete_id);

                    if ($stmt->execute()) {
                        echo "<script>alert('Vaccine deleted successfully!'); window.location.href='check_vaccine.php';</script>";
                    } else {
                        echo "<script>alert('Error deleting vaccine: " . $stmt->error . "');</script>";
                    }

                    $stmt->close();
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
