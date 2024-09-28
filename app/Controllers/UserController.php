<?php
namespace App\Controllers;
use Config\Session as SessionConfig;
use App\Models\User_Account_Model as userAccountModel;
use App\Models\Category_Model as categories;
use App\Models\Gear_Product_Model as gears;

class UserController extends BaseController
{
    // global variables
    protected $session;
    protected $sessionConfig;
    protected $expirationTime;
    protected $userAccount;
    protected $categories;
    protected $gears;

## ----- THIS PREVENTS LOADING MODELS AND MEMORY ISSUES ----- ##
## call this methods to load models
    // load session method
    private function loadSession() {
        if(!$this->session) {
            $this->session = session();
        }
    }
    // load session expiration time 
    private function loadExpirationTime() {
        if(!$this->expirationTime){
            $this->sessionConfig = new SessionConfig();
            $this->expirationTime = $this->sessionConfig->expiration;
        }
    }
    // load user account model 
    private function loadUserAccount(){
        if(!$this->userAccount) {
            $this->userAccount = new userAccountModel();
        }
    }
    // load categories model
    private function loadCategories() {
        if(!$this->categories) {
            $this->categories = new categories();
        }
    }
    // load gears model
    private function loadGears() {
        if(!$this->gears) {
            $this->gears = new gears();
        }
    }
## ----- END ----- ## 





## ----- FOR REDERING VIEWS AND CHECKING SESSIONS AND EXPIRATIONS ----- ##
    ## check sessions and redirect to views
    public function checkSessionThenRedirect($path, $isDisplaying = false){
        if($this->isAdmin()) {
            return redirect()->to('/admin/dashboard');
        }
        if($this->isSessionExpired()) {
            $this->deleteCookiesAndSession();
            return redirect()->to('/');
        }
        return $this->renderView($path, $isDisplaying);
    }
        ## check if session is set to admin
        private function isAdmin(){
            $this->loadSession();
            return  $this->session->get('type') == "admin" && 
                    $this->session->get('isLoggedIn') && 
                    $this->session->get('admin_id');
        }
        ## check if session is expired
        private function isSessionExpired() {
            $this->loadSession();
            $this->loadExpirationTime();
            return  $this->session->get('timeLoggedIn') && 
                    (time() - $this->session->get('timeLoggedIn')) > $this->expirationTime;
        }
        ## delete both cookies and session
        private function deleteCookiesAndSession(){
            helper('cookie');
            $this->loadSession();
            $this->loadUserAccount();
            $user_id = $this->session->get('user_id');
            $username = $this->session->get('username');
            $this->userAccount->update($user_id , ['remember_token' => null]);
            $this->userAccount->update($username, ['remember_token' => null]);
            delete_cookie('remember_token');
        }
        ## render view 
        private function renderView($path, $isDisplaying){
            $this->loadGears();
            $this->loadCategories();
            if($isDisplaying) {
                $pager = \Config\Services::pager(); 
        
                $perPage = 10; 
                $gears = $this->gears->getAllPaginated($perPage);
        
                $data = [
                    'categories' => $this->categories->getAll(),
                    'gearsPerCategory' => $gears, 
                    'pager' => $this->gears->pager 
                ];
                return view($path, $data);
            }
            return view($path); 
        }
## ----- END ----- ##





## ----- LOGOUT ----- ##
    ## logout method
    public function logout()
    {
        $this->loadUserAccount();
        $this->loadSession();
        helper('cookie');
        
        $user_id = $this->session->get('user_id');
        if($user_id) {
            $this->userAccount->update($user_id, ['remember_token' => null]);
        }
        
        $this->session->destroy();    
        delete_cookie('remember_token');
        return redirect()->to('/');
    }
## ----- END ----- ##





## ----- ROUTES ----- ##
    ## User Setting
    public function userSettings() {
        return $this->checkSessionThenRedirect('UserSide/userSettings', true);
    }
## ----- END ----- ##

}