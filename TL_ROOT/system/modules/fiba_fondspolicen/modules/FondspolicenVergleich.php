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
 * Namespace
 */
namespace Markocupic;


/**
 * Class FondspolicenVergleich
 *
 * @copyright  Marko Cupic 2016
 * @author     Marko Cupic
 * @package    Devtools
 */
class FondspolicenVergleich extends \Module
{

	/**
	 * @var bool
	 */
	protected $printPdf = false;

	/**
	 * @var bool
	 */
	protected $isAjax = false;

	/**
	 * @var null
	 */
	protected $ids = null;

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_fondspolicenvergleich';

	public function generate()
	{

        if (TL_MODE == 'BE')
        {
            /** @var \BackendTemplate|object $objTemplate */
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['fondspolicenvergleich'][0]) . ' ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

	    if(\Environment::get('isAjaxRequest'))
		{
			$this->isAjax = true;

		}

		if(\Input::get('printPdf') == 'true')
		{
			$this->printPdf = true;
			$this->strTemplate = 'fondspolicenvergleich_tcpdf';
		}

		if(\Input::get('ids'))
		{
			$this->ids = array_unique(explode(',', \Input::get('ids')));
		}



		return parent::generate();
	}


	/**
	 * Generate the module
	 */
	protected function compile()
	{

		$this->Template->isAjax = $this->isAjax;
		$this->Template->printPdf = $this->printPdf;

		if(!$this->isAjax && !$this->printPdf)
		{
			$arrItems = array();
			$objDatabase = $this->Database->prepare('SELECT * FROM tl_fondspolicen WHERE published=? ORDER BY title')->execute(1);
			if($objDatabase->numRows)
			{
				$arrItems = $objDatabase->fetchAllAssoc();
				$countItems = count($arrItems);
			}
			$this->Template->items = $arrItems;
			return;
		}

		// If isAjaxRequest
		$arrItems = array();
		$countItems = 0;
		foreach($this->ids as $id)
		{
			$objDatabase = $this->Database->prepare('SELECT * FROM tl_fondspolicen WHERE published=? AND id=?')->execute(1, $id);
			if($objDatabase->numRows)
			{
				$arrItems[] = $objDatabase->fetchAssoc();
				$countItems++;
			}
		}

		// Add icon path to array
		foreach($arrItems as $k => $item)
		{
			$iconPath = '';
			if($item['iconSRC'] != '')
			{
				$objFile = \FilesModel::findByUuid($item['iconSRC']);
				if($objFile !== null)
				{
					if(is_file(TL_ROOT . '/' . $objFile->path))
					{
						$iconPath = $objFile->path;
					}
				}
			}
			$arrItems[$k]['iconPath'] = $iconPath;
		}
		$this->Template->countItems = $countItems;
		$this->Template->items = $arrItems;
		$html = $this->Template->parse();
		$html = $this->replaceInsertTags($html);

		if($this->printPdf == true)
		{
			$objPdf = new FondspolicenTcpdf();
			$objPdf->printFondspolicen($html);
			exit();
		}


		echo json_encode(array('table' => $html));
		exit;
	}
}
