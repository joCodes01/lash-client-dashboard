<?php 
session_start();
include 'src/handle_session_login.php';

include 'src/handle_clientrecord.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="src/script.js" defer></script>
        <script src="src/handleAddNewClient.js" defer></script>
        <link rel="stylesheet" href="style.css">
        <title>Client Record</title>
    </head>
    <body>
        <header class="nav-container">
            <a href="dashboard.php"><img class="nav-logo" src="images/logo.png" alt=""></a>
            <nav>
                <ul class="navlist">
                    <li><a class="back-link" href="dashboard.php?resetAppID=1">Dashboard</a></li>
                    <li><a href="src/handle_logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <!-- <h1>Client Record</h1> -->
            <div class="client-record-container">
                <div class="form-container">
                    <form method="POST" action="" id="clientForm" class="CRUD-form">
                        <!-- FORM ID  hidden   -->
                        <input type="hidden" name="formID" id="clientForm" value="clientForm">
                        <label hidden for="clientID">Client ID: </label>
                        <select hidden name="clientID">
                            <option value="<?= htmlspecialchars($_SESSION['clientID']); ?>"> <?= htmlspecialchars($_SESSION['clientID']); ?> </option>
                            <option value="1">1</option>
                            <option value="3">3</option>
                            <option value="New client">New client</option>
                        </select>
                        <div class="client-name-section">
                            <h2><?= htmlspecialchars($row['firstName']) . " " . htmlspecialchars($row['lastName']) ?></h2>
                            <div>
                            <?php
                            if (($_SESSION['addNewClient'] ?? '') == "addNewClient") {
                                echo '<select name="CRUDclient" id="CRUDclient">
                                        <option selected value="CREATE">Create new client record</option>
                                        <option value="UPDATE">Update client record</option>
                                        <option value="DELETE">Delete client record</option>
                                    </select>';
                                }else {
                                    echo '<select name="CRUDclient" id="CRUDclient">
                                        <option selected value="UPDATE">Update client record</option>
                                        <option value="CREATE">Create new client record</option>
                                        <option value="DELETE">Delete client record</option>
                                    </select>';
                                }
                                ?>
                            </div>
                        </div>
                        
                        <div class="client-record-inner-container">
                            
                            <div>
                                <div>
                                    <label for="firstName">First name</label>
                                    <input type="text" name="firstName" id="firstName" value="<?= htmlspecialchars($row['firstName']) ?>">
                                </div>
                                <div>
                                    <label for="lastName">Last name</label>
                                    <input type="text" name="lastName" id="lastName" value="<?= htmlspecialchars($row['lastName']) ?>">
                                </div>
                                <div>
                                    <label for="age">Age</label>
                                      <select name="age" id="age" value="<?= htmlspecialchars($row['age']) ?>">
                                        <option value="<?=htmlspecialchars($row['age']) ? htmlspecialchars($row['age']) : "choose option"?>" selected><?=htmlspecialchars($row['age']) ? htmlspecialchars($row['age']) : "choose option"?></option>

                                        <option value="Over 18">Over 18</option>
                                        <option value="Under 18 - no parental consent yet">Under 18 - no parental consent yet</option>
                                        <option value="Under 18 - parental consent given">Under 18 - parental consent given</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="email">E-mail</label>
                                    <input type="email" name="email" id="email" value="<?= htmlspecialchars($row['email']) ?>">
                                </div>
                                <div>
                                    <label for="phoneNumber">Phone number</label>
                                    <input type="text" name="phoneNumber" id="phoneNumber" value="<?= htmlspecialchars($row['phoneNumber']) ?>">
                                </div>
                            </div>
                            <div>
                                <h2>Considerations</h2>
                                <div>
                                    <label for="contactLenses">Contact lenses</label>
                                    <select name="contactLenses" id="contactLenses" value="<?= htmlspecialchars($row['contactLenses']) ?>">
                                        <option value="<?=htmlspecialchars($row['contactLenses']) ? htmlspecialchars($row['contactLenses']) : ""?>" selected>
                                        <?=htmlspecialchars($row['contactLenses']) ? htmlspecialchars($row['contactLenses']) : "choose option" ?>
                                        </option>
                                        <option>Wears contact lenses</option>
                                        <option>Does not wear contact lenses</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="allergies">Allergies</label>
                                    <input type="text" name="allergies" id="allergies" value="<?= htmlspecialchars($row['allergies']) ?>">
                                </div>
                                <div>
                                    <label for="medication">Medication</label>
                                    <input type="text" name="medication" id="medication" value="<?= htmlspecialchars($row['medication']) ?>">
                                </div>
                            </div>
                            <div>
                                <h2>Patch test</h2>
                                <div>
                                    <label for="adhesivePatchTest">Adhesive</label>
                                    <input type="text" name="adhesivePatchTest" id="adhesivePatchTest" value="<?=htmlspecialchars($row['adhesivePatchTest']) ?>">

        
                                </div>
                                <div>
                                    <label for="removerPatchTest">Remover</label>
                                    <input type="text" name="removerPatchTest" id="removerPatchTest" value="<?= htmlspecialchars($row['removerPatchTest']) ?>">
                                </div>
                                <div>
                                    <label for="tintPatchTest">Tint</label>
                                    <input type="text" name="tintPatchTest" id="tintPatchTest" value="<?= htmlspecialchars($row['tintPatchTest']) ?>">
                                </div>
                                <div>
                                    <label for="liftPatchTest">Lift</label>
                                    <input type="text" name="liftPatchTest" id="liftPatchTest" value="<?= htmlspecialchars($row['liftPatchTest']) ?>">
                                </div>
                            </div>
                             <div>
                                <div>
                                    <label for="medicalConditions">Medical conditions</label>
                                    <textarea class="textarea-large" name="medicalConditions" id="medicalConditions" value="<?= htmlspecialchars($row['medicalConditions']) ?>"></textarea>
                                </div>
                            </div>
                            <div>
                                <div class="client-notes-section">
                                    <label for="clientNotes">Client notes</label>
                                    <textarea class="textarea-large" name="clientNotes" id="clientNotes" value="<?= htmlspecialchars($row['clientNotes']) ?>"></textarea>
                                </div>
                            </div>
                            
                        </div>
                        <button type="submit">Submit</button>
                        
                    </form>
                </div>
                <div class="form-container appointment-form-container">
            


                    <form method="POST" action="" id="appForm" class="CRUD-form" enctype="multipart/form-data">
                            <div class="appointment-heading-container">
                                <h2>Appointment details</h2>
                                    <!-- FORM ID     -->
                                    <input type="hidden" name="formID" id="appForm" value="appForm">
                                    <label hidden for="appClientID">Client ID: </label>
                                    <input hidden type="text" name="appClientID" id="appClientID" value="<?= $_SESSION['clientID']; ?>">
                                    <label hidden for="appID">Appointment ID: </label>
                                    <input hidden type="text" name="appID" id="appID" value="<?= $_SESSION['appID'] ?? null; ?>">
                                    <p>Appointment ID: <?= $_SESSION['appID'] ?? null; ?></p>
                                    <select name="CRUDapp">
                                        <option value="CREATE">Create new appointment</option>
                                        <option value="UPDATE">Update appointment</option>
                                        <option value="DELETE">Delete appointment</option>
                                    </select>
                                    <div class="app-type-container">
                                        <label for="appType">Appointment type</label>
                                        <select name="appType" id="appType">
                                            <option value="<?=$approw['appType']?>" selected><?=$approw['appType']?></option>
                                            <option value="Lash extensions - classic full set">Lash extensions - classic full set</option>
                                            <option value="Lash extensions - hybrid">Lash extensions - hybrid</option>
                                            <option value="Lash extensions - light volume">Lash extensions - light volume</option>
                                            <option value="Lash extensions - classic - infills (up to 2 weeks)">Lash extensions - classic - infills (up to 2 weeks)</option>
                                            <option value="Lash extensions - classic - infills (up to 3 weeks)">Lash extensions - classic - infills (up to 3 weeks)</option>
                                            <option value="Lash extensions - hybrid - infills (up to 2 weeks)">Lash extensions - hybrid - infills (up to 2 weeks)</option>
                                            <option value="Lash extensions - hybrid - infills (up to 3 weeks)">Lash extensions - hybrid - infills (up to 3 weeks)</option>
                                            <option value="Lash extensions - light volume - infills (up to 2 weeks)">Lash extensions - light volume - infills (up to 2 weeks)</option>
                                            <option value="Lash extensions - light volume - infills (up to 3 weeks)">Lash extensions - light volume - infills (up to 3 weeks)</option>
                                            <option value="Lash extensions - removal">Lash extensions - removal</option>
                                            <option value="Lash lift & tint">Lash lift & tint</option>
                                            <option value="Lash lift">Lash lift</option>
                                            <option value="Lash tint">Lash tint</option>
                                            <option value="Lift reversal">Lift reversal</option>
                                            <option value="Consultation/patch test">Consultation/patch test</option>
                                            <option value="Parental consent record">Parental consent record</option>
                                            <option value="none">none</option>
                                        </select>
                                    </div>
                            </div>
                        <div class="appointment-details-container">
                            <div>
                                <div>
                                    <label for="cost">Cost</label>
                                    <input type="number" name="cost" id="cost" value="<?=htmlspecialchars($approw['cost'])?>">
                                </div>
                                <div>
                                    <label for="discount">Discount</label>
                                     <select name="discount" id="discount">
                                        <option value="<?= !empty($approw['discount']) ? htmlspecialchars($approw['discount']) : '' ?>" selected>
                                        <?= !empty($approw['discount']) ? htmlspecialchars($approw['discount']) : 'choose option' ?>
                                        </option>
                                        <option value="20% referral discount">20% referral discount</option>
                                        <option value="100% instagram model discount">100% instagram model discount</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="appDate">Date</label>
                                    <input type="date" name="appDate" id="appDate" value="<?=htmlspecialchars($approw['appDate'])?>">
                                </div>
                                <div>
                                    <label for="appTime">Time</label>
                                    <input type="time" name="appTime" id="appTime" value="<?=htmlspecialchars($approw['appTime'])?>">
                                </div>
                                <div>
                                    <label for="duration">Duration</label>
                                    <select name="duration" id="duration" >
                                        <option value="<?=htmlspecialchars($approw['duration'])?>" selected><?= ( $_SESSION[$appID] ?? '00') != '00' ? "choose option" : htmlspecialchars($approw['duration'])?></option>
                                        <option value="15 mins">15 mins</option>
                                        <option value="30 mins">30 mins</option>
                                        <option value="45 mins">45 mins</option>
                                        <option value="1 hour">1 hour</option>
                                        <option value="1 hour 15 mins">1 hour 15 mins</option>
                                        <option value="1 hour 30 mins">1 hour 30 mins</option>
                                        <option value="1 hour 45 mins">1 hour 45 mins</option>
                                        <option value="2 hours">2 hours</option>
                                        <option value="2 hours 15 mins">2 hours 15 mins</option>
                                        <option value="2 hours 30 mins">2 hours 30 mins</option>
                                        <option value="2 hours 45 mins">2 hours 45 mins</option>
                                        <option value="3 hours mins">3 hours mins</option>
                                        <option value="3 hours">3 hours</option>
                                        <option value="3 hours 30 mins">3 hours 30 mins</option>
                                        <option value="3 hours 45 mins">3 hours 45 mins</option>
                                        <option value="4 hours">4 hours</option>
                                        <option value="none">none</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                 <div>
                                    <label for="lashStyle">Style</label>
                                   <select name="lashStyle" id="lashStyle">
                                        <option value="<?= !empty($approw['lashStyle']) ? htmlspecialchars($approw['lashStyle']) : '' ?>" selected>
                                        <?= !empty($approw['lashStyle']) ? htmlspecialchars($approw['lashStyle']) : 'choose option' ?>
                                        </option>
                                        <option value="Natural">Natural</option>
                                        <option value="Kitten">Kitten</option>
                                        <option value="Cat eye">Cat eye</option>
                                        <option value="Open eye">Open eye</option>
                                        <option value="none">none</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="lashLength">Lash lengths</label>
                                    <input type="text" name="lashLength" id="lashLength" value="<?=htmlspecialchars($approw['lashLength'])?>"> 
                                </div>
                                <div>
                                    <label for="lashBrand">Lash brand</label>
                                    <select name="lashBrand" id="lashBrand">
                                        <option value="<?= !empty($approw['lashBrand']) ? htmlspecialchars($approw['lashBrand']) : '' ?>" selected>
                                        <?= !empty($approw['lashBrand']) ? htmlspecialchars($approw['lashBrand']) : 'choose option' ?>
                                        </option>
                                        <option value="My Lash Store">My Lash Store</option>
                                        <option value="Lash Jungle">Lash Jungle</option>
                                        <option value="LBLA">LBLA</option>
                                        <option value="EnvoLash">EnvoLash</option>
                                        <option value="London Lash">London Lash</option>
                                        <option value="Elleebana - elleplex profusion">Elleebana - elleplex profusion</option>
                                        <option value="none">none</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="lashWidth">Lash diameter</label>
                                      <select name="lashWidth" id="lashWidth">
                                       <option value="<?= !empty($approw['lashWidth']) ? htmlspecialchars($approw['lashWidth']) : '' ?>" selected>
                                        <?= !empty($approw['lashWidth']) ? htmlspecialchars($approw['lashWidth']) : 'choose option' ?>
                                        </option>
                                        <option value="0.5">0.5</option>
                                        <option value="0.7">0.7</option>
                                        <option value="0.1">0.1</option>
                                        <option value="0.15">0.15</option>
                                        <option value="none">none</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="lashCurl">Lash curl</label>
                                      <select name="lashCurl" id="lashCurl">
                                         <option value="<?= !empty($approw['lashCurl']) ? htmlspecialchars($approw['lashCurl']) : '' ?>" selected>
                                        <?= !empty($approw['lashCurl']) ? htmlspecialchars($approw['lashCurl']) : 'choose option' ?>
                                        </option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="rods - small">rods - small</option>
                                        <option value="rods - medium">rods - medium</option>
                                        <option value="rods - large">rods - large</option>
                                        <option value="shields - small">shields - small</option>
                                        <option value="shields - medium">shields - medium</option>
                                        <option value="shields - large">shields - large </option>
                                        <option value="hybrid - small">hybrid - small</option>
                                        <option value="hybrid - medium">hybrid - medium</option>
                                        <option value="hybrid - large">hybrid - large</option>
                                        <option value="none">none</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="adhesive">Adhesive</label>
                                        <select name="adhesive" id="adhesive">
                                         <option value="<?= !empty($approw['adhesive']) ? htmlspecialchars($approw['adhesive']) : '' ?>" selected>
                                        <?= !empty($approw['adhesive']) ? htmlspecialchars($approw['adhesive']) : 'choose option' ?>
                                        </option>
                                        <option value="My Lash Store - Strong Hold">My Lash Store - Strong Hold</option>
                                        <option value="Lash Store HQ - Rapid Bond">Lash Store HQ - Rapid Bond</option>
                                        <option value="none">none</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="remover">Remover</label>
                                    <select name="remover" id="remover">
                                        <option value="<?= !empty($approw['remover']) ? htmlspecialchars($approw['remover']) : '' ?>" selected>
                                        <?= !empty($approw['remover']) ? htmlspecialchars($approw['remover']) : 'choose option' ?>
                                        </option> 
                                                                               
                                        <option value="BL lashes cream remover">BL lashes cream remover</option>
                                        <option value="Lash V - Professional eyelash adhesive remover">Lash V - Professional eyelash adhesive remover</option>
                                        <option value="Lash store HQ - Lash Reset, jelly remover">Lash store HQ - Lash Reset, jelly remover </option>
                                        <option value="EnvoLash - cream remover">EnvoLash - cream remover</option>
                                        <option value="none">none</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="tint">Tint</label>
                                     <select name="tint" id="tint">
                                        <option value="<?= !empty($approw['tint']) ? htmlspecialchars($approw['tint']) : '' ?>" selected>
                                        <?= !empty($approw['tint']) ? htmlspecialchars($approw['tint']) : 'choose option' ?>
                                        </option>         
                                        <option value="Elleplex profusion - black">Elleplex profusion - black</option>
                                        <option value="Elleplex profusion - blue/black">Elleplex profusion - blue/black</option>
                                        <option value="Refectocil - black">Refectocil - black</option>
                                        <option value="Refectocil - blue/black">Refectocil - blue/black</option>
                                        <option value="Refectocil - brown">Refectocil - brown</option>
                                        <option value="none">none</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="lift">Lift</label>
                                        <select name="lift" id="lift">
                                         <option value="<?= !empty($approw['lift']) ? htmlspecialchars($approw['lift']) : '' ?>" selected>
                                        <?= !empty($approw['lift']) ? htmlspecialchars($approw['lift']) : 'choose option' ?>
                                        </option> 
                                        <option value="Elleplex profusion">Elleplex profusion</option>
                                        <option value="My Lash Store - Total Care">My Lash Store - Total Care</option>
                                        <option value="none">none</option>
                                    </select>
                                </div>
                            </div>
                            <div class="notes-container">
                                <label for="appNotes">Notes</label>
                                <textarea class="textarea-large" name="appNotes" id="appNotes" value="<?=htmlspecialchars($approw['appNotes'])?>"><?=htmlspecialchars($approw['appNotes'])?></textarea>
                            </div>
                                <?php

                                //TODO
                                //TODO
                                //if the images are set then show the images that are set, otherwise show the palceholder image.
                                ?>
                        </div>
                            <div class="client-images-container">
                                <div class="client-image-container">
                                    <img src=<?= !empty($approw['beforePhoto']) ? 'photos/' .  $approw['beforePhoto'] : "photos/placeholder.jpg"; ?> id="beforePhotoImage">
                                    <div class="image-controls">
                                        <label for="beforePhoto">Before photo</label>
                                        <input type="file" name="beforePhoto" id="beforePhoto" accept=".png, .jpg, .jpeg, .gif" value="<?=$approw['beforePhoto']?>">
                                    </div>
                                </div>
                                <div class="client-image-container">
                                    <img src= <?= !empty($approw['afterPhoto']) ? 'photos/' . $approw['afterPhoto'] : "photos/placeholder.jpg";  ?> id="afterPhotoImage">
                                    <div class="image-controls">
                                        <label for="afterPhoto">After photo</label>
                                        <input type="file" name="afterPhoto" id="afterPhoto" accept=".png, .jpg, .jpeg, .gif" value="<?=$approw['afterPhoto']?>">
                                    </div>
                                </div>
                            </div>
                            <button type="submit">Submit</button>
                    </form>


                    
                </div>
            </div>
            <!-- This is the appointment list section below -->
            <section>
                <h2 class="prev-apps-title">Previous appointments</h2>
                <?php
                    include 'src/dbconnect.php';
                    $stmt = $conn->prepare("SELECT * FROM appointments WHERE clientID = ? ORDER BY appDate DESC");
                    $stmt->bind_param('i', $client);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if($result->num_rows > 0) {
            
                        // echo "client found";
                        $row = $result->fetch_all(MYSQLI_ASSOC);
                        if($client != "New client")
            
                            foreach($row as $appointment): ?>
                                <div class="appointment-record-container">
            
                                    <div class="app-title">
                                        <h2> <?=htmlspecialchars($appointment['appType'])?> </h2>
                                          <div class="app-time">
                                            <p> <?=htmlspecialchars($appointment['appTime'])?> </p>
                                            <p> <?=htmlspecialchars($appointment['appDate'])?> </p>  
                                        </div>
                                    </div>
                                      
                                    <!-- <div class="when-container"> -->
                                    <div class="pastapp-layout">
                                        <div class="app-container">
                                        
                                            <table class="app-item-group-table">
                                               
                                                <tr class="app-item">
                                                    <td class="bold r-space">Lash length</td>
                                                    <td> <?=htmlspecialchars($appointment['lashLength'])?> </td>
                                                </tr>
                                                <tr class="app-item">
                                                    <td class="bold r-space">Lash Brand</td>
                                                    <td> <?=htmlspecialchars($appointment['lashBrand'])?> </td>
                                                </tr>
                                                <tr class="app-item">
                                                    <td class="bold r-space">Diameter</td>
                                                    <td> <?=htmlspecialchars($appointment['lashWidth'])?> </td>
                                                </tr>
                                                <tr class="app-item">
                                                    <td class="bold r-space">Lash curl</td>
                                                    <td> <?=htmlspecialchars($appointment['lashCurl'])?> </td>
                                                </tr>
                                                <tr class="app-item">
                                                    <td class="bold r-space">Adhesive</td>
                                                    <td> <?=htmlspecialchars($appointment['adhesive'])?> </td>
                                                </tr>
                                                <tr class="app-item">
                                                    <td class="bold r-space">Remover</td>
                                                    <td> <?=htmlspecialchars($appointment['remover'])?> </td>
                                                </tr>
                                                <tr class="app-item">
                                                    <td class="bold r-space">Tint</td>
                                                    <td> <?=htmlspecialchars($appointment['tint'])?> </td>
                                                </tr>
                                                <tr class="app-item">
                                                    <td class="bold r-space">Lift</td>
                                                    <td> <?=htmlspecialchars($appointment['lift'])?> </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="app-item-group">
                                            <h3>Notes</h3>
                                            <p> <?=htmlspecialchars($appointment['appNotes'])?> </p>
                                        </div>
                                    </div>
                                    <div class="photos">
                                        <div>
                                            <h3>Before photo</h3>
                                            <img class="photo" src="photos/<?=$appointment['beforePhoto']?>">
                                        </div>
                                        <div>
                                            <h3>After photo</h3>
                                            <img class="photo" src="photos/<?=$appointment['afterPhoto']?>">
                                        </div>
                                    </div>
                                    <div class="appointment-footer">
    
                                            <table class="app-item-group-table">
                                                <tr class="app-item">
                                                    <td class="bold r-space ">Duration</td>
                                                    <td> <?=htmlspecialchars($appointment['duration'])?> </td>
                                                </tr>
                                                <tr class="app-item">
                                                    <td class="bold r-space">Discount</td>
                                                    <td> <?=htmlspecialchars($appointment['discount'])?> </td>
                                                </tr>
                                                <tr class="app-item">
                                                    <td class="bold r-space">Cost</td>
                                                    <td> <?=htmlspecialchars($appointment['cost'])?> </td>
                                                </tr>
                                            </table>
    
                                            <div class="view-appointment">
                                                <p>Appointment ID: <?=$appointment['appID']?></p>
                                                <form method="POST" action="">
                                                    <input type="hidden" name="formID" value="appList">
                                                    <button type="submit" name="action" value="viewAppItem">View appointment details</button>
                                                    <input type="hidden" name="appID" value="<?=$appointment['appID']?>">
                                                </form>
                                            </div>
                                    </div>
                                    
                                    </div>
                                    
                                    <div class="line"></div>
                            <?php endforeach;
                            } else{
                                $conn->close();
                            }
                ?>
            </section>
        </main>
    </body>
</html>