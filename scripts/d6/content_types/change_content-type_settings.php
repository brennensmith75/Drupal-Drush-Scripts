#!/usr/bin/php
<?php

/**
 *
 * Change field settings in a content type
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

  // Process "Event Date" field in the "Event" content type
  $result = system('drush sql-query "SELECT widget_settings FROM content_node_field_instance WHERE field_name = \'field_event_date\'"') . "\n";
  $data = unserialize($result); // Convert to an array
  $data['input_format'] = 'd.m.Y - H:i:s'; // Set the variable
  $final_pre = serialize($data); // Convert to string, again
  $final = addslashes($final_pre); // Some protection before writing to the DB (probably not needed)

  // Write to DB
  $sql = "UPDATE content_node_field_instance SET widget_settings = '$final' WHERE field_name = 'field_event_date'";
  system('drush sql-query "' . $sql . '"');

  // Clear all caches
  system('drush cc all');

  // Increase counter
  $counter++;

}

?>
