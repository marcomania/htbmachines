<?php
class HomeController
{
    public function index($router)
    {
        return $router->view('index');
    }

    public function invite($router)
    {
    	return $router->view('invite');
    }

    public function home($router)
    {
    	return $router->view('home');
    }

    public function change_log($router)
    {
    	return $router->view('changelog');
    }

    public function access($router)
    {
    	return $router->view('access');
    }

    public function rules($router)
    {
    	return $router->view('rules');
    }

    public function not_found($router)
    {
    	return $router->view('404');
    }
}
