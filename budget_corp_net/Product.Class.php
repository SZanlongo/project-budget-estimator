<?php require_once("includes/connection.php"); ?> 
<?php require_once("includes/functions.php"); ?>
<?php
class Product
{	
    private $productID;
    private $item;
    private $description;
    private $categoryID;
    
    
    /**
     * Default constructor 
     */
    public function Product(){}
       
    /**
     * Sets the global variable $productID
     * @param type $productId integer
     */      
    public function setProductID($productId) { $this->productID = $productId; }
    
     /**
     * Sets the global variable $item
     * @param type $productId integer 
     */ 
    public function setItem($item) { $this->item = $item; }
    
     /**
     * Sets the global variable $description
     * @param type String 
     */ 
    public function setDescription($description) { $this->description = $description; } 
    
     /**
     * Sets the global variable $categoryID
     * @param type $categoryID integer
     */ 
    public function setCategoryID($categoryID) {$this->categoryID = $categoryID;}    
    
    /**
     * Return the global variable $productId
     * @return type integer
     */
    public function getProductId() { return $this->productId; }   
    
        
    /**
     * Return the global variable $item
     * @return type String
     */
    public function getItem() { return $this->item; }
    
        
    /**
     * Return the global variable $description0
     * @return type String
     */
    public function getDescription() { return $this->description; }
    
        
    /**
     * Return the global variable $categoryID
     * @return type integer
     */
    public function getCategoryID() {return $this->categoryID;}
    
    /**
     * Create a new Product object and insert it into the Product table
     * in the database. Called in ProductController.php
     * @global type $connection 
     */
    public function create()
    {
        global $connection;
        $item = $this->getItem();
        $description = $this->getDescription();
        $categoryID = $this ->getCategoryID();
        $query = "INSERT INTO product (item, description, category_id)
                    VALUES ('{$item}','{$description}',{$categoryID})";
        $result = mysql_query($query, $connection);
        confirm_query($result);
        redirect_to("ProductCreateView.php");
    } // end create()
    
     /**
     * Update an existing Product object from the Product table
     * in the database. Called in ProductController.php
     * @global type $connection 
     * @param type $productId integer 
     */
    public function update($productId)
    {   
        global $connection;
       	$item = $this->getItem();
        $description = $this->getDescription();
        $category_id = $this ->getCategoryID();       
        
        $query = "UPDATE product
                 SET item = '{$item}', description = '{$description}', category_id = '{$category_id}'
                 WHERE product_id = {$productId}";
        $result = mysql_query($query, $connection);
        confirm_query($result);
        redirect_to("ProductCreateView.php");	
    }// end update($productId)
    
    // this function delete the product object. Called in ProductController.php
    
       /**
     * Delete an existing Product object from the Product table
     * in the database. Called in ProductController.php
     * @global type $connection 
     * @param type $productId integer 
     */
    public function delete($product_id)
    {
        global $connection;
        $query = "DELETE FROM product WHERE product_id = {$product_id}";
        $result = mysql_query($query, $connection);
        confirm_query($result);  
        redirect_to("ProductCreateView.php");
    }// end function delete($Supplier_id)
    
    // this function gets all the product objects in the database. Called in ProductCreateView.php
       /**
     * Retrieve all existing Product records from the Product table
     * in the database. Called in ProductController.php
     * @global type $connection 
     * @param type $product_id integer 
     */
    function get_all_product()
    {
        global $connection;
        $query = "SELECT * FROM product ORDER BY description ASC";
        $product_set = mysql_query($query, $connection);
        confirm_query($product_set);
        return  $product_set;     
    }// end get_all_product()
	
    // this function gets the ID of an specific product. Called in ProjCategoryDetailController.php
    
     /**
     * Retrieves a product id of an existing Product object from
     *  the Product table
     * in the database. Called in ProductController.php
     * @global type $connection 
     * @param type $item String 
     */
    function get_product_id($item)
    {
        global $connection;
        $query = "SELECT product_id FROM product WHERE item = \"{$item}\" LIMIT 1";
        $product_id = mysql_query($query, $connection);
        confirm_query($product_id);
        $array = mysql_fetch_array($product_id);
        $id = $array[0];
        return $id;	  
    } // end get_product_id($item)
	
    // this function gets the product by Id. Called in in find_selected()
    
     /**
     * Retrieves existing Product object record from
     *  the Product table in the database. 
     * Called in ProductController.php
     * @global type $connection 
     * @param type $product_id integer 
     */
    function get_product_by_id($product_id) 
    {
        global $connection;
        $query = "SELECT * FROM product WHERE product_id= \"{$product_id}\" LIMIT 1";
        $result_set = mysql_query($query, $connection);
        confirm_query($result_set);
        if($product = mysql_fetch_array($result_set)) 
        { return $product; } else { return NULL; }
    } // end get_product_by_id($product_id)
		
    // print all the product objects in the database. Called in ProductCreateView.php
    
     /**
     * Retrieves  a list of all existing Product object records from
     *  the Product table in the database. 
     * Called in ProductController.php
     * @global type $connection 
     * @param type $product_id integer 
     */
    public function getProductList()
    {    
        $table = "product"; display_db_table($table, TRUE, "border='1'");
    } // end getProductList()
    
}
?>    
