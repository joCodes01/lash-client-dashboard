<?php
session_start();
include 'src/handle_session_login.php';

include 'src/handle_dashboard.php';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <script src="src/script.js" defer></script>
        <script src="src/handleAddNewClient.js" defer></script>
        <title>Dashboard</title>
    </head>
    <body>
            <header class="nav-container">
            <img class="nav-logo" src="images/logo.png" alt="">
            <nav>
                <ul class="navlist">
                    <li><a href="src/handle_logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <h1>Dashboard</h1>
            <div class="dashboard-container">
                <section class="form-container-dashboard">
                    <div class="clients-heading-container">
                        <h2>Clients</h2>
                        <form method="POST" action="">
                            <input type="hidden" name="formID" value="addNewClient">
                            <button type="submit" id="addNewClient" name="action" value="Add new client"><img src="images/plus.png"></button>
                        </form>
                    </div>
            
                    <!-- for each loop through the clients n the database and list them here -->
                    <?php
                    include 'src/dbconnect.php';
                        $stmt = $conn->prepare("SELECT * FROM clients ORDER BY firstName ASC");
                        $stmt-> execute();
                        $result = $stmt->get_result();
                        // echo "<br><br> the client id is set to: " . $_SESSION['clientID'] . "<br>";
                        if($result->num_rows > 0) {
            
                            $row = $result->fetch_all(MYSQLI_ASSOC);
                            foreach($row as $clientItem): ?>
                            <?php $_SESSION['appID'] = '00'; ?>
                            
                                <div class="client-listitem-container">
                                    <form method="POST" action="">
                                        <input type="hidden" name="formID" id="clientItemForm" value="clientItemForm">
                                        <label hidden for="clientID">Client ID</label>
                                        <input hidden type="text" name="clientID" value="<?= htmlspecialchars($clientItem['clientID'])?>">
                                        <button class="client-name-btn" name="action" type="submit" value="viewApps"><?=htmlspecialchars($clientItem['firstName']) . " " . htmlspecialchars($clientItem['lastName']) ?></button>
                                        <button class="client-record-btn" id="client-record-btn" name="action" type="submit" value="viewRecord">Client record</button>
                                    </form>
                                </div>
                            <?php endforeach;
                            } else{
                                $conn->close();
                            }
                            ?>
                </section>
                <section class="form-container-dashboard">
                    <div class="appointments-heading-container">
                        <h2>Appointments</h2>
                            <form method="POST" action="">
                                <input type="hidden" name="formID" value="showAllApps">
                                <button class="show-all-btn" type="submit" name="action" value="Show all">Show all</button>
                            </form>
                    </div>
            
                    <h3 class="appointments-name"><?=htmlspecialchars($_SESSION['clientName'] ?? "")?></h3>
                    <!-- for each loop through the appointmentss n the database and list them here based on client selected-->
                    <!-- check the $_SESSION['clientID'] -->
                    <?php
                            include 'src/dbconnect.php';
                            if(($_SESSION['clientID'] ?? "") == 'allClients') {
            
                                // echo "its working";
            
                                $stmt = $conn->prepare("SELECT appointments.*, clients.firstName, clients.lastName
                                                        FROM appointments
                                                        INNER JOIN clients ON appointments.clientID = clients.clientID
                                                        ORDER BY appointments.appDate DESC
                                                        ");
                                $stmt-> execute();
                                $result = $stmt->get_result();
            
                                if($result->num_rows > 0) {
            
                                    // echo "appointment found";
                                    $row = $result->fetch_all(MYSQLI_ASSOC);
            
                                    foreach($row as $appItem): ?>
                                        <div class="app-listitem-container">
                                            <form method="POST" action="">
                                                    <input type="hidden" name="formID" value="viewApp">
                                                    <input type="hidden" name="appID" value="<?= htmlspecialchars($appItem['appID']) ?>">
                                                    <input type="hidden" name="clientID" value="<?= $appItem['clientID'] ?>">
            
                                                    <p class="app-client-name" id="appClientName"><?=htmlspecialchars($appItem['firstName']) . " " . htmlspecialchars($appItem['lastName']) ?></p>
                                                    <p><?= htmlspecialchars($appItem['appType'])?></p>
                                                    <div class="app-date-container">
                                                        <p class="display-date"><?= htmlspecialchars($appItem['appDate'])?></p>
                                                        <p class="display-time"><?= htmlspecialchars($appItem['appTime'])?></p>
                                                        <button class="details-btn" type="submit">Details</button>
                                                    </div>
                                                </form>
                                        </div>
                                    <?php endforeach;
                                    }else{
                                        $conn->close();
                                    }
                            }else {
                                $stmt = $conn->prepare("SELECT * FROM appointments WHERE clientID = ? ORDER BY appDate ASC");
                                $stmt->bind_param('i', $_SESSION['clientID']);
                                $stmt-> execute();
                                $result = $stmt->get_result();
                            if($result->num_rows > 0) {
            
                                // echo "appointment found";
                                $row = $result->fetch_all(MYSQLI_ASSOC);
                                echo '<div class="app-listitem-container-single">';
            
                                foreach($row as $appItem): ?>
            
                                        <form method="POST" action="">
                                            <input type="hidden" name="formID" value="viewApp">
                                            <input type="hidden" name="appID" value="<?= htmlspecialchars($appItem['appID']) ?>">
                                            <input type="hidden" name="clientID" value="<?= htmlspecialchars($appItem['clientID']) ?>">
                                            <p><?= htmlspecialchars($appItem['appType']) ?></p>
                                            <div class="app-date-container">
                                                <p class="display-date"><?= htmlspecialchars($appItem['appDate'])?></p>
                                                <p class="display-time"><?= htmlspecialchars($appItem['appTime'])?></p>
                                                <button class="details-btn" type="submit">Details</button>
                                            </div>
                                            
                                        </form>
            
                                <?php endforeach;
                                echo '</div>';
                            }else {
                                $conn->close();
                            }
                        }
                    ?>
                </section>
            </div>
        </main>
    </body>
</html> 

