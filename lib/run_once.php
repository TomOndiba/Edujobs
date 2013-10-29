<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

function edujobs_run_once_subtypes()	{
    add_subtype('object', Edujobs::SUBTYPE, "edujobs");
    add_subtype('object', Jobappication::SUBTYPE, "jobappication");
    add_subtype('object', Educv::SUBTYPE, "educv");
}
