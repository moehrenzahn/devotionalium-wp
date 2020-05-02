test:
	echo "Not implemented yet."
publish-WP:
	php build/publish-wp.php
update-pot:
	cd ~/dev/devotionalium-wp/devotionalium/languages
	php ~/dev/trunk/tools/i18n/makepot.php wp-plugin ~/dev/devotionalium-wp/devotionalium
