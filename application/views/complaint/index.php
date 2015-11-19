<body class="landing">
    <!-- Banner -->
    <section id="banner">
        <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();" style="position:absolute; top: 0; z-index: 20000; color: wheat;">

        </marquee>

        <b><h2>Online Hostel J</h2></b><br>
        <p><font color="black">
        <!-- Main Notice -->
        <font color="red">
	Web Developers needed. <a class="fadeandscale_open" style="color: blue">Whats in it for you?</a> Interested students contact before 20th October, 2015<br>Email: saurabhgarg510@gmail.com
</font><br>

        All those who are not registered for the website are requested to contact caretaker.<br>
        Tuckshop login not working? Contact Naman Garg: nmngarg174@gmail.com, 8437928163 
        <ul class="actions">
            <li><a href="<?php echo base_url(); ?>complaint/sign_in" class="button special">Sign In (For Complaints)</a>&nbsp &nbsp 
                <a href="http://tuckshop.onlinehostelj.in" class="button special" target="_blank">Hostel J Tuck Shop</a>&nbsp &nbsp
                <br>
             <!--   <a href="http://book.onlinehostelj.in" class="button special">Online Hostel Allotment</a>&nbsp &nbsp 
                <a href="http://onlinehostelj.in/shared/" class="button special">Shared Room Allotment</a><br>     -->           
            </li>
        </ul>
            <p><font color="red"><h3>Announcements</h3></font></p>
             <font color="white"><?php $i=1; foreach($notifications as $row1)
             {
                echo $i++.". ";
                echo $row1;
                echo "&nbsp;&nbsp;&nbsp;&nbsp;<br>";
                }    ?> </font>
              
            
    </section><br>


    <br><br>
    <!-- Main -->
    <section id="main" class="container">
        <section class="box special">
            <header class="major">
                <h2>Everything&nbsp; at&nbsp; one&nbsp; place
                    </h2>
            </header>
            <span class="image newfeatured"><img src="<?php echo base_url(); ?>public/images/pic01.jpg" alt="" /></span>
        </section>
    </section>
    <div id="fadeandscale" style="">
            <div class="box">
                <div id="type">
                        <h3>Whats in it for you?</h3>
                        <?php $str='
                        -> Role: Software developer :)<br>
                        -> Get to work with the best developers %-P<br>
                        -> Get your name in the project to show off :)<br>
                        -> Certificates from the DoSA :coolhmm:<br>' ; 
                        $str=  parse_smileys($str, base_url().'public/smileys');
                        echo $str;
                        ?>

                </div>
            </div>
    </div>
    <!-- Include jQuery Popup Overlay -->
    <script src="<?php echo base_url(); ?>public/js/jquery.popupoverlay.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize the plugin
            $('#fadeandscale').popup({
                transition: 'all 0.3s' //optional
            });
        });
    </script>