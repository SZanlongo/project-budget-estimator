<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php find_selected() ?>
<?php include("includes/header.php"); ?>
<table id="structure">
<tr>
     <td id="categories">
		<h2>Edit Customer: <?php echo $sel_customer['customer_name']; ?></h2>
		<?php session_start();// output a list of the fields that had errors		
                 if (isset($_SESSION['errors'])) { $errors=$_SESSION['errors']; display_errors($errors); session_destroy(); }?>
                
			<form action="CustomerController.php?cust=<?php echo
				urlencode($sel_customer['customer_id']);?>" method="post">

				<p>Company name : <input type="text" name="customer_name" 
				value="<?php echo $sel_customer['customer_name']; ?> "	id="customer_name" /><br />
				
				<p>Contact name : <input type="text" name="contact_name" 
				value="<?php echo $sel_customer['contact_name']; ?> "	id="contact_name" /><br />
						
				<p>Phone number : <input type="text" name="phone_number" 
				value="<?php echo $sel_customer['phone_number']; ?> " id="phone_number" /><br />
				
				<p>Email : <input type="text" name="email" 
				value="<?php echo $sel_customer['email']; ?> " id="email" /><br />
				
				<br/>
				<input type="submit" name="submit" value="Edit customer" />
								
				&nbsp;&nbsp;
				<a href="CustomerController.php?cust=<?php echo urlencode($sel_customer['customer_id']); ?>"  
						onclick="return confirm('Are you sure?');">Delete customer</a>
						
			</form>
		</br>
		<a href="CustomerCreateView.php">Cancel</a>
	
	</td>		
</tr>
</table>
<?php require("includes/footer.php"); ?>