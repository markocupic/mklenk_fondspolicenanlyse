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
 * Table tl_member
 */
$GLOBALS['TL_DCA']['tl_member']['config']['onload_callback'][] = array('tl_member_fiba', 'setPalettes');
$GLOBALS['TL_DCA']['tl_member']['config']['onload_callback'][] = array('tl_member_fiba', 'checkTable');

// Clean palette from unused fields
$GLOBALS['TL_DCA']['tl_member']['palettes']['default'] = '{personal_legend},firstname,lastname;{address_legend:hide},company,street,postal,city;{contact_legend},phone,mobile,fax,email;{groups_legend},groups;{login_legend},login;{account_legend},disable,start,stop';

// Add new fields to palette
$GLOBALS['TL_DCA']['tl_member']['palettes']['default'] = str_replace('{personal_legend', '{role_legend},fibaRole;{personal_legend', $GLOBALS['TL_DCA']['tl_member']['palettes']['default']);


// Add Fields
$GLOBALS['TL_DCA']['tl_member']['fields']['fibaRole'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_member']['fibaRole'],
    'filter' => true,
    'sorting' => true,
    'exclude' => true,
    'inputType' => 'select',
    'options' => array('isVermittler', 'isEmpfehlungsgeber'),
    'reference' => &$GLOBALS['TL_LANG']['tl_member'],
    'eval' => array('submitOnChange' => true, 'includeBlankOption' => true, 'mandatory' => false, 'tl_class' => 'w50'),
    'sql' => "varchar(32) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['vermittlerId'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_member']['vermittlerId'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('unique' => true, 'mandatory' => true, 'tl_class' => 'clr'),
    'sql' => "varchar(128) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['empfehlungsgeberLevel'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_member']['empfehlungsgeberLevel'],
    'filter' => true,
    'sorting' => true,
    'search' => true,
    'reference' => &$GLOBALS['TL_LANG']['tl_member']['empfehlungsgeberLevelReference'],
    'exclude' => true,
    'inputType' => 'select',
    'options' => array('0', '1', '2', '3'),
    'eval' => array('mandatory' => true, 'tl_class' => 'w50'),
    'sql' => "varchar(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['empfehlungsgeberAusbezahltePraemie'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_member']['empfehlungsgeberAusbezahltePraemie'],
    'filter' => true,
    'sorting' => true,
    'search' => true,
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('mandatory' => false, 'maxlength' => 9, 'rgxp' => 'natural', 'tl_class' => 'w50'),
    'sql' => "varchar(9) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['empfehlungsgeberEmpohleneKunden'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_member']['empfehlungsgeberEmpohleneKunden'],
    'search' => true,
    'exclude' => true,
    'inputType' => 'textarea',
    'eval' => array('mandatory' => false, 'maxlength' => 255, 'class' => 'clr'),
    'sql' => "mediumtext NULL"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['betreutDurchVermittlerId'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_member']['betreutDurchVermittlerId'],
    'filter' => true,
    'sorting' => true,
    'search' => true,
    'exclude' => true,
    'inputType' => 'select',
    'foreignKey' => 'tl_member.lastname',
    'options_callback' => array('tl_member_fiba', 'getVermittler'),
    'eval' => array('mandatory' => true, 'includeBlankOption' => false, 'feEditable' => true, 'feViewable' => true, 'feGroup' => 'vermittlerdata', 'tl_class' => 'w50'),
    'sql' => "int(10) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['iban'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_member']['iban'],
    'exclude' => true,
    'search' => true,
    'sorting' => true,
    'flag' => 1,
    'inputType' => 'text',
    'eval' => array('mandatory' => true, 'maxlength' => 255, 'feEditable' => true, 'feViewable' => true, 'feGroup' => 'bankdata', 'tl_class' => 'w50'),
    'sql' => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['bankName'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_member']['bankName'],
    'exclude' => true,
    'search' => true,
    'sorting' => true,
    'flag' => 1,
    'inputType' => 'text',
    'eval' => array('mandatory' => true, 'maxlength' => 255, 'feEditable' => true, 'feViewable' => true, 'feGroup' => 'bankdata', 'tl_class' => 'w50'),
    'sql' => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['agb'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_member']['agb'],
    'exclude' => true,
    'search' => true,
    'sorting' => true,
    'inputType' => 'checkbox',
    'eval' => array('mandatory' => true, 'maxlength' => 255, 'feEditable' => true, 'feViewable' => false, 'feGroup' => 'login', 'tl_class' => 'w50'),
    'sql' => "varchar(255) NOT NULL default ''"
);



/**
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class tl_member_fiba extends Backend
{

    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }

    /**
     * onloadCallback
     */
    public function setPalettes()
    {
        if (Input::get('act') == 'edit')
        {
            $objMember = MemberModel::findByPk(\Input::get('id'));
            if ($objMember !== null)
            {
                if ($objMember->fibaRole == 'isEmpfehlungsgeber')
                {
                    $GLOBALS['TL_DCA']['tl_member']['palettes']['default'] = str_replace('{groups_legend}', '{empfehlungsclub_legend},empfehlungsgeberLevel,empfehlungsgeberAusbezahltePraemie,empfehlungsgeberEmpohleneKunden;{betreut_durch_vermittler_legend},betreutDurchVermittlerId;{bank_data},iban,bankName;{groups_legend}', $GLOBALS['TL_DCA']['tl_member']['palettes']['default']);
                }
                if ($objMember->fibaRole == 'isVermittler')
                {
                    $GLOBALS['TL_DCA']['tl_member']['palettes']['default'] = str_replace('{groups_legend}', '{agent_legend},vermittlerId;{groups_legend}', $GLOBALS['TL_DCA']['tl_member']['palettes']['default']);
                }
            }
        }
    }

    /**
     * onload_callback
     * Check integrity
     */
    public function checkTable()
    {
        if(TL_MODE == 'BE' && Input::get('do') == 'member' && count($_GET) == 2)
        {
            // tl_member.betreutDurchVermittlerId löschen, falls Mitglied nicht Empfehlungsgeber ist.
            Database::getInstance()->prepare('UPDATE tl_member SET betreutDurchVermittlerId=? WHERE fibaRole!=?')->execute(0, 'isEmpfehlungsgeber');

            // Checkt, dass alle Empfehlungsgeber einen aktiven Vermitler besitzen
            $objEmpfehlungsgeber = \Database::getInstance()->prepare('SELECT * FROM tl_member WHERE fibaRole=?')->execute('isEmpfehlungsgeber');
            while ($objEmpfehlungsgeber->next())
            {
                $objVermittler = \Database::getInstance()->prepare('SELECT * FROM tl_member WHERE fibaRole=? AND id=?')->execute('isVermittler', $objEmpfehlungsgeber->betreutDurchVermittlerId);
                if (!$objVermittler->numRows)
                {
                    $strFormat = 'Dem Empfehlungsgeber "%s %s" (ID: %s) ist kein Vermittler zugewiesen. Bitte kontrollieren Sie die Einstellung.';
                    $strMsg = sprintf($strFormat, $objEmpfehlungsgeber->firstname, $objEmpfehlungsgeber->lastname, $objEmpfehlungsgeber->id);
                    Message::addError($strMsg);
                    Database::getInstance()->prepare('UPDATE tl_member SET betreutDurchVermittlerId=? WHERE id=?')->execute(0, $objEmpfehlungsgeber->id);
                }
            }
        }

    }

    /**
     * @return array
     */
    public function getVermittler()
    {
        $arrMember = array();
        $objMember = \Database::getInstance()->prepare('SELECT * FROM tl_member WHERE fibaRole=? ORDER BY firstname')->execute('isVermittler');
        while ($objMember->next())
        {
            $arrMember[$objMember->id] = $objMember->firstname . ' ' . $objMember->lastname;
        }
        return $arrMember;
    }
}
