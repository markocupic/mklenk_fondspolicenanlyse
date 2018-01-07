<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2018 Leo Feyer
 *
 * @package   FibaHypIframeContacForm
 * @author    Marko Cupic
 * @license   SHAREWARE
 * @copyright Marko Cupic 2018
 */


// Backend Modules
if (!isset($GLOBALS['BE_MOD']['fiba']))
{
	$GLOBALS['BE_MOD']['fiba'] = array();
}
$GLOBALS['BE_MOD']['fiba']['b2b_partner'] = array(
	'tables' => array('tl_fiba_b2b_partner'),
	'icon'   => 'system/modules/fiba_immo_hyp_iframe_contact_form/assets/icon.png',
);


// Frontend Modules
if (!isset($GLOBALS['FE_MOD']['fiba']))
{
	$GLOBALS['FE_MOD']['fiba'] = array();
}
$GLOBALS['FE_MOD']['fiba']['iframeContactForm'] = 'Markocupic\\FibaImmoHypIframeContactForm\\IframeContactForm';


// Hook
$GLOBALS['TL_HOOKS']['loadFormField'][] = array('Markocupic\\FibaImmoHypIframeContactForm\\LoadFormField', 'loadFormFieldHook');

// CSS
if(TL_MODE == 'BE')
{
	$GLOBALS['TL_CSS'][] = 'system/modules/fiba_immo_hyp_iframe_contact_form/assets/css/be_style.css';
}
