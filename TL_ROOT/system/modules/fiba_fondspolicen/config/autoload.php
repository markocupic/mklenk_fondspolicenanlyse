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
	// Classes
	'Markocupic\FondspolicenTcpdf'     => 'system/modules/fiba_fondspolicen/classes/FondspolicenTcpdf.php',

	// Models
	'Contao\FondspolicenModel'         => 'system/modules/fiba_fondspolicen/models/FondspolicenModel.php',

	// Modules
	'Markocupic\FondspolicenVergleich' => 'system/modules/fiba_fondspolicen/modules/FondspolicenVergleich.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'fondspolicenvergleich_tcpdf' => 'system/modules/fiba_fondspolicen/templates',
	'mod_fondspolicenvergleich'   => 'system/modules/fiba_fondspolicen/templates',
));
