<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

elgg_load_library('elgg:edujobs');

$user = elgg_get_logged_in_user_entity();

$uguid = get_input('uguid');
$guid = get_input('guid');

// check if user can upload CV
if (check_if_user_is_teacher($user) && $user->guid==$uguid) { 

    $title = elgg_echo('edujobs:cv:addeducation');
    
    elgg_push_breadcrumb(elgg_echo('edujobs'), 'edujobs/jobs'); 
    elgg_push_breadcrumb(elgg_echo('edujobs:label:mycv'), 'edujobs/teachers/mycv'); 
    elgg_push_breadcrumb(elgg_echo('edujobs:cv:add4:simple'), 'edujobs/teachers/addcv4/'.$user->guid); 
    elgg_push_breadcrumb($title);

	if ($guid)	{

		$cv = get_entity($guid);
		$vars = cv_education_prepare_form_vars($cv);	
	}
	else {
		$vars = cv_education_prepare_form_vars();	
	}
	
    // create form
    $form_vars = array('name' => 'educvedupost', 'enctype' => 'multipart/form-data');
    $content = elgg_view_form('edujobs/cvs/addeducation', $form_vars, $vars);

    $body = elgg_view_layout('content', array(
        'content' => $content,
        'title' => $title,
        'sidebar' => elgg_view('edujobs/cv_sidebar', array('user_guid' => $uguid, 'selected' => 'cv4')),
        'filter' => '',
    ));

    echo elgg_view_page($title, $body);
} 
else    {  
    register_error(elgg_echo('edujobs:cv:noaccessforpost'));  
    forward(REFERER);    
}





