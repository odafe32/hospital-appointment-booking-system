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
        $cancel_reason = trim($_POST["cancel_reason"]);

        // Validate that reason is provided
        if(empty($cancel_reason)){
            echo "<script>alert('Please provide a reason for cancellation'); window.location.href='schedule.php';</script>";
            exit();
        }

        // Get session details for confirmation
        $result = $database->query("SELECT * FROM schedule WHERE scheduleid='$id'");
        if($result && $row = $result->fetch_assoc()){
            $title = $row["title"];
            $scheduledate = $row["scheduledate"];
            $scheduletime = $row["scheduletime"];

            echo '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Confirm Cancellation</title>
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
                    .confirmation-box {
                        background: white;
                        padding: 40px;
                        border-radius: 20px;
                        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
                        max-width: 600px;
                        width: 100%;
                    }
                    .header {
                        text-align: center;
                        margin-bottom: 30px;
                    }
                    .header h2 {
                        color: #dc3545;
                        margin-bottom: 10px;
                    }
                    .session-details {
                        background: #f8f9fa;
                        padding: 20px;
                        border-radius: 10px;
                        margin-bottom: 20px;
                        border-left: 4px solid #dc3545;
                    }
                    .reason-box {
                        background: #fff3cd;
                        border: 1px solid #ffeaa7;
                        padding: 15px;
                        border-radius: 10px;
                        margin-bottom: 20px;
                    }
                    .reason-title {
                        font-weight: bold;
                        color: #856404;
                        margin-bottom: 8px;
                    }
                    .reason-text {
                        line-height: 1.5;
                    }
                    .button-group {
                        display: flex;
                        gap: 15px;
                        justify-content: center;
                    }
                    .btn {
                        padding: 12px 30px;
                        border: none;
                        border-radius: 8px;
                        cursor: pointer;
                        font-size: 16px;
                        font-weight: 500;
                        text-decoration: none;
                        display: inline-block;
                        transition: all 0.3s ease;
                    }
                    .btn-danger {
                        background-color: #dc3545;
                        color: white;
                    }
                    .btn-danger:hover {
                        background-color: #c82333;
                        transform: translateY(-2px);
                    }
                    .btn-secondary {
                        background-color: #6c757d;
                        color: white;
                    }
                    .btn-secondary:hover {
                        background-color: #5a6268;
                        transform: translateY(-2px);
                    }
                </style>
            </head>
            <body>
                <div class="confirmation-box">
                    <div class="header">
                        <h2>Confirm Session Cancellation</h2>
                        <p>Please review the details below before confirming cancellation</p>
                    </div>

                    <div class="session-details">
                        <h3>Session Details:</h3>
                        <p><strong>Title:</strong> '.htmlspecialchars($title).'</p>
                        <p><strong>Date:</strong> '.htmlspecialchars($scheduledate).'</p>
                        <p><strong>Time:</strong> '.htmlspecialchars($scheduletime).'</p>
                    </div>

                    <div class="reason-box">
                        <div class="reason-title">Cancellation Reason:</div>
                        <div class="reason-text">'.htmlspecialchars($cancel_reason).'</div>
                    </div>

                    <div class="button-group">
                        <form method="POST" action="confirm-delete-session.php" style="display: inline;">
                            <input type="hidden" name="id" value="'.$id.'">
                            <input type="hidden" name="reason" value="'.htmlspecialchars($cancel_reason).'">
                            <input type="hidden" name="title" value="'.htmlspecialchars($title).'">
                            <input type="hidden" name="scheduledate" value="'.htmlspecialchars($scheduledate).'">
                            <input type="hidden" name="scheduletime" value="'.htmlspecialchars($scheduletime).'">
                            <button type="submit" class="btn btn-danger">
                                Confirm Cancellation
                            </button>
                        </form>
                        <a href="schedule.php" class="btn btn-secondary">
                            Go Back
                        </a>
                    </div>
                </div>
            </body>
            </html>';
        } else {
            echo "<script>alert('Session not found'); window.location.href='schedule.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid request'); window.location.href='schedule.php';</script>";
    }

?>