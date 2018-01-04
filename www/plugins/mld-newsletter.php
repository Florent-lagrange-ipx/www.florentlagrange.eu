<?php
/****************************************************
 *
 * @File: 	mld-newsletter.php
 * @Package:	MLD Newsletter
 * @Subject:	Main plugin file
 * @Date:	2 February 2012
 * @Revision:	30 May 2012
 * @Version:	0.8
 * @Status:	Beta
 * @Author:	Leen Moerland (www.leenmoerland.com)
 *
 * Changelog v0.3:
 * - added backwards compatibility for GS3.0
 * - changed back to Swiftmailer class for better email handling
 *
 * Changelog v0.4
 * - No newsletter send if email address not confirmed.
 * - Create new newsletter button works now.
 * - Added data handling class
 * - Create new data files when not present
 * - fixed issue with slashes in encoding (thanks to luis)
 * - include configration.php for GSVERSION check
 * 
 * Changelog v0.5
 * - Fixed bug in url construction (thanks to luis)
 * - Fixed bug in subscription procedure (thanks to luis)
 * - Fixed bug in saving email_confirm (thanks to luis)
 * - Fixed bug deleting letters
 * - Fixed bug saving send status
 * - Catch exeption when sending email
 * - added frontend newsletter archive functionality
 * 
 * Changelog v0.6
 * - Added filters for use in content
 * - Added option to send admin email to site admin
 * - Hide send to subscribers button when already send
 * 
 * Changelog v0.7
 * - Fixed minor bugs due to lack of testing the script
 * - Prevent the script from running twice
 * - Subscribeform result didn't show [FIXED]
 * - Required settings indicator [ADDED]
 * 
 * Changelog v0.8
 * - AntiFlood plugin swiftmailer to prevent flooding of the SMTP server [ADD]
 * - Bug in subscribe function [FIXED]
 * - csv import names and email [ADD]
 * - Bug in template footer image [TODO]
*****************************************************/

// get correct id for plugin
$thisfile = basename(__FILE__, ".php");

// plugin registration
register_plugin(
    $thisfile, 
    'MLD Newsletter', 
    '0.7', 
    'Leen Moerland', 
    'http://www.leenmoerland.com/', 
    'Newsletter plugin for GS', 
    'mld-newsletter', 
    'newsletters'
);

//include config file if not present - since 0.4
if (file_exists(GSADMININCPATH . 'configuration.php')) {
    include_once GSADMININCPATH . 'configuration.php';
}

// add backwards compatibility - since 0.3
if (GSVERSION == 3.0) {
    include GSPLUGINPATH . 'mld-newsletter/compatibility.php';
}

// language support
i18n_merge('mld-newsletter') || i18n_merge('mld-newsletter', 'en_US');

//style support
if (GSVERSION > 3.0) {
    register_style('mld-newsletter-backstyle', $SITEURL . 'plugins/' . $thisfile . '/css/backstyle.css', '0.2', 'all');
    register_style('mld-newsletter-frontstyle', $SITEURL . 'plugins/' . $thisfile . '/css/frontstyle.css', '0.2', 'all');
    queue_style('mld-newsletter-backstyle', GSBACK);
    queue_style('mld-newsletter-frontstyle', GSFRONT);
} else {
    add_action('theme-header', 'addStyleBC', array(GSPLUGINPATH . 'mld-newsletter/css/frontstyle.css'));
    add_action('header', 'addStyleBC', array(GSPLUGINPATH . 'mld-newsletter/css/backstyle.css'));
}

//set the right function - since 0.3
$createNavTabFunction = 'createNavTab';
$createSideMenuFunction = 'createSideMenu';
if (GSVERSION == 3.0) {
    $createNavTabFunction = 'createNavTabBC';
    $createSideMenuFunction = 'createSideMenuBC';
}

//add actions
add_action('nav-tab', $createNavTabFunction, array('mld-newsletter', $thisfile, i18n_r('mld-newsletter/PLUGINNAME'), 'newsletters'));
add_action($thisfile . '-sidebar', $createSideMenuFunction, array($thisfile, i18n_r('mld-newsletter/MANAGELETTERS'), 'newsletters'));
add_action($thisfile . '-sidebar', $createSideMenuFunction, array($thisfile, i18n_r('mld-newsletter/MANAGESUBSCRIBERS'), 'subscribers'));
add_action($thisfile . '-sidebar', $createSideMenuFunction, array($thisfile, i18n_r('mld-newsletter/SETTINGS'), 'settings'));
add_action($thisfile . '-sidebar', $createSideMenuFunction, array($thisfile, i18n_r('mld-newsletter/EDITLETTER'), 'editletter', false));
add_action($thisfile . '-sidebar', $createSideMenuFunction, array($thisfile, i18n_r('mld-newsletter/VIEWLETTER'), 'viewletter', false));
add_filter('content', 'mld_newsletter_parse');

//include data class - since 0.4
require GSPLUGINPATH . 'mld-newsletter/mldnewsletter.class.php';

/**
 * This function handles the request.
 * 
 */
function newsletters() {
    if (isset($_GET['settings'])) {
        newsletter_settings();
    } elseif (isset($_GET['subscribers'])) {
        manage_subscribers();
    } elseif (isset($_GET['editletter'])) {
        edit_letter($_GET['editletter']);
    } elseif (isset($_GET['viewletter'])) {
        view_letter($_GET['viewletter']);
    } else {
        manage_newsletters();
    }
}

/**
 * This function handles the output filtering
 * 
 * @since 0.6
 * @param string $contents
 * @return string contents 
 */
function mld_newsletter_parse($contents) {
    //replace form
    $pattern = '`(?<!<code>)\(%\s*mldsubscribeform\s*(.*)\s*%\)`';
    $contents = preg_replace($pattern, mldNewsletterForm(true), $contents);
    
    //replace archive
    $pattern = '`(?<!<code>)\(%\s*mldnewsletterarchive\s*(.*)\s*%\)`';
    $contents = preg_replace($pattern, mldShowNewsletters(true), $contents);
    return $contents;
}

/**
 * This function displays the main screen.
 * 
 */
function manage_newsletters() {
    $mld = MLDnewsletter::getInstance();
    $url = $_SERVER['SCRIPT_NAME'] . "?id=mld-newsletter";

    if (isset($_GET['delete'])) {
        $msg = remove_letter($_GET['delete']);
        display_message($msg[0], $msg[1]);
    }
    $xml = $mld->getXmlData('newsletters');
?>
        <h3><?php i18n('mld-newsletter/MANAGELETTERS'); ?></h3>
        <div class="edit-nav" ><p><a href="<?php echo $url; ?>&editletter=<new>"><?php i18n('mld-newsletter/NEWLETTER'); ?></a></p></div>
        <table id="newsletters" class="edittable highlight">
    		<tr>
               	<th><?php i18n('mld-newsletter/LETTERTITLE'); ?></th>
                <th><?php i18n('mld-newsletter/ALREADYSEND'); ?></th>
                <th></th>
                <th></th>
            </tr>
    <?php
    foreach ($xml as $letter) {
        echo '<tr><td><a href="' . $url . '&editletter=' . $letter->id . '">' . $letter->title . '</a></td>';
        if ($letter->send == 'true') {
            $status = 'true';
        } else {
            $status = 'false';
        }
        echo '<td><img alt="" src="../plugins/mld-newsletter/images/' . $status . '.png" /></td>';
        echo '<td class="secondarylink"><a href="' . $url . '&viewletter=' . $letter->id . '">#</a></td>';
        echo '<td class="delete"><a href="' . $_SERVER['REQUEST_URI'] . '&delete=' . $letter->id . '">×</a></td></tr>';
    }
    ?> 
    	</table>
    <?php
	
}

/**
 * Shows preview of newsletter.
 *
 * @param string $letterid id of requested newsletter
 */
function view_letter($letterid) {
    $mld = MLDnewsletter::getInstance();
    $xml = $mld->getXmlData('newsletters');
    $url = $_SERVER['SCRIPT_NAME'] . '?id=mld-newsletter&viewletter=' . $letterid;
    
    foreach ($xml as $letter) {
        if ((string) $letter->id == $letterid) {
            $lettertitle = $letter->title;
            $lettercontent = $letter->content;
            $alreadysend = $letter->send;
            break;
        }
    }
    $sxml = $mld->getXmlData('settings');
    $theader = $sxml->theader;
    $tfooter = $sxml->tfooter;
    //$letterhtml = htmldecode($theader.$lettercontent.$tfooter);
    $letterhtml = stripslashes(htmldecode($theader . $lettercontent . $tfooter));
    $senderEmail = $sxml->semail;
    $senderName = $sxml->sname;

    if (isset($_GET['testsend'])) {
        //grab site email if needed
        if($sxml->usesitemail == 'true') {
            $semail = '';
            if (isset($_COOKIE['GS_ADMIN_USERNAME'])) {
                $cookie_user_id = _id($_COOKIE['GS_ADMIN_USERNAME']);
		if (file_exists(GSUSERSPATH . $cookie_user_id.'.xml')) {
                    $datau = getXML(GSUSERSPATH  . $cookie_user_id.'.xml');
                    $USR = stripslashes($datau->USR);
                    $file = _id($USR) .'.xml';
                    $data  = getXML(GSUSERSPATH . $file);
                    $semail =(string) $data->EMAIL;
		}
            }
            if($semail == '') {                
                display_message('error', i18n_r('mld-newsletter/SITEMAILNOTFOUND'));
                break 3;
            }
        } else {            
            $semail = $senderEmail;
        }
        $result = send_email($semail, $senderName, $lettertitle, $letterhtml);
        display_message($result[0], $result[1]);
    }
    if (isset($_GET['sendindeed'])) {

        $subscriberslist = array();
        $subscribersxml = getXML(GSDATAOTHERPATH . 'mld-newsletter/mld-newsletter-subscribers.xml');
        foreach ($subscribersxml as $subscriber) {
            $subscriberslist[(string) $subscriber->email] = $subscriber->name;
        }

        $result = send_email($subscriberslist, "", $lettertitle, $letterhtml, true);
        display_message($result[0], $result[1]);

        if ($result[0] == 'updated') {
            $xml = $mld->getXmlData('newsletters');
            foreach ($xml as $entry) {
                if ((string) $entry->id == $letterid) {
                    $entry->send = 'true';
                    XMLsave($xml, $mld->files['newsletters']);
                }
            }
        }
    }
    ?>
    <h3><?php i18n('mld-newsletter/VIEWLETTER'); ?>: <?php echo $lettertitle; ?></h3>
    <div class="edit-nav mldeditnav">
    <p><a href="<?php echo $url.'&testsend'; ?>"><?php i18n('mld-newsletter/TESTSEND'); ?></a>
    <?php if($alreadysend == 'true'): ?>
        <p class="mldalreadysendmessage"><?php i18n('mld-newsletter/BUTTONSENDHIDE'); ?></p>
    <?php else: ?>
        <a href="<?php echo $url.'&send'; ?>"><?php i18n('mld-newsletter/SEND'); ?></a>
    <?php endif; ?>
    </p></div>
    <?php
	if(isset($_GET['send'])) {
	echo '<p class="mldwarning">'.i18n_r('mld-newsletter/SENDWARNING');
	echo ' <a href="'.$url.'&sendindeed" class="cancel">'.i18n_r('YES').'</a>';
	echo ' <a href="'.$url.'" class="cancel">'.i18n_r('NO').'</a></p>';
	}
	?>
    <div id="mldpreview">
    <?php echo $letterhtml; ?>
    </div>            
    <?php			
}

/**
 * Removes the newsletter.
 *
 * @param string $id newsletter id
 * @return array with message
 */
function remove_letter($id) {
    $mld = MLDnewsletter::getInstance();
    $xml = $mld->getXmlData('newsletters');
    foreach ($xml as $entry) {
        if ($entry->id == $id) {
            $dom = dom_import_simplexml($entry);
            $dom->parentNode->removeChild($dom);
            break;
        }
    }
    if (XMLsave($xml, $mld->files['newsletters'])) {
        $msg = array('updated', i18n_r('mld-newsletter/DELETESUCCES'));
    } else {
        $msg = array('error', i18n_r('mld-newsletter/DELETEFAIL'));
    }
    return $msg;
}

/**
 * Shows the edit form.
 *
 * @global $HTMLEDITOR
 * @global $TEMPLATE
 * @global $SITEURL
 * @param string $letterid newsletter id
 */
function edit_letter($letterid = '') {
    $mld = MLDnewsletter::getInstance();
    global $HTMLEDITOR, $SITEURL;
    if ($letterid == '')
        $letterid = '<new>';
    $xml = $mld->getXmlData('newsletters');

    if (isset($_POST['saveletter']) && ($letterid != '<new>')) {
        remove_letter($letterid);
    }

    if (isset($_POST['saveletter'])) {
        $letterid = (string) uniqid();
        $thisletter = $xml->addChild('letter');
        $newletter = $thisletter->addChild('title');
        $newletter->addCData($_POST['newsletter']['title']);
        $thisletter->addChild('id', $letterid);
        $thisletter->addChild('send', $_POST['newsletter']['alreadysend']);
        $newletter = $thisletter->addChild('content');
        $newletter->addCdata(htmlentities($_POST['newsletter']['content'], ENT_QUOTES, 'UTF-8'));
        if (XMLsave($xml, $mld->files['newsletters'])) {
            display_message('updated', i18n_r('mld-newsletter/LETTERSAVED'));
        } else {
            display_message('error', i18n_r('mldnewsletter/LETTERSAVEFAIL'));
        }
    }

    $xml = $mld->getXmlData('newsletters');
    $lettertitle = '';
    $lettersend = '';
    $lettercontent = '';

    if ($letterid != '<new>') {
        foreach ($xml as $letter) {
            if (((string) $letter->id) == $letterid) {
                $lettertitle = $letter->title;
                $lettersend = $letter->send;
                //$lettercontent = htmldecode($letter->content);
                $lettercontent = stripslashes(htmldecode($letter->content));
                break;
            }
        }
    } else {
        $lettertitle = "<new>";
    }
    $alreadysend = ($letterid == '<new>') ? 'false' : $lettersend;

    //show editform

    if ($HTMLEDITOR != '') {
        if (defined('GSEDITORHEIGHT')) {
            $EDHEIGHT = GSEDITORHEIGHT . 'px';
        } else {
            $EDHEIGHT = '500px';
        }
        if (defined('GSEDITORLANG')) {
            $EDLANG = GSEDITORLANG;
        } else {
            $EDLANG = 'en';
        }
    }
    ?>
    <h3><?php i18n('mld-newsletter/EDITLETTER'); ?></h3>
        <div class="edit-nav" ><p><a href="<?php echo $_SERVER['SCRIPT_NAME'] . '?id=mld-newsletter&viewletter=' . $letterid; ?>"><?php i18n('mld-newsletter/VIEWLETTER'); ?></a></p></div>
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" class="mldeditform">
            <p><label class="mldlabel"><?php i18n('mld-newsletter/LETTERTITLE'); ?>:</label>
                <input type="text" class="text" name="newsletter[title]" value="<?php echo $lettertitle; ?>" /></p>
            <input type="hidden" name="newsletter[alreadysend]" value="<?php echo $alreadysend; ?>" />
                    <!--<p><label class="mldlabel"><?php i18n('mld-newsletter/ALREADYSEND'); ?>: <?php echo $lettersend; ?></label></p>-->
            <p><textarea id="newsletter-content" name="newsletter[content]"><?php echo $lettercontent; ?></textarea></p>
            <p><input type="submit" class="submit" value="<?php i18n('mld-newsletter/SAVELETTER'); ?>" id="saveletter" name="saveletter" /></p>
        </form>
        <script type="text/javascript" src="template/js/ckeditor/ckeditor.js"></script>
        <script type="text/javascript">
            var editor = CKEDITOR.replace( 'newsletter-content', {
                skin : 'getsimple',
                forcePasteAsPlainText : true,
                language : '<?php echo $EDLANG; ?>',
                defaultLanguage : '<?php echo $EDLANG; ?>',
                entities : false,
                uiColor : '#FFFFFF',
                height: '<?php echo $EDHEIGHT; ?>',
                baseHref : '<?php echo $SITEURL; ?>',
                toolbar : [['Bold','Italic','Underline','JustifyLeft','JustifyCenter','JustifyRight','Table','TextColor','Link',
                        'Unlink','Image','Font','FontSize','Source']],
                filebrowserBrowseUrl : 'filebrowser.php?type=all',
                filebrowserImageBrowseUrl : 'filebrowser.php?type=images',
                filebrowserWindowWidth : '730',
                filebrowserWindowHeight : '500'
            });
        </script>
	<?php
}

/**
* Shows the manage subscribers form
*
*/
function manage_subscribers() {
    global $SITEURL;
    global $EDLANG;
    
    $mld = MLDnewsletter::getInstance();    
    if (isset($_POST['adminsubscribe'])) {
        $result = subscribe($_POST['subscriber']['name'], $_POST['subscriber']['email'], false);
        display_message($result[0], $result[1]);
    } elseif (isset($_POST['unsubscribe'])) {
        $result = unsubscribe($_POST['subscriber']['email']);
        display_message($result[0], $result[1]);
    } elseif (isset($_GET['remove'])) {
        $result = unsubscribe($_GET['remove']);
        display_message($result[0], $result[1]);
    }
?>
    <h3 class="floated"><?php i18n('mld-newsletter/MANAGESUBSCRIBERS'); ?></h3>
    <?php $style = (isset($_POST['importcsv_submit'])) ? '' : 'display:none;'; ?>
    <div class="edit-nav clearfix">
        <a id="importcsv" href="#" <?php if($style == '') { echo 'class="current"'; } ?>><?php i18n('mld-newsletter/IMPORTCSV'); ?></a>      
    </div>    
    <div id="importcsv-form" style="<?php echo $style; ?>">
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
            <input type="text" id="import_file" name="import_file" class="text" />
            <input type="button" class="submit" id="importcsv_browse" name="importcsv_browse" value="<?php i18n('mld-newsletter/BROWSE'); ?>" />
            
            <script type="text/javascript">
                $(function() { 
                    $('#importcsv_browse').click(function(e) {
                        e.preventDefault();
                        window.open('<?php echo $SITEURL; ?>admin/filebrowser.php?type=all&CKEditorFuncNum=0&langCode=en&returnid=import_file', 'importcsv_browse_window', 'width=750,height=500');
                    });
                });
            </script>
            
            <br /><br />
            <input type="submit" class="submit" id="importcsv_submit" name="importcsv_submit" value="<?php i18n('mld-newsletter/IMPORT'); ?>" style="margin-right: 4px;"/>
            <?php i18n('mld-newsletter/OR'); ?>
            <a class="cancel" href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?id=mld-newsletter&subscribers"><?php i18n('ASK_CANCEL'); ?></a>
        </form>
              
        <script type="text/javascript">
            $('#importcsv').live("click", function($e) {
                $e.preventDefault();
                $("#importcsv-form").slideToggle();
                $(this).toggleClass('current');
            });
            $("#importcsv-form .cancel").live("click", function($e) {
                $e.preventDefault();
                $("#importcsv-form").slideUp();
                $('#importcsv').toggleClass('current');
            });
        </script>                
        
        <?php if(isset($_POST['importcsv_submit']) && file_exists('../data/uploads/'.pathinfo($_POST['import_file'], PATHINFO_BASENAME))): ?>
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
            <input type="hidden" name="csvfile" value="<?php echo $_POST['import_file']; ?>" />
            <table>
                <caption><?php i18n('mld-newsletter/TH_CSV_DESC'); ?></caption>
                <tr>
                    <th><?php i18n('mld-newsletter/TH_COLUMN'); ?></th>
                    <th><?php i18n('mld-newsletter/TH_DATAFIRSTROW'); ?></th>
                    <th><?php i18n('mld-newsletter/TH_DATASECONDROW'); ?></th>
                    <th><?php i18n('mld-newsletter/TH_ISNAME'); ?></th>
                    <th><?php i18n('mld-newsletter/TH_ISEMAIL'); ?></th>
                </tr>

                <?php            
                $row = array();
                if (($handle = fopen($_POST['import_file'], "r")) !== FALSE) {
                    $i = 1;
                    while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
                        $row[$i] = $data;                    
                        if($i >= 2) { break; }
                        $i++;
                    }
                    fclose($handle);                       
                    for ($c = 0; $c < count($row[1]); $c++) {
                        echo '<tr><td>'.(string) $c.'</td>';
                        echo '<td>'.$row[1][$c].'</td>';
                        echo '<td>'.$row[2][$c].'</td>';
                        echo '<td><input type="radio" name="isname" value="'.(string) $c.'" /></td>';
                        echo '<td><input type="radio" name="isemail" value="'.(string) $c.'" /></td></tr>';
                    }                
                } else {
                    display_message('error', i18n_r('mld-newsletter/IMPORTFILE_PROBLEM'));
                }
                ?>

            </table>            
            <input type="submit" class="submit" name="importcsv_final" value="<?php i18n('mld-newsletter/IMPORT'); ?>" />
        </form>
        <?php endif; ?>
        <?php
        if(isset($_POST['import_file']) && !file_exists('../data/uploads/'.pathinfo($_POST['import_file'], PATHINFO_BASENAME))) {
            display_message('error', i18n_r('mld-newsletter/IMPORTFILE_PROBLEM'));
        }
        if(isset($_POST['importcsv_final'])) {
            //import csv addresses            
            $col_name = (int) $_POST['isname'];
            $col_email = (int) $_POST['isemail'];
            $result = array();
            if (($handle = fopen($_POST['csvfile'], "r")) !== FALSE) {
                    while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {                                                                                  
                        $result[] = subscribe($data[$col_name], $data[$col_email], false);                        
                    }
                    fclose($handle);                                          
                } else {
                    display_message('error', i18n_r('mld-newsletter/IMPORTFILE_PROBLEM'));
                }            
        }
        
        ?>
        
        <hr style="margin-top: 10px;"/>
    </div>    
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" class="mldsubscribersform" >
        <p><label class="mldlabel"><?php i18n('mld-newsletter/NAME'); ?>:</label>
            <input type="text" class="text" name="subscriber[name]" value=""/></p>        
        <p><label class="mldlabel"><?php i18n('mld-newsletter/EMAIL'); ?>:</label>
            <input type="text" class="text" name="subscriber[email]" value=""/></p>
        <p><input type="submit" class="submit" value="<?php i18n('mld-newsletter/SUBSCRIBE'); ?>" id="adminsubscribe" name="adminsubscribe" />
            <input type="submit" class="submit" value="<?php i18n('mld-newsletter/UNSUBSCRIBE'); ?>" id="unsubscribe" name="unsubscribe" /></p>
    </form><br />

    <table id="subscribers" class="edittable highlight">
        <tr>
            <th><?php i18n('mld-newsletter/NAME'); ?></th>
            <th><?php i18n('mld-newsletter/EMAIL'); ?></th>
            <th><?php i18n('mld-newsletter/STATUS'); ?></th>
            <th></th>
        </tr>
<?php
    //get data
    $xml = $mld->getXmlData('subscribers');
    foreach ($xml as $entry) {
        echo '<tr><td>' . $entry->name . '</td>';
        echo '<td>' . $entry->email . '</td>';
        if ($entry->status == 'true') {
            $status = 'true';
        } else {
            $status = 'false';
        }
        echo '<td><img alt="" src="../plugins/mld-newsletter/images/' . $status . '.png" /></td>';
        echo '<td class="delete"><a href="' . $_SERVER['REQUEST_URI'] . '&remove=' . $entry->email . '">×</a></td></tr>';
    }
    ?>
    </table>
<?php
}

/**
* Shows the edit settings form.
*
* @global $HTMLEDITOR
* @global $SITEURL
*/
function newsletter_settings() {
    $mld = MLDnewsletter::getInstance();
    global $HTMLEDITOR, $SITEURL;

    //save data if submitted	
    if (isset($_POST['savesettings'])) {

        //print_r($_POST);		
        if (isset($_POST['settings']['smtpauth']) && $_POST['settings']['smtpauth'] == 'on') {
            $SMTPAUTH2 = 'true';
        } else {
            $SMTPAUTH2 = 'false';
        }
        if (isset($_POST['settings']['usesitemail']) && $_POST['settings']['usesitemail'] == 'on') {
            $USESITEMAIL2 = 'true';
        } else {
            $USESITEMAIL2 = 'false';
        }
        $xmls = new SimpleXMLExtended('<settings></settings>');
        $note = $xmls->addChild('sname');
        $note->addCData($_POST['settings']['sname']);
        $note = $xmls->addChild('semail');
        $note->addCData($_POST['settings']['semail']);
        $note = $xmls->addChild('usesitemail', $USESITEMAIL2);
        $note = $xmls->addChild('smtpserver', $_POST['settings']['smtpserver']);
        $note = $xmls->addChild('smtpport', (int) $_POST['settings']['smtpport']);
        $note = $xmls->addChild('smtpauth', $SMTPAUTH2);
        $note = $xmls->addChild('smtpsecure', $_POST['settings']['smtpsecure']);
        $note = $xmls->addChild('smtpauthname', $_POST['settings']['smtpauthname']);
        $note = $xmls->addChild('smtpauthpw', $_POST['settings']['smtpauthpw']);
        $note = $xmls->addChild('theader');
        $note->addCData(htmlentities($_POST['settings']['theader'], ENT_QUOTES, 'UTF-8'));
        $note = $xmls->addChild('tfooter');
        $note->addCData(htmlentities($_POST['settings']['tfooter'], ENT_QUOTES, 'UTF-8'));


        if (!XMLsave($xmls, $mld->files['settings'])) {
            $msg = array('error', i18n_r('mld-newsletter/SAVEFAIL'));
        } else {
            $msg = array('updated', i18n_r('mld-newsletter/SAVESUCCESS'));
        }
    }

    //get data from settingsfile
    $data = $mld->getXmlData('settings');
    $SENDERNAME = $data->sname;
    $SENDEREMAIL = $data->semail;
    $USESITEMAIL = ($data->usesitemail == 'true') ? 'checked' : '';
    $SMTPSERVER = $data->smtpserver;
    $SMTPPORT = $data->smtpport;
    $SMTPAUTH = ($data->smtpauth == 'true') ? 'checked' : '';
    $SMTPSECURE = $data->smtpsecure;
    $SMTPAUTHNAME = $data->smtpauthname;
    $SMTPAUTHPW = $data->smtpauthpw;    
    $TEMPLATEHEADER = stripslashes(htmldecode($data->theader));
    $TEMPLATEFOOTER = stripslashes(htmldecode($data->tfooter));

    //show message
    if (isset($msg)) {
        display_message($msg[0], $msg[1]);
    }

    if ($HTMLEDITOR != '') {
        if (defined('GSEDITORLANG')) {
            $EDLANG = GSEDITORLANG;
        } else {
            $EDLANG = 'en';
        }
    }
    ?>
    <h3><?php i18n('mld-newsletter/SETTINGS'); ?></h3>
    <p><?php i18n('mld-newsletter/REQUIREDFIELDS'); ?></p>
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" class="mldsettingsform" >
    <div class="leftsec">    
        <p><label class="mldlabel"><?php i18n('mld-newsletter/SENDERNAME'); ?>: *</label>
            <input type="text" class="text" name="settings[sname]" value="<?php echo $SENDERNAME; ?>"/></p>
    </div><div class="rightsec">
            <p><label class="mldlabel"><?php i18n('mld-newsletter/SENDEREMAIL'); ?>: *</label>
            <input type="text" class="text" name="settings[semail]" value="<?php echo $SENDEREMAIL; ?>"/></p>
    </div><div class="clear"></div>
        <p class="inline"><input type="checkbox" name="settings[usesitemail]" <?php echo $USESITEMAIL; ?> />
        <label class="mldlabel">&nbsp;<?php i18n('mld-newsletter/USESITEMAIL'); ?></label></p>    
    <h3><?php i18n('mld-newsletter/SMTPSETTINGS'); ?></h3>
    <div class="leftsec">
        <p><label class="mldlabel"><?php i18n('mld-newsletter/SMTPSERVER'); ?>: *</label>
        <input type="text" class="text" name="settings[smtpserver]" value="<?php echo $SMTPSERVER; ?>"/></p>
    </div><div class="rightsec">
        <p><label class="mldlabel"><?php i18n('mld-newsletter/SMTPPORT'); ?>: *</label>
        <input type="text" class="text" name="settings[smtpport]" value="<?php echo $SMTPPORT; ?>"/></p>
    </div><div class="clear"></div>
    <div class="leftsec">
            <p class="inline"><input type="checkbox" name="settings[smtpauth]" <?php echo $SMTPAUTH; ?> />
        <label class="mldlabel">&nbsp;<?php i18n('mld-newsletter/SMTPAUTH'); ?></label></p>
    </div><div class="rightsec">
        <p><label class="mldlabel"><?php i18n('mld-newsletter/SMTPSECURE'); ?>:</label>
        <input type="text" class="text" name="settings[smtpsecure]" value="<?php echo $SMTPSECURE; ?>"/></p>
    </div><div class="clear"></div>
    <div class="leftsec">
        <p><label class="mldlabel"><?php i18n('mld-newsletter/SMTPAUTHNAME'); ?>:</label>
        <input type="text" class="text" name="settings[smtpauthname]" value="<?php echo $SMTPAUTHNAME; ?>"/></p>
    </div><div class="rightsec">
        <p><label class="mldlabel"><?php i18n('mld-newsletter/SMTPAUTHPW'); ?>:</label>
        <input type="password" class="text" name="settings[smtpauthpw]" value="<?php echo $SMTPAUTHPW; ?>"/></p>
    </div><div class="clear"></div>
    <h3><?php i18n('mld-newsletter/TEMPLATESETTINGS'); ?></h3>
        <p><label class="mldlabel"><?php i18n('mld-newsletter/TEMPLATEHEADER'); ?>:</label>
        <textarea class="mldtemplatepart" name="settings[theader]"><?php echo $TEMPLATEHEADER; ?></textarea></p>
        <p><label class="mldlabel"><?php i18n('mld-newsletter/TEMPLATEFOOTER'); ?>:</label>
        <textarea class="mldtemplatepart" name="settings[tfooter]"><?php echo $TEMPLATEFOOTER; ?></textarea></p>
        <p><input type="submit" class="submit" value="<?php i18n('mld-newsletter/SAVE_SETTINGS'); ?>" id="savesettings" name="savesettings" /></p>
    </form>
    <script type="text/javascript" src="template/js/ckeditor/ckeditor.js"></script>
            <script type="text/javascript">
                    //<![CDATA[
                    var editor = CKEDITOR.replace( 'settings[theader]', {
                    skin : 'getsimple',
                    forcePasteAsPlainText : true,
                    language : '<?php echo $EDLANG; ?>',
                    defaultLanguage : '<?php echo $EDLANG; ?>',
                    entities : true,
                    uiColor : '#FFFFFF',
                    height: '250px',
                    baseHref : '<?php echo $SITEURL; ?>',
                    toolbar : [['Bold','Italic','Underline','JustifyLeft','JustifyCenter','JustifyRight','Table','TextColor','Link',
                            'Unlink','Image','Font','FontSize','Source']],
                    filebrowserBrowseUrl : 'filebrowser.php?type=all',
                    filebrowserImageBrowseUrl : 'filebrowser.php?type=images',
                    filebrowserWindowWidth : '730',
                    filebrowserWindowHeight : '500'
                    });
                    //]]>
            </script>
            <script type="text/javascript">
                    //<![CDATA[
                    var editor = CKEDITOR.replace( 'settings[tfooter]', {
                    skin : 'getsimple',
                    forcePasteAsPlainText : true,
                    language : '<?php echo $EDLANG; ?>',
                    defaultLanguage : '<?php echo $EDLANG; ?>',
                    entities : true,
                    uiColor : '#FFFFFF',
                    height: '250px',
                    baseHref : '<?php echo $SITEURL; ?>',
                    toolbar : [['Bold','Italic','Underline','JustifyLeft','JustifyCenter','JustifyRight','Table','TextColor','Link',
                            'Unlink','Image','Font','FontSize','Source']],
                    filebrowserBrowseUrl : 'filebrowser.php?type=all',
                    filebrowserImageBrowseUrl : 'filebrowser.php?type=images',
                    filebrowserWindowWidth : '730',
                    filebrowserWindowHeight : '500'
                    });
                    //]]>
            </script>

<?php
}

/**
 * Function to show subscribeform on frontpage
 *
 */
function mldNewsletterForm($buffer = false) {
    global $result;
    if (isset($_POST['subscribe'])) {
        $result = subscribe($_POST['subscriber']['name'], $_POST['subscriber']['email'], true);
        unset($_POST['subscribe']);
    } elseif (isset($_POST['unsubscribe'])) {
        $result = unsubscribe($_POST['subscriber']['email']);
        unset($_POST['unsubscribe']);
    } elseif (isset($_GET['emailconfirm'])) {
        $result = email_confirm($_GET['emailconfirm']);
        unset($_GET['emailconfirm']);
    }
    if ($buffer) {
        ob_start();
    }
    if (isset($result)) {
        echo '<div id="mldmessage" class="' . $result[0] . '">' . $result[1] . '</div>';
    }
    ?>                    
    	<form action="<?php get_page_url(); ?>" method="post" class="mldsubscribeform">
        <p><label class="mld_label"><?php i18n('mld-newsletter/NAME'); ?>:</label><input type="text" class="text" name="subscriber[name]" value=""/></p>        
        <p><label class="mld_label"><?php i18n('mld-newsletter/EMAIL'); ?>:</label><input type="text" class="text" name="subscriber[email]" value=""/></p>
        <p><input type="submit" class="submit" value="<?php i18n('mld-newsletter/SUBSCRIBE'); ?>" id="subscribe" name="subscribe" />
        <input type="submit" class="submit" value="<?php i18n('mld-newsletter/UNSUBSCRIBE'); ?>" id="unsubscribe" name="unsubscribe" /></p>
        </form>
    <?php
    if ($buffer) {
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
}

/**
 * Shows newsletter archive on website
 * 
 * @since 0.5
 */
function mldShowNewsletters($buffer = false) {
    $mld = MLDnewsletter::getInstance();
    $xml = $mld->getXmlData('newsletters');
    
    //check if form is submitted and load data
    $lettercontent = '<p>'.i18n_r('mld-newsletter/NOLETTERSELECTED').'</p>';
    if(isset($_POST['newsletters'])) {
        foreach($xml as $newsletter) {
            if((string) $newsletter->id == $_POST['newsletters']) {
                $lettercontent = (string) $newsletter->content;  
                break;
            }
        }
    }
    
    //load template header and footer
    $xmls = $mld->getXmlData('settings');
    $theader = (string) $xmls->theader;
    $tfooter = (string) $xmls->tfooter;
    
    if($buffer) { ob_start(); }
    ?>
    <h3><?php i18n('mld-newsletter/NEWSLETTERARCHIVE'); ?></h3>
    <form id="mld_selectNewsletter" class="mld_Form" method="post" action="<?php echo get_page_url(true); ?>">
        <label class="mld_label"><?php i18n('mld-newsletter/SELECTNEWSLETTER'); ?>:</label>
        <select name="newsletters" onchange="document.getElementById('mld_selectNewsletter').submit();">
            <option><?php i18n('mld-newsletter/SELECTNEWSLETTERFROMLIST'); ?></option>
            <?php            
                foreach($xml as $newsletter) {
                    if((string) $newsletter->send == 'true') {
                        echo '<option value="'.(string) $newsletter->id.'">'.(string) $newsletter->title.'</option>';                        
                    }                    
                }               
            ?>
        </select>
    </form>
    <div class="mld_newsletterpreview">
        <?php echo stripslashes(htmldecode($theader . $lettercontent . $tfooter)); ?>
    </div>
    <?php
    
    if($buffer) { 
         $html = ob_get_contents();
         ob_end_clean();
         return $html;
    }
}


/**
 * Confirm subscribed email address
 *
 * @param string $confirmcode
 * @return array with message
 */
function email_confirm($confirmcode) {
    $mld = MLDnewsletter::getInstance();
    $xml = $mld->getXmlData('subscribers');
    foreach ($xml as $entry) {
        if ((string) $entry->status == $confirmcode) {
            $entry->status = 'true';
            XMLsave($xml, $mld->files['subscribers']);
            return array('updated', i18n_r('mld-newsletter/SUBSCRIBESUCCES'));
        }
    }
    return array('error', i18n_r('mld-newsletter/CONFIRMATIONNOTFOUND'));
}

/**
 * Function to send emails.
 *
 * @param string $to_email
 * @param string $to_name
 * @param string $to_subject
 * @param string $to_message
 * @param boolean $batch
 * @return array with message
 */
function send_email($to_email, $to_name, $to_subject, $to_message, $batch = false) {
    $mld = MLDnewsletter::getInstance();
    $settingsxml = $mld->getXmlData('settings');
    require_once(GSPLUGINPATH . 'mld-newsletter/swift/swift_required.php');

    try {
        $SENDERNAME = (string) $settingsxml->sname;
        $SENDEREMAIL = (string) $settingsxml->semail;
        $SMTPSERVER = (string) $settingsxml->smtpserver;
        $SMTPPORT = (int) $settingsxml->smtpport;
        $SMTPAUTH = (string) $settingsxml->smtpauth;
        $SMTPSECURE = (string) $settingsxml->smtpsecure;
        $SMTPAUTHNAME = (string) $settingsxml->smtpauthname;
        $SMTPAUTHPW = (string) $settingsxml->smtpauthpw;

        $to_message = stripslashes($to_message);

        $mail = Swift_Message::newInstance()
                ->setSubject($to_subject)
                ->setFrom(array($SENDEREMAIL => $SENDERNAME))
                ->setBody((string) $to_message, 'text/html')
        ;

        //set transport
        $transport = Swift_SmtpTransport::newInstance($SMTPSERVER, (int) $SMTPPORT);
        if ($SMTPAUTH == true) {
        $transport->setEncryption($SMTPSECURE);
        $transport->setUsername($SMTPAUTHNAME);
        $transport->setPassword($SMTPAUTHPW);
        }

        $mailer = $mailer = Swift_Mailer::newInstance($transport);

        //add receipients
        if ($batch == true) {
            $mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100, 30));
            $numSent = 0;
            foreach ($to_email as $email => $name) {
                $mail->setTo(array((string) $email => $name));
                $numSent += $mailer->send($mail);
                    }
            if($numSent > 0) {
                return array('updated', i18n_r('mld-newsletter/SENDSUCCESS').' ('.(string) $numSent.')');
            } else {
                return array('error', i18n_r('mld-newsletter/SENDFAIL'));
            }
        } else {
            $mail->setTo(array((string) $to_email => $to_name));
            if ($mailer->send($mail) > 0) {
                return array('updated', i18n_r('mld-newsletter/SENDSUCCESSADMIN').$to_email);
            } else {
                return array('error', i18n_r('mld-newsletter/SENDFAILADMIN').$to_email);
            }
        }
    } catch (Exception $e) {
        return array('error', $e->getMessage());
        //echo $e->getMessage();
    }
}

/**
 * Subscribe email addresses
 *
 * @param string $name
 * @param string $email
 * @param boolean $confirm whether the subscribtion needs confirmation or not.
 * @return array with message
 */
function subscribe($name, $email, $confirm = true) {
    $mld = MLDnewsletter::getInstance();
    $error = array();
    $xml = $mld->getXmlData('subscribers');


    //check for valid email and duplication
    if (!check_email_address($email)) {
        $error = i18n_r('mld-newsletter/WRONGEMAIL');
    } else {
        foreach ($xml as $entry) {
            if ($entry->email == $email && $entry->status == 'true') {
                $error = i18n_r('mld-newsletter/ALREADYREGISTERED');
            } elseif ($entry->email == $email && $entry->status != 'true') {
                if($confirm == true) {
                    //send confirm email again
                    $error = sendConfirmEmail($entry->name, $entry->email, $entry->status, true);                                        
                } else {                    
                    return email_confirm($entry->status);                    
                }
            }
        }
    }

    if (count($error) == 0) {
        if ($confirm == true) {
            $confirmcode = uniqid();
        } else {
            $confirmcode = 'true';
        }

        $newentry = $xml->addChild('entry');
        $temp = $newentry->addChild('name');
        $temp->addCData($name);
        $temp = $newentry->addChild('email');
        $temp->addCData($email);
        $temp = $newentry->addChild('status', $confirmcode);
        XMLsave($xml, $mld->files['subscribers']);

        if ($confirm == true) {
            //send confirm email again
            $msg = sendConfirmEmail($newentry->name, $newentry->email, $newentry->status, false);             
        } else {
            $msg = array('updated', i18n_r('mld-newsletter/SUBSCRIBESUCCES'));
        }
        return $msg;
    } else {
        $msg = array('error', $error);
    }
    return $msg;
}

/**
 * Send confirmation email
 * 
 * @param string $name
 * @param string $email
 * @param string $status
 * @param boolean $again
 * @return array or string 
 */
function sendConfirmEmail($name, $email, $status, $again = false) {
    // Checking if the URL has arguments yet (has '?').
    if (strpos(get_page_url(true), '?')) {
        $confirmurl = get_page_url(true) . '&emailconfirm=' . $status;
    } else {
        $confirmurl = get_page_url(true) . '?&emailconfirm=' . $status;
    }
    $message = '<h3>' . i18n_r('mld-newsletter/CONFIRMEMAILTITLE') . '</h3>' . i18n_r('mld-newsletter/CONFIRMEMAILBODY1')
            . '<br />Name: ' . $name . '<br />Email: ' . $email . '<br />' . i18n_r('mld-newsletter/CONFIRMEMAILBODY2') . ' <a href="' . $confirmurl . '">'
            . $confirmurl . '</a>';
    $emailresult = send_email($email, $name, i18n_r('mld-newsletter/CONFIRMEMAILSUBJECT'), $message);
    if ($emailresult[0] != 'error' && $again == false) {
        return array('updated', i18n_r('mld-newsletter/CONFIRMATIONSEND'));
    } elseif ($emailresult[0] != 'error' && $again == true) {
        return i18n_r('mld-newsletter/CONFIRMAGAIN');
    } elseif ($again == false) {
        return array('error', i18n_r('mld-newsletter/SUBSCRIBEFAIL'));
    } else {
        return i18n_r('mld-newsletter/SUBSCRIBEFAIL');
    }
}

/**
 * Remove email address from file
 *
 * @param string $email
 * @return array with message
 */
function unsubscribe($email) {
    $mld = MLDnewsletter::getInstance();
    $xml = $mld->getXmlData('subscribers');
    $found = false;
    foreach ($xml as $entry) {
        if ($entry->email == $email) {
            $dom = dom_import_simplexml($entry);
            $dom->parentNode->removeChild($dom);
            $found = true;
            break;
        }
    }

    if ($found == true) {
        if (!XMLsave($xml, $mld->files['subscribers'])) {
            $msg = array('error', i18n_r('mld-newsletter/SAVEFAIL'));
        } else {
            $msg = array('updated', i18n_r('mld-newsletter/UNSUBSCRIBESUCCES'));
        }
    } else {
        $msg = array('error', i18n_r('mld-newsletter/EMAILNOTFOUND'));
    }

    return $msg;
}

/**
 * Show message.
 *
 * @param string $type gives type of message
 * @param string $text message text
 */
function display_message($type, $text) {
    ?>
    	<script type="text/javascript">
            $(function() {
                $('div.bodycontent').before('<div class="<?php echo $type; ?>" style="display:block;">'+
                    <?php echo json_encode($text); ?>+'</div>');
                    $(".updated, .error").fadeOut(500).fadeIn(500);
            });
    	</script>
    <?php
}
?>