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
$GLOBALS['BE_MOD']['fiba']['fiba_fonds_renditevergleich'] = array
(
    'tables' => array('tl_fonds_renditevergleich'),
    'icon'   => 'system/modules/fiba_fonds_renditevergleich/assets/icons/table.png'
);



if(!isset($GLOBALS['FE_MOD']['fiba']))
{
    $GLOBALS['FE_MOD']['fiba'] = array();
}

$GLOBALS['FE_MOD']['fiba']['fonds_renditevergleich'] = 'Markocupic\ModuleFondsRenditevergleich';


if(TL_MODE == 'FE')
{
    $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/fiba_fonds_renditevergleich/assets/js/fondsRenditevergleichTable.js';
    $GLOBALS['TL_CSS'][] = 'system/modules/fiba_fonds_renditevergleich/assets/css/fondsRenditevergleichTable.css';
}