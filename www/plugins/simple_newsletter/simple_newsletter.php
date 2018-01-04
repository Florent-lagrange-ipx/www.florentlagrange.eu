<?php
/**
 * Plugin Name: Simple Newsletter
 * Description: Simple newsletter with subscriptions
 * Version: 1.1
 * Author: David Shaner
 * Author URI: http://www.shaner.us/
 */

# get correct id for plugin
$thisfile=basename(__FILE__, ".php");

#Create Directories if they don't exist
if(!is_dir(GSDATAOTHERPATH.'newsletter_temp')){
    mkdir(GSDATAOTHERPATH.'newsletter_temp');
}
if(!is_dir(GSDATAOTHERPATH.'newsletter_subscriptions')){
    mkdir(GSDATAOTHERPATH.'newsletter_subscriptions');
}

# Global variables
$weeds = array('.','..','.DS_Store');
$pages = array();
$newsletter_subscribers = array();
$pages = scandir(GSDATAPAGESPATH);
$pages = array_diff($pages,$weeds);
$newsletter_settings = GSDATAOTHERPATH .'newsletter_settings.xml';
$newsletter_temp = GSDATAOTHERPATH .'newsletter_temp/';
$newsletter_subscriptions = GSDATAOTHERPATH .'newsletter_subscriptions/';
$newsletter_subscribers = scandir($newsletter_subscriptions);
$newsletter_subscribers = array_diff($newsletter_subscribers,$weeds);
$at_replacement = '-----';

$website_xml = GSDATAOTHERPATH.'website.xml';
$x = getXML($website_xml);
$website = $x->SITEURL;
$site_url = $_SERVER['SERVER_NAME'];

# register plugin
register_plugin(
	$thisfile, 
	'Simple Newsletter', 	
	'1.1', 		
	'David Shaner',
	'http://www.shaner.us/', 
	'A simple newsletter with subscriptions',
    'newsletter',
	'newsletter'  
);
#JQuery Load
register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', '1.7.1', FALSE);
queue_script('jquery',GSBOTH);

# Add tab in admin
add_action('nav-tab','createNavTab',array('newsletter',$thisfile,'Newsletter', 'directions'));

# Newsletter tab sidebar links - Admin
add_action('newsletter-sidebar','createSideMenu',array($thisfile,'Newsletter Settings','setup'));
add_action('newsletter-sidebar','createSideMenu',array($thisfile,'Send Newsletter','send'));

# Signup Form - Frontend Display
add_action('content-bottom','signup_form');

/**
 * Main Newsletter Function
 */
function newsletter(){
    /*
    if(!is_dir(GSDATAOTHERPATH.'newsletter_temp')){
        mkdir(GSDATAOTHERPATH.'newsletter_temp');
    }
    if(!is_dir(GSDATAOTHERPATH.'newsletter_subscriptions')){
        mkdir(GSDATAOTHERPATH.'newsletter_subscriptions');
    }
    */
    $action_url = $_SERVER['QUERY_STRING'];
    $action = explode('&',$action_url);
    $action = $action[1];
    
    switch($action){
        case 'directions':
            newsletter_directions();
            break;
        case 'send':
            newsletter_select();
            break;
        case 'setup':
            newsletter_settings();
            break;
    }
}

/**
 * Newsletter Settings
 */
function newsletter_settings(){
    global $newsletter_settings, $newsletter_email_address, $newsletter_subject, $site_url, $newsletter_contact,
    $newsletter_confirmation_body, $newsletter_confirmation_subject;
    
    $error = null;
    $success = null;
    
    if(isset($_POST['submit_newsletter_settings'])){
        $newsletter_email_address = null;
        $newsletter_subject = null;
        $newsletter_contact = null;
        $newsletter_confirmation_body = null;
        $newsletter_confirmation_subject = null;
        
        $newsletter_email_valid = validate_email($_POST['newsletter_email_address']);
        $newsletter_contact_valid = validate_email($_POST['newsletter_contact']);
        
        if($newsletter_email_valid === true){
            $newsletter_email_address = $_POST['newsletter_email_address'];
        } else{
            $newsletter_email_address = prepare_data($_POST['newsletter_email_address']);
            $error = 'Please enter a valid email address.';
        }
        
        if($_POST['newsletter_subject'] != ''){
            $newsletter_subject = prepare_data($_POST['newsletter_subject']);
        } else{
            $error = 'Please enter a newsletter subject.';
        }
        
        if($newsletter_contact_valid === true){
            $newsletter_contact = $_POST['newsletter_contact'];
        } else{
            $newsletter_contact = prepare_data($_POST['newsletter_contact']);
            $error = 'Please enter a valid email address.';
        }
        
        if($_POST['newsletter_confirmation_body'] != ''){
            $newsletter_confirmation_body = prepare_data($_POST['newsletter_confirmation_body']);
        } else{
            $error = 'Please create a confirmation email body.';
        }
        
        if($_POST['newsletter_confirmation_subject'] != ''){
            $newsletter_confirmation_subject = prepare_data($_POST['newsletter_confirmation_subject']);
        } else{
            $error = 'Please create a confirmation subject.';
        }
        
        
        if (!$error) {
			$xml = @new SimpleXMLElement('<item></item>');
			$xml->addChild('newsletter_email_address', $newsletter_email_address);
			$xml->addChild('newsletter_subject', $newsletter_subject);
            $xml->addChild('newsletter_contact', $newsletter_contact);
            $xml->addChild('newsletter_confirmation_body', $newsletter_confirmation_body);
            $xml->addChild('newsletter_confirmation_subject', $newsletter_confirmation_subject);
			
			if (! $xml->asXML($newsletter_settings)) {
				$error = i18n_r('CHMOD_ERROR');
			} else {
				$x = getXML($newsletter_settings);
				$newsletter_email_address = $x->newsletter_email_address;
				$newsletter_subject = $x->newsletter_subject;
                $newsletter_contact = $x->newsletter_contact;
                $newsletter_confirmation_body = $x->newsletter_confirmation_body;
                $newsletter_confirmation_subject = $x->newsletter_confirmation_subject;
				$success = 'Newsletter settings updated';
			}
		}
    }
    
    if (file_exists($newsletter_settings)) {
        $x = getXML($newsletter_settings);
        $newsletter_email_address = $x->newsletter_email_address;
        $newsletter_subject = $x->newsletter_subject;
        $newsletter_contact = $x->newsletter_contact;
        $newsletter_confirmation_body = $x->newsletter_confirmation_body;
        $newsletter_confirmation_subject = $x->newsletter_confirmation_subject;
    } else {
        $newsletter_email_address = 'no-reply@'.$site_url;
        $newsletter_subject = 'Simple Newsletter';
        $newsletter_contact = 'no-reply@'.$site_url;
        $newsletter_confirmation_body = 'Please replace this text with a confirmation email body';
        $newsletter_confirmation_subject = 'Please create a confirmation email subject';
    }
    ?>
    
    <h3>Newsletter Settings</h3>
	
	<?php 
	if($success) { 
		echo '<p style="color:#669933;"><b>'. $success .'</b></p>';
	} 
	if($error) { 
		echo '<p style="color:#cc0000;"><b>'. $error .'</b></p>';
	}
	?>
    <form method="post" action="<?php echo $_SERVER ['REQUEST_URI']?>">
		<p>
            <label for="newsletter_email_address" >Newsletter Email Address</label>
            <input id="newsletter_email_address" name="newsletter_email_address" class="text" value="<?php echo $newsletter_email_address; ?>" />
        </p>
		<p>
            <label for="newsletter_subject" >Newsletter Subject</label>
            <input id="newsletter_subject" name="newsletter_subject" class="text" value="<?php echo $newsletter_subject; ?>" />
        </p>
        <p>
            <label for="newsletter_contact" >Newsletter Contact Email</label>
            <input id="newsletter_contact" name="newsletter_contact" class="text" value="<?php echo $newsletter_contact; ?>" />
        </p>
        <p>
            <label for="newsletter_confirmation_subject" >Newsletter Confirmation Subject</label>
            <input id="newsletter_confirmation_subject" name="newsletter_confirmation_subject" class="text" value="<?php echo $newsletter_confirmation_subject; ?>" />
        </p>
        <p>
            <label for="newsletter_confirmation_body" >Newsletter Confirmation Email Body</label>
            <textarea id="newsletter_confirmation_body" name="newsletter_confirmation_body"><?php echo $newsletter_confirmation_body; ?></textarea>
        </p>
		<p>
            <input type="submit" id="submit" class="submit" value="Save Settings" name="submit_newsletter_settings" />
        </p>
	</form>
    <?php
}

/**
 * Newsletter Directions
 */
function newsletter_directions(){
     echo'<h3>Newsletter Directions</h3>';
     echo'<p>Please setup an email subject, email address, confirmation email body, and contact email address to be used by the newsletter.</p>';
     echo'<p>Emails will not be sent unless there is at least one subscriber.</p>';
     echo'<p>Any saved page can be sent as a newsletter.</p>';
}

/**
 * Create Temp File
 */
function newsletter_create_temp_file($random_number,$email){
    global $newsletter_temp, $at_replacement;
    
    $email = str_replace('@',$at_replacement,$email);
    
    $fh = fopen($newsletter_temp.$email.$at_replacement.$random_number.'.xml','w');
    fclose($fh);
    
}

/**
 * Generate Random Number
 */
function generate_random_number(){
    return sha1(microtime(true).mt_rand(10000,90000));
}

/**
 * Prepare data for return to form
 */
function prepare_data($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Get All Articles
 */
function newsletter_select(){
    global $weeds, $pages, $newsletter_subscribers;
    $success = null;
    $error = null;
    $newsletter_content = null;
    
    if(isset($_POST['newsletter_send'])){
        $newsletter_content = get_page($_POST['newsletter_page']);
        if($newsletter_content != ''){
            $success = send_email($newsletter_content);
        }
    }
    if(count($newsletter_subscribers) > 0){
    ?>
    <h3>Send Newsletter</h3>
    <form method="post" action="<?php echo $_SERVER ['REQUEST_URI']?>">
    <p><strong>Page to send</strong> <select id="newsletter_page" name="newsletter_page">
    <?php
    foreach($pages as $page){
        if(substr($page,-4) === '.xml'){
            $page_name = substr($page,0,-4).'/';
        ?>
        <option value="<?php echo GSDATAPAGESPATH.$page;?>"><?php echo substr($page,0,-4);?></option>
        <?php
        }
    }
    ?>
    </select></p>
    <p>
        <input type="submit" id="newsletter_send" class="submit" value="Send Newsletter" name="newsletter_send" />
    </p>
    </form>
    <?php
    }else{
        $error = 'There are no subscribers to your newsletter.';
    }
    
    if($success) { 
		echo '<p style="color:#669933;"><b>'. $success .'</b></p>';
	} 
	if($error) { 
		echo '<p style="color:#cc0000;"><b>'. $error .'</b></p>';
	}
    
}

/**
 * Get page content from XML file
 */
function get_page($page){
    if (file_exists($page)) {
        $x = getXML($page);
        $newsletter_content = $x->content;
    }
    return $newsletter_content;
}

/**
 * Email the newsletter
 */
function send_email($page) {
    global $site_url, $newsletter_settings, $newsletter_subscribers, $newsletter_subscriptions;
    
    $page = html_entity_decode(stripslashes($page));
    
    if (file_exists($newsletter_settings)) {
        $x = getXML($newsletter_settings);
        $newsletter_email_address = $x->newsletter_email_address;
        $newsletter_subject = $x->newsletter_subject;
    } else {
        $newsletter_email_address = 'no-reply@'.$site_url;
        $newsletter_subject = 'Simple Newsletter';
    }
    
    foreach($newsletter_subscribers as $ns){
        $s = getXML($newsletter_subscriptions.$ns);
        $to = $s->subscriber_email;
        $from = $newsletter_email_address;
        $subject = $newsletter_subject;
        $html_content = $page;
        $text_content = strip_tags($page);
        $replyto = "reply-to: $newsletter_email_address";
    
        # Setup mime boundary
        $mime_boundary = 'Multipart_Boundary_x'.md5(time()).'x';
        
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\r\n";
        $headers .= "Content-Transfer-Encoding: 7bit\r\n";
        $replyto .= $replyto;
        
        $body = "This is a multi-part message in mime format.\n\n";
        
        # Add in plain text version
        $body.= "--$mime_boundary\n";
        $body.= "Content-Type: text/plain; charset=\"charset=us-ascii\"\n";
        $body.= "Content-Transfer-Encoding: 7bit\n\n";
        $body.= $text_content;
        $body.= "\n\n";
        
        # Add in HTML version
        $body.= "--$mime_boundary\n";
        $body.= "Content-Type: text/html; charset=\"UTF-8\"\n";
        $body.= "Content-Transfer-Encoding: 7bit\n\n";
        $body.= $html_content;
        $body.= "\n\n";
        
        # End email
        $body.= "--$mime_boundary--\n"; # <-- Notice trailing --, required to close email body for mime's
        
        # Finish off headers
        $headers .= "From: $from\r\n";
        $headers .= "X-Sender-IP: $_SERVER[SERVER_ADDR]\r\n";
        $headers .= 'Date: '.date('n/d/Y g:i A')."\r\n";
        $replyto .= $replyto;
        # Mail it out
        mail($to, $subject, $body, $headers);
    }
    
    return 'Newsletters emailed.';
}

/**
 * Check email address
 */
function validate_email($email){
   $isValid = true;
   $atIndex = strrpos($email, "@");
   
   if (is_bool($atIndex) && !$atIndex){
      $isValid = false;
   } else{
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64){
         // local part length exceeded
         $isValid = false;
      } else if ($domainLen < 1 || $domainLen > 255){
         // domain part length exceeded
         $isValid = false;
      } else if ($local[0] == '.' || $local[$localLen-1] == '.'){
         // local part starts or ends with '.'
         $isValid = false;
      } else if (preg_match('/\\.\\./', $local)){
         // local part has two consecutive dots
         $isValid = false;
      } else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)){
         // character not valid in domain part
         $isValid = false;
      } else if (preg_match('/\\.\\./', $domain)){
         // domain part has two consecutive dots
         $isValid = false;
      } else if(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\","",$local))){
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\","",$local))){
            $isValid = false;
         }
      }
      if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A"))){
         // domain not found in DNS
         $isValid = false;
      }
   }
   return $isValid;
}

/**
 * Front-end functions
 */
function signup_form(){
    global $at_replacement, $newsletter_subscriptions, $newsletter_settings, $ran_num;
    
    $ran_num = $_GET['ran_num'];
    $subscriber_delete = $_GET['ds'];
    
    $subscriber_email = null;
    $error = null;
    $success = null;
    
    if(isset($_POST['newsletter_signup'])){
        $subscriber_email = strtolower(prepare_data($_POST['subscriber_email']));
        $valid_email = validate_email($_POST['subscriber_email']);
        $ds = $_POST['ds'];
        
        if($valid_email === true){
            $subscriber_filename = str_replace('@',$at_replacement,$subscriber_email);
            if(!in_array($subscriber_filename,$newsletter_subscriptions)){
                //$success =  'I would send out a confirmation email.';
                $success = send_confirmation_email($subscriber_email,$ds);
            } else{
                $error = $subscriber_email.' is already subscribed to this newsletter';
            }
        } else{
            $error = 'Please enter a valid email address.';
        }
    }
    if($success) { 
		echo '<p style="color:#669933;"><b>'. $success .'</b></p>';
	} 
	if($error) { 
		echo '<p style="color:#cc0000;"><b>'. $error .'</b></p>';
	}
    if (file_exists($newsletter_settings)) {
        if($ran_num != ''){
            create_subscriber();
        }
?>
        <style type="text/css">
        #newsletter_link{
            text-align:right;
            cursor:pointer;
        }
        #simple_newsletter{
            display:none;
        }
        </style>
        <p><strong><a href="#" id="newsletter_link">Newsletter Signup</a></strong></p>
        <div id="simple_newsletter">
            <h3>Newsletter Signup</h3>
            <form name="test" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <p>
                <label for="subscriber_email"><strong>Email Address:</strong></label>&nbsp;
                <input type="text" id="subscriber_email" name="subscriber_email" value="<?php echo $subscriber_email; ?>"/>
            </p>
            <p>
                <label for="ds"><strong>Unsubscribe Above Email:</strong></label>&nbsp;
                <input style="vertical-align:middle;" type="checkbox" id="ds" name="ds" value="yds"/>&nbsp;
            </p>
                <input type="submit" class="submit" name="newsletter_signup" value="Send Request"/>
            </p>
            </form>
        </div>
        <script type="text/javascript">
        $(document).ready(function(){
           $('#newsletter_link').click(function(){
                $('#simple_newsletter').toggle();
                return false;
           });
        });
        </script>
<?php
    }
}

/**
 * Send Confirmation Email
 */
function send_confirmation_email($to,$ds){
    global $site_url, $newsletter_settings, $website;
    
    $trailing_slash = substr($website,-1);
    
    if($trailing_slash != '/'){
        $website = $website.'/';
    }
    
    $random_number = generate_random_number();
    
    newsletter_create_temp_file($random_number,$to);
    
    if($ds === 'yds'){
        $x = getXML($newsletter_settings);
        $from = $x->newsletter_email_address;
        $subject = 'Unsubscribe '.$x->newsletter_confirmation_subject;
        $newsletter_contact = $x->newsletter_contact;
        $unsubscribe_body = 'Click the link below to unsubscribe.'."\n\n";
        $unsubscribe_body .= $website.'index.php?ds=yds&confirmation='.$to.'&ran_num='.$random_number."\n\n".$newsletter_contact;
        //$newsletter_confirmation_body = $x->newsletter_confirmation_body."\n\n".$website.'index.php?confirmation='.$to.'&ran_num='.$random_number."\n\n".$newsletter_contact;
    
        $html_content = '<p>'.str_replace("\n\n",'<br/><br/>',$unsubscribe_body).'</p>';
        $text_content = strip_tags($newsletter_confirmation_body);
        $replyto = "reply-to: $newsletter_contact";
        
    }else{
        $x = getXML($newsletter_settings);
        $from = $x->newsletter_email_address;
        $subject = $x->newsletter_confirmation_subject;
        $newsletter_contact = $x->newsletter_contact;
        $newsletter_confirmation_body = $x->newsletter_confirmation_body."\n\n".$website.'index.php?confirmation='.$to.'&ran_num='.$random_number."\n\n".$newsletter_contact;
    
        $html_content = '<p>'.str_replace("\n\n",'<br/><br/>',$newsletter_confirmation_body).'</p>';
        $text_content = strip_tags($newsletter_confirmation_body);
        $replyto = "reply-to: $newsletter_contact";
    }
    
    # Setup mime boundary
    $mime_boundary = 'Multipart_Boundary_x'.md5(time()).'x';
    
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\r\n";
    $headers .= "Content-Transfer-Encoding: 7bit\r\n";
    $replyto .= $replyto;
    
    $body = "This is a multi-part message in mime format.\n\n";
    
    # Add in plain text version
    $body.= "--$mime_boundary\n";
    $body.= "Content-Type: text/plain; charset=\"charset=us-ascii\"\n";
    $body.= "Content-Transfer-Encoding: 7bit\n\n";
    $body.= $text_content;
    $body.= "\n\n";
    
    # Add in HTML version
    $body.= "--$mime_boundary\n";
    $body.= "Content-Type: text/html; charset=\"UTF-8\"\n";
    $body.= "Content-Transfer-Encoding: 7bit\n\n";
    $body.= $html_content;
    $body.= "\n\n";
    
    # End email
    $body.= "--$mime_boundary--\n"; # <-- Notice trailing --, required to close email body for mime's
    
    # Finish off headers
    $headers .= "From: $from\r\n";
    $headers .= "X-Sender-IP: $_SERVER[SERVER_ADDR]\r\n";
    $headers .= 'Date: '.date('n/d/Y g:i A')."\r\n";
    $replyto .= $replyto;
    # Mail it out
    mail($to, $subject, $body, $headers);


}
/**
 * Create newsletter account
 * Also handles unsubscribe
 */
function create_subscriber(){
    global $newsletter_temp, $newsletter_subscriptions, $ran_num, $at_replacement,$ds;
    
    $error = null;
    $success = null;
    
    $random_number = $_GET['ran_num'];
    $subscriber_email = $_GET['confirmation'];
    $ds = $_GET['ds'];
    
    $email_replacement = str_replace('@',$at_replacement,$subscriber_email);
    
    if($ds === 'yds'){
        if(file_exists($newsletter_subscriptions.$email_replacement.'.xml')){
            unlink($newsletter_subscriptions.$email_replacement.'.xml');
            $success = $subscriber_email.' was successfully unsubscribed.';
        }
    } else if(file_exists($newsletter_temp.$email_replacement.$at_replacement.$random_number.'.xml')){
        
        if(!file_exists($newsletter_subscriptions.$email_replacement.'.xml')){
        
            $xml = @new SimpleXMLElement('<item></item>');
            $xml->addChild('subscriber_email', $subscriber_email);
		
            if (! $xml->asXML($newsletter_subscriptions.$email_replacement.'.xml')) {
                $error = i18n_r('CHMOD_ERROR');
            } else {
                $x = getXML($newsletter_subscriptions.$email_replacement.'.xml');
                $subscriber_email = $x->subscriber_email;
                $success =  'Newsletter Subscription Confirmed';
            }
        } else{
            $error = $subscriber_email.' is already subscribed to the newsletter.';
        }
    }
    if($success) { 
        echo '<p style="color:#669933;"><b>'. $success .'</b></p>';
    } 
    if($error) { 
        echo '<p style="color:#cc0000;"><b>'. $error .'</b></p>';
    }
}
?>