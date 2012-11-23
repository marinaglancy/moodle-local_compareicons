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
 * @copyright  2012 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) { // needs this condition or there is error on login page
    $url = new moodle_url('/local/compareicons/index.php');
    $ADMIN->add('development', new admin_externalpage('local_compareicons',
                                                  get_string('pluginname', 'local_compareicons'),
                                                  $url->out()));

    $temp = new admin_settingpage('local_compareicons_settings', new lang_string('pluginname', 'local_compareicons'));

    $local_compareicons_ignore = array(
        '/pix/adv',
        '/pix/madewithmoodle',
        '/pix/moodlelogo',
        '/pix/moodlelogo-med',
        '/pix/moodlelogo-med-white',
        '/pix/movehere',
        '/pix/req',
        '/pix/spacer',

        '/pix/i/colourpicker',
        '/pix/i/loading',
        '/pix/i/progressbar',
        '/pix/i/rsssitelogo',
        '/pix/i/star-rating',
        '/pix/i/test'
    );
    $temp->add(new admin_setting_configtextarea('local_compareicons/ignore',
            new lang_string('ignorefiles', 'local_compareicons'),
            new lang_string('ignorefilesdesc', 'local_compareicons'), 
            join("\n", $local_compareicons_ignore)));
    unset($local_compareicons_ignore);

    $local_compareicons_deprecated = array(
        '/pix/i/roles',
        '/pix/t/manual_item',
        '/pix/t/unlock_gray',
        '/pix/t/userblue'
    );
    $temp->add(new admin_setting_configtextarea('local_compareicons/deprecated',
            new lang_string('deprecatedfiles', 'local_compareicons'),
            new lang_string('deprecatedfilesdesc', 'local_compareicons'), 
            join("\n", $local_compareicons_deprecated)));
    unset($local_compareicons_deprecated);

    $local_compareicons_unused = array(
        '/pix/webding',

        '/pix/i/admin',
        '/pix/i/calendar',
        '/pix/i/closed',
        '/pix/i/db',
        '/pix/i/email',
        '/pix/i/feedback',
        '/pix/i/feedback_add',
        '/pix/i/grademark',
        '/pix/i/grademark-grey',
        '/pix/i/guest',
        '/pix/i/key',
        '/pix/i/lock',
        '/pix/i/log',
        '/pix/i/mahara_host',
        '/pix/i/mean',
        '/pix/i/moodle_host',
        '/pix/i/ne_red_mark',
        '/pix/i/new',
        '/pix/i/news',
        '/pix/i/open',
        '/pix/i/payment',
        '/pix/i/portfolio',
        '/pix/i/questions',
        '/pix/i/search',
        '/pix/i/switch',
        '/pix/i/unlock',

        '/pix/t/adddir',
        '/pix/t/calendar',
        '/pix/t/download',
        '/pix/t/email',
        '/pix/t/feedback',
        '/pix/t/feedback_add',
        '/pix/t/hiddenuntil',
        '/pix/t/hideuntil',
        '/pix/t/log',
        '/pix/t/mean',
        '/pix/t/outcomes',
        '/pix/t/reload',
        '/pix/t/sigma',
        '/pix/t/sigmaplus',
        '/pix/t/switch',
        '/pix/t/user',
        '/pix/t/usernot',
    );
    $temp->add(new admin_setting_configtextarea('local_compareicons/unused',
            new lang_string('unusedfiles', 'local_compareicons'),
            new lang_string('unusedfilesdesc', 'local_compareicons'), 
            join("\n", $local_compareicons_unused)));
    unset($local_compareicons_unused);

    $local_compareicons_new = array(
        '/pix/i/assignroles:/pix/i/roles',
        '/pix/i/down:/pix/t/down',
        '/pix/i/up:/pix/t/up',
        '/pix/i/dragdrop:/pix/i/move_2d',
        '/pix/i/enrolusers:/pix/i/users',
        '/pix/i/export:/pix/i/backup',
        '/pix/i/import:/pix/i/restore',
        '/pix/i/manual_item:/pix/t/manual_item',
        '/pix/i/switchrole:/pix/i/roles',

        '/pix/t/assignroles:/pix/i/roles',
        '/pix/t/cohort:/pix/i/cohort',
        '/pix/t/enrolusers:/pix/i/users',
        '/pix/t/locked:/pix/t/unlock',
        '/pix/t/sort:/pix/t/move',
        '/pix/t/sort_asc:/pix/t/up',
        '/pix/t/sort_desc:/pix/t/down',
        '/pix/t/unlocked:/pix/t/lock',
    );
    $temp->add(new admin_setting_configtextarea('local_compareicons/new',
            new lang_string('newfiles', 'local_compareicons'),
            new lang_string('newfilesdesc', 'local_compareicons'), 
            join("\n", $local_compareicons_new)));
    unset($local_compareicons_new);
    $ADMIN->add('localplugins', $temp);
    
}
