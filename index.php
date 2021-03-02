<html lang="en">
<head>
    <title>Daniel Burrell Assignment 1</title>
</head>
<body>
    <div id="create-update-delete" style="float:left;margin-left:25px;">
        <div id="create">
            <h2>CREATE</h2>
            <form action="UserController.php" method="post">
                <p>Add a new patient to the database.</p>
                <input type="text" name="create_name" id="nameField" placeholder="Name"><br>
                <input type="text" name="create_age" id="ageField" placeholder="Age"><br>
                <input type="text" name="create_address" id="emailField" placeholder="Address"><br>
                <input type="text" name="create_date" id="phoneField" placeholder="Infection Date(yyyy-mm-dd)"><br>
                <input type="submit" name="addButton" value="Add Patient"/>
            </form>
        </div>

        <div id="update">
        <h2>UPDATE</h2>
            <form action="UserController.php" method="post">
                <p>Enter the fields you wish to update to a record. Whatever fields you do not wish to update, just re-enter the original information.</p>
                <input type="text" name="id_number" id="nameField" placeholder="ID of Patient"><br>
                <input type="text" name="update_name" id="nameField" placeholder="Name"><br>
                <input type="text" name="update_age" id="ageField" placeholder="Age"><br>
                <input type="text" name="update_address" id="emailField" placeholder="Address"><br>
                <input type="text" name="update_date" id="phoneField" placeholder="Infection Date(yyyy-mm-dd)"><br>
                <input type="submit" name="updateButton" value="Update Information"/>
            </form>
        </div>

        <div id="delete">
        <h2>DELETE</h2>
            <form action="UserController.php" method="post">
                <p>Delete a patient from the database.</p>
                <input type="text" name="id_number" id="nameField" placeholder="ID of Patient"><br>
                <input type="submit" name="deleteButton" value="Remove Patient"/>
            </form>
        </div>
    
    
    </div id="select">
        <h2>READ</h2>
        <form action="UserController.php" method="POST">
            <p>Please enter the ID to retrieve a certain patient's information.</p>
            <input type="text" name="id_number" id="nameField" placeholder="ID of Patient"><br>
            <input type="submit" name="findButton" value="Get Patient"/>
            <input type="submit" name="findAllButton" value="Get All Patients"/>
        </form>
</body>