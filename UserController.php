<?php

require_once("DB.php");
require_once("UserModel.php");



/**
 * Creates the headings of the table.
 */
function create_table() {
    echo "<table style='margin-left:auto;margin-right:auto;text-align:center;'>";
    echo "<tr><th>ID</th>";
    echo "<th>Name</th>";
    echo "<th>Age</th>";
    echo "<th>Address</th>";
    echo "<th>Infection Date</th></tr>";
            
}

/**
 * Handles incoming requests from index.php
 */
function handle_request() {

    try {
        $user_connection = new UserConnection();


        if(array_key_exists("addButton", $_POST)){
            if(empty($_POST["create_name"]) || empty($_POST["create_age"]) || empty($_POST["create_address"]) || empty($_POST["create_date"])) {
                echo "All fields are required";
            }
            else {
                $new_user = new User($_POST["create_name"],$_POST["create_age"],$_POST["create_address"],$_POST["create_date"]);
                $status = $user_connection->add_user($new_user);
                if($status["success"]) {
                    echo "<h2>New Patient Added Successfully.</h2>";
                    echo "<h3>Your ID Number is ".$status["inserted_id"] ."</h3>";
                }
            }
        }

        if(array_key_exists("updateButton", $_POST)){
            if(empty($_POST["id_number"])|| empty($_POST["update_name"]) || empty($_POST["update_age"]) || empty($_POST["update_address"]) || empty($_POST["update_date"])) {
                echo "All fields are required";
            }
            else {
                $updated_information = new User($_POST["update_name"],$_POST["update_age"],$_POST["update_address"],$_POST["update_date"]);

                if($user_connection->update_user(intval($_POST["id_number"]), $updated_information)) {
                    echo "<h2>Information was updated successfully.</h2>";
                }
                else {
                    echo "<h2>Information could not be updated. Check the ID submitted.</h2>";
                }
            }
        }


        if(array_key_exists("deleteButton", $_POST)){
            if(empty($_POST["id_number"])) {
                echo "Please enter an ID number.";
            }
            else {
                if($user_connection->delete_user(intval($_POST["id_number"]))){
                    echo "<h2>Record was deleted successfully.</h2>";
                }
                else {
                    echo "<h2>Information could not be removed. Check the ID submitted.</h2>";
                }
            }
            
        }


        if(array_key_exists("findAllButton", $_POST)) {
            $users = $user_connection->get_all_users();
            create_table();
            while($row = $users->fetch_assoc()) {
                echo "<tr><td>".$row["ID"]."</td>";
                echo "<td>".$row["Name"]."</td>";
                echo "<td>".$row["Age"]."</td>";
                echo "<td>".$row["Address"]."</td>";
                echo "<td>".$row["Date"]."</td></tr>";
            }
            echo "</table>";
        }


        if(array_key_exists("findButton", $_POST)){
            if(empty($_POST["id_number"])) {
                echo "Please enter an ID number.";
            }
            else {
                $status = $user_connection->get_user(intval($_POST["id_number"]));
                if($status["success"]) {
                    $returned_user = $status["record"];
                    $returned_id = $status["returned_id"];
                    create_table();
                    echo "<tr><td>".$returned_id ."</td>";
                    echo "<td>".$returned_user->get_name() ."</td>";
                    echo "<td>".$returned_user->get_age() ."</td>";
                    echo "<td>".$returned_user->get_address() ."</td>";
                    echo "<td>".$returned_user->get_date() ."</td></tr>";
                    echo "</table>";
                }
                else{
                    echo "<h2>Record was not found.</h2>";
                }
            }
        }
    }
    catch(Throwable $error) {
        echo $error;
    }
    finally {
        $user_connection->close();
    }
}

handle_request();

?>