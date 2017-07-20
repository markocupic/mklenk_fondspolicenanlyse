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
 * Table tl_fondspolicen
 */
$GLOBALS['TL_DCA']['tl_fondspolicen'] = array(

    // Config
    'config'      => array(
        'dataContainer'    => 'Table',
        'enableVersioning' => true,
        'onload_callback'  => array(
            array('tl_fondspolicen', 'checkPermission'),
        ),
        'sql'              => array(
            'keys' => array(
                'id' => 'primary',
            ),
        ),
    ),
    // List
    'list'        => array(
        'sorting'           => array(
            'mode'   => 1,
            'fields' => array('title'),
            'flag'   => 1,
        ),
        'label'             => array(
            'fields' => array('title'),
            'format' => '%s',
        ),
        'global_operations' => array(
            'all' => array(
                'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'       => 'act=select',
                'class'      => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset();" accesskey="e"',
            ),
        ),
        'operations'        => array(
            'edit'   => array(
                'label' => &$GLOBALS['TL_LANG']['tl_fondspolicen']['edit'],
                'href'  => 'act=edit',
                'icon'  => 'edit.gif',
            ),
            'copy'   => array(
                'label' => &$GLOBALS['TL_LANG']['tl_fondspolicen']['copy'],
                'href'  => 'act=copy',
                'icon'  => 'copy.gif',
            ),
            'delete' => array(
                'label'      => &$GLOBALS['TL_LANG']['tl_fondspolicen']['delete'],
                'href'       => 'act=delete',
                'icon'       => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
            ),
            'toggle' => array(
                'label'           => &$GLOBALS['TL_LANG']['tl_fondspolicen']['toggle'],
                'icon'            => 'visible.gif',
                'attributes'      => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback' => array('tl_fondspolicen', 'toggleIcon'),
            ),
            'show'   => array(
                'label' => &$GLOBALS['TL_LANG']['tl_fondspolicen']['show'],
                'href'  => 'act=show',
                'icon'  => 'show.gif',
            ),
        ),
    ),
    // Select
    'select'      => array(
        'buttons_callback' => array(),
    ),
    // Edit
    'edit'        => array(
        'buttons_callback' => array(),
    ),
    // Palettes
    'palettes'    => array(
        '__selector__' => array(''),
        'default'      => '{title_legend},published,title,iconSRC;{A1_Legend},laufzeitA1,versicherungsmantelA1,versicherungsmantelInklA1;{A2_Legend},laufzeitA2,versicherungsmantelA2,versicherungsmantelInklA2;{A3_Legend},laufzeitA3,versicherungsmantelA3,versicherungsmantelInklA3;{A4_Legend},laufzeitA4,versicherungsmantelA4,versicherungsmantelInklA4;{B1_Legend},laufzeitB1,versicherungsmantelB1,versicherungsmantelInklB1;{B2_Legend},laufzeitB2,versicherungsmantelB2,versicherungsmantelInklB2;{B3_Legend},laufzeitB3,versicherungsmantelB3,versicherungsmantelInklB3;{B4_Legend},laufzeitB4,versicherungsmantelB4,versicherungsmantelInklB4;{fondsLegend},fondsuniversumUrl,etf,dimensionalFonds,eigenePortfolios,kostenfreiesRebalancing;{besonderesLegend},garantierterRentenfaktor,kickBacks,highlights;{datumLegend},datum;',
    ),
    // Subpalettes
    'subpalettes' => array(//
    ),
    // Fields
    'fields'      => array(
        'id'                        => array(
            'sql' => "int(10) unsigned NOT NULL auto_increment",
        ),
        'tstamp'                    => array(
            'sql' => "int(10) unsigned NOT NULL default '0'",
        ),
        'published'                 => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['published'],
            'exclude'   => true,
            'inputType' => 'checkbox',
            'eval'      => array('mandatory' => false),
            'sql'       => "char(1) NOT NULL default ''",
        ),
        'title'                     => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['title'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true, 'maxlength' => 255),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'iconSRC'                   => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['iconSRC'],
            'exclude'   => true,
            'inputType' => 'fileTree',
            'eval'      => array('filesOnly' => true, 'extensions' => Config::get('validImageTypes'), 'fieldType' => 'radio', 'mandatory' => true),
            'sql'       => "binary(16) NULL",
        ),
        'laufzeitA1'                => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['laufzeitA1'],
            'exclude'   => true,
            'inputType' => 'select',
            'options'   => range(0, 99, 1),
            'eval'      => array('mandatory' => true, 'maxlength' => 2, 'eval' => 'natural'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'laufzeitA2'                => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['laufzeitA2'],
            'exclude'   => true,
            'inputType' => 'select',
            'options'   => range(0, 99, 1),
            'eval'      => array('mandatory' => true, 'maxlength' => 2, 'eval' => 'natural'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'laufzeitA3'                => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['laufzeitA3'],
            'exclude'   => true,
            'inputType' => 'select',
            'options'   => range(0, 99, 1),
            'eval'      => array('mandatory' => true, 'maxlength' => 2, 'eval' => 'natural'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'laufzeitA4'                => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['laufzeitA4'],
            'exclude'   => true,
            'inputType' => 'select',
            'options'   => range(0, 99, 1),
            'eval'      => array('mandatory' => true, 'maxlength' => 2, 'eval' => 'natural'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'laufzeitB1'                => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['laufzeitB1'],
            'exclude'   => true,
            'inputType' => 'select',
            'options'   => range(0, 99, 1),
            'eval'      => array('mandatory' => true, 'maxlength' => 2, 'eval' => 'natural'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'laufzeitB2'                => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['laufzeitB2'],
            'exclude'   => true,
            'inputType' => 'select',
            'options'   => range(0, 99, 1),
            'eval'      => array('mandatory' => true, 'maxlength' => 2, 'eval' => 'natural'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'laufzeitB3'                => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['laufzeitB3'],
            'exclude'   => true,
            'inputType' => 'select',
            'options'   => range(0, 99, 1),
            'eval'      => array('mandatory' => true, 'maxlength' => 2, 'eval' => 'natural'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'laufzeitB4'                => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['laufzeitB4'],
            'exclude'   => true,
            'inputType' => 'select',
            'options'   => range(0, 99, 1),
            'eval'      => array('mandatory' => true, 'maxlength' => 2, 'eval' => 'natural'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'versicherungsmantelA1'     => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['versicherungsmantelA1'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'versicherungsmantelA2'     => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['versicherungsmantelA2'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'versicherungsmantelA3'     => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['versicherungsmantelA3'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'versicherungsmantelA4'     => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['versicherungsmantelA4'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'versicherungsmantelB1'     => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['versicherungsmantelB1'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'versicherungsmantelB2'     => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['versicherungsmantelB2'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'versicherungsmantelB3'     => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['versicherungsmantelB3'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'versicherungsmantelB4'     => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['versicherungsmantelB4'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'versicherungsmantelInklA1' => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['versicherungsmantelInklA1'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true, 'eval' => 'alnum'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'versicherungsmantelInklA2' => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['versicherungsmantelInklA2'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true, 'eval' => 'alnum'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'versicherungsmantelInklA3' => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['versicherungsmantelInklA3'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true, 'eval' => 'alnum'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'versicherungsmantelInklA4' => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['versicherungsmantelInklA4'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true, 'eval' => 'alnum'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'versicherungsmantelInklB1' => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['versicherungsmantelInklB1'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true, 'eval' => 'alnum'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'versicherungsmantelInklB2' => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['versicherungsmantelInklB2'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true, 'eval' => 'alnum'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'versicherungsmantelInklB3' => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['versicherungsmantelInklB3'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true, 'eval' => 'alnum'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'versicherungsmantelInklB4' => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['versicherungsmantelInklB4'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true, 'eval' => 'alnum'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        // ROW 3
        'fondsuniversumUrl'         => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['fondsuniversumUrl'],
            'exclude'   => true,
            'search'    => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => false, 'rgxp' => 'url', 'decodeEntities' => true, 'maxlength' => 255, 'fieldType' => 'radio', 'filesOnly' => true, 'tl_class' => 'clr wizard'),
            'wizard'    => array(
                array('tl_fondspolicen', 'pagePicker'),
            ),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'etf'                       => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['etf'],
            'reference' => $GLOBALS['TL_LANG']['tl_fondspolicen']['references']['etf'],
            'exclude'   => true,
            'inputType' => 'select',
            'options'   => array(0, 1),
            'eval'      => array('mandatory' => false, 'tl_class' => 'clr'),
            'sql'       => "char(1) NOT NULL default ''",
        ),
        'dimensionalFonds'          => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['dimensionalFonds'],
            'reference' => $GLOBALS['TL_LANG']['tl_fondspolicen']['references']['dimensionalFonds'],
            'exclude'   => true,
            'inputType' => 'select',
            'options'   => array(0, 1),
            'eval'      => array('mandatory' => false, 'tl_class' => 'clr'),
            'sql'       => "char(1) NOT NULL default ''",
        ),
        'eigenePortfolios'          => array(
            'label'       => &$GLOBALS['TL_LANG']['tl_fondspolicen']['eigenePortfolios'],
            'exclude'     => true,
            'search'      => true,
            'inputType'   => 'textarea',
            'eval'        => array('mandatory' => false, 'rte' => 'tinyMCE', 'helpwizard' => true, 'tl_class' => 'clr'),
            'explanation' => 'insertTags',
            'sql'         => "mediumtext NULL",
        ),
        'kostenfreiesRebalancing'   => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['kostenfreiesRebalancing'],
            'reference' => $GLOBALS['TL_LANG']['tl_fondspolicen']['references']['kostenfreiesRebalancing'],
            'exclude'   => true,
            'inputType' => 'select',
            'options'   => array(0, 1),
            'eval'      => array('mandatory' => false, 'tl_class' => 'clr'),
            'sql'       => "char(1) NOT NULL default ''",
        ),
        // ROW 3
        'garantierterRentenfaktor'  => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['garantierterRentenfaktor'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true, 'tl_class' => 'clr'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'kickBacks'                 => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['kickBacks'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => false, 'tl_class' => 'clr'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'highlights'                => array(
            'label'       => &$GLOBALS['TL_LANG']['tl_fondspolicen']['highlights'],
            'exclude'     => true,
            'search'      => true,
            'inputType'   => 'textarea',
            'eval'        => array('mandatory' => false, 'rte' => 'tinyMCE', 'tl_class' => 'clr', 'helpwizard' => true),
            'explanation' => 'insertTags',
            'sql'         => "mediumtext NULL",
        ),
        // ROW 4
        'datum'                     => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_fondspolicen']['datum'],
            'default'   => time(),
            'exclude'   => true,
            'sorting'   => true,
            'flag'      => 8,
            'inputType' => 'text',
            'eval'      => array('rgxp' => 'date', 'datepicker' => true, 'tl_class' => 'clr wizard'),
            'sql'       => "int(10) unsigned NULL",
        ),
    ),
);


class tl_fondspolicen extends Backend
{

    /**
     * Check permissions to edit table tl_fondspolicen
     */
    public function checkPermission()
    {
        //
    }

    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }

    /**
     * Return the link picker wizard
     *
     * @param DataContainer $dc
     *
     * @return string
     */
    public function pagePicker(DataContainer $dc)
    {
        return ' <a href="' . (($dc->value == '' || strpos($dc->value, '{{link_url::') !== false) ? 'contao/page.php' : 'contao/file.php') . '?do=' . Input::get('do') . '&amp;table=' . $dc->table . '&amp;field=' . $dc->field . '&amp;value=' . rawurlencode(str_replace(array('{{link_url::', '}}'), '', $dc->value)) . '&amp;switch=1' . '" title="' . specialchars($GLOBALS['TL_LANG']['MSC']['pagepicker']) . '" onclick="Backend.getScrollOffset();Backend.openModalSelector({\'width\':768,\'title\':\'' . specialchars(str_replace("'", "\\'", $GLOBALS['TL_LANG']['MOD']['page'][0])) . '\',\'url\':this.href,\'id\':\'' . $dc->field . '\',\'tag\':\'ctrl_' . $dc->field . ((Input::get('act') == 'editAll') ? '_' . $dc->id : '') . '\',\'self\':this});return false">' . Image::getHtml('pickpage.gif', $GLOBALS['TL_LANG']['MSC']['pagepicker'], 'style="vertical-align:top;cursor:pointer"') . '</a>';
    }

    /**
     * Return the "toggle visibility" button
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
    public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
    {
        if (strlen(Input::get('tid')))
        {
            $this->toggleVisibility(Input::get('tid'), (Input::get('state') == 1), (@func_get_arg(12) ?: null));
            $this->redirect($this->getReferer());
        }

        $href .= '&amp;tid=' . $row['id'] . '&amp;state=' . ($row['published'] ? '' : 1);

        if (!$row['published'])
        {
            $icon = 'invisible.gif';
        }

        return '<a href="' . $this->addToUrl($href) . '" title="' . specialchars($title) . '"' . $attributes . '>' . Image::getHtml($icon, $label, 'data-state="' . ($row['published'] ? 1 : 0) . '"') . '</a> ';
    }

    /**
     * Disable/enable a user group
     *
     * @param integer $intId
     * @param boolean $blnVisible
     * @param DataContainer $dc
     */
    public function toggleVisibility($intId, $blnVisible, DataContainer $dc = null)
    {
        // Set the ID and action
        Input::setGet('id', $intId);
        Input::setGet('act', 'toggle');

        if ($dc)
        {
            $dc->id = $intId; // see #8043
        }

        $this->checkPermission();


        $objVersions = new Versions('tl_news', $intId);
        $objVersions->initialize();

        // Trigger the save_callback
        if (is_array($GLOBALS['TL_DCA']['tl_fondspolicen']['fields']['published']['save_callback']))
        {
            foreach ($GLOBALS['TL_DCA']['tl_fondspolicen']['fields']['published']['save_callback'] as $callback)
            {
                if (is_array($callback))
                {
                    $this->import($callback[0]);
                    $blnVisible = $this->{$callback[0]}->{$callback[1]}($blnVisible, ($dc ?: $this));
                }
                elseif (is_callable($callback))
                {
                    $blnVisible = $callback($blnVisible, ($dc ?: $this));
                }
            }
        }

        // Update the database
        $this->Database->prepare("UPDATE tl_fondspolicen SET tstamp=" . time() . ", published='" . ($blnVisible ? '1' : '') . "' WHERE id=?")->execute($intId);

        $objVersions->create();

    }


}
