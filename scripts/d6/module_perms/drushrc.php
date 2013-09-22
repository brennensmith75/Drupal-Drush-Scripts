<?php

/**
 *
 * User scope Drush configuration file
 * Note: Put this file under ".drush" or "sites/all/drush" directory
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

// Settings for Drush Environment module
$options['environments'] = array(
  'orbingol' => array(
    // The list of modules to enabled (1) or disable (0).
    'modules' => array(
      'permissions_api' => 1,
      'system_perm' => 1,
    ),
    // grant or revoke
    'permissions' => array(
      'site administrator' => array (
		'revoke' => array (
			'select different theme',
			'administer content types',
		),
		'grant' => array (
			'administer site information',
			'configure mytheme theme',
		),
      ),
    ),
  ),
);
?>
