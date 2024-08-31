<?php

namespace App\Controllers;
/*

#logout - logout method controller to log out accounts
#session - check the session if there is an account logged in

#dashboard - redirect to dashboard page in admin panel
#transactions - redirect to transaction page in admin panel
#manageUsers - redirect to manage_users page in admin panel
#products - redirect to products page in admin panel

#registerAdmin - redirect to registerAdmin page in admin panel
#registerUser - redirect to registerUser page in admin panel

#createAdmin - a controller for creating new admin account
#createUser - a controller for creating new admin account

#addGears - a controller for adding new gear
#addCategory - a controller for adding new category for gears


*/

use App\Models\admin_account_model;
use App\Models\user_account_model;
use App\Models\category_table_model;
use App\Models\products_table_model;

use Config\Session as SessionConfig;

class AdminControl extends BaseController
{
    #session
    public function isSessionSetThenRedirect($page, $isDisplaying = false)
    {
        helper('cookie');
        $session = session();
        $sessionConfig = new SessionConfig();
        $expirationTime = $sessionConfig->expiration;
        $adminAccount = new admin_account_model();
        $categoryModel = new category_table_model();
        $productsModel = new products_table_model();

        $userAdmin_id = $session->get('admin_account_id');
        $userAdmin_username = $session->get('username');

        if(!$session->get('isLoggedIn') && !$session->get('account_type') ||
            $session->get('isLoggedIn') && $session->get('account_type') == 'user') {
            return redirect()->to('/');
        }

        if($session->get('timeLoggedIn') && (time() - $session->get('timeLoggedIn')) > $expirationTime) {
            $adminAccount->update($userAdmin_id, ['remember_token' => null]);
            $adminAccount->update($userAdmin_username, ['remember_token' => null]);
            $session->destroy();
            delete_cookie('remember_token');
            return redirect()->to('/');
        }

        if($isDisplaying == true) {
            $container = [];
            $container['categories'] = $categoryModel->getcategories();
            $container['showProducts'] = $productsModel->getGearAlongWIthCategory();

            return view($page, $container);
        }
        return view($page);
    }

# ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- #

    #logout
    public function logout() 
    {
        helper('cookie');
        $session = session();
        $adminAccount = new admin_account_model();
        
        $userAdmin_id = $session->get('admin_account_id');
        if($userAdmin_id) {
            $adminAccount->update($userAdmin_id, ['remember_token' => null]);
        }
        
        $session->destroy();    
        delete_cookie('remember_token');
        return redirect()->to('/');
    }


# ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- #


    #dashboard
    public function dashboard() 
    {
        return $this->isSessionSetThenRedirect('AdminSide/adminIndex');
    }


    #transactions
    public function transactions()
    {
        return $this->isSessionSetThenRedirect('AdminSide/adminTransactions');
    }


    #manageUsers
    public function manageusers()
    {
        return $this->isSessionSetThenRedirect('AdminSide/adminManageUsers');
    }


    #products
    public function products()
    {
        return $this->isSessionSetThenRedirect('AdminSide/adminProducts', true);
    }



    #registerAdmin
    public function register()
    {
        return $this->isSessionSetThenRedirect('AdminSide/adminRegister');
    }


    #registerUser
    public function registerUser()
    {
        return $this->isSessionSetThenRedirect('AdminSide/adminRegisterUser');
    }


# ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- #



    #createAdmin
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

        $usernameExists = $adminAccountModel->getUsername($username);
        $emailExists = $adminAccountModel->getEmail($email);

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
    
            $usernameExist = $userAccount->getUsername($username);
            $emailExist = $userAccount->getEmail($email);
    
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


# ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- #


    #addGears
    public function addGears() 
    {
        $productGear = new products_table_model();
    
        $gearName = $this->request->getPost('gear');
        $description = $this->request->getPost('description');
        $price = $this->request->getPost('price');
        $quantity = $this->request->getPost('quantity');
        $category = $this->request->getPost('categorySelected');
        $gearImageUrl = $this->request->getFile('image');
    
        $gearIsExist = $productGear->getGear($gearName);
        
        if ($gearIsExist) {
            return redirect()->back()->with('gearError', '\'' . $gearName . '\' gear already exists');
        }
        if($category == "") { $category = null; }

        if ($gearImageUrl->isValid() && !$gearImageUrl->hasMoved()) {
            $generatedRandomName = $gearImageUrl->getRandomName();
            $gearImageUrl->move('Admin_side_Assets/uploads/', $generatedRandomName);
            $imageUrlPath = base_url('Admin_side_Assets/uploads/' . $generatedRandomName);
    
            $productGear->save([
                'category_id' => $category,
                'product_name' => $gearName,
                'description' => $description,
                'price' => $price,
                'stock_quantity' => $quantity,
                'image_url' => $imageUrlPath
            ]);

            if($category == "") {
                return redirect()->back()->with('gearAdded', '\'' . $gearName . '\' Gear Added, but category is not set');
            }
            return redirect()->back()->with('gearAdded', '\'' . $gearName . '\' Gear Added');
        }
        return redirect()->back()->with('gearError', 'Image is not set or not valid!');
    }
    

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