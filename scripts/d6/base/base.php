#!/usr/bin/php
<?php

/**
 *
 * Base script for all multi-site Drush scripts
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

// Start looping within the sites
foreach($data_post as $d) {

    // Change to the site directory in consideration
    chdir($dir . "/" . $d);

    // Print information
    echo 'Site #: ' . $counter . ' / ' . $site_count . "\n" . 'Processing: ' . $d . "\n";

    // Increase counter
    $counter++;

}

?>
