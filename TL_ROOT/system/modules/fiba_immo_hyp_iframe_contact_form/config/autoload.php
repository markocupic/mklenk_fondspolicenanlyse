<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2018 Leo Feyer
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
	'Markocupic\FibaImmoHypIframeContactForm\LoadFormField'     => 'system/modules/fiba_immo_hyp_iframe_contact_form/classes/LoadFormField.php',

	// Models
	'Contao\FibaB2bPartnerModel'                                => 'system/modules/fiba_immo_hyp_iframe_contact_form/models/FibaB2bPartnerModel.php',

	// Modules
	'Markocupic\FibaImmoHypIframeContactForm\IframeContactForm' => 'system/modules/fiba_immo_hyp_iframe_contact_form/modules/IframeContactForm.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'be_fiba_b2b_hyp_iframe'    => 'system/modules/fiba_immo_hyp_iframe_contact_form/templates',
	'mod_custom_section_iframe' => 'system/modules/fiba_immo_hyp_iframe_contact_form/templates',
	'mod_iframe_contact_form'   => 'system/modules/fiba_immo_hyp_iframe_contact_form/templates',
));
