<?php require_once ("Project.Class.php"); ?>
<?php require_once ("Employee.Class.php"); ?>
<?php require_once ("Customer.Class.php"); ?>
<?php
	if(!isset($_POST['submit'])&& intval($_GET['proj']) != 0)	
        {
            $project = new Project();
            $project_id = mysql_prep($_GET['proj']);		
            $project->delete($project_id);
        }
        else if(isset($_POST['submit']))
	{
	    $errors = array();
	    $required_fields = array('employee_name','customer_name', 'start_day','due_day', 'description');
	    foreach($required_fields as $fieldname){if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){ $errors[] = $fieldname; }}
            
	    // check if the length is correct
	    $fields_with_lengths = array('employee_name'=> 30,'customer_name'=> 30,'description' => 150);
	    foreach($fields_with_lengths as $fieldname => $maxlength){if(strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength){ $errors[] = $fieldname; }}
            
            if(empty($errors))
	    {
                $project = new Project();
		$employee_name = mysql_prep($_POST['employee_name']);
		$customer_name = mysql_prep($_POST['customer_name']);
		$start_day = mysql_prep($_POST['start_day']);
		$due_day = mysql_prep($_POST['due_day']);
		$description = mysql_prep($_POST['description']);	

		$employee_id = get_employee_id($employee_name);	// get employee id	
		$customer_id = get_customer_id($customer_name); // get customer id
               
                $project->setEmployeeID($employee_id);
                $project->setCustomerID($customer_id);
		$project->setStartDay($start_day);
		$project->setDueDay($due_day);
		$project->setDescription($description);
                
                if(intval($_GET['proj']) != 0)// update project
                {
                    $project_id = mysql_prep($_GET['proj']);	    
                    $project->update($project_id);
                }
                else
                {
                     $project->create();// create project
                }
            }
            else
            {
                session_start();                
                $_SESSION['errors'] = $errors;
                redirect_to("ProjectCreateView.php");
            }    
                 
    } // end if(iseet($_POST['submit']))	 
?>