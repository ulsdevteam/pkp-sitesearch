<?php

/**
 * @defgroup plugins_generic_sitesearch
 */
 
/**
 * @file plugins/generic/sitesearch/index.php
 *
 * Copyright (c) University of Pittsburgh
 * Distributed under the GNU GPL v2 or later. For full terms see the LICENSE file.
 *
 * @ingroup plugins_generic_sitesearch
 * @brief Wrapper for Sitesearch plugin.
 *
 */

require_once('SitesearchPlugin.inc.php');

return new SitesearchPlugin();
