<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

//gatekeeper();
elgg_load_library('elgg:edujobs');

$owner = get_user_by_username(get_input('uname'));	// get cv user
$user = elgg_get_logged_in_user_entity();	// get logged-in user

elgg_push_breadcrumb(elgg_echo('edujobs'),'edujobs/jobs');

if ($user != null && $user->custom_profile_type == COLEGIO_PROFILE_TYPE_GUID)	{
	elgg_push_breadcrumb(elgg_echo('edujobs:teachers'),'edujobs/teachers/view');
}
elgg_push_breadcrumb(elgg_echo('edujobs:cv', array($owner->name)));

// build sidebar 
$sidebar = '';


$title = elgg_echo('edujobs:cv', array($owner->name));

if (check_if_user_has_cv($owner))	{
	$content = elgg_list_entities_from_metadata(array(
		'type' => 'object',
		'subtype' => 'educv',
		'limit' => 1,
		'full_view' => true,
		'count' => false,
		'pagination' => false,
		'owner_guid' => $owner->guid,
	));					
}

if (!$content) {
	$content = elgg_echo('edujobs:teachers:user:emptycv');
} 

$options = array(
	'filter_context' => 'all',
	'content' => $content,
	'title' => $title,
	'sidebar' => $sidebar,
	'filter_override' => elgg_view('edujobs/nav', array('selected' => $selected))
);

$body = elgg_view_layout('content', $options);

echo elgg_view_page($title, $body);










