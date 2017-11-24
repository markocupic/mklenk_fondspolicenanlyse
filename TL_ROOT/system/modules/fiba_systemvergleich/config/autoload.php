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
	'Markocupic\ModuleFibaSystemvergleich' => 'system/modules/fiba_systemvergleich/modules/ModuleFibaSystemvergleich.php',

	// Models
	'Contao\FibaSystemvergleichModel'      => 'system/modules/fiba_systemvergleich/models/FibaSystemvergleichModel.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_fiba_systemvergleich' => 'system/modules/fiba_systemvergleich/templates',
));
