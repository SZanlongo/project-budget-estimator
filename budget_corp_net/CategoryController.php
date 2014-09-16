<?php require_once ("Category.Class.php"); ?>
<?php
    if (!isset($_POST['submit']) && intval($_GET['product_categ']) != 0)
    {
        $category = new Category();
        $category_id = mysql_prep($_GET['product_categ']);
        $category->delete($category_id);
        
    } else if (isset($_POST['submit'])) {// test if the form have been submited
        $errors = array();
        // Form validation
        if (!isset($_POST['description']) || empty($_POST['description'])) { $errors[] = "description";}
        // check if the length is correct
        if (strlen(trim(mysql_prep($_POST['description']))) > 30) { $errors[] = "description"; }

        if (empty($errors))
        {   
            $category = new Category();
            $description = mysql_prep($_POST['description']);

            $category->setCategoryDescription($description);

            if (intval($_GET['product_categ']) != 0) {// update category
                
                $category_id = mysql_prep($_GET['product_categ']);
                $category->update($category_id);
           
            } else {
                $category->create(); // create category
            }
        } else {
            session_start();
            $_SESSION['errors'] = $errors;
            redirect_to("CategoryCreateView.php");
        }
    } // end if(iseet($_POST['submit']))
?>