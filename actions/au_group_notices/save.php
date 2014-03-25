<?php

//save group notice and location

$guid= get_input("guid");
if ($entity= get_entity($guid)){
	
	if ($entity instanceof ElggGroup && $entity->canEdit()){
		$entity->au_group_notice=get_input('au_group_notice');
		
		$contexts = array('blog','discussion','bookmarks','pages','file');
		foreach ($contexts as $context){
			$noticepart="au_group_".$context."_notice";
			$entity->{$noticepart}=get_input("{$noticepart}");
		}

		$entity->au_group_notice_position = get_input('au_group_notice_position');
		$entity->au_group_notice_bg = get_input('au_group_notice_bg');
		$entity->au_group_notice_border = get_input('au_group_notice_border');
		$entity->au_group_notice_corners = get_input('au_group_notice_corners');
		if (!$entity->save()){
			register_error(elgg_echo("au_group_notices:saveerror"));
			forward(REFERER);
		}else{
			system_message(elgg_echo('au_group_notices:saved').$entity->au_group_notice_position);
		}
	}
} else {
	
	register_error(elgg_echo('au_group_notices:saveerror').$entity->au_group_notice_position);
}
forward(REFERER);