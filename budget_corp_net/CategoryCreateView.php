<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once ("Category.Class.php"); ?>
<?php find_selected() ?>
<?php include("includes/header.php"); ?>
<table align="center">
    <tr>
        <td id="categories">
            <h2>Add category:</h2>
            <?php session_start(); // output a list of the fields that had errors
            if (isset($_SESSION['errors'])) {$errors = $_SESSION['errors']; display_errors($errors); session_destroy();} ?>
           
            <form action="CategoryController.php" method="post">
                Description : <input type="text" name="description" value="" id="description" >
                    <input type="submit" name="submit" value="Add category" />
                    &nbsp;
                    <a href="CategoryCreateView.php">Cancel</a>
            </form>
            
            <?php echo("<h2>List of categories.</h2>"); // dispaly category table?> 
            <?php  $category = new Category(); // create the category object.
                   $category_set = $category->getCategoryList();?>
            
            <br/>
            
            <table cellpadding="0" width="725" height="125">
                
                <td>
                    <form action="ProductController.php" method="post">                			
                        Edit Category : 
                            <select name="description">								
                                <?php $category = new Category(); // create category object
                                    $category_set = $category->get_all_category();						
                                    while($row = mysql_fetch_array($category_set)){echo "<option value=\"{$row['description']}\">{$row['description']}</option>";}?>						
                            </select>

                        <input type="submit" name="submit" value="Edit" />
                        
                        &nbsp;
                    </form>

                    <!-- <br/> -->

                    </td>
                    <tr/>
                    <td>
                    
                    <form action="ProductController.php" method="post">                			
                        Delete Category : 
                            <select name="description">								
                                <?php $category = new Category(); // create category object
                                    $category_set = $category->get_all_category();						
                                    while($row = mysql_fetch_array($category_set)){echo "<option value=\"{$row['description']}\">{$row['description']}</option>";}?>						
                            </select>

                        <input type="submit" name="submit" value="Delete" />
                        

                        &nbsp;
                    </form>
                </td>
            </table>
            
            <br/>
            <?php echo("<h2>Click category to edit or delete</h2>"); ?>
             <?php $category_set = $category->get_all_category();
             while ($category = mysql_fetch_array($category_set)) {// generate links to edit or delete category
                echo "<a href='CategoryEditView.php?product_categ=" . urlencode($category['category_id']) . "'>" 
                        . $category['description'] . "</a><br>";}?>
       </td>
    </tr>
</table>
<?php require("includes/footer.php"); ?>