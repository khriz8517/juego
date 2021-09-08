<?php 

require_once('../../config.php');
require_once('lib.php');

$id = required_param('id', PARAM_INT);    // Course Module ID

if (!$cm = get_coursemodule_from_id('daktico', $id)) {
    print_error('Course Module ID was incorrect'); // NOTE this is invalid use of print_error, must be a lang string id
}
if (!$course = $DB->get_record('course', array('id'=> $cm->course))) {
    print_error('course is misconfigured');  // NOTE As above
}
if (!$daktico = $DB->get_record('daktico', array('id'=> $cm->instance))) {
    print_error('course module is incorrect'); // NOTE As above
}

global $DB, $USER, $CFG;

require_login();

$context = context_system::instance();
$PAGE->set_url(new moodle_url('/mod/daktico/index.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Daktico');
$PAGE->set_heading('Daktico');

$iframe_link = $DB->get_field('daktico', 'imagen', ['moduleid'=>$id]);

$templateContext = (object)[
    'sesskey' => sesskey(),
    'cursoid' => $cm->course,
    'iframe_link' => $iframe_link,
    'coursemoduleid' => $id,
    'userid' => $USER->id,
    'url' => $CFG->wwwroot
];


echo $OUTPUT->header();
echo $OUTPUT->render_from_template('mod_daktico/index', $templateContext);
echo $OUTPUT->footer();