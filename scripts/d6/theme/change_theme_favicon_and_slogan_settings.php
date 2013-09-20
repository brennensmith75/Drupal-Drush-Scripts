#!/usr/bin/php
<?php

/**
 *
 * Enable favicon and slogan in theme settings
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

// Evaluate PHP code for "mytheme" theme to change its settings
$command_favicon = 'drush ev \'$a=variable_get("theme_mytheme_settings", array());$a["toggle_favicon"]=1;variable_set("theme_mytheme_settings", $a);\'';
$command_slogan = 'drush ev \'$a=variable_get("theme_mytheme_settings", array());$a["toggle_slogan"]=1;variable_set("theme_mytheme_settings", $a);\'';

// Start looping within the sites
foreach ($data as $d) {

  // Change to the site directory in consideration
  chdir($variables['dir'] . "/" . $d);

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
