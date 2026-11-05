
<?php

require_once "controller/facultyController.php";

$controller = new FacultyController();

$action = $_GET["action"] ?? "index";

$errors = [];
$faculty = [];
$editFaculty = null;

if ($action === "add" && $_SERVER["REQUEST_METHOD"] === "POST") {

    $errors = $controller->create($_POST);

} elseif ($action === "edit" && $_SERVER["REQUEST_METHOD"] === "POST") {

    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

    if (!$id || $id < 1) {
        die("Invalid faculty ID.");
    }

    $errors = $controller->update($id, $_POST);

} elseif ($action === "delete" && $_SERVER["REQUEST_METHOD"] === "POST") {

    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

    if (!$id || $id < 1) {
        die("Invalid faculty ID.");
    }

    if ($controller->delete($id)) {
        header("Location: index.php?success=deleted");
        exit;
    }

    die("Unable to delete faculty record.");

} elseif ($action === "edit") {

    $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

    if (!$id || $id < 1) {
        die("Invalid faculty ID.");
    }

    $editFaculty = $controller->edit($id);

    if (!$editFaculty) {
        die("Faculty record not found.");
    }

} elseif ($action !== "index" && $action !== "add") {

    http_response_code(404);
    die("Page not found.");

}

$faculty = $controller->index();

function safe($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}

if ($action === "add" && $_SERVER["REQUEST_METHOD"] === "POST") {
    require "views/faculty_add.php";

} elseif ($action === "edit") {
    require "views/faculty_edit.php";

} else {
    require "views/faculty_list.php";
}

?>
