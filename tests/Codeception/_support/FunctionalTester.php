<?php
/**
 * @package     Joomla.Tests
 * @subpackage  FunctionalTester
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Codeception\Actor;
use Codeception\Lib\Friend;

/**
 * Functional Tester global class for entry point.
 *
 * Inherited Methods.
 *
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
 *
 * @since  3.7.3
 */
class FunctionalTester extends Actor
{
	use _generated\FunctionalTesterActions;

	/**
	 * Define custom actions here
	 */
}
