<?php
class Feul
{
	//The below variables are information from the Feul xml file
	public $LoginCSS;
	public $WelcomeCSS;
	public $RegisterCSS;
	public $ProtectedMessage;
	
	/** 
     * Sets Creates settings xml file if it is not already created
     * 
     * @return void 
     */  
	public function __construct()
	{
		//check to see if the FeulFile file is created
		//If not created -> create
		if(!file_exists(FeulFile))
		{
			global $SITEURL;
			
			$this->Email = "noreply@".$_SERVER['HTTP_HOST'];
			$this->AllowRegister = "checked";

			//CSS For The Login Container - (Holds The Username/Password Fields & Submit Button)
$this->LoginCss = '<style>

/* User Register Link */
.user_login_register {

}

#loginform {
width:400px;
}

/* Login Form */
#loginform label{
display: inline-block; width: 150px;
}

/* Login Username Field */
.user_login_username {
padding:2px;
width:150px;
float:right;
}

/* Login Password Field */
.user_login_password {
padding:2px;
width:150px;
float:right;
}

/* Login Submit Button */
.user_login_submit {
float:left;
padding:3px;
}

</style>																																																																																					';

//Welcome Box CSS -  Holds Welcome Message For User
$this->WelcomeCss = '<style>
/* Span Tag Around "Welcome" Text */
.user-login-welcome-label {
font-size:17px;font-weight:bold;
}

/* Logout Link */
.user-login-logout-link {

}

.user_login_welcome_box_container {
font-size:16px;width:100%;
}

</style>';

//Register Box CSS - CSS For All Fields/titles/labels For Register Box
$this->RegisterCss = '<style>
.user-login-register-title {
font-size:16px;font-weight:bold;
}

#registerform {
width:500px;
}

/* Register Form Labels */
#registerform label{
display: inline-block; width: 130px;
}
#registerform input{
width:350px;float:right;
}
#registerform input[type=submit]{
float:left;width:120px;
}

</style>';

			//Protected Message - The Formatting/text For Protected Message - Can Be Changed Via CKEDITOR Through Plugin Admin Page
			$this->ProtectedMessage = '<div style="width:100%;height:25px;clear:both;padding:20px;font-size:18px;">
			Access denied. You have to be logged in and in a group with the needed rights.</div>';	
			
			//Create XML File
			$xml = new SimpleXMLElement('<item></item>');
			$xml->addChild('email', $this->Email);
			$xml->addChild('allowRegister', $this->AllowRegister);
			$xml->addChild('logincontainer', $this->LoginCss);
			$xml->addChild('welcomebox', $this->WelcomeCss);
			$xml->addChild('protectedmessage', $this->ProtectedMessage);
			$xml->addChild('registerbox', $this->RegisterCss);
			$xml->addChild('first', $this->RegisterCss);
			if (! XMLsave($xml, FeulFile))
			{
				$error = i18n_r('CHMOD_ERROR');
			}
			else
			{
				echo '<div class="updated">Front-End User Login Settings Succesfully Created</div>';
			}
		}
		
		$feul_data = getXML(FeulFile);
		$this->Email= $feul_data->email;		
		$this->LoginCss = $feul_data->logincontainer;
		$this->WelcomeCss =  $feul_data->welcomebox;
		$this->ProtectedMessage =  $feul_data->protectedmessage;
		$this->RegisterCss =  $feul_data->registerbox;
		
		if(!empty($feul_data->first))
		{
			$this->first = 'Yes';
		}
		
		if(empty($feul_data->allowRegister)) {
			$this->AllowRegister = "checked";
			$feul_data->addChild('allowRegister', "checked");
			unlink(FeulFile);
			XMLsave($feul_data, FeulFile);
		}
		else {
			$this->AllowRegister = $feul_data->allowRegister;
		}
		
		//Create data/site-users directory
		if(!file_exists(SITEUSERSPATH))
		{
			$create_feul_path = mkdir(SITEUSERSPATH);
			if($create_feul_path)
			{
				echo '<div class="updated">data/enhanced-site-users Directory Succesfully Created</div>';
			}
			else
			{
				echo '<div class="error"><strong>The data/enhanced-site-users folder could not be created!</strong><br/>You are going to have to create this directory yourelf for the plugin to work properly</div>';
			}
		}
		if(!file_exists(SITEUSERSGROUPPATH))
		{
			$create_feul_path = mkdir(SITEUSERSGROUPPATH);
			if($create_feul_path)
			{
				echo '<div class="updated">data/enhanced-site-groups Directory Succesfully Created</div>';
			}
			else
			{
				echo '<div class="error"><strong>The data/enhanced-site-groups folder could not be created!</strong><br/>You are going to have to create this directory yourelf for the plugin to work properly</div>';
			}
		}
	}

	/** 
    * Sets Gets data from xml file
    * 
	* @param string $field the xml node which will be returned
    * @return string the result of node request
    */  
	public function getData($field)
	{
		$feul_data = getXML(FeulFile);
		
		if(isset($feul_data->$field))
		{
			return $feul_data->$field;
		}
		else
		{
			return 'Error: Xml Field Does Not Exist';
		}
	}
	
	public function groupExists($group) {
		return ((strtolower($group) == "admin") || (strtolower($group) == "users") || (strtolower($group) == "unauthorized") || is_file(SITEUSERSGROUPPATH.$group.".xml"));
	}
	
	/**
	* Checks if the user exists.
	*/
	public function userExists($user) {
		return is_file(SITEUSERSPATH.$user.".xml");
	}
	
	public function getAllGroupNames() {
		$result[0] = 'Admin';
		$result[1] = 'Users';
		$result[2] = 'Unauthorized';
		
		$dir = SITEUSERSGROUPPATH."*.xml";
		$count = 2;
		
		foreach (glob($dir) as $file) 
		{
			if(strtolower(basename($file,".xml")) != "admin" 
			&& strtolower(basename($file,".xml")) != "users" 
			&& strtolower(basename($file,".xml")) != "unauthorized")
			{
				$count++;
				$result[$count] = basename($file,".xml");
			}
		}
		
		return $result;
	}
	
	/**
	* Gets all groups, two groups 'Admin' and 'Users' are default groups, that cannot be changed.
	*
	* @return array of all groups
	*/
	public function getAllGroups() {
		$result[0] = 'Admin';
		$result[1] = 'Users';
		$result[2] = 'Unauthorized';
		
		$dir = SITEUSERSGROUPPATH."*.xml";
		$count = 2;
		
		foreach (glob($dir) as $file) 
		{
			if(strtolower(basename($file,".xml")) != "admin" 
			&& strtolower(basename($file,".xml")) != "users" 
			&& strtolower(basename($file,".xml")) != "unauthorized")
			{
				$count++;
				$result[$count] = simplexml_load_file($file) or die("Unable to load XML file!");
			}
		}
		
		return $result;
	}
	
	/**
	* Gets description for a group.
	* 
	* @return the description of the group
	*/
	public function getGroupDescription($group) {
		if($group == "Admin") {
			return "Font end user login enhanced Administrator group. (Access to all pages)";
		}
		elseif($group == "Users") {
			return "Font end user login enhanced default users group.";
		}
		elseif($group == "Unauthorized") {
			return "Group for all not logged in users or users that are logged in but should not have any rights.";
		}		
		elseif(is_file(SITEUSERSGROUPPATH.$group.".xml")) {
			$xml = simplexml_load_file(SITEUSERSGROUPPATH.$group.".xml");
			
			return $xml->Description;
		}
		
		return '';
	}
	
	public function groupIsUsed($group) {
		foreach($this->getAllUsers() as $user) {
			if($user->Group == $group) {
				return true;
			}
		}
		
		return false;
	}
			
	/** 
    * Gets all users 
    * 
    * @return array all saved searches matching userID
    */  
	public function getAllUsers()
	{
		$result = array();

		$dir = SITEUSERSPATH."*.xml";
		$count = 0;
		foreach (glob($dir) as $file) 
		{
			$count++;
			$result[$count] = simplexml_load_file($file) or die("Unable to load XML file!");
		}

		// if the array count is 0
		if ( count ( $result ) == 0 )
		{
			return ( false );
		}
		else
		{
			return $result;
		}
	}
	
	function emailExists($email) {
		$users = $this->getAllUsers();
		
		if($users != NULL) {	
			foreach($users as $user) {
				if($user->EmailAddress == $email) {
					return true;
				}
			}
		}
		
		return false;
	}
			
	/** 
    * Gets data from database for requested user
    * 
	* @param string $user the user to select in database
	* @param string $column the database column to get data from
    * @return string the result of user data request
    */  
	public function getUserData($user,$column,$table=null)
	{
		$user_xml = getXML(SITEUSERSPATH.$user.".xml");
		if($this->userExists($user)) {
			$user_data = $user_xml->$column;
			return $user_data;
		}
		
		return '';
	}
	
	/** 
    * Gets data from database for requested user
    * 
	* @param string $user the user to select in database
	* @param string $column the database column to get data from
    * @return string the result of user data request
    */  
	public function getUserDataID($user,$column,$table=null)
	{
		$user = strtolower($user);

		$user_xml = getXML(SITEUSERSPATH.$user.".xml");
		$user_data = $user_xml->$column;
		return $user_data;
	}

		
	/** 
    * Process settings form. Saves to xml file
    * 
    * @return void
    */  
	public function processSettings()
	{
		$this->LoginCss = trim(safe_slash_html($_POST['post-login-container']));
		$this->Email = $_POST['post-from-email'];
		$this->WelcomeCss = trim(safe_slash_html($_POST['post-welcome-box']));
		$this->ProtectedMessage = trim(safe_slash_html($_POST['post-protected-message']));
		$this->RegisterCss = trim(safe_slash_html($_POST['post-register-box']));

		# create xml file
		if (file_exists(FeulFile)) 
		{ 
			unlink(FeulFile); 
		}	
		$xml = new SimpleXMLElement('<item></item>');
		$xml->addChild('email', $this->Email);
			
		if(isset($_POST['post-allow-register'])) {
			$this->AllowRegister = "checked";
		}
		else {
			$this->AllowRegister = " ";
		}
		
		$xml->addChild('allowRegister', $this->AllowRegister);
		$xml->addChild('logincontainer', $this->LoginCss);
		$xml->addChild('welcomebox', $this->WelcomeCss);
		$xml->addChild('protectedmessage', $this->ProtectedMessage);
		$xml->addChild('registerbox', $this->RegisterCss);
		if (! XMLsave($xml, FeulFile))
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function processEditGroup($groupname, $description = "")
	{
		$groupfile = SITEUSERSGROUPPATH.$groupname.".xml";
	
		rename($groupfile,SITEUSERSGROUPPATH . $groupname . '_old');
		
		$xml = new SimpleXMLElement('<item></item>');
		$xml->addChild('Groupname', $groupname);
		$xml->addChild('Description', $description);
		
		
		if (! XMLsave($xml, $groupfile) ) {
			$error = i18n_r('CHMOD_ERROR');
			rename(SITEUSERSGROUPPATH . $groupname . '_old',$groupfile);
		}
		
		else
		{
			unlink(SITEUSERSGROUPPATH . $groupname . '_old');
			print '<div class="updated">Group sucesfully edited</div>';
		}
	}
	
	/**
	* Adds new group to database
	* @param string $groupname, the new group name
	* @param string $decription, the description of the new group
	*/
	public function processAddGroupAdmin($groupname, $description = "")
	{
		if($this->groupExists($groupname) === true) {
		  return false;
		}
		
		$groupfile = SITEUSERSGROUPPATH.$groupname.".xml";
		
		// create group xml file
		$xml = new SimpleXMLElement('<item></item>');
		
		$xml->addChild('Groupname', $groupname);
		$xml->addChild('Description', $description);
		
		if (! XMLsave($xml, $groupfile) ) 
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	/**
	* Deletes a group that has no members
	*/
	public function deleteGroup($groupname)
	{
		if($this->groupExists($groupname)) {
			unlink(SITEUSERSGROUPPATH.$groupname.".xml");
		}
		
		return true;
	}
	
	/** 
    * Adds new user in database
    * 
	* @param string $username, the new account username
	* @param string $password the new account password
	* @param string $column the new account email
    * @return bool
    */  
	public function processAddUserAdmin($username, $group, $fullname, $password, $email, $convert=null)
	{
		if($convert == null)
		{
			$password = md5($password);
		}

		$username = strtolower($username);
		
		$usrfile = strtolower($username);
		$usrfile	= SITEUSERSPATH . $usrfile . '.xml';
		
		if($this->userExists($username) || $this->emailExists($email)) {
		  return false;
		}

		// create user xml file - This coding was mostly taken from the 'settings.php' page..
		$xml = new SimpleXMLElement('<item></item>');
		$xml->addChild('Username', $username);
		$xml->addChild('Group', $group);
		$xml->addChild('FullName', $fullname);
		$xml->addChild('Password', $password);
		$xml->addChild('EmailAddress', $email);
		if (! XMLsave($xml, $usrfile) ) 
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	/** 
    * Process Edit User Form XML
    * 
    * @return bool
    */  
	public function processEditUser($name=null, $group=null, $fullname=null, $password=null, $email=null, $change_pass=null, $change_name=null)
	{
		$usrfile = strtolower($name);
		$usrfile	= $usrfile . '.xml';
		
		$oldname = $usrfile;
		
		rename(SITEUSERSPATH . $oldname,SITEUSERSPATH . $oldname . '_old');
		
		if($change_name != null)
		{
			$usrfile = strtolower($change_name);
			$usrfile	= $usrfile . '.xml';
			$name = $change_name;
		}
		
		if($change_pass != null)
		{
			$password = md5($change_pass);
		}
		
		// create user xml file - This coding was mostly taken from the 'settings.php' page..
			$xml = new SimpleXMLElement('<item></item>');
			$xml->addChild('Username', $name);
			$xml->addChild('Group', $group);
			$xml->addChild('FullName', $fullname);
			$xml->addChild('Password', $password);
			$xml->addChild('EmailAddress', $email);
			if (! XMLsave($xml, SITEUSERSPATH . $usrfile) ) {
				$error = i18n_r('CHMOD_ERROR');
				rename(SITEUSERSPATH . $oldname . '_old',SITEUSERSPATH . $oldname);
			}
			
			else
			{
				unlink(SITEUSERSPATH . $oldname . '_old');
				print '<div class="updated">User sucesfully edited</div>';
			}
	}
		
	/** 
    * Deletes a user from database
    * 
	* @param string $username the user to delete
    * @return bool
    */  
	public function deleteUser($user)
	{
		$usrfile = strtolower($user);
		$usrfile	= $usrfile . '.xml';
		$delete_file = true;
		
		if(is_file(SITEUSERSPATH . $usrfile)) {
			$delete_file = unlink(SITEUSERSPATH . $usrfile);
		}
		if($delete_file)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/** 
    * Email user(s)
    * 
	* @param string $to email address(es) to send to
	* @param string $to_name name of recipitent
	* @param string $from the email address from which to send from
	* @param string $subject the subject of the email
	* @param string $message_content the body of the message
    * @return bool
    */  
	public function processEmailUser($to, $to_name, $from, $subject=null, $message_content)
	{
		$success = '';
		// subject
		if($subject == null)
		{
			$subject = $_POST['subject'];
		}

		// message
		$message = '
		<html>
		<head>
		  <title>'.$subject.'</title>
		</head>
		<body>
			'.$message_content.'
		</body>
		</html>
		';

		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers
		//$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
		$headers .= 'From: '.$from . "\r\n";
		//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
		//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

		// Mail it
		$success = mail($to, $subject, $message, $headers);
		if($success)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
	/** 
    * Check to see if a user is logged in and set session var -
    * Also logs user out if they click the logout link 
	*
    * @return void
    */  
	public function checkLogin($auto_login=null, $auto_username=null, $auto_password=null)
	{
		global $SITEURL;
		global $logged_in_message;
		//Check If User Session Is Started - If It IS NOT* Started, Then Start Session
		if(!isset($_SESSION))
		{
			session_start();
		}
		
		//I DONT THINK THE BELOW VARIABLE IS NEEDED
		//$the_page_slug =  return_page_slug();

		//Check If Logged In - Define Username - If logged in return true
		if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
		{
			//If Logged In The $logged_in Variable = true
			return true;
		}

		//If Not Logged In But USername And Password Have Been Posted
		elseif(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['login-form']))
		{
			//Set Posted Username And Password Variable
			$username = strtolower($_POST['username']);
			$password = $_POST['password'];
			$user_pass = $this->getUserData($username,'Password');

			//Check XML File Password.. If Correct, Log User In And Redirect Back To Page
			if(md5($password) == $user_pass)
			{
				$_SESSION['Username'] = strtolower($_POST['username']);
				$_SESSION['LoggedIn'] = 1;
				
				return true;
			}
			//If Login Credentials were wrong.. Do Not Log Visitor In And Return wrong information message
			else
			{
				return false;
			}
		}
		elseif($auto_login != null)	
		{
			$_SESSION['Username'] = strtolower($auto_username);
			$_SESSION['LoggedIn'] = 1;
		}
	}
	
	/** 
    * Check to see if a front end page is for members only
    * Display protected message if page is members only and user is not logged in
	*
    * @return bool
    */  
	public function checkPerm()
	{
		//Get Current Page Slug And XML File
		$the_page_slug_xml = GSDATAPAGESPATH.return_page_slug().'.xml';
		$page_data = getXML($the_page_slug_xml);

		//Check If Page Is For Members Only
		if(isset($page_data->memberonly) && strlen(trim($page_data->memberonly)) > 0)
		{
			$pageAccessArr = explode(';',$page_data->memberonly);
		
			//If The Page Is For Groups Only, The User Is Not Logged In Or Is In The Wrong Group Display protected Message
			if(isset($_SESSION['LoggedIn']))
			{
				$userGroupArr = explode(';',$this->getUserData($_SESSION['Username'],'Group'));
			
				foreach($pageAccessArr as $pageAccess) {
					if($pageAccess == "Unauthorized") {
						return true;
					}
					
					foreach($userGroupArr as $userGroup) {
						if($pageAccess == $userGroup || $userGroup == "Admin") {
							return true;
						}
					}
				}
				
				return false;
			}
			else
			{
				foreach($pageAccessArr as $pageAccess) {
					if($pageAccess == "Unauthorized") {
						return true;
					}
				}
				
				return false;
			}
		}	

		//If The Page Is NOT For Members Only - Display Normal Content
		else
		{
			return true;
		}
	}
	
	/**
	* Get the access group for the page
	*
	* @return the access group for the page
	*/
	public function getAccessForPage()
	{
		if(isset($_GET['id']))
		{
			$current_page_edit = $_GET['id'];
			$the_page_slug_xml = GSDATAPAGESPATH.$current_page_edit.'.xml';
			$page_data = getXML($the_page_slug_xml);

			return explode(';',$page_data->memberonly);
		}
		else
		{
			return array('Unauthorized');
		}
	}
}

?>
