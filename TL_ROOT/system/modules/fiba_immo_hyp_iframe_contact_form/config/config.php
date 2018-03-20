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
if (TL_MODE == 'FE')
{
    // Write comapany name to the hidden field companyName
    $GLOBALS['TL_HOOKS']['loadFormField'][] = array('Markocupic\\FibaImmoHypIframeContactForm\\FormHook', 'loadFormFieldHook');

    // Send copy to partnerHiredByEmail
    $GLOBALS['TL_HOOKS']['processFormData'][] = array('Markocupic\\FibaImmoHypIframeContactForm\\FormHook', 'processFormDataHook');
}

// CSS
if (TL_MODE == 'BE')
<<<<<<< HEAD
{
    $GLOBALS['TL_CSS'][] = 'system/modules/fiba_immo_hyp_iframe_contact_form/assets/css/be_style.css';
}

if (TL_MODE == 'FE')
{
    $GLOBALS['TL_CSS'][] = 'system/modules/fiba_immo_hyp_iframe_contact_form/assets/css/fe_style.css';
=======
{
    $GLOBALS['TL_CSS'][] = 'system/modules/fiba_immo_hyp_iframe_contact_form/assets/css/be_style.css';
>>>>>>> a1c556eeea272f0a35d0c7f4a0e7ecaaca2a62bf
}
