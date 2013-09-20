#!/usr/bin/php
<?php

/**
 *
 * Show empty "analytics_code" field in theme settings
 *
 */

// Include needed files
require_once '../includes/variables.php';
require_once '../includes/common.php';

// Get directories
$data = getSites();

// Start looping within the sites
foreach ($data as $d) {

  // Change to the site directory in consideration
  chdir($variables['dir'] . "/" . $d);

  // Assign Drush output to a variable. The output is in JSON format.
  $result = shell_exec('drush vget theme_mytheme_settings --format=json');

  // Convert JSON string to a PHP array
  $variables = json_decode($result);

  // Get "analytics_code" field
  $analytics_code = $variables->analytics_code;

  // Check the conditions and print site name if necessary
  if (empty($analytics_code) || !isset($variables->analytics_code)) {

    echo $d . "\n";

  }

}

?>
