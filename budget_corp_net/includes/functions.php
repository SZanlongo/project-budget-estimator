<?php
    // This file is the place to store all the basic functions
    function mysql_prep($value)
    {
        $magic_quotes_active = get_magic_quotes_gpc();
        $new_enough_php = function_exists("mysql_real_escape_string"); //i.e PHP >= v4.3.0
        if($new_enough_php)// PHP v4.3.0 or higher undo any magic quote effects so mysql_real_escape_string can do the work 
        {
            if($magic_quotes_active) { $value = stripslashes($value); }
            $value = mysql_real_escape_string($value);    
        }
        else //before PHP v4.3.0
        {
            // if magic quotes aren't already on the add slashes manually
            if (!$magic_quotes_active) { $values = addslashes($value); }        
        } // if magic quotes are active, then the slashes already exist
        return $value;
    } // end function mysql_prep($value)
    
    function redirect_to($location = NULL)
    {
        if($location != NULL) { header("Location: {$location}"); exit; }
    } // end redirect_to($location = NULL)
    
    function confirm_query($result_set)
    {
		if(!$result_set) { die("Database query failed: " . mysql_error()); }
    } // end confirm_query($result_set)
	
	// form functions implemented to validate the data inserted in forms
	
	function check_required_fields($required_fields)
	{
		$field_errors = array();
		 foreach($required_fields as $fieldname)
		{
			if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname]) )
			{ 	$field_errors[] = $fieldname; }
		}
		return $field_errors;
	}// end check_required_fields($required_array)
	
	function check_max_field_lengths($fields_with_lengths)
	{
		$field_errors = array();
		foreach($fields_with_lengths as $fieldname => $maxlength)
		{
			if(strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength)
			{ $field_errors[] = $fieldname; }
		}
		return $field_errors;
	} // end check_max_field_lengths($field_length_array)
	
	function display_errors($errors)
	{
		echo "<p class=\"errors\">";
		echo "Please review the following field:<br />";
		foreach($errors as $error) {
			echo " - " . $error . "<br />";
		}
		echo "</p>";
	}// end display_errors($errors_array)
	
	// querry functions	
	function get_all_supplier() // used in create_supplier
    {
        global $connection;
        $query = "SELECT *
		    FROM supplier
		    ORDER BY supplier_name ASC";
	      $supplier_set = mysql_query($query, $connection);
	      confirm_query($supplier_set);
        return  $supplier_set;     
    } // end get_all_supplier()

	function get_supplier_by_id($supplier_id)
    {
        global $connection;
        $query = "SELECT * ";
        $query .= "FROM supplier ";
        $query .= "WHERE supplier_id=" . $supplier_id ." ";
        $query .= "LIMIT 1"; // Limit the result to only one
        $result_set = mysql_query($query, $connection);
        confirm_query($result_set);
        // if no rows are returned, fetch_arrat will return false
        if($supplier = mysql_fetch_array($result_set)) // pass a single employee
        { return $supplier; }
        else { return NULL; }
    } // end get_supplier_by_id($supplier_id)
    
    // get supplier id used in create_bit
	function get_supplier_id($supplier_name)
	{
		global $connection;
		$query = "SELECT supplier_id 
					FROM supplier
					WHERE supplier_name = \"{$supplier_name}\"
					LIMIT 1";
		  $supplier_id = mysql_query($query, $connection);
	      confirm_query($supplier_id);
        
		$array = mysql_fetch_array($supplier_id);
		$id = $array[0];
		return $id;		
	} // end get_supplier_id($supplier_name)
	
	function get_all_employee()
    {
        global $connection;
        $query = "SELECT *
		    FROM employee
		    ORDER BY employee_name ASC";
	      $project_set = mysql_query($query, $connection);
	      confirm_query($project_set);
        return  $project_set;     
    } // end get_all_employee()
	
	// get employee id used in create_project
	function get_employee_id($employee_name)
	{
		global $connection;
		$query = "SELECT employee_id 
					FROM employee
					WHERE employee_name = \"{$employee_name}\"
					LIMIT 1";
		  $employee_id = mysql_query($query, $connection);
	      confirm_query($employee_id);
        
		$array = mysql_fetch_array($employee_id);
		$id = $array[0];
		return $id;		
	} // end get_employee_id($employee_name)
	
	function get_employee_by_id($employee_id)
    {
        global $connection;
        $query = "SELECT * ";
        $query .= "FROM employee ";
        $query .= "WHERE employee_id=" . $employee_id ." ";
        $query .= "LIMIT 1"; // Limit the result to only one
        $result_set = mysql_query($query, $connection);
        confirm_query($result_set);
        // if no rows are returned, fetch_arrat will return false
        if($employee = mysql_fetch_array($result_set)) // pass a single employee
        { return $employee; }
        else { return NULL; }
    } // end get_employee_by_id($employee_id)
	
	function get_all_customer()
    {
        global $connection;
        $query = "SELECT *
		    FROM customer
		    ORDER BY customer_name ASC";
	      $project_set = mysql_query($query, $connection);
	      confirm_query($project_set);
        return  $project_set;     
    } // end get_all_customer()
	
	function get_customer_by_id($customer_id)
    {
        global $connection;
        $query = "SELECT * ";
        $query .= "FROM customer ";
        $query .= "WHERE customer_id=" . $customer_id ." ";
        $query .= "LIMIT 1"; // Limit the result to only one
        $result_set = mysql_query($query, $connection);
        confirm_query($result_set);
        // if no rows are returned, fetch_array will return false
        if($customer = mysql_fetch_array($result_set)) // pass a single customer
        { return $customer; }
        else { return NULL; }
    } // end get_customer_by_id($customer_id)	
	
	// get customer id used in create_project
	function get_customer_id($customer_name)
	{
		global $connection;
		$query = "SELECT customer_id 
					FROM customer
					WHERE customer_name = \"{$customer_name}\"
					LIMIT 1";
		  $customer_id = mysql_query($query, $connection);
	      confirm_query($customer_id);
		  
		$array = mysql_fetch_array($customer_id);
		$id = $array[0];
		return $id;	  
	} // end get_customer_id($customer_name)
	
	function get_all_category()
    {
        global $connection;
        $query = "SELECT *
		    FROM category
		    ORDER BY description ASC";
	      $category_set = mysql_query($query, $connection);
	      confirm_query($category_set);
        return  $category_set;     
    } // end get_all_category()
	
	function get_category_id($category_name) // used in add_project_category
	{
		global $connection;
		$query = "SELECT category_id 
					FROM category
					WHERE description = \"{$category_name}\"
					LIMIT 1";
		  $category_id = mysql_query($query, $connection);
	      confirm_query($category_id);
		  
		$array = mysql_fetch_array($category_id);
		$id = $array[0];
		return $id;	  
	} // end get_category_id($category_name)
	
	function get_category_by_id($category_id) // used in find_selected()
    {
        global $connection;
        $query = "SELECT * ";
        $query .= "FROM category ";
        $query .= "WHERE category_id=" . $category_id ." ";
        $query .= "LIMIT 1"; // Limit the result to only one
        $result_set = mysql_query($query, $connection);
        confirm_query($result_set);
        // if no rows are returned, fetch_arrat will return false
        if($category = mysql_fetch_array($result_set)) // pass a single product
        {
            return $category;
        }   else { return NULL; }
    } // end get_category_by_id($category_id)
	
	function get_all_product()
    {
        global $connection;
        $query = "SELECT *
		    FROM product
		    ORDER BY description ASC";
	      $project_set = mysql_query($query, $connection);
	      confirm_query($project_set);
        return  $project_set;     
    }// end get_all_product()
	
	function get_product_id($item)
	{
		global $connection;
		$query = "SELECT product_id 
					FROM product
					WHERE item = \"{$item}\"
					LIMIT 1";
		  $product_id = mysql_query($query, $connection);
	      confirm_query($product_id);
		  
		$array = mysql_fetch_array($product_id);
		$id = $array[0];
		return $id;	  
	} // end get_product_id($item)
	
	function get_product_by_id($product_id) // used in find_selected()
    {
        global $connection;
        $query = "SELECT * ";
        $query .= "FROM product ";
        $query .= "WHERE product_id=" . $product_id ." ";
        $query .= "LIMIT 1"; // Limit the result to only one
        $result_set = mysql_query($query, $connection);
        confirm_query($result_set);
        // if no rows are returned, fetch_arrat will return false
        if($product = mysql_fetch_array($result_set)) // pass a single product
        { return $product; } else { return NULL; }
    } // end get_product_by_id($product_id)
		
    function get_all_projets()
    {
        global $connection;
        $query = "SELECT *
		    FROM project
		    ORDER BY description ASC";
	      $project_set = mysql_query($query, $connection);
	      confirm_query($project_set);
        return  $project_set;     
    } // end get_all_projets()
    
    function get_category_by_project($project_id) // project category class
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
	
    function get_project_by_id($project_id) // used in find_selected() and to delete project
    {
        global $connection;
        $query = "SELECT * ";
        $query .= "FROM project ";
        $query .= "WHERE project_id=" . $project_id ." ";
        $query .= "LIMIT 1"; // Limit the result to only one
        $result_set = mysql_query($query, $connection);
        confirm_query($result_set);
        // if no rows are returned, fetch_arrat will return false
        if($project = mysql_fetch_array($result_set)) // pass a single project
        {
            return $project; }
        else { return NULL; }
    } // end get_project_by_id($project_id)
	
	
	function test($project_category_id) // used in find_selected() and to delete project_category failllllllllllllllllllllllllllllllllllllllllllll
    {
        global $connection;       	
		 $query = "SELECT * 
				FROM project_category
				WHERE project_category_id = " . $project_category_id ." 
				LIMIT 1"; // Limit the result to only one				
        $result_set = mysql_query($query, $connection);
        confirm_query($result_set);
        return $result_set;
    }// end get_project_category_by_id($project_category_id)	
	
    function get_project_category_by_id($project_category_id) // used in find_selected() 
    {
        global $connection;       	
		$query = "SELECT project_category.project_category_id, 
				project_category.project_id, 
				project_category.category_id, category.description ";
		$query .= "FROM project_category , category ";
		$query .= "WHERE project_category_id = $project_category_id "; 
		$query .= "AND project_category.category_id = category.category_id ";
		$query .= "LIMIT 1";
				
        $result_set = mysql_query($query, $connection);
        confirm_query($result_set);
        // if no rows are returned, fetch_array will return false
        if($project_category = mysql_fetch_array($result_set)) { return $project_category; }
        else { return NULL; }
    }// end get_project_category_by_id($project_category_id)   
	
	function get_project_category_detail_by_id($project_category_detail_id) // used in find_selected() to use in create bit
    {
        global $connection;       	
		$query = "SELECT project_category_detail.project_category_detail_id, 
				project_category_detail.project_category_id, 
				project_category_detail.product_id, project_category_detail.quantity, product.item ";
		$query .= "FROM project_category_detail , product ";
		$query .= "WHERE project_category_detail_id = $project_category_detail_id "; 
		$query .= "AND project_category_detail.product_id = product.product_id ";
		$query .= "LIMIT 1";
				
        $result_set = mysql_query($query, $connection);
        confirm_query($result_set);
        // if no rows are returned, fetch_array will return false
        if($project_category = mysql_fetch_array($result_set)) { return $project_category; }
        else { return NULL; }
    }// end get_project_category_detail_by_id($project_category_detail_id)
	
	function get_project_category_detail_by_category_id($project_category_id) //all the detail project thet belongs to one category
    {
        global $connection;       	
		$query = "SELECT project_category_detail.project_category_detail_id, project_category_detail.project_category_id,  
				project_category_detail.product_id,project_category_detail.quantity, product.item 				
				FROM project_category_detail , product 
				WHERE project_category_id = {$project_category_id}  
				AND project_category_detail.product_id = product.product_id ";		
						
        $result_set = mysql_query($query, $connection);
        confirm_query($result_set);
		return $result_set;
        // no fetche because twice because give errors
       // if($project_category = mysql_fetch_array($result_set)) { return $project_category; }
       // else { return NULL; }
    }// end get_project_category_detail_by_category_id($project_category_id)
	
	 function find_selected() 
    {
        global $sel_project; global $sel_project_category; global $sel_project_category_detail;  global $sel_product; 
		global $sel_employee; global $sel_supplier; global $sel_customer; global $sel_product_category;	       
	    
		if(isset($_GET['proj'])) // project is selected
		{
			$sel_project = get_project_by_id($_GET['proj']);
			$sel_project_category = NULL; $sel_product = NULL; $sel_employee = NULL; $sel_supplier = NULL; $sel_customer = NULL; $sel_product_category = NULL; $sel_project_category_detail = NULL;
		} 
		elseif (isset($_GET['project_category_id'])) // category is selected
		{
			$sel_project_category = get_project_category_by_id($_GET['project_category_id']);
			$sel_project = NULL; $sel_product = NULL; $sel_employee = NULL; $sel_supplier = NULL; $sel_customer = NULL;	$sel_product_category = NULL; $sel_project_category_detail = NULL;
		}
		elseif (isset($_GET['empl'])) // employee is selected
		{
			$sel_employee = get_employee_by_id($_GET['empl']);
			$sel_project_category = NULL; $sel_project = NULL; $sel_product = NULL; $sel_supplier = NULL; $sel_customer = NULL;	$sel_product_category = NULL; $sel_project_category_detail = NULL;
		}
		elseif (isset($_GET['prod'])) // product is selected
		{
			$sel_product = get_product_by_id($_GET['prod']);
			$sel_project_category = NULL; $sel_project = NULL; $sel_employee = NULL; $sel_supplier = NULL; $sel_customer = NULL; $sel_product_category = NULL; $sel_project_category_detail = NULL;
		}
		elseif (isset($_GET['suppl'])) // supplier is selected
		{
			$sel_supplier = get_supplier_by_id($_GET['suppl']);
			$sel_product = NULL; $sel_project_category = NULL; $sel_project = NULL;	$sel_employee = NULL; $sel_customer = NULL;	$sel_product_category = NULL; $sel_project_category_detail = NULL;		
		}
		elseif (isset($_GET['cust'])) // customer is selected
		{
			$sel_customer = get_customer_by_id($_GET['cust']); 
			$sel_supplier = NULL; $sel_product = NULL; $sel_project_category = NULL; $sel_project = NULL; $sel_employee = NULL; $sel_product_category = NULL; $sel_project_category_detail = NULL;		
		}
		elseif (isset($_GET['product_categ'])) // product_categ is selected
		{
			$sel_product_category = get_category_by_id($_GET['product_categ']); 
			$sel_supplier = NULL; $sel_product = NULL; $sel_project_category = NULL; $sel_project = NULL; $sel_employee = NULL; $sel_customer = NULL; $sel_project_category_detail = NULL; 		
		}
		elseif (isset($_GET['proj_categ_detail'])) // proj_categ_detail is selected
		{
			$sel_project_category_detail = get_project_category_detail_by_id($_GET['proj_categ_detail']); 
			$sel_supplier = NULL; $sel_product = NULL; $sel_project_category = NULL; $sel_project = NULL; $sel_employee = NULL; $sel_customer = NULL; $sel_project_category = NULL; 		
		}
		else{$sel_project = NULL; $sel_project_category = NULL; $sel_product = NULL; $sel_employee = NULL; $sel_supplier = NULL; 
				$sel_customer = NULL; $sel_product_category = NULL; $sel_project_category_detail = NULL;}	
    } // end function find_selected()
	
    function navigation($sel_project_category,$sel_project)
    {		
        
		$output = "<ul class=\"projects\">";		
		$project_set = get_all_projets(); // object proj				
		while( $project = mysql_fetch_array($project_set))
		{
			$output .="<li";
			if($project['project_id'] == $sel_project['project_id']) {$output .=" class=\"selected\"";}	// make bool selected peoject			
			$output .="><a href=\"ProjectEditView.php?proj=" . urlencode($project['project_id']) . "\"> {$project["description"]}</a></li>";				
			
			$category_set = get_category_by_project($project["project_id"]);// object proj							
			$output .="<ul class=\"category\">";
			while( $project_category = mysql_fetch_array($category_set))
			{
				$output .="<li";
				if($project_category['project_category_id'] == $sel_project_category['project_category_id']) { $output .=" class=\"selected\"";} // make bool selected category
				$output .="><a href=\"ProjectCategoryDetailCreateView.php?project_category_id=" . urlencode($project_category['project_category_id']) .
				"\">{$project_category["description"]}</a></li>";	
			}
			$output .="</ul>";
		}		
		$output .="</ul>"; 
		return $output;				
    } // end navigation($sel_project_category, $sel_product,$sel_project, $sel_employee )
    
  /*   function navigation($sel_project_category,$sel_project)
    {		
		$output = "<ul class=\"projects\">";		
		$project_set = get_all_projets();				
		while( $project = mysql_fetch_array($project_set))
		{
			$output .="<li";
			if($project['project_id'] == $sel_project['project_id']) {$output .=" class=\"selected\"";}	// make bool selected peoject			
			$output .="><a href=\"edit_project.php?proj=" . urlencode($project['project_id']) . "\"> {$project["description"]}</a></li>";				
			
			$category_set = get_category_by_project($project["project_id"]);							
			$output .="<ul class=\"category\">";
			while( $project_category = mysql_fetch_array($category_set))
			{
				$output .="<li";
				if($project_category['project_category_id'] == $sel_project_category['project_category_id']) { $output .=" class=\"selected\"";} // make bool selected category
				$output .="><a href=\"create_project_category_detail.php?project_category_id=" . urlencode($project_category['project_category_id']) .
				"\">{$project_category["description"]}</a></li>";	
			}
			$output .="</ul>";
		}		
		$output .="</ul>"; 
		return $output;				
    } // end navigation($sel_project_category, $sel_product,$sel_project, $sel_employee )*/
		
    function project_navigation($sel_project) // used in product area
    {		
        $output = "<ul class=\"product\">";		
		$project_set = get_all_projets();				
		while( $project = mysql_fetch_array($project_set))
		{
			$output .="<li";
			if($project['project_id'] == $sel_project['project_id']) {$output .=" class=\"selected\"";}	// make bool selected peoject			
			$output .="><a href=\"ProjectConsolidateController.php?proj=" . urlencode($project['project_id']) . "\"> {$project["description"]}</a></li>";				
		}		
		$output .="</ul>"; 
		return $output;		
    } // end product_navigation($sel_product_category, $sel_product)
		
	function display_db_query($query_string, $header_bool, $table_params)
	{
		global $connection;		
		// perform the database query
		$result_set = mysql_query($query_string, $connection);
		confirm_query($result_set);
		// find out the number of columns in result
		$column_count = mysql_num_fields($result_set);
		confirm_query($column_count);
		// Here the table attributes from the $table_params variable are added
		print("<TABLE $table_params >\n");
		// optionally print a bold header at top of table
		if($header_bool) {
			print("<TR>");
			for($column_num = 0; $column_num < $column_count; $column_num++) {
				$field_name = mysql_field_name($result_set, $column_num);
				print("<TH>$field_name</TH>");
			}
			print("</TR>\n");
		}
		// print the body of the table
		while($row = mysql_fetch_row($result_set)) {
			print("<TR ALIGN=LEFT VALIGN=TOP>");
			for($column_num = 0; $column_num < $column_count; $column_num++) {	print("<TD>$row[$column_num]</TD>\n");}
			print("</TR>\n");
		}
		print("</TABLE>\n"); 
	}// end function display_db_query($query_string, $header_bool, $table_params)

	function display_db_table($tablename, $header_bool, $table_params)
	{
		$query_string = "SELECT * FROM $tablename";
		display_db_query($query_string, $header_bool, $table_params);
	} // end display_db_table($tablename, $header_bool, $table_params)
	
?>
