<!DOCTYPE html>
<html>
<head>
  <title>Request an Appointment</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href = "Project4.css"></a> 
  <script src = 'project4test.js'></script>
</head>
<body>

<?php
include 'navbar.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('connectionProj4.php');
    $appointmentDate2 = DateTime::createFromFormat('F j, Y',  $_POST['appointment_date']);
    $appointmentDate = $appointmentDate2->format('Y-m-d');
    $appointmentType = $_POST['appointment_type'];
    $doctorID = $_POST['doctor_id'];
    $PatientID = $_SESSION['id_number'];

    $doctorQuery = "SELECT * FROM Doctors WHERE DoctorID = '$doctorID'";
    $result = $conn->query($doctorQuery);
    $appointmentID = rand(100, 500);

    if ($result->num_rows > 0) {
        $insertQuery = "INSERT INTO Appointments (AppointmentID, PatientID, AppointmentDate, AppointmentType, DoctorID) VALUES ('$appointmentID', '$PatientID','$appointmentDate', '$appointmentType', '$doctorID')";
        if (mysqli_query($conn, $insertQuery)) {
            echo "<script>
    alert('Your appointment has been made and your Appointment ID is: $appointmentID');
    if (confirm('Do you want to schedule a procedure?')) {
        window.location.href = 'request_procedure.php';
    } else {
        window.location.href = 'homepage.php';
    }
</script>";
        }
    } else {
        echo "<script>alert('DoctorID doesn't exist or not in correct form. Please retry.')</script>;";
    }
}
?>
    <div class="login-container">
    <h2>House of Health: Request Appointment Form</h2>
    <form id="form" method="post" action="book_appointment_schedule.php" onsubmit = "bookAppointmentSubmit(event)"=>
        <label for="appointment_date">Appointment Date: (REQUIRED)</label>
        <input type="text" name="appointment_date" id="appointment_date" placeholder = "November 5, 2023" required><br><br>
        <label for="appointment_type">Appointment Type: (REQUIRED)</label>
        <input type="text" name="appointment_type" id = "appointment_type" placeholder = "Checkup" required><br><br>
        <label for="id_number">Doctor ID: (REQUIRED)</label>
        <input type="text" name="doctor_id" id = "doctor_id" placeholder = "105" required><br><br>
        <input type="submit" value="Verify">
    </form>
</div>
</body>
</html>
