<?php require_once("includes/connection.php"); ?> 
<?php require_once("includes/functions.php"); ?>

<?php
class Employee
{
    private $employeeID; 
    private $employeeName;
    private $employeePhone;
    private $employeeEmail;
     
    /**
     * Default constructor
     */
    public function Employee(){} 
       
 
    /**
     * Sets the global variable $projectID
     * @param type $id integer 
     */
    public function setProjectID($id) { $this->projectID = $id; }     
    
    
    /**
     * Sets the global variable $employeeName
     * @param type $id String 
     */
    public function setEmployeeName($name) { $this->employeeName = $name; }  
    
    
    /**
     * Sets the global variable $employeePhone
     * @param type $id String 
     */
    public function setEmployeePhone($phone) { $this->employeePhone = $phone; }
    
    
    /**
     * Sets the global variable $employeeEmail
     * @param type $id String 
     */
    public function setEmployeeEmail($email) { $this->employeeEmail = $email; }
    
    /**
     * Returns the global variable $employeeID
     * @return type integer
     */
    public function getEmployeeID() { return $this->employeeID; }
    
    /**
     * Returns the global variable $employeeName
     * @return type String
     */
    public function getEmployeeName() { return $this->employeeName; } 
    
    /**
     * Returns the global variable $employeePhone
     * @return type String
     */
    public function getEmployeePhone() { return $this->employeePhone; } 
    
    /**
     * Returns the global variable $employeeEmail
     * @return type String
     */
    public function getEmployeeEmail() { return $this->employeeEmail; }
    
    /**
     * Creates a new Employee object and inserts in the 
     * Employee table in the databae. Called in EmployeeController.php
     * @global type $connection 
     */
    public function create()
    {
        global $connection;        
        $eName = $this->getEmployeeName();
        $ePhone = $this->getEmployeePhone();
        $eEmail = $this->getEmployeeEmail();
                    
        $query = "INSERT INTO employee (employee_name, phone_number, email)
                    VALUES ('{$eName}','{$ePhone}','{$eEmail}')";
        $result = mysql_query($query, $connection);
        confirm_query($result);               
        redirect_to("EmployeeCreateView.php");           
    } // end create($selected)
    
    // this function update the employee. Called in EmployeeController.php
    
     /**
     * Updates an existing Employee object from the 
     * Employee table in the databae. Called in EmployeeController.php
     * @global type $connection 
     */
    public function update($employee_id)
    {
        global $connection;        
        $eName = $this->getEmployeeName();
        $ePhone = $this->getEmployeePhone();
        $eEmail = $this->getEmployeeEmail();
            
        $query = "UPDATE employee
                SET employee_name = '{$eName}', phone_number = '{$ePhone}', email = '{$eEmail}'
                WHERE employee_id = {$employee_id}";
        $result = mysql_query($query, $connection);	
        confirm_query($result);   
        redirect_to("EmployeeCreateView.php");	
    }// end update($employee_id)
    
      /**
     * Delete an existing Employee object from the 
     * Employee table in the databae. Called in EmployeeController.php
     * @global type $connection 
     */
    public function delete($employee_id) 
    {
        global $connection;         
        $query = "DELETE FROM employee WHERE employee_id = {$employee_id}";
        $result = mysql_query($query, $connection);
        confirm_query($result);        
        redirect_to("EmployeeCreateView.php");
    }// end delete($employee_id) 

    // this function gets all the employee objects in the database. Called in EmployeeCreateView.php
    
     /**
     * Retreives all existing Employee objects from the 
     * Employee table in the databae. Called in EmployeeController.php
     * @global type $connection 
     */
     public function get_all_employee() 
    {
        global $connection;
        $query = "SELECT * FROM employee ORDER BY employee_name ASC";
        $project_set = mysql_query($query, $connection);
        confirm_query($project_set);
        return  $project_set;     
    } // end get_all_employee()
	
    
     /**
     * Get the id of an existing Employee object from the 
     * Employee table in the databae. Called in EmployeeController.php
     * @global type $connection 
     */
    public function get_employee_id($employee_name)
    {
        global $connection;
        $query = "SELECT employee_id FROM employee
                WHERE employee_name = \"{$employee_name}\" LIMIT 1";
        $employee_id = mysql_query($query, $connection);
        confirm_query($employee_id);
        $array = mysql_fetch_array($employee_id);
        $id = $array[0];
        return $id;		
    } // end get_employee_id($employee_name)

     /**
     * Get an existing Employee object by its id from the 
     * Employee table in the databae. Called in EmployeeController.php
     * @global type $connection 
      * @param type $employee_id integer
      * @return type String
      * or if the table does not contain the object 
      * @return null
     */
    public function get_employee_by_id($employee_id)
    {
        global $connection;
        $query = "SELECT * FROM employee WHERE employee_id= \"{$employee_id}\"LIMIT 1";
        $result_set = mysql_query($query, $connection);
        confirm_query($result_set);
        if($employee = mysql_fetch_array($result_set))
        { return $employee; }
        else { return NULL; }
    } // end get_employee_by_id($employee_id)
	
  
     /**
     * Get a list of all existing Employee objects from the 
     * Employee table in the databae. Called in EmployeeController.php
     * @global type $connection 
     */
    public function getEmployeeList()
    {   
        $table = "employee";  display_db_table($table, TRUE, "border='1'");
    } // end getEmployeeList()
    
    
	
   
    
}

?>
