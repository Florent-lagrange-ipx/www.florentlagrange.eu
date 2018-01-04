<?php
/*
Description: Management Functions for User vCard
Author: Lluis Gesa
*/

/*
  Shows the profile form. It is assumed that is embedded inside
setting page in GS. This means that a hook registered in
"setting-user-extras" must call this method
*/
function uvcard_show_form() {
  global $uvcard_file;
  global $SITEURL;
  global $uvcard_current_user;
  global $uvcard_images_folder;

  $vcard_fname = "";
  $vcard_lname = "";
  $vcard_company = "";
  $vcard_title = "";
  $vcard_street = "";
  $vcard_city = "";
  $vcard_country = "";
  $vcard_zip = "";
  $vcard_email = "";
  $vcard_officetel = "";
  $vcard_celltel = "";
  $vcard_faxtel = "";
  $vcard_page = "";
  $vcard_photo = "";
  $publish_email = "";
  $publish_off_phone = "";
  $publish_cell_phone = "";
  $publish_fax = "";

  if (file_exists($uvcard_file)) {
    $v = getXML($uvcard_file);
    $vcard_fname = stripslashes($v->first_name);
    $vcard_lname = stripslashes($v->last_name);
    $vcard_company = stripslashes($v->company);
    $vcard_title = stripslashes($v->title);
    $vcard_street = stripslashes($v->work_address);
    $vcard_city = stripslashes($v->work_city);
    $vcard_country = stripslashes($v->work_country);
    $vcard_zip = $v->work_postal_code;
    $vcard_email = $v->email;
    $vcard_officetel = $v->office_tel;
    $vcard_celltel = $v->cell_tel;
    $vcard_faxtel = $v->fax_tel;
    $vcard_page = $v->page;
    $vcard_photo = $v->photo;

    if ($v->permissions->email !="")
      {
        $publish_email = "checked";
      }
    if ($v->permissions->office_tel !="")
      {
        $publish_off_phone = "checked";
      }
    if ($v->permissions->cell_tel !="")
      {
        $publish_cell_phone = "checked";
      }
    if ($v->permissions->fax_tel !="")
      {
        $publish_fax = "checked";
      }
  }

/* Start section  */

  echo '<div id="uvcard" class="section">
    <div class="clear"></div>
    <h3>vCard Contact Form</h3>
    <div class="edit-nav" >
    <a href="'.$SITEURL.'plugins/user-vcard/vcard.php?id='.$uvcard_current_user.'">View vCard</a>
    <div class="clear"></div></div>';

/* Foto section  */

  echo '<div class="leftsec"> <p>
  <label for="photo" >Photo:</label>';
  if ((string)$vcard_photo == "yes") {
    echo '<img style="float:left;height: 80px; border:1px solid blue;" src="'.$SITEURL.'data/uploads/'.$uvcard_images_folder.'/'.@$vcard_fname.'_'.@$vcard_lname.'.jpg"/>';
  } else {
    echo '';
  }
  echo '</p> <input type=hidden name="has_photo" value="'.@$vcard_photo.'"> </div>';

  echo '<div class="rightsec" style="height:100px;">
<p><label for="upload_photo" >Upload photo:</label>
<input type="file" name="vcardphoto" id="vcardphoto" /></p></div>';

/* data section */

  echo '<div class="leftsec">
     <p><label for="first_name" >First Name:</label><input class="text" id="first_name" name="first_name" type="text" value="'.@$vcard_fname.'"/></p></div>
    <div class="rightsec">
     <p><label for="last_name" >Last Name:</label><input class="text" id="last_name" name="last_name" type="text" value="'.@$vcard_lname.'"/></p></div>

    <div class="leftsec">
     <p><label for="company" >Company:</label><input class="text" id="company" name="company" type="text" value="'.@$vcard_company.'"/></p></div>
    <div class="rightsec">
     <p><label for="title" >Title:</label><input class="text" id="last_name" name="title" type="text" value="'.@$vcard_title.'"/></p></div>

    <div class="leftsec">
     <p><label for="company" >Work Address:</label><span>Street Name:</span><input class="text" id="work_address" name="work_address" type="text" value="'.@$vcard_street.'"/><span class="right">Postal Code:</span><input class="text" id="work_postal_code" name="work_postal_code" type="text" value="'.@$vcard_zip.'"/>
</p></div>

    <div class="rightsec">
     <p><label for="title" >&nbsp;</label><span >City:</span><input class="text" id="work_city" name="work_city" type="text" value="'.@$vcard_city.'"/>
<span >Country:</span><input class="text" id="work_country" name="work_country" type="text" value="'.@$vcard_country.'"/></p></div>

    <div class="leftsec">
     <p><label for="profile_email" >Email Address:</label><input class="text" id="profile_email" name="profile_email" type="text" value="'.@$vcard_email.'"/></p></div>
    <div class="rightsec">
     <p><label for="office_tel" >Office Phone:</label><input class="text" id="office_tel" name="office_tel" type="text" value="'.@$vcard_officetel.'"/></p></div>

    <div class="leftsec">
     <p><label for="cell_tel" >Mobile Phone:</label><input class="text" id="cell_tel" name="cell_tel" type="text" value="'.@$vcard_celltel.'"/></p></div>
    <div class="rightsec">
     <p><label for="fax_tel" >Fax Number:</label><input class="text" id="fax_tel" name="fax_tel" type="text" value="'.@$vcard_faxtel.'"/></p></div>
    <div><p>';

/* Publisher page section */

  echo '<label>Page to show contact info:</label>
        <select class="text" name="page" style="width:150px;">
        <option value="none">none</option>\n';

  $pages = get_available_pages();

  foreach ($pages as $page) {
    $slug = $page['slug'];
    if ($slug == $vcard_page)
      echo '<option value="'.$slug.'" selected="selected">'.$slug.'</option>\n';
    else
      echo '<option value="'.$slug.'">'.$slug.'</option>\n';
  }
  echo '</select></p></div>';

/* Publish permissions section */

  echo '<style  TYPE="text/css">  <!-- .datapublic { width:30px;height:40px;float:left;margin-left:4px; }--> </style>';

  echo '<label>Publish:</label><table width="100%"><tr>';
  echo '<td><label>Email:</label><input type="checkbox" name="publish_email" value="yes" '.$publish_email.' /></td>';
  echo '<td><label>Office  phone:</label><input type="checkbox" name="publish_off_phone" value="yes" '.$publish_off_phone.' /></td>';
  echo '<td><label>Mobile  phone:</label><input type="checkbox" name="publish_cell_phone" value="yes" '.$publish_cell_phone.' /></td>';
  echo '<td><label>Fax number:</label><input type="checkbox" name="publish_fax" value="yes" '.$publish_fax.' /></td>';
  echo '</tr></table>';

  echo '<p><b><img src="'.$SITEURL.'plugins/user-vcard/vcard.png" alt="vCard" />&nbsp;Code to link your vCard:</b><br />
        <code style="display:block;border:1px solid #ccc;background:#f9f9f9;padding:10px;font-size:11px;color:#666;" >&lt;a href="'.$SITEURL.'plugins/user-vcard/vcard.php?id='.$uvcard_current_user.'">Download vCard&lt;/a></code>
        </p> </div>';
}

function uvcard_create_vcard_images_folder() {
  global $uvcard_images_folder;

  if (file_exists(GSDATAUPLOADPATH.$uvcard_images_folder)) {
    return;

  } else {
    if (defined('GSCHMOD')) {
      $chmod_value = GSCHMOD;
    } else {
      $chmod_value = 0755;
    }
    mkdir(GSDATAUPLOADPATH . $uvcard_images_folder, $chmod_value);
  }
}

/*

Method to save information provided by created form in
uvcard_show_form. It is assumed that is embedded inside setting page
in GS. This means that a hook registered in "setting-user" must
call this method
 */
function uvcard_save() {
  global $uvcard_file;
  global $SITEURL;
  global $uvcard_current_user;
  global $error;
  global $uvcard_images_folder;
  global $uvcard_max_photo_size;

  if (isset($_POST['submitted'])) {

    $xml = @new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><item></item>');
    $note = $xml->addChild('first_name');
    $note->addCData(@$_POST['first_name']);

    $note = $xml->addChild('last_name');
    $note->addCData(@$_POST['last_name']);

    $note = $xml->addChild('company');
    $note->addCData(@$_POST['company']);

    $note = $xml->addChild('title');
    $note->addCData(@$_POST['title']);

    $note = $xml->addChild('work_address');
    $note->addCData(@$_POST['work_address']);

    $note = $xml->addChild('work_city');
    $note->addCData(@$_POST['work_city']);

    $note = $xml->addChild('work_country');
    $note->addCData(@$_POST['work_country']);

    $note = $xml->addChild('work_postal_code');
    $note->addCData(@$_POST['work_postal_code']);

    $note = $xml->addChild('email');
    $note->addCData(@$_POST['profile_email']);

    $note = $xml->addChild('office_tel');
    $note->addCData(@$_POST['office_tel']);

    $note = $xml->addChild('cell_tel');
    $note->addCData(@$_POST['cell_tel']);

    $note = $xml->addChild('fax_tel');
    $note->addCData(@$_POST['fax_tel']);

    $note = $xml->addChild('page');
    $note->addCData(@$_POST['page']);

    $perm = $xml->addChild('permissions');

    if (isset($_POST['publish_email']))
      $perm->addChild('email', $_POST['publish_email']);
    else
      $perm->addChild('email', '');

    if (isset($_POST['publish_off_phone']))
      $perm->addChild('office_tel', $_POST['publish_off_phone']);
    else
      $perm->addChild('office_tel', '');

    if (isset($_POST['publish_cell_phone']))
    $perm->addChild('cell_tel', $_POST['publish_cell_phone']);
    else
      $perm->addChild('cell_tel', '');

    if (isset($_POST['publish_fax']))
      $perm->addChild('fax_tel', $_POST['publish_fax']);
    else
      $perm->addChild('fax_tel', '');

    $note = $xml->addChild('photo');

    if ($_FILES["vcardphoto"]["name"] != "") {

      if ((($_FILES["vcardphoto"]["type"] == "image/jpeg")
           || ($_FILES["vcardphoto"]["type"] == "image/pjpeg"))
          && ($_FILES["vcardphoto"]["size"] < $uvcard_max_photo_size)) {

        if ($_FILES["vcardphoto"]["error"] > 0) {
              $error = "Uploading photo: ".$_FILES["vcardphoto"]["error"]. "";
              $note->addCData('no');
        }
        else {
          uvcard_create_vcard_images_folder();

          move_uploaded_file($_FILES["vcardphoto"]["tmp_name"],
                             GSDATAUPLOADPATH.$uvcard_images_folder.'/'.@$_POST['first_name'].'.jpg');
          $note->addCData('yes');
        }
      }
      else {
        $error = "Invalid file ".$_FILES["file"]["name"]."";
        $note->addCData('no');
      }
    }
    else {
      $note->addCData(@$_POST['has_photo']);
    }

    $xml->asXML($uvcard_file);
  }
}

/*
  Method that returns the User vCard information related with a given
page name
*/
function uvcard_get_linked_page($page) {
  $path = GSDATAOTHERPATH;

  $dir_handle = @opendir($path) or die("Unable to open $path");
  $filenames = array();
  while ($filename = readdir($dir_handle)) {
    $filenames[] = $filename;
  }
  closedir($dir_handle);

  $pagesArray = array();
  $count = 0;
  if (count($filenames) != 0) {
    foreach ($filenames as $file) {
      if (substr($file, -10) == "-vcard.xml") {
        $data = getXML($path . $file);
        $p = @$data->page;
        $user = substr($file, 0, -10);
        if ((string)$p == $page){
          return array($user, $data);
        }
      }
    }
  }
}

/*
  Method that must be registered as filter in contents, and when a
page related with a user vCard is detected. A header with user
information is attached in contents.
 */
function uvcard_show($content)
{
  global $uvcard_images_folder;
  global $SITEURL;

  /* Search if current page has a user vcard associated witrh it */
  $url = strval(get_page_slug(false));
  $vcard_info = uvcard_get_linked_page($url);

  if (isset($vcard_info)) {
    $user = $vcard_info[0];
    $vcard = $vcard_info[1];

    /* Complete User name */
    $name = ''.@$vcard->first_name.' '.@$vcard->last_name.'';

    /* Load and attach CSS files */
    $css_file=GSPLUGINPATH.'user-vcard/vcard.css';
    $css = '<style  TYPE="text/css">  <!--'.file_get_contents($css_file).'--> </style>';

    $info = $css.'<div class="vcard">';

    if ((string)@$vcard->photo == "yes")
      {
        $info = $info.' <div class="vcard_photo" style="float: right; height: 120px;"><img alt="'.$name.'" src="'.$SITEURL.'data/uploads/'.$uvcard_images_folder.'/'.@$vcard->first_name.'_'.@$vcard->last_name.'.jpg" style="height: 120px;" title="'.$name.'" /></div>';
      }

    $info = $info.'<p class="vcard_title">'.stripslashes(@$vcard->title).'</p>
            <div class="vcard_address">
             <span class="vcard_street-address">'.stripslashes(@$vcard->company).'<br/>'.stripslashes(@$vcard->work_address).'<br/>
            '.@$vcard->work_postal_code.' '.stripslashes(@$vcard->work_city).', '.stripslashes(@$vcard->work_country).'</span></div>';

    if ($vcard->permissions->email != "") {
      $info = $info.'<div class="vcard_email">'.stripslashes(@$vcard->email).'</div>';
    }
    if ($vcard->permissions->office_tel != "") {
      $info = $info.'<div class="vcard_off_tel">Office:'.stripslashes(@$vcard->office_tel).'</div>';
    }
    if ($vcard->permissions->cell_tel != "") {
      $info = $info.'<div class="vcard_cell_tel">Mobile:'.stripslashes(@$vcard->cell_tel).'</div>';
    }
    if ($vcard->permissions->fax_tel != "") {
      $info = $info.'<div class="vcard_fax">Fax:'.stripslashes(@$vcard->fax_tel).'</div>';
    }

    $info = $info.'<div class="vcard_link">
            <a href="plugins/user-vcard/vcard.php?id='.$user.'" title="Download as vCard">Download as vCard</a></div>
           </div>';

    $content = $info.$content;
  }

  return $content;
}
