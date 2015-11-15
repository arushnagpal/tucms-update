<section id="main" class="container 75%" >
    <header>
        <h3 style="margin-bottom:0px;">Add new complaint category</h3>
        <?php
        if (isset($_SESSION['stmt'])) {
            echo "<p style=\"margin-bottom:0px;\">New Category Added Successfully! </p>";
        }
        ?>
    </header>
    <div class="box">
        <form method="post" action="<?php echo base_url(); ?>index.php/admin/insertCategory">
            <div class="row uniform half">
                <div class="12u">
                    <input type="text" name="category" id="category" placeholder="Category Name" required/>
                </div>
            </div>
            <div class="row uniform half">
                <div class="12u">
                    <select name="level" class="dd" required>
                        <option hidden="">Level</option>
                        <option value="cluster">Cluster</option>
                        <option value="rc">Room and Cluster</option>
                    </select>
                </div>
            </div>

            <div class="row uniform">
                <div class="12u">
                    <ul class="actions align-center">
                        <li><input type="submit" value="Add Category" /></li>
                    </ul>
                </div>
            </div>
        </form>
    </div>
</section>