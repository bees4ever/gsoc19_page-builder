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

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Language\LanguageHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Response\JsonResponse;
use Joomla\CMS\Session\Session;
use Joomla\CMS\Table\Table;
use Joomla\Component\Templates\Administrator\Helper\RenderHelper;
use Joomla\CMS\Document\HtmlDocument;

/**
 * The menu controller for ajax requests
 *
 * @since  3.9.0
 */
class AjaxController extends BaseController
{
	/**
	 * Method to fetch associations
	 *
	 * The method assumes that the following http parameters are passed in an Ajax Get request:
	 * handles request for the page builder
	 *
	 * @return string JSON answer
	 * @author Allan Karlson
	 * @since  3.9.0
	 */

	public function fetchAssociations()
	{
		switch ($this->input->get("action"))
		{
			case "pagebuilder_liveview":
				$jsonLayout = base64_decode($this->input->get("data"));
				//$view = RenderHelper::renderElements($jsonLayout); // layout JSON is encoded

				// Apodis index.php need a "grid" parameter which I encoded because of "parameter sanitizing",
				// therefore set it again to the $_GET parameter now
				$_GET['grid'] = $jsonLayout;

				$config = Factory::getConfig();

				$fulltempPath = $config->get('tmp_path') . "/../templates/";

				$htmlDoc = new HtmlDocument();
				$outrender = $htmlDoc->render(false, ["directory" => $fulltempPath, "template" => "apodis", "file" => "index.php"]);
				echo new JsonResponse($outrender, "pagebuilder preview rendering");
				break;
		}
	}
}
