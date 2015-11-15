<script>
    function allClear() {
        var x;
        if (confirm("Are you sure you want to delete all complaints?") == true) {
            document.getElementById("all").submit();
        } else {
            x = "You pressed Cancel!";
        }

    }
    function compClear() {
        var x;
        if (confirm("Are you sure you want to delete all completed complaints?") == true) {
            document.getElementById("comp").submit();
        } else {
            x = "You pressed Cancel!";
        }

    }
</script>
</head>
<section id="main" class="container 50%" >
    <header>
        <h3 style="margin-bottom:0px;">Clean Database</h3>
    </header>

    <div class="box">
        <form action="<?php echo base_url(); ?>index.php/admin/deleteComplaints" method="post" id="all">
            <input type="hidden" value="all" name="clean">
            <input type="button" class="button special" value="Click here" onClick="allClear()"> to delete all complaints (Empty the table) <br>
        </form>
        <form action="<?php echo base_url(); ?>index.php/admin/deleteComplaints" method="post" id="comp">
            <input type="hidden" value="complete" name="clean">
            <input type="button" class="button special" value="Click here" onClick="compClear()"> to delete all completed complaints <br>
        </form>
    </div>
</section>
</body>
</html>