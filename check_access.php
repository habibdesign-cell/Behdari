<?php
include("include/sql.php");
include("include/replace.php");
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
$user_id = $_SESSION['user_id'];



try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}


//role fetching---------------------------------------------------------------
$stmt_role = $conn->prepare("SELECT * FROM permissions Where user_id = $user_id");
$stmt_role->execute();
$permission = $stmt_role->fetch(PDO::FETCH_ASSOC);
$_SESSION = $permission;
//fetching End---------------------------------------------------------------

if($_SESSION['dashboard']==1) {
  header("Location: dashboard.php");
}elseif($_SESSION['personnel']==1) {
  header("Location: personnel.php");
}elseif($_SESSION['psichology']==1) {
  header("Location: psichology.php");
}elseif($_SESSION['pharmacy']==1) {
  header("Location: pharmacy.php");
}elseif($_SESSION['repository']==1) {
  header("Location: repository.php");
}elseif($_SESSION['setting']==1) {
  header("Location: setting.php");
}
?>
