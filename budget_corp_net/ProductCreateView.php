<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once ("Product.Class.php"); ?>
<?php require_once ("Category.Class.php"); ?>
<?php find_selected() ?>
<?php include("includes/header.php"); ?>
<table id="structure">
<tr>
    <td id="categories">
        <h2>Add product:</h2>
        <?php session_start();// output a list of the fields that had errors		
        if (isset($_SESSION['errors'])) { $errors=$_SESSION['errors']; display_errors($errors); session_destroy(); }?>
            
            <form action="ProductController.php" method="post">
                <p>Product name : <input type="text" name="item" value="" id="item" /><br />  
                <p>Description : <input type="text" name="description" value="" id="description" /><br />				
                <p>Category : 
                    <select name="description">								
                        <?php $category = new Category(); // create category object
                            $category_set = $category->get_all_category();						
                            while($row = mysql_fetch_array($category_set)){echo "<option value=\"{$row['description']}\">{$row['description']}</option>";}?>						
                    </select>
                </p>			
                <input type="submit" name="submit" value="Create new product" />
                &nbsp;
                <a href="ProductCreateView.php">Cancel</a>
            </form>
        
        <?php echo("<h2>List of products.</h2>"); ?>
        <?php $product = new Product(); // create object
            $product->getProductList(); // display the list ?>	
        <br/>
        <?php echo("<h2>Clik product to edit.</h2>"); ?>
        <?php $product_set = $product->get_all_product();				
            while( $product = mysql_fetch_array($product_set)){
                echo "<a href='ProductEditView.php?prod=".urlencode($product['product_id'])."'>".$product['item'] ."</a><br>";}?> 	
    </td>		
</tr>
</table>
<?php require("includes/footer.php"); ?>