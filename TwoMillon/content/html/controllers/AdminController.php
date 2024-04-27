<?php
class AdminController
{
    public function is_admin($router)
    {
        if (!isset($_SESSION) || !isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !isset($_SESSION['username'])) {
            return header("HTTP/1.1 401 Unauthorized");
            exit;
        }

        $db = Database::getDatabase();

        $stmt = $db->query('SELECT is_admin FROM users WHERE username = ?', ['s' => [$_SESSION['username']]]);
        $user = $stmt->fetch_assoc();

        if ($user['is_admin'] == 1) {
            header('Content-Type: application/json');
            return json_encode(['message' => TRUE]);
        } else {
            header('Content-Type: application/json');
            return json_encode(['message' => FALSE]);
        }
    }

    public function update_settings($router) {
        $db = Database::getDatabase();

        $is_admin = $this->is_admin($router);
        if (!$is_admin) {
            return header("HTTP/1.1 401 Unauthorized");
            exit;
        }

        if (!isset($_SERVER['CONTENT_TYPE']) || $_SERVER['CONTENT_TYPE'] !== 'application/json') {
            return json_encode([
                'status' => 'danger',
                'message' => 'Invalid content type.'
            ]);
            exit;
        }

        $body = file_get_contents('php://input');
        $json = json_decode($body);

        if (!isset($json->email)) {
            return json_encode([
                'status' => 'danger',
                'message' => 'Missing parameter: email'
            ]);
            exit;
        }

        if (!isset($json->is_admin)) {
            return json_encode([
                'status' => 'danger',
                'message' => 'Missing parameter: is_admin'
            ]);
            exit;
        }

        $email = $json->email;
        $is_admin = $json->is_admin;

        if ($is_admin !== 1 && $is_admin !== 0) {
            return json_encode([
                'status' => 'danger',
                'message' => 'Variable is_admin needs to be either 0 or 1.'
            ]);
            exit;
        }

        $stmt = $db->query('SELECT * FROM users WHERE email = ?', ['s' => [$email]]);
        $user = $stmt->fetch_assoc();

        if ($user) {
            $stmt = $db->query('UPDATE users SET is_admin = ? WHERE email = ?', ['s' => [$is_admin, $email]]);
        } else {
            return json_encode([
                'status' => 'danger',
                'message' => 'Email not found.'
            ]);
            exit;
        }

        if ($user['username'] == $_SESSION['username'] ) {
            $_SESSION['is_admin'] = $is_admin;
        }

        return json_encode(['id' => $user['id'], 'username' => $user['username'], 'is_admin' => $is_admin]);
    }
}
