<?php
namespace App\Controllers;

class HomeController extends BaseController
{
## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- FOR REDERING VIEWS AND CHECKING SESSIONS AND EXPIRATIONS ----- ##
    ## check sessions and redirect to views
    public function checkSessionThenRedirect($path, $isDisplaying = false){
        if($this->isAdmin()) {
            return redirect()->to('/admin/dashboard');
        }
        if($this->isSessionExpired()) {
            $this->deleteCookiesAndSession("user");
            return redirect()->to('/');
        }
        return $this->renderView($path, $isDisplaying);
    }


 ## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    ## render view 
    private function renderView($path, $isDisplaying){
        $this->load->requireMethod('gears');
        $this->load->requireMethod('categories');

        if($isDisplaying) {
            $pager = \Config\Services::pager(); 
    
            $perPage = 10; 
            $gears = $this->load->gears->getAllPaginated($perPage);
    
            $data = [
                'categories' => $this->load->categories->getAll(),
                'gearsPerCategory' => $gears, 
                'pager' => $this->load->gears->pager 
            ];
            return view($path, $data);
        }
        return view($path); 
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- ROUTES ----- ##
    ## redirect to homepage 
    public function home() {
        return $this->checkSessionThenRedirect('homepage');
    }
    ## redirect to gear library 
    public function library(){
        return $this->checkSessionThenRedirect('library', true);
    }
    ## redirect to  community
    public function community(){
        return $this->checkSessionThenRedirect('community', true);
    }
    ## redirect to customize 
    public function customize(){
        return $this->checkSessionThenRedirect('customize', true);
    }
    ## redirect to login 
    public function login(){
        return $this->checkSessionThenRedirect('login');
    }
    ## redirect to signup
    public function signup() {
        return $this->checkSessionThenRedirect('signup');
    }

## ----- END ROUTES ----- ##
}