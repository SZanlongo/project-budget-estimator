<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once ("ProjectCategoryDetail.Class.php"); ?>
<?php find_selected() ?>
<?php include("includes/header.php"); ?>
<table id="structure">
<tr>
     <td id="navigation">
	<?php echo navigation($sel_project_category,$sel_project); ?> </td>		
	 <td id="categories">
        <h2>Add <?php echo $sel_project_category['description']; ?> product.</h2>
        <?php if(!empty($message)){ echo "<p class=\"message\">" . $message . "</p>"; }?>
        <?php if (!empty($errors)) { display_errors($errors); }	// output a list of the fields that had errors ?>
            <form action="ProjectCategoryDetailController.php?project_category_id=<?php echo
                urlencode($sel_project_category['project_category_id']);?>" method="post">
                <p>Product : 
                    <select name="item">								
                    <?php						
                        //get category_id by project_category_id
                        $project_category_id = $sel_project_category['project_category_id'];							
                        $query = "SELECT category_id 
                                        FROM project_category 
                                        WHERE project_category_id = $project_category_id";
                        $category_id = mysql_query($query, $connection);
                        confirm_query($category_id);
                        $category_id = mysql_fetch_array($category_id);
                        $category_id = $category_id['category_id'];
                        // get product by category
                        $query = "SELECT * 
                                        FROM product 
                                        WHERE category_id = $category_id";	
                        $product_set = mysql_query($query, $connection);
                        confirm_query($product_set);							
                        while($row = mysql_fetch_array($product_set)){echo "<option value=\"{$row['item']}\">{$row['item']}</option>";}
                    ?>						
                    </select>
                </p>						
                <p>Quantity : <input type="text" name="quantity" value="" id="quantity" /><br /><br/>
                <input type="submit" name="submit" value="Add product" />
                &nbsp;&nbsp;
                <a href="ProjectCategoryDeleteController.php?project_category_id=<?php echo urlencode($sel_project_category['project_category_id']); ?>" 
                                onclick="return confirm('Are you sure?');">Delete project category</a>					
                &nbsp;
                <a href="content.php">Back to projects</a>	
            </form>			
            <h2> <?php echo $sel_project_category['description']; ?> category detail.</h2>
        <?php
                // get the products incurring on each project by category
                $project_category_id = $sel_project_category['project_category_id'];	
                $query = "SELECT project_category_detail.project_category_detail_id, project_category_detail.project_category_id,			 
                        project_category_detail.product_id, product.item , project_category_detail.quantity				
                        FROM project_category_detail , product 
                        WHERE project_category_id = $project_category_id
                        AND project_category_detail.product_id = product.product_id ";

                $result_set = mysql_query($query, $connection);
                confirm_query($result_set);
                // find out the number of columns in result
                $column_count = mysql_num_fields($result_set);
                confirm_query($column_count);
                // Here the table attributes from the $table_params variable are added
                print("<TABLE border='1' >\n");
                // optionally print a bold header at top of table
                if(TRUE) {
                        print("<TR>");
                        for($column_num = 0; $column_num < $column_count; $column_num++) {
                                $field_name = mysql_field_name($result_set, $column_num);
                                print("<TH>$field_name</TH>");
                        }
                        print("</TR>\n");
                }
                // print the body of the table
                while($row = mysql_fetch_row($result_set)) {
                        print("<TR ALIGN=LEFT VALIGN=TOP>");
                        for($column_num = 0; $column_num < $column_count; $column_num++) {
                                print("<TD>$row[$column_num]</TD>\n");					
                        }
                        print("</TR>\n");
                }
                print("</TABLE>\n");
        ?>
                <br/>
                <?php echo("<h2>Clik on item to bit.</h2>"); ?>
        <?php	// create links to bit on product			
                $result_set = mysql_query($query, $connection);			
                while($row = mysql_fetch_array($result_set)){ echo "<a href='BidCreateView.php?proj_categ_detail="
                    .urlencode($row['project_category_detail_id'])."'>".$row["item"] ."</a><br>";}	
        ?> 	
                <br/>
                <?php echo("<h2>Clik on item to delete.</h2>"); ?>
        <?php	// create links to bit on product			
                $result_set = mysql_query($query, $connection);			
                while($row = mysql_fetch_array($result_set)){ echo "<a href='ProjectCategoryDetailDeleteController.php?proj_categ_detail="
                    .urlencode($row['project_category_detail_id'])."'>".$row["item"] ."</a><br>";}	
        ?> 	
	</td>		
</tr>
</table>
<?php require("includes/footer.php"); ?>



