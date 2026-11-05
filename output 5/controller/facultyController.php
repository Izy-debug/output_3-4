
<?php

require_once __DIR__ . "/../models/faculty.php";

class facultyController {

    private $faculty;

    function __construct() {
        $this->faculty = new Faculty();
    }

    // Validate faculty information
    function validateFaculty($data) {

        $errors = [];

        $fname = trim($data["fname"] ?? "");
        $mname = trim($data["mname"] ?? "");
        $lname = trim($data["lname"] ?? "");
        $age = $data["age"] ?? "";
        $gender = $data["gender"] ?? "";
        $address = trim($data["address"] ?? "");
        $position = trim($data["position"] ?? "");
        $salary = $data["salary"] ?? "";

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
            $age < 18 || $age > 100
        ) {
            $errors[] = "Age must be between 18 and 100.";
        }

        if (!in_array($gender, ["Male", "Female", "Other"], true)) {
            $errors[] = "Please select a valid gender.";
        }

        if ($address === "") {
            $errors[] = "Address is required.";
        }

        if ($position === "" || strlen($position) > 100) {
            $errors[] = "Please enter a valid position.";
        }

        if (
            $salary === "" ||
            !is_numeric($salary) ||
            !is_finite((float)$salary) ||
            $salary < 0 ||
            $salary > 99999999.99
        ) {
            $errors[] = "Please enter a valid salary.";
        }

        return $errors;
    }

    // Display all faculty
    function index() {
        return $this->faculty->getAllFaculty();
    }

    // Add faculty
    function create($data) {

        $errors = $this->validateFaculty($data);

        if (empty($errors)) {

            if ($this->faculty->addFaculty($data)) {
                header("Location: index.php?success=added");
                exit;
            }

            $errors[] = "Unable to save faculty record.";
        }

        return $errors;
    }

    // Get faculty for editing
    function edit($id) {
        return $this->faculty->getFacultyById($id);
    }

    // Update faculty
    function update($id, $data) {

        $errors = $this->validateFaculty($data);

        if (empty($errors)) {

            if ($this->faculty->updateFaculty($id, $data)) {
                header("Location: index.php?success=updated");
                exit;
            }

            $errors[] = "Unable to update faculty record.";
        }

        return $errors;
    }

    // Delete faculty
    function delete($id) {

        return $this->faculty->deleteFaculty($id);
    }

}

?>
