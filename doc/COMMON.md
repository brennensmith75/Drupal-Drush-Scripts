# Common Drush Commands ###

## Super fast Drupal 7 install ##

### Summary ###

* Download Drupal using Drush *(Careful about version number)*
* Move downloaded Drupal directory to *public_html*
* Install Drupal using Drush

### Code ###

```
~$ drush dl drupal
~$ mv drupal-7.xx public_html
~$ cd public_html
~$ drush site-install --db-url=mysql://username:password@localhost/dbname
```

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