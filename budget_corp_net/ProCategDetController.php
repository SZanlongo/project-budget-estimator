<?php require_once ("Create_project_category_detail.Class.php"); ?>
<?php 
	if(!isset($_POST['submit'])&& intval($_GET['proj_categ_detail']) != 0)
        {
            $create_project_category_detail = new Create_project_category_detail();
            $create_project_category_detail_id = mysql_prep($_GET['proj_categ_detail']);
            $create_project_category_detail->delete($create_project_category_detail_id);            
        }
        else if(isset($_POST['submit']))// test if the form have been submited
	{
            $errors = array();
         // Form validation
            //check $required_fields
            $required_fields = array('item', 'quantity');
            foreach($required_fields as $fieldname)
            {
                    if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname]))
                    { 	$errors[] = $fieldname; }
            }// end check $required_fields

		 ///if('quantity'<=0){$errors[] = 'quantity';}	// quantity have to be >= 0
		   
            
             if(empty($errors))
	    {            
                $create_project_category_detail = new Create_project_category_detail();                
                $project_category_id = mysql_prep($_GET['project_category_id']);		 
                $item = mysql_prep($_POST['item']);
                $product_id = get_product_id($item); // get product id
                $quantity = mysql_prep($_POST['quantity']);	
               
                $create_project_category_detail->setProject_category_id($project_category_id);
                $create_project_category_detail->setProduct_id($product_id);
                $create_project_category_detail->setQuantity($quantity);
               
                if(intval($_GET['proj_categ_detail']) != 0)// update supplier
                {
                    $proj_categ_detail_id = mysql_prep($_GET['proj_categ_detail']);
                    $create_project_category_detail->update($proj_categ_detail_id);
                }
                else
                {
                    
                     $proj_categ_detail_id->create();// create supplier
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