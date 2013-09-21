#!/usr/bin/php
<?php

/**
 *
 * Disable favicon in theme settings
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

// Evaluate PHP code for "mytheme" theme to change its settings
$command = 'drush ev \'$a=variable_get("theme_mytheme_settings", array());$a["toggle_favicon"]=0;variable_set("theme_mytheme_settings", $a);\'';

// Start looping within the sites
foreach ($data as $d) {

  // Set directory path for easy access
  $dir_path = $variables['dir'] . '/' . $d;

  // Change to the site directory in consideration
  chdir($dir_path);

  // Print current working directory
  echo getcwd() . "\n";

  // Execute command
  system($command);

}

?>
