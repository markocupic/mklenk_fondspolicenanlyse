<?php

/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 12.08.2017
 * Time: 12:27
 */
if(TL_MODE == 'FE'){
    $GLOBALS['TL_HOOKS']['generatePage'][] = array('Markocupic\Fiba\FibaMemberAutologin', 'validateAutologinKey');
    $GLOBALS['TL_HOOKS']['checkCredentials'][] = array('Markocupic\Fiba\FibaMemberAutologin', 'checkCredentials');
}
