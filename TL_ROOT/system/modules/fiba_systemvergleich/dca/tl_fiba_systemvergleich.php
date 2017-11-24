<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 02.03.2017
 * Time: 21:34
 */


/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Table tl_fiba_systemvergleich
 */
$GLOBALS['TL_DCA']['tl_fiba_systemvergleich'] = array
(

    // Config
    'config' => array
    (
        'dataContainer' => 'Table',
        'enableVersioning' => true,
        'onload_callback' => array
        (//array('tl_fiba_systemvergleich', 'checkPermission')
        ),
        'onsubmit_callback' => array
        (
            //array('tl_fiba_systemvergleich', 'storeDateAdded'),
            //array('tl_fiba_systemvergleich', 'checkRemoveSession')
        ),
        'ondelete_callback' => array
        (
            //array('tl_fiba_systemvergleich', 'removeSession')
        ),
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary',
            )
        )
    ),

    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode' => 2,
            'fields' => array('system ASC', 'laufzeit ASC', 'kosten ASC'),
            'flag' => 1,
            'panelLayout' => 'filter;sort,search,limit'
        ),
        'label' => array
        (
            'fields' => array('system', 'laufzeit', 'kosten', 'ablaufleistung'),
            'showColumns' => true,
            //'label_callback'          => array('tl_fiba_systemvergleich', 'addIcon')
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label' => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href' => 'act=select',
                'class' => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_fiba_systemvergleich']['edit'],
                'href' => 'act=edit',
                'icon' => 'edit.gif',
            ),
            'copy' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_fiba_systemvergleich']['copy'],
                'href' => 'act=copy',
                'icon' => 'copy.gif',
            ),
            'delete' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_fiba_systemvergleich']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
            ),
        )
    ),

    // Palettes
    'palettes' => array
    (
        //'__selector__'                => array('inherit', 'admin'),
        'default' => '{name_legend},system,laufzeit,kosten,ablaufleistung',
    ),


    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp' => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'system' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_fiba_systemvergleich']['system'],
            'exclude' => true,
            'search' => true,
            'sorting' => true,
            'flag' => 1,
            'inputType' => 'select',
            'options' => array('Fondssparplan','Fondspolice', 'Rentenkapital'),
            'eval' => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'clr'),
            'sql' => "varchar(255) NOT NULL default ''"
        ),
        'laufzeit' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_fiba_systemvergleich']['laufzeit'],
            'exclude' => true,
            'search' => true,
            'sorting' => true,
            'flag' => 1,
            'inputType' => 'select',
            'options' => range(1,50),
            'eval' => array('mandatory' => true, 'rgxp' => 'natural', 'maxlength' => 2, 'tl_class' => 'clr'),
            'sql' => "varchar(3) NOT NULL default ''"
        ),
        'kosten' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_fiba_systemvergleich']['kosten'],
            'exclude' => true,
            'search' => true,
            'sorting' => true,
            'flag' => 1,
            'inputType' => 'text',
            'eval' => array('mandatory' => true, 'maxlength' => 6, 'rgxp' => 'digit', 'tl_class' => 'clr'),
            'sql' => "float(6,2) NOT NULL default '0.00'"
        ),
        'ablaufleistung' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_fiba_systemvergleich']['ablaufleistung'],
            'exclude' => true,
            'search' => true,
            'sorting' => true,
            'flag' => 1,
            'inputType' => 'text',
            'eval' => array('mandatory' => true, 'maxlength' => 9, 'rgxp' => 'digit', 'tl_class' => 'clr'),
            'sql' => "float(15,2) NOT NULL default '0.00'"
        ),
    )
);


/**
 * Class tl_fiba_systemvergleich
 */
class tl_fiba_systemvergleich extends Backend
{

    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }


}