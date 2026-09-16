<?php
$_SESSION['clientName'] ?? null;
$_SESSION['addNewClient'] ?? null;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if(isset($_POST['formID'])){
        //if the form submitted is the view appointment form then send to clientrecord.php
        if($_POST['formID'] == 'viewApp') {
            $_SESSION['appID'] = $_POST['appID'];
            $_SESSION['clientID'] = $_POST['clientID'];
            header( 'Location: appointment.php');
            exit;
        }
        //if the form submitted is the client item form then do these checks
        if($_POST['formID'] == 'clientItemForm') {
            //set the session client ID
            $_SESSION['clientID'] = $_POST['clientID'];

            if($_POST['action'] == 'viewRecord') {
                header( "Location: clientrecord.php " );
                exit;
            }
            if($_POST['action'] == 'viewApps') {
                include 'src/dbconnect.php';
                $stmt = $conn->prepare("SELECT * FROM clients WHERE clientID = ? ORDER BY firstName ASC");
                $stmt->bind_param('i', $_SESSION['clientID']);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $_SESSION['clientName'] = $row['firstName'] . " " . $row['lastName'];
            }
        }
        if($_POST['formID'] == 'clientNewApp') {
        $_SESSION['clientID'] = $_POST['clientID'];
        $_SESSION['addNewClient'] = '';
        header('Location: appointment.php');
        exit;
        }
        if($_POST['formID'] == 'showAllApps') {
            $_SESSION['clientID'] = 'allClients';
            $_SESSION['clientName'] = "All clients";
        }
        if($_POST['formID'] == 'addNewClient') {
            $_SESSION['clientID'] = "";
            $_SESSION['appID'] = "";
            $_SESSION['addNewClient'] = "addNewClient";
            header( "Location: clientrecord.php");
            exit;
        } 
    }
    if(isset($_GET['resetAppID'])) {
        $_SESSION['appID'] = '00';
    }
}
?>