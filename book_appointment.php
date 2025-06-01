<!DOCTYPE html>
<html>
<head>
  <title>Book a Patient's Appointment</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href = "Project4.css"></a> 
</head>
<body>
<?php

include 'navbar.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    require_once('connectionProj4.php');

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $PatientID = $_POST['id_number'];
    $_SESSION['id_number'] = $_POST['id_number'];

    $query = "SELECT * FROM Patients1 WHERE FirstName = '$firstName' AND LastName = '$lastName' AND PatientID = '$PatientID'";
    $result = mysqli_query($conn, $query);

    if ($result->num_rows > 0) {
        header("Location: book_appointment_schedule.php");
        exit();
    } else {
        echo '<script type="text/javascript">'; 
        echo 'alert("Patient could not be found, you will be redirect to create an account");';
        echo 'window.location.href = "create_account.php";';
        echo '</script>';
        exit();
    }
}
?>
 <div class="login-container">
  <h1>House of Health: Verify Patient Form</h1>
    <form method="post" action="book_appointment.php">
        <label for="first_name" placeholder = "Matt">First Name: (REQUIRED)</label>
        <input type="text" name="first_name" required><br><br>

        <label for="last_name" placeholder = "Tony">Last Name: (REQUIRED)</label>
        <input type="text" name="last_name" required><br><br>
        
        <label for="id_number" placeholder = "55">ID Number: (REQUIRED)</label>
        <input type="text" name="id_number" required><br><br>
        <input type="submit" value="Verify">
    </form>
</div>
</body>
</html>
