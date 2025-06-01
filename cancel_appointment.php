<!DOCTYPE html>
<html>
<head>
  <title>Cancel an Appointment</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href = "Project4.css"></a> 
  <script src = "project4test.js"></script>
</head>
<body>
<?php
// done
require_once('connectionProj4.php');
include 'navbar.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appointmentID = $_POST['appointmentID'];

    $checkSql = "SELECT * FROM Appointments WHERE AppointmentID = '$appointmentID'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        echo "<script>
        if(confirm('Are you sure you want to cancel the appointment? Cancelling this will cancel the pre-surgical appointment.')) {
        alert('Appointment has been cancelled. Pre-surgical appointment has also been cancelled.')    
        window.location.href = 'cancel_appointment_confirm.php?appointmentID=$appointmentID'
        } </script>";    
    } else {
        echo "<script>alert('Appointment ID does not exist. Please enter a valid Appointment ID.')</script>";
    }
}

?>
<div class="login-container">
  <h1>House of Health: Cancel Appointment</h1>
<form method="post" action="cancel_appointment.php">
        
        <label for="appointmentID">Patient's Appointment ID (REQUIRED)</label>
        <input type="text" name="appointmentID" required><br><br>
        <input type="submit" value="Cancel Appointment">
    </form>
</div>
</body>
</html>