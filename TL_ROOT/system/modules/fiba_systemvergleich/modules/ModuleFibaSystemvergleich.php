<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 02.03.2017
 * Time: 23:14
 */

namespace Markocupic;


class ModuleFibaSystemvergleich extends \Module
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_fiba_systemvergleich';

    /**
     * Template
     * @var string
     */
    protected $strTemplateAjax = 'mod_fiba_systemvergleich_ajax';

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

            $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['fiba_systemvergleich'][0]) . ' ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

        if (\Environment::get('isAjaxRequest') && \Input::post('FORM_SUBMIT') === 'systemvergleichForm')
        {
            // Bypass Search Index for Ajax calls to prevent duplicate content error
            global $objPage;
            $objPage->noSearch = 1;

            $json = array();
            $json['status'] = 'error';

            $errorlevel = 0;
            foreach($_POST as $k => $v)
            {
                $json[$k] = \Input::post($k);
            }

            $objDb1 = \Database::getInstance()->prepare('SELECT * FROM tl_fiba_systemvergleich WHERE system=? AND laufzeit LIKE ? AND kosten LIKE ?')->limit(1)->execute('Fondssparplan', \Input::post('fondssparplan_laufzeit'), \Input::post('fondssparplan_kosten'));
            if ($objDb1->numRows)
            {
                $json['fondssparplan_laufzeit'] = $objDb1->laufzeit;
                $json['fondssparplan_kosten'] = $objDb1->kosten;
                $json['fondssparplan_ablaufleistung'] = $objDb1->ablaufleistung;
                $errorlevel++;
            }

            $objDb2 = \Database::getInstance()->prepare('SELECT * FROM tl_fiba_systemvergleich WHERE system=? AND laufzeit LIKE ? AND kosten LIKE ?')->limit(1)->execute('Fondspolice', \Input::post('fondspolice_laufzeit'), \Input::post('fondspolice_kosten'));
            if ($objDb2->numRows)
            {
                $json['fondspolice_laufzeit'] = $objDb2->laufzeit;
                $json['fondspolice_kosten'] = $objDb2->kosten;
                $json['fondspolice_ablaufleistung'] = $objDb2->ablaufleistung;
                $errorlevel++;

                $objDb3 = \Database::getInstance()->prepare('SELECT * FROM tl_fiba_systemvergleich WHERE system=? AND laufzeit LIKE ? AND kosten LIKE ?')->limit(1)->execute('Rentenkapital', \Input::post('fondspolice_laufzeit'), \Input::post('fondspolice_kosten'));
                if ($objDb3->numRows)
                {
                    $json['rentenkapital_laufzeit'] = $objDb3->laufzeit;
                    $json['rentenkapital_kosten'] = $objDb3->kosten;
                    $json['rentenkapital_ablaufleistung'] = $objDb3->ablaufleistung;
                    $errorlevel++;
                }
            }

            if ($errorlevel == 3)
            {
                $json['status'] = 'success';
            }


            echo json_encode($json);
            exit;
        }

        return parent::generate();
    }


    /**
     * Generate the module
     */
    protected function compile()
    {

        // Fondssparplan
        $objDb = \Database::getInstance()->prepare('SELECT DISTINCT laufzeit FROM tl_fiba_systemvergleich WHERE system=? ORDER BY laufzeit ASC')->execute('Fondssparplan');
        $arrFondssparplanLaufzeit = $objDb->fetchEach('laufzeit');
        $this->Template->arrFondssparplanLaufzeit = $arrFondssparplanLaufzeit;

        $objDb = \Database::getInstance()->prepare('SELECT DISTINCT kosten FROM tl_fiba_systemvergleich WHERE system=? ORDER BY kosten ASC')->execute('Fondssparplan');
        $arrFondssparplanKosten = $objDb->fetchEach('kosten');
        $this->Template->arrFondssparplanKosten = $arrFondssparplanKosten;

        // Fondspolice
        $objDb = \Database::getInstance()->prepare('SELECT DISTINCT laufzeit FROM tl_fiba_systemvergleich WHERE system=? ORDER BY laufzeit ASC')->execute('Fondspolice');
        $arrFondspoliceLaufzeit = $objDb->fetchEach('laufzeit');
        $this->Template->arrFondspoliceLaufzeit = $arrFondspoliceLaufzeit;

        $objDb = \Database::getInstance()->prepare('SELECT DISTINCT kosten FROM tl_fiba_systemvergleich WHERE system=? ORDER BY kosten ASC')->execute('Fondspolice');
        $arrFondspoliceKosten = $objDb->fetchEach('kosten');
        $this->Template->arrFondspoliceKosten = $arrFondspoliceKosten;

    }



}





