<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @package   FondspolicenVergleich
 * @author    Marko Cupic
 * @license   SHAREWARE
 * @copyright Marko Cupic 2016
 */







/**
 * BACK END MODULES
 *
 * Back end modules are stored in a global array called "BE_MOD". You can add
 * your own modules by adding them to the array.
 */
array_insert($GLOBALS['BE_MOD']['content'], 1, array(
    'fondspolicen' => array(
        'tables' => array('tl_fondspolicen'),
        'icon'   => 'system/modules/fondspolicen/assets/icon.png',
    ),
));


/**
 * FRONT END MODULES
 *
 * Front end modules are stored in a global array called "FE_MOD". You can add
 * your own modules by adding them to the array.
 **/
$GLOBALS['FE_MOD']['fondspolicen'] = array(
    'fondspolicenvergleich' => 'MCupic\FondspolicenVergleich',

);

