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
use Contao\Email;
use Contao\Controller;
use Contao\Validator;


/**
 * Class FormHook
 * @package Markocupic\FibaImmoHypIframeContactForm
 */
class FormHook
{

    /**
     * Write comapany name to the hidden field companyName
     *
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

    /**
     * Send message with all data to tl_fiba_b2b_partner.partnerHiredByEmail
     *
     * @param $arrSubmitted
     * @param $arrData
     * @param $arrFiles
     * @param $arrLabels
     * @param $objForm
     */
    public function processFormDataHook($arrSubmitted, $arrData, $arrFiles, $arrLabels, $objForm)
    {

        if (Input::get('showContactForm') && $arrSubmitted['companyName'] != '' && Input::get('companyIdToken') != '')
        {
            $token = Input::get('companyIdToken');
            if ($token !== '')
            {
                $objPartner = FibaB2bPartnerModel::findByCompanyIdToken($token);
                if ($objPartner !== null)
                {
                    if (!$objPartner->disable)
                    {
                        if ($objPartner->partnerHiredByEmail == '')
                        {
                            return;
                        }

                        if (!Validator::isEmail($objPartner->partnerHiredByEmail))
                        {
                            return;
                        }
                        $recipient = $objPartner->partnerHiredByEmail;


                        $recipientCc = '';
                        if (Validator::isEmail($recipient))
                        {
                            $recipientCc = $objPartner->email;
                        }

                        $message = 'Hallo ' . "\n\n";
                        $message .= 'Eine neue Anfrage ist eingegangen von:  ' . "\n\n\n";
                        $message .= '-----------------------------------  ' . "\n";
                        foreach ($arrSubmitted as $k => $v)
                        {
                            if ($k == 'cc')
                            {
                                continue;
                            }

                            $v = deserialize($v);

                            // Skip empty fields
                            if ($objForm->skipEmpty && !is_array($v) && !strlen($v))
                            {
                                continue;
                            }

                            // Add field to message
                            $message .= (isset($arrLabels[$k]) ? $arrLabels[$k] : ucfirst($k)) . ':' . "\n";
                            $message .= (is_array($v) ? implode(', ', $v) : $v) . "\n\n";

                        }
                        $message .= '-----------------------------------  ' . "\n";

                        $message .= 'Dies ist eine automatisch generierte Nachricht. Bitte antworten Sie nicht darauf.' . "\n\n";
                        $message .= 'Freundliche Gruesse.' . "\n\n";
                        $message .= $GLOBALS['TL_ADMIN_EMAIL'] . "\n\n";


                        $email = new Email();
                        $email->from = $GLOBALS['TL_ADMIN_EMAIL'];
                        $email->fromName = $GLOBALS['TL_ADMIN_NAME'];
                        // Set the admin e-mail as "from" address
                        $email->from = $GLOBALS['TL_ADMIN_EMAIL'];
                        $email->fromName = $GLOBALS['TL_ADMIN_NAME'];
                        $email->subject = Controller::replaceInsertTags($objForm->subject, false);
                        $email->text = $message;

                        // Send a copy to the partner
                        if ($recipientCc != '')
                        {
                            $email->sendCc($recipientCc);
                        }

                        $email->sendTo($recipient);
                    }
                }
            }
        }
    }
}
