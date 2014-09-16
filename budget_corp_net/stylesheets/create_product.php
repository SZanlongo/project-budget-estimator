<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php 
	if(intval($_GET['category_id']) == 0)// test if it is a valid project_id
	{ redirect_to("edit_category.php"); }
	if(isset($_POST['submit']))// test if the form have been submited
	{
		$errors = array();
         // Form validation
		 //check $required_fields
		 $required_fields = array('item', 'description');
		 foreach($required_fields as $fieldname)
		 {
			 if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname]))
			 { 	$errors[] = $fieldname; }
		 }// end check $required_fields
		
		 if(empty($errors))
		 { 
			//perform update
			$project_category_id = mysql_prep($_GET['project_category_id']);		 
			$item = mysql_prep($_POST['item']);
			$cetegory_id = mysql_prep('category_id'); // get product id
			$description = mysql_prep($_POST['description']);	
			
			$query = "INSERT INTO product 
				(item, description, category_id)
				VALUES
				( {$item}, {$description}, {$cetegory_id})";
			
			$result = mysql_query($query, $connection);	
			if(mysql_affected_rows() == 1) // sql errors
			{				
				$message = "The project was successfully update. "; //Success
			}else {				
				$message = "The project update failed. "; //failed
				$message .= "<br />". mysql_error();
			}// end if(empty($errors))			 
		 } else	{// validation errors occurred		 
			if(count($errors)==1)
			{	$message = "There was one error in the form."; 	}
			else
			{	$message = "There were " . count($errors) . " error in the form.";}	
		 }	
	} // end if(iseet($_POST['submit']))
?>
<?php find_selected() ?>
<?php include("includes/header.php"); ?>
<table id="structure">
<tr>
     <td id="navigation">
		<?php echo navigation($sel_project_category,$sel_project); ?> </td>		
	 <td id="categories">
		<h2>Add <?php echo $sel_product_category['description']; ?> product.</h2>
		<?php if(!empty($message)){ echo "<p class=\"message\">" . $message . "</p>"; }?>
		<?php if (!empty($errors)) { display_errors($errors); }	// output a list of the fields that had errors ?>
			<form action="create_product.php" method="post">
				<p>Product name : <input type="text" name="item" value="" id="item" /><br /><br/>
				<p>Description : <input type="text" name="description" value="" id="description" /><br /><br/>
				<input type="submit" name="submit" value="Create new product" />
				&nbsp;&nbsp;
				<a href="delete_project_category_detail.php?project_category_id=<?php echo 11; ?>" 
						onclick="return confirm('Are you sure?');">Delete projectect category</a>					
				&nbsp;
				<a href="content.php">Cancel </a>	
			</form>			
			<h2> <?php echo $sel_project_category['description']; ?> category detail.</h2>
		
	</td>		
</tr>
</table>
<?php require("includes/footer.php"); ?>