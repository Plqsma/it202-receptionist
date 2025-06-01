<!DOCTYPE html>
<html>
<head>
  <title>Cancel Procedure</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href = "Project4.css"></a> 
</head>
<body>
<?php
// done
include('navbar.php');
require_once("connectionProj4.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $procedureID = $_POST['procedure_id'];

        $query = "SELECT * FROM Procedures WHERE ProcedureID = '$procedureID'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<script>
                    if(confirm('Are you sure you want to cancel the procedure?')) {
                    alert('Procedure has been deleted')    
                    window.location.href = 'cancel_procedure_confirm.php?procedure_id=$procedureID'
                    } </script>";      
        } else {
            echo "<script>alert('The procedure does not exist. Please enter a valid Procedure ID.');</script>";
        }
    }

?>
    <div class="login-container">
    <h1>House of Health: Cancel A Procedure Form</h1>
    <form method="post" action="cancel_procedure.php">
        <label for="procedure_id">Patient's Procedure ID: (REQUIRED)</label>
        <input type="text" id="procedure_id" name="procedure_id" placeholder = "111" required><br><br>
        <input type="submit" value="Cancel Procedure">
    </form>
</div>
</body>
</html>