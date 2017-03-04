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
 * Table tl_vorsorgefonds
 */
$GLOBALS['TL_DCA']['tl_vorsorgefonds'] = array
(

    // Config
    'config' => array
    (
        'dataContainer'               => 'Table',
        'enableVersioning'            => true,
        'onload_callback' => array
        (
            //array('tl_vorsorgefonds', 'checkPermission')
        ),
        'onsubmit_callback' => array
        (
            //array('tl_vorsorgefonds', 'storeDateAdded'),
            //array('tl_vorsorgefonds', 'checkRemoveSession')
        ),
        'ondelete_callback' => array
        (
            //array('tl_vorsorgefonds', 'removeSession')
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
            'mode'                    => 2,
            'fields'                  => array('tarifbezeichnung DESC'),
            'flag'                    => 1,
            'panelLayout'             => 'filter;sort,search,limit'
        ),
        'label' => array
        (
            'fields'                  => array('tarifbezeichnung'),
            'showColumns'             => true,
            //'label_callback'          => array('tl_vorsorgefonds', 'addIcon')
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'                => 'act=select',
                'class'               => 'header_edit_all',
                'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_vorsorgefonds']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.gif',
                'button_callback'     => array('tl_vorsorgefonds', 'editItem')
            ),
            'copy' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_vorsorgefonds']['copy'],
                'href'                => 'act=copy',
                'icon'                => 'copy.gif',
                'button_callback'     => array('tl_vorsorgefonds', 'copyItem')
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_vorsorgefonds']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
                'button_callback'     => array('tl_vorsorgefonds', 'deleteItem')
            ),
            /*
            'toggle' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_vorsorgefonds']['toggle'],
                'icon'                => 'visible.gif',
                'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback'     => array('tl_vorsorgefonds', 'toggleIcon')
            ),
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_vorsorgefonds']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.gif'
            )
            */
        )
    ),

    // Palettes
    'palettes' => array
    (
        //'__selector__'                => array('inherit', 'admin'),
        'default' => '{name_legend},versicherer,tarifbezeichnung,tarif,laufzeit,sparrate,isin,kostenOhneFonds,ablaufleistungOhneFonds,kostenMitFonds,ablaufleistungMitFonds,garantierterRentenfaktor,etf,dimensional,link',
    ),


    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'versicherer' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vorsorgefonds']['versicherer'],
            'exclude'                 => true,
            'search'                  => true,
            'sorting'                 => true,
            'flag'                    => 1,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'tarifbezeichnung' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vorsorgefonds']['tarifbezeichnung'],
            'exclude'                 => true,
            'search'                  => true,
            'sorting'                 => true,
            'flag'                    => 1,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=> true, 'maxlength'=>255, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'tarif' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vorsorgefonds']['tarif'],
            'exclude'                 => true,
            'search'                  => true,
            'sorting'                 => true,
            'flag'                    => 1,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'laufzeit' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vorsorgefonds']['laufzeit'],
            'exclude'                 => true,
            'search'                  => true,
            'sorting'                 => true,
            'filter'                  => true,
            'flag'                    => 1,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'sparrate' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vorsorgefonds']['sparrate'],
            'exclude'                 => true,
            'search'                  => true,
            'sorting'                 => true,
            'flag'                    => 1,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'isin' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vorsorgefonds']['isin'],
            'exclude'                 => true,
            'search'                  => true,
            'sorting'                 => true,
            'flag'                    => 1,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'kostenOhneFonds' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vorsorgefonds']['kostenOhneFonds'],
            'exclude'                 => true,
            'search'                  => true,
            'sorting'                 => true,
            'flag'                    => 1,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'ablaufleistungOhneFonds' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vorsorgefonds']['ablaufleistungOhneFonds'],
            'exclude'                 => true,
            'search'                  => true,
            'sorting'                 => true,
            'flag'                    => 1,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'kostenMitFonds' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vorsorgefonds']['kostenMitFonds'],
            'exclude'                 => true,
            'search'                  => true,
            'sorting'                 => true,
            'flag'                    => 1,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'ablaufleistungMitFonds' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vorsorgefonds']['ablaufleistungMitFonds'],
            'exclude'                 => true,
            'search'                  => true,
            'sorting'                 => true,
            'flag'                    => 1,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'garantierterRentenfaktor' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vorsorgefonds']['garantierterRentenfaktor'],
            'exclude'                 => true,
            'search'                  => true,
            'sorting'                 => true,
            'flag'                    => 1,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'etf' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vorsorgefonds']['etf'],
            'exclude'                 => true,
            'search'                  => true,
            'sorting'                 => true,
            'filter'                  => true,
            'flag'                    => 1,
            'inputType'               => 'text',
            //'options'                 => array('ja','nein'),
            'eval'                    => array('includeBlankOption'=>true, 'maxlength'=>255, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'dimensional' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vorsorgefonds']['dimensional'],
            'exclude'                 => true,
            'search'                  => true,
            'sorting'                 => true,
            'filter'                  => true,
            'flag'                    => 1,
            'inputType'               => 'text',
            //'options'                 => array('ja','nein'),
            'eval'                    => array('includeBlankOption'=>true, 'maxlength'=>255, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'link' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vorsorgefonds']['link'],
            'exclude'                 => true,
            'search'                  => true,
            'sorting'                 => true,
            'flag'                    => 1,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),

    )
);



/**
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class tl_vorsorgefonds extends Backend
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
     * Return the copy item button
     *
     * @param array $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     * @param string $table
     *
     * @return string
     */
    public function copyItem($row, $href, $label, $title, $icon, $attributes, $table)
    {
        if ($GLOBALS['TL_DCA'][$table]['config']['closed'])
        {
            return '';
        }

        return '<a href="' . $this->addToUrl($href . '&amp;id=' . $row['id']) . '" title="' . specialchars($title) . '"' . $attributes . '>' . Image::getHtml($icon, $label) . '</a> ';
    }

    /**
     * Return the edit item button
     *
     * @param array  $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     *
     * @return string
     */
    public function editItem($row, $href, $label, $title, $icon, $attributes)
    {
        return '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ';
    }

    /**
     * Return the delete item button
     *
     * @param array  $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     *
     * @return string
     */
    public function deleteItem($row, $href, $label, $title, $icon, $attributes)
    {
        return '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ';
    }

}