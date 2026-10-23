<?php
    
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        $req_type = '$_GET';
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $req_type = '$_POST';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Output No. 1</title>
    <style>
        body {
            font-family: "Arial";
        }
    </style>
        <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Data is sent here, and it is store at <?php echo $req_type; ?> variable</h2>
    <table>
        <tr>
            <td width="120">First Name:</td>
            <td style="text-decoration: underline">
                
                <?php echo ($req_type == '$_GET') ? $_GET['fname'] : $_POST['fname']; ?>
            </td>
        </tr>
        <tr>
            <td>Middle Name:</td>
            <td style="text-decoration: underline">
                <?php echo ($req_type == '$_GET') ? $_GET['mname'] : $_POST['mname']; ?>
            </td>
        </tr>
        <tr>
            <td>Last Name:</td>
            <td style="text-decoration: underline">
                <?php echo ($req_type == '$_GET') ? $_GET['lname'] : $_POST['lname'];?>
            </td>
        </tr>
        <tr>
            <td>Age:</td>
            <td style="number-decoration: underline">
                <?php echo ($req_type == '$_GET') ? $_GET['Age'] : $_POST['Age'];?>
            </td>
        </tr>
        <tr>
            <td>Address:</td>
            <td style="text-decoration: underline">
                <?php echo ($req_type == '$_GET') ? $_GET['Address'] : $_POST['Address'];?>
            </td>
        </tr>
        <tr>
            <td>Contact Number:</td>
            <td style="number-decoration: underline">
                <?php echo ($req_type == '$_GET') ? $_GET['contactNumber'] : $_POST['contactNumber'];?>
            </td>
        </tr>
        <tr>
            <td>Gender:</td>
            <td style="text-decoration: underline">
                <?php echo ($req_type == '$_GET') ? $_GET['gender'] : $_POST['gender'];?>
            </td>
        </tr>
    </table>
    <br><br>
<div class="navigation">
    <a href="./">Login</a>
    <a href="./">Home Page</a>
    <a href="./">Forgot Password</a>
    <a href="./">Register</a>
</div>

</body>
</html>