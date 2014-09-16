<?php require_once ("ProjectCategory.Class.php"); ?>
<?php 
	if(!isset($_POST['submit'])&& intval($_GET['proj']) == 0)
        {
            redirect_to("ProjectCategoryCreateView.php");         
        }
        else if(isset($_POST['submit']))// test if the form have been submited
	{
            $errors = array();
            $required_fields = array('description');
            foreach($required_fields as $fieldname)
            {
                    if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) { $errors[] = $fieldname; }
            }// end check $required_fields

            // check if the length is correct
            $fields_with_lengths = array('description' => 30);	 
            foreach($fields_with_lengths as $fieldname => $maxlength)
            {
                if(strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength) { $errors[] = $fieldname; }
            }// end check fields length	 
            
             if(empty($errors))
	    {   
                $projectCategory = new ProjectCategory();
                $project_id = mysql_prep($_GET['proj']); // get project ID
                $category = mysql_prep($_POST['description']);// 	
                $category_id = get_category_id($category); // get the category ID	
               
                $projectCategory->setProjectID($project_id);
                $projectCategory->setCategoryID($category_id);
                $projectCategory->create();// create object
               
            }
            else
            {
                session_start();                
                $_SESSION['errors'] = $errors;
                redirect_to("ProjectCategoryCreateView.php");
            }    
                 
	} // end if(iseet($_POST['submit']))

	 
?>