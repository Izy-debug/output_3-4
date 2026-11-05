
<?php

require_once __DIR__ . "/../controller/facultyController.php";

class Faculty {

    private $db;

    function __construct() {
        $this->db = new facultyController();
    }


    function addFaculty($data) {

        $query = "INSERT INTO faculty
        (fname, mname, lname, age, gender, address, position, salary)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        return $this->db->executePrepared(
            $query,
            "sssisssd",
            [
                $data["fname"],
                $data["mname"],
                $data["lname"],
                (int)$data["age"],
                $data["gender"],
                $data["address"],
                $data["position"],
                (float)$data["salary"]
            ]
        );
    }

    function getAllFaculty() {

        $query = "SELECT * FROM faculty ORDER BY id DESC";

        return $this->db->executeQuery($query);
    }

    // READ ONE
    function getFacultyById($id) {

        $query = "SELECT * FROM faculty WHERE id = " . (int)$id;

        $result = $this->db->executeQuery($query);

        return $result[0] ?? null;
    }

    // UPDATE
    function updateFaculty($id, $data) {

        $query = "UPDATE faculty SET
        fname = ?,
        mname = ?,
        lname = ?,
        age = ?,
        gender = ?,
        address = ?,
        position = ?,
        salary = ?
        WHERE id = ?";

        return $this->db->executePrepared(
            $query,
            "sssisssdi",
            [
                $data["fname"],
                $data["mname"],
                $data["lname"],
                (int)$data["age"],
                $data["gender"],
                $data["address"],
                $data["position"],
                (float)$data["salary"],
                (int)$id
            ]
        );
    }

    // DELETE
    function deleteFaculty($id) {

        $query = "DELETE FROM faculty WHERE id = ?";

        return $this->db->executeDelete($query, (int)$id);
    }

}

?>
