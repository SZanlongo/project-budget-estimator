<?php require_once ("User.Class.php"); ?>
<?php
         if(isset($_POST['submit']))
        {			
                $errors = array();
                $required_fields = array('name', 'password');
                foreach($required_fields as $fieldname){ if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) { 	$errors[] = $fieldname; }}	 
            
             if(empty($errors))
            {            
                $user = new User();
                $name = mysql_prep($_POST['name']);			
                $password = mysql_prep($_POST['password']); 
                $hashed_password = sha1($password);// hash the password

                $user->setName($name );
                $user->setPassword($hashed_password);                
                $user->validate();
            }
            else
            {
                session_start();                
                $_SESSION['errors'] = $errors;
                redirect_to("UserCreateView.php");
            }    
                 
    } // end if(iseet($_POST['submit']))
?>