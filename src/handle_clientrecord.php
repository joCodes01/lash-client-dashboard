<?php

//set client ID in session variable
$_SESSION['clientID'] ?? null;
$_SESSION['appID'] ?? null;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //if the form submitted is the client form then do these checks
    if(isset($_POST['formID'])){

        if($_POST['formID'] == 'appList') {
            $_SESSION['appID'] = $_POST['appID'];

            header('Location: appointment.php');
        }
        if($_POST['formID'] == 'clientNewRecordApp') {
            // $_SESSION['clientID'] = $_POST['clientID'];
            $_SESSION['addNewClient'] = '';
            header('Location: appointment.php');
            exit;
        }
        if($_POST['formID'] == 'clientForm') {
            
            $message = "client form submitted";
            echo "<script>alert(" .  json_encode($message) . ")</script>";

            if(isset($_POST['clientID'])){
                $clientID = $_POST['clientID'];
                
                //set the clientID to a session variable
                $_SESSION['clientID'] = $clientID;
            }
            if(isset($_POST['CRUDclient'])){
                $CRUDclient = $_POST['CRUDclient'];
            }
            if(isset($_POST['firstName'])){
                $firstName = $_POST['firstName'];
            }
            if(isset($_POST['lastName'])){
                $lastName = $_POST['lastName'];
            }
            if(isset($_POST['age'])){
                $age = $_POST['age'];
            }
            if(isset($_POST['email'])){
                $email = $_POST['email'];
            }
            if(isset($_POST['phoneNumber'])){
                $phoneNumber = $_POST['phoneNumber'];
            }
            if(isset($_POST['contactLenses'])){
                $contactLenses = $_POST['contactLenses'];
            }
            if(isset($_POST['medicalConditions'])){
                $medicalConditions = $_POST['medicalConditions'];
            }
            if(isset($_POST['allergies'])){
                $allergies = $_POST['allergies'];
            }
            if(isset($_POST['medication'])){
                $medication = $_POST['medication'];
            }
            if(isset($_POST['adhesivePatchTest'])){
                $adhesivePatchTest = $_POST['adhesivePatchTest'];
            }
            if(isset($_POST['removerPatchTest'])){
                $removerPatchTest = $_POST['removerPatchTest'];
            }
            if(isset($_POST['tintPatchTest'])){
                $tintPatchTest = $_POST['tintPatchTest'];
            }
            if(isset($_POST['liftPatchTest'])){
                $liftPatchTest = $_POST['liftPatchTest'];
            }
            if(isset($_POST['clientNotes'])){
                $clientNotes = $_POST['clientNotes'];

            }
         
            //if the form is set to CREATE then create a new record
            if($_POST['CRUDclient'] == 'CREATE') {

                //connect to the database
                include 'src/dbconnect.php';
                
                //check client does not exist before creating client again!
                $stmt = $conn->prepare("SELECT clientID FROM clients WHERE firstName = ? AND lastName = ? ;");
                $stmt->bind_param('ss', $firstName, $lastName);
                $stmt->execute();
                $result = $stmt->get_result();

                if($result->num_rows > 0){

                    $message = "Client already exists, record not created.";

                    echo "<script>alert(" .  json_encode($message) . ")</script>";


                //if client record does not already exist then create client record
                //do not add client ID as it will be auto incremented when the record is created.
                }else{
                    $stmt = $conn->prepare("INSERT INTO clients (
                        firstName, 
                        lastName, 
                        age, 
                        email, 
                        phoneNumber, 
                        contactLenses, 
                        medicalConditions, 
                        allergies, 
                        medication,
                        adhesivePatchTest,
                        removerPatchTest,
                        tintPatchTest,
                        liftPatchTest,
                        clientNotes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                
                    $stmt->bind_param("ssssssssssssss", 
                        $firstName, 
                        $lastName, 
                        $age, 
                        $email, 
                        $phoneNumber, 
                        $contactLenses,
                        $medicalConditions,
                        $allergies,
                        $medication,
                        $adhesivePatchTest,
                        $removerPatchTest,
                        $tintPatchTest,
                        $liftPatchTest,
                        $clientNotes);
                    $stmt->execute();
                    $stmt->close();
                } 
                header('Location: dashboard.php');
                exit;
            }
            //if the form is set to Update then update the existing record
            if($_POST['CRUDclient'] == 'UPDATE') {

                if($_SESSION['appID'] == '00') {
                    header('Location: clientrecord.php');
                }

                //connect to the database
                include 'src/dbconnect.php';
              
                $stmt = $conn->prepare("UPDATE clients SET 
                    firstName = ?, 
                    lastName = ?, 
                    age = ?, 
                    email = ?, 
                    phoneNumber = ?,
                    contactLenses = ?,
                    medicalConditions = ?,
                    allergies = ?, 
                    medication = ?,
                    adhesivePatchTest = ?,
                    removerPatchTest = ?,
                    tintPatchTest = ?,
                    liftPatchTest = ?,
                    clientNotes = ? WHERE clientID = ?;");

                $stmt->bind_param("ssssssssssssssi", 
                    $firstName, 
                    $lastName,        
                    $age, 
                    $email, 
                    $phoneNumber,    
                    $contactLenses,
                    $medicalConditions,
                    $allergies,
                    $medication,
                    $adhesivePatchTest,
                    $removerPatchTest,
                    $tintPatchTest,
                    $liftPatchTest,
                    $clientNotes,
                    $clientID);
               
                    $stmt->execute();
                    $stmt->close();
            }
                //if client form is set to DELETE then delete the record based on clientID in the form.
            if($_POST['CRUDclient'] == 'DELETE') {

            //connect to the database
            include 'src/dbconnect.php';

            $stmt = $conn->prepare("DELETE FROM clients WHERE clientID = ?;");
            $stmt->bind_param("i", $clientID);
            $stmt->execute();
            $stmt->close();
            }
            $_SESSION['appID'] = '00';
            header('Location: clientrecord.php');
        }
    }
}


?>