<?php
if (!defined('WPINC')) die;

?>

<!-- URI List -->
<h3 class="litespeed-title"><?=__('URI List', 'litespeed-cache')?></h3>
<ol>
	<li><?=__('Enter a list of urls that should not be cached.', 'litespeed-cache')?></li>
	<li><?=__('The urls will be compared to the REQUEST_URI server variable.', 'litespeed-cache')?></li>
	<li><?=__('There should only be one url per line.', 'litespeed-cache')?></li>
</ol>
<div class="litespeed-callout litespeed-callout-warning">
	<h4><?=__('NOTE:', 'litespeed-cache')?></h4>
	<ol>
		<li><?=__('URLs must start with a \'/\' to be correctly matched.', 'litespeed-cache')?></li>
		<li><?=__('To do an exact match, add \'$\' to the end of the URL.', 'litespeed-cache')?></li>
		<li><?=__('Any surrounding whitespaces will be trimmed.', 'litespeed-cache')?></li>
		<li><?=sprintf(__('e.g. to exclude %1$s, insert %2$s', 'litespeed-cache'),
				'http://www.example.com/excludethis.php', '/excludethis.php')?></li>
		<li><?=sprintf(__('Similarly, to exclude %1$s(accessed with the /blog), insert %2$s', 'litespeed-cache'),
				'http://www.example.com/blog/excludethis.php', '/blog/excludethis.php')?></li>
	</ol>
</div>
<div class="litespeed-desc">
	<i>
		<?=__('SYNTAX: URLs must start with a \'/\' to be correctly matched.', 'litespeed-cache')?><br />
		<?=__('To do an exact match, add \'$\' to the end of the URL. One URL per line.', 'litespeed-cache')?>
	</i>
</div>
<?php $id = LiteSpeed_Cache_Config::OPID_EXCLUDES_URI; ?>
<textarea name="<?=LiteSpeed_Cache_Config::OPTION_NAME?>[<?=$id?>]" rows="10" cols="80"><?=esc_textarea($_options[$id])?></textarea>


<!-- Category List -->
<h3 class="litespeed-title"><?=__('Category List', 'litespeed-cache')?></h3>
<ol>
	<li><b><?=__('All categories are cached by default.', 'litespeed-cache')?></b></li>
	<li><?=__('To prevent a category from being cached, enter it in the text area below, one per line.', 'litespeed-cache')?></li>
</ol>
<div class="litespeed-callout litespeed-callout-warning">
	<h4><?=__('NOTE:', 'litespeed-cache')?></h4>
	<ol>
		<li><?=__('If the Category ID is not found, the name will be removed on save.', 'litespeed-cache')?></li>
		<li><?=sprintf(__('e.g. to exclude %1$s, insert %2$s', 'litespeed-cache'),
				'<code style="font-size: 11px;">http://www.example.com/category/category/category-id/</code>', 'category-id')?></li>
	</ol>
</div>
<div class="litespeed-desc">
	<i>
		<?=__('SYNTAX: One category id per line.', 'litespeed-cache')?>
	</i>
</div>
<?php $id = LiteSpeed_Cache_Config::OPID_EXCLUDES_CAT; ?>
<?php
	$excludes_buf = '';
	$cat_ids = $_options[$id];
	if ($cat_ids != '') {
		$id_list = explode(',', $cat_ids);
		$excludes_buf = implode("\n", array_map('get_cat_name', $id_list));
	}
?>
<textarea name="<?=LiteSpeed_Cache_Config::OPTION_NAME?>[<?=$id?>]" rows="5" cols="80"><?=esc_textarea($excludes_buf)?></textarea>


<!-- Tag List -->
<h3 class="litespeed-title"><?=__('Tag List', 'litespeed-cache')?></h3>
<ol>
	<li><b><?=__('All tags are cached by default.', 'litespeed-cache')?></b></li>
	<li><?=__('To prevent tags from being cached, enter the tag in the text area below, one per line.', 'litespeed-cache')?></li>
</ol>
<div class="litespeed-callout litespeed-callout-warning">
	<h4><?=__('NOTE:', 'litespeed-cache')?></h4>
	<ol>
		<li><?=__('If the Tag ID is not found, the name will be removed on save.', 'litespeed-cache')?></li>
		<li><?=sprintf(__('e.g. to exclude %1$s, insert %2$s', 'litespeed-cache'),
				'http://www.example.com/tag/category/tag-id/', 'tag-id')?></li>
	</ol>
</div>
<div class="litespeed-desc">
	<i>
		<?=__('SYNTAX: One tag id per line.', 'litespeed-cache')?>
	</i>
</div>
<?php $id = LiteSpeed_Cache_Config::OPID_EXCLUDES_TAG; ?>
<?php
	$excludes_buf = '';
	$ids = $_options[$id];
	if ($ids != '') {
		$id_list = explode(',', $ids);
		$tags_list = array_map('get_tag', $id_list);
		$tag_names = array();
		foreach ($tags_list as $tag) {
			$tag_names[] = $tag->name;
		}
		if (!empty($tag_names)) {
			$excludes_buf = implode("\n", $tag_names);
		}
	}
?>
<textarea name="<?=LiteSpeed_Cache_Config::OPTION_NAME?>[<?=$id?>]" rows="5" cols="80"><?=esc_textarea($excludes_buf)?></textarea>

<?php
if (is_multisite()) {
	return;
}
?>


<!-- Cookie List -->
<?php require LSWCP_DIR . 'admin/tpl/settings_inc.exclude_cookies.php'; ?>

<!-- User Agent List -->
<?php require LSWCP_DIR . 'admin/tpl/settings_inc.exclude_useragent.php'; ?>
