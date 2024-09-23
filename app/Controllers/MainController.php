<?php

namespace App\Controllers;
use Config\Session as SessionConfig;
use App\Models\User_Account_Model as userAccount;
use App\Models\Category_Model as categories;
use App\Models\Gear_Product_Model as gears;

class MainController extends BaseController
{
    protected $session;
    protected $sessionConfig;
    protected $expirationTime;
    protected $userAccount;
    protected $categories;
    protected $gearProduct;

    public function __construct()
    {
        $this->session = session();
        $this->sessionConfig = new SessionConfig();
        $this->expirationTime = $this->sessionConfig->expiration;
        $this->userAccount = new userAccount();
        $this->categories = new categories();
        $this->gearProduct = new gears();
    }

    // Check if session is set, redirect based on role, or render the view
    public function handleSession($path, $isDisplaying = false)
    {
        if ($this->isAdmin()) {
            return redirect()->to('/admin/dashboard');
        }

        if ($this->isSessionExpired()) {
            $this->logoutSession();
            return redirect()->to('/');
        }

        return $this->renderView($path, $isDisplaying);
    }

    // Check if admin session is set
    private function isAdmin()
    {
        return $this->session->get('type') == "admin" && $this->session->get('isLoggedIn') && $this->session->get('admin_id');
    }

    // Check if session is expired
    private function isSessionExpired()
    {
        return $this->session->get('timeLoggedIn') && (time() - $this->session->get('timeLoggedIn')) > $this->expirationTime;
    }

    // Logout session and clear tokens
    private function logoutSession()
    {
        $user_id = $this->session->get('user_id');
        $username = $this->session->get('username');
        $this->userAccount->update($user_id, ['remember_token' => null]);
        $this->userAccount->update($username, ['remember_token' => null]);
        delete_cookie('remember_token');
    }

    // Render view with optional data
    private function renderView($path, $isDisplaying)
    {
        if ($isDisplaying) {
            $data = [
                'categories' => $this->categories->getAll(),
                'gearsPerCategory' => $this->gearProduct->getAll(),
            ];
            return view($path, $data);
        }

        return view($path);
    }

    // Logout controller
    public function logout()
    {
        helper('cookie');
        $user_id = $this->session->get('admin_account_id');
        if ($user_id) {
            $this->userAccount->update($user_id, ['remember_token' => null]);
        }

        $this->session->destroy();
        delete_cookie('remember_token');
        return redirect()->to('/');
    }

    // Routes
    public function homepage() { return $this->handleSession('homepage'); }
    public function library() { return $this->handleSession('library', true); }
    public function community() { return $this->handleSession('community', true); }
    public function customize() { return $this->handleSession('customize', true); }
    public function login() { return $this->handleSession('signup_login'); }
    public function userSettings() { return $this->handleSession('UserSide/userSettings', true); }
}
