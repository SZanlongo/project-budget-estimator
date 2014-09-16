<?php require_once("includes/connection.php"); ?> 
<?php require_once("includes/functions.php"); ?>
<?php
class Project
{
    private $projectID; 
    private $employeeID;
    private $customerID;
    private $startDay;
    private $dueDay;
    private $description;
    
    /**
     *Default constructor 
     */
    public function Project(){} 
    
    /**
     * Set global variable $projectID 
     * @param type $pid (integer)
     */
    public function setProjectID($pid) { $this->projectID = $pid; }    
    
    
     /**
     * Set global variable $employeeID 
     * @param type $pid (integer)
     */
    public function setEmployeeID($eid) { $this->employeeID = $eid; }  
    
     /**
     * Set global variable $customerID 
     * @param type $cid (integer)
     */
    public function setCustomerID($cid) { $this->customerID = $cid; }
    
     /**
     * Set global variable $startDay 
     * @param type $startDay (Date)
     */
    public function setStartDay($startday) { $this->startDay = $startday; }
    
     /**
     * Set global variable $dueDay 
     * @param type $dueDay (Date)
     */
    public function setDueDay($dueday) { $this->dueDay = $dueday; }
    
     /**
     * Set global variable $description 
     * @param type $desc (String)
     */
    public function setDescription($desc) { $this->description = $desc; }
    
    /**
     * Returns the global variable $projectID
     * @return type integer 
     */
    public function getProjectID() { return $this->projectID; } 
    
     /**
     * Returns the global variable $employeeID
     * @return type integer 
     */
    public function getEmployeeID() { return $this->employeeID; }
    
     /**
     * Returns the global variable $customerID
     * @return type integer 
     */
    public function getCustomerID() { return $this->customerID; }
    
     /**
     * Returns the global variable $startDay
     * @return type Date 
     */
    public function getStartDay() { return $this->startDay; }
    
    /**
     * Returns the global variable $dueDay
     * @return type Date 
     */  
    public function getDueDay() { return $this->dueDay; }    
    
      /**
     * Returns the global variable $description
     * @return type String 
     */
    public function getDescription() { return $this->description; }    

    
    /**
     * Creates a new project object and inserts in the Project table in the
     * databae. Called in ProjectController.php
     * @global type $connection 
     */
    public function create()
    {
        global $connection;        
       
        $eid = $this->getEmployeeID();
        $cid = $this->getCustomerID();
        $startday = $this->getStartDay();
	$dueday = $this->getDueDay();
	$desc = $this->getDescription();
                    
        $query = "INSERT INTO project 
		    (employee_id, customer_id, start_day, due_day, description)
		    VALUES ( {$eid}, {$cid}, '{$startday}','{$dueday}', '{$desc}')";		    
        $result = mysql_query($query, $connection);
        confirm_query($result);
        redirect_to("ProjectCreateView.php");        
    } // end create()
    
    
   /**
    * Update an existing project in the Project table
    * in the database. Called in ProjectController.php
    * @global type $connection
    * @param type $project_id (integer)
    */
    public function update($project_id)
    {   
        global $connection;
        $eid = $this->getEmployeeID();
        $cid = $this->getCustomerID();
        $startday = $this->getStartDay();
	$dueday = $this->getDueDay();
	$desc = $this->getDescription();
        
        $query = "UPDATE project
                 SET employee_id = {$eid}, customer_id = {$cid}, start_day = '{$startday}',due_day = '{$dueday}', description = '{$desc}'
		 WHERE project_id = {$project_id}";
        $result = mysql_query($query, $connection);
        confirm_query($result);
        redirect_to("Content.php");		
    }// end update($project_id)
    
    // this function delete the project object. Called in ProjectController.php
    
       
   /**
    * Delete an existing project in the Project table
    * in the database. Called in ProjectController.php
    * @global type $connection
    * @param type $project_id (integer)
    */ 
    public function delete($project_id)
    {
        global $connection;
        $query = "DELETE FROM project WHERE project_id = {$project_id}";
        $result = mysql_query($query, $connection);
        confirm_query($result);
        redirect_to("Content.php");
    }// end function delete($project_id)
    
    /**
    * Retrieves a set off projects from the 
     * database. 
    * @global type $connection
    * @return type Resultset from database
    */
    function get_all_projets()
    {
        global $connection;
        $query = "SELECT * FROM project ORDER BY description ASC";
        $project_set = mysql_query($query, $connection);
        confirm_query($project_set);
        return  $project_set;     
    } // end get_all_projets()
    
   // this function gets the project by Id. Called in in find_selected()
    
    /**
     *
     * @global type $connection
     * @param type $project_id
     * @return type project row( String array) 
     * @return null 
     */
    function get_project_by_id($project_id) 
    {
        global $connection;
        $query = "SELECT * FROM project WHERE project_id= {$project_id } LIMIT 1";
        $result_set = mysql_query($query, $connection);
        confirm_query($result_set);
        if($project = mysql_fetch_array($result_set)){return $project; } else { return NULL; }
    } // end get_project_by_id($project_id)
    
    // this function gets the catedories that belongs to an specific project. Called in function / navegation
    // to grup categories by project
    
    /**
     * Retireves from the project_category a specific record 
     * that matchesthe condition by category_id
     * @global type $connection
     * @param type $project_id
     * @return type String set of categories
     */
    function get_category_by_project($project_id) 
    {
        global $connection;
         $query = "SELECT project_category.project_category_id, category.description 
                FROM project_category, category 
                WHERE project_category.category_id = category.category_id
                AND project_category.project_id = {$project_id}
                ORDER BY category.description ASC";
           $category_set = mysql_query($query, $connection);
           confirm_query($category_set);
           return $category_set;
    } // end get_category_by_project($project_id) 
    
	
    // print all the projects objects in the database. 
    public function getProjectList()
    {        
        $table = "project"; display_db_table($table, TRUE, "border='1'");
        
    } // end getProjectList()  
    
    
    /**
     *
     * 
     * @global type $connection
     * @param type $id
     * @return type String set
     */
    public function getReport( $id )
    {
        
        global $connection;        
        
        $sql = "SELECT ";
        $sql .= "project.project_id, project_category.project_category_id, ";
        $sql .= "project_category_detail.project_category_detail_id, ";
        $sql .= "product.item, ";
        $sql .= "project_category_detail.quantity, ";
        $sql .= "min(bit.bit) ";
        $sql .= "FROM project, project_category, project_category_detail, bit, product ";
        $sql .= "WHERE  ";
        $sql .= "project.project_id=project_category.project_id  ";
        $sql .= "AND project_category.project_category_id=project_category_detail.project_category_id ";
        $sql .= "AND bit.project_category_detail_id=project_category_detail.project_category_detail_id ";
        $sql .= "AND product.product_id=project_category_detail.product_id ";
        $sql .= "AND project.project_id=".$id." ";
        $sql .= "GROUP BY project_category_detail.project_category_detail_id ";
        
        $result = mysql_query($sql, $connection);
        $rows = array();
        
        while ($rows[] = mysql_fetch_array($result))
            ;
                
        return $rows;
    }
    
    /**
     * Return the total for a project
     * @param type $id
     * @return type double
     */
    public function getTotal( $id )
    {
        $total = 0;
        
        $project = $this->getReport( $id );
        foreach ($project as $row)
            $total += ($row[4] * $row[5]);
        
        return $total;
    }
}
?>