
<?php

class DBController {

    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "faculty_db";
    private $conn;

    function __construct() {
        $this->conn = $this->connectDB();
    }

    function connectDB() {

        $cnn = mysqli_connect(
            $this->host,
            $this->user,
            $this->password,
            $this->database
        );

        if (!$cnn) {
            die("Database Connection Failed: " . mysqli_connect_error());
        }

        mysqli_set_charset($cnn, "utf8mb4");

        return $cnn;
    }

    function executeQuery($query) {

        $result = mysqli_query($this->conn, $query);
        $resultset = [];

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $resultset[] = $row;
            }
        }

        return $resultset;
    }

    function executePrepared($query, $types, $params) {

        $stmt = mysqli_prepare($this->conn, $query);

        if (!$stmt) {
            return false;
        }

        $bindParams = [$types];

        foreach ($params as $key => &$value) {
            $bindParams[] = &$value;
        }

        call_user_func_array(
            "mysqli_stmt_bind_param",
            array_merge([$stmt], $bindParams)
        );

        $result = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        return $result;
    }

    function executeDelete($query, $id) {

        $stmt = mysqli_prepare($this->conn, $query);

        if (!$stmt) {
            return false;
        }

        mysqli_stmt_bind_param($stmt, "i", $id);

        $result = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        return $result;
    }

    function getConnection() {
        return $this->conn;
    }
}

?>
