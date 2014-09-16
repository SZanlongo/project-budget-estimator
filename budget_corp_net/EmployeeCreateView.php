<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once ("Employee.Class.php"); ?>

<?php find_selected() ?>
<?php include("includes/header.php"); ?>
<table id="structure">
<tr>	
    <td id="categories">
    <h2>Add employee:</h2>

        <?php session_start();// output a list of the fields that had errors		
        if (isset($_SESSION['errors'])) { $errors=$_SESSION['errors']; display_errors($errors); session_destroy(); }?>

        <form action="EmployeeController.php" method="post">				
                <p>Name : <input type="text" name="employee_name" value="" id="employee_name" > 
                <p>Phone number : <input type="text" name="phone_number" value="" id="phone_number" ><br />
                <p>Email : <input type="text" name="email" value="" id="email" ><br />
                </br>
                <input type="submit" name="submit" value="Add employee" />				
        </form>
        <a href="EmployeeCreateView.php">Cancel</a>
        <?php echo("<h2>List of employee.</h2>"); ?>
        <?php $employee = new Employee();// create the employee
                $employee->getEmployeeList();?>

        <br/>
        <?php echo("<h2>Clik on employee name to edit.</h2>"); ?>
        <?php	// generate link to edit employee		
            $employee_set = $employee->get_all_employee();				
            while( $employee = mysql_fetch_array($employee_set))
            {			
                 echo "<a href='EmployeeEditView.php?empl=".urlencode($employee['employee_id'])."'>".$employee['employee_name'] ."</a><br>";			
            }		
        ?> 	
</td>		
</tr>
</table>
<?php require("includes/footer.php"); ?>