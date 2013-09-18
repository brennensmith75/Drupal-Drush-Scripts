#!/usr/bin/php
<?php

/**
 *
 * Show empty "analytics_code" field in theme settings
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
    
    // Assign Drush output to a variable. The output is in JSON format.
    $result = shell_exec('drush vget theme_birim_genel_settings --format=json');
    
    // Convert JSON string to a PHP array
    $variables = json_decode($result);
    
    // Get "analytics_code" field
    $analytics_code = $variables->analytics_code;
    
    // Check the conditions and print site name if necessary
    if(empty($analytics_code) || !isset($variables->analytics_code)) {

        echo $d . "\n";

    }
    
}

?>
