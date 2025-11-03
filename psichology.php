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
if ($_SESSION['psichology']==0) {
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



$query = "SELECT * FROM psichology ORDER BY id DESC";
$stmt = $pdo->prepare($query);
$stmt->execute();
$reports = $stmt->fetchAll(PDO::FETCH_ASSOC);
$last_array = $reports[0];

$datez = [];
$groupbz = [];
$dispatchz = [];

foreach ($reports as $row) {
  $datez[] = $row['date']; // X-axis labels (dates)
  $groupbz[] = $row['groupb']; // X-axis labels (dates)
  $dispatchz[] = $row['dispatch']; // Y-axis values
}

?>

<html lang="fa" dir="rtl">
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/context.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="js/context.js"></script>
    <script src="js/menu.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/persian-date/dist/persian-date.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/persian-datepicker/dist/js/persian-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/persian-datepicker/dist/css/persian-datepicker.min.css">
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="container-fluid h-auto">
      <div class="row h-100">
        <div class="fixed-top animation-fade base d-lg-none d-flex flex-row w-100 justify-content-between">
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
                  <div class="fb-14 d-flex align-items-center g60 px-2 py-3 strokem">
                    <img class="mx-2" src="img/icon-dashboard.png" width="16px" height="16px" alt="">
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
                  <div class="fb-14 d-flex align-items-center primaryc px-2 py-3 strokem">
                    <img class="mx-2" src="img/icon-brain-active.png" width="16px" height="16px" alt="">
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
        <div class="menubg animation-fade w-50 col offcanvas offcanvas-end p-0" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
          <div class="d-flex flex-column col h-auto p-0">
              <div class="d-flex w-100 h-auto align-self-start flex-column">
                <?php if($_SESSION['dashboard']) : ?>
                  <a href="dashboard.php">
                    <div class="fb-14 d-flex align-items-center g60 px-2 py-3 stroke">
                      <img class="mx-2" src="img/icon-dashboard.png" width="16px" height="16px" alt="">
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
                    <div class="fb-14 d-flex align-items-center primaryc px-2 py-3 strokem">
                      <img class="mx-2" src="img/icon-brain-active.png" width="16px" height="16px" alt="">
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
        <div class="row col p-lg-5 p-3 m-lg-0 m-0 pt-5 mt-5 mt-lg-0 pt-lg-5">
          <div class="d-flex flex-column  animation-pop">
            <div class="row d-flex p-0 m-0 align-items-sm-baseline w-100 mb-3 justify-contet-between">
              <p class="col display-1">روانشناسی</p>
              <a class="col-lg-2 col w-25 me-3 p-0 ms-0" href="psichology_reports.php"><button class="w-100 m-0">گزارشات ماهیانه</button></a>
            </div>
            <div class="d-flex flex-lg-row flex-column w-100">
              <div class="col d-flex flex-row">
                <div class="col base ms-5">
                  <div class="d-flex pt-4 px-3">
                    <img class="ms-2" src="img/icon-user-p.png" width="24px" height="24px" alt="">
                    <p class="display-2">مشاوره پایور</p>
                  </div>
                <p class="display-3 ms-3 primaryc"><?php echo htmlspecialchars($last_array['cadre_interview']); ?></p>
                </div>
                <div class="col base ms-lg-5 ms-0">
                  <div class="d-flex pt-4 px-3">
                    <img class="ms-2" src="img/icon-officer.png" width="24px" height="24px" alt="">
                    <p class="display-2">مصاحبه وظیفه</p>
                  </div>
                <p class="display-3 ms-3 alertc"><?php echo htmlspecialchars($last_array['soldier_interview']); ?></p>
                </div>
              </div>
              <div class="col d-flex flex-row mt-lg-0 mt-3">
                <div class="col base ms-5">
                  <div class="d-flex pt-4 px-3">
                    <img class="ms-2" src="img/icon-doctor.png" width="24px" height="24px" alt="">
                    <p class="display-2">رانندگان تیپ</p>
                  </div>
                <p class="display-3 ms-3 successc"><?php echo htmlspecialchars($last_array['drivers']); ?></p>
                </div>
                <div class="col base">
                  <div class="d-flex pt-4 px-3">
                    <img class="ms-2" src="img/icon-soldier.png" width="24px" height="24px" alt="">
                    <p class="display-2">پاسدار و زاغه</p>
                  </div>
                <p class="display-3 ms-3 cautionc"><?php echo htmlspecialchars($last_array['guards']); ?>  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-5 p-0 w-100">
            <div class="col ms-lg-5 ms-0  animation-pop">
              <div class="row d-flex p-0 m-0 align-items-baseline w-100 justify-contet-between">
                <p class="col display-1 align-self-center">نمودار پرسنل تحت اقدام</p>
              </div>
              <div class="mt-3 base">
                <div id="areaChart" class="m-auto base py-5"></div>
              </div>
            </div>
            <div class="col mt-5 mt-lg-0 me-lg-5 me-0 animation-pop">
              <div class="col">
                <div class="row d-flex p-0 m-0 align-items-baseline w-100 justify-contet-between">
                  <p class="col display-1 align-self-center">نمودار اعزام به بیمارستان</p>
                </div>
                <div class="mt-3 base">
                  <div id="lineChart" class="m-auto base py-5"></div>
                </div>
              </div>
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
    <script>
    // Data for line chart
    const datez = <?php echo json_encode($datez); ?>;
    const groupbz = <?php echo json_encode($groupbz); ?>;
    const dispatchz = <?php echo json_encode($dispatchz); ?>;

    const lineChartData = [

    ];

    // Data for area chart
    const areaChartData = [

    ];

    // Line chart configuration
    const lineChartOptions = {
        chart: {
            type: 'area',
            height: 350
        },
        series: [{
            name: 'تعداد',
            data: dispatchz
        }],
        colors: ['#70A1FF'],
        xaxis: {
            categories: datez,
            labels: { rotate: -45 }
        },
        title: {
            text: 'اعزام پرسنل به بیمارستان صحرایی',
            align: 'left'
        },
        stroke: {
            curve: 'smooth',
            width: 2
        },
        dataLabels: {
            enabled: false
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: 'vertical',
                shadeIntensity: 0.5,
                gradientToColors: undefined,
                inverseColors: true,
                opacityFrom: 0.7,
                opacityTo: 0.2,
                stops: [0, 90, 100]
            }
          }
    };

    // Area chart configuration
    const areaChartOptions = {
        chart: {
            type: 'area',
            height: 350
        },
        series: [{
            name: 'تعداد',
            data: groupbz
        }],
        colors: ['#70A1FF'], // Different color for the area chart
        xaxis: {
            categories: datez,
            labels: { rotate: -45 }
        },
        title: {
            text: 'تعداد پرسنل گروه ب در گذر زمان',
            align: 'left'
        },
        stroke: {
            curve: 'smooth',
            width: 2
        },
        dataLabels: {
            enabled: false
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: 'vertical',
                shadeIntensity: 0.5,
                gradientToColors: undefined,
                inverseColors: true,
                opacityFrom: 0.7,
                opacityTo: 0.2,
                stops: [0, 90, 100]
            }
        },
    };

    // Render line chart
    const lineChart = new ApexCharts(document.querySelector("#lineChart"), lineChartOptions);
    lineChart.render();

    // Render area chart
    const areaChart = new ApexCharts(document.querySelector("#areaChart"), areaChartOptions);
    areaChart.render();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
