<?php

include 'connection.php';
$salt = "thispasswordcannotbehacked";
$pass = hash('sha256', $salt . $_POST['pass']);
$query = "select * from registration where roomno='" . $_POST['roomno'] . "'";
$res = mysqli_query($mysqli, $query);
if (mysqli_num_rows($res) == 1) {
    echo "Record deleted";
    $row = mysqli_fetch_assoc($res);
    print_r($row);
    $query = "delete from registration where roomno='" . $_POST['roomno'] . "'";
    mysqli_query($mysqli, $query);
    echo "<br>";
}
$query = "insert into `registration`(`fname`,`lname`,`regno`,`email`,`contact`,`roomno`) values('" . $_POST['fname'] . "','" . $_POST['lname'] . "','" . $_POST['regno'] . "','" . $_POST['email'] . "','" . $_POST['contact'] . "','" . $_POST['roomno'] . "')";
echo $query;
if (mysqli_query($mysqli, $query)) {
    $query1 = "insert into `login`(`email`,`pass`) values('" . $_POST['email'] . "','" . $pass . "')";
    echo $query1;
    if (mysqli_query($mysqli, $query1)) {
        $to = $_POST['email'];
        $subject = "Registration";
        $message = "<html>
<head>
<title>Registration Email</title>
</head>
<body>
<p>You have been successfully registered for the online Hostel-J Complaint portal</p>
<pre>
<b>Name     :  </b>" . $_POST['fname'] . " " . $_POST['lname'] . "<br>
<b>Username :  </b>" . $_POST['email'] . "<br>
<b>Password :  </b>" . $_POST['pass'] . "
</pre>
<br>
http://onlinehostelj.in/
<br>
Login using these credentials and register your complaints.
Change this password after your first login.<br>
<br>
<b style='color:red'>Note : No complaint would be entertained through the caretaker office from 18 January onwards.</b>
</body>
</html>";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers.="From:Hostel-J<developer@onlinehostelj.in>";
        if (mail($to, $subject, $message, $headers))
            echo "success";
    } else
        echo "entry into login failed " . mysqli_error($mysqli);
} else
    echo " entry into registration failed " . mysqli_error($mysqli);
?>