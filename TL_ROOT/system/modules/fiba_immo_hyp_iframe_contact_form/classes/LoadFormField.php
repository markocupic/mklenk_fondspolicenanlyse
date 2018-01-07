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
 * Namespace
 */

namespace Markocupic\FibaImmoHypIframeContactForm;

use Contao\Input;
use Contao\Widget;
use Contao\FibaB2bPartnerModel;

/**
 * Class LoadFormField
 * @package Markocupic\FibaImmoHypIframeContactForm
 */
class LoadFormField
{

	/**
	 * @param Widget $objWidget
	 * @param $strForm
	 * @param $arrForm
	 * @return Widget
	 */
	public function loadFormFieldHook(Widget $objWidget, $strForm, $arrForm)
	{

		if (Input::get('showContactForm') && $objWidget->name === 'companyName' && Input::get('companyIdToken') != '')
		{
			$token = Input::get('companyIdToken');
			if ($token !== '')
			{
				$objPartner = FibaB2bPartnerModel::findByCompanyIdToken($token);
				if ($objPartner !== null)
				{
					if (!$objPartner->disable)
					{
						$objWidget->value = $objPartner->companyName != '' ? htmlspecialchars($objPartner->companyName) : 'Keine Zuordnung moeglich';
					}
				}
			}
		}

		return $objWidget;
	}

}
