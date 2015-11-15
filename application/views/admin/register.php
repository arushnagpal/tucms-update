<section id="main" class="container 75%" >
    <header>
        <h3 style="margin-bottom:0px;">Register new student</h3>
        <?php
        if (isset($_SESSION['stmt'])) {
            echo "<p style=\"margin-bottom:0px;\">Registered Successfully! </p>";
            unset($_SESSION['stmt']);
        }
        if (isset($_SESSION['emailerr'])) {
            echo "<p style=\"margin-bottom:0px; color:#ff0000\">Email Already registered </p>";
            unset($_SESSION['emailerr']);
        }
        if (isset($_SESSION['roomerr'])) {
            echo "<p style=\"margin-bottom:0px; color:#ff0000\">Room Already registered </p>";
            unset($_SESSION['roomerr']);
        }

        ?>
    </header>
    <div class="box">
        <form method="post" action="<?php echo base_url(); ?>index.php/admin/registration">
            <div class="row uniform half">
                <div class="12u">
                    <input type="text" name="name" id="category" placeholder="Name" required/>
                </div>
            </div>
	    <div class="row uniform half">
                <div class="12u">
                    <input type="text" name="roll" id="category" placeholder="Roll Number" required/>
                </div>
            </div>
	    <div class="row uniform half">
                <div class="12u">
                    <input type="text" name="email" id="category" placeholder="Email" required/>
                </div>
            </div>
	    <div class="row uniform half">
                <div class="12u">
                    <input type="text" name="contact" id="category" maxlength="10" placeholder="Mobile" required/>
                </div>
            </div>
	    <div class="row uniform half">
                <div class="12u">
                    <input type="text" name="room" maxlength="6" onkeyup="roomSeparator()" id="room" placeholder="Room No." required/>
                </div>
            </div>

            <div class="row uniform">
                <div class="12u">
                    <ul class="actions align-center">
                        <li><input type="submit" value="Register Now" /></li>
                    </ul>
                </div>
            </div>
        </form>
    </div>
</section>
<script>
	function roomSeparator(){
		room=document.getElementById("room").value;
		l=room.length;
		if(l==2){
                        room=room.toUpperCase();
			room=room+"-";
		}
		document.getElementById("room").value=room;
	}
</script>