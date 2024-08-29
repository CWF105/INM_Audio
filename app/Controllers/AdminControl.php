<?php

namespace App\Controllers;
/*
press 'CTRL + F' to open search bar and type the methods starting with '#'
enter '##' for a group of methods
enter '#' for a method

##redirectToPages
    #dashboard
    #transactions
    #manageUsers
    #products
    #productsTable
    #registerAdmin
    #registerUser

##registerControls
    #createAdmin
    #createUser

##categoryControls
    #category
    #addCategory

##gearControls
    #products
    #addGears

other Controllers
    #displaying
    #logout
    #manageAccountsController
    #session
*/

use App\Models\admin_account_model;
use App\Models\user_account_model;
use App\Models\category_table_model;
use App\Models\products_table_model;

use Config\Session as SessionConfig;

class AdminControl extends BaseController
{

// >>>>>   NAVIGATIONS AND VALIDATIONS OF PAGES    <<<<< //
// CHECK SESSIONS AND REDIRECT
    #session
    #displaying
    public function checkIfSessionIsSet($admin = null, $ifNotSet = null, $data = null)
    {
        $session = session();
        $sessionConfig = new SessionConfig();
        $expirationTime = $sessionConfig->expiration;
        $adminAccount = new admin_account_model();
        $categoryModel = new category_table_model();

        $userAdmin_id = $session->get('admin_account_id');
        $userAdmin_username = $session->get('username');
        helper('cookie');

        if(session()->get('isLoggedIn') && session()->get('account_type') === 'admin') {
            if($session->get('timeLoggedIn') && (time() - $session->get('timeLoggedIn')) > $expirationTime) {
                $adminAccount->update($userAdmin_id, ['remember_token' => null]);
                $adminAccount->update($userAdmin_username, ['remember_token' => null]);
                $session->destroy();
                delete_cookie('remember_token');
                return redirect()->to('/');
            }
            else {
                #category - getting categories and displaying 
                if($data != null && $data == 'category'){
                    $val['category'] = $categoryModel->getcategories();
                    $data = $val['category'];
                    return view($admin, $val);
                }
                return view($admin);
            }
        }
        return redirect()->to($ifNotSet);
    }

// >>>>> .......... <<<<< //
// DIRECT TO ADMINISTRATOR PAGES
    // redirect to dashboard (main page after login)
    ##redirectToPages
    #dashboard
    public function dashboard() 
    {
        $checkSession = new AdminControl();
        return $checkSession->checkIfSessionIsSet('AdminSide/adminIndex', '/');
    }


    // direct to transactions (management of tracsactions made)
    #transactions
    public function transactions()
    {
        $checkSession = new AdminControl();
        return $checkSession->checkIfSessionIsSet('AdminSide/adminTransactions', '/');
    }


    // direct to manageusers (management of user accounts included the admin accounts)
    #manageUsers
    public function manageusers()
    {
        $checkSession = new AdminControl();
        return $checkSession->checkIfSessionIsSet('AdminSide/adminManageUsers', '/');
    }


    // direct to products (management of products)
    #products
    public function products()
    {
        $checkSession = new AdminControl();
        return $checkSession->checkIfSessionIsSet('AdminSide/adminProducts', '/', 'category');
    }



    // direct to register (page dedicated to the creation of administrator account)
    #registerAdmin
    public function register()
    {
        $checkSession = new AdminControl();
        return $checkSession->checkIfSessionIsSet('AdminSide/adminRegister', '/');
    }

    // direct to register (page dedicated to the creation of User accounts)
    #registerUser
    public function registerUser()
    {
        $checkSession = new AdminControl();
        return $checkSession->checkIfSessionIsSet('AdminSide/adminRegisterUser', '/');
    }




// >>>>>  functions to LOGOUT of admin page and redirect back to homepage(no account)
    // remove/unset and destroy the current session and redirect to homepage
    #logout
    public function logout() 
    {
        $session = session();
        $adminAccount = new admin_account_model();
        helper('cookie');
        
        $userAdmin_id = $session->get('admin_account_id');
        if($userAdmin_id) {
            $adminAccount->update($userAdmin_id, ['remember_token' => null]);
        }
        
        $session->destroy();    
        delete_cookie('remember_token');
        return redirect()->to('/');
    }




// >>>>>    FUNCTION FOR ADMIN PAGES     <<<<< //
    ##registerControls
    #createAdmin
    // creating new admin account
    public function create_new_admin() 
    {
        $adminAccountModel = new admin_account_model();

        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $prepareData = [
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword
        ];

        $usernameExists = $adminAccountModel->checkUsername($username);
        $emailExists = $adminAccountModel->checkEmail($email);

        if ($usernameExists && $emailExists) {
            session()->setFlashdata('errorAdmin', 'Both username and email are already in use.');
            return redirect()->to('/admin/registerAd');
        } elseif ($usernameExists) {
            session()->setFlashdata('errorAdmin', 'Username is already in use.');
            return redirect()->to('/admin/registerAd');
        } elseif ($emailExists) {
            session()->setFlashdata('errorAdmin', 'Email is already in use.');
            return redirect()->to('/admin/registerAd');
        } else {
            $adminAccountModel->save($prepareData);
            session()->setFlashdata('successAdmin', 'Administrator account created successfully.');
            return redirect()->to('/admin/registerAd');
        }
    }


    #createUser
    // creating new user account through admin panel though
    public function create_new_user()
        {
            $userAccount = new user_account_model();
            
            $firstName = $this->request->getPost('fname');
            $lastName = $this->request->getPost('lname');
            $email = $this->request->getPost('email');
            $phonenumber = $this->request->getPost('pnum');
            $username = $this->request->getPost('user');
            $password = $this->request->getPost('pass');
    
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            $prepareData = [
                'firstname' => $firstName,
                'lastname' => $lastName,
                'email' => $email,
                'phone_number' => $phonenumber,
                'username' => $username,
                'password' => $hashedPassword
            ];
    
            $usernameExist = $userAccount->checkUsername($username);
            $emailExist = $userAccount->checkEmail($email);
    
            if ($usernameExist && $emailExist) {
                session()->setFlashdata('errorUser', 'Both username and email are already in use.');
                return redirect()->to('/admin/registerUs');
            } elseif ($usernameExist) {
                session()->setFlashdata('errorUser', 'Username is already in use.');
                return redirect()->to('/admin/registerUs');
            } elseif ($emailExist) {
                session()->setFlashdata('errorUser', 'Email is already in use.');
                return redirect()->to('/admin/registerUs');
            } else {
                $userAccount->save($prepareData);
                session()->setFlashdata('successUser', 'Account created successfully.');
                return redirect()->to('/admin/registerUs');
            }
        }

    // user account management ( managing accounts for users of this website : i will also include later the management of admin accounts)
    #manageAccountsController
    public function manageAccounts() 
    {

    }


// >>>>>    OTHER CONTROLS  <<<<< //
    #addGears
    public function addGears() 
    {
        $productGear = new products_table_model();
    
        $category = $this->request->getPost('categorySelected');
        $gearName = $this->request->getPost('gear');
        $description = $this->request->getPost('description');
        $price = $this->request->getPost('price');
        $quantity = $this->request->getPost('quantity');
        $gearImageUrl = $this->request->getFile('image');
    
        $gearIsExist = $productGear->checkProductExistent($gearName);
        
        if ($gearIsExist) {
            return redirect()->back()->with('gearError', '\'' . $gearName . '\' gear already exists');
        }
    
        if ($gearImageUrl->isValid() && !$gearImageUrl->hasMoved()) {
            $generatedRandomName = $gearImageUrl->getRandomName();
            $gearImageUrl->move('/assets/uploads/', $generatedRandomName);
            $imageUrlPath = base_url('assets/uploads/' . $generatedRandomName);
    
            $productGear->save([
                'category_id' => $category,
                'product_name' => $gearName,
                'description' => $description,
                'price' => $price,
                'stock_quantity' => $quantity,
                'image_url' => $imageUrlPath
            ]);
            return redirect()->back()->with('gearAdded', '\'' . $gearName . '\' Gear Added');
        }
        return redirect()->back()->with('gearError', 'Something went wrong!');
    }
    

    ##categoryControls
    #addCategory
    public function addNewCategory()
    {
        $categories = new category_table_model();
        $category = $this->request->getPost('category');
        $action = $this->request->getPost('action');
        $retrieveCategory = $categories->getCategory($category);

        if ($action == 'add') {
            if($retrieveCategory) {
                return redirect()->back()->with('categoryError', '\'' . $category . '\' category already exist');
            }
            $categories->save(['category' => $category]);
            return redirect()->back()->with('categoryCreated', '\''. $category .'\' category Added');
        } elseif ($action == 'delete') {
            if($retrieveCategory) {
                $categories->where('category', $category)->delete();
                return redirect()->back()->with('categoryCreated', '\'' . $category . '\' category deleted!');
            }
            return redirect()->back()->with('categoryError', '\'' . $category . '\' category does\'nt exist');
        }
    }

}