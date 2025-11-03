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

// Permission Check -----------------
if ($_SESSION['dashboard']==0) {
    header("Location: 404.php");
    exit();
}
//end --------------------------------


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

$query = "SELECT * FROM user_login_details INNER JOIN personnel ON user_login_details.code = personnel.code ORDER BY user_login_details.id DESC LIMIT 6";
$stmt = $pdo->prepare($query);
$stmt->execute();
$login_details = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query_pharmacy = "SELECT dr.status AS status, dr.old_number AS old_number ,dr.number AS number,dr.date AS date,dr.name AS drug_name,p.name AS user_name FROM drugs_reports dr JOIN personnel p ON dr.user_id = p.code ORDER BY dr.id DESC Limit 6;";
$stmt = $pdo->prepare($query_pharmacy);
$stmt->execute();
$pharmacy = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query_repository = "SELECT rr.status AS status, rr.code AS code, rr.date AS date, rr.number AS number, rr.old_number AS old_number, rr.burrow_number AS burrow_number, p.name AS user_name, r.name AS good_name FROM repository_reports rr JOIN personnel p ON rr.user_id = p.code JOIN repository r ON rr.code = r.code ORDER BY rr.id DESC LIMIT 6";
$stmt = $pdo->prepare($query_repository);
$stmt->execute();
$repository = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query_personnel= "SELECT * FROM personnel";
$stmt = $pdo->prepare($query_personnel);
$stmt->execute();
$personnel = $stmt->fetchAll(PDO::FETCH_ASSOC);
$personnel = count($personnel);

$query_psichology= "SELECT * FROM psichology ORDER BY id DESC LIMIT 1";
$stmt = $pdo->prepare($query_psichology);
$stmt->execute();
$psichology = $stmt->fetch(PDO::FETCH_ASSOC);
$newbie = $psichology['newbie'];

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
        <div class="animation-fade position-fixed d-flex flex-column col-1 h-auto menubg p-0 d-none d-lg-flex">
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
              <?php if($_SESSION['personnel']) : ?>
                <a href="personnel.php">
                  <div class="fb-14 d-flex align-items-center g60 px-2 py-3 strokem">
                    <img class="mx-2" src="img/icon-user.png" width="16px" height="16px" alt="">
                    پرسنل
                  </div>
                </a>
              <?php endif; ?>
              <?php if($_SESSION['psichology']) : ?>
                <a href="psichology.php">
                  <div class="fb-14 d-flex align-items-center g60 px-2 py-3 strokem">
                    <img class="mx-2" src="img/icon-brain.png" width="16px" height="16px" alt="">
                    روانشناسی
                  </div>
                </a>
              <?php endif; ?>
              <?php if($_SESSION['pharmacy']) : ?>
                <a href="pharmacy.php">
                  <div class="fb-14 d-flex align-items-center g60 px-2 py-3 strokem">
                    <img class="mx-2" src="img/icon-pill.png" width="16px" height="16px" alt="">
                    داروخانه
                  </div>
                </a>
              <?php endif; ?>
              <?php if($_SESSION['repository']) : ?>
                <a href="repository.php">
                  <div class="fb-14 d-flex align-items-center g60 px-2 py-3 strokem">
                    <img class="mx-2" src="img/icon-box.png" width="16px" height="16px" alt="">
                    انبار بهداری
                  </div>
                </a>
              <?php endif; ?>
            </div>
            <div class="d-flex w-100 h-auto align-self-end mt-auto flex-column">
              <?php if($_SESSION['setting']) : ?>
                <a href="setting.php">
                  <div class="fb-14 d-flex align-items-center g60 px-2 py-3 strokem">
                    <img class="mx-2" src="img/icon-setting.png" width="16px" height="16px" alt="">
                    تنظیمات
                  </div>
                </a>
              <?php endif; ?>
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
        <div class="animation-fade menubg w-50 col offcanvas offcanvas-end p-0" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
          <div class="d-flex flex-column col h-auto p-0">
              <div class="d-flex w-100 h-auto align-self-start flex-column">
                <?php if($_SESSION['dashboard']) : ?>
                  <a href="dashboard.php">
                    <div class="fb-14 d-flex align-items-center primaryc px-2 py-3 stroke">
                      <img class="mx-2" src="img/icon-dashboard-active.png" width="16px" height="16px" alt="">
                      داشبورد
                    </div>
                  </a>
                <?php endif; ?>
                <?php if($_SESSION['personnel']) : ?>
                  <a href="personnel.php">
                    <div class="fb-14 d-flex align-items-center g60 px-2 py-3 strokem">
                      <img class="mx-2" src="img/icon-user.png" width="16px" height="16px" alt="">
                      پرسنل
                    </div>
                  </a>
                <?php endif; ?>
                <?php if($_SESSION['psichology']) : ?>
                  <a href="psichology.php">
                    <div class="fb-14 d-flex align-items-center g60 px-2 py-3 strokem">
                      <img class="mx-2" src="img/icon-brain.png" width="16px" height="16px" alt="">
                      روانشناسی
                    </div>
                  </a>
                <?php endif; ?>
                <?php if($_SESSION['pharmacy']) : ?>
                  <a href="pharmacy.php">
                    <div class="fb-14 d-flex align-items-center g60 px-2 py-3 strokem">
                      <img class="mx-2" src="img/icon-pill.png" width="16px" height="16px" alt="">
                      داروخانه
                    </div>
                  </a>
                <?php endif; ?>
                <?php if($_SESSION['repository']) : ?>
                  <a href="repository.php">
                    <div class="fb-14 d-flex align-items-center g60 px-2 py-3 strokem">
                      <img class="mx-2" src="img/icon-box.png" width="16px" height="16px" alt="">
                      انبار بهداری
                    </div>
                  </a>
                <?php endif; ?>
              </div>
            </div>
            <div class="d-flex w-100 h-auto align-self-end mt-auto flex-column">
              <?php if($_SESSION['setting']) : ?>
                <a href="setting.php">
                  <div class="fb-14 d-flex align-items-center g60 px-2 py-3 strokem">
                    <img class="mx-2" src="img/icon-setting.png" width="16px" height="16px" alt="">
                    تنظیمات
                  </div>
                </a>
              <?php endif; ?>
              <a href="logout.php">
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
        <div class="row col p-lg-5 p-3 pt-5 mt-5 mt-lg-0 pt-lg-5">
          <div class=" animation-pop col-lg-6 d-flex flex-column">
            <p class="display-1 mb-lg-5 mb-3">داشبورد</p>
            <div class="row d-flex flex-lg-row ">
              <div class="col base ms-5 ">
                <div class="d-flex pt-4 px-3">
                  <img class="ms-2" src="img/icon-user-p.png" width="24px" height="24px" alt="">
                  <p class="display-2">پرسنل بهداری</p>
                </div>
              <p class="display-3 ms-3 primaryc"><?php echo htmlspecialchars($personnel); ?></p>
              </div>
              <div class="col base ms-lg-5 mt-lg-0">
                <div class="d-flex pt-4 px-3">
                  <img class="ms-2" src="img/icon-officer.png" width="24px" height="24px" alt="">
                  <p class="display-2">جدید الورود</p>
                </div>
              <p class="display-3 ms-3 alertc"><?php echo htmlspecialchars($newbie); ?></p>
              </div>
            </div>
            <div class="row d-flex flex-lg-row flex-column mb-3 mt-3 ">
              <div class="col base-support ms-lg-5 p-4 ">
                <p class="display-2">پشتیبانی</p>
                <p class="fb-16">در صورت بروز هرگونه مشکل لطفا توسط یکی از راه های زیر با پشتیبانی تماس حاصل فرمایید.</p>
                <div class="row d-flex flex-row">
                  <a href="tel:+989037561506" class="ms-lg-3 col "><button type="button" class="btn-base w-100">شماره تماس : 09037561506</button></a>
                  <a href="mailto:h.bhrmi78@gmail.com" class="mx-lg-3 col mt-3 mt-lg-0"><button type="button" name="button" class=" w-100 btn-base2">ایمیل : h.bhrmi78@gmail.com</button></a>
                </div>
              </div>
            </div>
          </div>
          <div class=" animation-pop col col-lg-6 p-0">
            <p class="display-1 mb-lg-5 mt-3 mt-lg-0 mb-3">آخرین ورود کاربران</p>
            <table class="table base">
              <thead class="thead-light">
                <tr style="LINE-HEIGHT:32px">
                  <th scope="col">نام کاربری</th>
                  <th scope="col">تاریخ</th>
                  <th scope="col">ساعت</th>
                  <th scope="col"> </th>
                </tr>
              </thead>
              <tbody>
                <?php if (count($login_details) > 0): ?>
                  <?php foreach ($login_details as $row): ?>
                    <tr class=" fb-16 g100" >
                      <td class=""><?php echo htmlspecialchars($row['name']); ?></td>
                      <td class=""><?php echo htmlspecialchars($row['login_date']); ?></td>
                      <td class=""><?php echo htmlspecialchars($row['login_time']); ?></td>
                      <td class="">
                      </td>
                    </tr>
                  <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="9" style="text-align: center;">مقداری جهت نمایش وجود ندارد.</td>
                    </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
          <div class="d-flex  animation-pop flex-lg-row flex-column col p-0 mt-lg-5">
            <div class="col ms-lg-5">
              <p class="display-1 mb-lg-5 mt-3 mt-lg-0 mb-3">آخرین تغییرات انبار بهداری</p>
              <table class="table base">
                <thead class="thead-light">
                  <tr style="LINE-HEIGHT:32px">
                    <th scope="col">جنس</th>
                    <th scope="col">شخص</th>
                    <th scope="col">تاریخ</th>
                    <th scope="col">وضعیت</th>
                    <th scope="col">موجودی جدید</th>
                    <th scope="col">موجودی قبلی</th>
                    <th scope="col"> </th>
                  </tr>
                </thead>
                <?php if (count($repository) > 0): ?>
                  <?php foreach ($repository as $row): ?>
                    <tr class=" fb-16 g100" >
                      <td class=""><?php echo htmlspecialchars($row['good_name']); ?></td>
                      <td class=""><?php echo htmlspecialchars($row['user_name']); ?></td>
                      <td class=""><?php echo htmlspecialchars($row['date']); ?></td>
                      <td class=""><span class="<?php if($row['status']== 'active'){echo 'sbadge' ;}elseif($row['status']== 'leave'){echo 'abadge' ;}else{echo 'cbadge' ;} ?> fb-14"><?php echo translateReport(htmlspecialchars($row['status'])); ?></span></td>
                      <td class=""><?php echo htmlspecialchars($row['number']); ?></td>
                      <td class=""><?php echo htmlspecialchars($row['old_number']); ?></td>
                      <td class=""></td>
                    </tr>
                  <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="9" style="text-align: center;">مقداری جهت نمایش وجود ندارد.</td>
                    </tr>
                <?php endif; ?>
              </table>
            </div>
            <div class="col animation-pop">
              <p class="display-1 mb-lg-5 mt-3 mt-lg-0 mb-3">آخرین تغییرات انبار دارویی</p>
              <table class="table base">
                <thead class="thead-light">
                  <tr style="LINE-HEIGHT:32px">
                    <th scope="col">دارو</th>
                    <th scope="col">شخص</th>
                    <th scope="col">تاریخ</th>
                    <th scope="col">وضعیت</th>
                    <th scope="col">موجودی جدید</th>
                    <th scope="col">موجودی قبلی</th>
                    <th scope="col"> </th>
                  </tr>
                </thead>
                <?php if (count($pharmacy) > 0): ?>
                  <?php foreach ($pharmacy as $row): ?>
                    <tr class=" fb-16 g100" >
                      <td class=""><?php echo htmlspecialchars($row['drug_name']); ?></td>
                      <td class=""><?php echo htmlspecialchars($row['user_name']); ?></td>
                      <td class=""><?php echo htmlspecialchars($row['date']); ?></td>
                      <td class=""><span class="<?php if($row['status']== 'active'){echo 'sbadge' ;}elseif($row['status']== 'leave'){echo 'abadge' ;}else{echo 'cbadge' ;} ?> fb-14"><?php echo translateReport(htmlspecialchars($row['status'])); ?></span></td>
                      <td class=""><?php echo htmlspecialchars($row['number']); ?></td>
                      <td class=""><?php echo htmlspecialchars($row['old_number']); ?></td>
                      <td class=""></td>
                    </tr>
                  <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="9" style="text-align: center;">مقداری جهت نمایش وجود ندارد.</td>
                    </tr>
                <?php endif; ?>
              </table>
            </div>
          </div>
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
