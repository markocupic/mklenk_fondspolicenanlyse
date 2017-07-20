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
 * Class ReplaceInsertTags
 *
 * @copyright  Marko Cupic 2017
 * @author     Marko Cupic
 * @package    FibaMemberPlus
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
    public function replaceTags($strTag)
    {
        if (FE_USER_LOGGED_IN)
        {
            $this->import('FrontendUser', 'User');
            if (strpos($strTag, 'userFiba::') !== false)
            {
                $arrTag = explode('::', $strTag);
                if (isset($arrTag[1]))
                {
                    switch ($arrTag[1])
                    {
                        case 'userFiba::empfehlungsgeberLevel':
                            return $this->User->empfehlungsgeberLevel;
                            break;
                        case 'userFiba::empfehlungsgeberAusbezahltePraemie':
                            return $this->User->empfehlungsgeberAusbezahltePraemie;
                            break;
                        case 'userFiba::empfehlungsgeberEmpohleneKunden':
                            return $this->User->empfehlungsgeberEmpohleneKunden;
                            break;
                        case 'userFiba::betreutDurchVermittlerName':
                            return $this->User->betreutDurchVermittlerName;
                            break;
                        case 'userFiba::betreutDurchVermittlerPhone':
                            return $this->User->betreutDurchVermittlerPhone;
                            break;
                        case 'userFiba::betreutDurchVermittlerFax':
                            return $this->User->betreutDurchVermittlerFax;
                            break;
                        case 'userFiba::betreutDurchVermittlerEmail':
                            return $this->User->betreutDurchVermittlerEmail;
                            break;
                        default:
                            if (!is_array($this->User->{$arrTag[1]}))
                            {
                                return $this->User->{$arrTag[1]};
                            }
                            break;
                    }
                }
            }
        }

        return false;
    }
}
