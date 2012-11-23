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

$string['pluginname'] = 'Compare icons';
$string['ignorefiles'] = 'Files to ignore';
$string['ignorefilesdesc'] = 'These files will not be displayed at all';
$string['deprecatedfiles'] = 'Deprecated files';
$string['deprecatedfilesdesc'] = 'These files will be marked as "deprecated" in the files list';
$string['unusedfiles'] = 'Unused files';
$string['unusedfilesdesc'] = 'These files will be marked as "unused" in the files list or can be hidden by parameter';
$string['newfiles'] = 'New files';
$string['newfilesdesc'] = 'These files will be marked as "new" in the files list, you can specify the old file location after ":"';
$string['pagetitle'] = 'Moodle 2.4 Icons';

$string['unusedlabel'] = 'Unused';
$string['deprecatedlabel'] = 'Deprecated';
$string['newlabel'] = 'New';
$string['unusedlabeldesc'] = 'Search for the icon using \'git grep t/blah\' and not found (or not used in the code).';
$string['deprecatedlabeldesc'] = 'Marked as deprecated in theme/upgrade.txt.';
$string['newlabeldesc'] = 'New icons. Mouse over to see the icon previously used. The reason mostly being a more understandable name, or a resize.';
