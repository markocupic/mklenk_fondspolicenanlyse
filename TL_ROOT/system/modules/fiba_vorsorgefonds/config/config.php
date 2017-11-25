<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 02.03.2017
 * Time: 22:25
 */

$GLOBALS['BE_MOD']['fiba']['vorsorgefonds'] = array
(
    'tables' => array('tl_vorsorgefonds'),
    'icon'   => 'system/modules/fiba_vorsorgefonds/assets/icons/table.png'
);


/**
 * Front end modules
 */
if(!isset($GLOBALS['FE_MOD']['fiba']))
{
    $GLOBALS['FE_MOD']['fiba'] = array();
}

$GLOBALS['FE_MOD']['fiba']['vorsorgefondslist'] = 'Markocupic\ModuleVorsorgefondsList';


if(TL_MODE == 'FE')
{
    $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/fiba_vorsorgefonds/assets/js/vorsorgefonds-liste-filter.js';
    $GLOBALS['TL_CSS'][] = 'system/modules/fiba_vorsorgefonds/assets/css/vorsorgefonds-liste-filter.css';
}