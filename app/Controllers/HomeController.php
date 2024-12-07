<?php
namespace App\Controllers;

class HomeController extends BaseController
{
## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- SESSION ----- ##
private function checkUserSession($path, $data = null) {
        if($this->isAdmin()) {
            return redirect()->to('/admin/dashboard');
        }
        if($this->isSessionExpired()) {
            $this->deleteCookiesAndSession("user");
            return redirect()->to('/')->with('sessionTimeout', 'Session Timeout, login again');
        }
        if($data != null) {
            return view($path, $data);
        }
        return view($path);
    }

## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- ROUTES ----- ##
    ## redirect to homepage 
    public function home() {  
        return $this->checkUserSession('homepage');
    }

    ## redirect to gear library 
    public function library(){
        $pager = \Config\Services::pager(); 
        $this->load->requireMethod('gears');
        $this->load->requireMethod('categories');
        $perPage = 10; 
        $gears = $this->load->gears->getAllPaginated($perPage);
        $data = [
            'categories' => $this->load->categories->getAll(),
            'gearsPerCategory' => $gears, 
        ];
        return $this->checkUserSession('library', $data);
    }

    ## redirect to  community
    public function community(){
        return $this->checkUserSession('community');

    }
    ## redirect to customize 
    public function customize(){
        return $this->checkUserSession('customize');
    }
    ## redirect to login 
    public function login(){
        if($this->isUser()) {
            return redirect()->to('/admin/dashboard');
        }
        return $this->checkUserSession('login');
    }
    ## redirect to signup
    public function signup() {
        if($this->isUser()) {
            return redirect()->to('/admin/dashboard');
        }
        return $this->checkUserSession('signup');
    }

## ----- END ROUTES ----- ##
}