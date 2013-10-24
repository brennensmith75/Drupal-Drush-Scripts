#!/usr/bin/php
<?php

/**
 *
 * Enable "Link Checker" module, set some of its options and add its link to specified menu
 * Note: You need to put "environment.drush.inc" file under ".drush" directory before running this script.
 * You can find this file under "scripts/d6/modules/environment"
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

// Change to working directory
chdir(dirname(__FILE__));

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

  // Do the action
  system('drush -y environment orbingol');

  //system('drush -y pm-disable permissions_api'); /* We don't need to disable Permissions API if we do permission change operations frequently

  // Execute custom PHP code
  system('drush -y -u 1 scr menucode.php');

  // Clear all caches
  system('drush cc all');

  // Increase counter
  $counter++;
}

?>
