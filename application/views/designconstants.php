<?php

/**
 * @category		Constants
 * @author			Manoj kumar
 * @version			Release: 1.0
 * @section DESCRIPTION
 *	
 * The Constant file Contains all the paths and dynamic setting for design of the page		
 */
 

/*
 *  Defined the Base link for assets.
 */
$this->load->helper('url');
 define('SITE_URL', base_url() );
 define('IMG_FOLDER', base_url() . 'assets/images/');
 define('CSS_FOLDER', base_url(). 'assets/css/');
 define('JS_FOLDER', base_url(). 'assets/js/');

 

/** Header Text */
define('SITE_HEADER_TITLE', 'Sample Application Import / Export');


?>