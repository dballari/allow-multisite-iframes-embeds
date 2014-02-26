<?php
/*
 * Plugin Name: Allow Multisite iFrames and embeds
 * Plugin URI: http://ballarinconsulting.com
 * Description: Allows inserting embeds and iframes on a multisite wp install.
 * Version: 1.00
 * Author: dballari
 * Author URI: http://ballarinconsulting.com
 * License: GPL2
 */

/*  Copyright 2013  dballari  (email : desa@ballarinconsulting.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    If you want a copy of the GNU General Public License
    you may find it here http://www.gnu.org/licenses/gpl-2.0.html
*/

/**
 * This add_filter call allows inserting embeds and iframes on a multisite wp install
 * Permite insertar embeds e iframes en Multisitio
 */

add_filter('wp_kses_allowed_html', 'allow_iframe_tags', 1, 2 );

/**
 * The allow_iframe_tags function will be tied to the 'wp_kses_allowed_html' hook.
 * 
 * It allows iframes and embeds to be added from the content editor on a
 * multisite wp install.
 * 
 * It's not meant for blog networks as WordPress.com
 * Rather, it's meant for private multisite installations where all users
 * are trusted ones.
 * 
 * For example, use this plugin on a multisite installation of a multi language
 * corporate web page.
 * 
 * You can find the 'wp_kses_allowed_html' hook here: wp-includes/kses.php.
 * 
 * This pluggin has been develop as a response to a comment on this post:
 * http://ayudawordpress.com/iframe-y-embed-en-wordpress-multisitio/
 * So that people with no plugin development knowledge can use it on their site.
 *
 * The main snippet of code can be found here http://snipt.org/zhiah6
 * This plugin only takes this snippet and hooks a function to the rigth hook.
 *
 * Use this plugin as you wish. You can just take this function along with the
 * add_filter call and insert theme on your theme functions file.
 */

function allow_iframe_tags($allowedposttags, $context) {

	switch ( $context ) {

		case 'post' :

			//* This piece of code, esentially comes from here http://snipt.org/zhiah6
			//* allowfullscreen and frameborder have been added later

			$allowedposttags["iframe"] = array(
				"allowfullscreen" => array(),
				"frameborder" => array(),
				"height" => array(),
				"src" => array(),
				"width" => array(),
			);
			
			$allowedposttags["object"] = array(
				"height" => array(),
				"width" => array()
			);
			$allowedposttags["param"] = array(
				"name" => array(),
				"value" => array(),
			);
			$allowedposttags["embed"] = array(
				"src" => array(),
				"type" => array(),
				"allowfullscreen" => array(),
				"allowscriptaccess" => array(),
				"height" => array(),
				"width" => array(),
			);

			//* end of code from http://snipt.org/zhiah6

			return $allowedposttags;
			break;

		default:

			return $allowedposttags;

	}
}
