=== Instagram Feed ===
Contributors: smashballoon
Tags: Instagram, Instagram feed, Instagram photos, Custom Instagram Feed, responsive Instagram, mobile Instagram, Instagram wall, Instagram gallery, Instagram galleries, Instagram widget, beautiful Instagram
Requires at least: 3.0
Tested up to: 4.6
Stable tag: 1.4.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display beautifully clean, customizable, and responsive feeds from multiple Instagram accounts

== Description ==

Display Instagram photos from any non-private Instagram accounts, either in the same single feed or in multiple different ones.

= Features =
* **Compatible with the June 1st Instagram API changes**
* Super **simple to set up**
* Display photos from **multiple Instagram accounts** in the same feed or in separate feeds
* Completely **responsive** and mobile ready - layout looks great on any screen size and in any container width
* **Completely customizable** - Customize the width, height, number of photos, number of columns, image size, background color, image spacing and more!
* Display **multiple Instagram feeds** on the same page or on different pages throughout your site
* Use the built-in **shortcode options** to completely customize each of your Instagram feeds
* Display thumbnail, medium or **full-size photos** from your Instagram feed
* **Infinitely load more** of your Instagram photos with the 'Load More' button
* Includes a **Follow on Instagram button** at the bottom of your feed
* Display a **beautiful header** at the top of your feed
* Display your Instagram photos chronologically or in random order
* Add your own Custom CSS and JavaScript for even deeper customizations

= Benefits =
* **Increase Social Engagement** - Increase engagement between you and your Instagram followers. Increase your number of followers by displaying your Instagram content directly on your site.
* **Save Time** - Don't have time to update your photos on your site? Save time and increase efficiency by only posting your photos to Instagram and automatically displaying them on your website
* **Display Your Content Your Way** - Customize your Instagram feeds to look exactly the way you want, so that they blend seemlessly into your site or pop out at your visitors!
* **Keep Your Site Looking Fresh** - Automatically push your new Instagram content straight to your site to keep it looking fresh and keeping your audience engaged.
* **Super simple to set up** - Once installed, you can be displaying your Instagram photos within 30 seconds! No confusing steps or Instagram Developer account needed.

= Featured Reviews =
"**Simple and concise** - Excellent plugin. Simple and non-bloated. I had a couple small issues with the plugin when I first started using it, but a quick comment on the support forums got a new version pushed out the next day with the fix. Awesome support!" - [Josh Jones](https://wordpress.org/support/topic/simple-and-concise-3 'Simple and concise Instagram plugin')

"**Great plugin, greater support!** - I've definitely noticed an increase in followers on Instagram since I added this plugin to my sidebar. Thanks for the help in making some adjustments...looks and works great!" - [BNOTP](https://wordpress.org/support/topic/thanks-for-a-great-plugin-6 'Great plugin, greater Support!')

= Feedback or Support =
We're dedicated to providing the most customizable, robust and well supported Instagram feed plugin in the world, so if you have an issue or have any feedback on how to improve the plugin then please open a ticket in the [Support forum](http://wordpress.org/support/plugin/instagram-feed 'Instagram Feed Support Forum').

For a pop-up photo **lightbox**, to display posts by **hashtag**, show photo **captions**, **video** support + more, check out the [Pro version](http://smashballoon.com/instagram-feed/ 'Instagram Feed Pro').

== Installation ==

1. Install the Instagram Feed plugin either via the WordPress plugin directory, or by uploading the files to your web server (in the `/wp-content/plugins/` directory).
2. Activate the Instagram Feed plugin through the 'Plugins' menu in WordPress.
3. Navigate to the 'Instagram Feed' settings page to obtain your Instagram Access Token and Instagram User ID and configure your settings.
4. Use the shortcode `[instagram-feed]` in your page, post or widget to display your Instagram photos.
5. You can display multiple Instagram feeds by using shortcode options, for example: `[instagram-feed num=6 cols=3]`

For simple step-by-step directions on how to set up the Instagram Feed plugin please refer to our [setup guide](http://smashballoon.com/instagram-feed/free/ 'Instagram Feed setup guide').

= Display your Feed =

**Single Instagram Feed**

Copy and paste the following shortcode directly into the page, post or widget where you'd like the Instagram feed to show up: `[instagram-feed]`

**Multiple Instagram Feeds**

If you'd like to display multiple Instagram feeds then you can set different settings directly in the shortcode like so: `[instagram-feed num=9 cols=3]`

You can display as many different Instagram feeds as you like, on either the same page or on different pages, by just using the shortcode options below. For example:
`[instagram-feed]`
`[instagram-feed id="ANOTHER_USER_ID"]`
`[instagram-feed id="ANOTHER_USER_ID, YET_ANOTHER_USER_ID" num=4 cols=4 showfollow=false]`

See the table below for a full list of available shortcode options:

= Shortcode Options =
* **General Options**
* **id** - An Instagram User ID - Example: `[instagram-feed id=AN_INSTAGRAM_USER_ID]`
* **width** - The width of your Instagram feed. Any number - Example: `[instagram-feed width=50]`
* **widthunit** - The unit of the width of your Instagram feed. 'px' or '%' - Example: `[instagram-feed widthunit=%]`
* **height** - The height of your Instagram feed. Any number - Example: `[instagram-feed height=250]`
* **heightunit** - The unit of the height of your Instagram feed. 'px' or '%' - Example: `[instagram-feed heightunit=px]`
* **background** - The background color of the Instagram feed. Any hex color code - Example: `[instagram-feed background=#ffff00]`
* **class** - Add a CSS class to the Instagram feed container - Example: `[instagram-feed class=feedOne]`
*
* **Photo Options**
* **sortby** - Sort the Instagram posts by Newest to Oldest (none) or Random (random) - Example: `[instagram-feed sortby=random]`
* **num** - The number of Instagram posts to display initially. Maximum is 33 - Example: `[instagram-feed num=10]`

* **cols** - The number of columns in your Instagram feed. 1 - 10 - Example: `[instagram-feed cols=5]`
* **imageres** - The resolution/size of the Instagram photos. 'auto', full', 'medium' or 'thumb' - Example: `[instagram-feed imageres=full]`
* **imagepadding** - The spacing around your Instagram photos - Example: `[instagram-feed imagepadding=10]`
* **imagepaddingunit** - The unit of the padding in your Instagram feed. 'px' or '%' - Example: `[instagram-feed imagepaddingunit=px]`
* **disablemobile** - Disable the mobile layout for your Instagram feed. 'true' or 'false' - Example: `[instagram-feed disablemobile=true]`
*
* **Header Options**
* **showheader** - Whether to show the Instagram feed Header. 'true' or 'false' - Example: `[instagram-feed showheader=false]`
* **headercolor** - The color of the Instagram feed Header text. Any hex color code - Example: `[instagram-feed headercolor=#333]`
*
* **'Load More' Button Options**
* **showbutton** - Whether to show the 'Load More' button. 'true' or 'false' - Example: `[instagram-feed showbutton='false']`
* **buttoncolor** - The background color of the button. Any hex color code - Example: `[instagram-feed buttoncolor=#000]`
* **buttontextcolor** - The text color of the button. Any hex color code - Example: `[instagram-feed buttontextcolor=#fff]`
* **buttontext** - The text used for the button - Example: `[instagram-feed buttontext="Load More Photos"]`
*
* **'Follow on Instagram' Button Options**
* **showfollow** - Whether to show the 'Follow on Instagram' button. 'true' or 'false' - Example: `[instagram-feed showfollow=true]`
* **followcolor** - The background color of the 'Follow on Instagram' button. Any hex color code - Example: `[instagram-feed followcolor=#ff0000]`
* **followtextcolor** - The text color of the 'Follow on Instagram' button. Any hex color code - Example: `[instagram-feed followtextcolor=#fff]`
* **followtext** - The text used for the 'Follow on Instagram' button - Example: `[instagram-feed followtext="Follow me"]`

For more shortcode options, check out the [Pro version](http://smashballoon.com/instagram-feed/ 'Instagram Feed Pro').

= Setting up the Free Instagram Feed WordPress Plugin =

1) Once you've installed the Instagram Feed plugin click on the Instagram Feed item in your WordPress menu

2) Click on the large blue Instagram button to log into your Instagram account and get your Instagram Access Token and Instagram User ID

3) Copy and paste the Instagram Access Token and Instagram User ID into the relevant Instagram Access Token and Instagram User ID fields. If you're having trouble retrieving your Instagram information from Instagram then try using the Instagram button on [this page](https://smashballoon.com/instagram-feed/token/) instead.

You can also display photos from other Instagram accounts by using [this tool](http://www.otzberg.net/iguserid/) to find their Instagram User ID. 

4) Navigate to the Instagram Feed customize page to customize your Instagram feed. 

5) Once you've customized your Instagram feed, click on the Display Your Feed tab to grab the [instagram-feed] shortcode.

6) Copy the Instagram Feed shortcode and paste it into any page, post or widget where you want the Instagram feed to appear.

7) You can paste the Instagram Feed shortcode directly into your page editor. 

8) You can use the default WordPress 'Text' widget to display your Instagram Feed in a sidebar or other widget area.

== Frequently Asked Questions ==

= Can I display multiple Instagram feeds on my site or on the same page? =

Yep. You can display multiple Instagram feeds by using our built-in shortcode options, for example: `[instagram-feed id="12986477" cols=3]`.

= Can I display photos from more than one Instagram account in one single feed? =

Yep. You can just separate the IDs by commas, either in the User ID(s) field on the plugin's Settings page, or directly in the shortcode like so: `[instagram-feed id="12986477,13460080"]`.

= How do I find my Instagram Access Token and User ID =

We've made it super easy. Simply click on the big blue button on the Instagram Feed Settings page and log into your Instagram account. The plugin will then retrieve and display both your Access Token and User ID from Instagram.

You can also display photos from other peoples Instagram accounts. To find their Instagram User ID you can use [this tool](http://www.otzberg.net/iguserid/).

= My Instagram feed isn't displaying. Why not!? =

There are a few common reasons for this:

* **Your Access Token may not be valid.** Try clicking on the blue Instagram login button on the plugin's Settings page again and copy and paste the Instagram token it gives you into the plugin's Access Token field.
* **Your Instagram account may be set to private.** Your Instagram account may be set to private. Instagram doesn't allow photos from private Instagram accounts to be displayed publicly.
* **Your User ID may not be valid**. Be sure you're not using your Instagram username instead of your User ID. You can find your Instagram User ID by using [this tool](http://www.otzberg.net/iguserid/).
* **The plugin's JavaScript file isn't being included in your page.** This is most likely because your WordPress theme is missing the WordPress [wp_footer](http://codex.wordpress.org/Function_Reference/wp_footer) function which is required for plugins to be able to add their JavaScript files to your page. You can fix this by opening your theme's **footer.php** file and adding the following directly before the closing </body> tag: `<?php wp_footer(); ?>`
* **Your website may contain a JavaScript error which is preventing JavaScript from running.** The plugin uses JavaScript to load the Instagram photos into your page and so needs JavaScript to be running in order to work. You would need to remove any existing JavaScript errors on your website for the plugin to be able to load in your feed.

If you're still having an issue displaying your feed then please open a ticket in the [Support forum](http://wordpress.org/support/plugin/instagram-feed 'Instagram Feed Support Forum') with a link to the page where you're trying to display the Instagram feed and, if possible, a link to your Instagram account.

= Are there any security issues with using an Access Token on my site? =

Nope. The Access Token used in the plugin is a "read only" token, which means that it could never be used maliciously to manipulate your Instagram account.

= Can I view the full-size photos or play Instagram videos directly on my website?  =

This is a feature of the [Pro version](http://smashballoon.com/instagram-feed/ 'Instagram Feed Pro') of the plugin, which allows you to view the photos in a pop-up lightbox, support videos, display captions, display photos by hashtag + more!

= How do I embed my Instagram Feed directly into a WordPress page template? =

You can embed your Instagram feed directly into a template file by using the WordPress [do_shortcode](http://codex.wordpress.org/Function_Reference/do_shortcode) function: `<?php echo do_shortcode('[instagram-feed]'); ?>`.

= My Feed Stopped Working – All I see is a Loading Symbol =

If your Instagram photos aren't loading and all your see is a loading symbol then there are a few common reasons:

1) There's an issue with the Instagram Access Token that you are using

You can obtain a new Instagram Access Token on the Instagram Feed Settings page by clicking the blue Instagram login button and then copy and pasting it into the plugin's 'Access Token' field.

Occasionally the blue Instagram login button does not produce a working access token. You can try [this link](https://smashballoon.com/instagram-feed/token/) as well.

2) Your Instagram User ID is incorrect or is from a private Instagram account

Please double check the Instagram User ID that you are using. Please note that your Instagram User ID is different from your Instagram username. To find your Instagram User ID simply enter your Instagram username into [this tool](http://www.otzberg.net/iguserid/).

If your Instagram User ID doesn't show any Instagram photos then it may be that your Instagram account is private and that the Instagram photos aren't able to be displayed.

3) The plugin's JavaScript file isn't being included in your page

This is most likely because your WordPress theme is missing the WordPress wp_footer function which is required for plugins to be able to add their JavaScript files to your page. You can fix this by opening your theme's footer.php file and adding the following directly before the closing </body> tag:

<?php wp_footer(); ?>

4) There's a JavaScript error on your site which is preventing the plugin's JavaScript file from running

You find find out whether this is the case by right clicking on your page, selecting 'Inspect Element', and then clicking on the 'Console' tab, or by selecting the 'JavaScript Console' option from your browser's Developer Tools.

If a JavaScript error is occurring on your site then you'll see it listed in red along with the JavaScript file which is causing it.

5) The feed you are trying to display has no Instagram posts

If you are trying to display an Instagram feed that has no posts made to it, a loading symbol may be all that shows for the Instagram feed or nothing at all. Once you add an Instagram post the Instagram feed should display normally

6) The shortcode you are using is incorrect

You may have an error in the Instagram Feed shortcode you are using or are missing a necessary argument.

= What are the available shortcode options that I can use to customize my Instagram feed? =

The below options are available on the Instagram Feed Settings page but can also be used directly in the `[instagram-feed]` shortcode to customize individual Instagram feeds on a feed-by-feed basis.

* **General Options**
* **id** - An Instagram User ID - Example: `[instagram-feed id=AN_INSTAGRAM_USER_ID]`
* **width** - The width of your Instagram feed. Any number - Example: `[instagram-feed width=50]`
* **widthunit** - The unit of the width of your Instagram feed. 'px' or '%' - Example: `[instagram-feed widthunit=%]`
* **height** - The height of your Instagram feed. Any number - Example: `[instagram-feed height=250]`
* **heightunit** - The unit of the height of your Instagram feed. 'px' or '%' - Example: `[instagram-feed heightunit=px]`
* **background** - The background color of the Instagram feed. Any hex color code - Example: `[instagram-feed background=#ffff00]`
* **class** - Add a CSS class to the Instagram feed container - Example: `[instagram-feed class=feedOne]`
*
* **Photo Options**
* **sortby** - Sort the Instagram posts by Newest to Oldest (none) or Random (random) - Example: `[instagram-feed sortby=random]`
* **num** - The number of Instagram posts to display initially. Maximum is 33 - Example: `[instagram-feed num=10]`

* **cols** - The number of columns in your Instagram feed. 1 - 10 - Example: `[instagram-feed cols=5]`
* **imageres** - The resolution/size of the Instagram photos. 'auto', full', 'medium' or 'thumb' - Example: `[instagram-feed imageres=full]`
* **imagepadding** - The spacing around your Instagram photos - Example: `[instagram-feed imagepadding=10]`
* **imagepaddingunit** - The unit of the padding in your Instagram feed. 'px' or '%' - Example: `[instagram-feed imagepaddingunit=px]`
* **disablemobile** - Disable the mobile layout for your Instagram feed. 'true' or 'false' - Example: `[instagram-feed disablemobile=true]`
*
* **Header Options**
* **showheader** - Whether to show the Instagram feed Header. 'true' or 'false' - Example: `[instagram-feed showheader=false]`
* **headercolor** - The color of the Instagram feed Header text. Any hex color code - Example: `[instagram-feed headercolor=#333]`
*
* **'Load More' Button Options**
* **showbutton** - Whether to show the 'Load More' button. 'true' or 'false' - Example: `[instagram-feed showbutton='false']`
* **buttoncolor** - The background color of the button. Any hex color code - Example: `[instagram-feed buttoncolor=#000]`
* **buttontextcolor** - The text color of the button. Any hex color code - Example: `[instagram-feed buttontextcolor=#fff]`
* **buttontext** - The text used for the button - Example: `[instagram-feed buttontext="Load More Photos"]`
*
* **'Follow on Instagram' Button Options**
* **showfollow** - Whether to show the 'Follow on Instagram' button. 'true' or 'false' - Example: `[instagram-feed showfollow=true]`
* **followcolor** - The background color of the 'Follow on Instagram' button. Any hex color code - Example: `[instagram-feed followcolor=#ff0000]`
* **followtextcolor** - The text color of the 'Follow on Instagram' button. Any hex color code - Example: `[instagram-feed followtextcolor=#fff]`
* **followtext** - The text used for the 'Follow on Instagram' button - Example: `[instagram-feed followtext="Follow me"]`

For more shortcode options, check out the [Pro version](http://smashballoon.com/instagram-feed/ 'Instagram Feed Pro').

For more FAQs related to the Instagram Feed plugin please visit the [FAQ section](https://smashballoon.com/instagram-feed/support/faq/ 'Instagram Feed plugin FAQs') on our website.

== Screenshots ==

1. Default plugin styling
2. Your Instagram Feed is completely customizable
3. Display multiple Instagram feeds from any non-private Instagram account
4. Your Instagram feeds are completely responsive and look great on any device
5. Display your Instagram photos in multiple columns, with or without a scrollbar
6. Just copy and paste the shortcode into any page, post or widget on your site
7. The Instagram Feed plugin Settings pages

== Other Notes ==

Add beautifully clean, customizable, and responsive Instagram feeds to your website. Super simple to set up and tons of customization options to seamlessly match the look and feel of your site.

= Why do I need this? =

**Increase Social Engagement**
Increase engagement between you and your Instagram followers. Increase your number of Instagram followers by displaying your Instagram content directly on your site.

**Save Time**
Don't have time to update your photos on your site? Save time and increase efficiency by only posting your photos to Instagram and automatically displaying them on your website.

**Display Your Content Your Way**
Customize your Instagram feeds to look exactly the way you want, so that they blend seemlessly into your site or pop out at your visitors!

**Keep Your Site Looking Fresh**
Automatically push your new Instagram content straight to your site to keep it looking fresh and keeping your audience engaged.

**No Coding Required**
Choose from tons of built-in Instagram Feed customization options to create a truly unique feed of your Instagram content.

**Super simple to set up**
Once installed, you can be displaying your Instagram photos within 30 seconds! No confusing steps or Instagram Developer account needed.

**Mind-blowing Customer Support**
We understand that sometimes you need help, have issues or just have questions. We love our users and strive to provide the best support experience in the business. We're experts in the Instagram API and can provide unparalleled service and expertise. If you need support then just let us know and we'll get back to you right away.

= What can it do? =

* Display Instagram photos from any non-private Instagram account.
* Completely responsive and mobile ready –your Instagram feed layout looks great on any screen size and in any container width
* Display multiple Instagram feeds on the same page or on different pages throughout your site by using our powerful Instagram Feed shortcode options
* Display posts from multiple Instagram User IDs
* Use the built-in shortcode options to completely customize each of your Instagram feeds
* Infinitely load more of your Instagram photos with the 'Load More' button
* Plus more features added all the time!

= Completely Customizable =

* By default the Instagram feed will adopt the style of your website, but can be completely customized to look however you like!
* Set the number of Instagram photos you want to display
* Choose how many columns to display your Instagram photos in and the size of the Instagram photos
* Choose to show or hide certain parts of the Instagram feed, such as the header, 'Load More', and 'Follow' buttons
* Control the width, height and background color of your Instagram feed
* Set the spacing/padding between the Instagram photos
* Display Instagram photos in chronological or random order
* Use your own custom text and colors for the 'Load More' and 'Follow' buttons
* Enter your own custom CSS or JavaScript for even deeper customization
* Use the shortcode options to style multiple Instagram feeds in completely different ways
* Plus more customization options added all the time!

= What Others are Saying =

**Brilliant plugin and even better support! By Deanobenzino, June 23, 2015 for WP 4.2.2**
I searched for a while to find a decent plugin for an Instagram Feed. This is by far the best, the most stable and very intuitive to use. That being said, the support that I received when asking about a certain functionality I was looking for was fantastic. They were quick to respond and immediately gave me potential solutions. Very professional. Thanks guys!

**Works beautifully and simply! By Melissa, July 4, 2015 for WP 4.2.2**
I've been using a different Instagram plugin on my site, but saw this implemented recently so I tested it against the other plugin — and this one wins hands down.
Easy to set up. Beautiful, clean feed. Everything I need! I'll be upgrading to pro soon! Thanks for the great work!

**great plugin and 5 star support By frurosborg, June 9, 2015 for WP 4.2.2**
i have used many many instagram plugins but this one is the best yet and the support is outstanding. they got back to me and fixed my problem in the hour! do not hesitate. just get it!

**5 starsExcellent Plugin, even better support! By soerfi, January 15, 2015 for WP 4.1**
For 2 years I was searching for a plugin like this and I bought the Pro right away without hesitating. Exactly what I was looking for! I just had a small issue with the plugin and the alignment from my Template. David solved this within 2 hours!
2 thumbs up!

**5 starsGreat plugin - Fantastic support By inventia, January 1, 2015 for WP 4.1
The plugin is easy to install and setup, AND it looks great!
Needed to customize it with some CSS and sent a question to the developer. He responded a few hours later (ON CHRISTMAS EVE!!!) with a CSS code that I could copy&paste to the plugins Custom CSS Section.
Great plugin and fantastic support!

**5 starsawesome plugin / amazing support By seiran1, December 22, 2014 for WP 4.1**
getting things up and running was really straight forward and easy. because of the some custom features the client wanted, I ended up buying the pro version - which was well worth it. I started including some custom coding and when I hit a brick wall, John at Smash Balloon was incredibly quick to give me a hand and stuck in there when I fired off a ton of questions.
thanks again for the awesome plugin and the top-notch support. the plugin is definitely recommended and beats every single other plugin I tried for an instagram tie-in.

**5 starsGreat plugin, greater support! By rezza_marco, January 8, 2015 for WP 4.1**
This plugin is what i was looking for, and it's also very easy to use.
But the best part is about the support. I needed some advices and css customization. I had an email exchange with John, he always answered really fast (matter of few hours) and was totally helpful.
Thumbs up!!!

**Outstanding support By leanderbraunschweig, June 12, 2015 for WP 4.2.2**
First things first: The plugin does a great job. I needed an Instagram plugin that was flexible and lightweight enough to work in a corporate environment and am very satisfied.
But what surprised me the most was the brilliant support I got – responsive, professional and last but not least also very friendly.
Kudos Smashballoon! Thanks + keep up the good work.

**Exactly what I was looking for! By orthostice, July 4, 2015 for WP 4.2.2**
Great stuff-- there are a few other instagram gallery plugins out there, but they're not as easy to customize and, importantly, they don't get the presentation right. I don't want borders or drop shadows or to emulate what instagram's home page looks like-- I want my photos pulled from that service and displayed on my website in a way that matches the rest of my work and my other galleries. Great support, fantastic plugin!

**Incredibly good service and a super solid plugin... By skafte, July 29, 2015 for WP 4.2.3**
Incredibly good service and a super solid plugin that does exactly what you want it to do. One of my very best (plugin/theme) customer experiences ever! Thanks!

**Great support! By jillybekkers, November 24, 2015**
When I was trying something out, I bumped into a problem.
The service wasn't only super fast but also extremely helpful!
In 2 mails, they understood exactly what I wanted and fixed it.
Thanks a lot!!

**Amazing possibilities, great support By conchrisoulis, November 23, 2015 for WP 4.3.1**
I needed the Instagram Feed for the needs of my clients who are launching a baby clothes store and wanted to mirror their Instagram Feed on their front page.
The Feed is customized and works easily (via a simple link in a Page) and most importantly is provided immediate support by its creator, John, through the plug-in's WordPress support page.
Highly recommended.

**Love this plugin! By YvonneOH, November 18, 2015 for WP 4.3.1**
I had to make some adjustments to how the Instagram feed would display on my website and the support was very efficient and quick in helping me get the job done. Thanks! :)

**Best Instagram plugg! By adeb, November 17, 2015 for WP 4.3.1**
Easy to work with and customize, great pluggin!

**Fantastic Support By hugo85, November 12, 2015**
i had a problem and received a fast solution! Great Product freat Suport.

**Awesome and GREAT support! By Manyears, November 12, 2015**
This plugin is soooo goooood and the support is the best one! Support answers very fast!

**Easy to use yet flexible. By ringworld, November 11, 2015 for WP 4.3.1**
I started using this plug-in several months ago. Very impressed with the ease in set up. Also impressed that with various upgrades to WP platform this still goes on running. Great to plug-in to help consolidate your digital footprint.

**Great Support By hodori_tiger, November 10, 2015 for WP 4.3.1**
Plugin is great! Had some issues with getting the plugin to work on Win 10 and the Edge browser. Support I received from SmashBalloon was awesome.

**Fantastic customer service By bheyde, November 9, 2015 for WP 4.3.1**
Very nice, very helpful individualized customer service. So impressed.

**Awesome instagram plugin By flow__, November 9, 2015 for WP 4.3.1**
Fantastic plug with lots of options. Result: a beautiful instagram feed on your wordpress page!
Support extremely helpful, helping me to make the feed look exactly as I want. THANKS!

**Works like a charm at one... By RevistaWebVe, November 7, 2015 for WP 4.3.1**
Im so pleased with this plugin, make everything that promise and even more. I wrote to the developer asking for support and get reply fast and accurate. They are a role model in wordpress developer community. Wish you the best guys!!!

**Great plugin By rocked18, November 7, 2015 for WP 4.3.1**
Really good support on the pro version too, very happy with the Smash Balloon guys.

**Fantastic Support By SharonVL, November 4, 2015 for WP 4.3.1**
I had a problem an received a super fast response. I wish every company was this responsive. Thanks for the great product and support.
Sharon

**Love it! By leloosh, November 4, 2015 for WP 4.3.1**
Very customizable and the interface provides a straight forward way to do so. The lightbox is wonderful and their support is top notch. Highly recommended.

**Well worth buying By lhescott6, November 3, 2015 for WP 4.3.1**
Perfect. This plugin looks snappy and is really easy to set up. The support is excellent as well - I had a compatibility issue, that was sorted within an afternoon.

**Buy this plugin By joepunchteam, November 2, 2015 for WP 4.3.1**
Finally an Instagram plugin that works and is easy to use. These guys nailed it. Buy this plugin, thank them later.

**Just perfect. By parabasvat, October 31, 2015 for WP 4.3.1**
Perfect. It is responsive and very eye catching. Thanks and greetings from Greece.

**Very good. By romanbon, October 28, 2015 for WP 4.3.1**
Very good plugin that works excellent.

**Great app with amazing support! By lancegputnam, October 27, 2015**
This plugin is so easy to use and implement onto websites. The support is also amazing - I would definitely recommend this plugin!

**AMAZEBALLS! By kristinachilds, October 21, 2015 for WP 4.3.1**
I have the pro version, which is well worth it. The plugin is highly customizable, easy to use and the support team is extremely responsive, nice and *actually* helpful. 6/5 stars!!

**best! By rh41, October 16, 2015**
best instagram plugin!

**awesome plugin and fantastic support By chingchingching, October 15, 2015 for WP 4.3.1**
plugin exactly meets my need with all customised settings for both those who prefer a fancy layout or simple one! Love their really quick and responsive technical support as well!
highly recommended!

**Highly customizable with great customer service By BJIFashionGroup, October 14, 2015 for WP 4.3.1**
This plugin is awesome! We tried out many Instagram feed plugins and this is by far the best one. It is highly customizable and allows the feed to be generated using many hashtags and many usernames; it also allows many images to be hidden if they are spam/inappropriate/unnecessary for your specific feed.
A couple months into using this plugin we ran into a bit of a problem/bug with the functionality and the Smash Balloon staff was SO HELPFUL and friendly. They fixed the problem in a timely matter and were very patient with my questions.
I definitely recommend this plugin!

**Neat By BeatIdo, October 12, 2015**
Neat plugin and responsive support !

**Best Instagram Plugin By Le Claqueur de Doigts, October 10, 2015 for WP 4.3.1**
If you're looking for the best Instagram plugin, look no further.
Not only Instagram Feed is fully customizable so that you can tweak it to taste and make it fit the way that suits you best on your site, but the support team is also simply awesome.
Faster than light feedbacks, clear and detailed solutions is what you can expect from the team if you need an extra help.
By far my best experience with a support.
Thanks again David ! :)

**Does exactly what I wanted By wrightm1992, October 8, 2015**
Loving this plugin so far, works a treat and the support is really quick and helpful.

**Don't look any further By songbirdechoes, October 8, 2015 for WP 4.3.1**
Besides the fact that I am in love with this plugin which came pre-installed with my Pipdig theme, I must say the support is also great! John is fairly prompt with his responses and provides detailed and clear solutions. Look no further for the perfect Instagram plugin for your site :)

**Fantastic support By Dhruv, October 7, 2015**
Quick to revert on support and get things going!

**CSS padding By namaste364, October 7, 2015 for WP 4.3.1**
Unbelievable support!!!
As it tuned out it wasn't anything to do with the plugin, it was a problem on my site. David was so helpful and suggested a fix for it.
Very,very impressive!

**Perfect! By shashankkumar, October 7, 2015 for WP 4.3.1**
Special thanks for helping me iron out issues with my site.

**Great plugin with fantastic support! By betheroots, October 6, 2015 for WP 4.3.1**
This plugin does everything that I wanted it to do with a clean and simple design. Support was super quick and personal. Suggestions were made to deal with an issue which wasn't even caused by this plugin. Thanks :)

**Just great By antonk52, October 5, 2015 for WP 4.3.1**
Works perfect, custom attributes come in handy when integrating the feed with a multilingual site

**Stunning! By RynoDekker, September 28, 2015 for WP 4.3.1**
Absolutely amazing! So easy to use, customize and apply. I am currently on the free version, but suspect that the PRO version is on the horizon for me! Thank you so much for all the INCREDIBLE work that went into this!

**Superb plugin. Superb customer support. By michaeltakano, September 28, 2015 for WP 4.3.1**
This instagram plugin is a marvel. Super fast. Easy to configure. All features available through the settings panel AND through short-codes. This makes configuration super easy and allows for multiple and different instances of the plugin within a single site.
The customer service is fast, courteous and understanding.
Look no further for your Instagram plugin.

**Awesome Customer Service By owenow, September 28, 2015 for WP 4.3.1**
Tried the free standard edition and had a simple issue which was easily fixed due to awesome customer support from David. Have now purchased the Pro version and extremely happy.

**Works great and super helpful By omniscientlust, September 26, 2015**
Super helpful and I highly recommend, do not hesitate to contact them if you need any help, they replied to my query immediately and also followed up on it! super satisfied user

**Great support By lauravink, September 25, 2015 for WP 4.3.1**
Very detailed respons to my questions.

**Great plugin and support By NinaLee, September 22, 2015**
The plugin works fantastically, highly customizable. When I had a brief problem with it I sent an email and received a friendly response the day of, even though it was a weekend. Thanks so much!

**Great plugin with great support and service By northguide, September 21, 2015 for WP 4.3.1**
I've deployed many wordpress plugins over the years and this plugin is easily one of the best. The installation was flawless. I was able to set up my instagram feeds in minutes and able to get the look I wanted using the options in the short code with only a few, minor tweakings. I had some questions about additional capabilities and was impressed how quickly I support got back to me with some solutions. Solid performance in all aspects so far. Never been happier with a plugin purchase.

**Support that works By Petervee, September 17, 2015 for WP 4.3.1**
I've been developing with WordPress for over 5 years. I have submitted numerous support queries in the past to developers with no or very little interaction or reply. This morning I had a question for the guys at Smash Balloon and sent off a form to support. I got a personalised email back with steps on how to solve my issues. Thanks guys, your service and your plugin are amazing!
The Smash Balloon guys are ROCK STARS!

**Great product and quick support! By nayeonkim, September 16, 2015 for WP 4.3.1**
This plugin is one of the best ones out there for Instagram feed. Great product and support! I recommend this plugin.

= Instagram Platform Policy =

By using the Instagram APIs, you agree to this policy. We reserve the right to change this policy at any time without notice, so please check it regularly. Your continued use of the Instagram APIs constitutes acceptance of any changes. You also agree to and are responsible for ensuring that you comply with the Instagram Terms of Use and Instagram Community Guidelines.

We provide the Instagram APIs to support several types of apps and services. First, we provide them to help members of our community share their own content with apps or services. We also support apps and services that help brands and advertisers understand and manage their audience, develop their content strategy, and obtain digital rights. Finally, we provide the Instagram APIs to help broadcasters and publishers discover content, get digital rights to media, and share media using web embeds. The Instagram APIs are not intended for other types of apps or services. For those we do support, the following terms and information also apply:

**A. General Terms**
Ensure your app is stable and easily navigable.
Don't confuse, deceive, defraud, mislead, or harass anyone.
Be transparent about your identity and your app's identity.
Don't use the Instagram APIs for any app that constitutes, promotes or is used in connection with spyware, adware, or any other malicious programs or code.
Don't store or cache Instagram login credentials.
Follow any instructions we include in our technical documentation.
Provide meaningful customer support for your app, and make it easy for people to contact you.
Provide a publicly accessible privacy policy that tells people what you collect and how you will use this information.
If you allow third parties to serve content, including advertisements, or collect information directly from visitors, including placing or recognizing cookies on visitors' browsers, disclose this in your privacy policy.
Comply with your privacy policy.
Comply with any requirements or restrictions imposed on usage of Instagram user photos and videos ("User Content") by their respective owners. You are solely responsible for making use of User Content in compliance with owners' requirements or restrictions.
Remove within 24 hours any User Content or other information that the owner asks you to remove.
Obtain a person's consent before including their User Content in any ad.
Only store or cache User Content for the period necessary to provide your app's service.
If you store or cache User Content, keep it up to date. For example, if a user marks a photo as "private", you must reflect that change by removing the content as soon as reasonably possible.
Don't use the Instagram API to simply display User Content, import or backup content, or manage Instagram relationships, without our prior permission.
Don't apply computer vision technology to User Content, without our prior permission.
Don't participate in any "like", "share", "comment" or "follower" exchange programs.
Don't use follower information for anything other than analytics without our prior permission. For example, don't display these relationships in your app.
Only use the POST and DELETE endpoints after a business has taken an explicit action in your app requesting you to do so.
Only use the POST and DELETE likes, comments, and relationships endpoints to enable businesses to manage communication with people who have expressed interest in them. Don't use these endpoints for non-business purposes.
Ensure your comments are uniquely tailored for each person. Don't post unauthorized commercial communication or spam on Instagram.
Don't enable a business to take more than one action on Instagram at a time.
Add something unique to the community. Don't use the Instagram APIs to replicate or attempt to replace the functionality or essential user experiences of Instagram.com or any of Instagram's apps.
Respect the way Instagram looks and functions. Don't offer experiences that change it.
Don't attempt to build an ad network on Instagram.
Don't attempt to identify groups of individuals or create demographic clusters for the purpose of contacting or targeting Instagram members on or off Instagram.
Don't transfer any data that you receive from us (including anonymous, aggregate, or derived data) to any ad network, data broker, influencer network, or other advertising or monetization-related service.
You can administer a promotion on Instagram if you comply with all applicable laws and regulations, but don't directly incentivize other actions.
If you want to facilitate or promote online gambling, online real money games of skill, or online lotteries, get our written permission before using any of our products.
Don't use an unreasonable amount of bandwidth, or adversely impact the stability of Instagram.com servers or the behavior of other apps using the Instagram APIs.
Don't reverse engineer the Instagram APIs or any of Instagram's apps.
Don't sell, lease, or sublicense the Instagram APIs or any data derived through the APIs.
Comply with all applicable laws or regulations. Don't violate any rights of any person, including but not limited to intellectual property rights, rights of privacy, or rights of personality. Don't expose Instagram or people who use Instagram to harm or legal liability.

**B. Brand Assets**
Comply with Instagram's Brand Guidelines. Don't use the trademarks of Instagram or its affiliates without written permission, including as authorized by applicable brand guidelines.

**C. Things you should know**
Instagram primarily communicates with developers through email. Please ensure that the email addresses associated with your Instagram account are current and that you don't filter out these messages.
Instagram may rate limit or block apps that make a large number of calls to the API that are not primarily in response to direct user actions.
Enforcement is both automated and manual, and can include disabling your app, restricting you and your app's access to Instagram APIs, requiring that you delete data, terminating our agreements with you or any other action that we deem appropriate.
Instagram may change, suspend, or discontinue the availability of any Instagram APIs at any time. In addition, Instagram may impose limits on certain features and services or restrict your access to parts or all of the Instagram APIs or the Instagram website without notice or liability.
If Instagram elects to provide you with support or modifications for the Instagram APIs, this support may be terminated at any time without notice to you.
Instagram reserves the right to charge fees for future use of or access to the Instagram APIs.
Instagram doesn't guarantee that any Instagram APIs are free of inaccuracies, errors, bugs, or interruptions, or are reliable, accurate, complete, or otherwise valid.
Licensed Uses and Restrictions: The Instagram APIs are owned by Instagram and are licensed to you on a worldwide (except as limited below), non-exclusive, non-sublicenseable basis in accordance with these terms. Your license to the Instagram APIs continues until it is terminated by either party. Please note that User Content is owned by users and not by Instagram. All rights not expressly granted to you are reserved by Instagram.
Disclaimer of Any Warranty: Instagram APIs and all data derived through such APIs are provided "as is" with no warranty, express or implied, of any kind and Instagram expressly disclaims any and all warranties and conditions, including but not limited to, any implied warranty of merchantability, fitness for a particular purpose, availability, security, title and non-infringement. You are solely responsible for any damage that results from the use of any Instagram APIs and all any data derived through such APIs including, but not limited to, any damage to your computer system or loss of data.
Limitation of Liability: Instagram shall not, under any circumstances, be liable to you for any indirect, incidental, consequential, special or exemplary damages arising out of or in connection with use of the Instagram APIs and any data derived through such APIs, whether based on breach of contract, breach of warranty, tort (including negligence, product liability or otherwise), or any other pecuniary loss, whether or not Instagram has been advised of the possibility of such damages. Under no circumstances shall Instagram be liable to you for any amount.
Release and Waiver: To the maximum extent permitted by applicable law, you hereby release and waive all claims against Instagram, and its subsidiaries, affiliates, officers, agents, licensors, co-branders or other partners, and employees from any and all liability for claims, damages (actual and/or consequential), costs and expenses (including litigation costs and attorneys' fees) of every kind and nature, arising from or in any way related to your use of the Instagram APIs and data derived through such APIs. If you are a California resident, you waive your rights under California Civil Code 1542, which states, "A general release does not extend to claims which the creditor does not know or suspect to exist in his favor at the time of executing the release, which if known by him must have materially affected his settlement with the debtor." You understand that any fact relating to any matter covered by this release may be found to be other than now believed to be true and you accept and assume the risk of such possible differences in fact. In addition, you expressly waive and relinquish any and all rights and benefits which you may have under any other state or federal statute or common law principle of similar effect, to the fullest extent permitted by law.
Hold Harmless and Indemnify: To the maximum extent permitted by applicable law, you agree to hold harmless and indemnify Instagram and its subsidiaries, affiliates, officers, agents, licensors, co-branders or other partners, and employees from and against any third-party claim arising from or in any way related to your use of the Instagram APIs and any data derived through the APIs, including any liability or expense arising from all claims, losses, damages (actual and/or consequential), suits, judgments, litigation costs and attorneys' fees, of every kind and nature. Instagram shall use good faith efforts to provide you with written notice of such claim, suit or action.
Relationship of the Parties: Notwithstanding any provision hereof, for all purposes of the Instagram API Terms, you and Instagram shall be and act independently and not as partner, joint venturer, agent, employee or employer of the other. You don't have any authority to assume or create any obligation for or on behalf of Instagram, express or implied, and you must not attempt to bind Instagram to any contract.
Invalidity of Specific Terms: If any provision of the Instagram API Terms is found by a court of competent jurisdiction to be invalid, the parties nevertheless agree that the court should endeavor to give effect to the parties' intentions as reflected in the provision and that the other provisions remain in full force and effect.
No Waiver of Rights by Instagram: Instagram's failure to exercise or enforce any right or provision of the Instagram API Terms shall not constitute a waiver of such right or provision.

== Upgrade Notice ==

= 1.4.6 =
**Important:** Due to the recent Instagram API changes, in order for the Instagram Feed plugin to continue working after **June 1st** you must update the plugin and obtain a new Access Token on the plugin's Settings page.

== Changelog ==

= 1.4.7 =
* Fix: Fixed a security vulnerability
* Tested with upcoming WordPress 4.6 update

= 1.4.6.2 =
* Fix: Removed a comment from the plugin's JavaScript file which was causing an issue with some optimization plugins, such as Autoptimize.

= 1.4.6.1 =
* Fix: Fixed an issue with the Instagram image URLs which was resulting in inconsistent url references in some feeds

= 1.4.6 =
* **IMPORTANT: Due to the recent Instagram API changes, in order for the Instagram Feed plugin to continue working after June 1st you must obtain a new Access Token by using the Instagram button on the plugin's Settings page.** This is true even if you recently already obtained a new token. Apologies for any inconvenience.

= 1.4.5 =
* New: When you click on the name of a setting on the plugin’s Settings pages it now displays the shortcode option for that setting, making it easier to find the option that you need
* New: Added a setting to disable the Font Awesome icon font if needed. This can be found under the Misc tab at the bottom of the Customize page.
* Tweak: Updated the Instagram icon to match their new branding
* Tweak: Added a help link next to the Instagram login button in case there's an issue using it
* Fix: Updated the Font Awesome icon font to the latest version: 4.6.3

= 1.4.4 =
* Fix: Fixed an issue caused by a specific type of emoji which would cause the feed to break when used in a post
* Tweak: Added links to our other **free** plugins to the bottom of the admin pages: [The Custom Facebook Feed](https://wordpress.org/plugins/custom-facebook-feed/) and [Custom Twitter Feeds](https://wordpress.org/plugins/custom-twitter-feeds/)

= 1.4.3 =
* Fix: Important notice added in the last update is now only visible to admins

= 1.4.2 =
* New: Compatible with Instagram's new API changes effective June 1st
* New: Added video icons to Instagram posts in the feed which contain videos
* New: Added a setting to allow you to use a fixed pixel width for the feed on desktop but switch to a 100% width responsive layout on mobile
* Tweak: Added a width and height attribute to the images to help improve Google PageSpeed score
* Tweak: A few minor UI tweaks on the settings pages
* Fix: Minified CSS and JS files

= 1.3.11 =
* Fix: Fixed a bug which was causing the height of the Instagram photos to be shorter than they should have been in some themes
* Fix: Fixed an issue where when an Instagram feed was initially hidden (in a tab, for example) then the Instagram photo resolution was defaulting to 'thumbnail'

= 1.3.10 =
* Fix: Fixed an issue which was setting the visibility of some Instagram photos to be hidden in certain browsers
* Fix: The new square photo cropping is no longer being applied to Instagram feeds displaying images at less than 150px wide as the images from Instagram at this size are already square cropped
* Fix: Fixed a JavaScript error in Internet Explorer 8 caused by the 'addEventListener' function not being supported

= 1.3.9 =
* Fix: Fixed an issue where Instagram photos wouldn't appear in the Instagram feed if it was initially being hidden inside of a tab or some other element
* Fix: Fixed an issue where the new Instagram image cropping fuction was failing to run on some sites and causing the Instagram images to appear as blank

= 1.3.8 =
* Fix: If you have uploaded an Instagram photo in portrait or landscape then the plugin will now display the square cropped version of the photo in your Instagram feed

= 1.3.7 =
* Fix: Fixed an issue with double quotes in photo captions (used in the Instagram photo alt tags) which caused a formatting issue

= 1.3.6 =
* Fix: Fixed an issue introduced in version 1.3.4 which was causing theme settings to not be applied in some themes

= 1.3.5 =
* Fix: Reverted the 'prop' function introduced in the last update back to 'attr' as prop isn't supported in older versions of jQuery
* Fix: Removed the image load function as it was causing Instagram images not to be displayed for some users

= 1.3.4 =
* Fix: Used the Instagram photo caption to add a more descriptive alt tag to the Instagram photos
* Fix: Instagram photos are now only displayed once they're fully loaded
* Fix: Added a stricter CSS implementation for some elements to prevent styles being overridden by themes
* Fix: Added CSS opacity property to Instagram images to prevent issues with lazy loading in some themes
* Fix: Removed a line of code which was disabling WordPress Debug/Error Reporting. If needed, this can be disabled again by using the setting at the bottom of the plugin's 'Customize' settings page.
* Fix: Made some JavaScript improvements to the core Instagram Feed plugin code

= 1.3.3 =
* Fix: Fixed an issue with the 'Load more' button not always showing when displaying Instagram photos from multiple Instagram User IDs
* Fix: Moved the initiating sbi_init function outside of the jQuery ready function so that it can be called externally if needed by Ajax powered themes/plugins

= 1.3.2 =
* New: Added an option to disable the Instagram Feed mobile layout
* New: Added an setting which allows you to use the Instagram Feed plugin with an Ajax powered theme
* New: Added a 'class' shortcode option which allows you to add a CSS to class to each individual Instagram feed: `[instagram-feed class=feedOne]`
* New: Added a Support tab which contains System Info to help with troubleshooting
* New: Added friendly error messages which display only to WordPress admins
* New: Added validation to the Instagram User ID field to prevent usernames being entered instead of IDs
* Tweak: Made the Instagram Access Token field slightly wider to prevent tokens being copy and pasted incorrectly
* Fix: Fixed a JavaScript bug which caused the feed not to load photos correctly in IE8

= 1.3.1 =
* Fix: Fixed an issue with the Instagram icon not appearing in the 'Follow on Instagram' button or in the Instagram Feed header
* Fix: Addressed a few CSS issues which were causing some minor formatting issues in the Instagram Feed on certain themes

= 1.3 =
* New: You can now display Instagram photos from multiple Instagram User IDs. Simply separate your Instagram IDs by commas.
* New: Added an optional header to the Instagram feed which contains your Instagram profile picture, Instagram username and Instagram bio. You can activate this on the Instagram Feed Customize page.
* New: The Instagram Feed plugin now includes an 'Auto-detect' option for the Instagram Image Resolution setting which will automatically set the correct Instagram image resolution based on the size of your Instagram feed.
* New: Added an optional 'Follow on Instagram' button which can be displayed at the bottom of your Instagram feed. You can activate this on the Instagram Feed Customize page.
* New: Added the ability to use your own custom text for the 'Load More' button
* New: Added a loader icon to indicate that the Instagram photos are loading
* New: Added a unique ID to each Instagram photo so that they can be targeted individually via CSS
* Tweak: Added a subtle fade effect to the Instagram photos when hovering over them
* Tweak: Improved the responsive layout behavior of the Instagram feed
* Tweak: Improved the documentation within the Instagram Feed plugin settings pages
* Tweak: Included a link to [step-by-step setup directions](http//:smashballoon.com/instagram-feed/free/ 'Instagram feed setup directions') for the plugin
* Fix: Fixed an issue with the feed not clearing other widgets correctly

= 1.2.3 =
* Fix: Replaced the 'on' function with the 'click' function to increase compatibility with themes using older versions of jQuery

= 1.2.2 =
* Tweak: Added an initialize function to the Instagram Feed plugin
* Fix: Fixed an occasional issue with the 'Sort Photos By' option being undefined

= 1.2.1 =
* Fix: Fixed a minor issue with the Custom JavaScript being run before the Instagram photos are loaded
* Fix: Removed stray PHP notices
* Fix: Changed the double quotes to single quotes on the 'data-options' attribute

= 1.2 =
* New: Added Custom CSS and Custom JavaScript sections which allow you to add your own custom CSS and JavaScript to the Instagram Feed plugin
* New: Added an option to display your Instagram photos in random order
* New: A new tabbed layout has been implemented on the Instagram Feed plugin's settings pages
* New: Added an option to preserve your Instagram Feed settings when uninstalling the plugin
* New: Added a [Pro version](http://smashballoon.com/instagram-feed/ 'Instagram Feed Pro') of the Instagram Feed plugin which allows you to display Instagram photos by hashtag, display Instagram captions, view Instagram photos in a pop-up lightbox, show the number of Instagram likes & comments and more
* Tweak: The 'Load More' button now automatically hides if there are no more Instagram photos to load
* Tweak: Added a small gap to the top of the 'Load More' button
* Tweak: Added a icon to the Instagram Feed menu item

= 1.1.6 =
* Fix: A maximum width is now only applied to the Instagram feed when the Instagram photos are displayed in one column

= 1.1.5 =
* Fix: Added a line of code which enables shortcodes to be used in widgets for themes which don't have it enabled

= 1.1.4 =
* Fix: Fixed an issue with the Instagram Access Token and Instagram User ID retrieval functionality in certain web browsers

= 1.1.3 =
* Fix: Fixed an issue with the maximum Instagram image width
* Fix: Corrected a typo in the Instagram Feed Shortcode Options table

= 1.1.1 =
* Pre-tested for the upcoming WordPress 4.0 update
* Fix: Fixed an uncommon issue related to the output of the Instagram content

= 1.1 =
* New: Added an option to set the number of Instagram photos to be initially displayed
* New: Added an option to show or hide the 'Load More' button
* New: Added 'Step 3' to the Instagram Feed Settings page explaining how to display your feed using the [instagram-feed] shortcode
* New: Added a full list of all available Instagram Feed shortcode options to help you if customizing multiple Instagram feeds

= 1.0.2 =
* Fix: Fixed an issue with the Instagram login URL on the plugin's Instagram Feed Settings page

= 1.0.1 =
* Fix: Fixed an issue with the Instagram Feed 'Load More' button opening an empty browser window in Firefox

= 1.0 =
* Launched the Instagram Feed plugin!