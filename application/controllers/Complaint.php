<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Complaint extends CI_Controller {

    public function __construct() {
        parent::__construct();
        header("X-XSS-Protection: 1 ; mode=block ");
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header("Content-Security-Policy: script-src 'self' http://fonts.googleapis.com 'unsafe-inline' 'unsafe-eval';");
        header("Expires: Mon, 26 Jul 2014 05:00:00 GMT");
        header('Cache-Control: max-age=604800');
        header("Pragma: no-cache");
        session_start();
        session_regenerate_id(true);
    }

    function string_validate($str) {
        $str = filter_var($str, FILTER_SANITIZE_STRING);
        $str1 = str_replace("%", "p", "$str");
        $str = $this->db->escape($str1);
        return str_replace("'", '', $str);
    }

    function valid_pass($candidate) {
        if (!preg_match_all('$\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[\d])\S*$', $candidate))
            return FALSE;
        return TRUE;
    }

    function checkSession() {
        if (isset($_SESSION['user_type'])) {
            if ($_SESSION['user_type'] == 'student') {
                header('location: ' . base_url() . 'student');
                die();
            } else if ($_SESSION['user_type'] == 'caretaker' || $_SESSION['user_type'] == 'warden') {
                header('location: ' . base_url() . 'admin');
                die();
            }
        }
    }

    public function developers($page = 'developers') {
        if (!file_exists(APPPATH . '/views/complaint/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter
        $this->load->view('templates/header', $data);
        $this->load->view('complaint/' . $page);
        $this->load->view('templates/footer');
    }

    public function instructions($page = 'instruction') {
        if (!file_exists(APPPATH . '/views/complaint/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data['title'] = ucfirst($page . 's'); // Capitalize the first letter
        $this->load->view('templates/header', $data);
        $this->load->view('complaint/' . $page);
        $this->load->view('templates/footer');
    }

    public function index($page = 'index') {
        if (!file_exists(APPPATH . '/views/complaint/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $this->checkSession();
        $this->load->helper('smiley');
        $data['title'] = "Home";
        $this->load->model('Student_model');
        $data['notifications']= $this->Student_model->allnotifs();
        $this->load->view('templates/header', $data);
        $this->load->view('complaint/' . $page);
        $this->load->view('templates/footer');
    }

    public function sign_in($page = 'login') {
        if (!file_exists(APPPATH . '/views/complaint/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $this->checkSession();
        $data['title'] = 'Sign In';
        $this->load->view('templates/header', $data);
        $this->load->view('complaint/' . $page);
    }

    public function contact($page = 'contact') {
        if (!file_exists(APPPATH . '/views/complaint/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['title'] = ucfirst($page . ' Us'); // Capitalize the first letter
        $this->load->view('templates/header', $data);
        $this->load->view('complaint/' . $page);
        $this->load->view('templates/footer');
        unset($_SESSION['stmt']);
    }

    public function insertContact() {
        $data = $this->input->post();
        //print_r($data);
        $data['name'] = $this->string_validate($data['name']);
        $data['email'] = $this->string_validate($data['email']);
        $data['message'] = $this->string_validate($data['message']);
        $this->load->model('Outer_model');
        $this->Outer_model->contact($data);
        $_SESSION['stmt'] = TRUE;
        $_SESSION['nm'] = $data['name'];
        redirect(base_url() . 'complaint/contact');
    }

    public function check_user() {
        $flag = 1;
        if (!isset($_SESSION['false_login']))
            $_SESSION['false_login'] = 1;
        else
            $_SESSION['false_login'] += 1;
        $data['email'] = $this->input->post('email');
        $data['password'] = $this->input->post('password');
        $salt = "thispasswordcannotbehacked";
        $data['password'] = hash('sha256', $salt . $data['password']);
        $data['captcha'] = $this->input->post('captcha');
        if ($data['captcha'] != '') {
            if ($_SESSION['code'] == $data['captcha'])
                $flag = 1;
            else
                $flag = 0;
        }
        else if ($_SESSION['false_login'] > 3)
            $flag = 0;
        if ($flag == 1) {

            $this->load->model('Outer_model');
            $result = $this->Outer_model->validate_user($data);
            if ($result == 'student') {
                echo 'student';
                unset($_SESSION['false_login']);
            } else if ($result == 'caretaker' || $result == 'warden') {
                echo 'admin';
                unset($_SESSION['false_login']);
            } else {
                echo 0;
            }
        }
    }

    public function forgotPassword($page = 'forgot') {
        if (!file_exists(APPPATH . '/views/complaint/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $this->checkSession();
        $data['title'] = ucfirst($page . ' Password'); // Capitalize the first letter
        $this->load->view('templates/header', $data);
        $this->load->view('complaint/' . $page);
        session_unset();
    }

    public function checkEmail() {
        $this->load->helper('email');
        $email = $this->input->post('email');
        if (valid_email($email)) {
            $email = trim($email);
            $this->load->model('Outer_model');
            $exists = $this->Outer_model->email_exists($email);
            if ($exists) {
                $this->send_reset_password_email($email, $exists);
                $error = "SUCCESS";
            } else
                $error = 'This email is not registered. Please provide your registered email...';
        }
        else {
            $error = 'Please enter a valid email...';
        }
        $_SESSION['error'] = $error;
        redirect(base_url() . 'complaint/forgotPassword');
    }

    function send_reset_password_email($email, $name) {
        $email_code = sha1($email . $name);

        $to = $email;
        $subject = 'Reset Password onlinehostelj.in';
        $message = '<html>
		<body>
		<p>Dear ' . $name . ', <br><br>
		To reset your onlinehostelj.in password, <a href="' . base_url() . 'complaint/resetPassword/' . $email . '/' . $email_code . '">click here</a>. <br><br>
		If you are not able to view the link above, copy and paste into your address bar: 
		' . base_url() . 'complaint/resetPassword/' . $email . '/' . $email_code . '/ <br><br>
		If this was not you, kindly ignore this email.<br><br>
		Regards,<br>
		Developer
		</p>
		</body>
		</html>
		';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers.="From:Hostel-J<developer@onlinehostelj.in>";
        mail($to, $subject, $message, $headers);
    }

    public function resetPassword($email, $email_code) {
        if (!file_exists(APPPATH . '/views/complaint/reset.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $this->checkSession();
        $this->load->model('Outer_model');
        $exists = $this->Outer_model->email_exists($email);
        if ($exists) {
            $name = $exists;
            $email_newcode = sha1($email . $name);
            if ($email_code == $email_newcode) {
                $data['title'] = ucfirst('Reset Password'); // Capitalize the first letter
                $data['email'] = $email;
                $data['email_code'] = $email_code;
                $this->load->view('templates/header', $data);
                $this->load->view('complaint/reset', $data);
            } else {
                $this->load->view('templates/header');
                $this->load->view('complaint/reset_error');
            }
        } else {
            $this->load->view('templates/header');
            $this->load->view('complaint/reset_error');
        }
        session_unset();
    }

    function updatePassword() {
        $email = $this->input->post('email');
        $email = $this->string_validate($email);
        $email_code = $this->input->post('email_code');
        $pass = $this->input->post('pass');
        $repass = $this->input->post('repass');

        $this->load->model('Outer_model');
        $exists = $this->Outer_model->email_exists($email);

        if ($exists) {
            if ($pass == $repass)
                $_SESSION['matcherr'] = '';
            else
                $_SESSION['matcherr'] = "Passwords do not match. Please try again";

            if ($this->valid_pass($pass))
                $_SESSION['passerr'] = '';
            else
                $_SESSION['passerr'] = "Password is not valid. ";

            if ($pass == $repass && $_SESSION['matcherr'] == '' && $_SESSION['passerr'] == '') {
                $salt = "thispasswordcannotbehacked";
                $pass = hash('sha256', $salt . $pass);
                $this->Outer_model->updatePass($email, $pass);
		redirect(base_url() . 'complaint/sign_in');
            } else
                redirect(base_url() . 'complaint/resetPassword/' . $email . '/' . $email_code);
        } else {
            $_SESSION['emailerr'] = '';
            redirect(base_url() . 'complaint/resetPassword/' . $email . '/' . $email_code);
        }
    }

    public function logout() {
        if (!isset($_SESSION['id']))
            header('location: ' . base_url() . 'complaint');
        session_unset();
        session_destroy();
        header('location: ' . base_url() . 'complaint');
    }

}

?>