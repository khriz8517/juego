<?php 

require_once('../../config.php');
require_once('lib.php');

$id = required_param('id', PARAM_INT);    // Course Module ID

if (!$cm = get_coursemodule_from_id('juego', $id)) {
    print_error('Course Module ID was incorrect'); // NOTE this is invalid use of print_error, must be a lang string id
}
if (!$course = $DB->get_record('course', array('id'=> $cm->course))) {
    print_error('course is misconfigured');  // NOTE As above
}
if (!$juego = $DB->get_record('juego', array('id'=> $cm->instance))) {
    print_error('course module is incorrect'); // NOTE As above
}

global $DB;

require_login();

$context = context_system::instance();
$PAGE->set_url(new moodle_url('/mod/juego/index.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Activities Qroma Plugin');
$PAGE->set_heading('Activities Qroma Plugin');

$iframe_link = $DB->get_field('aq_iframe_page', 'iframe_link', ['id'=>1]);

$templateContext = (object)[
    'sesskey' => sesskey(),
    'cursoid' => $cm->course,
    'iframe_link' => $iframe_link
];


echo $OUTPUT->header();
echo $OUTPUT->render_from_template('mod_juego/index', $templateContext);
echo $OUTPUT->footer();