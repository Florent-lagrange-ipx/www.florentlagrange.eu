<?php

    if ($_GET['action'] == 'open') {
        $file = file_get_contents(urldecode($_GET['file_path']));
        $file = htmlentities($file);
        $ext = pathinfo($_GET['file_path'], PATHINFO_EXTENSION);
        $array = array($file, $ext, $_GET['file_path']);

        
    } elseif ($_GET['action'] == 'save') {
 
       $file_data = html_entity_decode($_GET['fileData']);
       $file_url = $_GET['editedFile'];
       $file = html_entity_decode(urldecode($file_url));
      
       $res = file_put_contents($file, $file_data);
       
       if($res){
           $res_data = true;
       }else{
             $res_data = false;  
       }
       
       $array = array($res_data);
    }
        
        header('content-type: application/json; charset=utf-8');
        echo json_encode($array);
       
    //
    //print_r($_GET);