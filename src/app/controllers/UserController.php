<?php
require_once __DIR__ . '/../models/UserModel.php';

class UserController {
    public function handleRequest() {
        $model = new UserModel();
        $users = $model->getUsers();

        include __DIR__ . '/../views/usersView.php';
    }
}
