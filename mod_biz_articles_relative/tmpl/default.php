<?php
/**
 * mod_biz_articles_relative
 * a modification to mod_articles_popular
 * of course this part can be altered or alternatives can be made next to this one
 * this one shows linked title, intro image, introtext and a readmore button in it's most simple way.
 * enjoy creating other views
 
 */

defined('_JEXEC') or die;
?>
<div class="biz-relative<?php echo $moduleclass_sfx; ?>">
<?php foreach ($list as $item) : ?>
	<?php $images = json_decode($item->images); ?>
	<div class="biz-relative-item" itemscope itemtype="https://schema.org/Article">
		<a href="<?php echo $item->link; ?>" itemprop="url">
			<span itemprop="name">
				<h2><?php echo $item->title; ?></h2>
			</span>
		</a>
        <div class="biz-relative-image"><img src="<?php echo $images->image_intro; ?>"></div>
        <div class="biz-relative-introtext"><?php echo $item->introtext; ?></div>
        <p class="readmore">
        	<a class="btn readmore" href="<?php echo $item->link; ?>"><?php echo JText::_('COM_CONTENT_READ_MORE'); ?></a>
        </p>
	</div>
<?php endforeach; ?>
</div>
