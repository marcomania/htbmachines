<?php
class VPNController
{
    private function remove_special_chars($string) {
        $string = str_replace(' ', '-', $string);
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);

        return $string;
    }

    private function download_vpn($fileName) 
    {
        // Define the allowed directory
        $allowedDir = realpath('/var/www/html/VPN/user');
        // Remove any path info from filename (for security)
        $fileName = basename($fileName);
        // Join the allowed directory with the filename
        $filePath = $allowedDir . '/' . $fileName;
        // Resolve to an absolute path
        $realPath = realpath($filePath);

        // Check if the file is in the allowed directory
        if ($realPath === false || strpos($realPath, $allowedDir) !== 0) {
            // File is not in the allowed directory
            header("HTTP/1.0 404 Not Found");
            die;
        }

        // Check if the file exists and is readable
        if (file_exists($filePath) && is_readable($filePath)) {
            // Send headers to prompt download
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            flush(); // Flush system output buffer
            readfile($filePath);
            exit;
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    public function generate_user_vpn($router) {
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            return header("HTTP/1.1 401 Unauthorized");
            exit;
        }
        if (!isset($_SESSION['username']) || $_SESSION['username'] == null) {
            return header("HTTP/1.1 401 Unauthorized");
            exit;
        }

        $username = $this->remove_special_chars($_SESSION['username']);
        $fileName = $username . ".ovpn";

        if (file_exists("VPN/user/" . $fileName) && is_readable("VPN/user/" . $fileName)) {
            $this->download_vpn($fileName);
        } else {
            $this->regenerate_user_vpn($router);
        }
    }

    public function regenerate_user_vpn($router, $user = null) {
        if ($user != null) {
            exec("/bin/bash /var/www/html/VPN/gen.sh $user", $output, $return_var);
        } else {
            if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
                return header("HTTP/1.1 401 Unauthorized");
                exit;
            }
            if (!isset($_SESSION['username']) || $_SESSION['username'] == null) {
                return header("HTTP/1.1 401 Unauthorized");
                exit;
            }

            $username = $this->remove_special_chars($_SESSION['username']);
            $fileName = $username. ".ovpn";

            exec("/bin/bash /var/www/html/VPN/gen.sh $username", $output, $return_var);

            $this->download_vpn($fileName);
        }
    }

    public function admin_vpn($router) {
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            return header("HTTP/1.1 401 Unauthorized");
            exit;
        }
        if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 1) {
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

        if (!isset($json)) {
            return json_encode([
                'status' => 'danger',
                'message' => 'Missing parameter: username'
            ]);
            exit;
        }
        if (!$json->username) {
            return json_encode([
                'status' => 'danger',
                    'message' => 'Missing parameter: username'
            ]);
            exit;
        }
        $username = $json->username;

        $this->regenerate_user_vpn($router, $username);
        $output = shell_exec("/usr/bin/cat /var/www/html/VPN/user/$username.ovpn");

        return is_array($output) ? implode("<br>", $output) : $output;
    }
}
