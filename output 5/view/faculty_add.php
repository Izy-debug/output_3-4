
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Faculty</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>Add New Faculty</h1>

    <?php foreach ($errors as $error): ?>
        <div class="error"><?= safe($error) ?></div>
    <?php endforeach; ?>

    <form action="index.php?action=add" method="POST">

        <label>First Name</label>
        <input type="text" name="fname"
        value="<?= safe($_POST["fname"] ?? "") ?>"
        maxlength="50" required>

        <label>Middle Name</label>
        <input type="text" name="mname"
        value="<?= safe($_POST["mname"] ?? "") ?>"
        maxlength="50">

        <label>Last Name</label>
        <input type="text" name="lname"
        value="<?= safe($_POST["lname"] ?? "") ?>"
        maxlength="50" required>

        <label>Age</label>
        <input type="number" name="age"
        value="<?= safe($_POST["age"] ?? "") ?>"
        min="18" max="100" required>

        <label>Gender</label>
        <select name="gender" required>
            <option value="">Select Gender</option>
            <option value="Male" <?= ($_POST["gender"] ?? "") === "Male" ? "selected" : "" ?>>Male</option>
            <option value="Female" <?= ($_POST["gender"] ?? "") === "Female" ? "selected" : "" ?>>Female</option>
            <option value="Other" <?= ($_POST["gender"] ?? "") === "Other" ? "selected" : "" ?>>Other</option>
        </select>

        <label>Address</label>
        <textarea name="address" required><?= safe($_POST["address"] ?? "") ?></textarea>

        <label>Position</label>
        <input type="text" name="position"
        value="<?= safe($_POST["position"] ?? "") ?>"
        maxlength="100" required>

        <label>Salary</label>
        <input type="number" name="salary"
        value="<?= safe($_POST["salary"] ?? "") ?>"
        min="0" max="99999999.99" step="0.01" required>

        <button type="submit">Save Faculty</button>

        <a href="index.php" class="back-button">Cancel</a>

    </form>

</div>

</body>
</html>
