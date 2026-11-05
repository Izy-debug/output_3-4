
<?php

require_once "DBController.php";

$db_handle = new DBController();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Invalid request method.");
}

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    die("Invalid record ID.");
}

$query = "DELETE FROM persons WHERE id = ?";

$result = $db_handle->executeDelete($query, (int)$id);

if ($result) {
    header("Location: index.php?deleted=1");
    exit;
}

die("Unable to delete record.");

?>
