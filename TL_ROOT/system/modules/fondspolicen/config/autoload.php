<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'FondspolicenVergleich',
	'MCupic',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'MCupic\FondspolicenTcpdf' => 'system/modules/fondspolicen/classes/FondspolicenTcpdf.php',

	// Models
	'Contao\FondspolicenModel'            => 'system/modules/fondspolicen/models/FondspolicenModel.php',

	// Modules
	'MCupic\FondspolicenVergleich'        => 'system/modules/fondspolicen/modules/FondspolicenVergleich.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_fondspolicenvergleich' => 'system/modules/fondspolicen/templates',
	'fondspolicenvergleich_tcpdf' => 'system/modules/fondspolicen/templates',

));
