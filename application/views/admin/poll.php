<section id="main" class="container 75%" >
    <header>
        <h3 style="margin-bottom:0px;">Add a new poll</h3>
        <?php
        if (isset($_SESSION['flag'])) {
            echo "<p style=\"margin-bottom:0px;\">Poll Added Successfully! </p>";
        }
        ?>
    </header>
    <div class="box">
        <form action="<?php echo base_url(); ?>admin/pollinsert" method="post">
            <input type="text" name="ques" placeholder="Enter the question here..."><br>
            <font color="red"><?php if (isset($_SESSION['queserr'])) echo $_SESSION['queserr']; ?></font>
            <input type="text" name="op1" placeholder="Option 1: " required><br>
            <input type="text" name="op2" placeholder="Option 2: " required><br>
            <input type="text" name="op3" placeholder="Option 3: (Optional)"><br>
            <input type="text" name="op4" placeholder="Option 4: (Optional)"><br>
            <input type="submit">
        </form>
    </div>
</section>