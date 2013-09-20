#!/usr/bin/php
<?php

/**
 *
 * Modify theme permissions according to the instructions in drushrc.php file
 * Note: You need to put "environment.drush.inc" file under ".drush" directory before running this script.
 * You can find this file under "scripts/d6/modules/environment"
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
foreach ($data as $d) {

  // Set directory path for easy access
  $dir_path = $variables['dir'] . '/' . $d;

  // Change to the site directory in consideration
  chdir($dir_path);

  // Print informational messages
  echo 'Site #: ' . $counter . ' / ' . $site_count . "\n" . 'Processing: ' . $d . "\n";

  // Run the Drush module using settings in drushrc.php
  system('drush -y environment metucc');

  // Clear all caches
  system('drush cc all');

  // Increase counter
  $counter++;

}

?>
