<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

// check if user is loggedin
if (!elgg_is_logged_in()) forward();

$guid = get_input('guid');
$job = get_entity($guid);

if ((elgg_instanceof($job, 'object', 'edujobs')) && $job->canEdit()) {
    $container = $job->getContainerEntity();

    if ($job->delete()) {
        system_message(elgg_echo("edujobs:delete:job:success"));
        if (elgg_instanceof($container, 'group')) {
                forward("edujobs/group/$container->guid/all");
        } else {
                forward("edujobs/owner/$container->username");
        }
    }
}
else if ((elgg_instanceof($job, 'object', 'educv')) && $job->canEdit()) {
    $container = $job->getContainerEntity();

    if ($job->delete()) {
        system_message(elgg_echo("edujobs:delete:cv:success"));
        if (elgg_instanceof($container, 'group')) {
                forward("edujobs/teachers/view");
        } else {
                forward("edujobs/teachers/view");
        }
    }
}

register_error(elgg_echo("edujobs:delete:job:failed"));
forward(REFERER);
