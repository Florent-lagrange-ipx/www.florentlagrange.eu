<?php

/* * **************************************************
 *
 * @File: 	mldnewsletter.class.php
 * @Package:	MLD Newsletter
 * @Subject:	Data class
 * @Date:	8 February 2012
 * @Revision:	8 May 2012
 * @Version:	0.7
 * @Status:	Beta
 * @Author:	Leen Moerland (www.leenmoerland.com)
 *
 * ************************************************** */

class MLDnewsletter
{
    private static $instance;
    public $files = array();
    //private $config = array();

    private function __construct() {
        $datapath = GSDATAOTHERPATH.'mld-newsletter/';
        //set paths
        $this->files['settings'] = $datapath.'mld-newsletter-settings.xml';
        $this->files['subscribers'] = $datapath.'mld-newsletter-subscribers.xml';
        $this->files['newsletters'] = $datapath.'mld-newsletter-newsletters.xml';
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Private clone method for singleton protection
     */
    private function __clone() {        
    }

    public function getXmlData($file) {
        if(file_exists($this->files[$file])) {
            $xml = getXML($this->files[$file]);
            return $xml;
        } else {
            $this->createNewFile($file);
            $xml = getXML($this->files[$file]);
            return $xml;
        }
    }

    private function createNewFile($type) {
        if(!is_dir(GSDATAOTHERPATH.'mld-newsletter/')) {
            mkdir(GSDATAOTHERPATH.'mld-newsletter/');
        }
        if ($type == 'settings') {
            $xml = new SimpleXMLExtended('<settings></settings>');
        } elseif ($type == 'newsletters') {
            $xml = new SimpleXMLExtended('<newsletters></newsletters>');
        } elseif ($type == 'subscribers') {
            $xml = new SimpleXMLExtended('<subscribers></subscribers>');
        }
        
        if(XMLsave($xml, $this->files[$type])) {
            display_message('updated', i18n_r('mld-newsletter/CREATEDNEWFILE')." newsletters");
        } else {
            display_message('error', i18n_r('mld-newsletter/COULDNOTCREATEFILE')." newsletters");
        }
    }
}

?>
