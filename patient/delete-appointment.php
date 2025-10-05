<?php

    session_start();

    if(!isset($_SESSION["user"]) || ($_SESSION["user"])=="" || $_SESSION['usertype']!='p'){
        header("location: ../login.php");
        exit();
    }

    // Only accept POST for cancellation with a reason
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        include("../connection.php");

        // Get logged-in patient
        $useremail = $_SESSION["user"];
        $userrow = $database->query("select * from patient where pemail='$useremail'");
        $userfetch = $userrow->fetch_assoc();
        $pid = $userfetch["pid"];

        // Read inputs
        $appoid = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $reason = isset($_POST['reason']) ? trim($_POST['reason']) : '';

        if($appoid <= 0 || $reason === ''){
            header("location: appointment.php");
            exit();
        }

        // Verify ownership of the appointment
        $check = $database->query("select appoid from appointment where appoid='$appoid' and pid='$pid' limit 1");
        if(!$check || $check->num_rows === 0){
            // Not found or not owned by this patient
            header("location: appointment.php");
            exit();
        }

        // Ensure cancellations table exists
        $database->query("CREATE TABLE IF NOT EXISTS appointment_cancellations (
            id INT(11) NOT NULL AUTO_INCREMENT,
            appoid INT(11) NOT NULL,
            pid INT(11) NOT NULL,
            reason TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1;");

        // Store the cancellation reason
        $reasonEsc = $database->real_escape_string($reason);
        $database->query("insert into appointment_cancellations(appoid, pid, reason) values ($appoid, $pid, '$reasonEsc')");

        // Delete the appointment record
        $database->query("delete from appointment where appoid='$appoid' and pid='$pid'");

        // Redirect with success indicator
        header("location: appointment.php?action=cancelled");
        exit();
    } else {
        // Fallback: if accessed via GET, redirect back
        header("location: appointment.php");
        exit();
    }


?>