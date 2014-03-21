<?php
/**
 * au_group_tag_menu
 * get settings for the tag menu
 * need the tags themselves
 * to limit results to a specific user's posts
*/

	//get current settings
	$group = elgg_get_page_owner_entity();

	if(!empty($group) && elgg_instanceof($group, "group")){
		// build form 
		//default notice
		$notice=$group->au_group_notice;
		$form_body="<br /><div>".elgg_echo('au_group_notices:help')."</div>";
		$form_body.="<div class='au-group-notice-blurb'>";
		$form_body.="<p class='elgg-module-popup'><strong>".elgg_echo('au_group_notices:noticeblurb')."</strong></p>";
		$form_body.="<div class='au-group-notice-blurb-inner'>";		
		$form_body.= elgg_view('input/longtext', array(
			'name' => 'au_group_notice',
			'id' => 'au_group_notice',
			'value' => $notice,
		));
		$form_body.="</div>";
		$form_body.="</div>";
		//blog notice
		if (elgg_is_active_plugin('blog')){
			$blognotice=$group->au_group_blog_notice;
			$form_body.="<div class='au-group-notice-blurb'>";
			$form_body.="<p class='elgg-module-popup'>".elgg_echo('au_group_notices:blognoticeblurb')."</p>";
			$form_body.="<div class='au-group-notice-blurb-inner'>";		
			$form_body.= elgg_view('input/longtext', array(
				'name' => 'au_group_blog_notice',
				'id' => 'au_group_blog_notice',
				'value' => $blognotice,
			));
			$form_body.="</div>";
			$form_body.="</div>";
		}
		// discussion notice
		$discussionnotice=$group->au_group_discussion_notice;
		$form_body.="<div class='au-group-notice-blurb'>";
		$form_body.="<p class='elgg-module-popup'>".elgg_echo('au_group_notices:discussionnoticeblurb')."</p>";
		$form_body.="<div class='au-group-notice-blurb-inner'>";		
		$form_body.= elgg_view('input/longtext', array(
			'name' => 'au_group_discussion_notice',
			'id' => 'au_group_discussion_notice',
			'value' => $discussionnotice,
		));
		$form_body.="</div>";
		$form_body.="</div>";

		// bookmarks notice
		if (elgg_is_active_plugin('bookmarks')){
			$bookmarksnotice=$group->au_group_bookmarks_notice;
			$form_body.="<div class='au-group-notice-blurb'>";
			$form_body.="<p class='elgg-module-popup'>".elgg_echo('au_group_notices:bookmarksnoticeblurb')."</p>";
			$form_body.="<div class='au-group-notice-blurb-inner'>";		
			$form_body.= elgg_view('input/longtext', array(
				'name' => 'au_group_bookmarks_notice',
				'id' => 'au_group_bookmarks_notice',
				'value' => $bookmarksnotice,
			));
			$form_body.="</div>";
			$form_body.="</div>";
		}
		// pages notice
		if (elgg_is_active_plugin('pages')){
			$pagesnotice=$group->au_group_pages_notice;
			$form_body.="<div class='au-group-notice-blurb'>";
			$form_body.="<p class='elgg-module-popup'>".elgg_echo('au_group_notices:pagesnoticeblurb')."</p>";
			$form_body.="<div class='au-group-notice-blurb-inner'>";		
			$form_body.= elgg_view('input/longtext', array(
				'name' => 'au_group_pages_notice',
				'id' => 'au_group_pages_notice',
				'value' => $pagesnotice,
			));
			$form_body.="</div>";
			$form_body.="</div>";
	
	
		}
		// files notice
		if (elgg_is_active_plugin('file')){	
			$filenotice=$group->au_group_file_notice;
			$form_body.="<div class='au-group-notice-blurb'>";
			$form_body.="<p class='elgg-module-popup'>".elgg_echo('au_group_notices:filenoticeblurb')."</p>";
			$form_body.="<div class='au-group-notice-blurb-inner'>";		
			$form_body.= elgg_view('input/longtext', array(
				'name' => 'au_group_file_notice',
				'id' => 'au_group_file_notice',
				'value' => $filenotice,
			));
			$form_body.="</div>";
			$form_body.="</div>";
	
	
		}
		//select the location to show the notice

		$form_body.="<div>";	
		$form_body.="<label for='au_group_notice_position'>".elgg_echo('au_group_notices:position').": </label> ";
		$position= $group->au_group_notice_position;
		$options=array('top'=>elgg_echo('au_group_notices:top'),
						'bottom'=>elgg_echo('au_group_notices:bottom'),
						'sidetop'=>elgg_echo('au_group_notices:sidetop'), 
						'sidebottom'=>elgg_echo('au_group_notices:sidebottom'),
					);		
		$form_body.=elgg_view("input/dropdown", array ("name"=>"au_group_notice_position",
														"id"=>"au_group_notice_position",
														"options_values"=>$options,
														"value" => $position,
														));		
		$form_body.="</div>";
		
		$form_body.="<div>";
		
		//choose background colour
		$form_body.="<label for='au_group_notice_bg'>".elgg_echo('au_group_notices:bg').": </label> ";
		$bg= $group->au_group_notice_bg;
		$options=array('white'=>elgg_echo('au_group_notices:white'),
						'black'=>elgg_echo('au_group_notices:black'),
						'silver' => elgg_echo('au_group_notices:silver'),
						'red'=>elgg_echo('au_group_notices:red'),
						'green'=>elgg_echo('au_group_notices:green'), 
						'yellow'=>elgg_echo('au_group_notices:yellow'),
						'blue'=>elgg_echo('au_group_notices:blue'),
						'transparent'=>elgg_echo('au_group_notices:transparent'),
					);		
		$form_body.=elgg_view("input/dropdown", array ("name"=>"au_group_notice_bg",
														"id"=>"au_group_notice_bg",
														"options_values"=>$options,
														"value" => $bg,
														));		

		$form_body.="</div>";
		$form_body.="<div>";
		
		//choose border, yes or no
		$form_body.="<label for='au_group_notice_border'>".elgg_echo('au_group_notices:border').": </label> ";
		$border= $group->au_group_notice_border;
		$options=array('1'=>elgg_echo('option:yes'),
						'0'=>elgg_echo('option:no')					);		
		$form_body.=elgg_view("input/dropdown", array ("name"=>"au_group_notice_border",
														"id"=>"au_group_notice_border",
														"options_values"=>$options,
														"value" => $border,
														));		
		$form_body.="</div>";

		//choose rounded corners, yes or no
		$form_body.="<div>";
		$form_body.="<label for='au_group_notice_corners'>".elgg_echo('au_group_notices:corners').": </label> ";
		$corners= $group->au_group_notice_corners;
		$options=array('1'=>elgg_echo('option:yes'),
						'0'=>elgg_echo('option:no')					);		
		$form_body.=elgg_view("input/dropdown", array ("name"=>"au_group_notice_corners",
														"id"=>"au_group_notice_corners",
														"options_values"=>$options,
														"value" => $corners,
														));		
		$form_body.="</div>";
				
		
		$form_body .= "<div class='elgg-foot'>";
		$form_body .= elgg_view("input/hidden", array("name" => "guid", "value" => $group->getGUID()));
		$form_body .= elgg_view("input/submit", array("value" => elgg_echo("save")));
		$form_body .= "</div>";
		$title = elgg_echo("au_group_notices:settings");
		$body = elgg_view("input/form", array("action" => "{$CONFIG->URL}action/au_group_notices/save", "body" => $form_body));
		
		echo elgg_view_module("info", $title, $body);

	}