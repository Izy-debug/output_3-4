
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Management System</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>Faculty Management System</h1>

    <p class="subtitle">Manage Faculty Information</p>

    <?php if (isset($_GET["success"])): ?>
        <div class="success">
            Faculty record successfully <?= safe($_GET["success"]) ?>!
        </div>
    <?php endif; ?>

    <a href="index.php?action=add" class="add-button">
        + Add New Faculty
    </a>

    <h2>List of Registered Faculty</h2>

    <div class="table-wrapper">

        <table>

            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Position</th>
                <th>Salary</th>
                <th>Action</th>
            </tr>

            <?php if (empty($faculty)): ?>

                <tr>
                    <td colspan="10">No faculty records found.</td>
                </tr>

            <?php else: ?>

                <?php foreach ($faculty as $row): ?>

                    <tr>
                        <td><?= safe($row["id"]) ?></td>
                        <td><?= safe($row["fname"]) ?></td>
                        <td><?= safe($row["mname"]) ?></td>
                        <td><?= safe($row["lname"]) ?></td>
                        <td><?= safe($row["age"]) ?></td>
                        <td><?= safe($row["gender"]) ?></td>
                        <td><?= safe($row["address"]) ?></td>
                        <td><?= safe($row["position"]) ?></td>
                        <td><?= number_format((float)$row["salary"], 2) ?></td>

                        <td class="actions">

                            <a href="index.php?action=edit&id=<?= (int)$row["id"] ?>"
                            class="edit-button">Edit</a>

                            <form method="POST"
                            action="index.php?action=delete"
                            onsubmit="return confirm('Delete this faculty record?');">

                                <input type="hidden" name="id"
                                value="<?= (int)$row["id"] ?>">

                                <button type="submit" class="delete-button">
                                    Delete
                                </button>

                            </form>

                        </td>
                    </tr>

                <?php endforeach; ?>

            <?php endif; ?>

        </table>

    </div>

</div>

</body>
</html>
