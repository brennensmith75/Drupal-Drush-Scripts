#!/usr/bin/php
<?php

/**
 *
 * Set event calendar
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

  // Enable needed modules and disable unneeded
  system('drush --yes pm-disable calendar_ical'); // Calendar iCal kapatiliyor
  system('drush --yes pm-enable date_popup'); // Date Popup aciliyor

  // Convert "Event" content type to multi-lingual
  $lang = system('drush php-eval \'echo i18n_get_lang();\'');
  $lang = trim($lang);
  system('drush --format=string vset language_content_type_event 2'); // This variable is a string!
  system('drush sql-query "UPDATE node SET language = \'' . trim($lang) . '\' WHERE type = \'event\'"');

  // Convert "Date" fields to "Popup Calendar" in the "Event" content type
  system('drush sql-query "UPDATE content_node_field_instance SET widget_type = \'date_popup\' WHERE field_name = \'field_event_date\'"');

  // If "Calendar" block is active, process it...
  $condition = system('drush block-show --region=sidebar | awk \'{print $2}\' | grep \'calendar-calendar_block_1\'');
  $condition = trim($condition);

  if (!empty($condition)) {

    // Do the action!
    system('drush block-disable --delta=calendar-calendar_block_1 --module=views'); // Command from "Drush Extras" module
    system('drush views-import drush-views/calendar.view'); // Command from "Drush Views" module
    system('drush block-configure --module=views --delta=calendar-block_1 --region=sidebar --weight=0');

  } else {

    // Print information
    echo 'No active calendar block' . "\n";

  }

  // Clear all caches
  system('drush cc all');

  // Increase counter
  $counter++;

}

?>
