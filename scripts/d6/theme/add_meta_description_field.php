#!/usr/bin/php
<?php

/**
 *
 * Add "meta_description" field to theme settings
 *
 */

// Define Drupal sites directory
$dir = "/home/user/public_html/sites";

// Read directory
if($handle = opendir($dir)){
    while (false !== ($entry = readdir($handle))) {
        if(is_dir($dir . "/" . $entry) && !is_link($dir . "/" . $entry)) {
            $entry = trim($entry);
            $data[] = $entry;
        }
    }
}

// Remove standard directories from the array
$data_pre = array_diff($data, array(".", "..", "all", "default"));
$data_post = array_values($data_pre);

// Start looping within the sites
foreach($data_post as $d) {

    // Change to the site directory in consideration
    chdir($dir . "/" . $d);

    // Print current working directory
    echo getcwd() . "\n";

    // Prepare settings.php file for writing
    system('chmod u+w settings.php');
    system('chmod u+w ' . $dir . '/' . $d);

    // We are adding "meta_description" field to settings.php. This field is accessible from Theme Settings
    system('sed "s/\'welcome_text\',/\'welcome_text\',\r\n\'meta_description\',/g" settings.php > settings_tmp.php');

    // Set new settings.php
    system('mv settings_tmp.php settings.php');

    // Return settings.php to its default permissions
    system('chmod u-w settings.php');
    system('chmod u-w ' . $dir . '/' . $d);

}

?>
