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

use Contao\Module;
use Contao\BackendTemplate;
use Contao\Input;
use Contao\FibaB2bPartnerModel;


/**
 * Class IframeContactForm
 *
 * @copyright  Marko Cupic 2018
 * @author     Marko Cupic
 */
class IframeContactForm extends Module
{

	protected $strTemplate = 'mod_iframe_contact_form';

	protected $objPartner = null;

	protected $hasError;

	protected $errorMsg = array();

	/**
	 * @return string
	 */
	public function generate()
	{

		if (TL_MODE == 'BE')
		{
			/** @var \BackendTemplate|object $objTemplate */
			$objTemplate = new BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['iframeContactForm'][0]) . ' ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}


		$token = Input::get('companyIdToken');
		if (Input::get('showContactForm') && $token !== '')
		{
			$objPartner = FibaB2bPartnerModel::findByCompanyIdToken($token);
			if ($objPartner !== null)
			{
				if (!$objPartner->disable)
				{
					if ($objPartner->enableRefererCheck)
					{
						if (strpos($_SERVER['HTTP_REFERER'], $objPartner->website) !== false)
						{
							$this->objPartner = $objPartner;
						}
						else
						{
							$this->hasError = true;
							$this->errorMsg[] = $GLOBALS['TL_LANG']['MSC']['refererCheckFailed'];
						}
					}
					else
					{
						$this->objPartner = $objPartner;
					}
				}
				else
				{
					$this->hasError = true;
					$this->errorMsg[] = $GLOBALS['TL_LANG']['MSC']['partnerDisabled'];
				}
			}
			else
			{
				$this->hasError = true;
				$this->errorMsg[] = $GLOBALS['TL_LANG']['MSC']['noCompanyIdTokenTransmitted'];
			}

			// Do not check on form submit
			if ($_POST['FORM_SUBMIT'] != '')
			{
				$this->hasError = null;
				$this->errorMsg = [];
			}

		}


		return parent::generate();
	}


	/**
	 * Generate the module
	 */
	protected function compile()
	{

		if ($this->hasError)
		{
			$this->Template->errorMsg = implode(' ', $this->errorMsg);
			$this->Template->hasError = true;
		}
		else
		{
			$this->Template->form = $this->form;
		}
	}
}
