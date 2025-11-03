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



try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

//Fetching Loged in user data -----------------------------
$code = $_SESSION['user_id'];
$query_user = "SELECT * FROM personnel WHERE code=$code";
$stmt_user = $pdo->prepare($query_user);
$stmt_user->execute();
$user_information = $stmt_user->fetch(PDO::FETCH_ASSOC);
//end of part ----------------------------------------------

$query = "SELECT *  FROM user_login_details";
$stmt = $pdo->prepare($query);
$stmt->execute();
$login_details = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/context.css" rel="stylesheet">
    <script src="js/context.js"></script>
    <script src="js/menu.js"></script>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="container-fluid h-auto">
      <div class="row h-auto">
        <div class="fixed-top base d-lg-none d-flex flex-row w-100 justify-content-between">
          <div class="offcanvas-header  justify-content-between d-flex">
              <div class="d-flex flex-row justify-content-center align-items-middle align-self-start p-0">
                <img src="<?php echo translateMedalIMG($user_information['medal']); ?>" class="rounded-pill ms-2" width="48px" height="48px" alt="Profile">
                <div class="d-flex flex-column px-2">
                  <p class="my-1 fb-14"><?php echo $user_information['name']; ?></p>
                  <p class="fb-12 m-0"><?php echo translateMedal($user_information['medal']);?></p>
                </div>
              </div>
          </div>
          <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu" class="btn-menu p-2">
            <span class="fb-14">
              منو
              <svg class="me-1 ms-3" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M1.33325 8H14.6666" stroke="#697077" stroke-width="1.5"/>
              <path d="M1.33325 4H14.6666" stroke="#697077" stroke-width="1.5"/>
              <path d="M1.33325 12H14.6666" stroke="#697077" stroke-width="1.5"/>
              <path d="M1.33325 8H14.6666" stroke="#697077" stroke-width="1.5"/>
              <path d="M14.6666 8H1.33325" stroke="#697077" stroke-width="1.5"/>
              </svg>
            </span>
          </button>
        </div>
        <!--
          Desktop menu is defined below
        -->
        <div class="position-fixed d-flex flex-column col-1 h-auto menubg p-0 d-none d-lg-flex">
          <div class="d-flex h-auto flex-column justify-content-center align-items-center align-self-start mx-auto my-3">
            <img src="<?php echo translateMedalIMG($user_information['medal']); ?>" class="rounded-pill mb-2" width="80px" height="80px" alt="Profile">
            <p class="my-1 fb-14"><?php echo $user_information['name'];?></p>
            <p class="fb-12"><?php echo translateMedal($user_information['medal']);?></p>
          </div>
            <div class="d-flex w-100 h-auto align-self-start flex-column">
              <?php if($_SESSION['dashboard']) : ?>
                <a href="dashboard.php">
                  <div class="fb-14 d-flex align-items-center primaryc px-2 py-3 strokem">
                    <img class="mx-2" src="img/icon-dashboard-active.png" width="16px" height="16px" alt="">
                    داشبورد
                  </div>
                </a>
              <?php endif; ?>
              <a href="personnel.php">
                <div class="fb-14 d-flex align-items-center g60 px-2 py-3 strokem">
                  <img class="mx-2" src="img/icon-user.png" width="16px" height="16px" alt="">
                  پرسنل
                </div>
              </a>
              <a href="#">
                <div class="fb-14 d-flex align-items-center g60 px-2 py-3 strokem">
                  <img class="mx-2" src="img/icon-brain.png" width="16px" height="16px" alt="">
                  روانشناسی
                </div>
              </a>
              <a href="#">
                <div class="fb-14 d-flex align-items-center g60 px-2 py-3 strokem">
                  <img class="mx-2" src="img/icon-pill.png" width="16px" height="16px" alt="">
                  داروخانه
                </div>
              </a>
              <a href="#">
                <div class="fb-14 d-flex align-items-center g60 px-2 py-3 strokem">
                  <img class="mx-2" src="img/icon-doc.png" width="16px" height="16px" alt="">
                  اداری
                </div>
              </a>
              <a href="#">
                <div class="fb-14 d-flex align-items-center g60 px-2 py-3 strokem">
                  <img class="mx-2" src="img/icon-box.png" width="16px" height="16px" alt="">
                  انبار بهداری
                </div>
              </a>
            </div>
            <div class="d-flex w-100 h-auto align-self-end mt-auto flex-column">
              <a href="#">
                <div class="fb-14 d-flex align-items-center g60 px-2 py-3 strokem">
                  <img class="mx-2" src="img/icon-setting.png" width="16px" height="16px" alt="">
                  تنظیمات
                </div>
              </a>
              <a href="logout.php">
                <div class="fb-14 d-flex align-items-center alertc px-2 py-3 strokem">
                  <img class="mx-2" src="img/icon-logout.png" width="16px" height="16px" alt="">
                  خروج
                </div>
              </a>
            </div>
        </div>
        <!--
          Mobile menu is defined below
        -->
        <div class="menubg w-50 col offcanvas offcanvas-end p-0" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
          <div class="d-flex flex-column col h-auto p-0">
              <div class="d-flex w-100 h-auto align-self-start flex-column">
                <a href="#">
                  <div class="fb-14 d-flex align-items-center primaryc px-2 py-3 stroke">
                    <img class="mx-2" src="img/icon-dashboard-active.png" width="16px" height="16px" alt="">
                    داشبورد
                  </div>
                </a>
                <a href="#">
                  <div class="fb-14 d-flex align-items-center g60 px-2 py-3 strokem">
                    <img class="mx-2" src="img/icon-user.png" width="16px" height="16px" alt="">
                    پرسنل
                  </div>
                </a>
                <a href="#">
                  <div class="fb-14 d-flex align-items-center g60 px-2 py-3 strokem">
                    <img class="mx-2" src="img/icon-brain.png" width="16px" height="16px" alt="">
                    روانشناسی
                  </div>
                </a>
                <a href="#">
                  <div class="fb-14 d-flex align-items-center g60 px-2 py-3 strokem">
                    <img class="mx-2" src="img/icon-pill.png" width="16px" height="16px" alt="">
                    داروخانه
                  </div>
                </a>
                <a href="#">
                  <div class="fb-14 d-flex align-items-center g60 px-2 py-3 strokem">
                    <img class="mx-2" src="img/icon-doc.png" width="16px" height="16px" alt="">
                    اداری
                  </div>
                </a>
                <a href="#">
                  <div class="fb-14 d-flex align-items-center g60 px-2 py-3 strokem">
                    <img class="mx-2" src="img/icon-box.png" width="16px" height="16px" alt="">
                    انبار بهداری
                  </div>
                </a>
              </div>
            </div>
            <div class="d-flex w-100 h-auto align-self-end mt-auto flex-column">
              <a href="#">
                <div class="fb-14 d-flex align-items-center g60 px-2 py-3 strokem">
                  <img class="mx-2" src="img/icon-setting.png" width="16px" height="16px" alt="">
                  تنظیمات
                </div>
              </a>
              <a href="#">
                <div class="fb-14 d-flex align-items-center alertc px-2 py-3 strokem">
                  <img class="mx-2" src="img/icon-logout.png" width="16px" height="16px" alt="">
                  خروج
                </div>
              </a>
            </div>
        </div>
        <div id="menu-overlay"></div>
        <div class="col-1 d-non">

        </div>
      </div>
    </div>
    <script type="text/javascript">

      const menu = document.getElementById('sliding-menu');
      const overlay = document.getElementById('menu-overlay');
      const menuButton = document.getElementById('menu-button');

      // Open menu
      menuButton.addEventListener('click', () => {
        menu.classList.add('open');
        overlay.classList.add('show');
      });

      // Close menu on overlay click
      overlay.addEventListener('click', () => {
        menu.classList.remove('open');
        overlay.classList.remove('show');
      });

    </script>
    <script src="js/farsinum.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
