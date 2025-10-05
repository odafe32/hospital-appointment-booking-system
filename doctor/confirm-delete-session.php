<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='d'){
            header("location: ../login.php");
        }
    }else{
        header("location: ../login.php");
    }


    if($_POST){
        //import database
        include("../connection.php");
        $id = $_POST["id"];
        $cancel_reason = $_POST["reason"];
        $title = $_POST["title"];
        $scheduledate = $_POST["scheduledate"];
        $scheduletime = $_POST["scheduletime"];

        // Get doctor info
        $useremail = $_SESSION["user"];
        $doc_result = $database->query("SELECT docid FROM doctor WHERE docemail='$useremail'");
        $docid = $doc_result->fetch_assoc()["docid"];

        // Get current timestamp
        $cancelled_at = date('Y-m-d H:i:s');

        // Update session status to cancelled instead of deleting
        $sql = $database->query("UPDATE schedule SET
            status='cancelled',
            cancellation_reason='$cancel_reason',
            cancelled_at='$cancelled_at',
            cancelled_by='$docid'
            WHERE scheduleid='$id'");

        // Also log the cancellation in the separate table
        $log_sql = $database->query("INSERT INTO session_cancellations
            (scheduleid, cancelled_by, cancellation_reason, original_date, original_time, doctor_id, session_title)
            VALUES ('$id', '$docid', '$cancel_reason', '$scheduledate', '$scheduletime', '$docid', '$title')");

        if($sql && $log_sql){
            // Show success message
            echo '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Cancellation Successful</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                        margin: 0;
                        padding: 20px;
                        min-height: 100vh;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    }
                    .success-box {
                        background: white;
                        padding: 40px;
                        border-radius: 20px;
                        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
                        max-width: 500px;
                        width: 100%;
                        text-align: center;
                    }
                    .success-icon {
                        width: 80px;
                        height: 80px;
                        background: #28a745;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        margin: 0 auto 20px;
                    }
                    .success-icon::before {
                        content: "✓";
                        color: white;
                        font-size: 40px;
                        font-weight: bold;
                    }
                    .header {
                        margin-bottom: 20px;
                    }
                    .header h2 {
                        color: #28a745;
                        margin-bottom: 10px;
                    }
                    .reason-display {
                        background: #f8f9fa;
                        padding: 15px;
                        border-radius: 10px;
                        margin: 20px 0;
                        text-align: left;
                    }
                    .reason-title {
                        font-weight: bold;
                        color: #495057;
                        margin-bottom: 8px;
                    }
                    .reason-text {
                        color: #6c757d;
                        line-height: 1.5;
                    }
                    .btn {
                        display: inline-block;
                        padding: 12px 30px;
                        background-color: #007bff;
                        color: white;
                        text-decoration: none;
                        border-radius: 8px;
                        font-size: 16px;
                        font-weight: 500;
                        transition: all 0.3s ease;
                        margin-top: 20px;
                    }
                    .btn:hover {
                        background-color: #0056b3;
                        transform: translateY(-2px);
                    }
                </style>
            </head>
            <body>
                <div class="success-box">
                    <div class="success-icon"></div>
                    <div class="header">
                        <h2>Session Cancelled Successfully</h2>
                        <p>The session has been cancelled and patients have been notified</p>
                    </div>

                    <div class="reason-display">
                        <div class="reason-title">Cancellation Reason:</div>
                        <div class="reason-text">'.htmlspecialchars($cancel_reason).'</div>
                    </div>

                    <p><strong>Session Details:</strong></p>
                    <p>Title: '.htmlspecialchars($title).'</p>
                    <p>Date: '.htmlspecialchars($scheduledate).' at '.htmlspecialchars($scheduletime).'</p>

                    <a href="schedule.php" class="btn">Return to Sessions</a>
                </div>
            </body>
            </html>';
        } else {
            echo "<script>alert('Error cancelling session. Please try again.'); window.location.href='schedule.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid request'); window.location.href='schedule.php';</script>";
    }

?>
