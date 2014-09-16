<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
class Category
{
    // instance variables
    private $categoryID;
    private $categoryDescription;

    
    /**
     * Default constructor 
     */
    public function Category() {}
    
    
    /**
     * Sets  the global variable $categoryDescription
     * @param type $cname String 
     */
    public function setCategoryDescription($cname) { $this->categoryDescription = $cname; }
    
    
    /**
     * Return the global variable $categoryID
     * @return type integer 
     */
    public function getCategoryID() { return $this->categoryID;}
    
        
    /**
     * Return the global variable $categoryDescription
     * @return type integer 
     */
    public function getCategoryDescription() { return $this->categoryDescription;}

    /**
     * * @global type $connection
     * This method creates a new category for a specific project.
     * It connects to the database through the $connection imported
     * from the connection.php class and insert into the category 
     * table the description of the new category.
     */
    public function create()
    {
        global $connection;
        $description = $this->getCategoryDescription();
        $query = "INSERT INTO category (description)VALUES('{$description}')";
        $result = mysql_query($query, $connection);
        confirm_query($result);
        redirect_to("CategoryCreateView.php");
    }// end create()

    /**
     *
     * @global type $connection
     * @param type $category_id 
     * This method updates a category of a project.
     * It will be used by the CategoryController.php
     * class.
     */
    public function update($category_id)
    {
        global $connection;
        $cname = $this->getCategoryDescription();// get category destription
        $query = "UPDATE category SET description = '{$cname}' WHERE category_id = {$category_id}";
        $result = mysql_query($query, $connection);
        confirm_query($result);
        redirect_to("CategoryCreateView.php");
    }// end update($category_id)

    /**
     *
     * @global type $connection
     * @param type $category_id 
     * This function delete the category object. 
     * It is called in CategoryController.php
     */
    public function delete($category_id)
    {
        global $connection;
        $query = "DELETE FROM category WHERE category_id = {$category_id} ";
        $result = mysql_query($query, $connection);
        confirm_query($result);
        redirect_to("CategoryCreateView.php");     
    }// delete($category_id)
    
    
    /**
     *
     * @global type $connection
     * @return type 
     * This function retrieves the category objects in the database. 
     * It is called in CategoryCreateView.php
     */
    public function get_all_category()
    {
        global $connection;
        $query = "SELECT *  FROM category ORDER BY description ASC";
	$category_set = mysql_query($query, $connection);
	confirm_query($category_set);
        return  $category_set;     
    } // end get_all_category()

    
    
    /**
     *
     * @global type $connection
     * @param type $category_name
     * This function retreives the ID of an specific category.
     * Called in ProjectCategoryController.php and ProductController.php
     * @return type int 
     */
    public function get_category_id($category_name) 
    {
        global $connection;
        $query = "SELECT category_id FROM category WHERE description = \"{$category_name}\" LIMIT 1";
        $category_id = mysql_query($query, $connection);
        confirm_query($category_id);
        $array = mysql_fetch_array($category_id);
        $id = $array[0];// get the id
        return $id;	  
    } // end get_category_id($category_name)

    
    /**
     *
     * @global type $connection
     * @param type $category_id
     * This function retrieves the category description by Id. 
     * Called in in find_selected()
     * @return null 
     */
    public function get_category_by_id($category_id)
    {
        global $connection;
        $query = "SELECT * FROM category WHERE category_id = \"{$category_id}\" LIMIT 1";
        $result_set = mysql_query($query, $connection);
        confirm_query($result_set);        
        if($category = mysql_fetch_array($result_set)) {return $category;} else { return NULL; }
    } // end get_category_by_id($category_id)

 
    /**
     * 
     * Print all the category objects in the database. 
     * Called in CategoryCreateView.php.
     */
    public function getCategoryList(){        
        $table = "category";  display_db_table($table, TRUE, "border='1'");
    }// end getCategoryList()
}
?>