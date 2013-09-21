<?php

/**
 *
 * Custom code for adding items to menus using Drush
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

// Load needed Drupsl modules
module_load_include('inc', 'menu', 'menu.admin');

// Define an array
$form_state = array();

// Fill that array
$form_state['values']['menu'] = array(
  'link_path' => 'admin/reports/linkchecker',
  'link_title' => 'Broken Links',
  'description' => 'Shows non-working links in this website',
  'enabled' => 1,
  'expanded' => 0,
  'parent' => 'menu-important-links-admin:0',
  'weight' => 0,
  'customized' => 1,
);

// Do the action
drupal_execute('menu_edit_item', $form_state, 'add', NULL, array('menu_name' => 'menu-important-links-admin'));

?>
