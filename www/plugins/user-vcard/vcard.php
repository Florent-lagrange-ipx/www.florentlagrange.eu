<?php
/*
Description: vCard downloader. Extracted from Author vCard by Chris Cagle
Author: Lluis Gesa
*/

require_once('class_vcard.php');

if (!isset($_GET['id'])) {
  return;
}

$name =  $_GET['id'];

vcard_download($name);

/*
  Given a user name, It is downloaded the vCard using the class_vcard
*/
function vcard_download($name)
{
  $vcard_file='../../data/other/'.$name.'-vcard.xml';

  if (!file_exists($vcard_file)) {
    return;
  }

  $xml = @file_get_contents($vcard_file);
  $v = simplexml_load_string($xml, NULL, LIBXML_NOCDATA);
  $vcard_fname = $v->first_name;
  $vcard_lname = $v->last_name;
  $vcard_company = $v->company;
  $vcard_title = $v->title;
  $vcard_street = $v->work_address;
  $vcard_city = $v->work_city;
  $vcard_country = $v->work_country;
  $vcard_zip = $v->work_postal_code;
  $vcard_email = $v->email;
  $vcard_officetel = $v->office_tel;
  $vcard_celltel = $v->cell_tel;

  $site_file='../../data/other/website.xml';
  $xml = @file_get_contents($site_file);
  $data = simplexml_load_string($xml, NULL, LIBXML_NOCDATA);
  $SITEURL 	= $data->SITEURL;

  $vc = new vcard();

  #$vc->filename = "";
  #$vc->revision_date = "";

  #$vc->data['display_name'] = "";
  $vc->data['first_name'] = $vcard_fname;
  $vc->data['last_name'] = $vcard_lname;
  #$vc->data['additional_name'] = ""; //Middle name
  #$vc->data['name_prefix'] = "";  //Mr. Mrs. Dr.
  #$vc->data['name_suffix'] = ""; //DDS, MD, III, other designations.
  #$vc->data['nickname'] = "";

  $vc->data['company'] = $vcard_company;
  #$vc->data['department'] = "";
  $vc->data['title'] = $vcard_title;
  #$vc->data['role'] = "";

  #$vc->data['work_po_box'] = "";
  #$vc->data['work_extended_address'] = "";
  $vc->data['work_address'] = $vcard_street;
  $vc->data['work_city'] = $vcard_city;
  #$vc->data['work_state'] = $vcard_state;
  $vc->data['work_postal_code'] = $vcard_zip;
  $vc->data['work_country'] = $vcard_country;

  #$vc->data['home_po_box'] = "";
  #$vc->data['home_extended_address'] = "";
  #$vc->data['home_address'] = "";
  #$vc->data['home_city'] = "";
  #$vc->data['home_state'] = "";
  #$vc->data['home_postal_code'] = "";
  #$vc->data['home_country'] = "";

  $vc->data['office_tel'] = $vcard_officetel;
  #$vc->data['home_tel'] = "";
  $vc->data['cell_tel'] = $vcard_celltel;
  $vc->data['fax_tel'] = $vcard_faxtel;
  #$vc->data['pager_tel'] = "";
  $vc->data['email1'] = $vcard_email;
  #$vc->data['email2'] = "";
  $vc->data['url'] = $SITEURL;
  #$vc->data['photo'] = "";  //Enter a URL.
  #$vc->data['birthday'] = "";
  #$vc->data['timezone'] = "";
  #$vc->data['sort_string'] = "";
  #$vc->data['note'] = "";

  /*
    Generate card and send as a .vcf file to user's browser for download.
  */
  $vc->download();
};

?>