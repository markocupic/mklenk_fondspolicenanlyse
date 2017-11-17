<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 16.08.2017
 * Time: 21:24
 */

// Palettes
$GLOBALS['TL_DCA']['tl_member']['palettes']['__selector__'][] = 'enableAutologin';
$GLOBALS['TL_DCA']['tl_member']['palettes']['__selector__'][] = 'enableAutologinRefererCheck';
$GLOBALS['TL_DCA']['tl_member']['subpalettes']['enableAutologin'] = 'autologinKey,enableAutologinRefererCheck,htmlDownloadButton';
$GLOBALS['TL_DCA']['tl_member']['subpalettes']['enableAutologinRefererCheck'] = 'autologinHostnames';


// Default palette
$GLOBALS['TL_DCA']['tl_member']['palettes']['default'] = str_replace('{login_legend', '{autologin_legend},enableAutologin;{login_legend', $GLOBALS['TL_DCA']['tl_member']['palettes']['default']);


// Onload callback
if (TL_MODE == 'BE')
{
    $GLOBALS['TL_DCA']['tl_member']['config']['onload_callback'][] = array('tl_member_fiba_autoload', 'sendHtmlSnippetToBrowser');
}


// Fields
$GLOBALS['TL_DCA']['tl_member']['fields']['htmlDownloadButton'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_member']['htmlDownloadButton'],
    'exclude' => true,
    'filter' => false,
    //'inputType' => 'checkbox',
    'input_field_callback' => array('tl_member_fiba_autoload', 'generateHtmlDownloadButton'),
    'eval' => array('doNotShow' => true, 'tl_class' => 'clr'),
    'sql' => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['enableAutologin'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_member']['enableAutologin'],
    'exclude' => true,
    'filter' => true,
    'inputType' => 'checkbox',
    'eval' => array('submitOnChange' => true, 'tl_class' => 'clr'),
    'sql' => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['autologinKey'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_member']['autologinKey'],
    'exclude' => true,
    'filter' => true,
    'load_callback' => array(array('tl_member_fiba_autoload', 'generateKey')),
    'inputType' => 'text',
    'eval' => array('mandatory' => true, 'submitOnChange' => true, 'tl_class' => 'clr long'),
    'sql' => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['enableAutologinRefererCheck'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_member']['enableAutologinRefererCheck'],
    'exclude' => true,
    'filter' => true,
    'inputType' => 'checkbox',
    'eval' => array('submitOnChange' => true, 'tl_class' => 'clr'),
    'sql' => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['autologinHostnames'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_member']['autologinHostnames'],
    'exclude' => true,
    'inputType' => 'multiColumnWizard',
    'eval' => array
    (
        'columnFields' => array
        (
            'autologinAddressItem' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_member']['autologinHostnameItem'],
                'exclude' => true,
                'inputType' => 'text',
                'eval' => array('style' => 'width:220px')
            )
        )
    ),
    'sql' => "blob NULL"
);

/**
 * Class tl_member_fiba_autoload
 */
class tl_member_fiba_autoload extends Backend
{

    /**
     * onload_callback
     */
    public function sendHtmlSnippetToBrowser($dc)
    {

        if (Input::get('action') == 'downloadHtml')
        {
            if ($dc->id != '')
            {
                $objMember = MemberModel::findByPk($dc->id);
                if ($objMember !== null)
                {
                    if ($objMember->autologinKey != '')
                    {
                        $objTemplate = new BackendTemplate('be_fiba_autologin_link');
                        $objTemplate->autologinKey = $objMember->autologinKey;
                        $objTemplate->protocol = \Environment::get('ssl') ? 'https://' : 'http://';
                        $objTempFile = new File('system/tmp/fiba_autologin.txt');
                        $objTempFile->truncate();
                        $objTempFile->append($objTemplate->parse());
                        $objTempFile->sendToBrowser();
                    }
                    else
                    {
                        Message::addError('Bitte geben Sie zuerst den autologin key ein.');
                    }

                }

            }
            $this->redirect($this->getReferer());
        }
    }

    /**
     * load_callback
     */
    public function generateKey($value, DC_Table $dc)
    {

        if ($value == '')
        {
            $value = Markocupic\Fiba\FibaMemberAutologin::generateKey();
        }

        return $value;
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
        <h3><label>HTML Schnipsel downloaden</label></h3>
        <br>
        <button class=\"tl_submit\" onclick=\"location.href='" . Environment::get('request') . "&amp;action=downloadHtml'; return false;\">HTML Schnipsel download</button>
    </div>
</div>";
        return $html;
    }
}

