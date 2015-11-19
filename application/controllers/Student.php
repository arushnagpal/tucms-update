<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

    public function __construct() {
        parent::__construct();
        header("X-XSS-Protection: 1 mode=block ");
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header("Content-Security-Policy: script-src 'self' http://fonts.googleapis.com 'unsafe-inline' 'unsafe-eval';");
        header("Cache-Control: no-cache");
        header("Pragma: no-cache");
        session_start();
        session_regenerate_id(true);
        if (!isset($_SESSION['id'])) {
            header('location: ' . base_url() . 'complaint');
            die();
        } else if ($_SESSION['user_type'] == 'caretaker' || $_SESSION['user_type'] == 'warden') {
            header('location: ' . base_url() . 'admin');
            die();
        }
        $this->load->model('Student_model');
    }

    function format_date($str) {
        $month = array(" ", "Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec");
        $y = explode(' ', $str);
        $x = explode('-', $y[0]);
        $date = "";
        $m = (int) $x[1];
        $m = $month[$m];
        $st = array(1, 21, 31);
        $nd = array(2, 22);
        $rd = array(3, 23);
        if (in_array($x[2], $st)) {
            $date = $x[2] . 'st';
        } else if (in_array($x[2], $nd)) {
            $date .= $x[2] . 'nd';
        } else if (in_array($x[2], $rd)) {
            $date .= $x[2] . 'rd';
        } else {
            $date .= $x[2] . 'th';
        }
        $date .= ' ' . $m . ' ' . $x[0];
        return $date;
    }

    public function index($page = 'new_complaint') {
        if (!file_exists(APPPATH . '/views/student/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['category'] = $this->Student_model->getData();
        $data['pollcheck'] = $this->Student_model->checkPoll();
        $data['query'] = $this->Student_model->getPoll();
        $data['title'] = ucfirst('Add Complaint'); // Capitalize the first letter
        //print_r($data);
        $this->load->view('templates/user_header', $data);
        $this->load->view('student/' . $page, $data);
        $this->load->view('templates/footer');
    }

    public function check($page = 'check_comp') {
        // check if complaint is registered before
        if (!file_exists(APPPATH . '/views/student/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data['type'] = $this->input->post('type');
        if ($data['type'] == '')
            redirect(base_url() . 'student');
        $data['message'] = $this->input->post('message');
        $data['level'] = $this->input->post('level');
        $data['go'] = $this->input->post('go');
        $data['flag'] = 0;
        if ($data['level'] == "room" || $data['level'] == "cluster")
            $data['flag'] = 1;
        //print_r($data);

        $data['num_results'] = $this->Student_model->getNumCat($data['type']);
        $data['room'] = $this->Student_model->getRoom();
        $data['cluster'] = substr($data['room'], 0, 4);
        $data['complaint'] = $this->Student_model->getNumComp($data);
        $data['title'] = ucfirst('Add Complaint'); // Capitalize the first letter
        //print_r($data);
        $this->load->view('templates/user_header', $data);
        $this->load->view('student/' . $page, $data);
        $this->load->view('templates/footer');
    }

    public function addComp() {
        $login = $this->Student_model->checkLoginCount();
        $data['status'] = $login;
        $data['title'] = 'Details';
        $page = 'details';
        $this->load->view('templates/user_header', $data);
        $this->load->view('student/' . $page, $data);
    }

    function valid_pass($candidate) {
        if (!preg_match_all('$\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[\d])\S*$', $candidate))
            return FALSE;
        return TRUE;
    }

    /*
      Explaining $\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$
      $ = beginning of string
      \S* = any set of characters
      (?=\S{8,}) = of at least length 8
      (?=\S*[a-z]) = containing at least one lowercase letter

      (?=\S*[\d]) = and at least one number
      (?=\S*[\W]) = and at least a special character (non-word characters)
      $ = end of the string

     */

    public function string_validate($str) {
        $str = filter_var($str, FILTER_SANITIZE_STRING);
        $str1 = str_replace("%", "p", "$str");
        /* @var $mysqli type */
        $str1 = $this->db->escape($str1);
        return str_replace("'", "", $str1);
    }

    public function status($page = 'status') {
        if (!file_exists(APPPATH . '/views/student/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $this->load->model('Admin_model');
        $data['status'] = $this->Student_model->getStatus();
        $sql = "select * from complaints where roomno = '" . $_SESSION['room'] . "'";
        $data['row'] = $this->Admin_model->filteredContent($sql);
        $data['title'] = ucfirst($page);
        $this->load->view('templates/user_header', $data);
        $this->load->view('student/' . $page, $data);
    }

    public function popup() {
        $_SESSION['compid'] = $this->input->post('send');
        $this->load->model('Admin_model');
        $row = $this->Admin_model->popData();
        echo $row['name'] . "," . $row['comp_id'] . "," . $row['category'] . "," . $row['roomno'] . "," . $this->format_date($row['comp_date']) . "(" . date("H:i:s", strtotime($row['comp_date'])) . ")" . "," . $row['status'] . "," . $row['details'];
        $data = $this->Admin_model->popRemark();
        if ($data) {
            foreach ($data as $ro) {
                echo "," . $ro['user_type'] . "," . $this->format_date($ro['time']) . "(" . date("H:i:s", strtotime($ro['time'])) . ")" . "," . $ro['remark'];
            }
        }
    }

    public function profile($page = 'profile') {
        if (!file_exists(APPPATH . '/views/student/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data = $this->Student_model->getProfile();
        $data['title'] = ucfirst($page);
        $this->load->view('templates/user_header', $data);
        $this->load->view('student/' . $page, $data);
        $this->load->view('templates/footer');
        unset($_SESSION['matcherr']);
        unset($_SESSION['passerr']);
        unset($_SESSION['olderr']);
        unset($_SESSION['success']);
    }

    public function vote($page = 'poll_student') {
        if (!file_exists(APPPATH . '/views/student/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['query'] = $this->Student_model->getPoll();
        $data['title'] = ucfirst($page);
        $this->load->view('templates/user_header', $data);
        $this->load->view('student/' . $page, $data);
        $this->load->view('templates/footer');
    }

    public function pollx() {
        $data['vote'] = $this->string_validate($this->input->get('vote'));
        $data['z'] = $this->input->get('z');
        $y = $data['z'];
        $this->Student_model->addVote($data);
        $_SESSION['msg'] = "You have successfully cast your vote.";
        echo $_SESSION['msg'];
    }

    public function updateProfile() {
        $oldpass = $this->input->post('oldpass');
        $pass = $this->input->post('pass');
        $repass = $this->input->post('repass');
        $data = $this->Student_model->getProfile();
        if (isset($oldpass)) {

            $salt = "thispasswordcannotbehacked";
            $oldpass = hash('sha256', $salt . $oldpass);
            if ($data['pass'] != $oldpass) {
                $_SESSION['olderr'] = "Your password doesnot match your previous password.";
            } else
                $_SESSION['olderr'] = '';

            if (isset($pass) && isset($repass)) {
                if ($pass == $repass)
                    $_SESSION['matcherr'] = '';
                else
                    $_SESSION['matcherr'] = "Passwords do not match. Please try again";

                if ($this->valid_pass($pass) && $_SESSION['olderr'] == '') {
                    $_SESSION['passerr'] = '';
                    $salt = "thispasswordcannotbehacked";
                    $pass = hash('sha256', $salt . $pass);
                    $this->Student_model->updatePro($pass);
                } else
                    $_SESSION['passerr'] = "Password is not valid. ";
                redirect(base_url() . 'student/profile');
            }
        }
    }

}

?>