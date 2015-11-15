<!-- Main -->

<section id="main" class="container" style="padding-bottom: 0">
    <header>
        <h2>New complaint</h2>
    </header>
    <ul class="actions" style="text-align:center">
        <?php
        foreach ($category as $val) {
            if ($val == $title)
                continue;
            ?>
            <li><input type="button" style = "width: 200px" class="special" onClick="changeRC()" value="<?php echo $val; ?>"/></li>
            <?php
        }
        ?>
    </ul>
</section>
<section id="main" class="container 75%" style="padding-top: 0">
    <div class="box">

        <form method="post" action="<?php echo base_url(); ?>index.php/student/check" name="complaint" id="complaint">
            <div id="type"><h3>Electricity</h3>
                <input type="hidden" name="type" value="Electricity"/>
            </div>

            <div id="room_cluster" class="row uniform half collapse-at-2">
                <div class="6u">
                    <input type="radio" id="room" name="level" value="room">
                    <label for="room">Room</label>
                </div>
                <div class="6u">
                    <input type="radio" id="cluster" name="level" checked="true"  value="cluster">
                    <label for="cluster">Cluster</label>
                </div>

            </div>
            <div class="row uniform half">
                <div class="12u">
                    <textarea maxlength="60" name="message" id="message" placeholder="Type your complaint here..." rows="4" required onKeyDown="limitText(this.form.message, this.form.countdown, 60);" onKeyUp="limitText(this.form.message, this.form.countdown, 60);" style="resize:none"></textarea>
                    <input type="hidden" name="countdown" value="60">
                    <div id ="count" name="count">(Maximum characters: 60) You have 60 characters left.</div>
                </div>
            </div>
            <div class="row uniform">
                <div class="12u">
                    <ul class="actions align-center">
                        <li><input type="submit" value="Submit" /></li>
                    </ul>
                </div>
            </div>
        </form>
    </div>
</section>
<?php if ($pollcheck['poll'] == 0) { ?>
<div id="fadeandscale" style="">
        <div id="pollDisplay" class="box" style="width: 50%; margin: auto">
            <form><h3><?php echo $query['ques']; ?>?</h3>
                <input id="s" name="s" type="hidden" value="<?php echo htmlspecialchars($query['id']); ?>">
                <input type="radio" name="poll_option" id="1" class="poll_sys" value="1">
                <label for="1"><?php
                    echo $query['op1'];
                    ?></label>
                <br>
                <input type="radio" name="poll_option" id="2" class="poll_sys" value="2">
                <label for="2"><?php
                    echo $query['op2'];
                    ?></label>
                <br>
                <?php if ($query['op3'] != 'NULL') { ?>
                    <input type="radio" name="poll_option" id="3" class="poll_sys" value="3">
                    <label for="3"><?php
                        echo $query['op3'];
                        ?></label>
                    <br>
                <?php } ?>
                <?php if ($query['op4'] != 'NULL') { ?>
                    <input type="radio" name="poll_option" id="4" class="poll_sys" value="4">
                    <label for="4"><?php
                        echo $query['op4'];
                        ?></label>
                    <br>
                <?php } ?>
                <button class="button special" onclick="return submitPoll('<?php echo htmlspecialchars($query['id']); ?>');" name="poll" >Submit Vote</button>
            </form>
        </div>
    </div>
    <div><button class="fadeandscale_open " id="pop" style="display:none">pop</button></div>

    <script>
        function submitPoll(id) {
            var radios = $(".poll_sys");
            var checked = '';
            for (var i = 0; i < radios.length; i++) {
                if (radios[i].checked) {
                    var checked = 'checked';
                }
            }
            if (checked == '') {
                alert("Please select an Option to participate in the poll");
                radios[0].focus();
                return false;
            }

            var radiovalue = $('input[name="poll_option"]:checked').val();
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function()
            {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("pollDisplay").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "<?php echo base_url(); ?>index.php/student/pollx?vote=" + radiovalue + "&z=" + id, true);
            xmlhttp.send();
            return false;
        }
    </script>
<?php } ?>
<script src="<?php echo base_url(); ?>public/js/student.js"></script>
<script>
        $(document).ready(function() {
            // Initialize the plugin
            $('#fadeandscale').popup();
            transition: 'all 0.3s'
            $('#pop').trigger('click');
        });
</script>
