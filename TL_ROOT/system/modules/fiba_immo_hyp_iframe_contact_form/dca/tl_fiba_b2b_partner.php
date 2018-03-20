<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2018 Leo Feyer
 *
 * @package   FibaHypIframeContacForm
 * @author    Marko Cupic
 * @license   SHAREWARE
 * @copyright Marko Cupic 2018
 */


/**
 * Table tl_fiba_b2b_partner
 */
$GLOBALS['TL_DCA']['tl_fiba_b2b_partner'] = array
(

    // Config
    'config'      => array
    (
        'dataContainer'     => 'Table',
        'enableVersioning'  => true,
        'onload_callback'   => array
        (
            array('tl_fiba_b2b_partner', 'route'),
        ),
        'onsubmit_callback' => array
        (
            //array('tl_fiba_b2b_partner', 'storeDateAdded'),
            //array('tl_fiba_b2b_partner', 'checkRemoveSession')
        ),
        'ondelete_callback' => array
        (//array('tl_fiba_b2b_partner', 'removeSession')
        ),
        'sql'               => array
        (
            'keys' => array
            (
                'id'             => 'primary',
                'email'          => 'index',
                'companyIdToken' => 'unique',
            ),
        ),
    ),

    // List
    'list'        => array
    (
        'sorting'           => array
        (
            'mode'        => 2,
            'fields'      => array('companyName DESC'),
            'flag'        => 1,
            'panelLayout' => 'filter;sort,search,limit',
        ),
        'label'             => array
        (
            'fields'         => array('', 'companyName', 'website'),
            'showColumns'    => true,
            'label_callback' => array('tl_fiba_b2b_partner', 'addIcon'),
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'       => 'act=select',
                'class'      => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"',
            ),
        ),
        'operations'        => array
        (
            'edit'   => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['edit'],
                'href'  => 'act=edit',
                'icon'  => 'edit.gif',
            ),
            'copy'   => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['copy'],
                'href'  => 'act=copy',
                'icon'  => 'copy.gif',
            ),
            'delete' => array
            (
                'label'      => &$GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['delete'],
                'href'       => 'act=delete',
                'icon'       => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
            ),
            'toggle' => array
            (
                'label'           => &$GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['toggle'],
                'icon'            => 'visible.gif',
                'attributes'      => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback' => array('tl_fiba_b2b_partner', 'toggleIcon'),
            ),
            'show'   => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['show'],
                'href'  => 'act=show',
                'icon'  => 'show.gif',
            ),

        ),
    ),

    // Palettes
    'palettes'    => array
    (
        //'__selector__' => array(),
        'default' => '{company_legend},companyName,contactPersonName,phone,email,website;{iframe_legend},partnerHiredByGender,partnerHiredByFirstname,partnerHiredByLastname,partnerHiredByStreet,partnerHiredByPostal,partnerHiredByCity,partnerHiredByEmail,partnerHiredByPhone,targetPage,obfuscateIframe,htmlDownloadButton,companyIdToken,enableRefererCheck',
    ),

    // Subpalettes
    'subpalettes' => array
    (//
    ),


    // Fields
    'fields'      => array
    (
        'id'                      => array
        (
            'sql' => "int(10) unsigned NOT NULL auto_increment",
        ),
        'tstamp'                  => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'",
        ),
        'disable'                 => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['disable'],
            'exclude'   => true,
            'filter'    => true,
            'inputType' => 'checkbox',
            'sql'       => "char(1) NOT NULL default ''",
        ),
        'companyName'             => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['companyName'],
            'exclude'   => true,
            'search'    => true,
            'sorting'   => true,
            'flag'      => 1,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'clr long'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'contactPersonName'       => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['contactPersonName'],
            'exclude'   => true,
            'search'    => true,
            'sorting'   => true,
            'flag'      => 1,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'clr long'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'phone'                   => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['phone'],
            'exclude'   => true,
            'search'    => true,
            'inputType' => 'text',
            'eval'      => array('maxlength' => 64, 'rgxp' => 'phone', 'decodeEntities' => true, 'tl_class' => 'clr long'),
            'sql'       => "varchar(64) NOT NULL default ''",
        ),
        'email'                   => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['email'],
            'exclude'   => true,
            'search'    => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true, 'maxlength' => 255, 'rgxp' => 'email', 'unique' => false, 'decodeEntities' => true, 'tl_class' => 'clr long'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'website'                 => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['website'],
            'exclude'   => true,
            'search'    => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true, 'rgxp' => 'url', 'maxlength' => 255, 'tl_class' => 'clr long'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'targetPage'              => array
        (
            'label'      => &$GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['targetPage'],
            'exclude'    => true,
            'inputType'  => 'pageTree',
            'foreignKey' => 'tl_page.title',
            'eval'       => array('mandatory' => true, 'fieldType' => 'radio', 'tl_class' => 'clr long'),
            'sql'        => "int(10) unsigned NOT NULL default '0'",
            'relation'   => array('type' => 'hasOne', 'load' => 'lazy'),
        ),
        'htmlDownloadButton'      => array
        (
            'label'                => &$GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['htmlDownloadButton'],
            'exclude'              => true,
            'filter'               => false,
            'input_field_callback' => array('tl_fiba_b2b_partner', 'generateHtmlDownloadButton'),
            'eval'                 => array('doNotShow' => true, 'tl_class' => 'clr long'),
            'sql'                  => "char(1) NOT NULL default ''",
        ),
        'companyIdToken'          => array
        (
            'label'         => &$GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['companyIdToken'],
            'exclude'       => true,
            'filter'        => true,
            'default'       => sha1(time() . rand(1, 10000)) . sha1(time() . rand(1, 10000)),
            'load_callback' => array(array('tl_fiba_b2b_partner', 'generateCompanyIdToken')),
            'inputType'     => 'text',
            'eval'          => array('mandatory' => true, 'readonly' => true, 'submitOnChange' => true, 'tl_class' => 'clr long'),
            'sql'           => "varchar(255) NOT NULL default ''",
        ),
        'enableRefererCheck'      => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['enableRefererCheck'],
            'exclude'   => true,
            'filter'    => true,
            'inputType' => 'checkbox',
            'eval'      => array('tl_class' => 'clr long'),
            'sql'       => "char(1) NOT NULL default ''",
        ),
        'obfuscateIframe'         => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['obfuscateIframe'],
            'exclude'   => true,
            'filter'    => true,
            'reference' => $GLOBALS['TL_LANG']['tl_fiba_b2b_partner'],
            'inputType' => 'select',
            'options'   => array('decoded', 'encoded'),
            'eval'      => array('tl_class' => 'clr long'),
            'sql'       => "varchar(128) NOT NULL default ''",
        ),
        'partnerHiredByGender'    => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['partnerHiredByGender'],
            'exclude'   => true,
            'inputType' => 'select',
            'options'   => array('male', 'female'),
            'reference' => &$GLOBALS['TL_LANG']['MSC'],
            'eval'      => array('includeBlankOption' => true, 'tl_class' => 'clr'),
            'sql'       => "varchar(32) NOT NULL default ''",
        ),
        'partnerHiredByFirstname' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['partnerHiredByFirstname'],
            'exclude'   => true,
            'search'    => true,
            'sorting'   => true,
            'flag'      => 1,
            'inputType' => 'text',
            'eval'      => array('mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'partnerHiredByLastname'  => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['partnerHiredByLastname'],
            'exclude'   => true,
            'search'    => true,
            'sorting'   => true,
            'flag'      => 1,
            'inputType' => 'text',
            'eval'      => array('mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'partnerHiredByStreet'    => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['partnerHiredByStreet'],
            'exclude'   => true,
            'search'    => true,
            'inputType' => 'text',
            'eval'      => array('maxlength' => 255, 'tl_class' => 'clr long'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'partnerHiredByPostal'    => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['partnerHiredByPostal'],
            'exclude'   => true,
            'search'    => true,
            'inputType' => 'text',
            'eval'      => array('maxlength' => 32, 'tl_class' => 'w50'),
            'sql'       => "varchar(32) NOT NULL default ''",
        ),
        'partnerHiredByCity'      => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['partnerHiredByCity'],
            'exclude'   => true,
            'filter'    => true,
            'search'    => true,
            'sorting'   => true,
            'inputType' => 'text',
            'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'partnerHiredByEmail'     => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['partnerHiredByEmail'],
            'exclude'   => true,
            'search'    => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true, 'maxlength' => 255, 'rgxp' => 'email', 'unique' => false, 'decodeEntities' => true, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'partnerHiredByPhone'     => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['partnerHiredByPhone'],
            'exclude'   => true,
            'search'    => true,
            'inputType' => 'text',
            'eval'      => array('maxlength' => 64, 'rgxp' => 'phone', 'decodeEntities' => true, 'feEditable' => true, 'feViewable' => true, 'feGroup' => 'contact', 'tl_class' => 'w50'),
            'sql'       => "varchar(64) NOT NULL default ''",
        ),
    ),
);


/**
 * Class tl_fiba_b2b_partner
 */
class tl_fiba_b2b_partner extends Backend
{

    /**
     * @param $dc
     */
    public function route($dc)
    {
        if (Input::get('action') === 'downloadHtml')
        {
            $this->sendHtmlSnippetToBrowser($dc);
        }
    }

    /**
     * @param $dc
     */
    protected function sendHtmlSnippetToBrowser($dc)
    {

        if ($dc->id != '')
        {
            $objPartner = FibaB2bPartnerModel::findByPk($dc->id);
            if ($objPartner !== null)
            {
                if ($objPartner->companyIdToken != '')
                {
                    $objPage = PageModel::findByPk($objPartner->targetPage);
                    if ($objPage !== null)
                    {
                        $targetSRC = $objPage->getFrontendUrl();
                        $protocol = Environment::get('ssl') ? 'https://' : 'http://';
                        $host = Environment::get('host');
                        $href = $protocol . $host . '/' . $targetSRC . '?showContactForm=true&companyIdToken=' . $objPartner->companyIdToken;
                        $strTemplate = $objPartner->obfuscateIframe == 'encoded' ? 'be_fiba_b2b_hyp_iframe_obfuscated' : 'be_fiba_b2b_hyp_iframe';
                        $objTemplate = new BackendTemplate($strTemplate);
                        $objTemplate->href = $href;
                        $objTemplate->hrefEncoded = base64_encode($href);

                        $objTemplate->companyName = $objPartner->companyName;

                        $objTempFile = new File('system/tmp/fiba_b2b_partner.txt');
                        $objTempFile->truncate();
                        $objTempFile->append($objTemplate->parse());
                        $objTempFile->sendToBrowser();
                    }
                    else
                    {
                        Message::addError('Fehler! Geben Sie eine gueltige Zielseite an.');
                    }
                }
                else
                {
                    Message::addError('Bitte geben Sie zuerst den company id token ein.');
                }
            }
        }
        $this->redirect($this->getReferer());
    }


    /**
     * input_field_callback
     * @return string
     */
    public function generateHtmlDownloadButton()
    {

        $html = "
<div id=\"sub_htmlDownloadButton\">
    <div>
        <h3><label>%s</label></h3>
        <br>
        <button class=\"tl_submit\" onclick=\"location.href='%s&amp;action=downloadHtml'; return false;\">HTML Iframe Schnipsel downloaden</button>
        <p class='tl_help tl_tip'>%s</p>
    </div>
</div>";
        $html = sprintf($html, $GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['downloadAutologinLinkButton'][0], Environment::get('request'), $GLOBALS['TL_LANG']['tl_fiba_b2b_partner']['downloadAutologinLinkButton'][1]);
        return $html;
    }

    /**
     * Add an image to each record
     * @param array $row
     * @param string $label
     * @param DataContainer $dc
     * @param array $args
     *
     * @return array
     */
    public function addIcon($row, $label, DataContainer $dc, $args)
    {
        $image = 'member';
        $time = \Date::floorToMinute();

        $disabled = $row['start'] !== '' && $row['start'] > $time || $row['stop'] !== '' && $row['stop'] < $time;

        if ($row['disable'] || $disabled)
        {
            $image .= '_';
        }

        $args[0] = sprintf('<div class="list_icon_new" style="background-image:url(\'%ssystem/themes/%s/images/%s.gif\')" data-icon="%s.gif" data-icon-disabled="%s.gif">&nbsp;</div>', TL_ASSETS_URL, Backend::getTheme(), $image, $disabled ? $image : rtrim($image, '_'), rtrim($image, '_') . '_');

        return $args;
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

        $href .= '&amp;tid=' . $row['id'] . '&amp;state=' . $row['disable'];

        if ($row['disable'])
        {
            $icon = 'invisible.gif';
        }

        return '<a href="' . $this->addToUrl($href) . '" title="' . specialchars($title) . '"' . $attributes . '>' . Image::getHtml($icon, $label, 'data-state="' . ($row['disable'] ? 0 : 1) . '"') . '</a> ';
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

        $objVersions = new Versions('tl_fiba_b2b_partner', $intId);
        $objVersions->initialize();

        // Trigger the save_callback
        if (is_array($GLOBALS['TL_DCA']['tl_fiba_b2b_partner']['fields']['disable']['save_callback']))
        {
            foreach ($GLOBALS['TL_DCA']['tl_fiba_b2b_partner']['fields']['disable']['save_callback'] as $callback)
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

        $time = time();

        // Update the database
        $this->Database->prepare("UPDATE tl_fiba_b2b_partner SET tstamp=$time, disable='" . ($blnVisible ? '' : 1) . "' WHERE id=?")
            ->execute($intId);

        $objVersions->create();

    }

    /**
     * Check a static URL
     *
     * @param mixed $varValue
     *
     * @return mixed
     */
    public function checkStaticUrl($varValue)
    {
        if ($varValue != '')
        {
            $varValue = preg_replace('@https?://@', '', $varValue);
            $varValue = preg_replace('@www.@', '', $varValue);

        }

        return $varValue;
    }

    /**
     * @param $value
     * @param DC_Table $dc
     * @return string
     */
    public function generateCompanyIdToken($value, DC_Table $dc)
    {
        if ($value != '')
        {
            return $value;
        }
        return sha1(time() . rand(1, 10000)) . sha1(time() . rand(1, 10000));
    }
}

