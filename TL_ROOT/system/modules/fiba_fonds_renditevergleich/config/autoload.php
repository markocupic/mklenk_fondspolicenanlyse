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
	'Markocupic\ModuleFondsRenditevergleich' => 'system/modules/fiba_fonds_renditevergleich/modules/ModuleFondsRenditevergleich.php',

    // Models
    'Contao\FondsRenditevergleichModel'            => 'system/modules/fiba_fonds_renditevergleich/models/FondsRenditevergleichModel.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_fonds_renditevergleich'                     => 'system/modules/fiba_fonds_renditevergleich/templates',
	'mod_fonds_renditevergleich_ajax'                => 'system/modules/fiba_fonds_renditevergleich/templates',
));
