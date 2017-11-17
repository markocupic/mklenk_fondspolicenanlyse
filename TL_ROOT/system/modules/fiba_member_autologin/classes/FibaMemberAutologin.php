<?php

namespace Markocupic\Fiba;


/**
 * Class FibaMemberAutologin
 * Autologin Frontend User if the autologinKey is assigned to a certain member
 * @author Marko Cupic <m.cupic@gmx.ch>
 */
class FibaMemberAutologin extends \Frontend
{


    /**
     * @var mixed|null
     */
    protected $objAutologinUser = null;


    /**
     * generatePage hook
     * @param $objPage
     * @param $objLayout
     * @param $objPageRegular
     */
    public function validateAutologinKey($objPage, $objLayout, $objPageRegular)
    {

        if(isset($_SESSION['fiba_autologin_user']))
        {
            unset($_SESSION['fiba_autologin_user']);
        }

        if (TL_MODE == 'FE')
        {
            if (\Input::get('autologin') == 'true' && \Input::get('autologinKey') != '')
            {

                // Check if user exists
                $objMember = \Database::getInstance()->prepare("SELECT * FROM tl_member WHERE autologinKey=? AND disable=? AND login=? AND enableAutologin=?")->execute(\Input::get('autologinKey'), '', '1', '1');
                if (!$objMember->numRows)
                {
                    // Redirect to home
                    $this->redirectToHome();
                }

                $objMemberModel = \MemberModel::findByPk($objMember->id);
                $objMemberModel->save();

                if ($objMemberModel !== null)
                {
                    // Referer check
                    if ($objMemberModel->enableAutologinRefererCheck)
                    {
                        $blnAllow = false;
                        $arrHosts = deserialize($objMemberModel->autologinHostnames, true);
                        if ($_SERVER["HTTP_REFERER"] != '')
                        {
                            foreach ($arrHosts as $host)
                            {
                                if ($host['autologinAddressItem'] != '')
                                {
                                    if (strpos($_SERVER["HTTP_REFERER"], $host['autologinAddressItem']) !== false)
                                    {
                                        $blnAllow = true;
                                        break;
                                    }
                                }
                            }
                        }

                        if ($blnAllow)
                        {
                            $this->objAutologinUser = $objMemberModel;
                        }
                    }
                    else
                    {
                        $this->objAutologinUser = $objMemberModel;
                    }
                }

                if ($this->objAutologinUser !== null)
                {
                    $this->loginUser();
                }

                // Redirect to home
                $this->redirectToHome();

            }
        }
    }


    /**
     * Login user
     */
    protected function loginUser()
    {

        if ($this->objAutologinUser !== null)
        {

            \Input::setPost('username', $this->objAutologinUser->username);
            \Input::setPost('password', 'xxxxxxxxyyyyyyyyyy');

            $this->import('FrontendUser', 'User');
            $strRedirect = '';



            // Overwrite the jumpTo page with an individual group setting
            $objMember = \MemberModel::findByUsername(\Input::post('username'));

            if ($objMember !== null)
            {
                $arrGroups = deserialize($objMember->groups);

                if (!empty($arrGroups) && is_array($arrGroups))
                {
                    $objGroupPage = \MemberGroupModel::findFirstActiveWithJumpToByIds($arrGroups);

                    if ($objGroupPage !== null)
                    {
                        $strRedirect = \Controller::generateFrontendUrl($objGroupPage->row(), null, null, true);
                    }
                }
            }



            // Save user id into the session
            $_SESSION['fiba_autologin_user'] = $this->objAutologinUser->id;

            // Login and redirect
            if ($this->User->login())
            {
                \Controller::redirect($strRedirect);
            }


            $this->redirectToHome();

        }

    }


    /**
     * checkCredentials-hook
     * @param $strUsername
     * @param $strPassword
     * @return bool
     */
    public function checkCredentials($strUsername, $strPassword)
    {
        // Authenticate without password
        if ($_SESSION['fiba_autologin_user'] > 0)
        {
            $objMember = \MemberModel::findByPk($_SESSION['fiba_autologin_user']);
            unset($_SESSION['fiba_autologin_user']);
            if ($objMember !== null)
            {
                if ($objMember->username === $strUsername)
                {
                    return true;
                }
            }
        }

        return false;
    }


    /**
     * @return string
     */
    public static function generateKey()
    {
        return md5(random_int(1, 10000000000) . microtime()) . md5(random_int(1, 10000000000) . microtime()) . md5(random_int(1, 10000000000) . microtime());
    }


    /**
     * redirectToHome
     */
    protected function redirectToHome()
    {
        global $objPage;
        $oPage = \PageModel::findByPk($objPage->id);
        if ($oPage !== null)
        {
            $strUrl = $oPage->getFrontendUrl();
            \Controller::redirect($strUrl);
        }
        \Controller::redirect('');
    }
}

