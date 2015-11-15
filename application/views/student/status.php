<?php
require_once(APPPATH . "libraries/functions.php");
?>

<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.tablesorter.js" defer></script>
<script type="text/javascript" defer>$(function() {
        $('#keywords').tablesorter({debug: true});
    });</script>
<script src="<?php echo base_url(); ?>public/js/complaint_stu.js" defer></script>
<!-- Main -->
<section id="main" class="container">
    <header>
        <h2>Complaints Status</h2>
    </header>
    <div class="box">
        <?php
        if ($status['counter'] != 0) {
            ?>
            <!---------------------------------------- POPUP start ------------------------->
            <div id="fadeandscale" style="text-align:center; width: 75%; padding: 0px;" >
                <table style="text-align:left">
                    <tr>
                        <th>Name</th>
                        <th>Complaint Id</th>
                        <th>Category</th>
                        <th>Room No</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th style="width: 25%">Details</th>
                    </tr>
                    <tr id="ajaxdata">
                    </tr>
                </table>
                <div class="box" style="padding: 15px;">
                    <div class="row uniform">
                        <div class="12u">
                            <center><h3>Remarks</h3></center>
                            <table style="text-align:center" id="getremark">
                                <?php // Loaded through ajax   ?>
                            </table>            
                        </div>
                    </div>
                    <br>
                </div>
            </div>
            <!---------------------------------------- POPUP end ------------------------->

            <div class="table-wrapper">
                <table id="keywords" class="tablesorter" >
                    <thead>
                        <tr>
                            <th>Complaint Id</th>
                            <th>Category</th>
                            <th>Details</th>
                            <th>Complaint Type</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($row as $val) { ?>
                            <tr>
                                <td><a class="fadeandscale_open" onclick=" show(<?php echo $val['comp_id']; ?>);"><?php echo $val['comp_id']; ?></a></td>
                                <td><?php echo $val['category']; ?></td>
                                <td><?php echo str_replace(array("\\r\\n", "\\r", "\\n"), "<br>", $val['details']); ?></td>
                                <td><?php echo $val['comp_type']; ?></td>
                                <td><?php echo format_date($val['comp_date']); ?></td>
                                <td><?php
                                    if ($val['status'] == 'Pending') {
                                        echo "<b style='color:blue'>" . $val['status'] . "</b>";
                                    } else if ($val['status'] == 'Complete') {
                                        echo "<b style='color:green'>" . $val['status'] . "</b>";
                                    } else if ($val['status'] == 'Urgent') {
                                        echo "<b style='color:red'>" . $val['status'] . "</b>";
                                    } else {
                                        echo $val['status'];
                                    }
                                }
                            } else
                                echo 'No Complaints added yet...';
                            ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        // Initialize the plugin
        $('#fadeandscale').popup({
            transition: 'all 0.3s' //optional
        });
    });
</script>