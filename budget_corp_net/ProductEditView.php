<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once ("Product.Class.php"); ?>
<?php require_once ("Category.Class.php"); ?>
<?php find_selected() ?>
<?php include("includes/header.php"); ?>
<table id="structure">
<tr>
 <td id="categories">
    <h2>Edit product: <?php echo $sel_product['item']; ?></h2>
    <?php session_start();// output a list of the fields that had errors		
    if (isset($_SESSION['errors'])) { $errors=$_SESSION['errors']; display_errors($errors); session_destroy(); }?>
        <form action="ProductController.php?prod=<?php echo
        urlencode($sel_product['product_id']);?>" method="post">

        <form action="EditProductView.php?prod=<?php echo
            urlencode($sel_product['product_id']);?>" method="post">

            <p>Item : <input type="text" name="item" 
            value="<?php echo $sel_product['item']; ?> "	id="item" /><br />

            <p>Description : <input type="text" name="description" 
            value="<?php echo $sel_product['description']; ?> " id="description" /><br />

            <p>Category : 
            <select name="category">								
                <?php $category = new Category(); // create category object
                        $category_set = $category->get_all_category();					
                    while($row = mysql_fetch_array($category_set))   
                    {
                        $category_id = $category->get_category_id($row['description']);
                        if($sel_product['category_id'] == $category_id) { echo "<option value=\"{$row['description']}\"";}
                        echo ">{$row['description']}</option>";
                    }?>						
            </select>
            </p>
            <br/>
            <input type="submit" name="submit" value="Edit product" />								
            &nbsp;&nbsp;
            <a href="ProductController.php?prod=<?php echo urlencode($sel_product['product_id']); ?>" 
                            onclick="return confirm('Are you sure?');">Delete product</a>						
        </form>
		<a href="ProductCreateView.php">Cancel edition</a>
	</td>		
</tr>
</table>
<?php require("includes/footer.php"); ?>

