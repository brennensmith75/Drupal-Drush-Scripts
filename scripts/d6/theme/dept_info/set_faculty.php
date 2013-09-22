#!/usr/bin/php
<?php

/**
 *
 * Set faculty names
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

// Read the files
$fac_eng_pre = file('depts/fac_eng.txt', FILE_SKIP_EMPTY_LINES);
$fac_edu_pre = file('depts/fac_edu.txt', FILE_SKIP_EMPTY_LINES);
$fac_arch_pre = file('depts/fac_arch.txt', FILE_SKIP_EMPTY_LINES);
$fac_artsci_pre = file('depts/fac_artsci.txt', FILE_SKIP_EMPTY_LINES);
$fac_eas_pre = file('depts/fac_eas.txt', FILE_SKIP_EMPTY_LINES);
$fbe_pre = file('depts/fbe.txt', FILE_SKIP_EMPTY_LINES);
$sbe_pre = file('depts/sbe.txt', FILE_SKIP_EMPTY_LINES);
$ee_pre = file('depts/ee.txt', FILE_SKIP_EMPTY_LINES);
$sfl_pre = file('depts/sfl.txt', FILE_SKIP_EMPTY_LINES);

// Trim whitespace due to EOL (/r/n)
foreach ($fac_eng_pre as $r) {
  $fac_eng[] = trim($r);
}
foreach ($fac_edu_pre as $r) {
  $fac_edu[] = trim($r);
}
foreach ($fac_arch_pre as $r) {
  $fac_arch[] = trim($r);
}
foreach ($fac_artsci_pre as $r) {
  $fac_artsci[] = trim($r);
}
foreach ($fac_artsci_pre as $r) {
  $fac_artsci[] = trim($r);
}
foreach ($fac_eas_pre as $r) {
  $fac_eas[] = trim($r);
}
foreach ($fbe_pre as $r) {
  $fbe[] = trim($r);
}
foreach ($sbe_pre as $r) {
  $sbe[] = trim($r);
}
foreach ($ee_pre as $r) {
  $ee[] = trim($r);
}
foreach ($sfl_pre as $r) {
  $sfl[] = trim($r);
}

// Prepare TR and EN names of faculties
$names_fac_eng_tr = 'MÜHENDİSLİK FAKÜLTESİ';
$names_fac_eng_en = 'FACULTY OF ENGINEERING';
$names_fac_edu_tr = 'EĞİTİM FAKÜLTESİ';
$names_fac_edu_en = 'FACULTY OF EDUCATION';
$names_fac_arch_tr = 'MİMARLIK FAKÜLTESİ';
$names_fac_arch_en = 'FACULTY OF ARCHITECTURE';
$names_fac_artsci_tr = 'FEN EDEBİYAT FAKÜLTESİ';
$names_fac_artsci_en = 'FACULTY OF ARTS AND SCIENCES';
$names_fac_eas_tr = 'İKTİSADİ VE İDARİ BİLİMLER FAKÜLTESİ';
$names_fac_eas_en = 'FACULTY OF ECONOMIC AND ADMINISTRATIVE SCIENCES';
$names_fbe_tr = 'FEN BİLİMLERİ ENSTİTÜSÜ';
$names_fbe_en = 'GRADUATE SCHOOL OF NATURAL AND APPLIED SCIENCES';
$names_sbe_tr = 'SOSYAL BİLİMLER ENSTİTÜSÜ';
$names_sbe_en = 'GRADUATE SCHOOL OF SOCIAL SCIENCES';
$names_ee_tr = 'ENFORMATİK ENSTİTÜSÜ';
$names_ee_en = 'GRADUATE SCHOOL OF INFORMATICS';
$names_sfl_tr = 'YABANCI DİLLER YÜKSEKOKULU';
$names_sfl_en = 'SCHOOL OF FOREIGN LANGUAGES';

// Start looping within the sites
foreach ($data as $d) {

  // Set directory path for easy access
  $dir_path = $variables['dir'] . '/' . $d;

  // Change to the site directory in consideration
  chdir($dir_path);

  // Print some information
  echo 'Site #: ' . $counter . ' / ' . $site_count . "\n" . 'Processing: ' . $d . "\n";

  // Set the variables to be assigned as "site_slogan"
  if (in_array($d, $fac_eng)) {

    $data_tr = $names_fac_eng_tr;
    $data_en = $names_fac_eng_en;

  } elseif (in_array($d, $fac_edu)) {

    $data_tr = $names_fac_edu_tr;
    $data_en = $names_fac_edu_en;

  } elseif (in_array($d, $fac_arch)) {

    $data_tr = $names_fac_arch_tr;
    $data_en = $names_fac_arch_en;

  } elseif (in_array($d, $fac_artsci)) {

    $data_tr = $names_fac_artsci_tr;
    $data_en = $names_fac_artsci_en;

  } elseif (in_array($d, $fac_eas)) {

    $data_tr = $names_fac_eas_tr;
    $data_en = $names_fac_eas_en;

  } elseif (in_array($d, $fbe)) {

    $data_tr = $names_fbe_tr;
    $data_en = $names_fbe_en;

  } elseif (in_array($d, $sbe)) {

    $data_tr = $names_sbe_tr;
    $data_en = $names_sbe_en;

  } elseif (in_array($d, $ee)) {

    $data_tr = $names_ee_tr;
    $data_en = $names_ee_en;

  } elseif (in_array($d, $sfl)) {

    $data_tr = $names_sfl_tr;
    $data_en = $names_sfl_en;

  } else {

    $data_tr = '';
    $data_en = '';

  }

  // If there isn't the name of the site inside the text files, we do not process it.
  if (isset($data_en) && isset($data_tr)) {

    // Wow! We have "i18n_variable_set" and "i18n_variable_get" coommands!!
    $command_tr = 'drush ev "i18n_variable_set(\'site_slogan\', \'' . $data_tr . '\', \'tr\')"';
    $command_en = 'drush ev "i18n_variable_set(\'site_slogan\', \'' . $data_en . '\', \'en\')"';

    // Do the action!
    system($command_tr);
    system($command_en);

    // Clear all caches
    system('drush cc all');

  }

  // Increase counter
  $counter++;

}

?>
