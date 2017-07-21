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
                        case 'empfehlungsgeberLevel':
                            return $this->User->empfehlungsgeberLevel;
                            break;
                        case 'empfehlungsgeberAusbezahltePraemie':
                            return (!$this->User->empfehlungsgeberAusbezahltePraemie > 0) ? '0' : $this->User->empfehlungsgeberAusbezahltePraemie;
                            break;
                        case 'empfehlungsgeberEmpohleneKunden':
                            return $this->User->empfehlungsgeberEmpohleneKunden;
                            break;
                        case 'betreutDurchVermittlerName':
                            if($this->User->fibaRole == 'isEmpfehlungsgeber' && $this->User->betreutDurchVermittlerId > 0)
                            {
                                $objVermittler = \MemberModel::findByPk($this->User->betreutDurchVermittlerId);
                                if($objVermittler !== null)
                                {
                                    return $objVermittler->firstname . ' ' . $objVermittler->lastname;
                                }
                            }
                            return 'Keinen betreuenden Vermittler gefunden.';
                            break;
                        case 'betreutDurchVermittlerPhone':
                            if($this->User->fibaRole == 'isEmpfehlungsgeber' && $this->User->betreutDurchVermittlerId > 0)
                            {
                                $objVermittler = \MemberModel::findByPk($this->User->betreutDurchVermittlerId);
                                if($objVermittler !== null)
                                {
                                    return $objVermittler->phone;
                                }
                            }
                            return 'Keine Nummer gefunden.';
                            break;
                        case 'betreutDurchVermittlerFax':
                            if($this->User->fibaRole == 'isEmpfehlungsgeber' && $this->User->betreutDurchVermittlerId > 0)
                            {
                                $objVermittler = \MemberModel::findByPk($this->User->betreutDurchVermittlerId);
                                if($objVermittler !== null)
                                {
                                    return $objVermittler->fax;
                                }
                            }
                            return 'Keine Faxnummer gefunden.';
                            break;
                        case 'betreutDurchVermittlerEmail':
                            if($this->User->fibaRole == 'isEmpfehlungsgeber' && $this->User->betreutDurchVermittlerId > 0)
                            {
                                $objVermittler = \MemberModel::findByPk($this->User->betreutDurchVermittlerId);
                                if($objVermittler !== null)
                                {
                                    return $objVermittler->email;
                                }
                            }
                            return 'Keine E-Mail-Adresse gefunden.';
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
