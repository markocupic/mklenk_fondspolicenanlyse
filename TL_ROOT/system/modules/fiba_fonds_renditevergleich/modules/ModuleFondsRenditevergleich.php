<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 02.03.2017
 * Time: 23:14
 */

namespace Markocupic;


class ModuleFondsRenditevergleich extends \Module
{
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_fonds_renditevergleich';

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplateAjax = 'mod_fonds_renditevergleich_ajax';

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

            $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['fonds_renditevergleich'][0]) . ' ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

		if (\Environment::get('isAjaxRequest') && $this->Input->get('FORM_SUBMIT') == 'fondsRenditevergleichFilterForm')
		{
			// Use an other template for Ajax calls
			$this->isAjax = true;
			$this->strTemplate = $this->strTemplateAjax;

			// Bypass Search Index for Ajax calls to prevent duplicate content error
			global $objPage;
			$objPage->noSearch = 1;
		}
		// Load Language File for thead
		\System::loadLanguageFile('tl_fonds_renditevergleich');


		return parent::generate();
	}


	/**
	 * Generate the module
	 */
	protected function compile()
	{
		// Get all providers as an array (this is used in the filter form for the options in the provider select menu
		$this->Template->arrAnbieter = $this->getAnbieter();

		$fieldRendite = $this->Input->get('rendite') ?: 'rendite3Jahre';


		// Handle the checkboxes in the filter form
		$arrFilter = array(
			'etf_aktienfonds' => 'ETF Aktienfonds',
			'etf_rentenfonds' => 'ETF Rentenfonds',
			'dimensional_aktienfonds' => 'Dimensional Aktienfonds',
			'dimensional_rentenfonds' => 'Dimensional Rentenfonds'
		);
		$arrWhere = array();
		$strWhere = '';
		foreach ($arrFilter as $k => $v)
		{
			if (\Input::get($k) == 1)
			{
				$arrWhere[] = "fondsart='" . $arrFilter[$k] . "'";
			}
		}
		if (count($arrWhere) > 0)
		{
			$strWhere = ' WHERE (' . implode(' OR ', $arrWhere) . ')';
		}

		// This is a bit "buggy" but it works ;-)
		// Do not show any datarecords if there are no checkboxes cheched
		if ($this->isAjax && $strWhere == '')
		{
			$strWhere = " WHERE id < '0'";
		}


		$chartX = [];
		$chartY = [];
		$chartBg = [];
		$chartBorder = [];

		$objDb = $this->Database->execute('SELECT * FROM tl_fonds_renditevergleich ' . $strWhere . ' ORDER BY ' . $fieldRendite . ' DESC');

		$i = 0;
		$rows = array();
		while ($objDb->next())
		{
			$blnFound = false;

			// If there is a filter
			if (\Input::get('anbieter') != '')
			{
				$strAnbieter = strtolower(trim($objDb->anbieter));
				$arrAnbieter = explode(',', $strAnbieter);
				$arrAnbieter = array_values($arrAnbieter);
				$arrAnbieter = array_unique($arrAnbieter);
				$arrAnbieter = array_filter($arrAnbieter);
				// !important urldecode Input
				$strFilter = urldecode(\Input::get('anbieter'));
				if (in_array(strtolower($strFilter), $arrAnbieter))
				{
					$rows[] = $objDb->row();
					$blnFound = true;
				}
			}
			else // Show all
			{
				$rows[] = $objDb->row();
				$blnFound = true;
			}


			if ($blnFound)
			{
				/**
				 * !important
				 * The configuration options for the horizontal bar chart are the same as for the bar chart.
				 * However, any options specified on the x axis in a bar chart, are applied to the y axis in a horizontal bar chart.
				 * The default horizontal bar configuration is specified in Chart.defaults.horizontalBar.
				 * http://www.chartjs.org/docs/latest/charts/bar.html
				 */
				$yValue = str_replace('%', '', str_replace(',', '.', $objDb->{$fieldRendite}));
				$chartY[] = '"' . $yValue . '"';
				$chartX[] = '"' . $objDb->fondsname . '"';

				$color = $this->getColor($i);
				$chartBg[] = "'rgba(" . implode(',', $color) . ",0.2)'";
				$chartBorder[] = "'rgba(" . implode(',', $color) . ",1)'";
				$i++;
			}
		}

		$this->Template->rows = $rows;

		// Visible fields in the table
		$fields = array('fondsname', 'isin');
		$fields[] = $fieldRendite;
		$fields = array_merge($fields, array('volantilitaet', 'laufendeKosten', 'factsheet', 'anbieter'));

		$this->Template->fields = $fields;

		// Message, if there are no items
		$this->Template->noItemsFound = $GLOBALS['TL_LANG']['MSC']['noItemFound'];
		$this->Template->chartX = implode(',', $chartX);
		$this->Template->chartY = implode(',', $chartY);
		$this->Template->chartBg = implode(',', $chartBg);
		$this->Template->chartBorder = implode(',', $chartBorder);

		// Closure setValue from the template
		$this->Template->setValue = (function ($key, $row)
		{
			$value = $row[$key];
			switch ($key)
			{
				case 'factsheet':
					$value = ($value != '') ? '<a href="' . $value . '" target="_blank" title="zum Anbieter">Factsheet</a>' : '';
					break;
				case 'anbieter':
					$value = sprintf('<img data-qtip2-tooltip="%s" style="cursor:help" src="system/modules/fiba_fonds_renditevergleich/assets/icons/list-provider.png">', $value);
					break;
				case 'laufendeKosten':
				case 'rendite3Jahre':
				case 'rendite5Jahre':
				case 'rendite10Jahre':
				case 'volantilitaet':
					$value = str_replace('.', ',', $value);
					$value = str_replace('0,00', '', $value);
					$value = $value != '' ? $value . ' %' : '';
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
	public function getColor($num)
	{
		$hash = md5('color' . $num); // modify 'color' to get a different palette
		return array(
			hexdec(substr($hash, 0, 2)), // r
			hexdec(substr($hash, 2, 2)), // g
			hexdec(substr($hash, 4, 2)) // b
		);
	}

	/**
	 * @return array
	 */
	protected function getAnbieter()
	{
		$strAnbieter = '';
		$objDb = $this->Database->execute("SELECT * FROM tl_fonds_renditevergleich");
		while ($objDb->next())
		{
			$strAnbieter .= trim($objDb->anbieter) . ',';
		}
		$arrAnbieter = explode(',', $strAnbieter);

		// Remove empty
		$arrAnbieter = array_values($arrAnbieter);
		$arrAnbieter = array_unique($arrAnbieter);
		$arrAnbieter = array_filter($arrAnbieter);
		// Sort array
		natcasesort($arrAnbieter);

		return $arrAnbieter;
	}


}





