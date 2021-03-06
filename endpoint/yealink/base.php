<?PHP

/**
 * Yealink Base File
 *
 * @author Andrew Nagy
 * @license MPL / GPLv2 / LGPL
 * @package Provisioner
 */
abstract class endpoint_yealink_base extends endpoint_base {

    public $brand_name = 'yealink';
    protected $use_system_dst = FALSE;

    function reboot() {
        if (($this->engine == "asterisk") AND ($this->system == "unix")) {
            exec($this->engine_location . " -rx 'sip notify polycom-check-cfg " . $this->settings['line'][0]['username'] . "'");
        }
    }

    function prepare_for_generateconfig() {
        parent::prepare_for_generateconfig();
        preg_match('/.*(-|\+)(\d*):(\d*)/i', $this->timezone['timezone'], $matches);
        switch ($matches[3]) {
            case '30':
                $point = '.5';
                break;
            default:
                $point = '';
                break;
        }
        $this->timezone['timezone'] = $matches[1] . $matches[2] . $point;
    }

}
