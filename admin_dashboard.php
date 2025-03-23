<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: admin_login.php");
    exit();
}
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>

    <div class="dashboard-container">
        <div class="dashboard-header">
            <h2>Welcome, Admin</h2>
            <a href="admin_logout.php"><button class="logout-btn">Logout</button></a>
        </div>

        <!-- Department Selection Dropdown -->
        <label>Select Department:</label>
        <select id="department-select" class="select-department" onchange="showDepartment()">
            <option value="computer">Computer Engineering</option>
            <option value="mechanical">Mechanical Engineering</option>
            <option value="civil">Civil Engineering</option>
        </select>

        <!-- Computer Engineering -->
        <div id="computer" class="tab-content active">
            <div class="form-container">
                <h3>Add Lecture - Computer Engineering</h3>
                <form action="add_lecture.php" method="POST">
                    <input type="hidden" name="department" value="Computer Engineering">
                    <label>Lecture Name:</label>
                    <input type="text" name="lecture_name" required>

                    <label>Phone:</label>
                    <input type="text" name="phone" required>

                    <label>Email:</label>
                    <input type="email" name="email" required>

                    <button type="submit" class="add-btn">Add Lecture</button>
                </form>
            </div>

            <h3>Lecture List</h3>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                <?php
                $result = $conn->query("SELECT * FROM lectures WHERE department='Computer Engineering'");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['lecture_name']}</td>
                            <td>{$row['phone']}</td>
                            <td>{$row['email']}</td>
                            <td><a href='delete_lecture.php?id={$row['id']}'><button class='delete-btn'>Delete</button></a></td>
                          </tr>";
                }
                ?>
            </table>
        </div>

        <!-- Mechanical Engineering -->
        <div id="mechanical" class="tab-content">
            <div class="form-container">
                <h3>Add Lecture - Mechanical Engineering</h3>
                <form action="add_lecture.php" method="POST">
                    <input type="hidden" name="department" value="Mechanical Engineering">
                    <label>Lecture Name:</label>
                    <input type="text" name="lecture_name" required>

                    <label>Phone:</label>
                    <input type="text" name="phone" required>

                    <label>Email:</label>
                    <input type="email" name="email" required>

                    <button type="submit" class="add-btn">Add Lecture</button>
                </form>
            </div>
        </div>

        <!-- Civil Engineering -->
        <div id="civil" class="tab-content">
            <div class="form-container">
                <h3>Add Lecture - Civil Engineering</h3>
                <form action="add_lecture.php" method="POST">
                    <input type="hidden" name="department" value="Civil Engineering">
                    <label>Lecture Name:</label>
                    <input type="text" name="lecture_name" required>

                    <label>Phone:</label>
                    <input type="text" name="phone" required>

                    <label>Email:</label>
                    <input type="email" name="email" required>

                    <button type="submit" class="add-btn">Add Lecture</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showDepartment() {
            let selectedDepartment = document.getElementById('department-select').value;
            let tabs = document.querySelectorAll('.tab-content');

            tabs.forEach(tab => tab.classList.remove('active'));
            document.getElementById(selectedDepartment).classList.add('active');
        }
    </script>

</body>
</html>
