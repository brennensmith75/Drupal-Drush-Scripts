# Drush Scripts #

## Introduction ##

These scripts manage configuration of Drupal multi-site installations from CLI. All of them are written in PHP and several of them uses Drush plugins or extensions.

The scripts can be executed like a Bash script. Do not try to run them from web browser, because you will probably hit execution time limit of PHP. Generally CLI side does not have "maximum execution time" setting (hardcoded to 0).

Example: `./clear_cache_all.php`

## Prerequisites ##

### Main ###

* [Drush](https://drupal.org/project/drush)
* [Drush Environment](https://drupal.org/sandbox/bleen18/1696714) and information about this module on [author's website](http://bleen.net/blog/maintaining-different-settings-different-environments-drush)

### Others ###

* [CAPTCHA module](https://drupal.org/project/captcha)
* [reCAPTCHA module](https://drupal.org/project/recaptcha)
* [Permissions API](https://drupal.org/project/permissions_api) _(for D6 only)_
* [Link Checker](https://drupal.org/project/linkchecker)
* [Internalization](https://drupal.org/project/i18n)
* [Secure Pages](https://drupal.org/project/securepages) _(for D6 only)_
* [System Permissions](https://drupal.org/project/system_perm) _(for D6 only)_

## Downloading Scripts from Github ##

### For All Platforms ##

* You can use *Download ZIP* button on the right side.

### Windows (for development) ###

* It is possible to use [Github for Windows](http://windows.github.com).
* Additionally, [Atlassian SourceTree](http://www.sourcetreeapp.com) is a good alternative.
  * It requires a registration, but registration is free.
  * If you have a *Bitbucket* account, you can use it for this step.
* You can commit, push and pull changes to [Github repo](https://github.com/orbingol/drush) using these tools.
* For editing files, I recommend [Notepad++](http://notepad-plus-plus.org).

### Debian (for development) ###

* Use `apt-get install git` to install *Git* from terminal.
* Go to your development directory (or create one) and run `git clone https://github.com/orbingol/drush.git`
* Use your favorite editor to edit files. [Geany](http://www.geany.org) is very similar to Notepad++ on Windows.
* Read [Git documentation](http://git-scm.com/documentation) for details.
