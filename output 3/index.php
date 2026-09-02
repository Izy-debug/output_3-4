<?php include './layout/head.php'; ?>
    <h1>PHP Output 3</h1>
    <p>This output connects to the database and allows the user to save records into it.</p>
    <form action="redirect.php" method="POST">
        <h2>Register Person</h2>
        <table>
            
            <tr>
                <td>
                    <label for="fname">First Name</label>
                </td>
                <td>
                    <input type="text" name="fname" id="fname" placeholder="Enter First Name">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="mname">Middle Name</label>
                </td>
                <td>
                    <input type="text" name="mname" id="mname" placeholder="Enter Middle Name">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="lname">Last Name</label>
                <td>
                    <input type="text" name="lname" id="lname" placeholder="Enter Last Name">
                </td>
                </td>
                <tr>
                <td>Age</td>
                <td>
                    <input type="number" name="Age" placeholder="Enter your Age" required />
                </td>
            <tr>
                <td>Address</td>
                <td>
                    <input type="text" name="Address" placeholder="Enter your Address" required />
                </td>
            </tr>
            <tr>
                <td>Contact Number</td>
                <td>
                    <input type="number" name="contactNumber" placeholder="Enter your contact number" required />
                </td>
            </tr>
                <td>Gender</td>
                <td>
                    <select name="gender" required>
                    <option value="" disabled selected>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    </select>

                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" value="Submit">
                    <input type="reset" name="cancel" value="Cancel">
                </td>
            </tr>
        </table>
    </form>
<?php include './layout/foot.php'; ?>