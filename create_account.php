<!DOCTYPE html>
<html>
<head>
  <title>Create a New Account</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href = "Project4.css"></a> 
</head>
<body>
  <?php
  //done
  include 'navbar.php';
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    require_once('connectionProj4.php');

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $patientID = $_POST['patientID'];

    $checkSql = "SELECT * FROM Patients1 WHERE FirstName = '$firstName' AND LastName = '$lastName' AND PatientID = '$patientID'";
    $checkResult = mysqli_query($conn, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
      echo '<script>alert("PATIENT EXISTS IN THE SYSTEM");</script>';
    } else {
      $insertSql = "INSERT INTO Patients1 (PatientID, FirstName, LastName) VALUES ('$patientID', '$firstName', '$lastName')";
      
      if (mysqli_query($conn, $insertSql)) {
        echo '<script>alert("Patient Account Created");</script>';
      } else {
        echo '<script>alert("ID is used, please enter another");</script>';
      }
    }
    $conn->close();  
  }
  ?>
   <div class="login-container">
  <h1>House of Health: Update Patient Information</h1>
  <form method="post" action = "create_account.php">
    <label for="firstName">Patients's First Name: (REQUIRED)</label>
    <input type="text" name="firstName" placeholder = "Matt" required><br><br>
    
    <label for="lastName">Patient's Last Name: (REQUIRED)</label>
    <input type="text" name="lastName" placeholder = "Tony" required><br><br>

    <label for="patientID">Patient's ID Number: (REQUIRED)</label>
    <input type="text" name="patientID" placeholder = "15" required><br><br>
    <input type="submit" value="Create Account">
  </form>
</div>
</body>
</html>
