<?php

/**
 * @file plugins/generic/sitesearch/SitesearchPlugin.inc.php
 *
 * Copyright (c) University of Pittsburgh
 * Distributed under the GNU GPL v2 or later. For full terms see the LICENSE file.
 *
 * @class SitesearchPlugin
 * @ingroup plugins_generic_sitesearch
 *
 * @brief Sitesearch plugin class
 */

use PKP\plugins\GenericPlugin;
use PKP\plugins\Hook;
use PKP\core\PKPApplication;

class SitesearchPlugin extends GenericPlugin {
	
	/**
	 * @copydoc LazyLoadPlugin::register()
	 */
	public function register($category, $path, $mainContextId = NULL) {
		$success = parent::register($category, $path, $mainContextId);
		if (!Config::getVar('general', 'installed') || defined('RUNNING_UPGRADE')) return true;
		if ($success && $this->getEnabled()) {
			// Override the search templates
			Hook::add('TemplateManager::display', array($this, 'handleTemplateProcess'));
			}
		return $success;
	}

	/**
	 * Get the display name of this plugin.
	 * @return String
	 */
	public function getDisplayName() {
		return __('plugins.generic.sitesearch.displayName');
	}

	/**
	 * Get a description of the plugin.
	 * @return String
	 */
	public function getDescription() {
		return __('plugins.generic.sitesearch.description');
	}

	/**
	 * Hook callback: register output filter to modify the search form action
	 * @see TemplateManager::display()
	 */
	public function handleTemplateProcess($hookName, $args) {
		
		$templateMgr = $args[0];
		$template = $args[1];
		if (strpos($template, 'frontend/pages/') === 0) {
			if(method_exists($templateMgr, 'registerFilter')) {
				$templateMgr->registerFilter("output", array($this, 'filterFormAction'));
			}
		}
		return false;
	}

	/**
	 * Output filter to change the form target
	 * @param $output string
	 * @param $templateMgr TemplateManager
	 * @return $string
	 */
	public function filterFormAction($output, $templateMgr) {
		$request = $this->getRequest();
		$router = $request->getRouter();
		$dispatcher = $router->getDispatcher();
		$routePage = PKPApplication::ROUTE_PAGE;
		$contextSearch = $dispatcher->url($request, $routePage, null, 'search');
		$siteSearch = $dispatcher->url($request, $routePage, 'index', 'search');
		$output = str_replace($contextSearch, $siteSearch, $output);
		return $output;
	}
}
