<section id="main" class="container 75%">
    <div class="box">
        <div id="type">
            <center>
                <h2><?php
                    if ($status == 'SUCCESS')
                        echo 'Your complaint has been recorded successfully';
                    else if ($status == 'EXCEED')
                        echo 'You have exceeded your maximum complaint limit of 2/day. Please try again tomorrow';
                    //else { header('location: ' . base_url() . 'student/'); die(); }
                    ?></h2>
                <ul class="actions" style="text-align:center">
                    <li><a href="<?php echo base_url(); ?>student" class="special">Click here </a> to go back</li>
                    <li><a href="<?php echo base_url(); ?>student/status" class="special">Click here </a> to view previous complaints</li>
                </ul>
            </center>
        </div>
    </div>
</section>
