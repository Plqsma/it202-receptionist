<?php
require_once("connectionProj4.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['appointmentID'])) {
    $appointmentID = $_GET['appointmentID'];

    $deleteQuery = "DELETE FROM Appointments WHERE AppointmentID = '$appointmentID'";
    $conn->query($deleteQuery);
    header("Location: cancel_appointment.php");
    exit();
} else {
    header("Location: cancel_appointment.php");
    exit();
}
?> 