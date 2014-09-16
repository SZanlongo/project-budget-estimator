<?php require_once ("Product.Class.php"); ?>
<?php 
	if(!isset($_POST['submit'])&& intval($_GET['prod']) != 0)
        {
            $product = new product();
            
            $product_id = mysql_prep($_GET['prod']);
            $product->setProductID($product_id);
            $product->delete();            
        }
        else if(isset($_POST['submit']))
        {			
                $errors = array();
                $required_fields = array('item', 'description','description');
                foreach($required_fields as $fieldname){ if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) { 	$errors[] = $fieldname; }}	 
            
             if(empty($errors))
            {            
                $product = new Product();
                $item = mysql_prep($_POST['item']);			
                $description = mysql_prep($_POST['description']);
                $category_description = mysql_prep($_POST['description']); 
                $category_id = get_category_id($category_description);	// get product id
                $product_id = mysql_prep($_GET['prod']);

                $product->setItem($item );
                $product->setDescription($description);
                $product->setCategoryId($category_id);
                $product->setProductID($product_id);
                
                if(intval($_GET['prod']) != 0)
                {   
                    $product_id = mysql_prep($_GET['prod']);
                    $product->update($product_id);// update product
                }
                else
                {   
                     $product->create();// create product
                }
        }
        else
        {
            session_start();                
            $_SESSION['errors'] = $errors;
            redirect_to("ProductCreateView.php");
        }    
                 
    } // end if(iseet($_POST['submit']))
?>