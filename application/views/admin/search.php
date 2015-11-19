<section id="main" class="container 75%" >
    <header>
        <h3 style="margin-bottom:0px;">Search For students</h3>
    </header>
    <div class="box">
        <form method="post" action="<?php echo base_url(); ?>admin/search">
            <div class="row uniform half">
                <div class="6u">
                    <input type="text" name="name" id="name" placeholder="Search by Name"/>
                </div>
                <div class="6u">
                    <input type="text" name="room" id="room" maxlength="6" onkeyup="roomSeparator()" placeholder="Search by Room"/>
                </div>
            </div>
            <div class="row uniform">
                <div class="12u">
                    <ul class="actions align-center">
                        <li><input type="submit" value="Search" /></li>
                    </ul>
                </div>
            </div>
        </form>
    </div>
</section>
<?php if(isset($room)){ ?>
<section class="container 75%" >
    <div class="box">
        <table>
        <tr><th>Roll No</th><td><?php echo $details['roll_no'] ?></td></tr>
        <tr><th>Name</th><td><?php echo $details['full_name'] ?></td></tr>
        <tr><th>Branch</th><td><?php echo $details['branch'] ?></td></tr>
        <tr><th>DOB</th><td><?php echo $details['dob'] ?></td></tr>
        <tr><th>Mobile</th><td><?php echo $details['student_mobile'] ?></td></tr>
        <tr><th>Email</th><td><?php echo $details['email'] ?></td></tr>
        <tr><th>Father Name</th><td><?php echo $details['father_name'] ?></td></tr>
        <tr><th>Father Mobile</th><td><?php echo $details['father_mobile'] ?></td></tr>
        <tr><th>Mother Name</th><td><?php echo $details['mother_name'] ?></td></tr>
        <tr><th>Mother Mobile</th><td><?php echo $details['mother_mobile'] ?></td></tr>
        <tr><th>Address</th><td><?php echo $details['permanent_address'] ?></td></tr>
        <tr><th>Room</th><td><?php echo $details['room_no'] ?></td></tr>
        </table>
    </div>
</section>
<?php } 
elseif(isset($name)){ ?>
<section class="container 75%" >
    <div class="box">
        <?php 
        foreach ($row as $details){
        ?>
        <table>
            <tr><th style="width:20%">Roll No</th><td><?php echo $details['roll_no'] ?></td></tr>
        <tr><th>Name</th><td><?php echo $details['full_name'] ?></td></tr>
        <tr><th>Branch</th><td><?php echo $details['branch'] ?></td></tr>
        <tr><th>DOB</th><td><?php echo $details['dob'] ?></td></tr>
        <tr><th>Mobile</th><td><?php echo $details['student_mobile'] ?></td></tr>
        <tr><th>Email</th><td><?php echo $details['email'] ?></td></tr>
        <tr><th>Father Name</th><td><?php echo $details['father_name'] ?></td></tr>
        <tr><th>Father Mobile</th><td><?php echo $details['father_mobile'] ?></td></tr>
        <tr><th>Mother Name</th><td><?php echo $details['mother_name'] ?></td></tr>
        <tr><th>Mother Mobile</th><td><?php echo $details['mother_mobile'] ?></td></tr>
        <tr><th>Address</th><td><?php echo $details['permanent_address'] ?></td></tr>
        <tr><th>Room</th><td><?php echo $details['room_no'] ?></td></tr>
        </table>
        <?php } ?>
    </div>
</section>
<?php } ?>

<script>
	function roomSeparator(){
		room=document.getElementById("room").value;
		l=room.length;
		if(l==2){
			room=room+"-";
		}
		document.getElementById("room").value=room;
	}
</script>