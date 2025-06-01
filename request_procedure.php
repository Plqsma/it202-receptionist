<!DOCTYPE html>
<html>
<head>
  <title>Request a Procedure</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href = "Project4.css"></a> 
</head>
<body>
<?php
function generateUniqueProcedureID() {
        return rand(50, 99);
    }

include 'navbar.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('connectionProj4.php');

    $procedureDate = $_POST['procedure_date'];
    $procedureType = $_POST['procedure_type'];
    $appointmentID = $_POST['appointment_id']; 

    $query =  "SELECT * FROM Appointments WHERE AppointmentID = '$appointmentID'";
    $result = mysqli_query($conn, $query);
    
    if ($result->num_rows > 0) {
        $procedureID = generateUniqueProcedureID();
        $insertQuery = "INSERT INTO Procedures (ProcedureDate, ProcedureType, ProcedureID) VALUES ('$procedureDate', '$procedureType', '$procedureID')";
            if (mysqli_query($conn, $insertQuery)) {
        echo "<script>
        if(confirm('You are about to schedule a procedure. Are you sure you want to do so?')) {
        alert('Procedure Appointment Scheduled. Your number is $procedureID') 
        } </script>";  
    }   
} else {
        echo "<script>alert('Please make sure a pre-procedure appointment was made')</script>;";
    }

}
?>

<div class="login-container">
    <h1>Schedule Procedure</h1>
    <form method="post" action="request_procedure.php">
        <label for="procedure_date">Procedure Date: (REQUIRED)</label>
        <input type="date" id="procedure_date" name="procedure_date" placeholder = "December 5, 2024" required><br><br>

        <label for="procedure_type">Procedure Type: (REQUIRED)</label>
        <input type="text" id="procedure_type" name="procedure_type" placeholder = "Lasik Surgery" required><br><br>

        <label for="appointment_id">Appointment ID: (REQUIRED)</label>
        <input type="text" id="appointment_id" name="appointment_id" placeholder = "10" required><br><br>
        
        <input type="submit" value="Schedule Procedure">
    </form>
</div>
</body>
</html>
