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
	'Markocupic',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Modules
	'Markocupic\ModuleVorsorgefondsList' => 'system/modules/fiba_vorsorgefonds/modules/ModuleVorsorgefondsList.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'form_checkbox_bootstrap'     => 'system/modules/fiba_vorsorgefonds/templates',
	'mod_vorsorgefonds_list'      => 'system/modules/fiba_vorsorgefonds/templates',
	'mod_vorsorgefonds_list_ajax' => 'system/modules/fiba_vorsorgefonds/templates',
));
