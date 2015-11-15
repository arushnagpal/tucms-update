<?php

class Admin_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function addCat($data) {
        return $this->db->insert("category", $data);
    }

    public function deleteComplaints($type) {
        if ($type == 'all'){
            $this->db->query('delete from remarks where 1');
            $this->db->query('delete from complaints where 1');
        }            
        else
            $this->db->query("delete from complaints where status='Complete'");
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

    public function getCategory() {
        $query = "select category from category";
        $result = $this->db->query($query);
        $data = array();
        foreach ($result->result() as $row) {
            array_push($data, $row->category);
        }
        return $data;
    }

    public function deleteCat($cat) {
        $query = "delete from category where category ='" . $cat . "'";
        $this->db->query($query);
    }

    public function filteredContent($sql) {
        $result = $this->db->query($sql);
        $details = array();
        foreach ($result->result() as $row) {
            $data['row']['comp_id'] = $row->comp_id;
            $data['row']['category'] = $row->category;
            $data['row']['roomno'] = $row->roomno;
            $contact = $this->db->query("select contact from registration where roomno='" . $row->roomno . "'");
            $data['row']['contact'] = $contact->row()->contact;
            $data['row']['comp_date'] = $row->comp_date;
            $data['row']['status'] = $row->status;
            $data['row']['details'] = $row->details;
            $data['row']['name'] = $row->name;
            $data['row']['comp_type'] = $row->comp_type;
            array_push($details, $data['row']);
        }
        return $details;
    }

    public function pollinsertquery($data) {
        $q = $data['ques'];
        $x = $data['op1'];
        $y = $data['op2'];
        if ($data['op3'] != "")
            $z = $data['op3'];
        else
            $z = 'NULL';
        if ($data['op4'] != "")
            $a = $data['op4'];
        else
            $a = 'NULL';

        $sql = "INSERT INTO newpoll(ques,op1,op2,op3,op4,poll_c1,poll_c2,poll_c3,poll_c4,switch) VALUES ('$q','$x','$y','$z','$a',0,0,0,0,1)";
        $this->db->query($sql);
        $sql1 = "select id from newpoll where ques='$q'";
        $result = $this->db->query($sql1);
        $row = $result->row();
        $idnew = $row->id;
        $sql2 = "update newpoll set switch=0 where id<>'$idnew'";
        $this->db->query($sql2);
        $sql3 = "update login set poll=0";
        $this->db->query($sql3);
    }

    public function pollresquery() {
        $queryTotalPoll = "SELECT *,poll_c1+poll_c2+poll_c3+poll_c4 as poll_count from newpoll order by id desc";
        $result = $this->db->query($queryTotalPoll);
        $details = array();
        foreach ($result->result_array() as $row) {
            $data['id'] = $row['id'];
            $data['ques'] = $row['ques'];
            $data['op1'] = $row['op1'];
            $data['op2'] = $row['op2'];
            $data['op3'] = $row['op3'];
            $data['op4'] = $row['op4'];
            $data['poll_c1'] = $row['poll_c1'];
            $data['poll_c2'] = $row['poll_c2'];
            $data['poll_c3'] = $row['poll_c3'];
            $data['poll_c4'] = $row['poll_c4'];
            $data['pollsum'] = $row['poll_count'];
            array_push($details, $data);
        }
        return $details;
    }

    public function pollresquery1($data) {
        $queryTotalPoll = "SELECT * from newpoll where id=".$data['id'];
        $result = $this->db->query($queryTotalPoll);
        $data['ques'] = $result->row()->ques;
        $data['op1'] = $result->row()->op1;
        $data['op2'] = $result->row()->op2;
        $data['op3'] = $result->row()->op3;
        $data['op4'] = $result->row()->op4;
        $data['poll_c1'] = $result->row()->poll_c1;
        $data['poll_c2'] = $result->row()->poll_c2;
        $data['poll_c3'] = $result->row()->poll_c3;
        $data['poll_c4'] = $result->row()->poll_c4;
        return $data;
    }

    function popData() {
        $sql = "SELECT * FROM complaints where comp_id = '" . $_SESSION['compid'] . "' order by comp_date desc";
        $result = $this->db->query($sql);
        $row = $result->row_array();
        return $row;
    }

    function popRemark() {
        $sql = "SELECT * FROM remarks where comp_id = '" . $_SESSION['compid'] . "' order by time desc";
        $result = $this->db->query($sql);
        $details = array();
        foreach ($result->result_array() as $row) {
            $data['user_type'] = $row['user_type'];
            $data['time'] = $row['time'];
            $data['remark'] = $row['remark'];
            array_push($details, $data);
            //format_date($row['time']) . "(" . date("H:i:s", strtotime($row['time'])) . ")" . "," . $row['remark'];
        }
        return $details;
    }

    function addRemark($sql) {
        $this->db->query($sql);
    }
    
    function searchStudent($room){
        $result=  $this->db->query("select * from student_details where room_no='".$room."'");
        $row = $result->row_array();
        return $row;
    }
    
    function searchStudentName($name) {
        $result=  $this->db->query("select * from student_details where full_name like '%".$name."%'");
        $details = array();
        foreach ($result->result_array() as $row) {
            array_push($details, $row);
        }
        return $details;
    }
    
    function getMailData() {
        $sql = "SELECT * FROM registration";
        $result = $this->db->query($sql);
        $details = array();
        foreach ($result->result_array() as $row) {
            array_push($details, $row);
        }
        return $details;
    }
    
    function getUserEmail($comp_id){
    	$result=$this->db->query("select * from registration where roomno IN (select roomno from complaints where comp_id=".$comp_id.")");
    	$row = $result->row_array();
        return $row['email'];    
    }    
    
    function getExistingData() {
        $sql = "SELECT * FROM login";
        $result = $this->db->query($sql);
        $details = array();
        foreach ($result->result_array() as $row) {
            array_push($details, $row);
        }
        return $details;
    }
    
    function checkEmail($email){
    	$query=$this->db->query("select email from registration where email='".$email."'");
    	if ($query->num_rows() > 0) return TRUE;
    	else return FALSE;
    }
    
    function checkRoom($room){
    	$query=$this->db->query("select roomno from registration where roomno='".$room."'");
    	if ($query->num_rows() > 0) return TRUE;
    	else return FALSE;
    }
    
    function insertLogin($email,$pass){
        $this->db->query("insert into login(email,pass) values ('".$email."','".$pass."')");
    }
    
    function insertRegistration($name,$roll,$email,$contact,$room){
        $this->db->query("insert into registration values ('".$name."','".$roll."','".$email."','".$contact."','".$room."','student')");
    }

}