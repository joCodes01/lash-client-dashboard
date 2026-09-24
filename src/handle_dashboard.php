<?php
$_SESSION['clientName'] ?? null;
$_SESSION['addNewClient'] ?? null;

//reset the last used variables 
$_SESSION['lastused_stronghold'] = null;
$_SESSION['lastused_stronghold_appDate'] = null;
$_SESSION['lastused_rapidbond'] = null;
$_SESSION['lastused_rapidbond_appDate'] = null;
$_SESSION['lastused_elleliftadhesive'] = null;
$_SESSION['lastused_elleliftadhesive_appDate'] = null;
$_SESSION['lastused_blremover'] = null;
$_SESSION['lastused_blremover_appDate'] = null;

$glue_strongHold = "My Lash Store - Strong Hold";
$glue_rapidBond = "Lash Store HQ - Rapid Bond";
$glue_elleLiftAdhesive = "Elleebana - Lash lift adhesive";
$remover_BL = "BL lashes cream remover";



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
    //VIEW CLIENT RECORD
            if($_POST['action'] == 'viewRecord') {


              //CHECK LAST USED DATES
                include 'src/dbconnect.php';
            // ADHESIVE
            //  Strong hold
                $stmt = $conn->prepare("SELECT * FROM appointments WHERE clientID = ? AND adhesive = ? ORDER BY appDate DESC LIMIT 1;");
                $stmt->bind_param('is', $_POST['clientID'], $glue_strongHold);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if($row) {
                    $_SESSION['lastused_stronghold'] = $row['adhesive'];
                    $_SESSION['lastused_stronghold_appDate'] = $row['appDate'];
                }

                // Rapid bond 
                $stmt = $conn->prepare("SELECT * FROM appointments WHERE clientID = ? AND adhesive = ? ORDER BY appDate DESC LIMIT 1;");
                $stmt->bind_param('is', $_POST['clientID'], $glue_rapidBond);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if($row) {
                    $_SESSION['lastused_rapidbond'] = $row['adhesive'];
                    $_SESSION['lastused_rapidbond_appDate'] = $row['appDate'];
                }
                // Ellebana lift adhesive 
                $stmt = $conn->prepare("SELECT * FROM appointments WHERE clientID = ? AND adhesive = ? ORDER BY appDate DESC LIMIT 1;");
                $stmt->bind_param('is', $_POST['clientID'], $glue_elleLiftAdhesive);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if($row) {
                    $_SESSION['lastused_elleliftadhesive'] = $row['adhesive'];
                    $_SESSION['lastused_elleliftadhesive_appDate'] = $row['appDate'];
                }
                //REMOVER
                // BL lashes cream remover
                $stmt = $conn->prepare("SELECT * FROM appointments WHERE clientID = ? AND remover = ? ORDER BY appDate DESC LIMIT 1;");
                $stmt->bind_param('is', $_POST['clientID'], $remover_BL);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if($row) {
                    $_SESSION['lastused_blremover'] = $row['adhesive'];
                    $_SESSION['lastused_blremover_appDate'] = $row['appDate'];
                }

               

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