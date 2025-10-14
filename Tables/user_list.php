<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../ClassAutoLoad.php'; // Include the autoloader

header('Content-Type: application/json');
global $SQL;
if (!$SQL) {
    echo json_encode(["data" => [], "error" => "Connection failed: " . $conn->connect_error]);
    exit();
}

if (isset($_POST['roleName'])) {
    $roleName = $_POST['roleName'];
    // You can use $roleName to modify your query if needed
    $users = $SQL->select_while("SELECT fullname, email, roleName FROM users JOIN roles USING(roleId) WHERE roleName = '$roleName'");
}else{
    $users = $SQL->select_while("SELECT fullname, email, roleName FROM users JOIN roles USING(roleId)");
}

$data = [];
if ($users) {
    $sn = 1;
   foreach($users as $row) {
        $row['sn'] = $sn++; // Add serial number to each row
        $values = array($row['sn'], $row['fullname'], $row['email'], $row['roleName']); // Prepare values in order
        $data[] = array_values($values); // Use array_values to ensure numeric indexing
    }
}

echo json_encode(["data" => $data]);