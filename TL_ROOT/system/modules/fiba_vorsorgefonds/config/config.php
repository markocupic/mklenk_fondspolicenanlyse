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

array_insert($GLOBALS['FE_MOD'], 2, array
(
    'vorsorgefonds' => array
    (
        'vorsorgefondslist'    => 'Markocupic\ModuleVorsorgefondsList',
    )
));

if(TL_MODE == 'FE')
{
    $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/fiba_vorsorgefonds/assets/js/vorsorgefonds-liste-filter.js';
    $GLOBALS['TL_CSS'][] = 'system/modules/fiba_vorsorgefonds/assets/css/vorsorgefonds-liste-filter.css';
}