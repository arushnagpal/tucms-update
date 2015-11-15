<section id="main" class="container 75%" >
    <header>
        <h3 style="margin-bottom:0px;">Remove complaint category</h3>
        <?php
        if (isset($_SESSION['stmt'])) {
            echo "<p style=\"margin-bottom:0px;\">Category Deleted Successfully! </p>";
        }
        ?>
    </header>
    <div class="box">
        <h5>Select the category to remove and click on delete.</h5>
        <form method="get" action="<?php echo base_url(); ?>index.php/admin/deleteCategory">
            <table>
                <?php
                $i = 1;
                echo "<tr>";
                //print_r($category);
                foreach ($category as $cat) {
                    echo '<td><input type="radio" id="' . $cat . '" name="category" value="' . $cat . '"><label for="' . $cat . '">' . $cat . '</label></td>';
                    if ($i % 3 == 0)
                        echo "</tr><tr>";
                    $i++;
                }
                echo "</tr>";
                ?>
            </table>
            <input type="submit" class="special" value="Delete">
        </form>
    </div>
</section>