#!/usr/bin/php
<?php

/**
 *
 * Clear all caches
 *
 */

// Include needed files
require_once '../includes/variables.php';
require_once '../includes/common.php';

// Get directories
$data = getSites();

// Initialize counter variables
$site_count = count($data);
$counter = 1;

// Start looping within the sites
foreach($data as $d) {

  // Change to the site directory in consideration
  chdir($variables['dir'] . "/" . $d);

    // Print information
    echo 'Site #: ' . $counter . ' / ' . $site_count . "\n" . 'Processing: ' . $d . "\n";

    // Do the action!
    system('drush cc all');

    // Increase counter
    $counter++;

}

?>
