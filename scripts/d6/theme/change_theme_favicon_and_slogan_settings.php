#!/usr/bin/php
<?php

/**
 *
 * Enable favicon and slogan in theme settings
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

// Initialize counter variables
$site_count = count($data_post);
$counter = 1;

// Evaluate PHP code for "mytheme" theme to change its settings
$command_favicon = 'drush ev \'$a=variable_get("theme_mytheme_settings", array());$a["toggle_favicon"]=1;variable_set("theme_mytheme_settings", $a);\'';
$command_slogan = 'drush ev \'$a=variable_get("theme_mytheme_settings", array());$a["toggle_slogan"]=1;variable_set("theme_mytheme_settings", $a);\'';

// Start looping within the sites
foreach($data_post as $d) {

    // Change to the site directory in consideration
    chdir($dir . "/" . $d);

    // Print some information
    echo 'Site #: ' . $counter . ' / ' . $site_count . "\n" . 'Processing: ' . $d . "\n";

    // Execute commands
    system($command_favicon);
    system($command_slogan);

    // Clear all caches
    system('drush cc all');

    // Increase counter
    $counter++;

}

?>
