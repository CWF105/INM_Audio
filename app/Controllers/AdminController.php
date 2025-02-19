<?php

namespace App\Controllers;

class AdminController extends BaseController
{
## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- SESSION ----- ##
    protected function checkAdminSession($path, $data = null) {
        if(!$this->isAdmin()) {
            return redirect()->to('/');
        }
        if($this->isSessionExpired()) {
            $this->deleteCookiesAndSession("admin");
            return redirect()->to('/')->with('sessionTimeout', 'Session Timeout, login again');
        }
        if($data != null) {
            return view($path, $data);
        }
        return view($path);
    }

## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- LOGOUT ----- ##
    public function logout(){
        helper('cookie');
        $this->load->requireMethod('adminAccount');
        
        $admin_id = $this->load->session->get('admin_id');
        if($admin_id) {
            $this->load->adminAccount->update($admin_id, ['remember_token' => null]);
        }
        
        $this->load->session->destroy();    
        delete_cookie('remember_token');
        return redirect()->to('/');
    }

    public function chart($time) {
        $this->load->requireMethod('orders');
        $result = $this->load->orders->totalSalesChart($time);
        $chart = [];
        foreach($result as $row) {
            $chart = [$row['time']];
        }
        return $chart;
    }
## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- ROUTES ----- ##
    // to edit
    public function dashboard() { 
        $this->load->requireMethod('adminAccount');
        $this->load->requireMethod('gears');
        $this->load->requireMethod('orders');
        $this->load->requireMethod('placed');   
        // $this->load->requireMethod('notif');   

        // $notifications = $this->load->notif->getNotifications();
        // $unreadCount = $this->load->notif->getUnreadCount();

        $data = [
            'adminAccount' => $this->load->adminAccount->getUser('admin_account_id', $this->load->session->get('admin_id')),
            'numberItems' => $this->load->gears->countAllGears(),
            'totalOrders' => $this->load->orders->getTotalOrders(),
            'totalPlaced' => $this->load->placed->getTotalPlaced(),
            'totalConfirmed' => $this->load->orders->getTotalConfirmed(),
            'totalCancelled' => $this->load->orders->getTotalCancelled(),
            'totalComplete' => $this->load->orders->getTotalComplete(),
            'totalRevenue' => $this->load->orders->getTotalRevenue(),
            'recentOrders' => $this->load->orders->getRecentOrders(),
        ];
        return $this->checkAdminSession('AdminSide/dashboard', $data);
    }

    ## redirect to transactions
    public function orders_transactions() { 
        $this->load->requireMethod('adminAccount');
        $this->load->requireMethod('orders');
        $this->load->requireMethod('placed');

        $data = [
            'adminAccount' => $this->load->adminAccount->getUser('admin_account_id', $this->load->session->get('admin_id')),
            'cancelledOrders' => $this->load->orders->getCancelledOrders(),
            'orders' => $this->load->orders->getOrders(),
            'complete' => $this->load->orders->getCompleteOrders(),
            'totalOrders' => $this->load->orders->getTotalOrders(),
            'totalPlaced' => $this->load->placed->getTotalPlaced(),
            'totalCancelled' => $this->load->orders->getTotalCancelled(),
            'totalComplete' => $this->load->orders->getTotalComplete(),
            'totalRevenue' => $this->load->orders->getTotalRevenue(),
            'confirmOrder' => $this->load->placed->getAllOrders()
        ];
        return $this->checkAdminSession('AdminSide/orders_transactions', $data);
    }
    

    ## redirect to gearManagement / addGear / addCategory
    public function gearManagement($dataVal = null) { 
        $this->load->requireMethod('adminAccount');
        $this->load->requireMethod('gears');
        $this->load->requireMethod('categories');  
        $data = [
            'adminAccount' => $this->load->adminAccount->getUser('admin_account_id', $this->load->session->get('admin_id')),
            'categories' => $this->load->categories->getAll(),
            'gears' => $dataVal ? $dataVal : $this->load->gears->getGearLeftJoinCategory()       
        ];
        return $this->checkAdminSession('AdminSide/management', $data);
    }

    ## redirect to gearManagement / addGear / addCategory
    public function customers() { 
        $this->load->requireMethod('adminAccount');
        $this->load->requireMethod('userAccount');

        $toGet = $this->request->getGet("search");

        if($toGet) {
            $users = $this->load->userAccount->searchUsers($toGet);
        }
        else {
            $users = $this->load->userAccount->getAll();
        }

        $data = [
            'adminAccount' => $this->load->adminAccount->getUser('admin_account_id', $this->load->session->get('admin_id')),
            'search' => $toGet,
            'userAccount' => $users
        ];
        return $this->checkAdminSession('AdminSide/customers', $data);
    }
    ## view user information 
    public function viewUserInformation($id) {
        $this->load->requireMethod('adminAccount');
        $this->load->requireMethod('userAccount');

        $userInfo = $this->load->userAccount->getUser('user_id', $id);
        $userOrders = $this->load->userAccount->getUserOrders($id);
        $data = [
            'adminAccount' => $this->load->adminAccount->getUser('admin_account_id', $this->load->session->get('admin_id')),
            'userInfo' => $userInfo,
            'orders' => $userOrders
        ];

        return $this->checkAdminSession('AdminSide/includes/viewUserInfo', $data);
    }

    ## redirect to register
    public function register() { 
        return $this->checkAdminSession('AdminSide/register/registerA');
    }

    ## redirect to registerUser
    public function registerUser() { 
        return $this->checkAdminSession('AdminSide/register/registerU');
    }

    ## redirect to accountSetting
    public function account() { 
        $this->load->requireMethod('adminAccount');
        $data = [
            'adminAccount' => $this->load->adminAccount->getUser('admin_account_id', $this->load->session->get('admin_id'))
        ];
        return $this->checkAdminSession('AdminSide/account', $data);
    }
## ----- END ----- ##


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- CREATE ACCOUNT FOR USER AND ADMINISTRATOR ----- ##
    ## create new admin
    public function createNewAdmin() {
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $cpassword = $this->request->getPost('cpassword');

        if($password == $cpassword) {
            $this->load->session->set([
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'signupAccountType' => 'admin_admin'
            ]);
            return $this->checkIfExist();
        }
        else {
            $this->load->session->setFlashdata('error', 'Password did not match');
            return redirect()->to('/admin/registerA');
        }
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    ## create new user
    public function createNewUser() {  
        $password = $this->request->getPost('pass');
        $cpassword = $this->request->getPost('cpass');
        if($password == $cpassword) {
            $this->load->session->set([
                'fname' => $this->request->getPost('fname'),
                'lname' => $this->request->getPost('lname'),
                'email' => $this->request->getPost('email'),
                'phonenumber' => $this->request->getPost('pnum'),
                'username' => $this->request->getPost('user'),
                'password' => $password,
                'signupAccountType' => 'admin_user'
            ]);
            return $this->checkIfExist();
        }
        else {
            $this->load->session->setFlashdata('error', 'Password did not match');
            return redirect()->to('/admin/registerU');
        }
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    ## check if user or admin account existing
    private function checkIfExist() {  
        $this->load->requireMethod('adminAccount');
        $this->load->requireMethod('userAccount');
        $this->load->requireMethod('emailVerify');

        $isAdminUsernameExist = $this->load->adminAccount->getUser('username', $this->load->session->get('username'));
        $isAdminEmailExist = $this->load->adminAccount->getUser('email', $this->load->session->get('email'));
        $isUserUsernameExist = $this->load->userAccount->getUser('username', $this->load->session->get('username'));
        $isUserEmailExist = $this->load->userAccount->getUser('email', $this->load->session->get('email'));
        if(($isAdminUsernameExist && $isAdminEmailExist) || ($isUserUsernameExist && $isUserEmailExist)) {
            $this->load->session->setFlashdata('error', 'Both username and email are already in use.');
            if($this->load->session->get('signupAccountType') == "admin_admin") {
                return redirect()->to('/admin/registerA');
            }
            else if($this->load->session->get('signupAccountType') == "admin_user") {
                return redirect()->to('/admin/registerU');
            }
        }
        else if($isAdminUsernameExist || $isUserUsernameExist) {
            $this->load->session->setFlashdata('error', 'Username is already in use.');
            if($this->load->session->get('signupAccountType') == "admin_admin") {
                return redirect()->to('/admin/registerA');
            }
            else if($this->load->session->get('signupAccountType') == "admin_user") {
                return redirect()->to('/admin/registerU');
            }
        }
        else if($isAdminEmailExist || $isUserEmailExist) {
            $this->load->session->setFlashdata('error', value: 'Email is already in use.');
            if($this->load->session->get('signupAccountType') == "admin_admin") {
                return redirect()->to('/admin/registerA');
            }
            else if($this->load->session->get('signupAccountType') == "admin_user") {
                return redirect()->to('/admin/registerU');
            }
        }
        else {
            return $this->load->emailVerify->sendEmailVerification($this->load->session->get('email'));
        }
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    ## check if verification code is valid or not
    public function checkIfVerificationCodeIsValid($verificationCode){
        $this->load->requireMethod('expirationTime');

        $expiryTime = $this->load->session->get('verification_expiry');
    
        if ($this->load->session->get('verification') == $verificationCode) {
            if (time() < $expiryTime) {
                return $this->saveData();
            } else {
                $this->load->session->setFlashdata('userError', 'The verification code has expired.');
                return redirect()->to('/account/verify-email');
            }
        }
    
        $this->load->session->setFlashdata('userError', 'Invalid verification code.');
        return redirect()->to('/account/verify-email');
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    ## saves data 
    private function saveData() {
        $this->load->requireMethod('adminAccount');
        $this->load->requireMethod('userAccount');

        if($this->load->session->get('signupAccountType') == "admin_admin") {
            $this->load->adminAccount->save([
                'username' => $this->load->session->get('username'),
                'email' => $this->load->session->get('email'),
                'password' => password_hash($this->load->session->get('password'), PASSWORD_DEFAULT)
            ]);
            $this->removeTempSession(1);

            $this->load->session->setFlashdata('success', 'account created');
            return redirect()->to('/admin/registerA');
        }
        else if($this->load->session->get('signupAccountType') == "admin_user") {
            $this->load->userAccount->save([
                'firstname' => $this->load->session->get('fname'), 
                'lastname' => $this->load->session->get('lname'), 
                'email' => $this->load->session->get('email'),
                'phone_number' => $this->load->session->get('phonenumber'),
                'username' => $this->load->session->get('username'),
                'password' => password_hash($this->load->session->get('password'), PASSWORD_DEFAULT)
            ]);
            $this->removeTempSession(2);
            $this->load->session->setFlashdata('success', 'account created');
            return redirect()->to('/admin/registerU');
        }      
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- SEARCH GEAR ----- ##
    public function searchGears() {
        $this->load->requireMethod('gears');
        $query = $this->request->getGet('search');
        $gears = $this->load->gears->searchGears($query);
        return $this->gearManagement($gears);
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- add new gear ----- ##
    public function addGear() {
        $this->load->requireMethod('gears');

        $gearName = $this->request->getPost('gearname');
        $description = $this->request->getPost('description');
        $price = $this->request->getPost('price');
        $quantity = $this->request->getPost('stock');
        $category = $this->request->getPost('category');
        $gearImageUrl = $this->request->getFile('img');

        $gearIsExist = $this->load->gears->getGear('product_name', $gearName);
        
        if ($gearIsExist) {
            return redirect()->back()->with('gearError', '\'' . $gearName . '\' gear already exists');
        }
        if($category == "") { $category = null; }

        if ($gearImageUrl->isValid() && !$gearImageUrl->hasMoved()) {
            $generatedRandomName = $gearImageUrl->getRandomName();
            $gearImageUrl->move('admin/uploads/', $generatedRandomName);
            $imageUrlPath = base_url('admin/uploads/' . $generatedRandomName);

            $this->load->gears->save([
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

## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- update gear----- ##
    public function updateGear($gearID) {
        $this->load->requireMethod('gears');
        $gearName = $this->request->getPost('gearName');
        $description = $this->request->getPost('description');
        $category = $this->request->getPost('category');
        $price = $this->request->getPost('price');
        $quantity = $this->request->getPost('stock');
        $gearImageUrl = $this->request->getFile('img');

        if ($gearImageUrl->isValid() && !$gearImageUrl->hasMoved()) {
            $generatedRandomName = $gearImageUrl->getRandomName();
            $gearImageUrl->move('admin/uploads/', $generatedRandomName);
            $imageUrlPath = base_url('admin/uploads/' . $generatedRandomName);
            $this->load->gears->update($gearID,[
                'image_url' => $imageUrlPath,
                'product_name' => $gearName,
                'description' => $description,
                'category_id' => $category,
                'price' => $price,
                'stock_quantity' => $quantity
            ]);
            return redirect()->back()->with('gearAdded', '*A gear is updated');
        }
        $this->load->gears->update($gearID,[
            'product_name' => $gearName,
            'description' => $description,
            'category_id' => $category,
            'price' => $price,
            'stock_quantity' => $quantity
        ]);
        return redirect()->back()->with('gearAdded', 'a gear is updated');    
    }

## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- remove gear----- ##
    public function removeGear($id) {
        $this->load->requireMethod('gears');
        if ($this->load->gears->delete($id)) {
            return redirect()->to('/admin/management')->with('removeSuccess', 'Product deleted successfully.');
        }
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- add new category----- ##
    public function addNewCategory(){
        $this->load->requireMethod('categories');
        $category = $this->request->getPost('category');
        $retrieveCategory = $this->load->categories->getCategory('category', $category);

        if($retrieveCategory) {
            return redirect()->back()->with('catError', '\'' . $category . '\' category already exist');
        }
        $this->load->categories->save(['category' => $category]);
        return redirect()->back()->with('catAdded', '\''. $category .'\' category Added');          
    }
## ----- END ----- ##


## ----- remove category by id ----- ##
    public function removeCategory($id){
        $this->load->requireMethod('categories');
        if ($this->load->categories->delete($id)) {
            return redirect()->to('/admin/management')->with('catDeleted', 'Category deleted successfully.');
        }
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- update admin account - admin settings panel ----- ##
    public function updateAdmin() {
        $this->load->requireMethod('userAccount');
        $this->load->requireMethod('adminAccount');

        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $cpassword = $this->request->getPost('cpassword');
        $password = $this->request->getPost('password');
        $admin = $this->load->adminAccount->getUser('admin_account_id', $this->load->session->get('admin_id'));
        $userUsername = $this->load->userAccount->getUser('username', $username);
        $userEmail = $this->load->userAccount->getUser('email', $email);

        // check if the image file is empty - if not empty proceed with this if statement
        if(!empty($this->request->getFile('profile_pic')) && $this->request->getFile('profile_pic')->isValid()) {
            $pfp = $this->request->getFile('profile_pic');
            $data['profile_pic'] = file_get_contents($pfp->getTempName());

            $this->load->adminAccount->update($admin, $data);
            return redirect()->back()->with('successUpdateProfile', 'Profile updated successfully.');
        }

        // check if username, email or both are existing and already in use by another or currently in used
        $admin_Username = $this->load->adminAccount->checkIfDataIsUsedByAnotherUser('username', $username, '!=');
        $admin_email = $this->load->adminAccount->checkIfDataIsUsedByAnotherUser('email', $email, '!=');

        if(password_verify($password, $admin['password'])) {
            $this->load->session->setFlashdata('existingEmail', 'Already using the new password input');
            return redirect()->back();
        }
        if($admin_Username > 0 || $userUsername) {
            $this->load->session->setFlashdata('existingUsername', 'Username is already in use');
            return redirect()->back();
        }
        if($admin_email > 0 || $userEmail) {
            $this->load->session->setFlashdata('existingEmail', 'Email is already in use');
            return redirect()->back();
        }
        if($admin_Username > 0 && $admin_email > 0 || $userUsername && $userEmail) {
            $this->load->session->setFlashdata('existingBoth', 'Username and Email is already in use');
            return redirect()->back();
        }

        // check if the password field is empty if empty proceed and update without the password
        if(empty($cpassword)) {
           if(empty($password)) {
                $data = [
                    'username' => $username,
                    'email' => $email
                ];
                if($this->request->getFile('profile_pic')->isValid()) {
                    $pfp = $this->request->getFile('profile_pic');
                    $data['profile_pic'] = file_get_contents($pfp->getTempName());
                }
                $this->load->adminAccount->update($admin, $data);
                $this->load->session->set([
                    'username' => $username,
                    'email' => $email
                ]);
                return redirect()->back()->with('successUpdateProfile', 'Profile updated successfully.');
           }
           return redirect()->back()->with('successUpdateProfile', 'Profile updated successfully.');
        }

        // if the conditions above didnt turn true, proceed with this one below
        if($cpassword == $password) {
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);
            $data = [
                'username' => $username,
                'email' => $email,
                'password' => $hashedPass
            ];
    
            if($this->request->getFile('profile_pic')->isValid()) {
                $pfp = $this->request->getFile('profile_pic');
                $data['profile_pic'] = file_get_contents($pfp->getTempName());
            }
    
            $this->load->session->set([
                'username' => $username,
                'email' => $email
            ]);
            $this->load->adminAccount->update($admin, $data);
            return redirect()->back()->with('successUpdateProfile', 'Profile updated successfully.');
        }
        return redirect()->back()->with('passwordErr', 'password did not match');
    }
    


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- delete admin account - admin settings panel ----- ##
    public function deleteAdmin($id){
        helper('cookie');
        $this->load->requireMethod('adminAccount');
        $this->load->requireMethod('carts');

        $this->load->carts->deleteCartById($id);
        $this->load->session->destroy();    
        delete_cookie('remember_token');
        $this->load->adminAccount->delete($id);
        return redirect()->to('/');
    }

## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- delete cancelled order ----- ##
    public function deleteCancelledOrder($order_id) {
        $this->load->requireMethod('orders');
        $this->load->orders->deleteCancelledOrdersByOrderId($order_id);
        return redirect()->to('/admin/orders_transactions');
    }   
## ------ confirm order ------ ##
    public function confirmOrder($placedOrderId) {
        $this->load->requireMethod('placed');
        $this->load->requireMethod('orders');
        $this->load->requireMethod('orderDetails');        
        $this->load->requireMethod('gears');

        $order = $this->load->placed->getOrderItemByPlaceOrderId($placedOrderId);

        $this->load->orders->save([
            'user_id' => $order->user_id,
            'product_id' => $order->product_id,
            'order_status' => 'to ship',
            'quantity' => $order->quantity,
            'price' => $order->total_price,
            'payment_method' => $order->payment_method
        ]);

        $this->load->gears->updateStock($order->product_id, $order->quantity, "-");
        $this->load->placed->deleteItemByProductId($order->product_id);
        return redirect()->to('/admin/orders_transactions');
    }

## ----- cancel to confirm order ------ ##
    public function deleteToConfirmOrder($placedOrderId) {
        $this->load->requireMethod('placed');
        $this->load->requireMethod('gears');

        $placedOrderItem = $this->load->placed->getOrderItemByPlaceOrderId($placedOrderId);
        $dateOfCancellation = date('Y-m-d');
        $this->load->orders->save([
            'user_id' => $placedOrderItem->user_id,
            'product_id' => $placedOrderItem->product_id,
            'order_status' => "cancelled",
            'quantity' => $placedOrderItem->quantity,
            'price' => $placedOrderItem->total_price,
            'payment_method' => $placedOrderItem->payment_method,
            'date_cancelled' => $dateOfCancellation
        ]);

        $this->load->placed->deleteItemByPlacedOrderId($placedOrderId);
        return redirect()->to('/admin/orders_transactions');
    }

    public function cancelOrder($order_id) {
        $this->load->requireMethod('orders');
        $this->load->requireMethod('orderDetails');
        $this->load->requireMethod('gears');

        $orders = $this->load->orders->getOrderById($order_id);
        $dateCancelled = date('Y-m-d');
        $this->load->orders->update($order_id, [
            'order_status' => 'cancelled',
            'date_cancelled' => $dateCancelled
        ]);
        $this->load->gears->updateStock($orders->product_id, $orders->quantity, "+");
        $this->load->orderDetails->updateOrderDetails("total_cancelled", 1, "+");
        return redirect()->to('/admin/orders_transactions');

    }


## ----- complete order ------ ##
    public function completeOrder($order_id) {
        $this->load->requireMethod('orders');
        $this->load->requireMethod('gears');
        $dateOrderComplete = date('Y-m-d');
        $this->load->requireMethod('orderDetails');
        
        $this->load->orders->update($order_id, [
            'order_status' => 'complete',
            'date_completed' => $dateOrderComplete
        ]);
        $total = $this->load->orders->getOrderById($order_id);
        $this->load->gears->updateGearTotalItemSold($total->product_id, $total->quantity);
        $this->load->orderDetails->updateOrderDetails("total_sales", $total->price, "+");
        $this->load->orderDetails->updateOrderDetails("total_completed", 1, "+");
        return redirect()->to('/admin/orders_transactions');
    }

    public function deleteComplteOrder($order_id) {
        $this->load->requireMethod('orders');
        $this->load->orders->where('order_id', $order_id)->delete();
        return redirect()->to('/admin/orders_transactions');
    }

## ----- RECENT ORDERS - DASHBOARD ----- #
    public function accountActivation($account_id) {
        $this->load->requireMethod('userAccount');
        $activationStatus = $this->load->userAccount->find($account_id);

        if($activationStatus['activation'] == "activated") {
            $this->load->userAccount->update($account_id, ['activation' => 'deactivated']);        }
        else {
            $this->load->userAccount->update($account_id, ['activation' => 'activated']);
        }
        return redirect()->back();
    }


## ------ DELETE USER ACCOUNT ----- ##
    public function deleteUserAccount($account_id) {
        $this->load->requireMethod('userAccount');
        $this->load->userAccount->delete($account_id);
        return redirect()->back();
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    private function removeTempSession($val) {
        if($val == 1) {
            $this->load->session->remove([
                'username', 'email', 'password', 'signupAccountType'
            ]);
        }
        else if($val == 2) {
            $this->load->session->remove([
                'fname', 'lname', 'email', 'phonenumber', 'username', 'password', 'signupAccountType'
            ]);
        }
    }



## -------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function getRevenueData(){
        $this->load->requireMethod(toLoad: 'orders');
        $timeframe = $this->request->getGet('timeframe') ?? 'yearly'; // Get timeframe from URL query

        if ($timeframe == 'monthly') {
            $query = $this->load->orders->query("
                SELECT DATE_FORMAT(date_completed, '%Y-%m') AS month, 
                    SUM(price * quantity) AS revenue 
                FROM orders 
                WHERE order_status = 'COMPLETE'
                GROUP BY YEAR(date_completed), MONTH(date_completed)
                ORDER BY month ASC
            ");
            $labelsKey = 'month';
        } elseif ($timeframe == 'weekly') {
            $query = $this->load->orders->query("
                SELECT CONCAT(YEAR(date_completed), '-W', WEEK(date_completed)) AS week, 
                    SUM(price * quantity) AS revenue 
                FROM orders 
                WHERE order_status = 'COMPLETE'
                GROUP BY YEAR(date_completed), WEEK(date_completed)
                ORDER BY week ASC
            ");
            $labelsKey = 'week';
        } else { // Default: Yearly
            $query = $this->load->orders->query("
                SELECT YEAR(date_completed) AS year, SUM(price * quantity) AS revenue 
                FROM orders 
                WHERE order_status = 'COMPLETE'
                GROUP BY YEAR(date_completed)
                ORDER BY year ASC
            ");
            $labelsKey = 'year';
        }

        $result = $query->getResultArray();
        $labels = array_column($result, $labelsKey);
        $values = array_column($result, 'revenue');

        return $this->response->setJSON([
            'labels' => $labels,
            'values' => $values
        ]);
    }

    

    public function getProductTrends(){
        $this->load->requireMethod('gears');
        $products = $this->load->gears->orderBy('totalSold', 'DESC')->limit(5)->findAll(); 

        $labels = array_column($products, 'product_name');
        $values = array_column($products, 'totalSold');

        return $this->response->setJSON([
            'labels' => $labels,
            'values' => $values
        ]);
    }


    // public function markAsRead($id){
    //     $this->load->requireMethod('notif');
    //     $this->load->notif->markAsRead($id);
    //     return redirect()->to('/admin/notifications');
    // }

    // public function deleteNotification($id){
    //     $this->load->requireMethod('notif');
    //     $this->load->notif->deleteNotification($id);
    //     return redirect()->to('/admin/notifications');
    // }

    // public function getUnreadCount(){
    //     $this->load->requireMethod('notif');
    //     return $this->response->setJSON(['count' => $this->load->notif->getUnreadCount()]);
    // }

}   