#!/usr/bin/php
<?php

/**
 *
 * Show empty faculty names
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

// Just to be cautious about charset...
header('Content-Type: text/html; charset=utf-8');

// Include needed files
require_once '../includes/variables.php';
require_once '../includes/common.php';

// Get directories
$data = getSites();

// Initialize counter variables
$site_count = count($data);
$counter = 1;

// Read the file
$other_depts_pre = file('others/others.txt', FILE_SKIP_EMPTY_LINES);

// Trim whitespace
foreach ($other_depts_pre as $r) {

  $other_depts[] = trim($r);

}

// Assign variables to an easy-to-use associative array.
for ($i = 0; $i < count($other_depts) + 1; $i = $i + 4) {

  if (!empty($other_depts[$i])) {

    $link = $other_depts[$i + 3];
    $shorts[$link]['short_name'] = $other_depts[$i];
    $names[$link]['name_en'] = $other_depts[$i + 1];
    $names[$link]['name_tr'] = $other_depts[$i + 2];

  }

}

// Start looping within the sites
foreach ($data as $d) {

  // Set directory path for easy access
  $dir_path = $variables['dir'] . '/' . $d;

  // Change to the site directory in consideration
  chdir($dir_path);

  // Print some information
  echo 'Site #: ' . $counter . ' / ' . $site_count . "\n" . 'Processing: ' . $d . "\n";


  // Wow! We have "i18n_variable_set" and "i18n_variable_get" coommands!!
  $command_en = 'drush sql-query "SELECT value FROM i18n_variable WHERE name = \'site_slogan\' AND language = \'en\'"';

  // Do the action!
  $lang_en = system($command_en);

  $lang_values_en = explode('value', $lang_en);
  $lang_en = unserialize(trim($lang_values_en[0]));

  // Get empty sites to an array
  if (empty($lang_en)) {

    $empty_sites[] = $d;

  }

  // Increase counter
  $counter++;

}

// Finally, print the result
foreach ($empty_sites as $es) {

  echo $es . "\n";

}

?>
