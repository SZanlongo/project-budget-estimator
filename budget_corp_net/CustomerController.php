<?php require_once ("Customer.Class.php"); ?>
<?php 
	if(!isset($_POST['submit'])&& intval($_GET['cust']) != 0)
        {
            $customer = new Customer();
            $customer_id = mysql_prep($_GET['cust']);
            $customer->delete($customer_id);            
        }
        else if(isset($_POST['submit']))// test if the form have been submited
	{
            $errors = array();
            $required_fields = array('customer_name','contact_name','phone_number', 'email');
            foreach($required_fields as $fieldname){ if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {$errors[] = $fieldname; }}

            // check if the length is correct
            foreach($required_fields as $fieldname) {if(strlen(trim(mysql_prep($_POST[$fieldname]))) > 30) { $errors[] = $fieldname; }}
            
             if(empty($errors))
	    {            
                $customer = new Customer();
                $customer_name = mysql_prep($_POST['customer_name']);
                $contact_name = mysql_prep($_POST['contact_name']);
                $phone_number = mysql_prep($_POST['phone_number']);
                $email = mysql_prep($_POST['email']);
               
                $customer->setCustomerName($customer_name);
                $customer->setContactName($contact_name);
                $customer->setCustomerPhone($phone_number);
                $customer->setCustomerEmail($email);
                
                if(intval($_GET['cust']) != 0)// update supplier
                {
                    $customer_id = mysql_prep($_GET['cust']);
                    $customer->update($customer_id);
                }
                else
                {                    
                     $customer->create();// create supplier
                }
            }
            else
            {
                session_start();                
                $_SESSION['errors'] = $errors;
                redirect_to("CustomerCreateView.php");
            }    
                 
	} // end if(iseet($_POST['submit']))

	 
?>