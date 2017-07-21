<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 02.03.2017
 * Time: 23:14
 */

namespace Markocupic;


class ModuleVorsorgefondsList extends \Module
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_vorsorgefonds_list';

    /**
     * Template
     * @var string
     */
    protected $strTemplateAjax = 'mod_vorsorgefonds_list_ajax';

    /**
     * isAjaxRequest
     * @var bool
     */
    protected $isAjax = false;


    /**
     * Display a wildcard in the back end
     *
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            /** @var \BackendTemplate|object $objTemplate */
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['vorsorgefonds'][0]) . ' ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

        if (\Environment::get('isAjaxRequest') && $this->Input->get('FORM_SUBMIT') == 'auto_vorsorgefondsFilteredListForm')
        {
            // Use an other template for Ajax calls
            $this->isAjax = true;
            $this->strTemplate = $this->strTemplateAjax;

            // Bypass Search Index for Ajax calls to prevent duplicate content error
            global $objPage;
            $objPage->noSearch = 1;
        }
        // Load Language File for thead
        \System::loadLanguageFile('tl_vorsorgefonds');


        return parent::generate();
    }


    /**
     * Generate the module
     */
    protected function compile()
    {

        $rows = array();

        $tarif = $this->Input->get('tarif') ?: 'einzel';
        $laufzeit = $this->Input->get('laufzeit') ?: 12;
        $sparrate = $this->Input->get('sparrate') ?: 100;
        $kosten = $this->Input->get('kosten') == 'mit_fondskosten' ? 'mit_fondskosten' : 'ohne_fondskosten';
        $etf = $this->Input->get('etf') == 'ja' ? true : false;
        $dimensional = $this->Input->get('dimensional') == 'ja' ? true : false;
        $order = ($kosten == 'mit_fondskosten') ? 'kostenMitFonds' : 'kostenOhneFonds';


        $where = array(
            "tarif='" . $tarif . "'",
            "laufzeit=" . $laufzeit,
            "sparrate=" . $sparrate,
        );

        if ($etf)
        {
            $where[] = "etf='ja'";
        }

        if ($dimensional)
        {
            $where[] = "dimensional='ja'";
        }
        $chartX = [];
        $chartY = [];
        $chartBg = [];
        $chartBorder = [];


        $objDb = $this->Database->prepare("SELECT * FROM tl_vorsorgefonds WHERE " . implode(" AND ", $where) . " ORDER BY " . $order)->execute();
        $i = 0;
        while ($objDb->next())
        {
            $rows[] = $objDb->row();
            $chartX[] = '"' . $objDb->versicherer . '"';
            $xValue = ($kosten == 'mit_fondskosten') ? $objDb->kostenMitFonds : $objDb->kostenOhneFonds;
            $chartY[] = str_replace('%', '', str_replace(',', '.', $xValue));

            $color = $this->getColor($i);
            $chartBg[] = "'rgba(" . implode(',', $color) . ",0.2)'";
            $chartBorder[] = "'rgba(" .implode(',', $color) . ",1)'";
            $i++;
        }

        $this->Template->rows = $rows;

        // Visible fields in the table
        $fields = array('versicherer', 'tarif', 'tarifbezeichnung');
        $fields[] = ($kosten == 'ohne_fondskosten') ? 'kostenOhneFonds' : 'kostenMitFonds';
        $fields[] = ($kosten == 'ohne_fondskosten') ? 'ablaufleistungOhneFonds' : 'ablaufleistungMitFonds';
        //$fields[] = 'garantierterRentenfaktor';
        $fields[] = 'link';
        $this->Template->fields = $fields;

        // Message, if there are no items
        $this->Template->noItemsFound = $GLOBALS['TL_LANG']['MSC']['noItemFound'];
        $this->Template->chartX = implode(',', $chartX);
        $this->Template->chartY = implode(',', $chartY);
        $this->Template->chartBg = implode(',', $chartBg);
        $this->Template->chartBorder = implode(',', $chartBorder);

        // Closure setValue from the template
        $this->Template->setValue = (function($key, $row){
            $value = $row[$key];
            switch ($key) {
                case 'kostenOhneFonds':
                case 'kostenMitFonds':
                    $value = $value . ' %';
                    break;
                case 'link':
                    $value = ($value != '') ? '<a href="' . $value . '" target="_blank" title="zum Anbieter">Link</a>' : '';
                    break;
                case 'garantierterRentenfaktor':
                case 'ablaufleistungOhneFonds':
                case 'ablaufleistungMitFonds':
                    $value = is_numeric($value) ? $value . ' &euro;' : $value;
                    break;
            }

            return $value;
        });

        // Parse and output template for Ajax calls
        if ($this->isAjax)
        {
            $this->Template->output();
            exit();
        }

    }

    /**
     * @param $num
     * @return array
     */
    public function getColor($num) {
        $hash = md5('color' . $num); // modify 'color' to get a different palette
        return array(
            hexdec(substr($hash, 0, 2)), // r
            hexdec(substr($hash, 2, 2)), // g
            hexdec(substr($hash, 4, 2)) // b
        );
    }



}



