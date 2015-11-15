<section id="main" class="container 75%">
    <div class="box">
        <div id="type">
            <center>
                <h2>Forgot Password</h2>
                <?php
                if (!isset($_SESSION['error']) || (isset($_SESSION['error']) && $_SESSION['error'] != 'SUCCESS')) {
                    if (isset($_SESSION['error']))
                        echo $_SESSION['error'] . '<br>';
                    ?>
                    <form action="<?php echo base_url(); ?>index.php/complaint/checkEmail" method="post">
                        <div class="row uniform">
                            <div class="8u"><input type="email" name="email" required placeholder="Enter your registered email..."></div>
                            <div class="4u"><input type="submit" class="special" value="Reset Password"></div>
                        </div>
                    </form>

                    <?php
                }
                if (isset($_SESSION['error']) && $_SESSION['error'] == 'SUCCESS')
                    echo 'Reset Password link has been sent to your email...';
                ?>
                <ul class="actions" style="text-align:center">
                    <li><a href="<?php echo base_url(); ?>index.php/complaint" class="special">Click here </a> to go back</li>
                    <li><a href="<?php echo base_url(); ?>index.php/complaint/sign_in" class="special">Click here </a> to login</li>
                </ul>
            </center>
        </div>
    </div>
</section>
