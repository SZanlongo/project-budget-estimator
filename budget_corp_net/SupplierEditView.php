<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once ("Supplier.Class.php"); ?>
<?php /*$supplier = new Supplier(); $supplier->SelectedSupplier() ; */?>  
<?php find_selected() ?>
<?php include("includes/header.php"); ?>
<table id="structure">
<tr>
     <td id="categories">
    <h2>Edit supplier: <?php echo $sel_supplier['supplier_name']; ?></h2>
    <?php session_start();// output a list of the fields that had errors		
    if (isset($_SESSION['errors'])) { $errors=$_SESSION['errors']; display_errors($errors); session_destroy(); }?>

    <form action="SupplierController.php?suppl=<?php echo
        urlencode($sel_supplier['supplier_id']);?>" method="post">

        <p>Company name : <input type="text" name="supplier_name" 
        value="<?php echo $sel_supplier['supplier_name']; ?> "	id="supplier_name" /><br />

        <p>Contact name : <input type="text" name="contact_name" 
        value="<?php echo $sel_supplier['contact_name']; ?> "	id="contact_name" /><br />

        <p>Phone number : <input type="text" name="phone_number" 
        value="<?php echo $sel_supplier['phone_number']; ?> " id="phone_number" /><br />

        <p>Email : <input type="text" name="email" 
        value="<?php echo $sel_supplier['email']; ?> " id="email" /><br />

        <br/>
        <input type="submit" name="submit" value="Edit supplier" />

        &nbsp;&nbsp;
        <a href="SupplierController.php?suppl=<?php echo urlencode($sel_supplier['supplier_id']); ?>" 
                        onclick="return confirm('Are you sure?');">Delete supplier</a>

    </form>
    </br>
     <!-- This is for rank vendor. -->
                <div style ="font-weight: bold; " >  
                    <form action ="SupplierController.php?suppl=<?php echo urlencode($sel_supplier['supplier_id']);?>" method="post"> 
                     Rank Supplier: <select name ="rank"> 
                                       <option value ="1"> 1 </option>
                                       <option value ="2"> 2 </option>
                                       <option value ="3" selected="selected"> 3 </option>
                                       <option value ="4"> 4 </option>
                                       <option value ="5"> 5 </option>
                                    </select>
                    <input type="submit" name="submit" value="Rank" />
                    </form>
                  <!-- end -->  
    <a href="SupplierCreateView.php">Cancel</a>
	
	</td>		
</tr>
</table>
<?php require("includes/footer.php"); ?>