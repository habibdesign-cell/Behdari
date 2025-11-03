<?php
// Start the session
include("include/sql.php");
include("include/replace.php");
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = md5($_POST['password']);
// Validate input
    if (empty($username) || empty($password)) {
        $error_message = "Please fill in both fields.";
    } else {
        // Fetch user from the database
        $stmt = $pdo->prepare("SELECT code, username, password_hash FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify password
        if ($user && $password===$user['password_hash']) {
            // Set session variables
            $_SESSION['user_id'] = $user['code'];
            $_SESSION['username'] = $user['username'];
            $user_id = $_SESSION['user_id'];
            $code = $user['code'];
            $login_date = translatenowDate();
            $login_time= date('H:i');
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
            //Saving Login Records---------------------------------------------------------------
            $stmt_login = $pdo->prepare("INSERT INTO user_login_details (code, login_date, login_time, ip_address, user_agent) VALUES (?, ?, ?, ?, ?)");
            $stmt_login->execute([$code, $login_date, $login_time, $ip_address, $user_agent]);
            //Saving End---------------------------------------------------------------
            header("Location: check_access.php");
        } else {
            $error_message = "نام کاربری یا رمز عبور اشتباه است.";
        }
    }
  }
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/context.css" rel="stylesheet">
    <link href="css/Style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/persian-date/dist/persian-date.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/persian-datepicker/dist/js/persian-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/persian-datepicker/dist/css/persian-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.ui.position.js"></script>
    <script src="js/context.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="container-fluid d-lg-block d-sm-flex justify-content-center h-100 position-fixed">
      <div class="row d-flex h-100 justify-content-center">
        <div class="animation-fade col px-5 mx-5 m-auto justify-content-center d-flex flex-column">
          <form class="d-flex col-lg-6 flex-column" action="index.php" method="POST">
            <p class="col display-1 mb-4">ورود</p>
            <input name="username" type="text" class="form-control-simple" placeholder="نام کاربری">
            <input name="password" type="password" class="form-control-simple mt-3" placeholder="کلمه عبور">
            <?php if (isset($error_message)): ?>
              <?php alert('نام کاربری یا کلمه عبور اشتباه است.','warning'); ?>
            <?php endif; ?>
            <button class="mt-3">ورود</button>
          </form>

        </div>
        <div class="col p-0 d-none d-lg-flex">
          <img src="img/picture.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>
    <div class="fixed-bottom base p-3 w-100 justify-content-center text-center d-flex flex-column fb-16">
      تمام حقوق این پروژه محفوظ است.
      همکاری تیم طراحی سایت توازن و سرهنگ پزشک رضا صفاری
      <i class=" fb-16 g60">تیپ 328 متحرک هجومی نزاجا</i>
    </div>
  </body>
</html>
