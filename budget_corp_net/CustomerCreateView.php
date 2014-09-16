<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once ("Customer.Class.php"); ?>
<?php find_selected() ?>
<?php include("includes/header.php"); ?>
<table id="structure">
<tr>
    <td id="categories">
    <h2>Add customer:</h2>
    <?php session_start();// output a list of the fields that had errors		
        if (isset($_SESSION['errors'])) { $errors=$_SESSION['errors']; display_errors($errors); session_destroy(); }?>

        <form action="CustomerController.php" method="post">				
            <p>Company name : <input type="text" name="customer_name" value="" id="customer_name" > 
            <p>Contact name : <input type="text" name="contact_name" value="" id="contact_name" >
            <p>Phone number : <input type="text" name="phone_number" value="" id="phone_number" ><br />
            <p>Email : <input type="text" name="email" value="" id="email" ><br />
            </br>
            <input type="submit" name="submit" value="Add customer" />				
        </form>
    </br>
    <a href="CustomerCreateView.php">Cancel</a>
    <?php echo("<h2>List of customer.</h2>"); ?>
    <?php $customer = new Customer(); // create customer object
            $customer->getCustomerList();?>

    <br/>
    <?php echo("<h2>Clik on customer name to edit.</h2>"); ?>
    <?php // generate link to edit customer
        $customer_set = $customer->get_all_customer();				
        while( $customer = mysql_fetch_array($customer_set))
        {
            echo "<a href='CustomerEditView.php?cust=".urlencode($customer['customer_id'])."'>".$customer["customer_name"] ."</a><br>";					
        }
    ?>		
</td>		
</tr>
</table>
<?php require("includes/footer.php"); ?>