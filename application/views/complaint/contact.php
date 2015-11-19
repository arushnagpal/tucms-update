<?php
if (!isset($_COOKIE['count'])) {
    $c = 1;
    setcookie('count', $c, time() + (28800), "/");
}
?>

<script>
    function spam_alert() {
        alert("To prevent spamming, we allow atmost 3 feedbacks in 8 hours from 1 machine");
        window.location.assign("http://localhost/ci/complaint");
    }
</script>

<?php
//require_once(APPPATH.'libraries/functions.php'); 
if (isset($_SESSION['stmt'])) {
    //echo $_COOKIE['count'];
    $c = $_COOKIE['count'];
    $c += 1;
    setcookie('count', $c, time() + (28800), "/");
    if ($c > 4) {
        ?>
        <script type="text/javascript">
            spam_alert();
        </script>
        <?php
        die();
    }
    ?>

    <!-- Main -->
    <section id="main" class="container 75%">
        <header >
            <h2>Contact Us</h2>
            <p>
                <?php
                echo "Hi " . $_SESSION['nm'] . ", we have received your message";
            } else {
                echo '<section id="main" class="container 75%" >
        <header >
            <h2 >Contact Us</h2>
            <p style="padding: 0">';
                echo "Tell us what you think about our little operation. ";
            }
            ?></p>
    </header>
    <div class="box">
        <form method="post" action="<?php echo base_url(); ?>complaint/insertContact">
            <div class="row uniform half collapse-at-2">
                <div class="6u">
                    <input type="text" name="name" id="name" value="" placeholder="Name" required title="Enter your name"/>
                </div>
                <div class="6u">
                    <input type="email" name="email" id="email" value="" placeholder="Email" required title="Enter your valid email id"/>
                </div>
            </div>

            <div class="row uniform half">
                <div class="12u">
                    <textarea name="message" id="message" placeholder="Enter your message" rows="6" required style="resize: vertical" title="Enter your message/feedback"></textarea>
                </div>
            </div>
            <div class="row uniform">
                <div class="12u">
                    <ul class="actions align-center">
                        <li><input type="submit" value="Send Message" /></li>
                    </ul>
                </div>
            </div>
        </form>
    </div>
</section>
