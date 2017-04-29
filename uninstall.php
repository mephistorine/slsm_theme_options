<?php
if (!defined('WP_UNINSTALL_PLUGIN')) exit;

class SLSMApiUninstall
{
	/**
	 * SLSMApiUninstall constructor.
	 */
	public function __construct()
	{
		delete_option('slsm_theme_options');
	}
}