
<?php

require_once "DBController.php";

$db_handle = new DBController();

function safe($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    die("Invalid record ID.");
}

// Retrieve existing record
$query = "SELECT * FROM persons WHERE id = " . (int)$id;
$records = $db_handle->executeQuery($query);

if (empty($records)) {
    die("Record not found.");
}

$person = $records[0];
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $fname = trim($_POST["fname"] ?? "");
    $mname = trim($_POST["mname"] ?? "");
    $lname = trim($_POST["lname"] ?? "");
    $age = $_POST["age"] ?? "";
    $gender = $_POST["gender"] ?? "";
    $email = trim($_POST["email"] ?? "");
    $address = trim($_POST["address"] ?? "");
    $contactNumber = trim($_POST["contactNumber"] ?? "");

    if ($fname === "" || strlen($fname) > 50) {
        $errors[] = "Invalid first name.";
    }

    if (strlen($mname) > 50) {
        $errors[] = "Invalid middle name.";
    }

    if ($lname === "" || strlen($lname) > 50) {
        $errors[] = "Invalid last name.";
    }

    if (filter_var($age, FILTER_VALIDATE_INT) === false ||
        $age < 1 || $age > 120) {
        $errors[] = "Invalid age.";
    }

    if (!in_array($gender, ["Male", "Female", "Other"], true)) {
        $errors[] = "Invalid gender.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }

    if ($address === "") {
        $errors[] = "Address is required.";
    }

    if (!preg_match('/^[0-9+\-\s()]{7,20}$/', $contactNumber)) {
        $errors[] = "Invalid contact number.";
    }

    if (empty($errors)) {

        $query = "UPDATE persons SET
            fname = ?,
            mname = ?,
            lname = ?,
            age = ?,
            gender = ?,
            email = ?,
            address = ?,
            contactNumber = ?
            WHERE id = ?";

        $result = $db_handle->executePrepared(
            $query,
            "sssissssi",
            [
                $fname,
                $mname,
                $lname,
                (int)$age,
                $gender,
                $email,
                $address,
                $contactNumber,
                (int)$id
            ]
        );

        if ($result) {
            header("Location: index.php?success=1");
            exit;
        }

        $errors[] = "Unable to update record.";
    }

    $person = array_merge($person, [
        "fname" => $fname,
        "mname" => $mname,
        "lname" => $lname,
        "age" => $age,
        "gender" => $gender,
        "email" => $email,
        "address" => $address,
        "contactNumber" => $contactNumber
    ]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Person</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>Edit Registered Person</h1>

    <?php foreach ($errors as $error): ?>
        <div class="error"><?= safe($error) ?></div>
    <?php endforeach; ?>

    <form method="POST">

        <label>First Name</label>
        <input type="text" name="fname"
        value="<?= safe($person["fname"]) ?>" required maxlength="50">

        <label>Middle Name</label>
        <input type="text" name="mname"
        value="<?= safe($person["mname"]) ?>" maxlength="50">

        <label>Last Name</label>
        <input type="text" name="lname"
        value="<?= safe($person["lname"]) ?>" required maxlength="50">

        <label>Age</label>
        <input type="number" name="age"
        value="<?= safe($person["age"]) ?>" min="1" max="120" required>

        <label>Gender</label>
        <select name="gender" required>
            <?php foreach (["Male", "Female", "Other"] as $g): ?>
                <option value="<?= $g ?>"
                    <?= $person["gender"] === $g ? "selected" : "" ?>>
                    <?= $g ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Email Address</label>
        <input type="email" name="email"
        value="<?= safe($person["email"]) ?>" required>

        <label>Address</label>
        <input type="text" name="address"
        value="<?= safe($person["address"]) ?>" required>

        <label>Contact Number</label>
        <input type="tel" name="contactNumber"
        value="<?= safe($person["contactNumber"]) ?>"
        pattern="[0-9+\-\s()]{7,20}" required>

        <button type="submit">Update Record</button>

        <a href="index.php" class="back-button">Cancel</a>

    </form>

</div>

</body>
</html>
