<?php
class AuthController
{
    public function get_register($router) {
        return $router->view('register');
    }

    public function get_login($router) {
        return $router->view('login');
    }

    public function logout($router)
    {
        return $router->view('logout');
    }

    public function post_register($router) {
        $db = Database::getDatabase();

        if (!isset($_POST['username']) || !isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['password_confirmation'])) {
            header('Location: /register?error=Please+fill+in+all+fields');
            exit;
        }

        if (!isset($_POST['code'])) {
            header('Location: /register?error=Get+an+invite+code+first');
            exit;
        }

        // Check the request method
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirmation'];
        $code = $_POST['code'];

        // Validate input
        if (empty($username) || empty($email) || empty($password) || empty($password_confirm)) {
            header('Location: /register?error=Please+fill+in+all+fields');
            exit;
        }

        if (empty($code)) {
            header('Location: /register?error=Get+an+invite+code+first');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: /register?error=Email+address+is+invalid');
            exit;
        }

        if ($password !== $password_confirm) {
            header('Location: /register?error=Passwords+do+not+match');
            exit;
        }

        $stmt = $db->query('SELECT * FROM invite_codes WHERE code = ?', ['s' => [$code]]);
        $result = $stmt->fetch_assoc();

        if (!isset($result['id'])) {
            header('Location: /register?error=Code+is+invalid!');
            exit;
        }

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if username or email already exists
        $stmt = $db->query('SELECT * FROM users WHERE username = ? OR email = ?', ['s' => [$username, $email]]);
        $user = $stmt->fetch_row();

        if ($user) {
            header('Location: /register?error=Username+or+email+already+exists');
            exit;
        }

        // Insert into database
        $stmt = $db->query('INSERT INTO users (username, email, password) VALUES (?, ?, ?)', ['s' => [$username, $email, $hashed_password]]);

        // Delete invite code
        $stmt = $db->query('DELETE FROM invite_codes WHERE code = ?', ['s' => [$code]]);

        return header("Location: /login");
    }

    public function post_login($router) {
        if (empty(trim($_POST["email"]))) {
            return header("Location: /login?error=Please+enter+an+email");
            exit;
        }
        if (empty(trim($_POST["password"]))) {
            return header("Location: /login?error=Please+enter+a+password");
            exit;
        }

        $db = Database::getDatabase();

        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        $stmt = $db->query('SELECT * FROM users WHERE email = ?', ['s' => [$email]]);
        $user = $stmt->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $user['id'];
            $_SESSION["username"] = $user['username'];
            $_SESSION["is_admin"] = $user['is_admin'];
            return header("Location: /home");
        } else {
            return header("Location: /login?error=User+not+found");
        }
    }

    public function is_authenticated($router) {
        if (isset($_SESSION['loggedin']) && isset($_SESSION['username']) && isset($_SESSION['is_admin'])) {
            header('Content-Type: application/json');
            return json_encode(['loggedin' =>  $_SESSION['loggedin'] ,'username' => $_SESSION['username'],'is_admin' => $_SESSION['is_admin']]);
        } else {
            header('Content-Type: application/json');
            return json_encode(['message' => FALSE]);
        }
    }
}
