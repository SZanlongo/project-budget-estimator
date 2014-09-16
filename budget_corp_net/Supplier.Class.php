<?php require_once("includes/connection.php"); ?> 
<?php require_once("includes/functions.php"); ?>

<?php
 class Supplier
{
    private $supplierID; 
    private $supplierName;
    private $contactName;
    private $supplierPhone;
    private $supplierEmail;
    /**
     *Default constructor 
     */          
    public function Supplier(){} 
       
    /**
     * Sets the global variable $supplierName
     * @param type $sname String
     */    
    public function setSupplierName($sname) { $this->supplierName = $sname; } 
    
      /**
     * Sets the global variable $contactName
     * @param type $sname String
     */ 
    public function setContactName($cname) { $this->contactName = $cname; } 
    
     /**
     * Sets the global variable $supplierPhone
     * @param type $sname String
     */ 
    public function setSupplierPhone($phone) { $this->supplierPhone = $phone; }
    
     /**
     * Sets the global variable $supplierEmail
     * @param type $sname String
     */ 
    public function setSupplierEmail($email) { $this->supplierEmail = $email; }
    
    
    /**
     * Returns the global variable $supplierID
     * @return type integer
     */
    public function getSupplierID() { return $this->supplierID; }   
    
     /**
     * Returns the global variable $supplierName
     * @return type String
     */
    public function getSupplierName() { return $this->supplierName; }  
    
     /**
     * Returns the global variable $contactName
     * @return type String
     */
    public function getContactName() { return $this->contactName; }  
    
     /**
     * Returns the global variable $supplierPhone
     * @return type String
     */
    public function getSupplierPhone() { return $this->supplierPhone; }   
    
     /**
     * Returns the global variable $supplierEmail
     * @return type String
     */
    public function getSupplierEmail() { return $this->supplierEmail; }
    
    /**
     * Creates a new Supplier and insert it into the Supplier table
     * in the database
     * @global type $connection 
     */
    public function create()
    {
        global $connection;        
        $sname = $this->getSupplierName();
        $cname = $this->getContactName();
        $phone = $this->getSupplierPhone();
        $email = $this->getSupplierEmail();
                    
        $query = "INSERT INTO supplier 
        (supplier_name, contact_name, phone_number, email)
                    VALUES('{$sname}','{$cname}','{$phone}','{$email}')";
        $result = mysql_query($query, $connection);
        confirm_query($result);
        redirect_to("SupplierCreateView.php");   
               
    } // end create()
    

    /**
     * Updates an existing supplier in the Supplier table 
     * in the database. 
     * @global type $connection. Called in SupplierController.php
     * @param type $supplier_id integer
     */
    public function update($supplier_id)
    {   
        global $connection;
        $sname = $this->getSupplierName();
        $cname = $this->getContactName();
        $phone = $this->getSupplierPhone();
        $email = $this->getSupplierEmail();
        
        $query = "UPDATE supplier
        SET supplier_name = '{$sname}', contact_name = '{$cname}',
                  phone_number = '{$phone}',  email = '{$email}'
                  WHERE Supplier_id = {$supplier_id}";
        $result = mysql_query($query, $connection);
        confirm_query($result);
        redirect_to("SupplierCreateView.php");	
    }// end update($supplier_id)
    
  
    /**
     * Deletes an existing supplier in the Supplier table 
     * in the database. 
     * @global type $connection. Called in SupplierController.php
     * @param type $supplier_id integer
     */
    public function delete($supplier_id)
    {
        global $connection;
        $query = "DELETE FROM supplier WHERE supplier_id = {$supplier_id}";
        $result = mysql_query($query, $connection);
        confirm_query($result);
         redirect_to("SupplierCreateView.php");
    }// end function delete($Supplier_id)
    
    
     /**
     * Retrieves all existing suppliers from the Supplier table 
     * in the database. 
     * @global type $connection. Called in SupplierController.php
     * @return type Resultset
     */

    public function get_all_supplier() 
    {
        global $connection;
        $query = "SELECT * FROM supplier  ORDER BY supplier_name ASC";
        $supplier_set = mysql_query($query, $connection);
        confirm_query($supplier_set);
        return  $supplier_set;     
    } // end get_all_supplier()
    
     /**
     * Retrieves a supplier record by its id from the Supplier table 
     * in the database. 
     * @global type $connection. Called in SupplierController.php
     * @param type $supplier_id integer
     * @return type String
     * or @return null  
     */
    public function get_supplier_by_id($supplier_id)
    {
        global $connection;
        $query = "SELECT * FROM supplier
        WHERE supplier_id= {$supplier_id}LIMIT 1";
        $result_set = mysql_query($query, $connection);
        confirm_query($result_set);
        if($supplier = mysql_fetch_array($result_set))
            { return $supplier; } 
            else { return NULL; }
    } // end get_supplier_by_id($supplier_id)
    
 
     /**
     * Retrieves an existing supplier id from the Supplier table 
     * in the database. 
     * @global type $connection. Called in SupplierController.php
     * @param type $supplier_id integer
     * @return type integer
     */
    public function get_supplier_id($supplier_name)
    {
        global $connection;
        $query = "SELECT supplier_id FROM supplier
        WHERE supplier_name = \"{$supplier_name}\" LIMIT 1";
        $supplier_id = mysql_query($query, $connection);
        confirm_query($supplier_id);
        $array = mysql_fetch_array($supplier_id);
        $id = $array[0];
        return $id;		
    } // end get_supplier_id($supplier_name)
    
    // this function gets supplier from the URL. Called in SupplierEditView
    
    /**
     * Set a supplier to a specific supplier from the database by its id
     * @global type $sel_supplier 
     */
    public function SelectedSupplier(){
        global $sel_supplier;
        if(isset($_GET['suppl']))
            {$sel_supplier = get_supplier_by_id($_GET['suppl']);}            
    }// end SelectedSupplier()
      
    // print all the suppliers objects in the database. Called in CategoryCreateView.php
    /**
     * Creates a result set of all suppliers from the supplier table
     * from the database 
     */
    public function getSupplierList(){   
        $table = "supplier"; display_db_table($table, TRUE, "border='1'");
    } // end getSupplierList()

    /**
     * Ranks a supplier by category and updates it in the database
     * @global type $connection
     * @param type $id
     * @param type $rank 
     */
   public function rankSupplier($id, $rank)
   {
        global $connection;

        $query1 = "SELECT ratings FROM supplier WHERE supplier_id={$id}";
        $oRatings = mysql_query($query1, $connection) or die(mysql_error());
        $row1 = mysql_fetch_row($oRatings);

        $query2 = "SELECT rank FROM supplier WHERE supplier_id={$id}";
        $oRank = mysql_query($query2, $connection) or die(mysql_error());
        $row2 = mysql_fetch_row($oRank);

        $nRank = (($row2[0] * $row1[0]) + $rank) / ($row1[0] + 1);
        $row1[0] += 1;

        $query4 = "UPDATE supplier SET rank='{$nRank}' WHERE supplier_id={$id}";
        $result2 = mysql_query($query4, $connection);

        $query5 = "UPDATE supplier SET ratings='{$row1[0]}' 
        WHERE supplier_id={$id}";
        $result1 = mysql_query($query5, $connection) or die(mysql_error());
    
    }
 
    
    
    
}

?>    
