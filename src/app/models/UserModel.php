<?php
// app/models/UserModel.php
require_once __DIR__ . '/../database.php';

class UserModel {
    public function getUsers() {
        global $conn;
        $sql = "SELECT id_user, nama, email FROM users";
        $result = $conn->query($sql);

        $users = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }
}
