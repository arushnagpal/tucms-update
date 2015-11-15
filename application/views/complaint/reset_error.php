<section id="main" class="container 75%">
    <div class="box">
        <div id="type">
            <center>
                <h1><?php if(isset($_SESSION['emailerr'])) echo $_SESSION['emailerr']; ?><br>
                Unsuccessful Attempt. Please provide a valid URL received on your email.</h1>
                
                <ul class="actions" style="text-align:center">
                    <li><a href="<?php echo base_url(); ?>index.php/complaint" class="special">Click here </a> to go back</li>
                    <li><a href="<?php echo base_url(); ?>index.php/complaint/sign_in" class="special">Click here </a> to login</li>
                </ul>
            </center>
        </div>
    </div>
</section>
