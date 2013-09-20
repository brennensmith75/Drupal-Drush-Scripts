<?php

// Include needed variables
require 'variables.php';

// Reads Drupal "sites" directory
function getSites()
{

  global $variables;

  // For compatibility issues...
  $dir = $variables['dir'];

  // Read directory
  if ($handle = opendir($dir)) {
    while (false !== ($entry = readdir($handle))) {
      if (is_dir($dir . "/" . $entry) && !is_link($dir . "/" . $entry)) {
        $entry = trim($entry);
        $data[] = $entry;
      }
    }
  }

  // Remove standard directories from the array
  $dirs_after_exclusion = array_diff($data, $variables['excluded_dirs']);
  $dirs_final = array_values($dirs_after_exclusion);

  // Return Drupal sites
  return $dirs_final;

}
