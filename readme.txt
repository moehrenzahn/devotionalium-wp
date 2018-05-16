=== Devotionalium for Wordpress ===
Contributors: maxmelzer
Tags: bible, devotion, watchword, losung, theology
Requires at least: 4.9
Tested up to: 4.9.5
Stable tag: 1.0.5
Requires PHP: 5.6
Text Domain:  devotionalium
Domain Path:  /languages
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Include today's bible verses from devotionalium.com, with rich support for original languages.

== Description ==

Devotionalium for Wordpress is a plugin that utilises the [Devotionalium.com](https://devotionalium.com/api/docs) API to display today's featured bible verses from [Devotionalium.com](https://devotionalium.com) on your Wordpress page.

You can use it as

- a *widget*,
- via the *shortcode* `[devotionalium]`
- or directly in your template via `<?php echo do_shortcode('[devotionalium]'); ?>`.

It offers rich configuration options for language, bible version and optional display of Devotionalium in the original biblical languages ancient hebrew and ancient greek.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the plugin files to the `/wp-content/plugins/devotionalium` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings->Devotionalium screen to configure the plugin

== Frequently Asked Questions ==

= What is Devotionalium? =

Devotionalium is a free service for reading daily verses from the bible. Check out devotionalium.com for more.

== Screenshots ==

1. Devotionalium as a sidebar widget.
2. The Devotionalium configuration area.

== Changelog ==
= 1.0.4 =
* Restored compatibility with PHP 5.6
= 1.0.4 =
* Fixed a problem with nested <p> tags in templates
= 1.0.3 =
* adjusted translation namespace, removed local translation
= 1.0.2 =
* Fixes for german translation.
= 1.0.1 =
* Switch to production api endpoint.
= 1.0 =
* Initial release.
