#!/usr/bin/php
<?php

/**
 *
 * Add "meta_description" field to theme settings
 *
 */

// Include needed files
require_once '../includes/variables.php';
require_once '../includes/common.php';

// Get directories
$data = getSites();

// Start looping within the sites
foreach ($data as $d) {

  // Set directory path for easy access
  $dir_path = $variables['dir'] . '/' . $d;

  // Change to the site directory in consideration
  chdir($dir_path);

  // Print current working directory
  echo getcwd() . "\n";

  // Prepare settings.php file for writing
  system('chmod u+w settings.php');
  system('chmod u+w ' . $dir_path);

  // We are adding "meta_description" field to settings.php. This field is accessible from Theme Settings
  system('sed "s/\'welcome_text\',/\'welcome_text\',\r\n\'meta_description\',/g" settings.php > settings_tmp.php');

  // Set new settings.php
  system('mv settings_tmp.php settings.php');

  // Return settings.php to its default permissions
  system('chmod u-w settings.php');
  system('chmod u-w ' . $dir_path);

}

?>
