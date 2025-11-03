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

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}


$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");
// Query to fetch data from the table
$table_name = $_GET['name'];

if ($table_name) {
  if($table_name==='drugs'){
    $query = "SELECT * FROM $table_name";
    $result = $conn->query($query);
  $custom_columns = [
    'name' => 'نام',
    'code' => 'شماره', // Replace with your custom title
    'organization_number' => 'سازمانی', // Replace with your custom title
    'real_number' => 'موجودی' // Replace with your custom title
    // Add more columns as needed
];}elseif($table_name==='repository'){
  $query = "SELECT * FROM $table_name";
  $result = $conn->query($query);
  $custom_columns = [
    'name' => 'نام جنس',
    'code' => 'کد جنس', // Replace with your custom title
    'organization_number' => 'سازمانی', // Replace with your custom title
    'real_number' => 'موجودی',
    'burrow_number' => 'قرض', // Replace with your custom title
    'repository' => 'انبار (1 سررشته داری و 2 تجهیزات پزشکی)'
    // Add more columns as needed
  ];
}elseif($table_name==='psichology'){
  $query = "SELECT * FROM $table_name";
  $result = $conn->query($query);
  $custom_columns = [
    'date' => 'تاریخ',
    'guards' => 'مصاحبه پاسدار و زاغه', // Replace with your custom title
    'cadre_interview' => 'مشاوره پایور', // Replace with your custom title
    'soldier_interview' => 'مشاوره وظیفه',
    'drivers' => 'مصاحبه رانندگان', // Replace with your custom title
    'dispatch' => 'اعزام به سنندج و تهران', // Replace with your custom title
    'groupb' => 'پرسنل تحت اقدام', // Replace with your custom title
    'newbie' => 'جدید الورود',
    'education' => 'ساعات کلاس های آموزشی'
    // Add more columns as needed
  ];
}
// Set headers for CSV download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $table_name . '.csv"');

// Open output stream
$output = fopen('php://output', 'w');

// Add BOM (Byte Order Mark) for UTF-8 compatibility in Excel
fwrite($output, "\xEF\xBB\xBF");

// Write custom column titles to CSV
fputcsv($output, array_values($custom_columns));

// Fetch and write data rows
while ($row = $result->fetch_assoc()) {
    // Replace column names with custom titles (if needed)
    $row_data = [];
    foreach ($custom_columns as $column => $title) {
        $row_data[] = $row[$column];
    }
    fputcsv($output, $row_data);
}

// Close the output stream
fclose($output);
} else {
echo "No data found in the table.";
}

// Close the database connection
$conn->close();
 ?>
