<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	if(intval($_GET['product_categ']) == 0)// test if it is a valid project_id
	{ redirect_to("product_area.php"); }
	if(isset($_POST['submit']))// test if the form have been submited
	{
		$errors = array();
		 // Form validation
		 if(!isset($_POST['description']) || empty($_POST['description'])) 
		 { $errors[] = "description"; }		 
		 // check if the length is correct		 
		 if(strlen(trim(mysql_prep($_POST['description']))) > 30)
		 { $errors[] = "description"; }		 
		 if(empty($errors))
		 { 
			//perform update
			$category_id = mysql_prep($_GET['product_categ']);		 
			$description = mysql_prep($_POST['description']);
						
			$query = "UPDATE category SET					
					description = '{$description}'
					WHERE category_id = {$category_id}";
			
			$result = mysql_query($query, $connection);	
			if(mysql_affected_rows() == 1) // sql errors
			{ $message = "The category was successfully update. "; } //Success
			else
			{				
				$message = "The category update failed. "; //failed
				$message .= "<br />". mysql_error();
			} // end if(empty($errors))		 
		 } else { // validation errors occurred
			if(count($errors)==1)
			{	$message = "There was one error in the form."; 	}
			else
			{	$message = "There were " . count($errors) . " error in the form.";	}
		 }	
	} // end if(iseet($_POST['submit']))
?>
<?php find_selected() ?>
<?php include("includes/header.php"); ?>
<table id="structure">
<tr>
     <td id="navigation">
		<?php echo product_navigation($sel_product_category, $sel_product); ?>
		</td>
	 <td id="categories">
		<h2>Edit category: <?php echo $sel_product_category['description']; ?></h2>
		<?php if(!empty($message))
		{ echo "<p class=\"message\">" . $message . "</p>"; }?>
		<?php
		// output a list of the fields that had errors
		if (!empty($errors)) { display_errors($errors); }
		?>
			<form action="edit_category.php?categ=<?php echo
			urlencode($sel_product_category['category_id']);?>" method="post">				
				<p>Description : <input type="text" name="description" 
				value="<?php echo $sel_product_category['description']; ?> "
				id="description" /><br />
				<br/>
				<input type="submit" name="submit" value="Edit category" />	
				&nbsp;&nbsp;
				<a href="product_area.php">Cancel edit</a>
				&nbsp;&nbsp;	
				<a href="delete_category.php?categ=<?php 	echo urlencode($sel_product_category['category_id']); ?>" 
						onclick="return confirm('Are you sure?');">Delete category</a>		
					
				&nbsp;&nbsp;	
				<a href="create_product.php?product_categ=<?php echo urlencode($sel_product_category['category_id']); ?>"> Add new product</a>			
			</form>		
	</td>		
</tr>
</table>
<?php require("includes/footer.php"); ?>
