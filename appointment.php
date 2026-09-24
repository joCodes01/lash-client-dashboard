<?php 
session_start();
include 'src/handle_session_login.php';
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
        <title>Appointment</title>
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
            <div class="form-container appointment-form-container">
                <form method="POST" action="" id="appForm" class="CRUD-form" enctype="multipart/form-data">
                    <div class="appointment-heading-container">
                        
                        <!-- <h2>Appointment</h2> -->
                        <h1><?= htmlspecialchars($row['firstName']) . " " . htmlspecialchars($row['lastName']) ?></h1>
                        
                        <!-- FORM ID     -->
                        <input type="hidden" name="formID" id="appForm" value="appForm">
                        <label hidden for="appClientID">Client ID: </label>
                        <input hidden type="text" name="appClientID" id="appClientID" value="<?= $_SESSION['clientID']; ?>">
                        <label hidden for="appID">Appointment ID: </label>
                        <input hidden type="text" name="appID" id="appID" value="<?= $_SESSION['appID'] ?? null; ?>">
                        <p hidden>Appointment ID: <?= $_SESSION['appID'] ?? null; ?></p>
                        
                    <!-- if the app ID is 00 then set the dropdown to create new appointment else set it to update -->
                        <?php
                            if (($_SESSION['appID'] ?? '') == "00") {
                                echo '<select name="CRUDapp">
                                        <option selected value="CREATE">Create new appointment</option>
                                        <option value="UPDATE">Update appointment</option>
                                        <option value="DELETE">Delete appointment</option>
                                    </select>';
                                }else {
                                    echo '<select name="CRUDapp">
                                        <option value="CREATE">Create new appointment</option>
                                        <option selected value="UPDATE">Update appointment</option>
                                        <option value="DELETE">Delete appointment</option>
                                    </select>';
                                }
                        ?>

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
                                <option value="Patch test">Patch test</option>
                                <option value="Parental consent record">Parental consent record</option>
                                <option value="none">none</option>
                            </select>
                        </div>             
                    </div>
                    <div class="appointment-details-container">
                        
                        <div>
                            <h2>Appointment</h2>
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
                                    <option value="No discount">No discount</option>
                                    <option value="10% discount">10% discount</option>
                                    <option value="20% discount">20% discount</option>
                                    <option value="20% referral discount">20% referral discount</option>
                                    <option value="100% instagram model discount">100% instagram model discount</option>
                                    <option value="100% instagram model discount">100% model discount</option>
                                    <option value="100% discount">100% discount</option>
                                    <option value="Free of charge">Free of charge</option>
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
                            <h2>Style</h2>
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
                                    <option value="hybrid - x large">hybrid - x large</option>
                                    <option value="universal - x small">universal - x small</option>
                                    <option value="universal - small">universal - small</option>
                                    <option value="universal - medium">universal - medium</option>
                                    <option value="universal - large">universal - large</option>
                                    <option value="universal - x largwe">universal - x large</option>
                                    <option value="none">none</option>
                                </select>
                            </div>
                            <div>
                                <label for="lashStyle">Lash map</label>
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
                                   <select name="lashLength" id="lashLength">
                                    <option value="<?= !empty($approw['lashLength']) ? htmlspecialchars($approw['lashLength']) : '' ?>" selected>
                                    <?= !empty($approw['lashLength']) ? htmlspecialchars($approw['lashLength']) : 'choose option' ?>
                                    </option>
                                    <option value="7 - 8">7 - 8</option>
                                    <option value="7 - 9">7 - 9</option>
                                    <option value="7 - 10">7 - 10</option>
                                    <option value="7 - 11">7 - 11</option>
                                    <option value="7 - 12">7 - 12</option>
                                    <option value="7 - 13">7 - 13</option>
                                    <option value="7 - 14">7 - 14</option>
                                    <option value="7 - 15">7 - 15</option>
                                    <option value="8 - 9">8 - 9</option>
                                    <option value="8 - 10">8 - 10</option>
                                    <option value="8 - 11">8 - 11</option>
                                    <option value="8 - 12">8 - 12</option>
                                    <option value="8 - 13">8 - 13</option>
                                    <option value="8 - 14">8 - 14</option>
                                    <option value="8 - 15">8 - 15</option>
                                    <option value="9 - 10">9 - 10</option>
                                    <option value="9 - 11">9 - 11</option>
                                    <option value="9 - 12">9 - 12</option>
                                    <option value="9 - 13">9 - 13</option>
                                    <option value="9 - 14">9 - 14</option>
                                    <option value="9 - 15">9 - 15</option>
                                    <option value="none">none</option>
                                </select>
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
                            
                        </div>
                        <div>
                            <h2>Liquids</h2>
                            <div>
                                <label for="cleanser">Cleanser</label>
                                <select name="cleanser" id="cleanser">
                                    <option value="<?= !empty($approw['cleanser']) ? htmlspecialchars($approw['cleanser']) : '' ?>" selected>
                                    <?= !empty($approw['cleanser']) ? htmlspecialchars($approw['cleanser']) : 'choose option' ?>
                                    </option> 
                                    <option value="Pro-long cleanser">Pro-long cleanser</option>
                                    <option value="Elleebana make-up remover">Elleebana make-up remover</option>
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
                                    <option value="My Lash Store - Eyelash Extension Remover Cream">My Lash Store - Eyelash Extension Remover Cream</option>
                                    <option value="Lash V - Professional eyelash adhesive remover">Lash V - Professional eyelash adhesive remover</option>
                                    <option value="Lash store HQ - Lash Reset, jelly remover">Lash store HQ - Lash Reset, jelly remover </option>
                                    <option value="EnvoLash - cream remover">EnvoLash - cream remover</option>
                                    <option value="none">none</option>
                                </select>
                            </div>
                            <div>
                                <label for="primer">Primer</label>
                                <select name="primer" id="primer">
                                    <option value="<?= !empty($approw['primer']) ? htmlspecialchars($approw['primer']) : '' ?>" selected>
                                    <?= !empty($approw['primer']) ? htmlspecialchars($approw['primer']) : 'choose option' ?>
                                    </option> 
                                    <option value="My Lash Store primer">My Lash Store primer</option>
                                    <option value="Lash Store HQ primer">Lash Store HQ primer</option>
                                    <option value="none">none</option>
                                </select>
                            </div>
                            <div>
                                <label for="adhesive">Adhesive</label>
                                    <select name="adhesive" id="adhesive">
                                        <option value="<?= !empty($approw['adhesive']) ? htmlspecialchars($approw['adhesive']) : '' ?>" selected>
                                    <?= !empty($approw['adhesive']) ? htmlspecialchars($approw['adhesive']) : 'choose option' ?>
                                    </option>
                                    <option value="My Lash Store - Strong Hold">My Lash Store - Strong Hold</option>
                                    <option value="Lash Store HQ - Rapid Bond">Lash Store HQ - Rapid Bond</option>
                                    <option value="Elleebana - Lash lift adhesive">Elleebana - Lash lift adhesive</option>
                                    <option value="Elleebana - ElleBalm">Elleebana - ElleBalm</option>
                                    <option value="My Lash Store - Lift & Lam Balm">My Lash Store - Lift & Lam Balm</option>
                                    <option value="none">none</option>
                                </select>
                            </div>
                            <div>
                                <label for="bonder">Bonder</label>
                                <select name="bonder" id="bonder">
                                        <option value="<?= !empty($approw['bonder']) ? htmlspecialchars($approw['bonder']) : '' ?>" selected>
                                    <?= !empty($approw['bonder']) ? htmlspecialchars($approw['bonder']) : 'choose option' ?>
                                    </option> 
                                    <option value="My Lash Store bonder">My Lash Store bonder</option>
                                    <option value="Lash Store HQ bonder">Lash Store HQ bonder</option>
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
                            <h2>Notes</h2>



                                 <div>
                                    <label for="lotion1">Lift lotion 1</label>
                                    <select name="lotion1" id="lotion1">
                                        <option value="<?= !empty($approw['lotion1']) ? htmlspecialchars($approw['lotion1']) : '' ?>" selected>
                                        <?= !empty($approw['lotion1']) ? htmlspecialchars($approw['lotion1']) : 'choose option' ?>
                                        </option>
                                        <option value="3 mins">3 mins</option>
                                        <option value="4 mins">4 mins</option>
                                        <option value="5 mins">5 mins</option>
                                        <option value="6 mins">6 mins</option>
                                        <option value="7 mins">7 mins</option>
                                        <option value="8 mins">8 mins</option>
                                        <option value="9 mins">9 mins</option>
                                        <option value="10 mins">10 mins</option>
                                        <option value="11 mins">11 mins</option>
                                        <option value="12 mins">12 mins</option>
                                        <option value="13 mins">13 mins </option>
                                        <option value="14 mins">14 mins</option>
                                        <option value="15 mins">15 mins</option>
                                        <option value="16 mins">16 mins</option>
                                        <option value="none">none</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="lotion2">Lift lotion 2</label>
                                    <select name="lotion2" id="lotion2">
                                        <option value="<?= !empty($approw['lotion2']) ? htmlspecialchars($approw['lotion2']) : '' ?>" selected>
                                        <?= !empty($approw['lotion2']) ? htmlspecialchars($approw['lotion2']) : 'choose option' ?>
                                        </option>
                                        <option value="3 mins">3 mins</option>
                                        <option value="4 mins">4 mins</option>
                                        <option value="5 mins">5 mins</option>
                                        <option value="6 mins">6 mins</option>
                                        <option value="7 mins">7 mins</option>
                                        <option value="8 mins">8 mins</option>
                                        <option value="9 mins">9 mins</option>
                                        <option value="10 mins">10 mins</option>
                                        <option value="11 mins">11 mins</option>
                                        <option value="12 mins">12 mins</option>
                                        <option value="13 mins">13 mins </option>
                                        <option value="14 mins">14 mins</option>
                                        <option value="15 mins">15 mins</option>
                                        <option value="16 mins">16 mins</option>
                                        <option value="none">none</option>
                                    </select>
                                </div>
                            





                            <label for="appNotes">Notes</label>
                            <textarea class="textarea-large" name="appNotes" id="appNotes" value="<?=htmlspecialchars($approw['appNotes'])?>"><?=htmlspecialchars($approw['appNotes'])?></textarea>
                        </div>
                        <!-- <div class="client-images-container"> -->
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
                        <!-- </div> -->
                        <button type="submit">Submit</button>
                </form>
                <p>Appointment ID: <?= $_SESSION['appID'] ?? null; ?></p>   
                </div>
            </div>
        </main>
    </body>