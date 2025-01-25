<?php
namespace App\Controllers;

class HomeController extends BaseController
{
## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- SESSION ----- ##
private function checkUserSession($path, $data = null) {
        if($this->isAdmin()) {
            return redirect()->to('/admin/dashboard');
        }
        if($this->isSessionExpired()) {
            $this->deleteCookiesAndSession("user");
            return redirect()->to('/')->with('sessionTimeout', 'Session Timeout, login again');
        }
        if($data != null) {
            return view($path, $data);
        }
        return view($path);
    }

## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- ROUTES ----- ##
    ## redirect to homepage 
    public function home() {  
        return $this->checkUserSession('homepage');
    }

    ## redirect to gear library 
    public function library(){
        $pager = \Config\Services::pager(); 
        $this->load->requireMethod('gears');
        $this->load->requireMethod('categories');
        $perPage = 10; 
        $gears = $this->load->gears->getAllPaginated($perPage);
        
        $data = [
            'categories' => $this->load->categories->getAll(),
            'gearsPerCategory' => $gears, 
        ];
        return $this->checkUserSession('library', $data);
    }

    ## redirect to  community
    public function community(){
        $this->load->requireMethod('userAccounts');
        $this->load->requireMethod('adminAccounts');
        $this->load->requireMethod('comments');
        $this->load->requireMethod('gears');
        
        $products = $this->load->gears->getAll();
        foreach ($products as &$product) {
            $product['comments'] = $this->load->comments->getCommentsByProductId($product['product_id']);
            $existingReview = $this->load->comments->getReviewByUserAndProduct($this->load->session->get('user_id'), $product['product_id']);
            $product['existingReview'] = $existingReview;
        }
        $data = [
            'commentsPerProduct' => $products
        ];
        return $this->checkUserSession('community', $data);

    }
    ## redirect to customize 
    public function customize(){
        return $this->checkUserSession('customize');
    }
    ## redirect to login 
    public function login(){
        if($this->isUser()) {
            return redirect()->to('/admin/dashboard');
        }
        return $this->checkUserSession('login');
    }
    ## redirect to signup
    public function signup() {
        if($this->isUser()) {
            return redirect()->to('/admin/dashboard');
        }
        return $this->checkUserSession('signup');
    }

## ----- END ROUTES ----- ##

    public function rateReviewProduct($product_id) {
        if(!$this->isUser()) {
            return redirect()->to('/login');
        }

        $this->load->requireMethod('userAccounts');
        $this->load->requireMethod('comments');

        $rate = $this->request->getPost('rating-value');
        $rate = (int) $rate;
        $review = $this->request->getPost('review');
        $userId = $this->load->session->get('user_id');
        $alreadyReviewed = $this->load->comments->getReviewByUserAndProduct($userId, $product_id);
        if($alreadyReviewed) {
            $this->load->comments->updateComment($userId, $product_id, [
                'comment_text' => $review,
                'rating' => $rate
            ]);
            return redirect()->to('/community');
        }
        else {
            if(empty($rate)) {
                $rate = null;
            }
            if($review) {
                $this->load->comments->save([
                    'product_id' => $product_id,
                    'user_id' => $userId,
                    'comment_text' => $review,
                    'rating' => $rate
                ]);
            }
            else {
                $this->load->comments->save([
                    'product_id' => $product_id,
                    'user_id' => $userId,
                    'comment_text' => null,
                    'rating' => $rate
                ]);
            }
            return redirect()->to('/community');
        }
    }

    public function deleteReview($product_id) {
        $this->load->requireMethod('userAccounts');
        $this->load->requireMethod('comments');
        $userId = $this->load->session->get('user_id');
        $this->load->comments->deleteReview($userId, $product_id);
        return redirect()->to('/community');
    }
}