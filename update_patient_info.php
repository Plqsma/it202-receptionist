<!DOCTYPE html>
<html>
<head>
  <title>Update Patient Information</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href = "Project4.css"></a> 
</head>
<body>
  <?php

  // done
  include 'navbar.php';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once('connectionProj4.php');
    $patientID = $_POST['patientID'];
    $shotsGiven = $_POST['shotsGiven'];
    $illnesses = $_POST['illnesses'];

    $sql = "SELECT * FROM Patients2 WHERE PatientID = $patientID";
    $result = $conn->query($sql);


    if (mysqli_num_rows($result) > 0) {
      $updateSql = "UPDATE Patients2 SET ShotsGiven = '$shotsGiven', Illnesses = '$illnesses' WHERE PatientID = $patientID";
     
      if (mysqli_query($conn, $updateSql)) {
      echo '<script>confirm("You are about to update the Shots and Illnesses for the patient. Are you sure you want to do so?");</script>';
      $confirmSql = "SELECT * FROM Patients2 WHERE PatientID = $patientID AND Illnesses = $illnesses";
        if (mysqli_query($conn, $confirmSql)) {echo '<script>alert("' . $illnesses . ' and ' . $shotsGiven . ' have been updated")</script>';}
      } else {
        echo "Error updating patient records: " . mysqli_error($conn);
      }
    } else {
      echo '<script>alert("Invalid Patient ID");</script>';
    }

    mysqli_close($conn);
  }
  ?>
  <div class="login-container">
  <h1>House of Health: Update Patient Information</h1>
  <form method="post" action = 'update_patient_info.php'>
    <label for="patientID">Patient ID: (REQUIRED)</label>
    <input type="text" name="patientID" placeholder = "1001" required><br><br>
    
    <label for="shotsGiven">Shots: (REQUIRED)</label>
    <input type="text" name="shotsGiven" placeholder = "MMR" required><br><br>

    <label for="illnesses">Illnesses: (REQUIRED)</label>
    <input type="text" name="illnesses" placeholder ="Vertigo" required><br><br>
    <input type="submit" value="Update Patient" onclick = >
  </form>
</div>
</body>
</html>
