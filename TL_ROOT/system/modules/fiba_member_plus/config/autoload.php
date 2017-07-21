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
	'FibaMemberPlus\ReplaceInsertTags'                   => 'system/modules/fiba_member_plus/classes/ReplaceInsertTags.php',
	'FibaMemberPlus\FibaHooks'                           => 'system/modules/fiba_member_plus/classes/FibaHooks.php',

	// Modules
	'FibaMemberPlus\ModuleFibaListEmpfehlungsgeber'      => 'system/modules/fiba_member_plus/modules/ModuleFibaListEmpfehlungsgeber.php',
	'FibaMemberPlus\ModuleFibaEmpfehlungsgeberDashboard' => 'system/modules/fiba_member_plus/modules/ModuleFibaEmpfehlungsgeberDashboard.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_fiba_list_empfehlungsgeber'      => 'system/modules/fiba_member_plus/templates',
	'mod_fiba_empfehlungsgeber_dashboard' => 'system/modules/fiba_member_plus/templates',
));
