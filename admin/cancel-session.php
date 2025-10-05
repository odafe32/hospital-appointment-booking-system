<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }
    }else{
        header("location: ../login.php");
    }


    if($_GET){
        //import database
        include("../connection.php");
        $id = $_GET["id"];

        // Get session details before cancellation for logging
        $result = $database->query("SELECT * FROM schedule WHERE scheduleid='$id'");
        if($result && $row = $result->fetch_assoc()){
            $title = $row["title"];
            $scheduledate = $row["scheduledate"];
            $scheduletime = $row["scheduletime"];
            $docid = $row["docid"];

            // Get admin info for logging
            $adminemail = $_SESSION["user"];
            $admin_result = $database->query("SELECT aemail FROM admin WHERE aemail='$adminemail'");
            $admin_cancelled_by = $admin_result->fetch_assoc()["aemail"];

            // Get current timestamp
            $cancelled_at = date('Y-m-d H:i:s');

            // Update session status to cancelled instead of deleting
            $sql = $database->query("UPDATE schedule SET
                status='cancelled',
                cancellation_reason='Cancelled by Administrator',
                cancelled_at='$cancelled_at',
                cancelled_by='$docid'
                WHERE scheduleid='$id'");

            // Also log the cancellation in the separate table
            $log_sql = $database->query("INSERT INTO session_cancellations
                (scheduleid, cancelled_by, cancellation_reason, original_date, original_time, doctor_id, session_title)
                VALUES ('$id', '0', 'Cancelled by Administrator ($admin_cancelled_by)', '$scheduledate', '$scheduletime', '$docid', '$title')");

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
                            <p>The session has been cancelled and the record has been preserved for audit purposes.</p>
                        </div>

                        <p><strong>Session Details:</strong></p>
                        <p>Title: '.htmlspecialchars($title).'</p>
                        <p>Date: '.htmlspecialchars($scheduledate).' at '.htmlspecialchars($scheduletime).'</p>
                        <p>Cancelled by: Administrator</p>

                        <a href="schedule.php" class="btn">Return to Schedule Management</a>
                    </div>
                </body>
                </html>';
            } else {
                echo "<script>alert('Error cancelling session. Please try again.'); window.location.href='schedule.php';</script>";
            }
        } else {
            echo "<script>alert('Session not found'); window.location.href='schedule.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid request'); window.location.href='schedule.php';</script>";
    }

?>
