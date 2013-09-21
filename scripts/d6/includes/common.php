<?php

/**
 *
 * Common functions for use in Drush Scripts
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

// Include needed variables
require_once 'variables.php';

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
