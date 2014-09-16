<?php require_once("includes/connection.php"); ?> 
<?php require_once("includes/functions.php"); ?>
<?php
class Customer
{
    private $customerID; 
    private $customerName;
    private $contactName;
    private $customerPhone;
    private $customerEmail;
    
    
    /**
     * Default constructor
     */
    public function Customer(){} 
       
    /**
     * Sets the global variable $customerName
     * @param type $sname String 
     */      
    public function setCustomerName($sname) { $this->customerName = $sname; } 
    
    /**
     * Sets the global variable $contactName
     * @param type $sname String 
     */ 
    public function setContactName($cname) { $this->contactName = $cname; }
    
    /**
     * Sets the global variable $customerPhone
     * @param type $sname String 
     */ 
    public function setCustomerPhone($phone) { $this->customerPhone = $phone; }
    
    /**
     * Sets the global variable $customerEmail
     * @param type $sname String 
     */ 
    public function setCustomerEmail($email) { $this->customerEmail = $email; }
    
    /**
     * Returns the global variable $customerID
     * @return type integer
     */
    public function getCustomerID() { return $this->customerID; }  
    
   /**
     * Returns the global variable $customerName
     * @return type String
     */  
    public function getCustomerName() { return $this->customerName; }  
    
     
   /**
     * Returns the global variable $contactName
     * @return type String
     */ 
    public function getContactName() { return $this->contactName; }  
    
    
   /**
     * Returns the global variable $customerPhone
     * @return type String
     */ 
    public function getCustomerPhone() { return $this->customerPhone; } 
    
      
   /**
     * Returns the global variable $customerEmail
     * @return type String
     */ 
    public function getCustomerEmail() { return $this->customerEmail; }
    
    /**
     *
     * @global type $connection 
     * It uses  the global $connection
     * Creates a new Customer in the database 
     * It creates a new Customer and inserts it into the 
     * Customer table in the database
     */
    public function create() 
    {
        global $connection;        
        $sname = $this->getCustomerName();
        $cname = $this->getContactName();
        $phone = $this->getCustomerPhone();
        $email = $this->getCustomerEmail();
                    
        $query = "INSERT INTO customer (customer_name, contact_name, phone_number, email)
                    VALUES ('{$sname}','{$cname}','{$phone}','{$email}')";
        $result = mysql_query($query, $connection);
        confirm_query($result);
        redirect_to("CustomerCreateView.php");               
    } // end create()
    
     /**
     *
     * @global type $connection 
     * It uses  the global $connection
     * Updates a Customer in the 
     * Customer table in the database
     * Called in CustomerController.php
     * 
     */
    public function update($customer_id)
    {   
        global $connection;
        $sname = $this->getCustomerName();
        $cname = $this->getContactName();
        $phone = $this->getCustomerPhone();
        $email = $this->getCustomerEmail();
        
        $query = "UPDATE customer 
                   SET customer_name = '{$sname}', contact_name = '{$cname}', phone_number = '{$phone}', email = '{$email}'
                   WHERE customer_id = {$customer_id}";        
        $result = mysql_query($query, $connection);
        confirm_query($result);
        redirect_to("CustomerCreateView.php");	
    }// end update($customer_id)
    
     /**
     *
     * @global type $connection 
     * It uses the global $connection.
     * Deletes a Customer in the 
     * Customer table in the database
     * Called in CustomerController.php
     * 
     */
    public function delete($customer_id)
    {
        global $connection;       
        $query = "DELETE FROM customer WHERE customer_id = {$customer_id}";
        $result = mysql_query($query, $connection);
        confirm_query($result);  
        redirect_to("CustomerCreateView.php");
    }// end function delete($customer_id)
    
      /**
     *
     * @global type $connection 
     * It uses the global $connection
     * This function gets all the customers objects in the database.
     * Called in CustomerController.php
     * 
     */
    public function get_all_customer()
    {
        global $connection;
        $query = "SELECT * FROM customer  ORDER BY customer_name ASC";
        $suctomer_set = mysql_query($query, $connection);
        confirm_query($suctomer_set);
        return  $suctomer_set;     
    } // end get_all_customer()
	
    
     /**
     *
     * @global type $connection 
     * It uses the global $connection
     * This function retreives a customer by ID 
     * from in the database.
     * Called in CustomerController.php
     * 
     */
    public function get_customer_by_id($customer_id)
    {
        global $connection;
        $query = "SELECT * ";
        $query .= "FROM customer ";
        $query .= "WHERE customer_id=" . $customer_id ." ";
        $query .= "LIMIT 1"; // Limit the result to only one
        $result_set = mysql_query($query, $connection);
        confirm_query($result_set);
        if($customer = mysql_fetch_array($result_set)){ return $customer; } else { return NULL; }
    } // end get_customer_by_id($customer_id)	
	
    
     /**
     *
     * @global type $connection 
     * It uses the global $connection
     * This function gets a customer ID from the database.
     * Called in ProjectController.php
     * 
     */
    public function get_customer_id($customer_name)
    {
        global $connection;
        $query = "SELECT customer_id FROM customer WHERE customer_name = \"{$customer_name}\" LIMIT 1";
        $customer_id = mysql_query($query, $connection);
        confirm_query($customer_id);
        $array = mysql_fetch_array($customer_id);
        $id = $array[0];
        return $id;	  
    } // end get_customer_id($customer_name)
    
          
     /**
     *
     * @global type $connection 
     * It uses the global $connection
     * This function retrieves the list of 
     * all customers from the database.
     * Called in CustomerController.php
     * 
     */
    public function getCustomerList()
    {        
        $table = "customer"; display_db_table($table, TRUE, "border='1'");        
    } // end getCustomerList()
    
}

?>    
