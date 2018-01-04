<?php
/*
Name: User vCard
Description: Allows the users of a site to dynamically create profile pages an a downloadable vCards
Version: 1.0
Author: Lluis Gesa
Author URI: http://www.hlod-wig.org/
*/

# Configuration
$uvcard_max_photo_size = 80000;
$uvcard_images_folder = 'vcard-images';

# get correct id for plugin
$thisfile=basename(__FILE__, ".php");


# Useful environment values
$uvcard_current_user = get_cookie('GS_ADMIN_USERNAME');
$uvcard_file=GSDATAOTHERPATH.$uvcard_current_user.'-vcard.xml';

# register plugin
register_plugin(
        $thisfile,
        'User vCard',
        '1.0',
        'Lluís Gesa',
        'http://www.hlod-wig.org/',
        'Allows the users of a site to dynamically create profile pages an a downloadable vCards',
        '',
        '');

# includes
require_once('user-vcard/functions.php');

# hooks
add_action('settings-user-extras','uvcard_show_form');
add_action('settings-user','uvcard_save');
add_filter('content','uvcard_show');
