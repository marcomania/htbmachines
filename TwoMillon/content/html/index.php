<?php 

session_start();

//error_reporting(E_ALL);
//ini_set('display_errors',1);

spl_autoload_register(function ($name){
    if (preg_match('/Controller$/', $name))
    {
        $name = "controllers/${name}";
    }
    else if (preg_match('/Model$/', $name))
    {
        $name = "models/${name}";
    }
    include_once "${name}.php";
});

$envFile = file('.env');
$envVariables = [];
foreach ($envFile as $line) {
    $line = trim($line);
    if (!empty($line) && strpos($line, '=') !== false) {
        list($key, $value) = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);
        $envVariables[$key] = $value;
    }
}


$dbHost = $envVariables['DB_HOST'];
$dbName = $envVariables['DB_DATABASE'];
$dbUser = $envVariables['DB_USERNAME'];
$dbPass = $envVariables['DB_PASSWORD'];


$database = new Database($dbHost, $dbUser, $dbPass, $dbName);
$database->connect();

$router = new Router();

// Home Routes
$router->new('GET', '/', 'HomeController@index');

$router->new('GET', '/invite', 'HomeController@invite');
$router->new('GET', '/register', 'AuthController@get_register');
$router->new('GET', '/login', 'AuthController@get_login');
$router->new('GET', '/logout', 'AuthController@logout');
$router->new('GET', '/404', 'HomeController@not_found');

$router->new('GET', '/home', 'HomeController@home');
$router->new('GET', '/home/changelog', 'HomeController@change_log');
$router->new('GET', '/home/access', 'HomeController@access');
$router->new('GET', '/home/rules', 'HomeController@rules');

// API Routes
$router->new('GET', '/api', 'APIController@get_version');
$router->new('GET', '/api/v1', 'APIController@get_routes');

$router->new('POST', '/api/v1/invite/how/to/generate', 'InviteController@how_to_generate');
$router->new('POST', '/api/v1/invite/generate', 'InviteController@generate');
$router->new('POST', '/api/v1/invite/verify', 'InviteController@verify');

$router->new('GET', '/api/v1/user/auth', 'AuthController@is_authenticated');
$router->new('POST', '/api/v1/user/register', 'AuthController@post_register');
$router->new('POST', '/api/v1/user/login', 'AuthController@post_login');

$router->new('GET', '/api/v1/user/vpn/generate', 'VPNController@generate_user_vpn');
$router->new('GET', '/api/v1/user/vpn/regenerate', 'VPNController@regenerate_user_vpn');
$router->new('GET', '/api/v1/user/vpn/download', 'VPNController@generate_user_vpn');

$router->new('GET', '/api/v1/admin/auth', 'AdminController@is_admin');
$router->new('POST', '/api/v1/admin/vpn/generate', 'VPNController@admin_vpn');
$router->new('PUT', '/api/v1/admin/settings/update', 'AdminController@update_settings');

$response = $router->match();

die($response);
