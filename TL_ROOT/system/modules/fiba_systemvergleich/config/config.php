<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 02.03.2017
 * Time: 22:25
 */
if(!isset($GLOBALS['BE_MOD']['fiba']))
{
    $GLOBALS['BE_MOD']['fiba'] = array();
}
$GLOBALS['BE_MOD']['fiba']['fiba_systemvergleich'] = array
(
    'tables' => array('tl_fiba_systemvergleich'),
    'icon'   => 'system/modules/fiba_systemvergleich/assets/icons/table.png'
);


/**
 * Front end modules
 */
if(!isset($GLOBALS['FE_MOD']['fiba']))
{
    $GLOBALS['FE_MOD']['fiba'] = array();
}

$GLOBALS['FE_MOD']['fiba']['mod_fiba_systemvergleich'] = 'Markocupic\ModuleFibaSystemvergleich';


if(TL_MODE == 'FE')
{
    $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/fiba_systemvergleich/assets/js/fibaSystemvergleich.js';
}