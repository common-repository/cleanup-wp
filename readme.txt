=== CleanUp WP ===
Contributors: kuckovic
Tags: remove, demo, content, fresh, install, robots, permalinks, menu, clean, simple
Requires at least: 4.0
Tested up to: 4.9.5
=======
Tested up to: 4.9
>>>>>>> .r1874238
Stable tag: 4.3
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Removes all premade content, sets robots.txt, creates a default navigation and more! One click, and you're done!

== Description ==

When you setup WordPress on a new website, you always have to do some tasks before you can start writing your content, or designing the next big website. CleanUp WP can do all the prep-work for you!

When you install and activate the plugin, it will do the following tasks:

*   Removes default post and page (Hello World and Example page)
*   Sets up your permalinks, so they look prettier
*   Deletes the "Hello Dolly" plugin
*   Deletes "Akismet" plugin
*   Deletes all unused themes - only keeps the active one
*   Removes all widgets from the sidebar(s)
*   Creates a "Main Menu" and a link to "Home"
*   Activates Robots.txt

**New in 1.3**

* Removes "Akismet Plugin" from Plugin directory


**IMPORTANT!** 

* Do **NOT** use this plugin on an fully functional WordPress site with content etc.
* Do **NOT** forget to delete the plugin after it's done!

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/` directory, or install the plugin through the WordPress controlpanel.
2. Activate the plugin - and it will perform the tasks above
3. Once the plugin is done, **you should** delete it.

== Screenshots ==

== Changelog ==

= 1.0 =
* Initial version of the plugin

= 1.1 =
* Corrected the name of the plugin

= 1.2 =
* Disables user registration by default
* Renames "Uncategorized" category to "News"
* Disables commenting by default

= 1.2.1 =
* Updated ReadMe.txt

= 1.2.2 =
* Now the plugin is checking whether you're using a child-theme or not. If so, the plugin will not delete any themes.

= 1.3 =
* Removes "Akismet Plugin" from Plugin directory