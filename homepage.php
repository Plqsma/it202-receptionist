<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Project4.css">
    <script src = 'project4test.js'></script>
    
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_start();
        require_once('connectionProj4.php');
        $firstName = $_POST['first-name'];
        $lastName = $_POST['last-name'];
        $password = $_POST['password'];
        $phoneNumber = $_POST['phone'];
        $id = $_POST['receptionist-id'];
        $selectedOption = $_POST['transaction-type'];
    
        if ($email = isset($_POST['email-confirmation']) ? $_POST['email'] : '') {
            $sql = "SELECT * FROM Receptionists1 WHERE ReceptionistID = '$id' AND FirstName = '$firstName' AND LastName = '$lastName' AND Password = '$password' 
            AND PhoneNumber = '$phoneNumber' AND EmailAddress = '$email' ";  
        } else {
            $sql = "SELECT * FROM Receptionists1 WHERE ReceptionistID = '$id' AND FirstName = '$firstName' AND LastName = '$lastName' AND Password = '$password' 
            AND PhoneNumber = '$phoneNumber'";    
        }
      
        $result = $conn->query($sql);
        
        $_SESSION['firstName'] = $_POST['first-name'];
        $_SESSION['lastName'] = $_POST['last-name'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['phoneNumber'] = $_POST['phone'];
        $_SESSION['id'] = $_POST['receptionist-id'];
        $_SESSION['email'] = $_POST['email'];
    
        if ($result->num_rows > 0) {
            if ($selectedOption === 'search-account') {
                header("Location: search_account.php");
                exit();
            } elseif ($selectedOption === 'book-appointment') {
                header("Location: book_appointment.php");
                exit();
            } elseif ($selectedOption === 'cancel-appointment') {
                header("Location: cancel_appointment.php");
                exit();
            } elseif ($selectedOption === 'request-procedure') {
                header("Location: request_procedure.php");
                exit();
            } elseif ($selectedOption === 'cancel-procedure') {
                header("Location: cancel_procedure.php");
                exit();
            } elseif ($selectedOption === 'update-info') {
                header("Location: update_patient_info.php");
                exit();
            } elseif ($selectedOption === 'create-account') {
                header("Location: create_account.php");
                exit();
            } else {
                echo '<script>alert("Incorrect option selected");</script>';
            }
        } else {
            echo '<script>alert("Could not find receptionist");</script>';
        }
    
        $conn->close();
    }
    ?>
    
    <div class="login-container">
        <h1>House of Health</h1>
        <form id="form" method="post" action="homepage.php" onsubmit="handleSubmit(event)">
            <label for="first-name">Receptionist's First Name: (REQUIRED)</label>
            <input type="text" id="first-name" name="first-name" placeholder = "Please enter receptionist's first name">

            <label for="last-name">Receptionist's Last Name: (REQUIRED)</label>
            <input type="text" id="last-name" name="last-name" placeholder = "Please enter receptionist's last name">

            <label for="phone">Receptionist's Phone Number: (REQUIRED)</label>
            <input type="text" id="phone" name="phone" placeholder = "Please enter your receptionist's phone number">
            
            <label for="password">Receptionist's Password: (REQUIRED)</label>
            <input type="password" id="password" name="password" placeholder = "Please enter your receptionist's password" >

            <label for="receptionist-id">Receptionist's ID: (REQUIRED)</label>
            <input type="text" id="receptionist-id" name="receptionist-id" placeholder = "Please enter receptionist's id">


            <label for="email-confirmation">Check Email Confirmation Below:</label>
            <input type="checkbox" id="email-confirmation" name="email-confirmation" onclick="toggleEmailInput()">
            <div id="email-container" style="display: none;">
            <label for="email">Receptionist's Email Address:</label>
            <input type="text" id="email" name="email" placeholder="Please enter your receptionist's email address">
            </div>

            <label for="transaction-type">Select a Transaction Type:</label>
            <select id="transaction-type" name="transaction-type">
                <option value="search-account">Search Account</option>
                <option value="book-appointment">Book Appointment</option>
                <option value="cancel-appointment">Cancel Appointment</option>
                <option value="request-procedure">Request Procedure</option>
                <option value="cancel-procedure">Cancel Procedure</option>
                <option value="update-info">Update Patient Information</option>
                <option value="create-account">Create New Patient Account</option>
            </select>

            <input type="submit" name = 'btnsubmit' id = 'btnsubmit' class = 'btnsubmit'></input>
            <input type="reset" id = 'reset' class = 'reset'></input>
        </form>
    </div>
    </body>
</html>