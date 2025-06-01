<?php
require_once("connectionProj4.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['procedure_id'])) {
    $procedureID = $_GET['procedure_id'];

    $deleteQuery = "DELETE FROM Procedures WHERE ProcedureID = '$procedureID'";
    $conn->query($deleteQuery);

    header("Location: homepage.php");
    exit();
} else {
    header("Location: cancel_procedure.php");
    exit();
}
?>