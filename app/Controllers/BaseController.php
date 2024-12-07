<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Controllers\Helpers\LoadersController as loader;
/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## Personal Configs - Session
## --------------------------------------------------------------------------------------------------------------------------- ##

    ## GLOBAL VARIABLE
    protected $load;

    ## Defaults load nescessary method models
    public function __construct() {
        $this->load = new loader();
        $this->load->requireMethod('session');
        $this->load->requireMethod('expirationTime');
    }

// SESSION DATA CHECKING -------------------------------------------
        ## check if session is expired
        protected function isSessionExpired() {
            return  $this->load->session->get('timeLoggedIn') && 
                    (time() - $this->load->session->get('timeLoggedIn')) > $this->load->expirationTime;
        }
        ## check if session is set to admin
        protected function isAdmin(){
            return  $this->load->session->get('type') == "admin" && 
                    $this->load->session->get('isLoggedIn') && 
                    $this->load->session->get('admin_id');
        }
        ## check if session is set to user
        protected function isUser() {
            return  $this->load->session->get('type') == "user" &&
                    $this->load->session->get('user_id') &&
                    $this->load->session->get('isLoggedIn');
        }
        ## delete both cookies and session
        protected function deleteCookiesAndSession($val){
            helper('cookie');
            $this->load->requireMethod('userAccount');
            $this->load->requireMethod('adminAccount');

            if($val == "user") {
                $user_id = $this->load->session->get('user_id');
                $this->load->userAccount->update($user_id , ['remember_token' => null]);
            }
            if($val == "admin") {
                $admin_id = $this->load->session->get('admin_id');
                $this->load->adminAccount->update($admin_id , ['remember_token' => null]);
            }
            $this->load->session->destroy();
            delete_cookie('remember_token');
        }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## DEFAULTS 
## --------------------------------------------------------------------------------------------------------------------------- ##
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);        
        if($this->load->session->has('isLoggedIn')) {
            redirect()->to('/');
        }
        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }
}
