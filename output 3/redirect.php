<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "myfirstdb";

$conn = new mysqli($servername, $username, $password, $db);

if($conn->connect_error) {
    die("Connection Failed: ". $conn->connect_error);
}


if(isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $age = $_POST[age];
    $contactNum = $_POST[contactNum];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $sql = "INSERT INTO persons(person_fname,person_mname,person_lname,peson_age,person_contactNum,person_address,person_gender) VALUES('$fname', '$mname', '$lname', $age, $contactNumber,'$adrress','$gender')";

   if($conn->query($sql) === TRUE) {
        $isSuccess = true;
    } else {
        echo $sql." ".$conn->error;
    }

}

?>

<?php include './layout/head.php'; ?>
    
    <?php if($isSuccess ): ?>
        <h3>Record Successfully Inserted to Database</h3>
    <?php endif; ?>
    
    <a href="./">Back to Main Form</a>
<?php include './layout/foot.php'; ?>