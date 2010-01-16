<?php if ( ! defined('EXT')) exit('Invalid file request');

/**
 * Create some new segment based variables 
 *
 * @package			ExpressionEngine
 * @subpackage		Last_segment Extension
 * @category		Extension
 * @author			Tom Kiss
 * @link			http://www.tomkiss.net/ee
 */
class Last_segment {
	
	var $settings = array();
	var $name = 'Last_segment';
	var $version = '1.0.2';
	var $description = 'Creates a global variable for the last segment in a URL.';
	var $settings_exist = 'n';
	var $docs_url = 'http://www.tomkiss.net/ee';
	
	/**
	 * Constructor
	 *
	 */
	function Last_segment($settings='')
	{
		$this->settings = $settings;
	}
	
	function set_last_segment($SESS)
	{
		
	    global $IN, $FNS;
    	
		$IN->global_vars['last_segment'] = end($IN->SEGS);
		$IN->global_vars['current_url'] = $FNS->fetch_current_uri();
		
		// Ignore Pagination
		$start = substr(end($IN->SEGS), 0, 1);
		$end = substr(end($IN->SEGS), 1, strlen(end($IN->SEGS)));
		if ($start == "P" && (preg_match( '/^\d*$/', $end) == 1))
		{
			$index = sizeof($IN->SEGS)-1;
			$ls_np = $IN->SEGS[$index];
		} 
		else 
		{
			$ls_np = end($IN->SEGS);
		}
		$IN->global_vars['last_segment_np'] = $ls_np;
		
	}
	
	
	// --------------------------------------------------------------------
	
	/**
	 * Activate Extension
	 *
	 * Installs the extension
	 *
	 * @access	public
	 * @return	void
	 */
	function activate_extension($from_module = FALSE)
	{
		global $DB, $LANG, $OUT;
		
		$DB->query($DB->insert_string('exp_extensions',
				array(
				'extension_id'	=> '',
				'class'			=> "Last_segment",
				'method'		=> "set_last_segment",
				'hook'			=> "sessions_start",
				'settings'		=> "a:0:{}",
				'priority'		=> 10,
				'version'		=> $this->version,
				'enabled'		=> "y"
				)
			)
		);
	}

	// --------------------------------------------------------------------
	
	/**
	 * Update Extension
	 *
	 * Updates the extension
	 *
	 * @access	public
	 * @param	type
	 * @return	type
	 */
	function update_extension($current = '')
	{
		global $DB;
		
		if ($current == '' OR $current == $this->version)
		{
			return FALSE;
		}

		$DB->query("UPDATE exp_extensions 
					SET version = '".$DB->escape_str($this->version)."' 
					WHERE class = 'Last_segment'");
	}

	// --------------------------------------------------------------------
	
	/**
	 * Disable Extension
	 *
	 * Uninstalls the extension
	 *
	 * @access	public
	 * @return	void
	 */
	function disable_extension($from_module = FALSE)
	{
		global $DB, $LANG, $OUT;
		
		$DB->query("DELETE FROM exp_extensions WHERE class = 'Last_segment'");
	}

	// --------------------------------------------------------------------
	

}
// END Fresh Variables Class
?>