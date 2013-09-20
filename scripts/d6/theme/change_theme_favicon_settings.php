#!/usr/bin/php
<?php

/**
 *
 * Disable favicon in theme settings
 *
 */

// Include needed files
require_once '../includes/variables.php';
require_once '../includes/common.php';

// Get directories
$data = getSites();

// Evaluate PHP code for "mytheme" theme to change its settings
$command = 'drush ev \'$a=variable_get("theme_mytheme_settings", array());$a["toggle_favicon"]=0;variable_set("theme_mytheme_settings", $a);\'';

// Start looping within the sites
foreach ($data as $d) {

  // Change to the site directory in consideration
  chdir($variables['dir'] . "/" . $d);

  // Print current working directory
  echo getcwd() . "\n";

  // Execute command
  system($command);

}

?>
