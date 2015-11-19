<section id="main" class="container 75%" >
    <header>
        <h3 style="margin-bottom:0px;">Add or Remove Notifications</h3>
        <?php
        //if (isset($verified)) {
          //  echo "<p style=\"margin-bottom:0px;\">New Notification Added Successfully! </p>";
        //}
        ?>
    </header>
    <div class="box">
        <form method="post" action="<?php echo base_url(); ?>admin/add_notification">
            <div class="row uniform half">
                <div class="12u">
                    <input type="text" name="heading" id="heading" placeholder="Notification Description" required/>
                </div>
            </div>
            <div class="row uniform">
                <div class="12u">
                    <ul class="actions align-center">
                        <li><input type="submit" value="Add Notification" /></li>
                    </ul>
                </div>
            </div>
            <div class="row uniform">
                <div class="12u">
                    <h1>Current Notifications</h1>
                    <p>None for now</p>
                </div>
            </div>

        </form>
    </div>
</section>