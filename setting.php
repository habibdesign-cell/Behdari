<?php
// Start the session
include("include/sql.php");
include("include/replace.php");
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Permission Check -----------------
if ($_SESSION['setting']==0) {
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


$conn = new mysqli($host, $user, $pass, $dbname);


$query2 = "SELECT * FROM personnel";
$stmt = $pdo->prepare($query2);
$stmt->execute();
$persons = $stmt->fetchAll(PDO::FETCH_ASSOC);


if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Prepare and execute the delete query
    $query = "DELETE FROM users WHERE code = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $delete_id]);

    $query2 = "DELETE FROM permissions WHERE user_id = :id";
    $stmt = $pdo->prepare($query2);
    $stmt->execute(['id' => $delete_id]);

    // Redirect back to the personnel list
    header("Location: setting.php");
    exit();
}


if (isset($_GET['id'])) {
  $user = $_GET['id'];
  $sql = "SELECT * FROM permissions WHERE user_id=$user";
  $result = $conn->query($sql);
  $person_permission = $result->fetch_assoc();

  $sql2 = "SELECT * FROM users WHERE code=$user";
  $result = $conn->query($sql2);
  $person_login= $result->fetch_assoc();
}

// Handle form submission for adding or updating a drug
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['users'];
    if(isset($_GET['id'])){
      $user = $_GET['id'];
    }
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $psichology = $_POST['psichology'];
    $personnel = $_POST['personnel'];
    $pharmacy = $_POST['pharmacy'];
    $repository = $_POST['repository'];
    $sql = "SELECT * FROM users WHERE code=$user";
    $result = $conn->query($sql);
    $person_set= $result->fetch_assoc();
    if (empty($person_set)) {
        // Add new drug
        $sql1 = "INSERT INTO users (code, username, password_hash)
                VALUES ('$user', '$username', '$password')";
        $sql2 = "INSERT INTO permissions (user_id, dashboard, personnel, psichology, pharmacy, repository, setting)
                VALUES ('$user', '0', '$personnel', '$psichology', '$pharmacy', '$repository', '0')";
        $success_message = "New drug added successfully!";
    } else {

        // Update existing drug
        $sql1 = "UPDATE users SET
                code='$user',
                username='$username'
                WHERE code='$user'";
        $sql2 = "UPDATE permissions SET
                user_id='$user',
                personnel='$personnel',
                pharmacy='$pharmacy',
                repository='$repository',
                psichology='$psichology'
                WHERE user_id='$user'";
        $success_message = "Drug updated successfully!";
    }
    if ($conn->query($sql1) === TRUE AND $conn->query($sql2) === TRUE) {
        header("Location: setting.php");
    } else {
        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

// Search and Pagination -------------------------------------------------------<
// Define the number of rows per page
$rows_per_page = 6;
// Get the current page number from the URL (default to 1 if not set)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) {
    $page = 1;
}
// Calculate the offset for the SQL query
$offset = ($page - 1) * $rows_per_page;

// Query to fetch total number of rows in the table
$table_name = 'users';
$count_query = "SELECT COUNT(*) as total FROM $table_name";
$count_result = $conn->query($count_query);
$total_rows = $count_result->fetch_assoc()['total'];

// Calculate the total number of pages
$total_pages = ceil($total_rows / $rows_per_page);
// End of Pagination -----------------------------------------------------------<
// Query to fetch data for the current page
if(isset($_GET['search'])){
  $search_term = $_GET['search'];
  // SQL query to search for the drug
  $sql = "SELECT * FROM personnel WHERE name LIKE '%$search_term%' OR city LIKE '%$search_term%' OR code LIKE '%$search_term%' OR personnel_code LIKE '%$search_term%' OR phone LIKE '%$search_term%'";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $personnel = $stmt->fetchAll(PDO::FETCH_ASSOC);
}else{
  $query = "SELECT * FROM users LEFT JOIN personnel ON users.code=personnel.code LIMIT 10 OFFSET $offset";
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  $personnel = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// End of Search ---------------------------------------------------------------<
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
        <div class="position-fixed  animation-fade d-flex flex-column col-1 h-auto menubg p-0 d-none d-lg-flex">
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
                  <div class="fb-14 d-flex align-items-center primaryc px-2 py-3 strokem">
                    <img class="mx-2" src="img/icon-setting-active.png" width="16px" height="16px" alt="">
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
        <div class="menubg w-50 col offcanvas offcanvas-end p-0" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
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
                  <div class="fb-14 d-flex align-items-center primaryc px-2 py-3 strokem">
                    <img class="mx-2" src="img/icon-setting-active.png" width="16px" height="16px" alt="">
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
        <div class="col col-lg-11 p-lg-5 p-3 pt-5 mt-5 mt-lg-0 pt-lg-5 animation-pop">
          <div class="row p-lg-0 p-3">
            <div class="row d-flex p-0 m-0 align-items-center mb-3">
              <p class="display-1 col align-content-center">تنظیمات</p>
              <div class="col d-flex justify-content-end p-0">
                <a class="w-lg-25 me-3 ms-3" href="setting.php"><button class="btn-type">رفرش صفحه</button></a>
                <button id="button-form" class="btn-type">بستن و نمایش فرم</button>
              </div>
            </div>
            <div class="col mb-3">
              <form method="POST" class=" animation-fade" action="setting.php<?php if(isset($_GET['id'])){echo '?id='.htmlspecialchars($person_login['code']);} ?>" id="form" style="<?php if(isset($_GET['id'])){echo "display:block;";}else{echo "display:none;";} ?>">
                <div class="d-flex flex-lg-row flex-column flex-row ">
                  <div class="input-group mt-lg-0 mt-3 ms-lg-3" style="min-width:300px;">
                    <label for="medal">پرسنل</label>
                    <select class="input-group-prepend w-100 form-control fb-14 g60 dropdown-toggle" name="users"  required>
                      <?php foreach ($persons as $person) {
                        if($_GET['id']==$person['code']){
                          echo '<option class="fb-14" value="'.$person['code'].'" selected>' .$person['name']. '</option>';
                        }else{
                          echo '<option class="fb-14" value="'.$person['code'].'">' .$person['name']. '</option>';
                        }
                      } ?>
                    </select>
                  </div>
                  <div class="ms-lg-3 mt-3 mt-lg-0 col">
                    <label for="username">نام کاربری</label>
                    <input value="<?php if(isset($_GET['id'])){echo htmlspecialchars($person_login['username']);} ?>" name="username" type="text" class="form-control-simple mt-lg-0 ms-lg-3" placeholder="قابل تغییر نمی باشد" required >
                  </div>
                  <?php if(!isset($_GET['id'])): ?>
                  <div class="ms-lg-3 mt-3 mt-lg-0 col">
                    <label for="password">رمز عبور</label>
                    <input value="" name="password" type="text" class="form-control-simple mt-lg-0 ms-lg-3" placeholder="غیرقابل مشاهده دوباره" required >
                  </div>
                <?php endif; ?>
                  <div class="input-group mt-lg-0 mt-3 ms-lg-3">
                    <label for="type">دسترسی به پرسنل</label>
                    <select class="input-group-prepend w-100 form-control fb-14 g60 dropdown-toggle" name="personnel"  value="<?php if(isset($_GET['id'])){echo htmlspecialchars($person_permission['personnel']);} ?>" required>
                      <option class="fb-14" value="0" <?php if(isset($_GET['id'])){if($person_permission['personnel']==0){echo "selected";}} ?>>❌ غیر فعال</option>
                      <option class="fb-14" value="1" <?php if(isset($_GET['id'])){if($person_permission['personnel']==1){echo "selected";}} ?>>✔️ فعال</option>
                    </select>
                  </div>
                  <div class="input-group mt-lg-0 mt-3 ms-lg-3">
                    <label for="type">دسترسی به روانشناسی</label>
                    <select class="input-group-prepend w-100 form-control fb-14 g60 dropdown-toggle" name="psichology"  value="<?php if(isset($_GET['id'])){echo htmlspecialchars($person_permission['psichology']);} ?>" required>
                      <option class="fb-14" value="0" <?php if(isset($_GET['id'])){if($person_permission['psichology']==0){echo "selected";}} ?>>❌ غیر فعال</option>
                      <option class="fb-14" value="1" <?php if(isset($_GET['id'])){if($person_permission['psichology']==1){echo "selected";}} ?>>✔️ فعال</option>
                    </select>
                  </div>
                  <div class="input-group mt-lg-0 mt-3 ms-lg-3">
                    <label for="type">دسترسی به داروخانه</label>
                    <select class="input-group-prepend w-100 form-control fb-14 g60 dropdown-toggle" name="pharmacy"  value="<?php if(isset($_GET['id'])){echo htmlspecialchars($person_permission['pharmacy']);} ?>" required>
                      <option class="fb-14" value="0" <?php if(isset($_GET['id'])){if($person_permission['pharmacy']==0){echo "selected";}} ?>>❌ غیر فعال</option>
                      <option class="fb-14" value="1" <?php if(isset($_GET['id'])){if($person_permission['pharmacy']==1){echo "selected";}} ?>>✔️ فعال</option>
                    </select>
                  </div>
                  <div class="input-group mt-lg-0 mt-3 ms-lg-0">
                    <label for="type">دسترسی به انبار</label>
                    <select class="input-group-prepend w-100 form-control fb-14 g60 dropdown-toggle" name="repository"  value="<?php if(isset($_GET['id'])){echo htmlspecialchars($person_permission['repository']);} ?>" required>
                      <option class="fb-14" value="0" <?php if(isset($_GET['id'])){if($person_permission['repository']==0){echo "selected";}} ?>>❌ غیر فعال</option>
                      <option class="fb-14" value="1" <?php if(isset($_GET['id'])){if($person_permission['repository']==1){echo "selected";}} ?>>✔️ فعال</option>
                    </select>
                  </div>
                  <button class="me-3 col h-50 align-self-end w-100 mt-lg-0 mt-3">تایید اطلاعات</button>
                </div>
              </form>
            </div>
            <div class="row d-flex p-0 m-0 justify-content-between">
              <div class="col p-0 align-content-center">
                <ul class="nav nav-pills mb-3 pe-0" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link g60 active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="true">همه پرسنل</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link g60" id="pills-cadre-tab" data-bs-toggle="pill" data-bs-target="#pills-cadre" type="button" role="tab" aria-controls="pills-cadre" aria-selected="false">پایور</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link g60" id="pills-soldier-tab" data-bs-toggle="pill" data-bs-target="#pills-soldier" type="button" role="tab" aria-controls="pills-soldier" aria-selected="false">وظیفه</button>
                  </li>
                </ul>
              </div>
              <div class="col-lg-2 col-5 p-0 ps-0 align-content-center">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text h-100" id="basic-addon1">
                      <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M6.99993 10.9999C7.52522 10.9999 8.04536 10.8965 8.53066 10.6954C9.01596 10.4944 9.45692 10.1998 9.82836 9.82836C10.1998 9.45692 10.4944 9.01596 10.6954 8.53066C10.8965 8.04536 10.9999 7.52522 10.9999 6.99993C10.9999 6.47464 10.8965 5.9545 10.6954 5.46919C10.4944 4.98389 10.1998 4.54294 9.82836 4.1715C9.45692 3.80007 9.01596 3.50543 8.53066 3.30441C8.04536 3.10339 7.52522 2.99993 6.99993 2.99993C5.93906 2.99993 4.92165 3.42136 4.1715 4.1715C3.42136 4.92165 2.99993 5.93906 2.99993 6.99993C2.99993 8.06079 3.42136 9.07821 4.1715 9.82836C4.92165 10.5785 5.93906 10.9999 6.99993 10.9999ZM11.2133 10.2706L13.5999 12.6573C13.6636 12.7188 13.7143 12.7924 13.7492 12.8738C13.7841 12.9551 13.8024 13.0426 13.8031 13.1311C13.8038 13.2197 13.7869 13.3074 13.7533 13.3893C13.7197 13.4712 13.6702 13.5456 13.6075 13.6082C13.5449 13.6707 13.4704 13.7202 13.3885 13.7537C13.3065 13.7871 13.2187 13.8039 13.1302 13.8031C13.0417 13.8023 12.9542 13.7838 12.8729 13.7488C12.7916 13.7138 12.718 13.663 12.6566 13.5993L10.2699 11.2126C9.19824 12.0445 7.84979 12.4367 6.4991 12.3094C5.1484 12.1821 3.897 11.5448 2.99963 10.5273C2.10226 9.5098 1.62639 8.18856 1.66888 6.83254C1.71137 5.47653 2.26904 4.18768 3.22836 3.22836C4.18768 2.26904 5.47653 1.71137 6.83254 1.66888C8.18856 1.62639 9.5098 2.10226 10.5273 2.99963C11.5448 3.897 12.1821 5.1484 12.3094 6.4991C12.4367 7.84979 12.0445 9.19824 11.2126 10.2699L11.2133 10.2706Z" fill="#757575"/>
                      </svg>
                    </span>
                  </div>
                  <input type="text" class="form-control" placeholder="جستجو ..." aria-label="Username" aria-describedby="basic-addon1">
                </div>
              </div>
            </div>
            <div class="col p-0 d-flex flex-column d-lg-none" id="responsive-table">
              <?php if (count($personnel) > 0): ?>
                <?php foreach ($personnel as $row): ?>
              <div class="col flex-column base mt-3 responsive-row" data-status='<?php echo $row["type"]; ?>'>
                <div class="px-3 py-2 d-flex flex-row justify-content-between bottom-line">
                  <span class="flex-start fb-16 g60">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                  </span>
                  <span class="flex-end fb-16 g100 action-cell">
                    <div class="action-menu">
                      <svg class="dropbtn menu-btn" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M3.3335 10C2.80306 10 2.29436 9.78929 1.91928 9.41421C1.54421 9.03914 1.3335 8.53043 1.3335 8C1.3335 7.46957 1.54421 6.96086 1.91928 6.58579C2.29436 6.21071 2.80306 6 3.3335 6C3.86393 6 4.37264 6.21071 4.74771 6.58579C5.12278 6.96086 5.3335 7.46957 5.3335 8C5.3335 8.53043 5.12278 9.03914 4.74771 9.41421C4.37264 9.78929 3.86393 10 3.3335 10ZM12.6668 10C12.1364 10 11.6277 9.78929 11.2526 9.41421C10.8775 9.03914 10.6668 8.53043 10.6668 8C10.6668 7.46957 10.8775 6.96086 11.2526 6.58579C11.6277 6.21071 12.1364 6 12.6668 6C13.1973 6 13.706 6.21071 14.081 6.58579C14.4561 6.96086 14.6668 7.46957 14.6668 8C14.6668 8.53043 14.4561 9.03914 14.081 9.41421C13.706 9.78929 13.1973 10 12.6668 10ZM8.00016 10C7.46973 10 6.96102 9.78929 6.58595 9.41421C6.21088 9.03914 6.00016 8.53043 6.00016 8C6.00016 7.46957 6.21088 6.96086 6.58595 6.58579C6.96102 6.21071 7.46973 6 8.00016 6C8.5306 6 9.0393 6.21071 9.41438 6.58579C9.78945 6.96086 10.0002 7.46957 10.0002 8C10.0002 8.53043 9.78945 9.03914 9.41438 9.41421C9.0393 9.78929 8.5306 10 8.00016 10Z" fill="#697077"/>
                      </svg>
                        <ul class="menu-options">
                            <li><a class="fb-14 dropdown-section" href="setting.php?id=<?php echo $row['code']; ?>">ویرایش</a></li>
                            <li><a class="fb-14 dropdown-del" href="setting.php?delete_id=<?php echo $row['code']; ?>"  onclick="return confirm('آیا از حذف این مورد مطمئن هستید?');">حذف</a></li>
                        </ul>
                    </div>
                  </span>
                </div>
                <div class="px-3 py-2 d-flex flex-row justify-content-between bottom-line">
                  <span class="flex-start fb-16 g60">نام و نشان</span>
                  <span class="flex-end fb-16 g100"><?php echo htmlspecialchars($row['name']); ?></span>
                </div>
                <div class="px-3 py-2 d-flex flex-row justify-content-between bottom-line">
                  <span class="flex-start fb-14 g60">درجه</span>
                  <span class="badgemedal flex-end fb-16 g100"><?php echo translateMedal(htmlspecialchars($row['medal'])); ?></span>
                </div>
                <div class="px-3 py-2 d-flex flex-row justify-content-between bottom-line">
                  <span class="flex-start fb-14 g60">کدملی</span>
                  <span class="flex-end fb-16 g100"><?php echo htmlspecialchars($row['code']); ?></span>
                </div>
                <div class="px-3 py-2 d-flex flex-row justify-content-between bottom-line">
                  <span class="flex-start fb-16 g60">نام کاربری</span>
                  <span class="flex-end cbadge fb-16 g100"><?php echo htmlspecialchars($row['username']); ?></span>
                </div>
                <div class="px-3 py-2 d-flex flex-row justify-content-between bottom-line">
                  <span class="flex-start fb-16 g60">تلفن</span>
                  <span class="flex-end fb-16 g100"><?php echo htmlspecialchars($row['phone']); ?></span>
                </div>
              </div>

            <?php endforeach; ?>
              <?php else: ?>
              <tr>
                <td colspan="9" style="text-align: center;">No personnel records found.</td>
              </tr>
              <?php endif; ?>
            </div>
            <table class="table base d-non" id="personnel-table">
              <thead class="thead-light">
                <tr style="LINE-HEIGHT:32px">
                  <th scope="col"></th>
                  <th scope="col">نام و نشان</th>
                  <th scope="col">درجه</th>
                  <th scope="col">کد ملی</th>
                  <th scope="col">نام کاربری</th>
                  <th scope="col">تلفن</th>
                  <th scope="col"> </th>
                </tr>
              </thead>
              <tbody>
                <?php if (count($personnel) > 0): ?>
                  <?php foreach ($personnel as $row):
                    echo "<tr class='fb-16 g100' data-status='{$row['type']}'>"
                    ?>
                  <th>
                   <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                  </th>
                  <td class="">
                    <?php echo htmlspecialchars($row['name']); ?>
                  </td>
                  <td class="">
                   <span class="badgemedal fb-14"><?php echo translateMedal(htmlspecialchars($row['medal'])); ?></span>
                  </td>
                  <td class=""><?php echo htmlspecialchars($row['code']); ?></td>
                  <td class=""><?php echo htmlspecialchars($row['username']); ?></td>
                  <td class=""><?php echo htmlspecialchars($row['phone']); ?></td>
                  <td class="action-cell">
                        <div class="action-menu">
                          <svg class="dropbtn menu-btn" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M3.3335 10C2.80306 10 2.29436 9.78929 1.91928 9.41421C1.54421 9.03914 1.3335 8.53043 1.3335 8C1.3335 7.46957 1.54421 6.96086 1.91928 6.58579C2.29436 6.21071 2.80306 6 3.3335 6C3.86393 6 4.37264 6.21071 4.74771 6.58579C5.12278 6.96086 5.3335 7.46957 5.3335 8C5.3335 8.53043 5.12278 9.03914 4.74771 9.41421C4.37264 9.78929 3.86393 10 3.3335 10ZM12.6668 10C12.1364 10 11.6277 9.78929 11.2526 9.41421C10.8775 9.03914 10.6668 8.53043 10.6668 8C10.6668 7.46957 10.8775 6.96086 11.2526 6.58579C11.6277 6.21071 12.1364 6 12.6668 6C13.1973 6 13.706 6.21071 14.081 6.58579C14.4561 6.96086 14.6668 7.46957 14.6668 8C14.6668 8.53043 14.4561 9.03914 14.081 9.41421C13.706 9.78929 13.1973 10 12.6668 10ZM8.00016 10C7.46973 10 6.96102 9.78929 6.58595 9.41421C6.21088 9.03914 6.00016 8.53043 6.00016 8C6.00016 7.46957 6.21088 6.96086 6.58595 6.58579C6.96102 6.21071 7.46973 6 8.00016 6C8.5306 6 9.0393 6.21071 9.41438 6.58579C9.78945 6.96086 10.0002 7.46957 10.0002 8C10.0002 8.53043 9.78945 9.03914 9.41438 9.41421C9.0393 9.78929 8.5306 10 8.00016 10Z" fill="#697077"/>
                          </svg>
                            <ul class="menu-options">
                                <li><a class="fb-14 dropdown-section" href="setting.php?id=<?php echo $row['code']; ?>">ویرایش</a></li>
                                <li><a class="fb-14 dropdown-del" href="setting.php?delete_id=<?php echo $row['code']; ?>" onclick="return confirm('Are you sure you want to delete this record?');">حذف</a></li>
                            </ul>
                        </div>
                  </td>
                </tr>
              <?php endforeach; ?>
                <?php else: ?>
                <tr>
                  <td colspan="9" style="text-align: center;">No personnel records found.</td>
                </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
          <?php if(!isset($_GET['search'])) : ?>
          <div class="row mt-4">
              <?php
                // Display pagination links
                echo '<nav aria-label="..."><ul class="pagination  justify-content-center">';
                if ($page > 1) {
                    echo '<a href="?page=' . ($page - 1) . '"><li class="page-item disabled"><span class="page-link">قبلی</span></li></a>';
                }

                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $page) {
                        echo '<li class="page-item active"><span class="page-link">'.$i.'</span></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
                    }
                }

                if ($page < $total_pages) {
                    echo '<a href="?page=' . ($page + 1) . '"><li class="page-item disabled"><span class="page-link">بعدی</span></li></a>';
                }
                echo "</ul></nav>";
               ?>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <script src="js/farsinum.js"></script>
    <script type="text/javascript">
    $("#button-form").click(function(){
      $("#form").toggle();
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const pills = document.querySelectorAll('.nav-link');
            const tableRows = document.querySelectorAll('#personnel-table tbody tr');
            const responsiveRows = document.querySelectorAll('#responsive-table .responsive-row');

            pills.forEach(pill => {
                pill.addEventListener('click', function () {
                    const filter = this.getAttribute('data-bs-target').replace('#pills-', '');

                    tableRows.forEach(row => {
                        const status = row.getAttribute('data-status').toLowerCase();
                        if (filter === 'all' || status === filter) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    responsiveRows.forEach(row => {
                        const status = row.getAttribute('data-status').toLowerCase();
                        if (filter === 'all' || status === filter) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
  </body>
</html>
