=== Google Analytics Dashboard for WP ===
Contributors: deconf
Donate link: https://deconf.com/donate/
Tags: google,analytics,google analytics,dashboard,analytics dashboard,google analytics dashboard,google analytics plugin,google analytics widget,tracking,universal google analytics,realtime,multisite,gadwp
Requires at least: 3.5
Tested up to: 4.5
Stable tag: 4.9.3.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Displays Google Analytics reports in your WordPress Dashboard. Inserts the latest Google Analytics tracking code in your pages.

== Description ==
This Google Analytics for WordPress plugin enables you to track your site using the latest Google Analytics tracking code and allows you to view key Google Analytics reports in your WordPress install.

In addition to a set of general Google Analytics reports, in-depth Page reports and in-depth Post reports allow further segmentation of your analytics data, providing performance details for each post or page from your website.

The Google Analytics tracking code is fully customizable through options and hooks, allowing advanced data collection using custom dimensions and events.    

= Google Analytics Real-Time =

Google Analytics reports, in real-time, in your dashboard screen:

- Real-time number of visitors 
- Real-time acquisition channels
- Real-time traffic sources details 

= Google Analytics Reports =

The Google Analytics reports you need, on your dashboard, in your All Posts and All Pages screens, and on site's frontend:  

- Sessions, organic searches, page views, bounce rate analytics reports
- Locations, pages, referrers, keywords analytics reports
- Traffic channels, social networks, traffic mediums, search engines analytics reports
- Device categories, browsers, operating systems, screen resolutions, mobile brands analytics reports 
- User access control over analytics reports

= Google Analytics Basic Tracking =

Installs the latest Google Analytics tracking code and allows full code customization:

- Switch between Universal Google Analytics and Classic Google Analytics code
- IP address anonymization
- Enhanced link attribution
- Remarketing, demographics and interests tracking
- Google AdSense linking
- Page Speed sampling rate control
- Cross domain tracking
- Exclude user roles from tracking

= Google Analytics Event Tracking =

Google Analytics Dashboard for WP enables you to easily track events like:
 
- Downloads
- Emails 
- Outbound links
- Affiliate links
- Fragment identifiers

= Google Analytics Custom Dimensions =

With Google Analytics Dashboard for WP you can use custom dimensions to track:

- Authors
- Publication year
- Categories
- Tags
- User engagement

= Google Analytics Dashboard for WP on Multisite =

This plugin is fully compatible with multisite network installs, allowing three setup modes:

- Mode 1: network activated using multiple Google Analytics accounts
- Mode 2: network activated using a single Google Analytics account
- Mode 3: network deactivated using multiple Google Analytics accounts

> <strong>Google Analytics Dashboard for WP on GitHub</strong><br>
> You can submit feature requests or bugs on [Google Analytics Dashboard for WP](https://github.com/deconf/Google-Analytics-Dashboard-for-WP) repository.

= Further reading =

* Homepage of [Google Analytics Dashboard for WP](https://deconf.com/google-analytics-dashboard-wordpress/)
* Other [WordPress Plugins](https://deconf.com/wordpress/) by same author
* [Google Analytics | Partners](https://www.google.com/analytics/partners/company/5127525902581760/gadp/5629499534213120/app/5707702298738688/listing/5639274879778816) Gallery

== Installation ==

1. Upload the full google-analytics-dashboard-for-wp directory into your wp-content/plugins directory.
2. In WordPress select Plugins from your sidebar menu and activate the Google Analytics Dashboard for WP plugin.
3. Open the plugin configuration page, which is located under Google Analytics menu.
4. Authorize the plugin to connect to Google Analytics using the Authorize Plugin button.
5. Go back to the plugin configuration page, which is located under Google Analytics menu to update/set your settings.
6. Go to Google Analytics -> Tracking Code to configure/enable/disable tracking.

== Frequently Asked Questions == 

= Do I have to insert the Google Analytics tracking code manually? =

No, once the plugin is authorized and a default domain is selected the Google Analytics tracking code is automatically inserted in all webpages.

= Some settings are missing in the video tutorial =

We are constantly improving Google Analytics Dashboard for WP, sometimes the video tutorial may be a little outdated.

= How can I suggest a new feature, contribute or report a bug? =

You can submit pull requests, feature requests and bug reports on [our GitHub repository](https://github.com/deconf/Google-Analytics-Dashboard-for-WP).

= Documentation, Tutorials and FAQ =

For documentation, tutorials, FAQ and videos check out: [Google Analytics Dashboard for WP documentation](https://deconf.com/google-analytics-dashboard-wordpress/).

== Screenshots ==

1. Google Analytics Dashboard for WP Blue Color
2. Google Analytics Dashboard for WP Real-Time
3. Google Analytics Dashboard for WP reports per Posts/Pages
4. Google Analytics Dashboard for WP Geo Map
5. Google Analytics Dashboard for WP Top Pages, Top Referrers and Top Searches
6. Google Analytics Dashboard for WP Traffic Overview
7. Google Analytics Dashboard for WP statistics per page on Frontend
8. Google Analytics Dashboard for WP cities on region map
9. Google Analytics Dashboard for WP Widget

== Localization ==

You can translate Google Analytics Dashboard for WP on [translate.wordpress.org](https://translate.wordpress.org/projects/wp-plugins/google-analytics-dashboard-for-wp).

== License ==

Google Analytics Dashboard for WP it's released under the GPLv2, you can use it free of charge on your personal or commercial website.

== Upgrade Notice ==

== Changelog ==

= 4.9.3.1 =
* Bug Fixes:
	* fixing a bug where &nbsp was displayed instead of a blank space on localized sites
	
= 4.9.3 =
* Enhancements: 
	* implement more specific error codes
	* files cleanup
	* move reports.js and other scripts to footer
	* on-screen errors instead of using console
* New Features:
	* custom dimensions support for Tags	
	
= 4.9.2 =
* Enhancements: 
	* improved loading speed for charts
	* add autoloading for Charts Library to allow dequeue on conflicts
	* removed API Key option, since is not needed anymore
	* display session values in Pie Chart slices
	* improved data accuracy for Pie Charts 

* Bug Fixes:
	* multiple fixes for frontend widget
	* page title missing in Realtime report

* New Features:
	* brand new Technology Reports with details about Device Categories, Browsers, Operating Systems, Screen Resolutions and Device Brands  

= 4.9.1.2 =
- Bug Fix: multiple CSS fixes for frontend widget
- Bug Fix: clean-up output for View selection list
- Bug Fix: try to fix Google Charts conflicts with other plugins
- Bug Fix: prevent PHP warnings during authorization and while revoking tokens

= 4.9.1.1 =
- Bug Fix: focusFlag preventing Real-Time reports from refreshing properly
- Bug Fix: date format is not properly localized in daily/monthly reports
- Bug Fix: reports loading issues on WordPress 4.4

= 4.9.1 =
- Bug Fix: clear_cache method is generating PHP warnings on certain conditions 
- Bug Fix: make sure Google charts libraries are loaded before rendering

= 4.9.0.1 =
- Bug Fix: Pages report missing from admin dashboard widget
- Bug Fix: Invalid response with a -31 error when using a certain combination of backend settings

= 4.9 =
- Bug Fix: add an unique class to jQuery UI Tooltips to avoid conflicts
- Bug Fix: multiple CSS improvements
- Bug Fix: invalid localized date formats
- Bug Fix: switching between multisite modes doesn't propagate the new network status on all sites
- Bug Fix: Location Settings ignored in posts/pages reports
- Enhancement: unset cookies while revoking the authorization or clearing the cache 
- Enhancement: no more page re-loads on admin dashboard widget when switching between reports
- Enhancement: unified reporting system with real-time capabilities
- Enhancement: new tracking options enabling you to customize cookieName, cookieDomain, cookieExpires; props by [Martins Sipenko](https://github.com/martinssipenko) 
- Enhancement: display update notices only to admins and only on dashboard
- Enhancement: force language packs updates for all available languages on a Network
- Enhancement: added View switch capabilities

The full changelog is [available here](https://deconf.com/changelog-google-analytics-dashboard-for-wp/).
