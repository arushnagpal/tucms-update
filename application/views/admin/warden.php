<?php
require_once(APPPATH . "libraries/functions.php");
?>       
<script src="<?php echo base_url(); ?>public/js/print.js" defer></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.tablesorter.js" defer></script>
<script type="text/javascript" defer>$(function() {
        $('#keywords').tablesorter({debug: true});
    });</script>
<script src="<?php echo base_url(); ?>public/js/complaint_ct.js" type="text/javascript" defer></script>

<section id="main" class="container " >
    <form action="<?php echo base_url(); ?>index.php/admin/filter" method="get" id="form">
        <section class="box" style="padding-top: 15px; padding-bottom: 0px;">
            <h1> Filters </h1>
            <div class="row">
                <div class="4u">
                    <select class="dd" name="fcat">
                        <option hidden="" value="<?php
                        if (isset($_SESSION['fcat']))
                            echo $_SESSION['fcat'];
                        else
                            echo ""
                            ?>"><?php
                                    if (isset($_SESSION['fcat']) && $_SESSION['fcat'] != '') {
                                        echo $_SESSION['fcat'];
                                    } else
                                        echo "Category";
                                    ?></option>
                        <?php foreach ($category as $cat) { ?>
                            <option value="<?php echo $cat; ?>"><?php echo $cat; ?></option>
                        <?php } ?>
                        <option value="">All</option>
                    </select> </div>
                <div class="4u">

                    <select class="dd" name="fwing">
                        <option hidden="" value="<?php
                        if (isset($_SESSION['fwing']))
                            echo $_SESSION['fwing'];
                        else
                            echo ""
                            ?>"><?php
                                    if (isset($_SESSION['fwing']) && $_SESSION['fwing'] != '') {
                                        echo $_SESSION['fwing'];
                                    } else
                                        echo "Wing";
                                    ?></option>                            
                        <option value="West" >West</option>
                        <option value="East" >East</option>
                        <option value="">All</option>
                    </select>
                </div>
                <div class="4u">
                    <select class="dd" name="fstat">
                        <option hidden="" value="<?php
                        if (isset($_SESSION['fstat']))
                            echo $_SESSION['fstat'];
                        else
                            echo ""
                            ?>"><?php
                                    if (isset($_SESSION['fstat']) && $_SESSION['fstat'] != '') {
                                        echo $_SESSION['fstat'];
                                    } else
                                        echo "Status";
                                    ?></option>                            
                        <option value="Pending">Pending</option><option value="Waiting">Waiting</option>
                        <option value="Complete">Completed</option>
                        <option value="Urgent">Urgent</option>
                        <option value="">All</option> 
                    </select>
                </div></div>

            <div style="margin-bottom:20px"> Sort complaints from
                <br />
                <div class="row"> <div class="4u"> <input type="date" name="f_sdate" value="<?php if (isset($_SESSION['f_sdate'])) echo $_SESSION['f_sdate']; ?>"/></div>
                    <div class="4u"> <input type="date" id="f_edate" name="f_edate" value="<?php if (isset($_SESSION['f_edate'])) echo $_SESSION['f_edate']; ?>"/></div>
                    <div class="4u">
                        <ul class="actions" >
                            <li class="4u"><a onclick="document.getElementById('form').submit()" class="button special" >Search</a></li>
                            <li class="3u" style="margin-right: 20px;"><a href="<?php base_url() . 'index.php/admin/resetFilters' ?>" class="button special" >Reset</a></li>
                            <li class="3u"><a class="button special" onclick="printDiv('print')" >Print</a></li>
                        </ul>
                    </div>
                </div>

        </section>
    </form>

    <!---------------------------------------- POPUP start ------------------------->

    <div id="fadeandscale" style="text-align:center; width: 75%; padding: 0px;">

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
            <center>

                <form action="<?php echo base_url(); ?>index.php/admin/updateRemark" method="post">
                    <div class="row uniform">
                        <div class="4u">
                            <br />
                            <div class="12u" style="<?php if ($_SESSION['user_type'] == "warden") echo 'display:none;'; ?>">
                                Expected Completion Date
                                <input type="date" name="cdate" id="complete" <?php if ($_SESSION['user_type'] != "warden") echo 'required'; ?>/>
                            </div><br />            
                            <div class="12u">
                                <select class="dd" id="status" name="status">
                                    <?php
                                    if ($_SESSION['user_type'] == "warden") {
                                        echo '
                                        <option value="" hidden="">Status</option>
                                        <option value="Urgent" >Urgent</option>
                                        </div> ';
                                    } else {
                                        echo '
                                        <option value="" hidden="">Status</option>
                                        <option value="Waiting" >Waiting</option>
                                        <option value="Complete">Completed</option>
                                ';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="8u">
                            <textarea placeholder="Remarks" id="remark" name="remark" rows="4" style="resize:none"></textarea>
                        </div>
                    </div>
                    <br><input type="submit" class="button" value="Update" "/>
                </form> 
            </center>
        </div>
    </div>

    <!---------------------------------------- POPUP end -------------------------> 
    <div class="box">
        <h1 style="font-size:32px;text-align:center;margin-top:0px"> Complaints (<?php echo count($row); ?>) </h1>
        <div class="table-wrapper" id="print">
            <table id="keywords" class="tablesorter" >
                <thead>
                    <tr>
                        <th>Complaint Id</th>
                        <th>Category</th>
                        <th>Details</th>
                        <th>Room No</th>
                        <th>Type</th>
                        <th>Contact</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($row as $val) { ?>
                        <tr>
                            <td><a class="fadeandscale_open" onclick=" show(<?php echo $val['comp_id']; ?>);
                                   "><?php echo $val['comp_id']; ?></a></td>
                            <td><?php echo $val['category']; ?></td>
                            <td width="20%"><?php echo str_replace(array("\\r\\n", "\\r", "\\n"), "<br>", $val['details']); ?></td>
                            <td><?php echo $val['roomno']; ?></td>
                            <td><?php echo $val['comp_type']; ?></td>
                            <td><?php echo $val['contact']; ?></td>
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