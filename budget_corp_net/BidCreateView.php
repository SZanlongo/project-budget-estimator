<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once ("Bid.Class.php"); ?>
<?php require_once ("Supplier.Class.php"); ?>
<?php find_selected() ?>
<?php include("includes/header.php"); ?>
<table id="structure">
<tr>
     <td id="categories">
        <h2>Bit on item: <?php echo $sel_project_category_detail['item']; ?></h2>
        <?php session_start();// output a list of the fields that had errors		
            if (isset($_SESSION['errors'])) { $errors=$_SESSION['errors']; display_errors($errors); session_destroy(); }?>
            <form action="BidController.php?proj_categ_detail=<?php echo
            urlencode($sel_project_category_detail['project_category_detail_id']);?>" method="post">

            <p>Supplier :                 
                <select name="supplier_name">								
                <?php $supplier = new Supplier();// create supplier object
                    $supplier_set = $supplier->get_all_supplier();						
                    while($row = mysql_fetch_array($supplier_set))
                    {	
                        echo "<option value=\"{$row['supplier_name']}\">{$row['supplier_name']}</option>";
                    }
                ?>						
                </select>
            </p>
            <p>Bid : <input type="text" name="bid" value="" id="bid" /><br />  	
            <br/>
            <input type="submit" name="submit" value="Bid" />									
            </form>			
        <A HREF="javascript:history.go(-1)">Back</A>
    </td>		
</tr>
</table>
<?php require("includes/footer.php");?>