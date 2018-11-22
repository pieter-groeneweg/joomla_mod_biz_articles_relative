<?php
/**
 * mod_biz_articles_relative
 * a modification to mod_articles_popular
 */

defined('_JEXEC') or die;

// Include the popular functions only once
JLoader::register('ModBizArticlesRelativeHelper', __DIR__ . '/helper.php');

$list = ModBizArticlesRelativeHelper::getList($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

require JModuleHelper::getLayoutPath('mod_biz_articles_relative', $params->get('layout', 'default'));
