<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once ("Category.Class.php"); ?>
<?php find_selected() ?>
<?php include("includes/header.php"); ?>
<table id="structure">
    <tr>
        <td id="categories">
            <h2>Edit category: <?php echo $sel_product_category['description']; ?></h2>
            <?php
            session_start(); // output a list of the fields that had errors
            if (isset($_SESSION['errors'])) { $errors = $_SESSION['errors']; display_errors($errors); session_destroy();} ?>
            <form action="CategoryController.php?product_categ=<?php
            echo urlencode($sel_product_category['category_id']);?>" method="post">

                <p>Category : <input type="text" name="description"
                    value="<?php echo $sel_product_category['description']; ?> "id="description" /><br />

                    <br/>
                    <input type="submit" name="submit" value="Edit category" />
                    &nbsp;&nbsp;
                    <a href="CategoryController.php?product_categ=<?php echo urlencode($sel_product_category['category_id']); ?>"
                       onclick="return confirm('Are you sure?');">Delete category</a>
            </form>
            <a href="CategoryCreateView.php">Cancel</a>
        </td>
    </tr>
</table>
<?php require("includes/footer.php"); ?>
