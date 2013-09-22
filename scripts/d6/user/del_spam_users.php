#!/usr/bin/php
<?php

/**
 *
 * Remove spam users
 *
 *
 * Copyright 2012-2013 Onur Rauf Bingol
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 */

// Include needed files
require_once '../includes/variables.php';
require_once '../includes/common.php';
require '../includes/ldap.php';

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

  // Print some information
  echo 'Site #: ' . $counter . ' / ' . $site_count . "\n" . 'Processing: ' . $d . "\n";

  // Query `users` table to write all Drupal users to a file
  system('drush sql-query "SELECT name FROM users" --result-file=sites/' . $d . '/files/orb_sql_data_1234560.txt');

  // Get file contents to an array
  $lines = file($dir_path . '/files/orb_sql_data_1234560.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

  // Start reading from the array
  foreach ($lines as $l) {

    // Trim whitespace
    $l = trim($l);

    // Bypass column name coming from the query
    if ($l == 'name') {

      continue;

    }

    // Check username from LDAP and remove if not available
    if (ldap_check($l) == 0) {

      // Do the action!
      system('drush -y ucan ' . $l);

      // Print information about it
      echo 'Spam user ' . $l . ' is deleted.' . "\n";

    }

  }

  // Remove the file containing sql query results
  system('rm ' . $dir_path . '/files/orb_sql_data_1234560.txt');

  // Clear all caches
  system('drush cc all');

  // Increase counter
  $counter++;

}

?>
