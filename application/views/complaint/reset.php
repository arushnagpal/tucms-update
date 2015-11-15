<section id="main" class="container 75%">
    <div class="box">
        <div id="type">
            <center>
                <h2>Reset Password</h2>
                <form action="<?php echo base_url(); ?>index.php/complaint/updatePassword" method="post">
                    <input type="hidden" name="email_code" value="<?php echo $email_code; ?>" readonly>
                    <input type="email" name="email" value="<?php echo $email; ?>" readonly><br>
                    <span>Password : atleast 1 number, 1 lowercase alphabet and minimum length is 6</span>
                    <input type="password" name="pass" required placeholder="Enter your new password..."><br>
                    <?php if(isset($_SESSION['passerr'])) echo $_SESSION['passerr']; ?>
                    <input type="password" name="repass" required placeholder="Re-Enter your new password..."><br>
                    <?php if(isset($_SESSION['matcherr'])) echo $_SESSION['matcherr'];?><br>
                    <input type="submit" class="special" value="Reset Password">
                </form>
            </center>
        </div>
    </div>
</section>

