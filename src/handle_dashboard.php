<?php
$_SESSION['clientName'] ?? null;
$_SESSION['addNewClient'] ?? null;

//reset the last used variables 
$_SESSION['lastused_stronghold'] = null;
$_SESSION['lastused_stronghold_appDate'] = null;
$_SESSION['lastused_stronghold_timepassed'] = null;
$_SESSION['lastused_rapidbond'] = null;
$_SESSION['lastused_rapidbond_appDate'] = null;
$_SESSION['rapidbond_timepassed'] = null;
$_SESSION['lastused_elleliftadhesive'] = null;
$_SESSION['lastused_elleliftadhesive_appDate'] = null;
$_SESSION['elleliftadhesive_timepassed'] = null;
$_SESSION['lastused_blremover'] = null;
$_SESSION['lastused_blremover_appDate'] = null;
$_SESSION['blremover_timepassed'] = null;
$_SESSION['lastused_lashvremover'] = null;
$_SESSION['lastused_lashvremover_appDate'] = null;
$_SESSION['lashvremover_timepassed'] = null;
$_SESSION['lastused_LSHQjellyremover'] = null;
$_SESSION['lastused_LSHQjellyremover_appDate'] = null;
$_SESSION['LSHQjellyremover_timepassed'] = null;
$_SESSION['lastused_envolashremover'] = null;
$_SESSION['lastused_envolashremover_appDate'] = null;
$_SESSION['envolashremover_timepassed'] = null;
$_SESSION['lastused_mlsremover'] = null;
$_SESSION['lastused_mlsremover_appDate'] = null;
$_SESSION['mlsremover_timepassed'] = null;
$_SESSION['lastused_refectocil'] = null;
$_SESSION['lastused_refectocil_appDate'] = null;
$_SESSION['refectocil_timepassed'] = null;
$_SESSION['lastused_elleplex'] = null;
$_SESSION['lastused_elleplex_appDate'] = null;
$_SESSION['elleplex_timepassed'] = null;
$_SESSION['lastused_profusion'] = $row['appDate'] = null;
$_SESSION['lastused_profusion_appDate'] = $row['appDate'] = null;
$_SESSION['profusion_timepassed'] = null;
$_SESSION['lastused_appDate'] = $row['appDate'] = null;
$_SESSION['lastused_totalcare'] = $row['appDate'] = null;
$_SESSION['lastused_totalcare_appDate'] = $row['appDate'] = null;
$_SESSION['totalcare_timepassed'] = null;

$glue_strongHold = "My Lash Store - Strong Hold";
$glue_rapidBond = "Lash Store HQ - Rapid Bond";
$glue_elleLiftAdhesive = "Elleebana - Lash lift adhesive";
$remover_BL = "BL lashes cream remover";
$remover_lashv = "Lash V - Professional eyelash adhesive remover";
$remover_LSHQjelly = "Lash store HQ - Lash Reset, jelly remover";
$remover_envolash = "EnvoLash - cream remover";
$remover_MLS = "My Lash Store - Eyelash Extension Remover Cream";
$tint_refectocil = "%Refectocil%";
$tint_elleplex = "%Elleplex%";
$lift_profusion = "Elleplex profusion";
$lift_MLS_totalcare = "My Lash Store - Total Care";

$now = new DateTime();



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
                    $stronghold_appDate = new DateTime($row['appDate']);
                    
                    $diff = $stronghold_appDate->diff($now);
                    $_SESSION['stronghold_timepassed'] = $diff->y . ' years, ' . $diff->m . ' months, '. $diff->d . ' days';
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
                    $rapidbond_appDate = new DateTime($row['appDate']);
                    
                    $diff = $rapidbond_appDate->diff($now);
                    $_SESSION['rapidbond_timepassed'] = $diff->y . ' years, ' . $diff->m . ' months, '. $diff->d . ' days';
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
                    $elleliftadhesive_appDate = new DateTime($row['appDate']);
                    
                    $diff = $elleliftadhesive_appDate->diff($now);
                    $_SESSION['elleliftadhesive_timepassed'] = $diff->y . ' years, ' . $diff->m . ' months, '. $diff->d . ' days';
                }
                //REMOVER
                // BL lashes cream remover
                $stmt = $conn->prepare("SELECT * FROM appointments WHERE clientID = ? AND remover = ? ORDER BY appDate DESC LIMIT 1;");
                $stmt->bind_param('is', $_POST['clientID'], $remover_BL);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if($row) {
                    $_SESSION['lastused_blremover'] = $row['remover'];
                    $_SESSION['lastused_blremover_appDate'] = $row['appDate'];
                    $blremover_appDate = new DateTime($row['appDate']);
                    
                    $diff = $blremover_appDate->diff($now);
                    $_SESSION['blremover_timepassed'] = $diff->y . ' years, ' . $diff->m . ' months, '. $diff->d . ' days';
                }
                //lash V
                $stmt = $conn->prepare("SELECT * FROM appointments WHERE clientID = ? AND remover = ? ORDER BY appDate DESC LIMIT 1;");
                $stmt->bind_param('is', $_POST['clientID'], $remover_lashv);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if($row) {
                    $_SESSION['lastused_lashvremover'] = $row['remover'];
                    $_SESSION['lastused_lashvremover_appDate'] = $row['appDate'];
                    $lashvremover_appDate = new DateTime($row['appDate']);
                    
                    $diff = $lashvremover_appDate->diff($now);
                    $_SESSION['lashvremover_timepassed'] = $diff->y . ' years, ' . $diff->m . ' months, '. $diff->d . ' days';
                }
                //lash store HQ jelly
                $stmt = $conn->prepare("SELECT * FROM appointments WHERE clientID = ? AND remover = ? ORDER BY appDate DESC LIMIT 1;");
                $stmt->bind_param('is', $_POST['clientID'], $remover_LSHQjelly);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if($row) {
                    $_SESSION['lastused_LSHQjellyremover'] = $row['remover'];
                    $_SESSION['lastused_LSHQjellyremover_appDate'] = $row['appDate'];
                    $LSHQjellyremover_appDate = new DateTime($row['appDate']);
                    
                    $diff = $LSHQjellyremover_appDate->diff($now);
                    $_SESSION['LSHQjellyremover_timepassed'] = $diff->y . ' years, ' . $diff->m . ' months, '. $diff->d . ' days';
                }
                //Envolash
                $stmt = $conn->prepare("SELECT * FROM appointments WHERE clientID = ? AND remover = ? ORDER BY appDate DESC LIMIT 1;");
                $stmt->bind_param('is', $_POST['clientID'], $remover_envolash);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if($row) {
                    $_SESSION['lastused_envolashremover'] = $row['remover'];
                    $_SESSION['lastused_envolashremover_appDate'] = $row['appDate'];
                    $envolashremover_appDate = new DateTime($row['appDate']);
                    
                    $diff = $envolashremover_appDate->diff($now);
                    $_SESSION['envolashremover_timepassed'] = $diff->y . ' years, ' . $diff->m . ' months, '. $diff->d . ' days';
                }
                 //MyLashStore
                $stmt = $conn->prepare("SELECT * FROM appointments WHERE clientID = ? AND remover = ? ORDER BY appDate DESC LIMIT 1;");
                $stmt->bind_param('is', $_POST['clientID'], $remover_MLS);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if($row) {
                    $_SESSION['lastused_mlsremover'] = $row['remover'];
                    $_SESSION['lastused_mlsremover_appDate'] = $row['appDate'];
                    $mlsremover_appDate = new DateTime($row['appDate']);
                    
                    $diff = $mlsremover_appDate->diff($now);
                    $_SESSION['mlsremover_timepassed'] = $diff->y . ' years, ' . $diff->m . ' months, '. $diff->d . ' days';
                }
                //TINT
                //refectocil
                $stmt = $conn->prepare("SELECT * FROM appointments WHERE clientID = ? AND tint LIKE ? ORDER BY appDate DESC LIMIT 1;");
                $stmt->bind_param('is', $_POST['clientID'], $tint_refectocil);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if($row) {
                    $_SESSION['lastused_refectocil'] = $row['tint'];
                    $_SESSION['lastused_refectocil_appDate'] = $row['appDate'];
                    $refectocil_appDate = new DateTime($row['appDate']);
                    
                    $diff = $refectocil_appDate->diff($now);
                    $_SESSION['refectocil_timepassed'] = $diff->y . ' years, ' . $diff->m . ' months, '. $diff->d . ' days';
                }
                // elleplex tint
                $stmt = $conn->prepare("SELECT * FROM appointments WHERE clientID = ? AND tint LIKE ? ORDER BY appDate DESC LIMIT 1;");
                $stmt->bind_param('is', $_POST['clientID'], $tint_elleplex);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if($row) {
                    $_SESSION['lastused_elleplex'] = $row['tint'];
                    $_SESSION['lastused_elleplex_appDate'] = $row['appDate'];
                    $elleplex_appDate = new DateTime($row['appDate']);
                    
                    $diff = $elleplex_appDate->diff($now);
                    $_SESSION['elleplex_timepassed'] = $diff->y . ' years, ' . $diff->m . ' months, '. $diff->d . ' days';
                }
                //LIFT
                //elleplex profusion
                $stmt = $conn->prepare("SELECT * FROM appointments WHERE clientID = ? AND lift = ? ORDER BY appDate DESC LIMIT 1;");
                $stmt->bind_param('is', $_POST['clientID'], $lift_profusion);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if($row) {
                    $_SESSION['lastused_profusion'] = $row['lift'];
                    $_SESSION['lastused_profusion_appDate'] = $row['appDate'];
                    $profusion_appDate = new DateTime($row['appDate']);
                    
                    $diff = $profusion_appDate->diff($now);
                    $_SESSION['profusion_timepassed'] = $diff->y . ' years, ' . $diff->m . ' months, '. $diff->d . ' days';
                }
                // My Lash Store Total care
                $stmt = $conn->prepare("SELECT * FROM appointments WHERE clientID = ? AND lift = ? ORDER BY appDate DESC LIMIT 1;");
                $stmt->bind_param('is', $_POST['clientID'], $lift_MLS_totalcare);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if($row) {
                    $_SESSION['lastused_totalcare'] = $row['lift'];
                    $_SESSION['lastused_totalcare_appDate'] = $row['appDate'];
                    $totalcare_appDate = new DateTime($row['appDate']);
                    
                    $diff = $totalcare_appDate->diff($now);
                    $_SESSION['totalcare_timepassed'] = $diff->y . ' years, ' . $diff->m . ' months, '. $diff->d . ' days';
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