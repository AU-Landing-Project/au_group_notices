<?php
/**
 * AU group notices
 * allows group owners to add persistent notices to a group
 */


elgg_register_event_handler('init', 'system', 'au_group_notices_init');

function au_group_notices_init() {
	
	if (elgg_is_active_plugin('groups')){
		//add option to save form
		$base_dir = elgg_get_plugins_path() . 'au_group_notices/actions/au_group_notices';
		elgg_register_action('au_group_notices/save', "$base_dir/save.php");
	
		// Extend the main CSS file
		elgg_extend_view('css/elgg', 'au_group_notices/css');
	
		// add settings for tools
		elgg_extend_view('groups/edit','au_group_notices/au_group_notices_settings');
	
	
		// to fix - elgg_register_plugin_hook_handler('page_owner','system','au_group_notices_page_owner',100);
		
		elgg_register_event_handler('pagesetup','system','au_position_notice');
	}
}

function au_position_notice(){
	
	$group=elgg_get_page_owner_entity();	
	if (elgg_instanceof($group,'group')){
		$position=$group->au_group_notice_position;
		switch($position){
			case 'top':
				elgg_extend_view('page/elements/body','au_group_notices/au_group_notices_show',499);
			break;
			case 'bottom':
				elgg_extend_view('page/elements/body','au_group_notices/au_group_notices_show',501);
			break;
			case 'sidebottom':
				elgg_extend_view('page/elements/sidebar','au_group_notices/au_group_notices_show',600);
			break;
			case 'sidetop':
				elgg_extend_view('group/default','au_group_notices/au_group_notices_show',100);
			break;
			default:
				// do nothing - if position not set, no settings provided
				// elgg_extend_view('page/elements/body','au_group_notices/au_group_notices_show',100);
			
			break;
		}
	}

}

