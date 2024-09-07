<?php

namespace App\Controllers;
use Config\Session as SessionConfig;
use App\Models\Admin_Account_Model as adminAccount;
use App\Models\User_Account_Model as userAccount;
use App\Models\Category_Model as categories;
use App\Models\Gear_Product_Model as gears;

class AdminController extends BaseController
{
// check if session is set to admin account or is not set to any account
    public function isSessionSetThenRedirect($path, $isDisplaying = false)
    {
        helper('cookie');
        $session = session();
        $sessionConfig = new SessionConfig();
        $expirationTime = $sessionConfig->expiration;
        $adminAccount = new adminAccount();
        $categories = new categories();
        $gears = new gears();
        
        $admin_id = $session->get('admin_id');
        $username = $session->get('username');

        if(!$session->get('isLoggedIn') && !$session->get('type')) {
            return redirect()->to('/');
        }

        if($session->get('timeLoggedIn') && (time() - $session->get('timeLoggedIn')) > $expirationTime) {
            $adminAccount->update($admin_id, ['remember_token' => null]);
            $adminAccount->update($username, ['remember_token' => null]);
            $session->destroy();
            delete_cookie('remember_token');
            return redirect()->to('/');
        }

        if($session->get('type') !== "admin" && !$session->get('isLoggedIn') && !$session->get('admin_id'))
        {
            $session->destroy();
            return redirect()->to('/');
        }

        if($isDisplaying == true) {
            $container = []; 
            $container['adminAccount'] = $adminAccount->getUser('admin_account_id', session()->get('admin_id'));
            $container['gears'] = $gears->getGearLeftJoinCategory();
            $container['categories'] = $categories->getAll();

            if(!$container['adminAccount']) {
                return redirect()->to('/admin/loggingOut');
            }
            return view($path, $container);
        }
        return view($path);
    }


// logout controller
    public function logout()
    {
        helper('cookie');
        $session = session();
        $adminAccount = new adminAccount();
        
        $admin_id = $session->get('admin_account_id');
        if($admin_id) {
            $adminAccount->update($admin_id, ['remember_token' => null]);
        }
        
        $session->destroy();    
        delete_cookie('remember_token');
        return redirect()->to('/');
    }










## ---------------------------------------------------------------------
// redirect to dashboard
    public function dashboard() 
    { 
        return $this->isSessionSetThenRedirect('AdminSide/dashboard', true); 
    }


// redirect to transactions
    public function transactions() 
    { 
        return $this->isSessionSetThenRedirect('AdminSide/transactions', true); 
    }


// redirect to gearManagement / addGear / addCategory
    public function gearManagement() 
    { 
        return $this->isSessionSetThenRedirect('AdminSide/gearManagement/gearManagement', true); 
    }
    // redirect to add gears page
    public function addGears() 
    {
        return $this->isSessionSetThenRedirect('AdminSide/gearManagement/addGear', true);;
    }
    // redirect to add categories page
    public function addCategories()
    {
        return $this->isSessionSetThenRedirect('AdminSide/gearManagement/addCategory', true);;
    }


// redirect to register
    public function register() 
    { 
        return $this->isSessionSetThenRedirect('AdminSide/register/registerA'); 
    }


// redirect to registerUser
    public function registerUser() 
    { 
        return $this->isSessionSetThenRedirect('AdminSide/register/registerU'); 
    }


// redirect to accountSetting
    public function accountSetting() 
    { 
        return $this->isSessionSetThenRedirect('AdminSide/accountSetting', true); 
    }









## ---------------------------------------------------------------------
// create admin account
    public function createNewAdmin()
    {
        $adminAccountModel = new adminAccount();

        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $prepareData = [
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword
        ];

        $usernameExists = $adminAccountModel->getUser('username', $username);
        $emailExists = $adminAccountModel->getUser('email', $email);

        if ($usernameExists && $emailExists) {
            session()->setFlashdata('errorAdmin', 'Both username and email are already in use.');
            return redirect()->to('/admin/registerA');
        } elseif ($usernameExists) {
            session()->setFlashdata('errorAdmin', 'Username is already in use.');
            return redirect()->to('/admin/registerA');
        } elseif ($emailExists) {
            session()->setFlashdata('errorAdmin', 'Email is already in use.');
            return redirect()->to('/admin/registerA');
        } else {
            $adminAccountModel->save($prepareData);
            session()->setFlashdata('successAdmin', 'Administrator account created successfully.');
            return redirect()->to('/admin/registerA');
        }
    }


// create user account
    public function createNewUser()
    {
        $userAccount = new userAccount();
            
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

        $usernameExist = $userAccount->getUser('username', $username);
        $emailExist = $userAccount->getUser('email', $email);

        if ($usernameExist && $emailExist) {
            session()->setFlashdata('errorUser', 'Both username and email are already in use.');
            return redirect()->to('/admin/registerU');
        } elseif ($usernameExist) {
            session()->setFlashdata('errorUser', 'Username is already in use.');
            return redirect()->to('/admin/registerU');
        } elseif ($emailExist) {
            session()->setFlashdata('errorUser', 'Email is already in use.');
            return redirect()->to('/admin/registerU');
        } else {
            $userAccount->save($prepareData);
            session()->setFlashdata('successUser', 'Account created successfully.');
            return redirect()->to('/admin/registerU');
        }
    }










## ---------------------------------------------------------------------
// add new gear
    public function addGear() 
    {
        $productGear = new gears();

        $gearName = $this->request->getPost('gear');
        $description = $this->request->getPost('description');
        $price = $this->request->getPost('price');
        $quantity = $this->request->getPost('quantity');
        $category = $this->request->getPost('categorySelected');
        $gearImageUrl = $this->request->getFile('image');

        $gearIsExist = $productGear->getGear('product_name', $gearName);
        
        if ($gearIsExist) {
            return redirect()->back()->with('gearError', '\'' . $gearName . '\' gear already exists');
        }
        if($category == "") { $category = null; }

        if ($gearImageUrl->isValid() && !$gearImageUrl->hasMoved()) {
            $generatedRandomName = $gearImageUrl->getRandomName();
            $gearImageUrl->move('admin/uploads/', $generatedRandomName);
            $imageUrlPath = base_url('admin/uploads/' . $generatedRandomName);

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




// remove gear
    public function removeGear($id) 
    {
        $gears = new Gears();
        
        if ($gears->delete($id)) {
            return redirect()->to('/admin/gears')->with('removeSuccess', 'Product deleted successfully.');
        }
    }



// add new category
    public function addNewCategory()
    {
        $categories = new categories();
        $category = $this->request->getPost('category');
        $retrieveCategory = $categories->getCategory('category', $category);

        if($retrieveCategory) {
            return redirect()->back()->with('catError', '\'' . $category . '\' category already exist');
        }
        $categories->save(['category' => $category]);
        return redirect()->back()->with('catAdded', '\''. $category .'\' category Added');          
    }

// remove category by id
    public function removeCategory($id)
    {
        $categories = new categories();
        if ($categories->delete($id)) {
            return redirect()->to('/admin/gears/addCategory')->with('catDeleted', 'Category deleted successfully.');
        }
    }



// update admin account - admin settings panel
    public function updateAdmin() 
    {
        $session = session();
        $adminAccount = new adminAccount();

        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $admin = $adminAccount->getUser('admin_account_id', $session->get('admin_id'));
        $adminUsername = $adminAccount->getUser('username', $username);
        $adminEmail = $adminAccount->getUser('email', $email);

        // check if the image file is empty - if not empty proceed with this if statement
        if(!empty($this->request->getFile('profile_pic')) && $this->request->getFile('profile_pic')->isValid()) {
            $pfp = $this->request->getFile('profile_pic');
            $data['profile_pic'] = file_get_contents($pfp->getTempName());

            $adminAccount->update($admin, $data);
            return redirect()->back()->with('successUpdateProfile', 'Profile updated successfully.');
        }

        // check if username, email or both are existing and already in use by another or currently in used
        if($adminUsername) {
            $session->setFlashdata('existingUsername', 'Username is already in use');
            return redirect()->back();
        }
        if($adminEmail) {
            $session->setFlashdata('existingEmail', 'Email is already in use');
            return redirect()->back();
        }
        if($adminUsername && $adminEmail) {
            $session->setFlashdata('existingBoth', 'Username and Email is already in use');
            return redirect()->back();
        }

        // check if the password field is empty if empty proceed and update without the password
        if(!empty($password)) {
            $data = [
                'username' => $username,
                'email' => $email
            ];
            if($this->request->getFile('profile_pic')->isValid()) {
                $pfp = $this->request->getFile('profile_pic');
                $data['profile_pic'] = file_get_contents($pfp->getTempName());
            }
            $adminAccount->update($admin, $data);
            return redirect()->back()->with('successUpdateProfile', 'Profile updated successfully.');
        }

        // if the conditions above didnt turn true, proceed with this one below
        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $password
        ];

        if($this->request->getFile('profile_pic')->isValid()) {
            $pfp = $this->request->getFile('profile_pic');
            $data['profile_pic'] = file_get_contents($pfp->getTempName());
        }

        $adminAccount->update($admin, $data);
        return redirect()->back()->with('successUpdateProfile', 'Profile updated successfully.');
    }



// delete admin account - admin settings panel
    public function deleteAdmin($id)
    {
        helper('cookie');
        $session = session();
        $adminAccount = new adminAccount();

        $session->destroy();    
        delete_cookie('remember_token');
        $adminAccount->delete($id);
        return redirect()->to('/');
    }
}