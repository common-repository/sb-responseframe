<?php
/*
Plugin Name: SB-ResponseFrame
Plugin URI: http://git.ladasoukup.cz/sb-responseframe
Description: This is simple shortcode to embed responsive (fixed-ratio) iframes
Version: 1.0.0
Author: Ladislav Soukup (ladislav.soukup@gmail.com)
Author URI: http://www.ladasoukup.cz/
Author Email: ladislav.soukup@gmail.com
License:

  Copyright 2013 Ladislav Soukup (ladislav.soukup@gmail.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as 
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
  
*/

class SB_ResponseFrame {
	private $plugin_path;
	public $cfg_version = '1.0';
	
	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/
	
	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {
		$this->plugin_path = plugin_dir_path( __FILE__ );
		
		add_shortcode( 'rframe', array( 'SB_ResponseFrame', 'SB_rframe_sh' ) );
		
	} // end constructor
	

	public function SB_rframe_sh ( $atts, $content ){
		global $SB_ResponseFrame;
		$out = '';
		extract( shortcode_atts( array(
					'ratio' => '4x3',
					'src' => 'about:blank',
					'width' => '100%'
		), $atts ) );
		
		$inline_img = $SB_ResponseFrame->SB_rframe_createInlineImage( $ratio );
		
		$out .= '<div style="width:'.$width.';height:100%;margin:0 auto;">';
		$out .= '	<div style="position:relative;">';
		$out .= '		<img src="'.$inline_img.'" style="display:block;width:100%;height:auto;" data-ratio="'.$ratio.'" />';
		$out .= '		<iframe src="'.$src.'" frameborder="0" allowfullscreen style="position:absolute;top:0;left:0;width:100%; height:100%;"></iframe>';
		$out .= '	</div>';
		$out .= '</div>';
		
		
		return( $out );
	}
	
	public function SB_rframe_createInlineImage( $ratio = '4x3' ) {
		/* convert ratio to image size */
		list( $img_w, $img_h ) = explode( 'x', $ratio );
		if ( $img_w < 1 ) $img_w = 4;
		if ( $img_h < 1 ) $img_h = 3;
		if ( $img_w > 100 ) $img_w = 100;
		if ( $img_h > 100 ) $img_h = 100;
		
		$img_inline = '';
		$img = false;
		
		/* create new image */
		if ( function_exists( "imagecreatetruecolor" ) ){
			if ( !@$img = imagecreatetruecolor( $img_w, $img_h ) ){
				$img = imagecreate( $img_w, $img_h );
			}
		} else {
			$img = imagecreate( $img_w, $img_h );
		}
		
		/* transparent PNG - fill */
		@imagealphablending( $img, false );
		@imagesavealpha( $img, true );
		$col = @imagecolorallocatealpha( $img, 255, 255, 255, 127 );
		@imagefill( $img, 0, 0, $col );
		
		/* capture the image */
		ob_start(); imagepng( $img ); $img_inline = ob_get_clean();
		imagedestroy( $img );
		
		/* encode to inline image */
		$img_inline = 'data:image/png;base64,' . base64_encode( $img_inline );
		
		return( $img_inline );
	}
	/**
	 * Fired when the plugin is activated.
	 *
	 * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog 
	 */
	public function activate( $network_wide ) {
		
	} // end activate
	
	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog 
	 */
	public function deactivate( $network_wide ) {
		
	} // end deactivate
	
	/**
	 * Fired when the plugin is uninstalled.
	 *
	 * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog 
	 */
	public function uninstall( $network_wide ) {
		
	} // end uninstall
	
	
} // end class
$SB_ResponseFrame = new SB_ResponseFrame();