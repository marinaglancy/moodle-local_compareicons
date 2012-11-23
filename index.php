<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * 
 *
 * @package    local_compareicons
 * @copyright  2012
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(__FILE__) . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->dirroot . '/local/compareicons/locallib.php');
require_once("$CFG->libdir/pluginlib.php");

$hideunused = optional_param('hideunused', 0, PARAM_INT);

admin_externalpage_setup('local_compareicons');

$PAGE->set_heading(get_string('pagetitle', 'local_compareicons'));
$PAGE->set_title($SITE->fullname . ': ' . get_string('pagetitle', 'local_compareicons'));
$PAGE->set_pagelayout('admin');

$renderer = $PAGE->get_renderer('local_compareicons');
echo $OUTPUT->header();

$renderer->display_legend();

$options = array('hideunused' => $hideunused);

$renderer->render(new local_compareicons_iconslist('/pix/', $options));
$renderer->render(new local_compareicons_iconslist('/pix/i/', $options));
$renderer->render(new local_compareicons_iconslist('/pix/t/', $options));

$renderer->display_activities_header();
$allplugins = plugin_manager::instance()->get_plugins();
$subplugins = plugin_manager::instance()->get_subplugins();

foreach ($allplugins['mod'] as $module) {
    $renderer->render(new local_compareicons_iconslist($module->get_dir().'/pix/', $options, $module->name));
    if (isset($subplugins[$module->component])) {
        foreach ($subplugins[$module->component] as $type => $unused) {
            foreach ($allplugins[$type] as $subplugin) {
                $renderer->render(new local_compareicons_iconslist($subplugin->get_dir().'/pix/',
                        $options, $module->name.'/'.$subplugin->name));
            }
        }
    }
}
$renderer->display_activities_footer();

echo $OUTPUT->footer();
