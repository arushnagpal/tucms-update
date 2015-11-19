<?php
$count = 0;
if ($go == '') {
    if ($message == '') {
        echo "<center><br /><br/><br /><br /><h2>Invalid Data.....Redirecting</h2></center>";
        echo "<script>setTimeout(function(){document.location.assign('http://localhost/ci/student')}, 2000)</script>";
        die();
    }
    if ($num_results == 0 || $flag == 0) {
        echo "<center><br /><br/><br /><br /><h2>Invalid Data.....Redirecting</h2></center>";
        echo "<script>setTimeout(function(){document.location.assign('http://localhost/ci/student')}, 2000)</script>";
        die();
    }
    $_SESSION['type'] = $type;
    $_SESSION['level'] = $level;
    $_SESSION['msg'] = $message;
    $name = $_SESSION['name'];
}
if ($complaint['count'] > 0) {
    ?>
<section id="main" class="container">
        <div class="box">
            <div class="table-wrapper">
                <center><h2 >Complaints similar to yours were found</h2></center>
                <table id="keywords" class="tablesorter" >
                    <thead>
                        <tr>
                           <!-- <th><input type="checkbox" id="all"><label></label> </th>-->
                            <th>Complaint Id</th>
                            <th>Category</th>
                            <th>Room No</th>
                            <th>Details</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($complaint as $row) {
                            ?>
                            <tr>
                                <td><?php echo $row['comp_id']; ?></td>
                                <td><?php echo $row['category']; ?></td>
                                <td><?php echo $row['roomno']; ?></td>
                                <td><?php echo $row['details']; ?></td>
                                <td><?php echo $row['comp_date']; ?></td>
                                <td><?php
                                    if ($row['status'] == 'Pending')
                                        echo "<b style='color:blue' >" . $row['status'] . "</b>";
                                    else if ($row['status'] == 'Complete')
                                        echo "<b style='color:green'>" . $row['status'] . "</b>";
                                    else if ($row['status'] == 'Urgent')
                                        echo "<b style='color:red'>" . $row['status'] . "</b>";
                                    else
                                        echo $row['status'];
                                    ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <form action="<?php echo base_url(); ?>student/addComp" method="post" >
            <center><ul class="actions">
                    <li><input type="hidden" value="go" name="go"/></li>
                    <li><a><input type="submit" class="button" value="Still Submit"  /></a></li>
                    <li><a><input type="button" class="button" value="Go back" onclick='window.location.assign("http://localhost/ci/student")' /></a></li>
                </ul>
                <b><p style="color:red">Warning : Do not submit the same cluster complaint if it has already been registered. </p></b>
            </center>
        </form>
        </div>
    </section>
    <?php
}
else {
    unset($go);
    header('location: ' . base_url() . 'student/addComp');
}
?>
