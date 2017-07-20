<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 02.03.2017
 * Time: 22:25
 */

$GLOBALS['BE_MOD']['fiba']['fiba_fonds_renditevergleich'] = array
(
    'tables' => array('tl_fonds_renditevergleich'),
    'icon'   => 'system/modules/fiba_fonds_renditevergleich/assets/icons/table.png'
);

array_insert($GLOBALS['FE_MOD'], 2, array
(
    'vorsorgefonds' => array
    (
        'fonds_renditevergleich'    => 'Markocupic\ModuleFondsRenditevergleich',
    )
));

if(TL_MODE == 'FE')
{
    $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/fiba_fonds_renditevergleich/assets/js/fondsRenditevergleichTable.js';
    $GLOBALS['TL_CSS'][] = 'system/modules/fiba_fonds_renditevergleich/assets/css/fondsRenditevergleichTable.css';
}