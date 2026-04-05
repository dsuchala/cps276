<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true){
    header("Location: index.php");
    exit;
}

// Example dynamic content
$event = isset($_SESSION['upcomingEvent']) ? $_SESSION['upcomingEvent'] : null;
$bandUpdate = isset($_SESSION['bandUpdate']) ? $_SESSION['bandUpdate'] : null;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Inline navigation bar -->
<nav class="top-nav">
    <span>GITPUSHPLAY</span>
    <span><a href="schedule.php">SCHEDULE</a></span>
    <span><a href="demos.php">DEMOS</a></span>
    <span><a href="bands.php">BANDS</a></span>
    <span><a href="artist_profile.php">ARTIST PROFILE</a></span>
</nav>

<div class="welcome-box">Welcome back!</div>

<div class="card">
    <?php
    if($event) {
        echo $event;
    } else {
        echo "(No upcoming events)";
    }
    ?>
</div>

<div class="card">
    <?php
    if($bandUpdate) {
        echo $bandUpdate;
    } else {
        echo "(No updates to band profile)";
    }
    ?>
</div>

<footer class="bottom-nav">
    <span>HOME</span>
    <span>SETTINGS</span>
</footer>

</body>
</html>
