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


/**
 * Namespace
 */

namespace FibaMemberPlus;


/**
 * Class tl_member_fiba
 *
 * @copyright  Marko Cupic 2017
 * @author     Marko Cupic
 * @package    Devtools
 */
class ReplaceInsertTags extends \Controller
{
public function __controller()
{
    return parent::__controller();
}

    /**
     * Replace insert tags with their values
     *
     * @param string $strBuffer The text with the tags to be replaced
     * @param boolean $blnCache If false, non-cacheable tags will be replaced
     *
     * @return string The text with the replaced tags
     */
    public function replaceInsertTags($strTag)
    {
        if (FE_USER_LOGGED_IN)
        {
            $this->import('FrontendUser', 'User');
            if (strpos($strTag, 'userFiba::') !== false)
            {
                //empfehlungsgeberLevel,empfehlungsgeberAusbezahltePraemie,empfehlungsgeberEmpohleneKunden;{betreut_durch_vermittler_legend},betreutDurchVermittlerName,betreutDurchVermittlerPhone,betreutDurchVermittlerFax,betreutDurchVermittlerEmail;';

                switch ($strTag)
                {
                    // Date
                    case 'userFiba::empfehlungsgeberLevel':
                        return $this->User->empfehlungsgeberLevel;
                        break;

                }
            }


        }


        return false;
    }
}
