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

defined('MOODLE_INTERNAL') || die;
require_once($CFG->dirroot . '/local/compareicons/locallib.php');

/**
 * 
 */
class local_compareicons_renderer extends plugin_renderer_base {
    
    /**
     *
     * @param string $label
     * @param array $attributes
     * @return string
     */
    protected function get_label_html($label, $attributes = array()) {
        $classes = array('unused' => 'warning', 'deprecated' => 'inverse', 'new' => 'success');
        return html_writer::tag('span', get_string($label.'label', 'local_compareicons'),
                array('class' => 'label label-'.$classes[$label]) + $attributes);
    }

    /**
     * 
     */
    public function display_legend() {
        echo html_writer::start_tag('div', array('class' => 'container'));
        foreach (array('unused' => 'warning', 'deprecated' => 'inverse', 'new' => 'success') as $label => $class) {
            echo html_writer::start_tag('p');
            echo $this->get_label_html($label);
            echo ' '. get_string($label.'labeldesc', 'local_compareicons');
            echo html_writer::end_tag('p');
        }
        echo html_writer::end_tag('div'); // .container
    }

    /**
     * 
     */
    public function display_activities_header() {
        echo '<h2>Modules</h2>';
        echo '<table class="table table-striped table-bordered table-hover table-condensed" style="width: 100%">';
        echo '<tr><th style="width: 40%">&nbsp;</th>';
        foreach (local_compareicons_iconslist::get_extensions() as $extension) {
            echo '<th style="width: 20%">'.$extension.'</th>';
        }
        echo '</tr>';
    }

    /**
     * 
     */
    public function display_activities_footer() {
        echo '</table>';
    }

    /**
     *
     * @param local_compareicons_iconslist $iconslist
     */
    protected function render_local_compareicons_iconslist(local_compareicons_iconslist $iconslist) {
        global $CFG;

        if ($iconslist->get_pluginname() === null) {
            echo '<h2>'.$iconslist->get_path().'</h2>';
            echo '<table class="table table-striped table-bordered table-hover table-condensed" style="width: 100%">';
        }
        $images = $iconslist->get_images();
        if ($iconslist->get_pluginname() === null) {
            echo '<tr><th style="width: 40%">&nbsp;</th>';
            foreach ($iconslist->get_extensions() as $extension) {
                echo '<th style="width: 20%">'.$extension.'</th>';
            }
            echo '</tr>';
        }
        foreach ($images as $filename => $image) {
            $warning = '';
            if ($iconslist->is_unused($filename)) {
                // Unused.
                if ($iconslist->get_option('hideunused')) {
                    continue;
                }
                $warning = $this->get_label_html('unused');;
            } else if ($iconslist->is_deprecated($filename)) {
                // Deprecated.
                $warning = $this->get_label_html('deprecated');;
            } else if ($iconslist->is_new($filename)) {
                // New.
                $warning = $this->get_label_html('new', array('title' => $iconslist->get_file_oldname($filename)));
            }
            echo '<tr><th align="left">'.$iconslist->get_pluginname(). ' ' .basename($filename). ' ' . $warning . '</th>';
            foreach ($iconslist->get_extensions() as $extension) {
                echo '<td>';
                if (isset($image[$extension])) {
                    echo html_writer::empty_tag('img', array('src' => $CFG->wwwroot. $image[$extension]));
                } else {
                    echo '&nbsp;';
                }
                echo '</td>';
            }
            echo '</tr>';
        }
        if ($iconslist->get_pluginname() === null) {
           echo '</table>';
        }
    }
}