<?php 
session_start();
include 'src/handle_session_login.php';
include 'src/handle_clientrecord.php';
include 'src/handle_appointment.php';
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
                      <!-- ADD NEW APPOINTMENT -->
                     <form class="new-appointment-button-form" method="POST" action="">
                        <input type="hidden" name="formID" id="clientNewRecordApp" value="clientNewRecordApp">
                        <label hidden for="clientID">Client ID</label>
                        <input hidden type="text" name="clientID" value="<?= htmlspecialchars($_SESSION['clientID'])?>">
                        <button id="client-app-btn" name="action" type="submit" value="newRecord">New appointment</button>
                    </form>
                    
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


                            <!-- LAST USED -->
                            <div>
                                <h2>Last used</h2>
                          
                                <h3>Adhesive</h3>
                                <?php if (isset($_SESSION['lastused_stronghold'])): ?>
                                    <div class="lastused_item">
                                        <p><?= htmlspecialchars($_SESSION['lastused_stronghold']) ?></p>
                                        <p><?= htmlspecialchars($_SESSION['lastused_stronghold_appDate']) ?></p>
                                    </div>
                                <?php endif; ?>
                                <?php if (isset($_SESSION['lastused_rapidbond'])): ?>
                                    <div class="lastused_item">
                                        <p><?= htmlspecialchars($_SESSION['lastused_rapidbond']) ?></p>
                                        <p><?= htmlspecialchars($_SESSION['lastused_rapidbond_appDate']) ?></p>
                                    </div>
                                <?php endif; ?>
                                <?php if (isset($_SESSION['lastused_elleliftadhesive'])): ?>
                                    <div class="lastused_item">
                                        <p><?= htmlspecialchars($_SESSION['lastused_elleliftadhesive']) ?></p>
                                        <p><?= htmlspecialchars($_SESSION['lastused_elleliftadhesive_appDate']) ?></p>
                                    </div>
                                <?php endif; ?>

                                <h3>Remover</h3>
                                       <?php if (isset($_SESSION['lastused_blremover'])): ?>
                                    <div class="lastused_item">
                                        <p><?= htmlspecialchars($_SESSION['lastused_blremover']) ?></p>
                                        <p><?= htmlspecialchars($_SESSION['lastused_blremover_appDate']) ?></p>
                                    </div>
                                <?php endif; ?>
                               



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
                                    <textarea class="textarea-large" name="medicalConditions" id="medicalConditions"><?= htmlspecialchars($row['medicalConditions']) ?></textarea>
                                </div>
                            </div>
                            <div>
                                <div class="client-notes-section">
                                    <label for="clientNotes">Client notes</label>
                                    <textarea class="textarea-large" name="clientNotes" id="clientNotes" ><?= htmlspecialchars($row['clientNotes']) ?></textarea>
                                </div>
                            </div>
                            
                        </div>
                        <button class="submit" type="submit">Submit</button>
                        
                    </form>
                </div>
            <!-- PREVIOUS APPOINTMENTS LIST -->
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
                                    <div class="pastapp-layout">
                                    <?php if ($appointment['appType'] == "Lash lift & tint" || $appointment['appType'] == "Lash lift" || $appointment['appType'] == "Lift reversal"): ?>


                                        <div class="app-container">
                                                <table class="app-item-group-table">
                                                     <tr class="app-item">
                                                        <td class="bold r-space">Lift</td>
                                                        <td> <?=htmlspecialchars($appointment['lift'] ?? '')?> </td>
                                                    </tr>
                                                    <tr class="app-item">
                                                        <td class="bold r-space">Tint</td>
                                                        <td> <?=htmlspecialchars($appointment['tint'] ?? '')?> </td>
                                                    </tr>
                                                       <tr class="app-item">
                                                        <td class="bold r-space">Adhesive</td>
                                                        <td> <?=htmlspecialchars($appointment['adhesive'] ?? '')?> </td>
                                                    </tr>
                                                    <tr class="app-item">
                                                        <td class="bold r-space">Cleanser</td>
                                                        <td> <?=htmlspecialchars($appointment['cleanser'] ?? '')?> </td>
                                                    </tr>
                                                    <tr class="app-item">
                                                        <td class="bold r-space">Remover</td>
                                                        <td> <?=htmlspecialchars($appointment['remover'] ?? '')?> </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <?php elseif ($appointment['appType'] == "Lash tint"): ?>

                                            <div class="app-container">
                                                <table class="app-item-group-table">
                                                    <tr class="app-item">
                                                        <td class="bold r-space">Tint</td>
                                                        <td> <?=htmlspecialchars($appointment['tint'] ?? '')?> </td>
                                                    </tr>
                                                    <tr class="app-item">
                                                        <td class="bold r-space">Cleanser</td>
                                                        <td> <?=htmlspecialchars($appointment['cleanser'] ?? '')?> </td>
                                                    </tr>
                                                    <tr class="app-item">
                                                        <td class="bold r-space">Remover</td>
                                                        <td> <?=htmlspecialchars($appointment['remover'] ?? '')?> </td>
                                                    </tr>
                                                </table>
                                            </div>
                                             <?php elseif ($appointment['appType'] == "Patch test"): ?>

                                            <div class="app-container">
                                                <table class="app-item-group-table">
                                                    <tr class="app-item">
                                                        <td class="bold r-space">Adhesive</td>
                                                        <td> <?=htmlspecialchars($appointment['adhesive'] ?? '')?> </td>
                                                    </tr>
                                                           <tr class="app-item">
                                                        <td class="bold r-space">Primer</td>
                                                        <td> <?=htmlspecialchars($appointment['primer'] ?? '')?> </td>
                                                    </tr>
                                                    <tr class="app-item">
                                                        <td class="bold r-space">Bonder</td>
                                                        <td> <?=htmlspecialchars($appointment['bonder'] ?? '')?> </td>
                                                    </tr>
                                                     <tr class="app-item">
                                                        <td class="bold r-space">Lift</td>
                                                        <td> <?=htmlspecialchars($appointment['lift'] ?? '')?> </td>
                                                    </tr>
                                                    <tr class="app-item">
                                                        <td class="bold r-space">Tint</td>
                                                        <td> <?=htmlspecialchars($appointment['tint'] ?? '')?> </td>
                                                    </tr>
                                                    <tr class="app-item">
                                                        <td class="bold r-space">Cleanser</td>
                                                        <td> <?=htmlspecialchars($appointment['cleanser'] ?? '')?> </td>
                                                    </tr>
                                                    <tr class="app-item">
                                                        <td class="bold r-space">Remover</td>
                                                        <td> <?=htmlspecialchars($appointment['remover'] ?? '')?> </td>
                                                    </tr>
                                                </table>
                                            </div>



                                            <?php else: ?>
                                            <div class="app-container">
                                                <table class="app-item-group-table">
                                                    <tr class="app-item">
                                                        <td class="bold r-space">Lash length</td>
                                                        <td> <?=htmlspecialchars($appointment['lashLength'] ?? '')?> </td>
                                                    </tr>
                                                    <tr class="app-item">
                                                        <td class="bold r-space">Lash Brand</td>
                                                        <td> <?=htmlspecialchars($appointment['lashBrand'] ?? '')?> </td>
                                                    </tr>
                                                    <tr class="app-item">
                                                        <td class="bold r-space">Diameter</td>
                                                        <td> <?=htmlspecialchars($appointment['lashWidth'] ?? '')?> </td>
                                                    </tr>
                                                    <tr class="app-item">
                                                        <td class="bold r-space">Lash curl</td>
                                                        <td> <?=htmlspecialchars($appointment['lashCurl'] ?? '')?> </td>
                                                    </tr>
                                                    <tr class="app-item">
                                                        <td class="bold r-space">Adhesive</td>
                                                        <td> <?=htmlspecialchars($appointment['adhesive'] ?? '')?> </td>
                                                    </tr>
                                                    <tr class="app-item">
                                                        <td class="bold r-space">Remover</td>
                                                        <td> <?=htmlspecialchars($appointment['remover'] ?? '')?> </td>
                                                    </tr>
                                                    <tr class="app-item">
                                                        <td class="bold r-space">Cleanser</td>
                                                        <td> <?=htmlspecialchars($appointment['cleanser'] ?? '')?> </td>
                                                    </tr>
                                                    <tr class="app-item">
                                                        <td class="bold r-space">Primer</td>
                                                        <td> <?=htmlspecialchars($appointment['primer'] ?? '')?> </td>
                                                    </tr>
                                                    <tr class="app-item">
                                                        <td class="bold r-space">Bonder</td>
                                                        <td> <?=htmlspecialchars($appointment['bonder'] ?? '')?> </td>
                                                    </tr>
                                                </table>
                                            </div>
                                     <?php endif ?>
                                        <div class="app-item-group">
                                            <h3>Notes</h3>
                                            <p> <?=htmlspecialchars($appointment['appNotes'])?> </p>
                                        </div>
                                    </div>

                                    <!-- If appointment type is patch test- dont include the photos -->
                                    
                                        <?php if($appointment['appType'] != 'Patch test'): ?>
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
                                        <?php endif; ?>

                                        <div class="appointment-footer">
                                            <table class="app-item-group-table">
                                                <tr class="app-item">
                                                    <td class="bold r-space ">Duration</td>
                                                    <td> <?=htmlspecialchars($appointment['duration'] )?> </td>
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