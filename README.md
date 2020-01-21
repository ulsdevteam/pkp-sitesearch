# Sitesearch plugin for PKP

This plugin rewrites the search for a context to the site level.  This is used in the case where one journal has assumed the operations of one or more other journals (which are installed in the same site).

## Requirements

* OJS 3.x / OMP 3.1 or later
* PHP 7.2 or later

For an OJS 2.x. analog, see the [Block Site Search](https://github.com/ulsdevteam/ojs-sitesearch-plugin/) plugin.

## Installation

Install this as a "generic" plugin. The preferred installation method is through the Plugin Gallery.

To install manually via the filesystem, extract the contents of this archive to an "sitesearch" directory under "plugins/generic" in your OJS root.  To install via Git submodule, target that same directory path: `git submodule add https://github.com/ulsdevteam/pkp-sitesearch plugins/generic/sitesearch` and `git submodule update --init --recursive plugins/generic/sitesearch`.  Run the plugin install script to register this plugin, e.g.: `php lib/pkp/tools/installPluginVersion.php plugins/generic/sitesearch/version.xml`, or run the upgrade script, e.g.: `php tools/upgrade.php upgrade`

## Configuration

No configuration is needed.  Just enable and go!

## Usage

The display of templates for the search handler and for the simple searchbar will be modified to point to the index search for the context(s) in which this is enabled.

## Author / License

Written by Clinton Graham for the [University of Pittsburgh](http://www.pitt.edu).  Copyright (c) University of Pittsburgh.

Released under a license of GPL v2 or later.
