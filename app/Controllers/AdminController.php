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
            $container['gears'] = $gears->getGearLeftJoinCategory();
            $container['categories'] = $categories->getAll();
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
        return $this->isSessionSetThenRedirect('AdminSide/dashboard'); 
    }


// redirect to transactions
    public function transactions() 
    { 
        return $this->isSessionSetThenRedirect('AdminSide/transactions'); 
    }


// redirect to gearManagement / addGear / addCategory
    public function gearManagement() 
    { 
        return $this->isSessionSetThenRedirect('AdminSide/gearManagement/gearManagement', true); 
    }
    public function addGears() 
    {
        return $this->isSessionSetThenRedirect('AdminSide/gearManagement/addGear', true);;
    }
    public function addCategories()
    {
        return $this->isSessionSetThenRedirect('AdminSide/gearManagement/addCategory', true);;
    }


// redirect to register
    public function register() 
    { 
        return $this->isSessionSetThenRedirect('AdminSide/registerA'); 
    }


// redirect to registerUser
    public function registerUser() 
    { 
        return $this->isSessionSetThenRedirect('AdminSide/registerU'); 
    }


// redirect to accountSetting
    public function accountSetting() 
    { 
        return $this->isSessionSetThenRedirect('AdminSide/accountSetting'); 
    }









## ---------------------------------------------------------------------
// create admin account
    public function createNewAdmin()
    {
        
    }


// create user account
    public function createNewUser()
    {

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
}