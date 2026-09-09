<?php
//set client ID in session variable
$_SESSION['clientID'] ?? null;
$_SESSION['appID'] ?? null;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //if the form submitted is the client form then do these checks
    if(isset($_POST['formID'])){

        if($_POST['formID'] == 'appList') {
          
                $_SESSION['appID'] = $_POST['appID'];
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
            }
            //if the form is set to Update then update the existing record
            if($_POST['CRUDclient'] == 'UPDATE') {

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
//APPOINTMENT FORM

         //if the form submitted is the appointment form then do these checks
        if($_POST['formID'] == 'appForm') {

            $message = "appointment form submitted";
            echo "<script>alert(" .  json_encode($message) . ")</script>";

            if(isset($_POST['appClientID'])){
                $appClientID = $_POST['appClientID'];
            }
            if(isset($_POST['appID'])){
                $appID = $_POST['appID'];
            }
            if(isset($_POST['CRUDapp'])){
                $CRUDapp = $_POST['CRUDapp'];
            }
            if(isset($_POST['appType'])){
                $appType = $_POST['appType'];
            }
            if(isset($_POST['cost'])){
                $cost = $_POST['cost'];
            }
            if(isset($_POST['appDate'])){
                $appDate = $_POST['appDate'];
            }
            if(isset($_POST['appTime'])){
                $appTime = $_POST['appTime'];
            }
            if(isset($_POST['duration'])){
                $duration = $_POST['duration'];
            }
            if(isset($_POST['lashLength'])){
                $lashLength = $_POST['lashLength'];
            }
            if(isset($_POST['lashBrand'])){
                $lashBrand = $_POST['lashBrand'];
            }
            if(isset($_POST['lashWidth'])){
                $lashWidth = $_POST['lashWidth'];
            }
            if(isset($_POST['lashCurl'])){
                $lashCurl = $_POST['lashCurl'];
            }
            if(isset($_POST['adhesive'])){
                $adhesive = $_POST['adhesive'];
            }
            if(isset($_POST['remover'])){
                $remover = $_POST['remover'];
            }
            if(isset($_POST['tint'])){
                $tint = $_POST['tint'];
            }
            if(isset($_POST['lift'])){
                $lift = $_POST['lift'];
            }
            if(isset($_POST['appNotes'])){
                $appNotes = $_POST['appNotes'];
            }


            //image upload
            //make a date string to re-name uploaded images
            $date = new DateTime(); 
            $dateString = date_format($date, 'Y-m-d_H-i-s');
            
            //UPLOAD BEFORE PHOTO
            if(isset($_FILES['beforePhoto']) && $_FILES["beforePhoto"]["error"] === UPLOAD_ERR_OK) {

                // $message = "image is uploaded";
                // echo "<script>alert(" .  json_encode($message) . ")</script>";
                
                //upload image   
                $targetDir = "photos/";
                $targetFile = $targetDir . basename($_FILES["beforePhoto"]["name"]);
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                //rename the uploaded file to a date string
                $targetFileRename = $targetDir . $dateString . "_before" . "." . $imageFileType;
                //set the image file name for upload to DB
                $beforePhoto = $dateString . "_before" . "." . $imageFileType;

                $uploadOk = TRUE;

                // echo "<br>" . "image file type is" . $imageFileType . "<br>";
                // echo $targetFileRename;
          
                //check if the file is an image
                $checkimage = getimagesize($_FILES["beforePhoto"]["tmp_name"]);

                if ($checkimage === false) {

                    $message = "Sorry this file is not an image.";
                    echo "<script>alert(" .  json_encode($message) . ")</script>";

                    $uploadOk = FALSE;
                }

                //check file size does not exceed 5MB
                if ($_FILES["beforePhoto"]["size"] > 5000000) {
                    
                    $message = "File is too large. 5MB allowed.";
                    echo "<script>alert(" .  json_encode($message) . ")</script>";

                    $uploadOk = FALSE;
                }

                //check file type is JPG, JPEG, PNG, or GIF
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {

                    $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    echo "<script>alert(" .  json_encode($message) . ")</script>";

                    $uploadOk = FALSE;
                }

                //ADD CLIENT ID TO THE FILE NAME

                if ($uploadOk) {
                    move_uploaded_file($_FILES["beforePhoto"]["tmp_name"], $targetFileRename);

                    //connect to the database
                    include "src/dbconnect.php";
                }
            } else {
                //if no file is uploaded then default to placeholder.jpg
                if(!empty($approw['beforePhoto'])) {
                    $beforePhoto = $approw['beforePhoto'];
                } else {
                    $beforePhoto = "placeholder.jpg";
                }
            }

            //UPLOAD AFTER PHOTO
            if(isset($_FILES['afterPhoto']) && $_FILES["afterPhoto"]["error"] === UPLOAD_ERR_OK) {

                // $message = "image is uploaded.";
                // echo "<script>alert(" .  json_encode($message) . ")</script>";

                //upload image   
                $targetDir = "photos/";
                $targetFile = $targetDir . basename($_FILES["afterPhoto"]["name"]);
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                //rename the uploaded file to a date string
                $targetFileRename = $targetDir . $dateString . "_after" . "." . $imageFileType;
                //set the image file name
                $afterPhoto = $dateString . "_after" . "." . $imageFileType;

                $uploadOk = TRUE;

                // echo "<br>" . "image file type is" . $imageFileType . "<br>";
                // echo $targetFileRename;
          
                //check if the file is an image
                $checkimage = getimagesize($_FILES["afterPhoto"]["tmp_name"]);

                if ($checkimage === false) {

                    $message = "Sorry this file is not an image.";
                    echo "<script>alert(" .  json_encode($message) . ")</script>";
                    
                    $uploadOk = FALSE;
                }

                //check file size does not exceed 5MB
                if ($_FILES["afterPhoto"]["size"] > 5000000) {

                    $message = "File is too large. 5MB allowed.";
                    echo "<script>alert(" .  json_encode($message) . ")</script>";

                    $uploadOk = FALSE;
                }

                //check file type is JPG, JPEG, PNG, or GIF
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {

                    $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    echo "<script>alert(" .  json_encode($message) . ")</script>";

                    $uploadOk = FALSE;
                }

                //ADD CLIENT ID TO THE FILE NAME
                if ($uploadOk) {
                    
                    move_uploaded_file($_FILES["afterPhoto"]["tmp_name"], $targetFileRename);
                    

                    //connect to the database
                    include "src/dbconnect.php";
                }
            }else {
                //if no file is uploaded then default to placeholder.jpg
                // $afterPhoto = "placeholder.jpg";

                   if(!empty($approw['afterPhoto'])) {
                    $afterPhoto = $approw['afterPhoto'];
                } else {
                    $afterPhoto = "placeholder.jpg";
                }  
            }

            if($_POST['CRUDapp'] == 'CREATE') {

                //connect to the database
                include 'src/dbconnect.php';

                //check if a record exists with the client ID on this date
                // $result = $conn->query("SELECT clientID FROM appointments WHERE clientID = '$appClientID' AND appDate = '$appDate'");
                $stmt = $conn->prepare("SELECT clientID FROM appointments WHERE clientID = ? AND appDate = ?");
                $stmt->bind_param('is', $appClientID, $appDate );
                $stmt->execute();
                $result = $stmt->get_result();

                //if the record exists echo error message
                if($result->num_rows > 0){
            
                    $message = "sorry an appointment for this date already exists for client ID: " . htmlspecialchars($appClientID);
                    echo "<script>alert(" .  json_encode($message) . ")</script>";
                }else {

                //Select all appointments with the clientID from the database
                //check if there is an appointment with this clientID on the same date?
                //if there is then echo sorry, appointment already exists for this client on this date
                
                    //else: create a new appointment.
                    $stmt = $conn->prepare("INSERT INTO appointments (
                        clientID,
                        appType, 
                        cost, 
                        appDate, 
                        appTime, 
                        duration, 
                        lashLength, 
                        lashBrand, 
                        lashWidth, 
                        lashCurl, 
                        adhesive, 
                        remover, 
                        tint, 
                        lift, 
                        appNotes,
                        beforePhoto,
                        afterPhoto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                    $stmt->bind_param("issssssssssssssss", 
                        $appClientID,
                        $appType,    
                        $cost, 
                        $appDate, 
                        $appTime, 
                        $duration, 
                        $lashLength, 
                        $lashBrand, 
                        $lashWidth, 
                        $lashCurl, 
                        $adhesive,
                        $remover,
                        $tint,
                        $lift,
                        $appNotes,
                        $beforePhoto,
                        $afterPhoto); 

                    $stmt->execute();
                    $stmt->close();
                }
            }

            if($_POST['CRUDapp'] == 'UPDATE') {

                include 'src/dbconnect.php';
                $stmt = $conn->prepare("UPDATE appointments SET 
                    appType = ?, 
                    cost = ?, 
                    appDate = ?, 
                    appTime = ?, 
                    duration = ?, 
                    lashLength = ?, 
                    lashBrand = ?, 
                    lashWidth = ?, 
                    lashCurl = ?, 
                    adhesive = ?, 
                    remover = ?, 
                    tint = ?, 
                    lift = ?, 
                    appNotes = ?, 
                    beforePhoto = ?, 
                    afterPhoto = ?
                WHERE appID = ?");

                $stmt->bind_param("ssssssssssssssssi",
                    $appType,
                    $cost,
                    $appDate,
                    $appTime,
                    $duration,
                    $lashLength,
                    $lashBrand,
                    $lashWidth,
                    $lashCurl,
                    $adhesive,
                    $remover,
                    $tint,
                    $lift,
                    $appNotes,
                    $beforePhoto,
                    $afterPhoto,
                    $appID   
                );

                $stmt->execute();
                $stmt->close();
            }


                //if client form is set to DELETE then delete the record based on clientID in the form.
               if($_POST['CRUDapp'] == 'DELETE') {

                //connect to the database
                include 'src/dbconnect.php';
                $stmt = $conn->prepare("DELETE FROM appointments WHERE appID = ?;");
                $stmt->bind_param("i", $appID);
                $stmt->execute();
                $stmt->close();
               }
               $_SESSION['appID'] = '00';
               header('Location: clientrecord.php');
        }
    }
}

include 'src/dbconnect.php';
$client = $_SESSION['clientID'];

$stmt = $conn->prepare("SELECT * FROM clients WHERE clientID = ? ");
$stmt->bind_param('i', $client);
$stmt->execute();
$result = $stmt->get_result();


if($result->num_rows > 0) {
    // echo "client found";
    $row = $result->fetch_assoc();

}else {
    $row['firstName'] = "";
    $row['lastName'] = "";
    $row['age'] = "";
    $row['email'] = "";
    $row['phoneNumber'] = "";
    $row['contactLenses'] = "";
    $row['medicalConditions'] = "";
    $row['allergies'] = "";
    $row['medication'] = "";
    $row['adhesivePatchTest'] = "";
    $row['removerPatchTest'] = "";
    $row['tintPatchTest'] = "";
    $row['liftPatchTest'] = "";
    $row['clientNotes'] = "";
}
$conn->close();

include 'src/dbconnect.php';
$appID = $_SESSION['appID'] ?? "";

$stmt = $conn->prepare("SELECT * FROM appointments WHERE appID = ? ");
$stmt->bind_param('i', $appID);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0) {
    // echo "appointment found";
    $approw = $result->fetch_assoc();
}else {
    $approw['appClientID'] = "";
    $approw['appType'] = "";
    $approw['cost'] = "";
    $approw['appDate'] = "";
    $approw['appTime'] = "";
    $approw['duration'] = "";
    $approw['lashLength'] = "";
    $approw['lashBrand'] = "";
    $approw['lashWidth'] = "";
    $approw['lashCurl'] = "";
    $approw['adhesive'] = "";
    $approw['remover'] = "";
    $approw['tint'] = "";
    $approw['lift'] = "";
    $approw['appNotes'] = "";
    $approw['beforePhoto'] = "";
    $approw['afterPhoto'] = "";
}
$conn->close();
?>