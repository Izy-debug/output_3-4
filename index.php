<?php

require_once "DBController.php";

$db_handle = new DBController();

$errors = [];
$success = isset($_GET["success"]);

function safe($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}


if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["submit"])) {

    $data = $_GET;

} elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {

    $data = $_POST;

} else {

    $data = [];

}

if (!empty($data)) {

    $fname = trim($data["fname"] ?? "");
    $mname = trim($data["mname"] ?? "");
    $lname = trim($data["lname"] ?? "");
    $age = $data["age"] ?? "";
    $gender = $data["gender"] ?? "";
    $email = trim($data["email"] ?? "");
    $address = trim($data["address"] ?? "");
    $contactNumber = trim($data["contactNumber"] ?? "");


    if ($fname === "" || strlen($fname) > 50) {
        $errors[] = "Please enter a valid first name.";
    }

    if (strlen($mname) > 50) {
        $errors[] = "Middle name must not exceed 50 characters.";
    }

    if ($lname === "" || strlen($lname) > 50) {
        $errors[] = "Please enter a valid last name.";
    }

    if (
        filter_var($age, FILTER_VALIDATE_INT) === false ||
        $age < 1 || $age > 120
    ) {
        $errors[] = "Age must be between 1 and 120.";
    }

    if (!in_array($gender, ["Male", "Female", "Other"], true)) {
        $errors[] = "Please select a valid gender.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if ($address === "") {
        $errors[] = "Address is required.";
    }

    if (!preg_match('/^[0-9+\-\s()]{7,20}$/', $contactNumber)) {
        $errors[] = "Please enter a valid contact number.";
    }


    if (empty($errors)) {

        $query = "INSERT INTO persons
        (fname, mname, lname, age, gender, email, address, contactNumber)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $result = $db_handle->executePrepared(
            $query,
            "sssissss",
            [
                $fname,
                $mname,
                $lname,
                (int)$age,
                $gender,
                $email,
                $address,
                $contactNumber
            ]
        );

        if ($result) {

            header("Location: index.php?success=1");
            exit;

        } else {

            $errors[] = "Failed to save the record. Please try again.";

        }
    }
}


$query = "SELECT * FROM persons ORDER BY id DESC";

$persons = $db_handle->executeQuery($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PHP Output No. 1</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h1>PHP Output No. 1</h1>

    <p class="subtitle">
        Personal Information Registration System
    </p>

    <?php if ($success): ?>

        <div class="success">
            Record successfully saved to database!
        </div>

    <?php endif; ?>

    <?php foreach ($errors as $error): ?>

        <div class="error">
            <?= safe($error) ?>
        </div>

    <?php endforeach; ?>




    <fieldset>

        <legend>This form uses GET request</legend>

        <form action="index.php" method="GET">

            <table>

                <tr>
                    <td>First Name</td>
                    <td>
                        <input type="text" name="fname"
                        placeholder="Enter First Name"
                        maxlength="50" required>
                    </td>
                </tr>

                <tr>
                    <td>Middle Name</td>
                    <td>
                        <input type="text" name="mname"
                        placeholder="Enter Middle Name"
                        maxlength="50">
                    </td>
                </tr>

                <tr>
                    <td>Last Name</td>
                    <td>
                        <input type="text" name="lname"
                        placeholder="Enter Last Name"
                        maxlength="50" required>
                    </td>
                </tr>

                <tr>
                    <td>Age</td>
                    <td>
                        <input type="number" name="age"
                        placeholder="Enter your Age"
                        min="1" max="120" required>
                    </td>
                </tr>

                <tr>
                    <td>Gender</td>
                    <td>
                        <select name="gender" required>

                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Email Address</td>
                    <td>
                        <input type="email" name="email"
                        placeholder="Enter Email Address" required>
                    </td>
                </tr>

                <tr>
                    <td>Address</td>
                    <td>
                        <input type="text" name="address"
                        placeholder="Enter Address" required>
                    </td>
                </tr>

                <tr>
                    <td>Contact Number</td>
                    <td>
                        <input type="tel" name="contactNumber"
                        placeholder="Enter Contact Number"
                        pattern="[0-9+\-\s()]{7,20}" required>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <button type="submit" name="submit" value="1">
                            Submit GET Data
                        </button>

                        <input type="reset" value="Cancel">
                    </td>
                </tr>

            </table>

        </form>

    </fieldset>



    <fieldset>

        <legend>This form uses POST request</legend>

        <form action="index.php" method="POST">

            <table>

                <tr>
                    <td>First Name</td>
                    <td>
                        <input type="text" name="fname"
                        placeholder="Enter First Name"
                        maxlength="50" required>
                    </td>
                </tr>

                <tr>
                    <td>Middle Name</td>
                    <td>
                        <input type="text" name="mname"
                        placeholder="Enter Middle Name"
                        maxlength="50">
                    </td>
                </tr>

                <tr>
                    <td>Last Name</td>
                    <td>
                        <input type="text" name="lname"
                        placeholder="Enter Last Name"
                        maxlength="50" required>
                    </td>
                </tr>

                <tr>
                    <td>Age</td>
                    <td>
                        <input type="number" name="age"
                        placeholder="Enter your Age"
                        min="1" max="120" required>
                    </td>
                </tr>

                <tr>
                    <td>Gender</td>
                    <td>
                        <select name="gender" required>

                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Email Address</td>
                    <td>
                        <input type="email" name="email"
                        placeholder="Enter Email Address" required>
                    </td>
                </tr>

                <tr>
                    <td>Address</td>
                    <td>
                        <input type="text" name="address"
                        placeholder="Enter Address" required>
                    </td>
                </tr>

                <tr>
                    <td>Contact Number</td>
                    <td>
                        <input type="tel" name="contactNumber"
                        placeholder="Enter Contact Number"
                        pattern="[0-9+\-\s()]{7,20}" required>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <button type="submit" name="submit" value="1">
                            Submit POST Data
                        </button>

                        <input type="reset" value="Cancel">
                    </td>
                </tr>

            </table>

        </form>

    </fieldset>


    <!-- REGISTERED PERSONS TABLE -->

    <h2>List of Registered Persons</h2>

    <div class="table-wrapper">

        <table class="records">

            <thead>

                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Contact Number</th>
                    <th>Action</th>
                </tr>

            </thead>

            <tbody>

                <?php if (empty($persons)): ?>

                    <tr>
                        <td colspan="10">
                            No registered persons found.
                        </td>
                    </tr>

                <?php else: ?>

                    <?php foreach ($persons as $person): ?>

                        <tr>

                            <td><?= safe($person["id"]) ?></td>

                            <td><?= safe($person["fname"]) ?></td>

                            <td><?= safe($person["mname"]) ?></td>

                            <td><?= safe($person["lname"]) ?></td>

                            <td><?= safe($person["age"]) ?></td>

                            <td><?= safe($person["gender"]) ?></td>

                            <td><?= safe($person["email"]) ?></td>

                            <td><?= safe($person["address"]) ?></td>

                            <td><?= safe($person["contactNumber"]) ?></td>

                            <td class="actions">

                                <a class="edit"
                                href="edit.php?id=<?= (int)$person["id"] ?>">
                                    Edit
                                </a>

                                <form action="delete.php"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this record?');">

                                    <input type="hidden" name="id"
                                    value="<?= (int)$person["id"] ?>">

                                    <button type="submit" class="delete">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>

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