
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Faculty</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>Edit Faculty Information</h1>

    <?php foreach ($errors as $error): ?>
        <div class="error"><?= safe($error) ?></div>
    <?php endforeach; ?>

    <form action="index.php?action=edit" method="POST">

        <input type="hidden" name="id" value="<?= (int)$editFaculty["id"] ?>">

        <label>First Name</label>
        <input type="text" name="fname"
        value="<?= safe($_POST["fname"] ?? $editFaculty["fname"]) ?>"
        maxlength="50" required>

        <label>Middle Name</label>
        <input type="text" name="mname"
        value="<?= safe($_POST["mname"] ?? $editFaculty["mname"]) ?>"
        maxlength="50">

        <label>Last Name</label>
        <input type="text" name="lname"
        value="<?= safe($_POST["lname"] ?? $editFaculty["lname"]) ?>"
        maxlength="50" required>

        <label>Age</label>
        <input type="number" name="age"
        value="<?= safe($_POST["age"] ?? $editFaculty["age"]) ?>"
        min="18" max="100" required>

        <label>Gender</label>
        <?php $selectedGender = $_POST["gender"] ?? $editFaculty["gender"]; ?>

        <select name="gender" required>
            <option value="">Select Gender</option>
            <?php foreach (["Male", "Female", "Other"] as $g): ?>
                <option value="<?= $g ?>"
                <?= $selectedGender === $g ? "selected" : "" ?>>
                    <?= $g ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Address</label>
        <textarea name="address" required><?= safe($_POST["address"] ?? $editFaculty["address"]) ?></textarea>

        <label>Position</label>
        <input type="text" name="position"
        value="<?= safe($_POST["position"] ?? $editFaculty["position"]) ?>"
        maxlength="100" required>

        <label>Salary</label>
        <input type="number" name="salary"
        value="<?= safe($_POST["salary"] ?? $editFaculty["salary"]) ?>"
        min="0" max="99999999.99" step="0.01" required>

        <button type="submit">Update Faculty</button>

        <a href="index.php" class="back-button">Cancel</a>

    </form>

</div>

</body>
</html>
