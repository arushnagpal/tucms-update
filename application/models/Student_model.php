<?php

class Student_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getData() {
        $arr = array();
        $query = 'SELECT * FROM category where level = "rc"';
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            array_push($arr, $row->category);
        }
        $query = 'SELECT * FROM category where level = "cluster"';
        $result1 = $this->db->query($query);
        foreach ($result1->result() as $row) {
            array_push($arr, $row->category);
        }
        return $arr;
    }

    function getNumCat($type) {
        $result = $this->db->query("select id from category where category='" . $type . "'");
        return $result->num_rows();
    }

    function getNumComp($data) {
        if ($data['level'] == 'cluster') {
            $result = $this->db->query("select * from complaints where roomno like '" . $data['cluster'] . "%' and not(status='Complete') and category='" . $data['type'] . "' and comp_type='" . $data['level'] . "'");
        } else
            $result = $this->db->query("select * from complaints where roomno like '" . $data['room'] . "%' and not(status='Complete') and category='" . $data['type'] . "' and comp_type='" . $data['level'] . "'");

        $details = array();
        $details['count'] = $result->num_rows();
        foreach ($result->result() as $row) {
            $data['row']['comp_id'] = $row->comp_id;
            $data['row']['category'] = $row->category;
            $data['row']['roomno'] = $row->roomno;
            $data['row']['comp_date'] = $row->comp_date;
            $data['row']['status'] = $row->status;
            $data['row']['details'] = $row->details;
            array_push($details, $data['row']);
        }
        return $details;
    }

    function getRoom() {
        $result = $this->db->query("select roomno from registration where regno =  '" . $_SESSION['roll'] . "'");
        $row = $result->row();
        $room = $row->roomno;
        return $room;
    }

    public function getProfile() {
        $query = "select pass from login where email = '" . $_SESSION['email'] . "'";
        $result = $this->db->query($query);
        $row = $result->row();
        $data['pass'] = $row->pass;
        $query1 = "select * from registration where email = '" . $_SESSION['email'] . "'";
        $result1 = $this->db->query($query1);
        $row1 = $result1->row();
        $data['contact'] = $row1->contact;
        return $data;
    }

    public function updatePro($pass) {
        $query = "update login set pass = '" . $pass . "' where email = '" . $_SESSION['email'] . "'";
        $this->db->query($query);
        $_SESSION['success'] = "Your changes have been saved";
    }

    function getStatus() {
        $sql = 'SELECT * FROM complaints,registration where registration.regno="' . $_SESSION['roll'] . '" and registration.roomno=complaints.roomno order by comp_date desc';
        $result = $this->db->query($sql);
        $data = array();
        $data['counter'] = $result->num_rows();
        foreach ($result->result_array() as $row) {
            $det['user_type'] = $row['user_type'];
            $det['comp_id'] = $row['comp_id'];
            $det['comp_date'] = $row['comp_date'];
            $det['category'] = $row['category'];
            $det['details'] = $row['details'];
            $det['status'] = $row['status'];
            $det['exp_date'] = $row['exp_date'];
            array_push($data, $det);
        }
        return $data;
    }

    public function string_validate($str) {
        $str = filter_var($str, FILTER_SANITIZE_STRING);
        $str1 = str_replace("%", "p", "$str");
        /* @var $mysqli type */
        return $this->db->escape($str1);
    }

    function checkLoginCount() {
        $result = $this->db->query("select login_date,count from login where email ='" . $_SESSION['email'] . "'");
        $row = $result->row_array();
        if ($row['login_date'] == date('Y-m-d')) {
            if ($row['count'] >= 2) {
                return 'EXCEED';
            }
        } else
            $this->db->query("update login set login_date='" . date('Y-m-d') . "',count=0 where email='" . $_SESSION['email'] . "'");
        $this->db->query("update login set count=count+1 where email='" . $_SESSION['email'] . "'");
        $result = $this->db->query("select roomno from registration where regno =  '" . $_SESSION['roll'] . "'");
        $room = $result->row()->roomno;
        $cat = $_SESSION['type'];
        $roomno = $room;
        $det_with_comma = $this->string_validate($_SESSION['msg']);
        $det = str_replace(",", ";", $det_with_comma);
        $nam = $_SESSION['name'];
        if ($roomno == "Mess")
            $type = "Mess";
        else
            $type = $_SESSION['level'];
        $this->db->query("insert into complaints(category, roomno,  details, name, comp_type,comp_date) values (?,?,?,?,?,?)", array($cat, $roomno, $det, $nam, $type, date('Y-m-d H:i:s')));
        unset($_SESSION['type']);
        unset($_SESSION['msg']);
        unset($_SESSION['level']);
        return 'SUCCESS';
    }

    public function getPoll() {
        $query = "select * from newpoll where switch=1";
        $result = $this->db->query($query);
        $row = $result->row_array();
        $data['id'] = $row['id'];
        $data['ques'] = $row['ques'];
        $data['op1'] = $row['op1'];
        $data['op2'] = $row['op2'];
        $data['op3'] = $row['op3'];
        $data['op4'] = $row['op4'];
        return $data;
    }

    public function checkPoll() {
        $result = $this->db->query("select poll from login where email ='" . $_SESSION['email'] . "'");
        $data['poll'] = $result->row()->poll;
        return $data;
    }

    public function addVote($data) {
        //what are x,y,z ??
        $x = $data['vote'];
        $y = $data['z'];
        $new = "poll_c" . $x;
        $sql = "update newpoll set $new=$new+1 where id='" . $y . "'";
        $this->db->query($sql);
        $sqlpoll = "update login set poll=1 where email ='" . $_SESSION['email'] . "'";
        $this->db->query($sqlpoll);
        $expire = time() + 60 * 60 * 24 * 30;
        setcookie("poll" . "_" . $y, "poll" . "_" . $y, $expire);
    }

}

?>