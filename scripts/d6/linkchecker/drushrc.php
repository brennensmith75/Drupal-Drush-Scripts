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
  // #key = The enviroment name.
  'orbingol' => array(
    // The list of modules to enabled (1) or disable (0).
    'modules' => array(
      'linkchecker' => 1,
      'permissions_api' => 1,
    ),
    'settings' => array(
      'linkchecker_scan_nodetypes' => array(
        'duyuru' => 'duyuru',
        'event' => 'event',
        'page' => 'page',
        'webform' => 'webform',
        'story' => 0,
      ),
      'linkchecker_scan_comments' => 0,
      'linkchecker_scan_blocks' => 1,
      'linkchecker_fqdn_only' => 0,
      'linkchecker_extract_from_a' => 1,
      'linkchecker_extract_from_audio' => 0,
      'linkchecker_extract_from_embed' => 0,
      'linkchecker_extract_from_iframe' => 0,
      'linkchecker_extract_from_img' => 1,
      'linkchecker_extract_from_object' => 0,
      'linkchecker_extract_from_source' => 0,
      'linkchecker_extract_from_video' => 0,
      'linkchecker_filter_blacklist' => array(
        'filter/1' => 'filter/1',
        'php/0' => 'php/0',
        'filter/3' => 0,
        'filter/0' => 0,
        'filter/2' => 0,
      ),
      'linkchecker_check_useragent' => "Drupal (+http://drupal.org/)",
      'linkchecker_check_links_interval' => "604800",
      'linkchecker_disable_link_check_for_urls' => "example.com
example.net
example.org",
      'linkchecker_action_status_code_301' => "3",
      'linkchecker_action_status_code_404' => "0",
      'linkchecker_ignore_response_codes' => "200
206
302
304
401
403",
    ),
    // grant or revoke
    'permissions' => array(
      'site admin' => array (
        'grant' => array (
          'access broken links report',
          'access own broken links report',
          'edit link settings',
        ),
      ),
    ),
  ),
);

?>
