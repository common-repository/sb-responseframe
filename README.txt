=== SB-ResponseFrame ===
Contributors: ladislav.soukup@gmail.com
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=P6CKTGSXPFWKG&lc=CZ&item_name=Ladislav%20Soukup&item_number=SB%20ResponseFrame%20%5bWP%2dPlugin%5d&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted
Tags: responsive, iframe
Requires at least: 3.3.1
Tested up to: 3.7
Stable tag: 1.0.0

This is simple shortcode to embed responsive (fixed-ratio) iframes

== Description ==
This is simple shortcode to embed responsive iframe to your post. Iframe will hold the specified ratio when page is rescaled.

[rframe ratio="16x9" src="http://flixel.com/player/snqi608mlq1h98w5p9jy" width="60%" /]

= How it Works =
DIV block with specified width is creted. Inside is transparent PNG file with specifed ratio scaled to 100% width and height set to auto. This image will scale the main DIV to size with correct ratio.
Embeded IFRAME is then set to fill the wrapper DIV, so it is scaled with the image.
Image is created on the fly via PHP and inserted as inline image directly to src attribute of img tag.

= Credit =
Thanks to Masau ( http://jsfiddle.net/Masau/7WRHM/ ) for the "trick".

== Installation ==
1. Upload to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Feed is now updated, you should check it


== Changelog ==
= 1.0 =

first release version