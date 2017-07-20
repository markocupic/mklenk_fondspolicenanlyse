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

// New fields
$fibaFields = '{empfehlungsclub_legend},empfehlungsgeberLevel,empfehlungsgeberAusbezahltePraemie,empfehlungsgeberEmpohleneKunden;{betreut_durch_vermittler_legend},betreutDurchVermittlerName,betreutDurchVermittlerPhone,betreutDurchVermittlerFax,betreutDurchVermittlerEmail;';

$GLOBALS['TL_DCA']['tl_member']['palettes']['default'] = str_replace('{groups_legend', $fibaFields . '{groups_legend', $GLOBALS['TL_DCA']['tl_member']['palettes']['default']);


// Add Fields
$GLOBALS['TL_DCA']['tl_member']['fields']['empfehlungsgeberLevel'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_member']['empfehlungsgeberLevel'],
    'reference' => &$GLOBALS['TL_LANG']['tl_member']['empfehlungsgeberLevelReference'],
    'exclude' => true,
    'inputType' => 'select',
    'options' => array('1', '2', '3'),
    'eval' => array('mandatory' => true, 'tl_class' => 'w50'),
    'sql' => "varchar(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['empfehlungsgeberAusbezahltePraemie'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_member']['empfehlungsgeberAusbezahltePraemie'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('mandatory' => true, 'maxlength' => 9, 'rgxp' => 'natural', 'tl_class' => 'w50'),
    'sql' => "varchar(9) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['empfehlungsgeberEmpohleneKunden'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_member']['empfehlungsgeberEmpohleneKunden'],
    'exclude' => true,
    'inputType' => 'textarea',
    'eval' => array('mandatory' => true, 'maxlength' => 255, 'class' => 'clr'),
    'sql' => "mediumtext NULL"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['betreutDurchVermittlerName'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_member']['betreutDurchVermittlerName'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
    'sql' => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['betreutDurchVermittlerPhone'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_member']['betreutDurchVermittlerPhone'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('maxlength' => 64, 'rgxp' => 'phone', 'decodeEntities' => true, 'tl_class' => 'w50'),
    'sql' => "varchar(64) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_member']['fields']['betreutDurchVermittlerFax'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_member']['betreutDurchVermittlerFax'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('maxlength' => 64, 'rgxp' => 'phone', 'decodeEntities' => true, 'tl_class' => 'w50'),
    'sql' => "varchar(64) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_member']['fields']['betreutDurchVermittlerEmail'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_member']['betreutDurchVermittlerEmail'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('mandatory' => true, 'maxlength' => 255, 'rgxp' => 'email', 'decodeEntities' => true, 'tl_class' => 'w50'),
    'sql' => "varchar(255) NOT NULL default ''"
);
