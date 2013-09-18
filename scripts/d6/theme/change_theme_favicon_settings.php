#!/usr/bin/php
<?php

/**
 *
 * Disable favicon in theme settings
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

// Evaluate PHP code for "mytheme" theme to change its settings
$command = 'drush ev \'$a=variable_get("theme_mytheme_settings", array());$a["toggle_favicon"]=0;variable_set("theme_mytheme_settings", $a);\'';

// Start looping within the sites
foreach($data_post as $d) {

    // Change to the site directory in consideration
    chdir($dir . "/" . $d);

    // Print current working directory
    echo getcwd() . "\n";

    // Execute command
    system($command);

}

?>
