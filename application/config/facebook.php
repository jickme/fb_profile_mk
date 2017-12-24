<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	//facebook api information goes here
	$config['api_id']       = '173428909918579';
	$config['api_secret']   = '1decb12010f70688e4fc1d246f5fb3ff';
	$config['redirect_url'] = base_url();  //change this if you are not using my fb controller
	$config['logout_url']   = base_url('Login/');          //User will be redirected here when he logs out.
	$config['permissions']  = array(
                                        'email', 
                                        'public_profile'
                                      );