## Drush-PHP CLI Scripts for Drupal MS Installations ##

## Introduction ##

These scripts manage configuration of Drupal multi-site installations from CLI. All of them are written in PHP and several of them uses Drush plugins or extensions.

The scripts can be executed like a Bash script. Do not try to run them from web browser, because you will probably hit execution time limit of PHP. Generally CLI side does not have "maximum execution time" setting (hardcoded to 0).

Example: `./clear_cache_all.php`

## Prerequisites ##

* [Drush](https://drupal.org/project/drush)

## Downloading Scripts from Github ##

### For All Platforms ##

* You can use *Download as zip* button on the right side.

### Windows (for development) ###

* It is possible to use [Github for Windows](http://windows.github.com)
* Altenatively, [Atlassian SourceTree](http://www.sourcetreeapp.com) is a good alternative.
  * Requires free registration.
  * If you have *Bitbucket* account, you can use it for free registration.
* For editing files, I recommend [Notepad++](http://notepad-plus-plus.org).
* You can stage, commit and push changes to [Github repo](https://github.com/orbingol/drush) using these tools.

## Debian (for development) ##

* Use `apt-get install git` to install *Git* from terminal.
* Go to your development directory (or create one) and run `git checkout https://github.com/orbingol/drush.git`
* Use your favorite editor to edit files. [Geany](http://www.geany.org) is very similar to Notepad++ on Windows.
* Checkout [Git documentation](http://git-scm.com/documentation) for details.
