=== Simple Yearly Archive ===
Contributors: Alphawolf
Donate link: https://www.schloebe.de/donate/
Tags: gettext, archive, yearly, polyglot, shortcode, exclude, category, wpml, language, localization, multilingual, coauthors, wp_query, get_posts
Requires at least: 3.7
Tested up to: 5.5.9999
Stable tag: trunk
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Simple Yearly Archive is a rather neat and simple Wordpress plugin that allows you to display your archives in a year-based list.

== Description ==

Simple Yearly Archive is a rather neat and simple Wordpress plugin that allows you to **display your archives in a year-based list**. It works mostly like the usual WP archive, but displays all published posts seperated by their year of publication. That said, it’s also possible to restrict the output to certain categories, and much more.

**See [Usage](https://www.schloebe.de/wordpress/simple-yearly-archive-plugin/#tabwidget-27592 "Usage") for examples, available parameters and more.**

**Included languages:**

* English
* German (de_DE) (Thanks to me ;-))
* Italian (it_IT) (Thanks for contributing italian language goes to [Gianni Diurno](https://gidibao.net))
* Russian (ru_RU) (Thanks for contributing russian language goes to [Dimitry German](https://grugl.me))
* Belorussian (by_BY) (Thanks for contributing belorussian language goes to [Marcis Gasuns](https://www.fatcow.com))
* Uzbek (uz_UZ) (Thanks for contributing uzbek language goes to [Alexandra Bolshova](https://www.comfi.com))
* French (fr_FR) (Thanks for contributing french language goes to [Jean-Michel Meyer](https://www.li-an.fr/blog))
* Chinese (zh_CN) (Thanks for contributing chinese language goes to [Mariana Ma](https://marianama.net))
* Japanese (ja) (Thanks for contributing japanese language goes to [Chestnut](https://staff.blog.bng.net))
* Portuguese Brazil (pt_BR) (Thanks for contributing portuguese brazil language goes to LucasTolle)
* Dutch (nl_NL) (Thanks for contributing dutch language goes to Bart Verkerk)
* Spanish (es) (Spanish translation by [Ibidem Group](https://www.ibidemgroup.com))

[Click here for a demo](https://www.schloebe.de/archiv/ "Click here for a demo")

[Developer on Twitter](https://twitter.com/wpseek "Developer on Twitter")

**Looking for more WordPress plugins? Visit [www.schloebe.de/portfolio/](https://www.schloebe.de/portfolio/)**

== Frequently Asked Questions ==

= Usage =

You can add the archive to any post/page by using shortcode. See [Usage](https://www.schloebe.de/wordpress/simple-yearly-archive-plugin/#tabwidget-27592 "Usage") for examples, available parameters and more.

= How can I change the posts' titles? =

Just use the filter `sya_the_title`. Example: Add the following to your theme's `functions.php`:

`
add_filter( 'sya_the_title', 'my_sya_filter_title', 10, 2 );

function my_sya_filter_title( $title, $id ) {
	return $id . ' - ' . $title;
}
`

This will prepend the post's ID to the output. This also allows you to append custom taxonomies and more by using `get_post( $id )`.

= How can I change the posts' authors listing (like in supporting the Co-Authors Plus plugin)? =

Just use the filter `sya_the_authors`. Example: Add the following to your theme's `functions.php`:

`
if( function_exists('get_coauthors') ) {
	add_filter( 'sya_the_authors', 'my_sya_filter_authors', 10, 2 );
	
	function my_sya_filter_authors( $author, $post ) {
		$coauthors = get_coauthors( $post->ID );
		$authorsCollection = array();
		foreach( $coauthors as $coauthor ) {
			if( $coauthor->display_name ) {
				$authorsCollection[] = $coauthor->display_name;
			}
		}
		return implode(', ', $authorsCollection);
	}
}
`

= How can I make the posts' categories list only show child categories? =

Just use the filter `sya_categories`. Example: Add the following to your theme's `functions.php`:

`
function sya_child_categories( $sya_categories ) {
	return array_filter($sya_categories, function($v, $k) {
		return get_category( $k )->parent > 0;
	}, ARRAY_FILTER_USE_BOTH);
}
add_filter( 'sya_categories', 'sya_child_categories', 10, 3 );
`

= How can I change query parameters? =

Just use the filter `sya_get_posts` that allows you to query for literally anything using [`WP_Query`](https://developer.wordpress.org/reference/classes/wp_query/parse_query/ "WP_Query") parameters. Add the following snippets to your theme's `functions.php`.

**Display posts that have "either" of these tags**

`
add_filter( 'sya_get_posts', function() {
	return array(
		'tag' => 'bread,baking'
	);
});
`

**Display posts that match the search term "keyword"**

`
add_filter( 'sya_get_posts', function() {
	return array(
		's' => 'keyword'
	);
});
`

**Display only password protected posts**

`
add_filter( 'sya_get_posts', function() {
	return array(
		'has_password' => true
	);
});
`

**Display only 10 posts**

`
add_filter( 'sya_get_posts', function() {
	return array(
		'numberposts' => 10
	);
});
`

**Display posts tagged with *bob*, under *people* custom taxonomy**

`
add_filter( 'sya_get_posts', function() {
	return array(
		'tax_query' => array(
			array(
				'taxonomy' => 'people',
				'field'    => 'slug',
				'terms'    => 'bob',
			)
		)
	);
});
`

**Display posts from several custom taxonomies**

`
add_filter( 'sya_get_posts', function() {
	return array(
		'tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'movie_genre',
				'field'    => 'slug',
				'terms'    => array( 'action', 'comedy' ),
			),
			array(
				'taxonomy' => 'actor',
				'field'    => 'term_id',
				'terms'    => array( 103, 115, 206 ),
				'operator' => 'NOT IN',
			),
		)
	);
});
`

**Display posts that are in the *quotes* category OR have the *quote* format**

`
add_filter( 'sya_get_posts', function() {
	return array(
		'tax_query' => array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => array( 'quotes' ),
			),
			array(
				'taxonomy' => 'post_format',
				'field'    => 'slug',
				'terms'    => array( 'post-format-quote' ),
			),
		)
	);
});
`

**Display posts that are in the *quotes* category OR both have the *quote* post format AND are in the *wisdom* category**

`
add_filter( 'sya_get_posts', function() {
	return array(
		'tax_query' => array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => array( 'quotes' )
			),
			array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'post_format',
					'field'    => 'slug',
					'terms'    => array( 'post-format-quote' )
				),
				array(
					'taxonomy' => 'category',
					'field'    => 'slug',
					'terms'    => array( 'wisdom' ),
				)
			)
		)
	);
});
`

Configuration? Parameters? [Head over here](https://www.schloebe.de/wordpress/simple-yearly-archive-plugin/ "Head over here")

== Installation ==

1. Download the plugin and unzip it.
1. Upload the folder simple-yearly-archive/ to your /wp-content/plugins/ folder.
1. Activate the plugin from your Wordpress admin panel.
1. Installation finished.

See [Usage](https://www.schloebe.de/wordpress/simple-yearly-archive-plugin/#tabwidget-27592 "Usage") for examples, available parameters and more.

== Changelog ==

= 2.1.2 =
* WordPress 5.3 compatibility

= 2.1.1 =
* Minor bugfix for the `the_title` filter

= 2.1.0 =
* Added the filters `sya_categories` and `sya_tags`
* Minor fixes

= 2.0.2 =
* WordPress 4.8 compatibility

= 2.0.1 =
* Removed printing out the module name and version as a HTML comment

= 2.0.0 =
* Added filter `sya_get_posts` so you can query for literally anything using [`WP_Query`](https://developer.wordpress.org/reference/classes/wp_query/parse_query/ "WP_Query") parameters! See examples [here](https://wordpress.org/plugins/simple-yearly-archive/faq/ "here")

= 1.9.0 =
* Added option to show tags after each post
* Localizations updated

= 1.8.3 =
* Settings page optimizations
* Localizations updated
* Bug fixes

= 1.8.2 =
* WordPress 4.7 compatibility
* PHP 7 compatibility

= 1.8.1 =
* Fixed an issue with (post type) attachment not being listed
* Minor bug fixes
* Code cleanup

= 1.8.0 =
* Added the possibility to include more than one custom post type

= 1.7.5 =
* Polylang support

= 1.7.4 =
* Added a filter `sya_the_authors` so you can filter the post's authors listing before output (e.g. support for the Co-Authors Plus plugin)
* Minor bug fixes

= 1.7.3 =
* Added a filter `sya_the_title` so you can filter the post's title before output
* Minor bug fixes

= 1.7.2 =
* IMPORTANT: Date format changed to reflect localized date strings. Please review and update your date string in the plugin's settings!
* Code cleanup
* Localizations updated

= 1.7.1.2 =
* Permission error fix (thanks outtareach!)
* Code cleanup
* Localizations updated

= 1.7.1.1 =
* Code cleanup

= 1.7.1 =
* Post thumbnails support!
* Code cleanup and bugfixing

= 1.7.0.2 =
* Fixed an issue with the plugin's textdomain not loading

= 1.7.0.1 =
* Added legacy direct PHP invocation again: `<?php simpleYearlyArchive(); ?>` (sorry!)
* Fixed an issue where the anchored years weren't displayed

= 1.7.0 =
* Code rewrite (please let me know if you experience something is broken)
* You can now specify a custom time period for a period like `[SimpleYearlyArchive type="1249077600-1280527200"]` where start and end point are UNIX timestamps
* Increased performance

= 1.6.2.5 =
* Added a CSS class post id to the post links so people can do more custom things with CSS or javascript

= 1.6.2.2 =
* Hide comments count for posts with comments closed

= 1.6.2.1 =
* Fixed a bug that did not reverse post order if "Reverse order" was selected

= 1.6.2 =
* Improved WPML support

= 1.6.1 =
* Initial WPML support (thanks to Emilie from bornbilingue.com for the help!)

= 1.6.0 =
* Support for post types

= 1.5.0 =
* Significant changes that result in a lot less memory consumption on blogs with 1000+ posts
* Code cleanup

= 1.4.3.3 =
* Fixed another PHP notice. Didn't have enough coffee.

= 1.4.3.2 =
* Fixed a PHP notice when using exclude/include parameter (thanks Lea!)

= 1.4.3.1 =
* Fixed an issue that caused to load unsecure resources on SSL enabled sites

= 1.4.3 =
* Fixed a bug that caused listing "auto draft" posts

= 1.4.2 =
* Fixed a bug with the anchored years overview at the top

= 1.4.1 =
* Added a date wrapper span so you can hide the date via CSS

= 1.4 =
* New option "Collapsible years?" added

= 1.3.3 =
* Readme.txt updated to be more compliant with the readme.txt standard
* Moved screenshots off the package to the assets/ folder

= 1.3.2 =
* Maintenance update #2 ( Dominik :) )

= 1.3.1 =
* Maintenance update

= 1.3.0 =
* Option to reverse the order of the year/posts list output

= 1.2.9 =
* Maintenance update

= 1.2.8 =
* A few fixes that resulted from the previous versions

= 1.2.7 =
* Character encoding for new date format string fixed
* Fixed a bug that occured when "Anchored overview at the top" was checked while "Linked years" was unchecked (Thanks Kroom!)
* Added an admin notice when someone didn't already switch to the new date format string

= 1.2.6 =
* IMPORTANT: Date format changed to reflect localized date strings. Please update your date string in the plugin's settings!

= 1.2.5 =
* Optional anchored links to each year at the top

= 1.2.4 =
* Archive links now working again

= 1.2.3 =
* Minor performance improvements
* Min version set to 2.3

= 1.2.2 =
* Private posts are now prefixed with "Private" in order to follow WordPress standards (Thanks Andrei Borota!)

= 1.2.1 =
* Fixed a warning message

= 1.2 =
* Date format can be set in the shortcode like `[SimpleYearlyArchive ... dateformat="d/m"]`

= 1.1.50 =
* Changed post authot output from user_login to display_name

= 1.1.40 =
* Added japanese localization (Thanks to [Chestnut](https://staff.blog.bng.net))!)

= 1.1.31 =
* Fixed an issue on server configurations having PHP short tags disabled

= 1.1.30 =
* Fixed an issue that threw an 'Missing argument 3' warning in PHP
* Added `apply_filters('sya_archive_output', $output)` filter hook so you can alter the HTML output before it's being returned
* Added french localization (Thanks to [Jean-Michel Meyer](https://www.li-an.fr/blog)!)

= 1.1.20 =
* Added the `include` parameter allowing to include categories instead of only excluding them
* code cleanup

= 1.1.10 =
* Minor Code Changes

= 1.1.9 =
* Fixed issue on displaying post count for each year when there are excluded categories

= 1.1.8 =
* Some options page changes
* Improved compatibility with WP 2.7
* Code improvements

= 1.1.7 =
* Some options page changes
* Improved compatibility with WP 2.7
* Code improvements

= 1.1.5 =
* Exclude code changed that works like the WordPress method now (which makes this archive plugin unique ;-) )
* Private and password-protected posts now show up depending on user capibilities

= 1.1.2 =
* Markup is now html strict compatible

= 1.1.1 =
* Option added to display post author after each post
* Added italian localization (Thanks to Gianni Diurno!)

= 1.1.0 =
* Improved compatibility with WordPress 2.6
* Added shortcode compatibility
* Minor html changes

= 1.0.1 =
* Improved compatibility with WordPress 2.2.x
* Fixed issue that occasionally occured with the inline function

= 1.0 =
* Option added to display categories after each post

= 0.98 =
* Fixed error, that prevented backend localization

= 0.97 =
* Simple Yearly Archive options page has WP 2.5 style (if used in WP 2.5+) (see screenshots)
* Performance improvements

= 0.96 =
* Year headings do not show if there are no posts in that year (Thanks to Stephanie C. Leary!)

= 0.95 =
* Option "Show optional Excerpt" added
* Option "Max. chars of Excerpt" added
* Option "Indentation of Excerpt" added

= 0.91 =
* WP 2.3 compatibility on exclude cateogries
* minor language fixes
* minor fixes and code optimisation

= 0.9 =
* Added a bunch of new options

= 0.82 =
* gettext-ready, plugins like language-switcher or polyglot are supported now

= 0.81 =
* Now compatible with the Admin Drop Down Menu Plugin, which caused to not to be able to access the options page

= 0.8 =
* New options page in Wordpress administration
* plugin can now be called from within a page/post

= 0.7 =
* Now it’s possible to show posts from the given date of year only
* Little fix in get_year_link

= 0.6 =
* 2 parameters added: Display the current year’s posts or the past year’s posts only
* Posts remain sorted in case of changing the post’s timestamp

= 0.5 =
* The plugin has been released

== Screenshots ==

1. The options page

== Upgrade Notice ==

* Added filter `sya_get_posts` so you can query for literally anything using `WP_Query` parameters: https://developer.wordpress.org/reference/classes/wp_query/parse_query/
