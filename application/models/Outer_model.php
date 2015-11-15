<?php

class Outer_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function validate_user($data) {
        $query = "select * from login where email='" . $data['email'] . "' and pass='" . $data['password'] . "'";
        $result = $this->db->query($query);
        if ($result->num_rows() > 0) {
            $_SESSION['id'] = session_id();
            $query = 'select * from registration where registration.email="' . $data['email'] . '"';
            $res = $this->db->query($query);
            $row1 = $res->row();
            $_SESSION['email'] = $data['email'];
            $_SESSION['name'] = $row1->fname;
            $_SESSION['user_type'] = $row1->user_type;
            $_SESSION['roll'] = $row1->regno;
            $_SESSION['room'] = $row1->roomno;
            return $row1->user_type;
        } 
        else return '0';
    }

    public function contact($data) {
        return $this->db->insert('contact', $data);

        /* 	$to=$_POST['email'];
          $subject="Regarding your Feedback/Request at Hostel-J online portal";
          $message="We have received your feedback/request. Its being processed and we will get back to you as soon as possible.";
          $headers="From:Hostel-J<developer@onlinehostelj.in>";
          mail($to,$subject,$message,$headers);
          $to="developer@onlinehostelj.in";
          $subject="New request or feedback";
          $message="Name = ".$_POST['name']." Email = ".$_POST['email']." Message = ".$_POST['message'];
          $headers="From:".$_POST['name']."<".$_POST['email'].">";
          mail($to,$subject,$message,$headers); */
    }

    function email_exists($email) {
        $result = $this->db->query("select fname,email from registration where email = '" . $email . "'");
        if ($result->num_rows() >= 1) {
            return $result->row()->fname;
        } else
            return FALSE;
    }

    function updatePass($email, $pass) {
        $this->db->query("update login set pass = '" . $pass . "' where email = '" . $email . "'");
    }

}

?>