
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Leave</title>
</head>
<body>
    <h1>Apply for Leave</h1>
    <form action="apply_leave_send.php" method="POST">
        <label for="employee_name">Employee Name:</label>
        <input type="text" id="employee_name" name="employee_name" required><br><br>

        <label for="leave_type">Leave Type:</label>
        <select id="leave_type" name="leave_type" required>
            <option value="Sick Leave">Sick Leave</option>
            <option value="Casual Leave">Casual Leave</option>
            <option value="Annual Leave">Annual Leave</option>
        </select><br><br>

        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required><br><br>

        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required><br><br>

        <input type="submit" value="Apply for Leave">     
      <a href="">check result</a>
    </form>
</body>
</html>