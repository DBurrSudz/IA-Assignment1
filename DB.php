<?php

require_once("UserModel.php");

class UserConnection extends mysqli {
    private const host = "localhost";
    private const user = "root";
    private const password = "";
    private const port = "3307";
    private const database = "test";

    public function __construct() {
        parent::__construct(self::host,self::user,self::password,self::database,self::port);
    }

    /**
     * Adds a user to the database.
     * @param User $new_user The new user to be added to the database.
     * 
     */
    public function add_user(User $new_user) {
        $name = $new_user->get_name();
        $age = $new_user->get_age();
        $address = $new_user->get_address();
        $date = $new_user->get_date();

        $this->query("insert into User (name,age,address,date) VALUES('{$name}','{$age}','{$address}','{$date}');");
        if($this->affected_rows > 0) {
            return array("success" => true, "inserted_id" => $this->insert_id);
        }
        else {
            return array("success" => false);
        } 
    }


    /**
     * Returns a person's information based on their unique id.
     * @param int $id_number The ID number of the person to be searched for.
     * 
     */
    public function get_user(int $id_number) {
      
        $results = $this->query("select * from User where ID = {$id_number}");
        if($results->num_rows > 0) {
            $information = $results->fetch_assoc();
            return array("success" => true, "returned_id" => $information["ID"], "record" => new User($information['Name'],$information['Age'],$information['Address'],$information['Date']));
        }
        else {
            return array("success" => false);
        }
    }

    /**
     * Gets all the users stored in the database.
     * 
     */
    public function get_all_users() {
        $result = $this->query("select * from User");
        return $result;
    }


    /**
     * Updates a person's information in the database based on their unique id.
     * @param int $id_number The ID number of the person to be updated.
     * @param User $updated_user The updated information for the user.
     * @return bool
     */
    public function update_user(int $id_number, User $updated_user) {
        $new_name = $updated_user->get_name();
        $new_age = $updated_user->get_age();
        $new_address = $updated_user->get_address();
        $new_date = $updated_user->get_date();
        $this->query("update User set name = '{$new_name}', age = '{$new_age}', address = '{$new_address}', date = '{$new_date}' where ID = {$id_number}");
        if($this->affected_rows > 0) {
            return true;
        }
        else {
            return false;
        }
    }


    /**
     * Deletes a specific user in the database based on their id number.
     * @param int $id_number The ID number for the person to be deleted from the database.
     * @return bool
     */
    public function delete_user(int $id_number) {
        $this->query("delete from user where ID = {$id_number}");
        if($this->affected_rows > 0) {
            return true;
        }
        else {
            return false;
        }
    }
}

?>