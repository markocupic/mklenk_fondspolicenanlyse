<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace FibaMemberPlus;


/**
 * Front end module "ModuleFibaListEmpfehlungsgeber".
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class ModuleFibaListEmpfehlungsgeber extends \Module
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_fiba_list_empfehlungsgeber';


    /**
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            /** @var \BackendTemplate|object $objTemplate */
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['fibaListEmpfehlungsgeber'][0]) . ' ###<br>' . $GLOBALS['TL_LANG']['FMD']['fibaListEmpfehlungsgeber'][1];
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

        $objUser = \FrontendUser::getInstance();
        if ($objUser === null || $objUser->fibaRole != 'isVermittler')
        {
            return '';
        }


        $this->User = $objUser;

        return parent::generate();
    }


    /**
     * Generate the module
     */
    protected function compile()
    {
        $arrEmpfehlungsgeber = [];
        $this->Template->User = $this->User;

        $objMember = \Database::getInstance()->prepare('SELECT * FROM tl_member WHERE fibaRole=? AND betreutDurchVermittlerId=? ORDER BY lastname, firstname')->execute('isEmpfehlungsgeber', $this->User->id);

        while ($objMember->next())
        {
            $empfehlungsgeber = [];
            $empfehlungsgeber['id'] = $objMember->id;
            $empfehlungsgeber['firstname'] = $objMember->firstname;
            $empfehlungsgeber['lastname'] = $objMember->lastname;
            $empfehlungsgeber['email'] = $objMember->email;
            $empfehlungsgeber['empfehlungsgeberLevel'] = $objMember->empfehlungsgeberLevel;
            $empfehlungsgeber['empfehlungsgeberAusbezahltePraemie'] = ($objMember->empfehlungsgeberAusbezahltePraemie > 0) ? $objMember->empfehlungsgeberAusbezahltePraemie : '0';
            $arrEmpfehlungsgeber[] = $empfehlungsgeber;
        }

        $this->Template->empfehlungsgeber = $arrEmpfehlungsgeber;
        $this->Template->countResults = count($arrEmpfehlungsgeber);

    }
}
