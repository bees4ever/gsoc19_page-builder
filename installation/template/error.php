<?php
/**
 * @package	Joomla.Installation
 *
 * @copyright  Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license	GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

/** @var JDocumentError $this */

// Add Stylesheets
HTMLHelper::_('stylesheet', 'installation/template/css/template.css', ['version' => 'auto']);
HTMLHelper::_('stylesheet', 'installation/template/css/joomla-alert.min.css', ['version' => 'auto']);

// Add scripts
HTMLHelper::_('script', 'installation/template/js/template.js', ['version' => 'auto']);
HTMLHelper::_('webcomponent', 'vendor/joomla-custom-elements/joomla-alert.min.js', ['version' => 'auto', 'relative' => true]);

// Add script options
$this->addScriptOptions('system.installation', ['url' => Route::_('index.php')]);

// Set page title
$this->setTitle($this->error->getCode() . ' - ' . htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'));

$this->setMetaData('viewport', 'width=device-width, initial-scale=1');

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
	<head>
		<jdoc:include type="metas" />
		<jdoc:include type="styles" />
	</head>
	<body>
		<div class="j-install">
			<!-- Header -->
			<header class="j-header" role="banner">
				<div class="j-header-logo">
					<img src="<?php echo $this->baseurl; ?>/template/images/logo.svg" alt="" class="logo"/>
				</div>
				<div class="j-header-help">
					<a href="https://docs.joomla.org/Special:MyLanguage/J4.x:Installing_Joomla">
						<span class="fa fa-lightbulb" aria-hidden="true"></span>
						<span class="sr-only"><?php echo Text::_('INSTL_HELP_LINK'); ?></span>
					</a>
				</div>
			</header>
			<!-- Container -->
			<section class="j-container">
				<jdoc:include type="message" />
				<div id="javascript-warning">
					<noscript>
						<?php echo Text::_('INSTL_WARNJAVASCRIPT'); ?>
					</noscript>
				</div>
				<div class="container-installation flex">
					<div class="j-install-step active">
						<div class="j-install-step-header">
							<span class="fa fa-exclamation" aria-hidden="true"></span> <?php echo Text::_('INSTL_ERROR'); ?>
						</div>
						<div class="j-install-step-form">
							<div class="alert preinstall-alert">
								<div class="alert-icon">
									<span class="alert-icon fa fa-exclamation-triangle" aria-hidden="true"></span>
								</div>
								<div class="alert-text">
									<h2><?php echo Text::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></h2>
									<p class="form-text text-muted small"><span class="badge badge-default"><?php echo $this->error->getCode(); ?></span> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></p>
								</div>
							</div>
							<?php if ($this->debug) : ?>
								<div>
									<?php echo $this->renderBacktrace(); ?>
									<?php // Check if there are more Exceptions and render their data as well ?>
									<?php if ($this->error->getPrevious()) : ?>
										<?php $loop = true; ?>
										<?php // Reference $this->_error here and in the loop as setError() assigns errors to this property and we need this for the backtrace to work correctly ?>
										<?php // Make the first assignment to setError() outside the loop so the loop does not skip Exceptions ?>
										<?php $this->setError($this->_error->getPrevious()); ?>
										<?php while ($loop === true) : ?>
											<p><strong><?php echo Text::_('JERROR_LAYOUT_PREVIOUS_ERROR'); ?></strong></p>
											<p><?php echo htmlspecialchars($this->_error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></p>
											<?php echo $this->renderBacktrace(); ?>
											<?php $loop = $this->setError($this->_error->getPrevious()); ?>
										<?php endwhile; ?>
										<?php // Reset the main error object to the base error ?>
										<?php $this->setError($this->error); ?>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</section>
			<jdoc:include type="scripts" />
			<footer class="j-footer">
				<a href="https://www.joomla.org" target="_blank">Joomla!</a>
				is free software released under the
				<a href="https://www.gnu.org/licenses/old-licenses/gpl-2.0.html" target="_blank" rel="noopener noreferrer">GNU General Public License</a>
			</footer>
		</div>
	</body>
</html>
