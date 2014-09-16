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
	<?php echo navigation($sel_project_category,$sel_project); ?>
     </td>
        <td id="categories">
            <h2>Edit project: <?php echo $sel_project['description']; ?></h2>
            <?php session_start();// output a list of the fields that had errors		
                if (isset($_SESSION['errors'])) { $errors=$_SESSION['errors']; display_errors($errors); session_destroy(); }?>

            <form action="ProjectController.php?proj=<?php echo	
            urlencode($sel_project['project_id']);?>" method="post">
                <p>Employee : 
                    <select name="employee_name">								
                        <?php $employee = new Employee(); // create employee object
                        $employee_set = $employee->get_all_employee();						
                        while($row = mysql_fetch_array($employee_set)) 
                        {
                            $employee_id = $employee->get_employee_id($row['employee_name']);                                        
                            if($sel_project['employee_id'] == $employee_id){echo "<option value=\"{$row['employee_name']}\"";}
                            echo ">{$row['employee_name']}</option>";
                        }?>						
                    </select>
                </p>							
                <p>Customer : 
                    <select name="customer_name">								
                        <?php $customer = new Customer();
                        $customer_set = $customer->get_all_customer();						
                        while($row = mysql_fetch_array($customer_set))   
                        {
                            $customer_id = $customer->get_customer_id($row['customer_name']);
                            if($sel_project['customer_id'] == $customer_id) { echo "<option value=\"{$row['customer_name']}\"";}                             
                            echo ">{$row['customer_name']}</option>";		
                        }?>						
                    </select>
                </p>				
                <p>Start day : <input type="text" name="start_day" value= "<?php echo $sel_project['start_day']; ?> " id="start_day" /><br />
                <p>Due day : <input type="text" name="due_day" value="<?php echo $sel_project['due_day']; ?> " id="due_day" /><br />
                <p>Description : <input type="text" name="description" value="<?php echo $sel_project['description']; ?> " id="description" /><br />
                <br/>
                <input type="submit" name="submit" value="Edit project" />
                &nbsp;&nbsp;
                <a href="ProjectCategoryCreateView.php?proj=<?php echo urlencode($sel_project['project_id']); ?>">Add category</a>	
                &nbsp;&nbsp;		
                <a href="ProjectController.php?proj=<?php echo urlencode($sel_project['project_id']); ?>"
                                    onclick="return confirm('Are you sure?');">Delete project</a>						
           </form>
            <a href="content.php">Back to projects</a>	
    </td>		
</tr>
</table>
<?php require("includes/footer.php"); ?>