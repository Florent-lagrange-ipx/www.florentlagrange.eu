<?php
/*
Plugin Name: DY XML Table
Description: Presents a data from XML document in a HTML table
Version: 1.0
Author: Dmitry Yakovlev
Author URI: http://dimayakovlev.ru/
*/

# get correct id for plugin
$thisfile = basename(__FILE__, ".php");

# register plugin
register_plugin(
  $thisfile,                          # ID of plugin, should be filename minus php
  'DY XML Table',                    # Title of plugin
  '1.0',                              # Version of plugin
  'Dmitry Yakovlev',                    # Author of plugin
  'http://dimayakovlev.ru/',          # Author URL
  'Presents a data from XML document in a HTML table',   # Plugin Description
  '',                                 # Page type of plugin
  ''                                  # Function that displays content
);

add_filter('content', 'dyXMLTableShortcode');

function dyXMLTableShortcode($content) {
  // (% dyXMLTable filename:data.xml full:true THEAD:"Title, Description" %)
  $pattern = '(\(%\s+dyXMLTable\s+(.*)\s+%\))';
  return preg_replace_callback($pattern, 'dyXMLTableCallback', $content);
}

function dyXMLTableCallback($matches) {
  if (isset($matches[0])) {
    preg_match('/filename:(\S+)/', $matches[1], $array);
    if (isset($array[1])) {      
      $fileName = $array[1];
      $fullTable = false;
      $thead = null;      
      preg_match('/full:(true|false)/', $matches[1], $array);
      if (isset($array[1]) && $array[1] == 'true') $fullTable = true;
      if ($fullTable) {
        preg_match('/THEAD:"(.*)"/i',  $matches[1], $array);
        if (isset($array[1]) & !empty($array[1])) $thead = explode(' | ', $array[1]);
      }
      return dyXMLTable($fileName, $fullTable, $thead, false);
    }
  }
}

function dyXMLTable($filename, $full = true, $thead = null, $echo = true) {
  $filename = GSDATAUPLOADPATH . DIRECTORY_SEPARATOR . $filename;
  if (is_file($filename)) {
    $cache = GSCACHEPATH . 'dyXMLTable-' . md5_file($filename) . '.txt';
    $table = '';
    if ($full) {
      $table = '<table class="dy-xml-table table ' . basename($filename, '.xml') . '">';
      if (is_array($thead) && !empty($thead)) {
        $table .= '<thead><tr>';
        foreach($thead as $item) $table .= '<th>' . $item . '</th>';
        $table .= '</tr></thead>';
      }
    }
    if (is_file($cache)) {
      $table .= file_get_contents($cache);
    } else {
      $xmlObj = simplexml_load_file($filename);
      $tbody = '<tbody>';
      foreach($xmlObj as $row) {
        $tbody .= '<tr>';
        foreach ($row->children() as $key => $value)
          $tbody .= '<td>' . $value.  '</td>';
        $tbody .= '</tr>';
      }
      $tbody .= '</tbody>';
      file_put_contents($cache, $tbody);
      $table .= $tbody;
    }
    if ($full) $table .= '</table>';
    if ($echo) {
      echo $table;
    } else {
      return $table;
    }
  }
}

?>