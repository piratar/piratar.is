=== The Events Calendar Shortcode ===
Contributors: brianhogg, dandelionweb, ankitpokhrel, sujin2f
Tags: event, events, calendar, shortcode, modern tribe
Requires at least: 3.0
Tested up to: 4.5.3
Stable tag: 1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds shortcode functionality to The Events Calendar Plugin (Free Version) by Modern Tribe.

== Description ==

This plugin adds a shortcode for use with The Events Calendar Plugin (by Modern Tribe).

The shortcode displays lists of your events.  You can control the event display with the shortcode options.
Example shortcode to show next 8 events in the category festival in ASC order with date showing [ecs-list-events cat='festival' limit='8']

= Shortcode Options: =
* Basic shortcode: [ecs-list-events]
* cat - Represents single event category. [ecs-list-events cat='festival'].  Use commas when you want multiple categories [ecs-list-events cat='festival, workshops']
* limit - Total number of events to show. Default is 5. [ecs-list-events limit='3']
* order - Order of the events to be shown. Value can be 'ASC' or 'DESC'. Default is 'ASC'. Order is based on event date. [ecs-list-events order='DESC']
* date - To show or hide date. Value can be 'true' or 'false'. Default is true. [ecs-list-events eventdetails='false']
* venue - To show or hide the venue. Value can be 'true' or 'false'. Default is false. [ecs-list-events venue='true']
* excerpt - To show or hide the excerpt and set excerpt length. Default is false. [ecs-list-events excerpt='true'] //displays excerpt with length 100
 excerpt='300' //displays excerpt with length 300
* thumb - To show or hide thumbnail image. Default is false. [ecs-list-events thumb='true'] //displays post thumbnail in default thumbnail dimension from media settings.
* You can use 2 other attributes: thumbwidth and thumbheight to customize the thumbnail size [ecs-list-events thumb='true' thumbwidth='150' thumbheight='150']
* message - Message to show when there are no events. Defaults to 'There are no upcoming events at this time.'
* viewall - Determines whether to show 'View all events' or not. Values can be 'true' or 'false'. Default to 'true' [ecs-list-events cat='festival' limit='3' order='DESC' viewall='false']
* contentorder - Manage the order of content with commas. Default to `title, thumbnail, excerpt, date, venue`. [ecs-list-events cat='festival' limit='3' order='DESC' viewall='false' contentorder='title, thumbnail, excerpt, date, venue']
* month - Show only specific Month. Type 'current' for displaying current month only [ecs-list-events cat='festival' month='2015-06']
* past - Show Outdated Events. [ecs-list-events cat='festival' past='yes']
* key - Order with Start Date [ecs-list-events cat='festival' key='start date']


Want to include your upcoming events in your newsletters?

>**[Check out Event Calendar Newsletter](https://eventcalendarnewsletter.com/?utm_source=wordpress.org&utm_medium=link&utm_campaign=event-cal-shortcode-readme&utm_content=tecs-description)**


== Installation ==

1. Install The Events Calendar Shortcode Plugin from the WordPress.org repository or by uploading the-events-calendar-shortcode folder to the /wp-content/plugins directory. You must also install The Event Calendar Plugin by Modern Tribe and add your events to the calendar.

2. Activate the plugin through the Plugins menu in WordPress


== Frequently Asked Questions ==

= What are the shortcode Options: =
= Shortcode Options: =
* Basic shortcode: [ecs-list-events]
* cat - Represents event category [ecs-list-events cat='festival'] or specify multiple categories [ecs-list-events cat='festival, workshops']
* limit - Total number of events to show. Default is 5. [ecs-list-events limit='3']
* order - Order of the events to be shown. Value can be 'ASC' or 'DESC'. Default is 'ASC'. Order is based on event date. [ecs-list-events order='DESC']
* date - To show or hide date. Value can be 'true' or 'false'. Default is true. [ecs-list-events eventdetails='false']
* venue - To show or hide the venue. Value can be 'true' or 'false'. Default is false. [ecs-list-events venue='true']
* excerpt - To show or hide the excerpt and set excerpt length. Default is false. [ecs-list-events excerpt='true'] //displays excerpt with length 100
 excerpt='300' //displays excerpt with length 300
* thumb - To show or hide thumbnail image. Default is false. [ecs-list-events thumb='true'] //displays post thumbnail in default thumbnail dimension from media settings.
* You can use 2 other attributes: thumbwidth and thumbheight to customize the thumbnail size [ecs-list-events thumb='true' thumbwidth='150' thumbheight='150']
* message - Message to show when there are no events. Defaults to 'There are no upcoming events at this time.'
* viewall - Determines whether to show 'View all events' or not. Values can be 'true' or 'false'. Default to 'true' [ecs-list-events cat='festival' limit='3' order='DESC' viewall='false']
* contentorder - Manage the order of content with commas. Default to `title, thumbnail, excerpt, date, venue`. [ecs-list-events cat='festival' limit='3' order='DESC' viewall='false' contentorder='title, thumbnail, excerpt, date, venue']
* month - Show only specific Month. Type 'current' for displaying current month only. [ecs-list-events cat='festival' month='2015-06']
* past - Show Outdated Events. [ecs-list-events cat='festival' past='yes']
* key - Order with Start Date [ecs-list-events cat='festival' key='start date']

= How do I use this shortcode in a widget? =

* You can put the shortcode in a text widget.
* Not all themes support use of a shortcode in a widget. If a regular text widget doesn't work, put the shortcode in a <a href="https://wordpress.org/plugins/black-studio-tinymce-widget/">Visual Editor Widget</a>.

= What are the classes for styling the list of events? =
The plugin does not include styling. Events are listed in ul li tags with appropriate classes for styling.
* ul class="ecs-event-list"
* li class="ecs-event"
* event title link is H4 class="entry-title summary"
* date class is time
* venue class is venue
* span .ecs-all-events
* p .ecs-excerpt

= How do I include a list of events in a page template? =
include echo do_shortcode("[ecs-list-events]"); in the template where you want the events list to display.

== Upgrade Notice ==
= 1.0.11 =
Add Link to Thumbnail
merge pull request from d4mation -Replaced extracted variables with $atts as using extract was deprecated
=1.0.10 =
Minor Error Change - fix  name and slug 
= 1.0.9 =
Minor Error Change - Multiple Categories
= 1.0.8 =
Add options : multi-categories - Thanks to sujin2f
= 1.0.7 =
Add options : contentorder, month, past, key  - Thanks to sujin2f
= 1.0.6 =
Fix missing ul
= 1.0.5 =
* Add excerpt and thumbnail - Thanks to ankitpokhrel
= 1.0.2 =
* Add venue to shortcode - Thanks to ankitpokhrel
= 1.0.1 =
* Fix Firefox browser compatibility issue
= 1 =
* Initial Release

== Changelog ==
= 1.0.11 =
Add Link to Thumbnail
merge pull request from d4mation -Replaced extracted variables with $atts as using extract was deprecated
= 1.0.10 =
Minor Error Change - fix name and slug
= 1.0.9 =
Minor Error Change - Multiple Categories
= 1.0.8 =
Add options : multi-categories - Thanks to sujin2f
= 1.0.7 =
* Add options : contentorder, month, past, key - Thanks to sujin2f
= 1.0.6 =
Fix missing ul
= 1.0.5 =
* Add excerpt and thumbnail - Thanks to ankitpokhrel
= 1.0.2 =
* Add venue to shortcode  - Thanks to ankitpokhrel
= 1.0.1 =
* Fix Firefox browser compatibility issue
= 1 =
* Initial release
