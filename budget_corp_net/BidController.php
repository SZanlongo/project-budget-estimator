<?php require_once 'Bid.Class.php';?>
<?php
    $value = intval($_GET['proj_categ_detail']);
    if($value == 0)// test if it is a valid project_id
    { /*redirect_to("CreateProjectCategoryDeteailView.php"); */}
    if(isset($_POST['submit']))// test if the form have been submited
    {
        $errors = array();
    // Form validation		 
        $required_fields = array('supplier_name', 'bid');//check $required_fields
        foreach($required_fields as $fieldname) { if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) { $errors[] = $fieldname; } }		 

        $fields_with_lengths = array('supplier_name' => 30);	 // check if the length is correct 
        foreach($fields_with_lengths as $fieldname => $maxlength){	 if(strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength) { $errors[] = $fieldname; } }	 

        $greater_than_cero = array('bid');//check if bid is positive
        foreach($greater_than_cero as $fieldname) { if((mysql_prep($_POST[$fieldname])) <= 0){ $errors[] = $fieldname; } }// end check positive

        if(empty($errors))
        {          
            $bid = new Bid();
            $project_category_detail_id = mysql_prep($_GET['proj_categ_detail']);
            $supplier_name = mysql_prep($_POST['supplier_name']);
            $supplier_id = get_supplier_id($supplier_name);	// get supplier id
            $bidOn = mysql_prep($_POST['bid']);

            $bid->setBid($bidOn);
            $bid->setSuplierID($supplier_id);
            $bid->setprojectCategoryDetailID($project_category_detail_id);

            $bid->create(); 
        }
        else
        {
            session_start();                
            $_SESSION['errors'] = $errors;
            redirect_to("ProductCreateView.php");
        }    
    } // end if(iseet($_POST['submit']))

?>
