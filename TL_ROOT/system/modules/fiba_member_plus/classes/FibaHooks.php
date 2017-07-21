<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 14.06.2017
 * Time: 17:54
 */

namespace FibaMemberPlus;


class FibaHooks
{

    /**
     * @param $userId
     * @param $arrData
     * @param $objRegistration
     */
    public function createNewUser($userId, $arrData, $objRegistration)
    {
        if ($objRegistration->isEmpfehlungsgeberRegistrationForm)
        {
            $objNewUser = \MemberModel::findByPk($userId);
            if ($objNewUser !== null)
            {
                $objNewUser->fibaRole = 'isEmpfehlungsgeber';
                $objNewUser->empfehlungsgeberLevel = '0';
                $objNewUser->empfehlungsgeberAusbezahltePraemie = '0';

                // Der agentId Url Parameter referenziert einen Vermittler
                if (\Input::get('agentId') != '')
                {
                    $objMember = \Database::getInstance()->prepare('SELECT * FROM tl_member WHERE fibaRole=? AND vermittlerId=?')->limit(1)->execute('isVermittler', \Input::get('agentId'));
                    if ($objMember->numRows)
                    {
                        $objNewUser->betreutDurchVermittlerId = $objMember->id;
                    }
                }
                $objNewUser->save();
            }
        }
    }

    /**
     * @param $arrSubmitted
     * @param $arrData
     * @param $arrFiles
     * @param $arrLabels
     * @param $objForm
     */
    public function processFormData($arrSubmitted, $arrData, $arrFiles, $arrLabels, $objForm)
    {
        // Send email to the assigned vermittler (agent)
        if ($objForm->formID == 'form-weitere-empfehlung')
        {
            $objMember = \FrontendUser::getInstance();
            if ($objMember != null)
            {
                if ($objMember->fibaRole == 'isEmpfehlungsgeber' && $objMember->betreutDurchVermittlerId > 0)
                {
                    $objVermittler = \MemberModel::findByPk($objMember->betreutDurchVermittlerId);
                    if ($objVermittler !== null)
                    {
                        $message = 'Hallo ' . $objVermittler->firstname . "\n\n";
                        $message .= sprintf('Von %s %s aus deinem Empfehlungs-Club kommt eine neue Empfehlung. Hier die Daten: ', $objMember->firstname, $objMember->lastname) . "\n\n";

                        foreach ($arrSubmitted as $k => $v)
                        {
                            if ($k == 'cc')
                            {
                                continue;
                            }

                            $v = deserialize($v);

                            // Skip empty fields
                            if (!is_array($v) && !strlen($v))
                            {
                                continue;
                            }

                            // Add field to message
                            $message .= (isset($arrLabels[$k]) ? $arrLabels[$k] : ucfirst($k)) . ': ' . (is_array($v) ? implode(', ', $v) : $v) . "\n";
                        }
                        $email = new \Email();
                        $email->subject = sprintf('Neue Empfehlung von %s %s aus deinem Empfehlungsclub', $objMember->firstname, $objMember->lastname);


                        // Set the admin e-mail as "from" address
                        $email->from = $objMember->email != '' ? $objMember->email : $GLOBALS['TL_ADMIN_EMAIL'];
                        $email->fromName = $objMember->email != '' ? $objMember->firstname . ' ' . $objMember->lastname : $GLOBALS['TL_ADMIN_NAME'];
                        if ($objMember->email != '')
                        {
                            $replyTo = '"' . $objMember->firstname . ' ' . $objMember->lastname . '" <' . $objMember->email . '>';
                            $email->replyTo($replyTo);
                        }
                        $email->text = \StringUtil::decodeEntities(trim($message));
                        $email->sendTo($objVermittler->email);
                    }
                }
            }
        }
    }


    /**
     * @param $arrAttributes
     * @param $objDca
     * @return mixed
     */
    public function getAttributesFromDca($arrAttributes, $objDca)
    {
        // Im Frontend soll der Vermittler kein mandatory Feld sein.
        if (TL_MODE == 'FE')
        {
            if ($arrAttributes['name'] == 'betreutDurchVermittlerId')
            {
                $arrAttributes['mandatory'] = 0;
            }
            if ($arrAttributes['name'] == 'postal')
            {
                $arrAttributes['mandatory'] = 1;
            }
            if ($arrAttributes['name'] == 'street')
            {
                $arrAttributes['mandatory'] = 1;
            }
            if ($arrAttributes['name'] == 'city')
            {
                $arrAttributes['mandatory'] = 1;
            }
        }

        return $arrAttributes;
    }


    /**
     * @param $arrAttributes
     * @param $objDca
     * @return mixed
     */
    public function parseWidget($strBuffer, $objWidget)
    {
        if (TL_MODE == 'FE')
        {
            // Der agentId Url Parameter referenziert einen Vermittler
            // Ist der Parameter gesetzt, wird dem neuen Benutzer im createNewUser Hook ein Vermittler zugeordnet
            if (\Input::get('agentId'))
            {
                if ($objWidget->name == 'betreutDurchVermittlerId')
                {
                    $strBuffer = '';
                }
            }
        }

        return $strBuffer;


    }

    /**
     * @param $strBuffer
     * @param $strTemplate
     * @return mixed
     */
    public function parseFrontendTemplate($strBuffer, $strTemplate)
    {
        // AGB's hinzufügen
        if ($strTemplate == 'member_default')
        {
            $strBuffer = str_replace('<fieldset id="ctrl_agb"', '{{insert_content::2138}}<fieldset id="ctrl_agb"', $strBuffer);
        }

        return $strBuffer;
    }


}