<?php
require_once 'connector.php';

class authenticationModel extends Connector {
    function __construct() {
        parent::__construct();
    }

    function loggedin() {
        $username = htmlspecialchars($_POST['username']);
        $password = $_POST['password'];

        $sql = "SELECT * FROM admin_tb WHERE admin_username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['admin_password'])) {
            $_SESSION['admin_id'] = $user['admin_id'];
            $_SESSION['admin_username'] = $user['admin_username'];
            $_SESSION['admin_type'] = $user['admin_type'];
            $_SESSION['loggedin'] = true;
            return $user;
        }
        return false;
    }

    function register() {
        $username = htmlspecialchars($_POST['user']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $sql = "INSERT INTO admin_tb (admin_user, admin_password) VALUES (:username, :password)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'username' => $username,
            'password' => $password
        ]);
    }
}
?>
