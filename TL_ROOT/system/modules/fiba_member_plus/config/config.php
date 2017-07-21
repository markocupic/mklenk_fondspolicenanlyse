<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @package   FibaMemberPlus
 * @author    Marko Cupic
 * @license   GNU/LGPL
 * @copyright Marko Cupic 2017
 */

// HOOKS
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('FibaMemberPlus\ReplaceInsertTags', 'replaceTags');
/**
 * New tags
 * {{userFiba::empfehlungsgeberLevel}}
 * {{userFiba::empfehlungsgeberAusbezahltePraemie}}
 * {{userFiba::empfehlungsgeberEmpohleneKunden|nl2br}}
 * {{userFiba::betreutDurchVermittlerName}}
 * {{userFiba::betreutDurchVermittlerPhone}}
 * {{userFiba::betreutDurchVermittlerFax}}
 * {{userFiba::betreutDurchVermittlerEmail}}{{br}}
 */


$GLOBALS['TL_CSS'][] = 'system/modules/fiba_member_plus/assets/stylesheet.css';


/**
 * Front end modules
 */
$GLOBALS['FE_MOD']['fiba']['fibaListEmpfehlungsgeber'] = 'FibaMemberPlus\ModuleFibaListEmpfehlungsgeber';


// HOOKS
$GLOBALS['TL_HOOKS']['createNewUser'][] = array('FibaMemberPlus\FibaHooks', 'createNewUser');
$GLOBALS['TL_HOOKS']['processFormData'][] = array('FibaMemberPlus\FibaHooks', 'processFormData');
$GLOBALS['TL_HOOKS']['getAttributesFromDca'][] = array('FibaMemberPlus\FibaHooks', 'getAttributesFromDca');
$GLOBALS['TL_HOOKS']['parseWidget'][] = array('FibaMemberPlus\FibaHooks', 'parseWidget');
$GLOBALS['TL_HOOKS']['parseFrontendTemplate'][] = array('FibaMemberPlus\FibaHooks', 'parseFrontendTemplate');







