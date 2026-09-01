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
            <h1>Client Record</h1>
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
                            <div >
                                <div>
                                    <label for="firstName">First name</label>
                                    <input type="text" name="firstName" id="firstName" value="<?= htmlspecialchars($row['firstName']) ?>">
                                </div>
                                <div>
                                    <label for="lastName">Last name</label>
                                    <input type="text" name="lastName" id="lastName" value="<?= htmlspecialchars($row['lastName']) ?>">
                                </div>
                                <div>
                                    <label for="birthDate">Date of birth</label>
                                    <input type="date" name="birthDate" id="birthDate" value="<?= htmlspecialchars($row['birthDate']) ?>">
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
                                <div>
                                    <label for="address">Address</label>
                                    <input type="text" name="address" id="address" value="<?= htmlspecialchars($row['address']) ?>">
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="emergencyContactName">Emergency contact name</label>
                                    <input type="text" name="emergencyContactName" id="emergencyContactName" value="<?= htmlspecialchars($row['emergencyContactName']) ?>">
                                </div>
                                <div>
                                    <label for="emergencyContactPhone">Emergency contact phone number</label>
                                    <input type="text" name="emergencyContactPhone" id="emergencyContactPhone" value="<?= htmlspecialchars($row['emergencyContactPhone']) ?>">
                                </div>
                                <div>
                                    <label for="medicalConditions">Medical conditions</label>
                                    <input type="text" name="medicalConditions" id="medicalConditions" value="<?= htmlspecialchars($row['medicalConditions']) ?>">
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="contactLenses">Contact lenses</label>
                                    <select name="contactLenses" id="contactLenses" value="<?= htmlspecialchars($row['contactLenses']) ?>">
                                        <option selected>choose option</option>
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
                                <div>
                                    <label for="adhesivePatchTest">Adhesive patch test</label>
                                    <input type="text" name="adhesivePatchTest" id="adhesivePatchTest" value="<?= htmlspecialchars($row['adhesivePatchTest']) ?>">
                                </div>
                                <div>
                                    <label for="removerPatchTest">Remover patch test</label>
                                    <input type="text" name="removerPatchTest" id="removerPatchTest" value="<?= htmlspecialchars($row['removerPatchTest']) ?>">
                                </div>
                                <div>
                                    <label for="tintPatchTest">Tint patch test</label>
                                    <input type="text" name="tintPatchTest" id="tintPatchTest" value="<?= htmlspecialchars($row['tintPatchTest']) ?>">
                                </div>
                                <div>
                                    <label for="liftPatchTest">Lift patch test</label>
                                    <input type="text" name="liftPatchTest" id="liftPatchTest" value="<?= htmlspecialchars($row['liftPatchTest']) ?>">
                                </div>
                            </div>
                            <div>
                                <div class="client-notes-section">
                                    <label for="clientNotes">Client notes</label>
                                    <textarea  name="clientNotes" id="clientNotes" value="<?= htmlspecialchars($row['clientNotes']) ?>"><?= htmlspecialchars($row['clientNotes']) ?></textarea>
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
                                            <option selected><?=$approw['appType']?></option>
                                            <option>Lash extensions - classic full set: 120</option>
                                            <option>Lash extensions - hybrid: 140</option>
                                            <option>Lash extensions - light volume: 160</option>
                                            <option>Lash extensions - half set: 90</option>
                                            <option>Lash extensions - classic - infills (up to 3 weeks): 90</option>
                                            <option>Lash extensions - hybrid - infills (up to 3 weeks): 100</option>
                                            <option>Lash extensions - light volume - infills (up to 3 weeks): 110</option>
                                            <option>Lash extensions - removal: 35</option>
                                            <option>Lash lift & tint: 95</option>
                                            <option>Lash lift: 80</option>
                                            <option>Lash tint: 30</option>
                                            <option>Consultation</option>
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
                                    <label for="appDate">Date</label>
                                    <input type="date" name="appDate" id="appDate" value="<?=htmlspecialchars($approw['appDate'])?>">
                                </div>
                                <div>
                                    <label for="appTime">Time</label>
                                    <input type="time" name="appTime" id="appTime" value="<?=htmlspecialchars($approw['appTime'])?>">
                                </div>
                                <div>
                                    <label for="duration">Duration</label>
                                    <input type="number" step="0.25" name="duration" id="duration" value="<?=htmlspecialchars($approw['duration'])?>">
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="lashLength">Lash lengths on right eye</label>
                                    <input type="text" name="lashLength" id="lashLength" value="<?=htmlspecialchars($approw['lashLength'])?>">
                                </div>
                                <div>
                                    <label for="lashBrand">Lash brand</label>
                                    <input type="text" name="lashBrand" id="lashBrand" value="<?=htmlspecialchars($approw['lashBrand'])?>">
                                </div>
                                <div>
                                    <label for="lashWidth">Lash diameter</label>
                                    <input type="text" name="lashWidth" id="lashWidth" value="<?=htmlspecialchars($approw['lashWidth'])?>">
                                </div>
                                <div>
                                    <label for="lashCurl">Lash curl</label>
                                    <input type="text" name="lashCurl" id="lashCurl" value="<?=htmlspecialchars($approw['lashCurl'])?>">
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="adhesive">Adhesive</label>
                                    <input type="text" name="adhesive" id="adhesive" value="<?=htmlspecialchars($approw['adhesive'])?>">
                                </div>
                                <div>
                                    <label for="remover">Remover</label>
                                    <input type="text" name="remover" id="remover" value="<?=htmlspecialchars($approw['remover'])?>">
                                </div>
                                <div>
                                    <label for="tint">Tint</label>
                                    <input type="text" name="tint" id="tint" value="<?=htmlspecialchars($approw['tint'])?>">
                                </div>
                                <div>
                                    <label for="lift">Lift</label>
                                    <input type="text" name="lift" id="lift" value="<?=htmlspecialchars($approw['lift'])?>">
                                </div>
                            </div>
                            <div class="notes-container">
                                <label for="appNotes">Notes</label>
                                <textarea name="appNotes" id="appNotes" value="<?=htmlspecialchars($approw['appNotes'])?>"><?=htmlspecialchars($approw['appNotes'])?></textarea>
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
            
                                    <h2> <?=htmlspecialchars($appointment['appType'])?> </h2>
            
            
                                    <!-- <div class="when-container"> -->
                                    <div class="app-grid">
                                        
                                            <div>
                                            <h3>Date</h3>
                                            <p> <?=htmlspecialchars($appointment['appDate'])?> </p>
                                        </div>
                                            <div>
                                            <h3>Time</h3>
                                            <p> <?=htmlspecialchars($appointment['appTime'])?> </p>
                                        </div>
                                            <div>
                                            <h3>Duration</h3>
                                            <p> <?=htmlspecialchars($appointment['duration'])?> </p>
                                        </div>
                                        <div>
                                            <h3>Cost</h3>
                                            <p> <?=htmlspecialchars($appointment['cost'])?> </p>
                                        </div>
                                        <div>
                                            <h3>Lash length</h3>
                                            <p> <?=htmlspecialchars($appointment['lashLength'])?> </p>
                                        </div>
                                        <div>
                                            <h3>Lash Brand</h3>
                                            <p> <?=htmlspecialchars($appointment['lashBrand'])?> </p>
                                        </div>
                                        <div>
                                            <h3>Diameter</h3>
                                            <p> <?=htmlspecialchars($appointment['lashWidth'])?> </p>
                                        </div>
                                        <div>
                                            <h3>Lash curl</h3>
                                            <p> <?=htmlspecialchars($appointment['lashCurl'])?> </p>
                                        </div>
                                        <div>
                                            <h3>Adhesive</h3>
                                            <p> <?=htmlspecialchars($appointment['adhesive'])?> </p>
                                        </div>
                                        <div>
                                            <h3>Remover</h3>
                                            <p> <?=htmlspecialchars($appointment['remover'])?> </p>
                                        </div>
                                        <div>
                                            <h3>Tint</h3>
                                            <p> <?=htmlspecialchars($appointment['tint'])?> </p>
                                        </div>
                                        <div>
                                            <h3>Lift</h3>
                                            <p> <?=htmlspecialchars($appointment['lift'])?> </p>
                                        </div>
                                    </div>
                                    <div>
                                        <h3>Notes</h3>
                                        <p> <?=htmlspecialchars($appointment['appNotes'])?> </p>
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
                                    <p>Appointment ID: <?=$appointment['appID']?></p>
                                    <form method="POST" action="">
                                        <input type="hidden" name="formID" value="appList">
                                        <button type="submit" name="action" value="viewAppItem">View appointment details</button>
                                        <input type="hidden" name="appID" value="<?=$appointment['appID']?>">
                                    </form>
                                    
            
                                    </div>
                            <?php endforeach;
                            } else{
                                $conn->close();
                            }
                ?>
            </section>
        </main>
    </body>
</html>