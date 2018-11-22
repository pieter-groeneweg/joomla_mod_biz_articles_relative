<?php
/**
 * mod_biz_articles_relative
 * a modification to mod_articles_popular
 */

defined('_JEXEC') or die;

JLoader::register('ContentHelperRoute', JPATH_SITE . '/components/com_content/helpers/route.php');

JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_content/models', 'ContentModel');

abstract class ModBizArticlesRelativeHelper
{
	public static function getList(&$params)
	{
		$model = JModelLegacy::getInstance('Articles', 'ContentModel', array('ignore_request' => true));

		$app = JFactory::getApplication();
		$appParams = $app->getParams();
		$model->setState('params', $appParams);

		$model->setState('list.start', 0);
		$model->setState('list.limit', (int) $params->get('count', 5));
		$model->setState('filter.published', 1);
		$model->setState('filter.featured', $params->get('show_front', 1) == 1 ? 'show' : 'hide');
		$model->setState('load_tags', false);
		//acl
		$access = !JComponentHelper::getParams('com_content')->get('show_noauth');
		$authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
		$model->setState('filter.access', $access);
		//categories
		$model->setState('filter.category_id', $params->get('catid', array()));
		//range
		$model->setState('filter.date_filtering', 'range');
		$model->setState('filter.date_field', 'a.created');
		//get timezone offset to avoid matching to UTC only
		$timezone = new DateTimeZone(JFactory::getConfig()->get('offset'));
		//starting publish
		$daysBeforeCreation = new JDate('now +'.$params->get('start_date_range', '1').' day');
		$daysBeforeCreation->setTimezone($timezone);
		$model->setState('filter.start_date_range', $daysBeforeCreation);
		//stop after
		$daysToStayAlive = new JDate($daysBeforeCreation. '+'.$params->get('end_date_range', '2').' day');
		$model->setState('filter.end_date_range', $daysToStayAlive);
		//languag
		$model->setState('filter.language', $app->getLanguageFilter());
		//sort order
		$model->setState('list.ordering', 'a.created');
		$model->setState('list.direction', 'DESC');

				//build the list of items
		$items = $model->getItems();
		foreach ($items as &$item)
		{
			$item->slug = $item->id . ':' . $item->alias;
			$item->catslug = $item->catid . ':' . $item->category_alias;

			if ($access || in_array($item->access, $authorised))
			{
				$item->link = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language));
			}
			else
			{
				$item->link = JRoute::_('index.php?option=com_users&view=login');
			}
		}
		return $items;
	}
}
