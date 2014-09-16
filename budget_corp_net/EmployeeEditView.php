<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php find_selected() ?>
<?php include("includes/header.php"); ?>
<table id="structure">
<tr>
     <td id="categories">
        <h2>Edit employee: <?php echo $sel_employee['employee_name']; ?></h2>
        <?php session_start();// output a list of the fields that had errors		
        if (isset($_SESSION['errors'])) { $errors=$_SESSION['errors']; display_errors($errors); session_destroy(); }?>

            <form action="EmployeeController.php?empl=<?php echo
            urlencode($sel_employee['employee_id']);?>" method="post">

                    <p>Employee name : <input type="text" name="employee_name" 
                    value="<?php echo $sel_employee['employee_name']; ?> "	id="employee_name" /><br />

                    <p>Phone number : <input type="text" name="phone_number" 
                    value="<?php echo $sel_employee['phone_number']; ?> " id="phone_number" /><br />

                    <p>Email : <input type="text" name="email" 
                    value="<?php echo $sel_employee['email']; ?> " id="email" /><br />

                    <br/>
                    <input type="submit" name="submit" value="Edit employee" />

                    &nbsp;&nbsp;
                    <a href="EmployeeController.php?empl=<?php echo urlencode($sel_employee['employee_id']); ?>" 
                                    onclick="return confirm('Are you sure?');">Delete employee</a>						
            </form>
        <a href="EmployeeCreateView.php">Cancel</a>
    </td>		
</tr>
</table>
<?php require("includes/footer.php"); ?>