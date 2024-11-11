<?php
 /*   SQL Query Founction   */

//Check if value exists
function isExists($conn, $table, $field, $value){
		$result = $conn->query("SELECT $field FROM $table WHERE $field='".$value."' ") or die("Not Selected: ".mysqli_error($conn));
	
	if($result->num_rows > 0) { 
		return true; 
	}else{ 
		return false; 
	}
}

//Check if record that is about to be updated exists
function isExistsCurrent($conn, $table, $field1, $value1, $field2, $value2){
	$r = $conn->query("SELECT $field1 FROM $table WHERE $field1 = $value1 AND $field2 = '".$value2."'") or die("Can't select record : ".mysqli_error($conn));
	
	if($r->num_rows != 1) {
		return true; 
	}else{ 
		return false; 
	}
}

//This function will add new message to inboxtable
function do_inbox_add($conn, $message, $pincode) 
{
	$conn->query("INSERT INTO inbox VALUES (0, '".$pincode."', 
			'".tt_sensatize_input($conn, $message)."', '0',
			'".tt_sensatize_input($conn, date("d-m-Y H:ia"))."')") or die("Insert Inbox Error: ".mysqli_error($conn));
}	
	
//This function will return the name of the programme base of it's ID feeded. 
function get_programme_title($conn, $pid) 
{
	$result = $conn->query("SELECT title FROM programme WHERE deptID = '".base64_decode($pid)."' ") or die("Select error: ".mysqli_error($conn));
	$c 	= $result->num_rows;
		
		if($c){
			$r = $result->fetch_assoc();
			return 	$r['title'];
		}else{
			return 'Not Found!';
		}
}		

//This function will return the user's application state base of it's ID feeded. 
function get_user_account_status($conn, $uid) 
{
	$result = $conn->query("SELECT category FROM profile WHERE pincode = '".$uid."' ") or die("Select error: ".mysqli_error($conn));
	$c 	= $result->num_rows;
		
		if($c){
			$r = $result->fetch_assoc();
			switch($r['category']){
				case "apply": return "<span style='color:#CC9900'>Unprocessed Application</span>";
					break;
				case "reject": return "<span style='color:#FF0000'>Rejected Application</span>";
					break;
				case "admit": return "<span style='color:#009900'>Admitted Student</span>";
					break;		
				default:
					return 'Not Found!';
			}		
		}
}		

//This function will return the concatinated fullname of the Admin using his ID.
function get_admin_fullname($conn, $id) 
{
	$result = $conn->query("SELECT fullname FROM tbl_admin WHERE admin_id = '".$id."' ") or die("get_admin_fullname() error: ".mysqli_error($conn));
	$c 	= $result->num_rows;
		
		if($c){
			$r = $result->fetch_assoc();
			return 	$r['fullname'];
		}
		return 'Fullname Not Found!';
}

//This function will return the concatinated fullname of the student by his/her pincode.
function get_user_fullname($conn, $pincode) 
{
	$result = $conn->query("SELECT fname, mname, lname FROM profile WHERE pincode = '".$pincode."' ") or die("get_user_fullname() error: ".mysqli_error($conn));
	$c 	= $result->num_rows;
		
		if($c){
			$r = $result->fetch_assoc();
			return 	$r['fname'].' '.$r['mname'].' '.$r['lname'];
		}
		return 'Fullname Not Found!';
}

//This function will return the field name of the user base of it's feeded ID. 
function get_user_info($conn, $field, $pincode) 
{
	if($pincode != '') {
	$result = $conn->query("SELECT ".$field." FROM profile WHERE pincode = '".$pincode."' ") or die("get_user_info() error: ".mysqli_error($conn));
	$c		= $result->num_rows;
		if($c != 0){
			$r = $result->fetch_assoc();
			return 	$r[$field];
		}
	}
	return 'No Value!';
}
	
//This function will return the field name of the user base of it's feeded ID. 
function get_any_value($conn, $table, $field, $wField, $wValue, $sender) 
{
	if($wValue != '') {
	
	$result = $conn->query("SELECT ".$field." FROM ".$table." WHERE ".$wField." = '".$wValue."' ") or die("get_any_value() SQL Error: ".mysqli_error($conn)."\n\n Sender: ".$sender);
	$c		= $result->num_rows;
		if($c != 0){
			$r = $result->fetch_assoc();
			return 	$r[$field];
		}
	}
	return 'No Value!';
}
	
//This function will return the field name of the chooses table base of it's feeded ID. 
function get_user_program($conn, $field) 
{
	if($_SESSION['pincode'] == '') {
		return '';
	}else{	
	$result = $conn->query("SELECT ".$field." FROM choose WHERE pincode = '".$_SESSION['pincode']."' ") or die("get_user_program() error: ".mysqli_error($conn));
	$c		= $result->num_rows;
		if($c){
			$r = $result->fetch_assoc();
			return 	$r[$field];
		}else{
			return 'Programme Not Found!';
		}
	}
}
		
//This function will return the field name base of it's feeded ID. 
function get_admin_info($conn, $field, $admin_id) 
{
	if($admin_id == '') {
		return '';
	}else{	
	$result = $conn->query("SELECT ".$field." FROM admin WHERE admin_id = '".$admin_id."' ") or die("get_admin_information() error: ".mysqli_error($conn));
	$c		= $result->num_rows;
		if($c){
			$r = $result->fetch_assoc();
			return 	$r[$field];
		}else{
			return 'Admin Not Found!';
		}
	}
}
		
//This function will return number of rows in the given table
function get_row_count($conn, $p_key, $table, $field, $value) 
{	
	if($field == "" || $value == ""){
		$result = $conn->query("SELECT ".$p_key." FROM ".$table) or die("Not get data count: ".mysqli_error($conn));
		$dc 	= $result->num_rows;
	}else{
		$result = $conn->query("SELECT ".$p_key." FROM ".$table." WHERE ".$field." = '".$value."' ") or die("Not get data count: ".mysqli_error($conn));
		$dc 	= $result->num_rows;
	}
	return $dc;	
}	

//This function will return number of unseen notifications
function get_inbox_count($conn) 
{
	$result = $conn->query("SELECT pincode FROM inbox WHERE pincode = '".$_SESSION['pincode']."' AND status = 0 ") or die("Select error: ".mysqli_error($conn));
	$counter 	= $result->num_rows;
	return $counter;
}

//Get random programme icon
function getRandomProgramIcon()
{
	$icon_arr = array("icon-display", 	"icon-magic-wand", 	"icon-database", 	"icon-accessibility", 	"icon-cloud", 
					 "icon-aid-kit", 	"icon-airplane", 	"icon-alarm", 		"icon-angry", 			"icon-attachment",
					 "icon-camera", 	"icon-cart", 		"icon-magnet", 		"icon-delicious", 		"icon-music",
					 "icon-bell", 		"icon-binoculars", 	"icon-baffled", 	"icon-basecamp", 		"icon-bullhorn");
	
	// get random index from array $arrX
	$rand_index = array_rand($icon_arr);
	 
	// output the value for the random index
	if($icon_arr[$rand_index]!=""){
		return $icon_arr[$rand_index];	
	}else{
		getRandomProgramIcon();
	}			 
}


#Preset Variables
//function pre_setting($conn)
//{
if(isset($_SESSION["adminID"])) {
	$view_records	= get_any_value($conn, 'setting', 'display_rows', 'admin_id', $_SESSION["adminID"], "_tt_functions_app.php");//15	//Pagination/Setting
	$display_pages	= get_any_value($conn, 'setting', 'display_pages', 'admin_id', $_SESSION["adminID"], "_tt_functions_app.php");//5;	//Pagination
	$max_view		= get_any_value($conn, 'setting', 'max_views', 'admin_id', $_SESSION["adminID"], "_tt_functions_app.php");//10;	//Pagination
	$imgP_height	= get_any_value($conn, 'setting', 'imgP_height', 'admin_id', $_SESSION["adminID"], "_tt_functions_app.php");//600; 	//This define the height of picture to upload as USER/ADMIN.
	$imgG_height	= get_any_value($conn, 'setting', 'imgG_height', 'admin_id', $_SESSION["adminID"], "_tt_functions_app.php");//800; 	//This define the height of picture to upload as GALLERY.
	$imgN_height	= get_any_value($conn, 'setting', 'imgN_height', 'admin_id', $_SESSION["adminID"], "_tt_functions_app.php");//600; 	//This define the height ofpicture to upload as NEWS.
}	
//}	
?>
