<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once ("Project.Class.php"); ?>
<?php require_once ("Employee.Class.php"); ?>
<?php require_once ("Customer.Class.php"); ?>
<?php find_selected() ?>
<?php include("includes/header.php"); ?>
<table id="structure">
<tr>
     <td id="navigation">
        <?php echo navigation($sel_project_category, $sel_product,$sel_project, $sel_employee ); ?>
        </td>
	 <td id="categories">
        <h2>Add new project</h2>
        <?php session_start();// output a list of the fields that had errors		
            if (isset($_SESSION['errors'])) { $errors=$_SESSION['errors']; display_errors($errors); session_destroy(); }?>

            <form action="ProjectController.php" method="post">
            <p>Employee : 
            <select name="employee_name">								
                <?php
                    $employee = new Employee();
                    $employee_set = $employee->get_all_employee();
                    while($row = mysql_fetch_array($employee_set)){echo "<option value=\"{$row['employee_name']}\">{$row['employee_name']}</option>"; }
                ?>						
            </select>
            </p>							
            <p>Customer : 
            <select name="customer_name">								
                <?php
                    $customer = new Customer();
                    $customer_set = $customer->get_all_customer();					
                    while($row = mysql_fetch_array($customer_set)){ echo "<option value=\"{$row['customer_name']}\">{$row['customer_name']}</option>";}
                ?>						
            </select>
            </p>				
            <p>Start day : <input type="text" name="start_day" value="" id="start_day" /><br />
            <p>Due day : <input type="text" name="due_day" value="" id="due_day" /><br />
            <p>Description : <input type="text" name="description" value="" id="description" /><br />
            <br/>
            <input type="submit" name="submit" value="Add project" />

            </form>
        </br>
        <a href="content.php">Back to projects</a>	
	</td>		
</tr>
</table>
<?php require("includes/footer.php"); ?>