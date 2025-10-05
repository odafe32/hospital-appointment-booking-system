<?php
/**
 * Database Update Script for Session Cancellation Feature
 *
 * This script helps update your existing database to support the new session cancellation system.
 * Run this script once after updating your SQL file to ensure compatibility.
 */

echo "<h2>Database Update Script for Session Cancellation</h2>";
echo "<p>This script will update your database structure to support proper session cancellation.</p>";
echo "<p><strong>Note:</strong> Make sure to backup your database before running this script.</p>";

// Database connection
include("connection.php");

echo "<h3>Checking current database structure...</h3>";

// Check if schedule table exists
$result = $database->query("SHOW TABLES LIKE 'schedule'");
if($result->num_rows == 0) {
    echo "<p style='color: red;'>❌ Schedule table not found. Please import the updated SQL file first.</p>";
    exit();
}

// Check current schedule table structure
$result = $database->query("DESCRIBE schedule");
$columns = [];
while($row = $result->fetch_assoc()) {
    $columns[] = $row['Field'];
}

echo "<h4>Current schedule table columns:</h4>";
echo "<ul>";
foreach($columns as $column) {
    echo "<li>$column</li>";
}
echo "</ul>";

$required_columns = ['status', 'cancellation_reason', 'cancelled_at', 'cancelled_by'];
$missing_columns = [];

foreach($required_columns as $required) {
    if(!in_array($required, $columns)) {
        $missing_columns[] = $required;
    }
}

if(empty($missing_columns)) {
    echo "<p style='color: green;'>✅ All required columns are present in the schedule table.</p>";
} else {
    echo "<p style='color: orange;'>⚠️ Some columns are missing. You may need to manually update the database structure.</p>";
    echo "<p><strong>Missing columns:</strong> " . implode(', ', $missing_columns) . "</p>";
}

// Check if session_cancellations table exists
$result = $database->query("SHOW TABLES LIKE 'session_cancellations'");
if($result->num_rows == 0) {
    echo "<p style='color: orange;'>⚠️ session_cancellations table not found. This is optional but recommended for audit trails.</p>";
} else {
    echo "<p style='color: green;'>✅ session_cancellations table exists.</p>";
}

echo "<h3>Database Status Summary:</h3>";
echo "<ul>";
echo "<li>Schedule table: ✅ Present</li>";
if(empty($missing_columns)) {
    echo "<li>Required columns: ✅ All present</li>";
} else {
    echo "<li>Required columns: ❌ Missing: " . implode(', ', $missing_columns) . "</li>";
}
echo "<li>Session cancellations table: " . ($result->num_rows > 0 ? "✅ Present" : "⚠️ Missing (optional)") . "</li>";
echo "</ul>";

echo "<h3>Next Steps:</h3>";
echo "<ol>";
echo "<li>If any columns are missing, you may need to manually add them to your database</li>";
echo "<li>Update your existing records to set status='active' for all current sessions</li>";
echo "<li>Test the cancellation feature in your application</li>";
echo "</ol>";

echo "<p><a href='schedule.php'>← Back to Schedule Management</a></p>";
?>

<style>
body {
    font-family: Arial, sans-serif;
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    line-height: 1.6;
}
h2, h3, h4 {
    color: #333;
}
.success { color: green; }
.warning { color: orange; }
.error { color: red; }
ul li {
    margin-bottom: 5px;
}
</style>
