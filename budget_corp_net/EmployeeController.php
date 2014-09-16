<?php require_once ("Employee.Class.php"); ?>

<?php 
	if(!isset($_POST['submit'])&& intval($_GET['empl']) != 0)
        {
            $employee = new Employee();
            $employee_id = mysql_prep($_GET['empl']);
            $employee->delete($employee_id);            
        }
        else if(isset($_POST['submit']))// test if the form have been submited
	{
            $errors = array();            
            $required_fields = array('employee_name','phone_number', 'email');
            foreach($required_fields as $fieldname){ if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) { $errors[] = $fieldname; }}
            
            // check if the length is correct
            foreach($required_fields as $fieldname){ if(strlen(trim(mysql_prep($_POST[$fieldname]))) > 30) { $errors[] = $fieldname; } }
            
             if(empty($errors))
	    {            
                $employee = new Employee();
                
                $name = mysql_prep($_POST['employee_name']);
                $phone = mysql_prep($_POST['phone_number']);
                $email = mysql_prep($_POST['email']);       
               
                $employee->setEmployeeName($name);
                $employee->setEmployeePhone($phone);
                $employee->setEmployeeEmail($email);
                
                
                if(intval($_GET['empl']) != 0)
                {
                    $employee_id = mysql_prep($_GET['empl']);
                    $employee->update($employee_id);// update the employee
                }
                else
                {                    
                     $employee->create();// create the employee
                }
            }
            else
            {
                session_start();                
                $_SESSION['errors'] = $errors;
                redirect_to("EmployeeCreateView.php");
            }    
                 
	} // end if(iseet($_POST['submit']))
	 
?>