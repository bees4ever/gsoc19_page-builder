<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_menus
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Templates\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\Language\Associations;
use Joomla\CMS\Language\LanguageHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Response\JsonResponse;
use Joomla\CMS\Session\Session;
use Joomla\CMS\Table\Table;
use Joomla\Component\Templates\Administrator\Helper\RenderHelper;

/**
 * The menu controller for ajax requests
 *
 * @since  3.9.0
 */
class AjaxController extends BaseController
{
    /**
     * Method to fetch associations of a menu item
     *
     * The method assumes that the following http parameters are passed in an Ajax Get request:
     * token: the form token
     * assocId: the id of the menu item whose associations are to be returned
     * excludeLang: the association for this language is to be excluded
     *
     * @return  null
     *
     * @since  3.9.0
     */

    public function fetchAssociations()
    {
        switch($this->input->get("action")) {
            case "pagebuilder_liveview":
                $view = RenderHelper::renderElements(base64_decode($this->input->get("data"))); // layout JSON is encoded
                echo new JsonResponse($view, "pagebuilder preview rendering");
                break;
        }
    }
}
