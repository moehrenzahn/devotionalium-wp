=== Devotionalium Daily Verses for Wordpress ===
Contributors: maxmelzer
Tags: bible, quran, torah, devotion, watchword, losung, theology
Requires at least: 4.9
Tested up to: 5.1.1
Stable tag: 1.2.0
Requires PHP: 5.6
Text Domain:  devotionalium
Domain Path:  /languages
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Include today's verses from devotionalium.com, with rich support for original languages.

== Description ==

Devotionalium Daily Verses for Wordpress is a plugin that uses the [Devotionalium.com](https://devotionalium.com/api/docs) API to display today's featured verses from [Devotionalium.com](https://devotionalium.com) on your Wordpress page.

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

Devotionalium is a free service for reading daily verses from the Torah, the New Testament, and the Quran. Check out devotionalium.com for more.

== Screenshots ==

1. Devotionalium as a sidebar widget.
2. The Devotionalium configuration area.

== Changelog ==
= 1.2.0 =
* Add setting to toggle Quran display
* Fixes and updates for new API format
= 1.1.0 =
* Add ability to choose an API endpoint url
* request specific days from the API instead of offsets
= 1.0.6 =
* Fixed a bug that sometimes prohibited the activation of the plugin
= 1.0.5 =
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
