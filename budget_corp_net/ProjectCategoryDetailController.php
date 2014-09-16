<?php require_once ("ProjectCategoryDetail.Class.php"); ?>
<?php 
	if(intval($_GET['project_category_id']) == 0)// test if it is a valid project_id
	{ redirect_to("content.php"); }
	if(isset($_POST['submit']))// test if the form have been submited
	{
		$errors = array();
                // Form validation
		 //check $required_fields
		 $required_fields = array('item', 'quantity');
		 foreach($required_fields as $fieldname) { if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {$errors[] = $fieldname; }}		 ///if('quantity'<=0){$errors[] = 'quantity';}	// quantity have to be >= 0
		  
		 if(empty($errors))
                {
                    //perform update
                    $projectCategoryDetail = new ProjectCategoryDetail();
                    $projCateg_id = mysql_prep($_GET['project_category_id']);		 
                    $item = mysql_prep($_POST['item']);
                    $product_id = get_product_id($item); // get product id
                    $quantity = mysql_prep($_POST['quantity']);	

                    $projectCategoryDetail->setProjCategID($projCateg_id);
                    $projectCategoryDetail->setProductID($product_id);
                    $projectCategoryDetail->setQuantity($quantity);

                    $projectCategoryDetail->create();// create detail

                }
                else
                {
                    session_start();                
                    $_SESSION['errors'] = $errors;
                    redirect_to("ProjectCategoryDetailCreateView.php");  

                }  
	} // end if(iseet($_POST['submit']))
?>



        