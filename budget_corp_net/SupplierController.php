<?php require_once ("Supplier.Class.php"); ?>
<?php 
    if(!isset($_POST['submit'])&& intval($_GET['suppl']) != 0)
    {
        $supplier = new Supplier();
        $supplier_id = mysql_prep($_GET['suppl']);
        $supplier->delete($supplier_id);            
    }
    else if(isset($_POST['rank']))
{
     $supplier = new Supplier();
     $rank = $_POST['rank'];
     $supplierId = $_GET['suppl'];
     $supplier->rankSupplier($supplierId, $rank);
     
     header("SupplierCreateView.php");

     
}

    else if(isset($_POST['submit']))// test if the form have been submited
    {
        $errors = array();
        $required_fields = array('supplier_name','contact_name','phone_number', 'email');
        foreach($required_fields as $fieldname) {if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {$errors[] = $fieldname; }}

        // check if the length is correct
        foreach($required_fields as $fieldname){if(strlen(trim(mysql_prep($_POST[$fieldname]))) > 30) { $errors[] = $fieldname; }}		 

            if(empty($errors))
        {            
            $supplier = new Supplier();
            $supplier_name = mysql_prep($_POST['supplier_name']);
            $contact_name = mysql_prep($_POST['contact_name']);
            $phone_number = mysql_prep($_POST['phone_number']);
            $email = mysql_prep($_POST['email']);

            $supplier->setSupplierName($supplier_name);
            $supplier->setContactName($contact_name);
            $supplier->setSupplierPhone($phone_number);
            $supplier->setSupplierEmail($email);

            if(intval($_GET['suppl']) != 0)// update supplier
            {
                $supplier_id = mysql_prep($_GET['suppl']);
                $supplier->update($supplier_id);
            }
            else
            {   
                 $supplier->create();// create supplier
            }
        }
        else
        {
            session_start();                
            $_SESSION['errors'] = $errors;
            redirect_to("SupplierCreateView.php");
        }    

    } // end if(iseet($_POST['submit']))	 
?>