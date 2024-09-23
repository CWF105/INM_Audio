<?php 

namespace App\Controllers;
use Config\Session as SessionConfig;
use App\Models\Admin_Account_Model as AdminAccount;
use App\Models\User_Account_Model as UserAccount;
use App\Models\Category_Model as Categories;
use App\Models\Gear_Product_Model as Gears;

class AdminController extends BaseController
{
    protected $session;
    protected $adminAccount;
    protected $userAccount;
    protected $categories;
    protected $gears;
    protected $expirationTime;

    public function __construct() 
    {
        helper('cookie');
        $this->session = session();
        $this->adminAccount = new AdminAccount();
        $this->userAccount = new UserAccount();
        $this->categories = new Categories();
        $this->gears = new Gears();
        $this->expirationTime = (new SessionConfig())->expiration;
    }

    private function isSessionExpired()
    {
        return $this->session->get('timeLoggedIn') && (time() - $this->session->get('timeLoggedIn')) > $this->expirationTime;
    }

    private function checkSession()
    {
        if (!$this->session->get('isLoggedIn') || !$this->session->get('type')) {
            return redirect()->to('/');
        }

        if ($this->isSessionExpired()) {
            $this->handleLogout();
        }

        if ($this->session->get('type') !== 'admin' || !$this->session->get('admin_id')) {
            $this->session->destroy();
            return redirect()->to('/');
        }
    }

    private function handleLogout()
    {
        $admin_id = $this->session->get('admin_account_id');
        if ($admin_id) {
            $this->adminAccount->update($admin_id, ['remember_token' => null]);
        }
        $this->session->destroy();
        delete_cookie('remember_token');
    }

    private function renderView($path, $isDisplaying = false)
    {
        $this->checkSession();
        
        if ($isDisplaying) {
            $container['adminAccount'] = $this->adminAccount->getUser('admin_account_id', $this->session->get('admin_id'));
            $container['gears'] = $this->gears->getGearLeftJoinCategory();
            $container['categories'] = $this->categories->getAll();

            if (!$container['adminAccount']) {
                return redirect()->to('/admin/loggingOut');
            }

            return view($path, $container);
        }

        return view($path);
    }

    public function dashboard() 
    { 
        return $this->renderView('AdminSide/dashboard', true); 
    }

    public function transactions() 
    { 
        return $this->renderView('AdminSide/transactions', true); 
    }

    // Other redirect methods can follow this pattern

    public function logout()
    {
        $this->handleLogout();
        return redirect()->to('/');
    }

    // Refactored account creation method
    private function createAccount($model, $data, $redirectPath, $flashDataKey)
    {
        $usernameExists = $model->getUser('username', $data['username']);
        $emailExists = $model->getUser('email', $data['email']);

        if ($usernameExists && $emailExists) {
            session()->setFlashdata($flashDataKey, 'Both username and email are already in use.');
        } elseif ($usernameExists) {
            session()->setFlashdata($flashDataKey, 'Username is already in use.');
        } elseif ($emailExists) {
            session()->setFlashdata($flashDataKey, 'Email is already in use.');
        } else {
            $model->save($data);
            session()->setFlashdata('success', 'Account created successfully.');
        }

        return redirect()->to($redirectPath);
    }

    public function createNewAdmin()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ];

        return $this->createAccount($this->adminAccount, $data, '/admin/registerA', 'errorAdmin');
    }

    public function createNewUser()
    {
        $data = [
            'firstname' => $this->request->getPost('fname'),
            'lastname' => $this->request->getPost('lname'),
            'email' => $this->request->getPost('email'),
            'phone_number' => $this->request->getPost('pnum'),
            'username' => $this->request->getPost('user'),
            'password' => password_hash($this->request->getPost('pass'), PASSWORD_DEFAULT)
        ];

        return $this->createAccount($this->userAccount, $data, '/admin/registerU', 'errorUser');
    }

    // Other CRUD methods like `addGear`, `removeGear`, `addNewCategory`, `removeCategory`, etc. can be simplified similarly
}
