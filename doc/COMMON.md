# Common Drush Commands ###

## Create a Zen subtheme ##

### Requirements ###

* [Zen](https://drupal.org/project/ZEN) theme

### Usage ###

If you want to create a starterkit theme

* `drush zen "Full Theme Name" theme_name --without-rtl --path=sites/all/themes`
  * This will create a directory named *theme_name* under *sites/all/themes*
* To enable newly created theme, run `drush en theme_name`
* To set it as the default theme, run `drush vset theme_default theme_name`

If you want to remove the theme

* Run `drush dis theme_name` to disable the theme
* Delete theme directory from *sites/all/themes*