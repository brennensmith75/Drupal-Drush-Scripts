<?php

/**
 *
 * LDAP functions for use in Drush scripts
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

function ldap_check($username) {

  global $variables;

  $ds = ldap_connect($variables['ldap_server']);
  @$r = ldap_bind($ds);
  $dn = $variables['ldap_dn'];
  $filter = '(&(uid=' . $username . '))';
  @$sr = ldap_search($ds, $dn, $filter);
  @$info = ldap_get_entries($ds, $sr);

  if (ldap_count_entries($ds, $sr) == 0) {

    $check_result = 0;

  } else {

    $check_result = 1;
  }

  return $check_result;

}