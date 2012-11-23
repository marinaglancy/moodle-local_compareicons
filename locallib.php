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

/**
 * 
 */
class local_compareicons_iconslist implements renderable {
    protected $path;
    protected $options;
    protected $pluginname;
    protected static $extensions = array('svg', 'png', 'gif');

    /**
     *
     * @param type $path
     * @param type $options
     * @param plugininfo_base $plugin
     */
    public function __construct($path, $options = array(), $pluginname = null) {
        $this->path = $path;
        $this->options = $options;
        $this->pluginname = $pluginname;
    }

    /**
     * 
     */
    public static function get_extensions() {
        return self::$extensions;
    }

    /**
     * 
     */
    public function get_pluginname() {
        return $this->pluginname;
    }

    /**
     * 
     */
    public function get_path() {
        return $this->path;
    }

    /**
     * 
     */
    protected static function get_new_files() {
        $lines = preg_split('/\s*\n\s*/', get_config('local_compareicons', 'new'), -1, PREG_SPLIT_NO_EMPTY);
        $new = array();
        foreach ($lines as $line) {
            $chunks = preg_split('/:/', $line. ':');
            $new[$chunks[0]] = $chunks[1];
        }
        return $new;
    }

    /**
     * Checks if file must be marked as "new"
     *
     * @param string $filename
     * @return bool
     */
    public static function is_new($filename) {
        return array_key_exists($filename, self::get_new_files());
    }

    /**
     * If file is new, return the old name used for this file
     * 
     * @param string $filename
     * @return string
     */
    public static function get_file_oldname($filename) {
        $newfiles = self::get_new_files();
        if (array_key_exists($filename, $newfiles)) {
            return $newfiles[$filename];
        }
        return '';
    }

    /**
     * 
     * @param string $filename
     * @return bool
     */
    public static function is_deprecated($filename) {
        $deprecated = preg_split('/\s*\n\s*/', get_config('local_compareicons', 'deprecated'), -1, PREG_SPLIT_NO_EMPTY);
        return in_array($filename, $deprecated);
    }

    /**
     * 
     * @param string $filename
     * @return bool
     */
    public static function is_unused($filename) {
        $unused = preg_split('/\s*\n\s*/', get_config('local_compareicons', 'unused'), -1, PREG_SPLIT_NO_EMPTY);
        return in_array($filename, $unused);
    }

    /**
     * Returns the value of an option (or null if option was not set)
     *
     * @param string $name
     * @return mixed
     */
    public function get_option($name) {
        if (isset($this->options[$name])) {
            return $this->options[$name];
        }
        return null;
    }

    /**
     * 
     * @param string $filename
     * @return bool
     */
    public static function is_ignored($filename) {
        $ignored = preg_split('/\s*\n\s*/', get_config('local_compareicons', 'ignore'), -1, PREG_SPLIT_NO_EMPTY);
        return in_array($filename, $ignored);
    }

    /**
     * Returns the list of all images in this directory
     *
     * @return array
     */
    public function get_images() {
        global $CFG;
        $images = array();
        if (!is_dir($CFG->dirroot.$this->path)) {
            return $images;
        }
        if ($handle = opendir($CFG->dirroot.$this->path)) {
            while (false !== ($entry = readdir($handle))) {
                $extension = strtolower(pathinfo($entry, PATHINFO_EXTENSION));
                if (in_array($extension, self::get_extensions())) {
                    $filename = pathinfo($entry, PATHINFO_FILENAME);
                    // Ignore.
                    if ($this->is_ignored($this->path.$filename)) {
                        continue;
                    }
                    $images[$this->path.$filename][$extension] = $this->path.$entry;
                }
            }
            closedir($handle);
        }
        ksort($images);
        return $images;
    }
}
