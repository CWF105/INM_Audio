<?php
namespace App\Controllers;

class UserController extends BaseController
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
## ----- LOGOUT ----- ##
    ## logout method
    public function logout(){
        $this->load->requireMethod('userAccount');

        helper('cookie');
        
        $user_id = $this->load->session->get('user_id');
        if($user_id) {
            $this->load->userAccount->update($user_id, ['remember_token' => null]);
        }
        
        $this->load->session->destroy();    
        delete_cookie('remember_token');
        return redirect()->to('/');
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- ROUTES ----- ##
    ## User Setting
    public function userSettings() {
        return $this->checkSessionThenRedirect('UserSide/userprof', true);
    }
}