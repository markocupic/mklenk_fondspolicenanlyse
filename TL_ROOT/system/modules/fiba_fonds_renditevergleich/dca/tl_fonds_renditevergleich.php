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
 * Table tl_fonds_renditevergleich
 */
$GLOBALS['TL_DCA']['tl_fonds_renditevergleich'] = array
(

    // Config
    'config' => array
    (
        'dataContainer' => 'Table',
        'enableVersioning' => true,
        'onload_callback' => array
        (//array('tl_fonds_renditevergleich', 'checkPermission')
        ),
        'onsubmit_callback' => array
        (
            //array('tl_fonds_renditevergleich', 'storeDateAdded'),
            //array('tl_fonds_renditevergleich', 'checkRemoveSession')
        ),
        'ondelete_callback' => array
        (//array('tl_fonds_renditevergleich', 'removeSession')
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
            'fields' => array('fondsname DESC'),
            'flag' => 1,
            'panelLayout' => 'filter;sort,search,limit'
        ),
        'label' => array
        (
            'fields' => array('fondsname', 'isin', 'anbieter'),
            'showColumns' => true,
            //'label_callback'          => array('tl_fonds_renditevergleich', 'addIcon')
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
                'label' => &$GLOBALS['TL_LANG']['tl_fonds_renditevergleich']['edit'],
                'href' => 'act=edit',
                'icon' => 'edit.gif',
                //'button_callback'     => array('tl_fonds_renditevergleich', 'editItem')
            ),
            'copy' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_fonds_renditevergleich']['copy'],
                'href' => 'act=copy',
                'icon' => 'copy.gif',
                //'button_callback'     => array('tl_fonds_renditevergleich', 'copyItem')
            ),
            'delete' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_fonds_renditevergleich']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
                //'button_callback'     => array('tl_fonds_renditevergleich', 'deleteItem')
            ),
            /*
            'toggle' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_fonds_renditevergleich']['toggle'],
                'icon'                => 'visible.gif',
                'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback'     => array('tl_fonds_renditevergleich', 'toggleIcon')
            ),
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_fonds_renditevergleich']['show'],
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
        'default' => '{name_legend},fondsname,fondsart,isin,anbieter,factsheet;{facts_legend},rendite3Jahre,rendite5Jahre,rendite10Jahre,volantilitaet,laufendeKosten;',
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
        'fondsname' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_fonds_renditevergleich']['fondsname'],
            'exclude' => true,
            'search' => true,
            'sorting' => true,
            'flag' => 1,
            'inputType' => 'text',
            'eval' => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'clr'),
            'sql' => "varchar(255) NOT NULL default ''"
        ),
        'anbieter' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_fonds_renditevergleich']['anbieter'],
            'exclude' => true,
            'search' => true,
            'sorting' => true,
            'flag' => 1,
            'inputType' => 'text',
            'eval' => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'clr'),
            'sql' => "varchar(255) NOT NULL default ''"
        ),
        'fondsart' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_fonds_renditevergleich']['fondsart'],
            'exclude' => true,
            'search' => true,
            'sorting' => true,
            'flag' => 1,
            'options' => array('Dimensional Rentenfonds', 'Dimensional Aktienfonds', 'ETF Rentenfonds', 'ETF Aktienfonds'),
            'inputType' => 'select',
            'eval' => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'clr'),
            'sql' => "varchar(255) NOT NULL default ''"
        ),
        'isin' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_fonds_renditevergleich']['isin'],
            'exclude' => true,
            'search' => true,
            'sorting' => true,
            'flag' => 1,
            'inputType' => 'text',
            'eval' => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'clr'),
            'sql' => "varchar(255) NOT NULL default ''"
        ),
        'rendite3Jahre' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_fonds_renditevergleich']['rendite3Jahre'],
            'exclude' => true,
            'search' => true,
            'sorting' => true,
            'flag' => 1,
            'inputType' => 'text',
            'eval' => array('maxlength' => 6, 'rgxp' => 'digit', 'tl_class' => 'clr'),
            'sql' => "float(5,2) NOT NULL default '0.00'"
        ),
        'rendite5Jahre' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_fonds_renditevergleich']['rendite5Jahre'],
            'exclude' => true,
            'search' => true,
            'sorting' => true,
            'flag' => 1,
            'inputType' => 'text',
            'eval' => array('maxlength' => 6, 'rgxp' => 'digit', 'tl_class' => 'clr'),
            'sql' => "float(5,2) NOT NULL default '0.00'"
        ),
        'rendite10Jahre' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_fonds_renditevergleich']['rendite10Jahre'],
            'exclude' => true,
            'search' => true,
            'sorting' => true,
            'flag' => 1,
            'inputType' => 'text',
            'eval' => array('maxlength' => 6, 'rgxp' => 'digit', 'tl_class' => 'clr'),
            'sql' => "float(5,2) NOT NULL default '0.00'"
        ),
        'volantilitaet' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_fonds_renditevergleich']['volantilitaet'],
            'exclude' => true,
            'search' => true,
            'sorting' => true,
            'filter' => true,
            'flag' => 1,
            'inputType' => 'text',
            'eval' => array('maxlength' => 6, 'rgxp' => 'digit', 'tl_class' => 'clr'),
            'sql' => "float(5,2) NOT NULL default '0.00'"
        ),
        'laufendeKosten' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_fonds_renditevergleich']['laufendeKosten'],
            'exclude' => true,
            'search' => true,
            'sorting' => true,
            'filter' => true,
            'flag' => 1,
            'inputType' => 'text',
            'eval' => array('maxlength' => 6, 'rgxp' => 'digit', 'tl_class' => 'clr'),
            'sql' => "float(5,2) NOT NULL default '0.00'"
        ),
        'factsheet' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_fonds_renditevergleich']['factsheet'],
            'exclude' => true,
            'search' => true,
            'sorting' => true,
            'flag' => 1,
            'inputType' => 'text',
            'eval' => array('maxlength' => 255, 'rgxp' => 'url', 'tl_class' => 'clr'),
            'sql' => "varchar(255) NOT NULL default ''"
        ),

    )
);


/**
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class tl_fonds_renditevergleich extends Backend
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
     * @param array $row
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
        return '<a href="' . $this->addToUrl($href . '&amp;id=' . $row['id']) . '" title="' . specialchars($title) . '"' . $attributes . '>' . Image::getHtml($icon, $label) . '</a> ';
    }

    /**
     * Return the delete item button
     *
     * @param array $row
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
        return '<a href="' . $this->addToUrl($href . '&amp;id=' . $row['id']) . '" title="' . specialchars($title) . '"' . $attributes . '>' . Image::getHtml($icon, $label) . '</a> ';
    }

}