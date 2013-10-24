#!/usr/bin/php
<?php

/**
 *
 * Add a new user to "site administrator" role
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

// Prepare variables
$user_name = 'my_user';
$user_email = 'test@example.com';
$user_password = '123456';
$user_role = 'site administrator';

// Prepare Drush commands
$add_user_command = 'drush user-create ' . $user_name . ' --mail="' . $user_email .'" --password="' . $user_password . '"';
$add_user_to_role_command = 'drush user-add-role "' . $user_role . '" --name="' . $user_name . '"';

// Start looping within the sites
foreach ($data as $d) {

  // Set directory path for easy access
  $dir_path = $variables['dir'] . '/' . $d;

  // Change to the site directory in consideration
  chdir($dir_path);

  // Print an informational message
  echo 'Site #: ' . $counter . ' / ' . $site_count . "\n" . 'Processing: ' . $d . "\n";

  // Do the action!
  system($add_user_command);
  system($add_user_to_role_command);

  // Increase counter
  $counter++;

}

?>
