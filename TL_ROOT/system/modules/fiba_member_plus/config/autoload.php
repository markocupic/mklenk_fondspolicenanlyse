<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'FibaMemberPlus',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'FibaMemberPlus\ReplaceInsertTags' => 'system/modules/fiba_member_plus/classes/ReplaceInsertTags.php',
));
