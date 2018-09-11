<?php
/**
 * RenderJSON
 * 
 * @copyright Copyright 2018 Eric C. Weig 
 * @license http://opensource.org/licenses/MIT MIT
 */

/**
 * The RenderJSON plugin.
 * 
 * @package Omeka\Plugins\RenderJSON
 */
class RenderJSONPlugin extends Omeka_Plugin_AbstractPlugin
{
    // Define Hooks

    protected $_hooks = array(
        'install',
        'uninstall',
        'admin_head'
	);
	
    protected $_filters = array(
        'jsonField' => array('Display', 'Item', 'Tech', 'Interview Technical Overview'),
    );
    
    public function hookInstall()
    {
      
    }
    
    public function hookUninstall()
    {
     
    }
    
    /**
     * Configure admin theme header.
     *
     * @param array $args
     */
    public function hookAdminHead($args)
    {
            queue_css_file('renderjson');
            queue_js_file('renderjson');
    }

    public function jsonField($text, $args) {
        return $this->_jsonField($text, $args);
    }
    
    public function _jsonField($text, $args) {
        $text = str_replace('&quot;', '"', $text);
        json_decode($text);
        if (json_last_error() == JSON_ERROR_NONE) {
        return "<div id=\"json\"></div></script><script>document.getElementById(\"json\").appendChild(renderjson($text)
    );</script>";
        } else {
        return $text;
        }

    }
    
}

