# Sitesearch plugin for PKP

This plugin rewrites the search for a context to the site level.  This is used in the case where one journal has assumed the operations of one or more other journals (which are installed in the same site).

For example, suppose the Journal of Autonomous Variables (JoAV) used to be called the Journal of Variable Technology (JoVT), and also took over for the Journal of Variable Mechanics (JoVM).  When viewing JoVT or JoVM, the JoAV managers may want searches to include both the archival content and the new content from the current journal publication.  Enabling this plugin for JoVT and JoVM will force searches done in those journals to be performed at the site level, including the contents from all journals.

## Requirements

* OJS 3.4 / OMP 3.4 or later
* PHP 8.0 or later

## Installation

Install this as a "generic" plugin. The preferred installation method is through the Plugin Gallery.

To install manually via the filesystem, extract the contents of this archive to an "sitesearch" directory under "plugins/generic" in your OJS root.  To install via Git submodule, target that same directory path: `git submodule add https://github.com/ulsdevteam/pkp-sitesearch plugins/generic/sitesearch`.  Run the plugin install script to register this plugin, e.g.: `php lib/pkp/tools/installPluginVersion.php plugins/generic/sitesearch/version.xml`, or run the upgrade script, e.g.: `php tools/upgrade.php upgrade`

## Configuration

No configuration is needed.  Just enable and go!

## Usage

The display of templates for the search handler and for the simple searchbar will be modified to point to the index search for the context(s) in which this is enabled.

## Author / License

Written by Clinton Graham and Tazio Polanco for the [University of Pittsburgh](http://www.pitt.edu).  Copyright (c) University of Pittsburgh.

Released under a license of GPL v2 or later.
