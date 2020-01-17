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

import('lib.pkp.classes.plugins.GenericPlugin');

class SitesearchPlugin extends GenericPlugin {
	
	/**
	 * @copydoc LazyLoadPlugin::register()
	 */
	function register($category, $path, $mainContextId = NULL) {
		$success = parent::register($category, $path, $mainContextId);
		if (!Config::getVar('general', 'installed') || defined('RUNNING_UPGRADE')) return true;
		if ($success && $this->getEnabled()) {
			// Override the search templates
			HookRegistry::register('TemplateManager::display', array($this, 'handleTemplateProcess'));
			}
		return $success;
	}

	/**
	 * Get the display name of this plugin.
	 * @return String
	 */
	function getDisplayName() {
		return __('plugins.generic.sitesearch.displayName');
	}

	/**
	 * Get a description of the plugin.
	 * @return String
	 */
	function getDescription() {
		return __('plugins.generic.sitesearch.description');
	}

	/**
	 * Hook callback: register output filter to modify the search form action
	 * @see TemplateManager::display()
	 */
	function handleTemplateProcess($hookName, $args) {
		
		$templateMgr = $args[0];
		$template = $args[1];
		/*
		 * FIXME: this should really target just "frontend/pages/search.tpl" and "frontend/components/searchForm_simple.tpl"
                 * But searchForm_simple is processed neither through the ::display or ::fetch hooks, so we are stuck with a global replace.
		 */
		if (strpos($template, 'frontend/pages/') === 0) {
			if(method_exists($templateMgr, 'registerFilter')) {
				// OJS 3.1.2 and later (Smarty 3)
				$templateMgr->registerFilter("output", array($this, 'filterFormAction'));
			} else {
				// OJS 3.1.1 and earlier (Smarty 2)
				$templateMgr->register_outputfilter(array($this, 'filterFormAction'));
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
	function filterFormAction($output, $templateMgr) {
		$request = $this->getRequest();
		$router = $request->getRouter();
		$dispatcher = $router->getDispatcher();
		$contextSearch = $dispatcher->url($request, ROUTE_PAGE, null, 'search');
		$siteSearch = $dispatcher->url($request, ROUTE_PAGE, 'index', 'search');
		$output = str_replace($contextSearch, $siteSearch, $output);
		return $output;
	}


	/**
	 * @see PKPPlugin::getTemplatePath()
	 */
	function getTemplatePath($inCore = false) {
		$templatePath = parent::getTemplatePath($inCore);
		// OJS 3.1.2 and later include the 'templates' directory, but no trailing slash
		$templateDir = 'templates';
		if (strlen($templatePath) >= strlen($templateDir)) {
			if (substr_compare($templatePath, $templateDir, strlen($templatePath) - strlen($templateDir), strlen($templateDir)) === 0) {
				return $templatePath;
			}
		}
		// OJS 3.1.1 and earlier includes a trailing slash to the plugin path
		return $templatePath . $templateDir . DIRECTORY_SEPARATOR;
	}	

}
