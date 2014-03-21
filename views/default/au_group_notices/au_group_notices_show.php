<?php

/* view to show notice in groups

@uses au_group_notices_location[], au_group_notice[context,notice]

this simply outputs a notice in a group if one exists

*/


$group= elgg_get_page_owner_entity();
$bg = $group->au_group_notice_bg;
if (!$bg){
	$bg='background-color:white;';
}else{
	$bg="background-color:$bg;";
}
$container=get_input('container_guid');
$border= $group->au_group_notice_border;
if ($border=='1'){
	$border='border: 1px solid black;';
}else{
	$border='border:none;';
}
$corners=$group->au_group_notice_corners;
if ($corners=='1'){
	$corners='border-radius: 10px;';
}else{
	$corners='border-radius: 0px;';
}


//are we in a group?
if (!empty($group) && elgg_instanceof($group, "group")){
	//first set this to the default notice
	$notice=$group->au_group_notice;
	//replace with different notice if in blog context and notice is set
	if ($group->au_group_blog_notice && elgg_in_context('blog')){
		$notice=$group->au_group_blog_notice;
	}
	//replace with different notice for discussions if notice set
	if ($group->au_group_discussion_notice && elgg_in_context('discussion')){
		$notice=$group->au_group_discussion_notice;
	}
	//likewise bookmarks
	if ($group->au_group_bookmarks_notice && elgg_in_context('bookmarks')){
		$notice=$group->au_group_bookmarks_notice;
	}	
	//likewise pages
	if ($group->au_group_pages_notice && elgg_in_context('pages')){
		$notice=$group->au_group_pages_notice;
	}	
	//likewise files
	if ($group->au_group_file_notice && elgg_in_context('file')){
		$notice=$group->au_group_file_notice;
	}	
	if ($notice){
		// there is a notice to display so do so
		?>
		
		<div class="au-group-notice" style="<?php echo $bg .$border.$corners?>">
		
		<?php
		echo elgg_view ('output/longtext', array('value'=>$notice));
		?>
		
		
		</div>
		<?php
	}
}
