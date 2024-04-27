<?php
class APIController
{
    public function get_version($router) {
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            return header("HTTP/1.1 401 Unauthorized");
            exit;
        }
        header('Content-Type: application/json');
        return json_encode([
            '/api/v1' => 'Version 1 of the API'
        ]);

    }
    public function get_routes($router) {
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            return header("HTTP/1.1 401 Unauthorized");
            exit;
        }
        header('Content-Type: application/json');
        return json_encode([
            'v1' => [
                'user' => [
                    'GET' => [
                        '/api/v1' => 'Route List',
                        '/api/v1/invite/how/to/generate' => 'Instructions on invite code generation',
                        '/api/v1/invite/generate' => 'Generate invite code',
                        '/api/v1/invite/verify' => 'Verify invite code',
                        '/api/v1/user/auth' => 'Check if user is authenticated',
                        '/api/v1/user/vpn/generate' => 'Generate a new VPN configuration',
                        '/api/v1/user/vpn/regenerate' => 'Regenerate VPN configuration',
                        '/api/v1/user/vpn/download' => 'Download OVPN file'
                    ],
                    'POST' => [
                        '/api/v1/user/register' => 'Register a new user',
                        '/api/v1/user/login' => 'Login with existing user',
                    ]
                ],
                'admin' => [
                    'GET' => [
                        '/api/v1/admin/auth' => 'Check if user is admin'
                    ],
                    'POST' => [
                        '/api/v1/admin/vpn/generate' => 'Generate VPN for specific user'
                    ],
                    'PUT' => [
                        '/api/v1/admin/settings/update' => 'Update user settings'
                    ]
                ]
            ]
        ]);
    }
}
