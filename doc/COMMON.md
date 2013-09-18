# Common Drush Commands ###

## Create a Zen subtheme ##

### Requirements ###

* [Zen](https://drupal.org/project/ZEN) theme

### Usage ###

* `drush zen "Full Theme Name" theme_name --without-rtl --path=sites/all/themes`
  * This will create a directory named *theme_name* under *sites/all/themes*
* To enable newly created theme, run `drush en theme_name`
* To set it as the default theme, run `drush vset theme_default theme_name`