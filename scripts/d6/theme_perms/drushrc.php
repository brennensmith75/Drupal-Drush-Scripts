<?php

/**
 *
 * User scope Drush configuration file
 * Note: Put this file under ".drush" directory
 *
 */

// Settings for Environments Drush Module
$options['environments'] = array(
  'orbingol' => array(
    'permissions' => array(
      'site admin' => array(
        'grant' => array(
          'administer themes',
        ),
      ),
    ),
  ),
);

?>
