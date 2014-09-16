<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once ("Supplier.Class.php"); ?>
<?php find_selected() ?>
<?php include("includes/header.php"); ?>
<table id="structure">
<tr>
    <td id="categories">
    <h2>Add supplier:</h2>

    <?php session_start();// output a list of the fields that had errors		
    if (isset($_SESSION['errors'])) { $errors=$_SESSION['errors']; display_errors($errors); session_destroy(); }?>

    <form action="SupplierController.php" method="post">				
        <p>Company name : <input type="text" name="supplier_name" value="" id="supplier_name" > 
        <p>Contact name : <input type="text" name="contact_name" value="" id="contact_name" >
        <p>Phone number : <input type="text" name="phone_number" value="" id="phone_number" ><br />
        <p>Email : <input type="text" name="email" value="" id="email" ><br />
        </br>
        <input type="submit" name="submit" value="Add supplier" />				
    </form>
    <a href="SupplierCreateView.php">Cancel</a>
    <?php echo("<h2>List of supplier.</h2>"); ?>
    <?php $supplier = new Supplier(); // create supplier object
            $supplier->getSupplierList();?>
    <br/>
    <?php echo("<h2>Clik on supplier name to edit or .</h2>"); ?>
        <?php // generate link to edit supplier	
        $supplier_set = $supplier->get_all_supplier();				
        while( $supplier = mysql_fetch_array($supplier_set))
        {
            echo "<a href='SupplierEditView.php?suppl=".urlencode($supplier['supplier_id'])."'>".$supplier["supplier_name"] ." </a><br>";				
        }			
    ?> 		
</td>		
</tr>
</table>
<?php require("includes/footer.php"); ?>