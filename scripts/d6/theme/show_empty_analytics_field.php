#!/usr/bin/php
<?php

/**
 *
 * Show empty "analytics_code" field in theme settings
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

// Start looping within the sites
foreach ($data as $d) {

  // Set directory path for easy access
  $dir_path = $variables['dir'] . '/' . $d;

  // Change to the site directory in consideration
  chdir($dir_path);

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
