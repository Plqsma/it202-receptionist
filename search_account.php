<html>
  <head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href = "Project4.css"></a> 
  <title>Search Account</title>
    
  </head>
  <body>
    
<?php
// done 
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: homepage.php");
    exit();
}
include 'navbar.php';
require_once('connectionProj4.php');


$receptionistID = $_SESSION['id'];

    $sql = "SELECT 
    R.FirstName AS ReceptionistFirstName, 
    R.LastName AS ReceptionistLastName, 
    R.ReceptionistID AS ReceptionistIDNumber, 
    R.PhoneNumber AS ReceptionistPhoneNumber, 
    R.EmailAddress AS ReceptionistEmail,
    P1.FirstName AS PatientFirstName,
    P1.LastName AS PatientLastName,
    P1.PatientID AS PatientID,
    P2.DateOfBirth AS PatientDateOfBirth,
    P2.Age AS PatientAge,
    P2.AddressAndPhoneNumber AS PatientPhoneNumber,
    P2.ShotsGiven AS PatientImmunizationRecord,
    P2.Illnesses AS PatientIllnessRecord,
    A.AppointmentDate AS PatientAppointmentDate,
    A.AppointmentType AS PatientAppointmentType,
    Pr.ProcedureDate AS PatientProcedureDate,
    Pr.ProcedureType AS PatientProcedureType,
    D.DoctorName AS PatientDoctorName,
    D.DoctorID AS DoctorID
    FROM 
    Receptionists1 R
    INNER JOIN 
    Patients1 P1 ON R.ReceptionistID = P1.ReceptionistID
    LEFT JOIN 
    Patients2 P2 ON P1.PatientID = P2.PatientID
    LEFT JOIN 
    Appointments A ON P1.PatientID = A.PatientID
    LEFT JOIN 
    Procedures Pr ON P1.PatientID = Pr.PatientID
    LEFT JOIN 
    Doctors D ON P1.PatientID = D.PatientID
    WHERE
    R.ReceptionistID = '$receptionistID'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Receptionist Name</th><th>Receptionist ID</th><th>Receptionist Phone</th><th>Receptionist Email</th><th>Patient Name</th><th>Patient ID</th><th>Date Of Birth</th><th>Age</th><th>Patient Phone</th><th>Immunization Record</th><th>Illness Record</th><th>Appointment Date</th><th>Appointment Type</th><th>Procedure Date</th><th>Procedure Type</th><th>Doctor's Name</th><th>Doctor ID</th></tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["ReceptionistFirstName"]." ".$row["ReceptionistLastName"]."</td><td>".$row["ReceptionistIDNumber"]."</td><td>".$row["ReceptionistPhoneNumber"]."</td><td>".$row["ReceptionistEmail"]."</td><td>".$row["PatientFirstName"]." ".$row["PatientLastName"]."</td><td>".$row["PatientID"]."</td><td>".$row["PatientDateOfBirth"]."</td><td>".$row["PatientAge"]."</td><td>".$row["PatientPhoneNumber"]."</td><td>".$row["PatientImmunizationRecord"]."</td><td>".$row["PatientIllnessRecord"]."</td><td>".$row["PatientAppointmentDate"]."</td><td>".$row["PatientAppointmentType"]."</td><td>".$row["PatientProcedureDate"]."</td><td>".$row["PatientProcedureType"]."</td><td>".$row["PatientDoctorName"]."</td><td>".$row["DoctorID"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}


$conn->close();
?>
</body>
</html>

