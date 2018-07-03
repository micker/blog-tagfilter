<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_tags
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.core');
JHtml::_('formbehavior.chosen', 'select');

// Get the user object.
$user = JFactory::getUser();

// Check if user is allowed to add/edit based on tags permissions.
// Do we really have to make it so people can see unpublished tags???
$canEdit = $user->authorise('core.edit', 'com_tags');
$canCreate = $user->authorise('core.create', 'com_tags');
$canEditState = $user->authorise('core.edit.state', 'com_tags');
$n = count($this->items);
$bootstrapclass = 'col-md-' . $this->params->get('bootstrapcols', '6');

JFactory::getDocument()->addScriptDeclaration("
		var resetFilter = function() {
		document.getElementById('filter-search').value = '';
	}
");
?>


<div class="element-item col-12 <?php echo $bootstrapclass; ?>
     <?php foreach ($this->item->tags->itemTags as $tag) {
	echo $tag->alias . ' ';
} ?>">


	<div class="inner">
		<?php $tags = $this->item->tags->itemTags; ?>
		<?php echo JLayoutHelper::render('joomla.content.blog_style_default_item_title', $this->item); ?>

		<?php // Content is generated by content plugin event "onContentAfterTitle" ?>
		<?php echo $this->item->event->afterDisplayTitle; ?>

		<div class="row">

			<div class="col-6">
				<?php
				$images = json_decode($this->item->images);
				echo JLayoutHelper::render('joomla.content.intro_image', $this->item); ?>

			</div>
			<?php // Content is generated by content plugin event "onContentBeforeDisplay" ?>
			<?php echo $this->item->event->beforeDisplayContent; ?>
			<div class="col-6">
				<?php echo $this->item->introtext; ?>
			</div>
			<?php // Content is generated by content plugin event "onContentAfterDisplay" ?>
			<?php echo $this->item->event->afterDisplayContent; ?>
			<div class="col-12">
				<ul class="tags">

					<?php

					foreach ($this->item->tags->itemTags as $tag) { ?>
						<li itemprop="keywords">

							<?php echo $tag->title; ?>

						</li>
						<?php
					}

					?>

				</ul>
			</div>
		</div>
	</div>
</div>
