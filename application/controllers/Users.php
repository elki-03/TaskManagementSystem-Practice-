<!-- 1.	User Authentication 
o	Implement a registration and login system using CodeIgniter’s Session library. 
o	Encrypt passwords securely using some kind of encryption we are using md5() for our current system.  -->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    // Constructor
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('User_model'); 
    // url-helper is loaded in autoload --> $autoload['helper'] = array('url');
    //form validation libraray for password rules --> registration
        $this->load->library('form_validation');
        $this->load->helper(array('form'));
    }

    //loads login view
    public function login() {
        $this->load->view('users/login');
    }

    //  checks login of user(are username and password in database?)
    public function check_login() {     
        $username = $this->input->post('username', TRUE);
        $pw   = $this->input->post('pw', TRUE);
    
         if ($username && $pw) {
            $user_data = $this->User_model->get_user_from_db($username);
            //$data['message'] = "user model is functioning";//for debugging

            if ($user_data) {
                if (password_verify($pw, $user_data['password'])) { //with password_hashed()
                    $this->session->set_userdata([
                        'username'    => $user_data['username'],
                        'user_id' => $user_data['user_id']
                    ]);
                    $data['message'] = "You are logged in!<br>redirect in 3 seconds";
                    echo '<meta http-equiv="refresh" content="3;url=' . site_url('tasks/index') . '">';//metafresh for 3 seconds redirect (so user can read the message of being logged in before redirect)
                } else {
                     $data['message'] = "Wrong password";
                }
            } else {
                $data['message'] = "user name not found";
            }
    
            $this->load->view('users/login', $data);
        } else {

            $data['message'] = "user name and password not found";//
            redirect('users/login');
        }     
    }

    //registration
    public function register() {
        $data['message'] = "";//message empty so there won't be an error

        if ($this->input->method() === 'post') {
            $username = $this->input->post('username', TRUE);
            $pw = $this->input->post('pw', TRUE);

            $this->submit_register($username, $pw);
            return; //to leave function at this point
        }
        $this->load->view('users/register', $data);
    }
    
    //part of registration: uses the validation function und sees if pw is not talen yet. If everything is okay--> user is registered
    public function submit_register($username, $pw) {
        $data = array('message' => '');

        $this->form_validation->set_rules('pw', 'Password', 'required|callback_valid_password');//sets form validation rules 

        // Was form validation successful?
        if ($this->form_validation->run() == FALSE) {
            // if not, form shows again and error msg is shown in view on top of form validation error helper 
            $this->load->view('users/register', $data);//$data new for validation msg
        } else {
            // password hashing/encrypting
            $pw = password_hash($pw, PASSWORD_DEFAULT);
            $this->load->model('User_model');  
            $user_data = $this->User_model->get_user_from_db($username);
                
            if ($user_data) {
                $data['message'] = "user name is already taken. Please try another one!";
                echo '<meta http-equiv="refresh" content="3;url=' . site_url('users/register') . '">';
            } else {
                 $success = $this->User_model->save_user_in_db($username, $pw);
                
                 if ($success) {
                    $data['message'] = "Your username has been registered!!<br>redirect in 3 seconds";
                    echo '<meta http-equiv="refresh" content="3;url=' . site_url('users/login') . '">';
                } else {
                    $data['message'] = "You haven't been registered";
                     echo '<meta http-equiv="refresh" content="3;url=' . site_url('users/register') . '">';
                }
            } $this->load->view('users/register', $data);
        }    
    }

    //function for validating the passord: are all rules met? With form_validation from CI3
    public function valid_password($password) {
        // defines string with allowed characters
        $special_chars = '!"§$%&/()=?#';

        // pw length at least 11 characters
        if (strlen($password) < 11) {
            // error message for user
            $this->form_validation->set_message('valid_password', 'Password needs to be at least 11 characters');
            return FALSE; // Stops valodation, since condition has not been met
        }

        // at least one upper case
        if (!preg_match('/[A-Z]/', $password)) {
            $this->form_validation->set_message('valid_password', 'Password needs at least one letter in upper case');
            return FALSE;
        }

        // at least one lower case
        if (!preg_match('/[a-z]/', $password)) {
            $this->form_validation->set_message('valid_password', 'Password needs at least one letter in lower case');
            return FALSE;
        }

        // at least one number (between 0 and 9)
        if (!preg_match('/[0-9]/', $password)) {
            $this->form_validation->set_message('valid_password', 'Password needs at least one number');
            return FALSE;
        }

        // at least one special character
        // preg_quote() makes it that all special characters escape correctly, if the have a speacial meaning vor Regex/Regular Expression
        if (!preg_match('/[' . preg_quote($special_chars, '/') . ']/', $password)) {
            // error msg with list for allowed characters
            $this->form_validation->set_message('valid_password', 'Password needs at least one special character of the following list: ' . htmlspecialchars($special_chars));
            return FALSE;
        }
        //If all examinations successful -->true, means pw is validated
        return TRUE;
    }
}