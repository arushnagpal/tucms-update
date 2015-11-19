<script src="<?php echo base_url(); ?>public/js/login_js.js"></script>

<!-- Main -->
<section id="main" class="container 75%" >

    <header>
        <h2>Sign In</h2>
        <!--<p></p>-->
    </header>
    <div class="box">
        <form method="post" name="login" autocomplete="off">
            <div class="row uniform half">
                <div class="12u">
                    <input type="text" name="username" id="username" placeholder="Email" required/>
                </div>
            </div>
            <div class="row uniform half">
                <div class="12u">
                    <input type="password" name="password" id="password" placeholder="Password" autocomplete="off" onkeyup="if (event.keyCode == 13)
                                document.getElementById('signin').click()" required/>
                </div>
            </div>
            <div class="row uniform half">
                <div class="12u">
                    <center>
                        <label id="captchenable" style="<?php if ((isset($_SESSION['false_login']) && $_SESSION['false_login'] < 3) || !isset($_SESSION['false_login'])) echo'display:none; color:red'; ?>">
                            <div class="4u" style="float: left" id="image"><img src="<?php echo base_url(); ?>public/images/captcha.php" height="50px" width="100px"></div>
                            <div class="4u" style="float: left"><input type="text" autocomplete="off" maxlength="4" name="captcha" id="captcha" placeholder="Image"  required/></div>  
                            <div class="4u" style="float: left">More than 2 wrong login attempts. Enter the number shown.</div>
                        </label>
                    </center>
                </div>
            </div>
            <div class="row uniform half">
                <div class="12u" style="padding-top:0px; padding-bottom: 10px">
                    <center>
                        <div id="incorrect" style="<?php if (!isset($_SESSION['false_login'])) echo'display:none; color:red'; ?>">Incorrect Email ID or Password</div>
                    </center>
                </div>
            </div>
            <div class="row uniform">
                <div class="12u" style="padding-top:0px">
                    <ul class="actions align-center">
                        <li><a><input type="button" class="special" id="signin" onClick="val()" value="Sign In" /></a></li>
                        <li><a class="button special" href="<?php echo base_url(); ?>complaint/forgotPassword">Forgot Password?</a></li>
                    </ul>
                </div>
            </div>
        </form>
    </div>
</section>
