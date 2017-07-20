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
    {{userFiba::empfehlungsgeberLevel}}
    {{userFiba::empfehlungsgeberAusbezahltePraemie}}
    {{userFiba::empfehlungsgeberEmpohleneKunden|nl2br}}
    {{userFiba::betreutDurchVermittlerName}}
    {{userFiba::betreutDurchVermittlerPhone}}
    {{userFiba::betreutDurchVermittlerFax}}
    {{userFiba::betreutDurchVermittlerEmail}}{{br}}
 */
