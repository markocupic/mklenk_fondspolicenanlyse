<?php

/**
 * Contao Open Source CMS
 * Copyright (c) 2005-2014 Leo Feyer
 * @package BUF (Beurteilen und Fördern)
 * @author Marko Cupic m.cupic@gmx.ch, 2014
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace Markocupic;


/**
 * Class PDFController
 */

class FondstabellenPdfBase extends \TCPDF
{
    /**
     * @var Event db-object
     */
    public $Event;


    /**
     * @var page type
     */
    public $type;


    // Page header
    public function Header()
    {

        // Logo header left
        //$logoSRC = TL_ROOT . '/system/modules/fiba_fondspolicen/assets/fiba-logo.png';
        //$this->Image($logoSRC, 20, 10, 15, '', '', 'http://www.fiba-consulting.de', '', false, 300, '', false, false, 0);

        // Logo header right
        $logoSRC = TL_ROOT . '/system/modules/fiba_fondspolicen/assets/Fondspolicen-Analyse_Logo1.jpg';
        $this->Image($logoSRC, 217, 10, 60, '', '', 'https://www.fondspolicen-analyse.de', '', false, 300, '', false, false, 0);
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetX(0);
        $this->SetY(-15);

        // Set font
        $this->SetFont('opensanslight', '', 9);
        // Footer Text
        $this->Cell(277, 10, $this->getAliasNumPage() . ' von ' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
        $this->SetX(0);
        $this->SetY(-15);
        $this->Cell(0, 10, '© Fondspolicen-Analyse.de, Berechnungsgrundlagen sowie weitere Annahmen siehe: https://www.fondspolicen-analyse.de/Fondspolicen-Vergleich.html ', 0, false, 'L', 0, '', 0, false, 'T', 'M');
    }

}

class FondspolicenTcpdf extends \System
{

    /**
     * @var
     */
    public $pdf;


    /**
     *
     */
    public function __construct()
    {
        // register fpdf classes
        \ClassLoader::addClasses(array(
            'TCPDF'       => 'vendor/tecnickcom/tcpdf/tcpdf.php',
            'TCPDF_FONTS' => 'vendor/tecnickcom/tcpdf/include/tcpdf_fonts.php',
        ));

        return parent::__construct();
    }

    /**
     * Launch method cia CronJob (Geplante Aufgaben on Plesk)
     */
    public function printFondspolicen($html)
    {

        // create new PDF document
        // Extend TCPDF for special footer and header handling
        $this->pdf = new FondstabellenPdfBase(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        //opensanslight
        \TCPDF_FONTS::addTTFfont(TL_ROOT . '/system/modules/fiba_fondspolicen/fonts/opensans/OpenSans-Light.ttf', 'TrueTypeUnicode', '', 96);
        // opensansb
        \TCPDF_FONTS::addTTFfont(TL_ROOT . '/system/modules/fiba_fondspolicen/fonts/opensans/OpenSans-Bold.ttf', 'TrueTypeUnicode', '', 96);
        //opensanslighti
        \TCPDF_FONTS::addTTFfont(TL_ROOT . '/system/modules/fiba_fondspolicen/fonts/opensans/OpenSans-LightItalic.ttf', 'TrueTypeUnicode', '', 96);

        $this->pdf->setPrintHeader(true);
        $this->pdf->setPrintFooter(true);

        // set margins
        $this->pdf->SetMargins(20, 20, 20);
        $this->pdf->SetHeaderMargin(0);


        // set auto page breaks false
        $this->pdf->SetAutoPageBreak(true, 15);

        $this->pdf->AddPage('L', 'A4');
        $this->pdf->SetY(25);
        $this->pdf->SetFont('opensanslight', '', 9);
        $this->pdf->SetTextColor(0, 0, 0);


        $html = preg_replace('/class="headerlogo" width="(\d+)"/', 'class="headerlogo" width="40"', $html);

        $html = str_replace('<span class="fa fa-check-circle"></span>', '<img src="system/modules/fiba_fondspolicen/assets/checked-symbol.png" width="9"/>', $html);
        $posPageBreak = strpos($html, '<!--tcpdf-page-2-->');
        $posStyle = strpos($html, '<!--tcpdf-style-->');

        $page_1 = substr($html, 0, $posPageBreak);
        $page_2 = substr($html, $posPageBreak, $posStyle - $posPageBreak);
        $htmlStyle = substr($html, $posStyle);

        $this->pdf->writeHTML($page_1 . $htmlStyle);

        $this->pdf->AddPage('L', 'A4');
        $this->pdf->SetY(25);
        $this->pdf->writeHTML($page_2 . $htmlStyle);


        // Send File to Browser
        $this->pdf->Output('Fiba_Consulting_Fondspolicenvergleich.pdf', 'D');

    }

    /**
     * @return string
     */
    private function generateStyle()
    {

        // Create template object
        $objPartial = new \FrontendTemplate('fondspolicenvergleich_pdf');
        return $objPartial->parse();

    }


}