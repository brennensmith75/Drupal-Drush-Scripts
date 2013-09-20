#!/usr/bin/php
<?php

/**
 *
 * Enable and setup CAPTCHA and reCAPTCHA modules
 * Note: You need to manually download CAPTCHA and reCAPTCHA modules
 * CAPTCHA Module: https://drupal.org/project/captcha
 * reCAPTCHA Module: https://drupal.org/project/recaptcha
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

  // Print informational messages
  echo 'Site #: ' . $counter . ' / ' . $site_count . "\n" . 'Processing: ' . $d . "\n";

  // Activate the needed modules
  system('drush --yes en captcha recaptcha');

// Get all Webform Node IDs to a file
  system('drush sql-query "SELECT nid FROM webform" --result-file=sites/' . $d . '/files/orb_sql_data_1234560.txt');

  // Put file contents into an array
  $lines = file($dir_path . '/files/orb_sql_data_1234560.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

  /*
  // Remove captcha points, if you re-run this script
  system('drush sql-query "TRUNCATE captcha_points"');
  */

  // Start looping within the node IDs
  foreach ($lines as $l) {

    // Clear whitespace
    $l = trim($l);

    // SQL query returns the row name and we need to pass it
    if ($l == 'nid') {
      continue;
    }

    // Form IDs are stored like this
    $webform = 'webform_client_form_' . $l;

    // Prepare Drush command and set all forms use reCAPTCHA
    $values = "drush sql-query \"INSERT INTO captcha_points (form_id,module,captcha_type) VALUES ('$webform','recaptcha','reCAPTCHA')\"";

    // Run the command
    system($values);

  }

  // reCAPTCHA Settings
  system('drush vset recaptcha_public_key "YOUR_PUBLIC_KEY"');
  system('drush vset recaptcha_private_key "YOUR_PRIVATE_KEY"');
  system('drush vset recaptcha_secure_connection 1');
  system('drush vset recaptcha_ajax_api 0');
  /*system('drush vset captcha_description_en "This question is for testing whether you are a human visitor and to prevent automated spam submissions."');
  system('drush vset captcha_description_tr "Bu soru sizin bir insan olup olmadığınızı denetlemek ve otomatik spam gönderilerini önlemek içindir."');*/
  system('drush vset captcha_default_validation "1"');
  system('drush vset captcha_administration_mode 0');
  system('drush vset captcha_allow_on_admin_pages 0');
  system('drush vset captcha_default_challenge "recaptcha/reCAPTCHA"');
  system('drush vset captcha_add_captcha_description 0');
  system('drush vset captcha_log_wrong_responses 0');
  system('drush vset captcha_persistence "0"');
  system('drush vset recaptcha_tabindex ""');

  // Delete the file we have produced to store SQL query results
  system('rm ' . $dir_path . '/files/orb_sql_data_1234560.txt');

  // Clear all caches
  system('drush cc all');

  // Increase counter
  $counter++;

}

?>
