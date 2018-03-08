=== Page-list ===
Contributors: webvitaly
Donate link: http://web-profile.net/donate/
Tags: page, page-list, pagelist, sitemap, subpages, siblings
Requires at least: 3.0
Tested up to: 5.0
Stable tag: 5.1
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html

[pagelist], [subpages], [siblings] and [pagelist_ext] shortcodes

== Description ==

> **[Silver Bullet Pro](http://codecanyon.net/item/silver-bullet-pro/15171769?ref=webvitalii "Speedup and protect WordPress in a smart way")** |
> **[Page-list](http://web-profile.net/wordpress/plugins/page-list/ "Plugin page")** |
> **[all Page-list params](http://wordpress.org/plugins/page-list/other_notes/ "Page-list params")** |
> **[Donate](http://web-profile.net/donate/ "Support the development")** |
> **[GitHub](https://github.com/webvitalii/page-list "Fork")**

= shortcodes: =

* **[pagelist]** - hierarchical tree of all pages on site (useful to show sitemap of the site);
* **[subpages]** - hierarchical tree of subpages to the current page;
* **[siblings]** - hierarchical tree of sibling pages to the current page;
* **[pagelist_ext]** - list of pages with featured image and with excerpt;

= examples with aditional parameters: =

* `[pagelist child_of="4" depth="2" exclude="6,7,8"]`
* `[pagelist_ext child_of="4" exclude="6,7,8" image_width="50" image_height="50"]`
* **[all Page-list params](http://wordpress.org/plugins/page-list/other_notes/ "Page-list params")**

= Useful: =
* **[Silver Bullet Pro - Speedup and protect WordPress in a smart way](http://codecanyon.net/item/silver-bullet-pro/15171769?ref=webvitalii "Speedup and protect WordPress in a smart way")**
* **[Anti-spam Pro - Block spam in comments](http://codecanyon.net/item/antispam-pro/6491169?ref=webvitalii "Block spam in comments")**


== Other Notes ==

= Parameters for [pagelist], [subpages] and [siblings]: =
* **[pagelist]** - list of all pages as the hierarchical list;
* **[subpages]** - list of subpages to the current page as the hierarchical list; Same as: `[pagelist child_of="current"]`;
* **[siblings]** - list of sibling pages to the current page as the hierarchical list; Same as: `[pagelist child_of="parent"]`;
* **depth** - how many levels in the hierarchy of pages are to be included in the list: `[pagelist depth="3"]`; by default depth is unlimited (depth="0"); Displays pages at any depth and arranges them in a flat list: `[pagelist depth="-1"]`;
* **child_of** - displays the sub-pages of a single Page by ID: `[pagelist child_of="4"]`;
* **exclude** - define a comma-separated list of Page IDs to be excluded from the list: `[pagelist exclude="6,7,8"]`; You may exclude current page: `[pagelist exclude="current"]`;
* **exclude_tree** - define a comma-separated list of parent Page IDs and all its subpages to be excluded: `[pagelist exclude_tree="7,10"]`;
* **include** - include a comma-separated list of Page IDs into the list: `[pagelist include="6,7,8"]`;
* **title_li** - set the text and style of the Page list's heading: `[pagelist title_li="<h2>List of pages</h2>"]`; by default there is no title (title_li="");
* **authors** - only include pages authored by the authors in this comma-separated list of author IDs: `[pagelist authors="2,5"]`; by default all authors are included (authors="");
* **number** - sets the number of pages to display: `[pagelist number="10"]`; by default the number is unlimited (number="");
* **offset** - the number of pages to pass over (or displace) before collecting the set of pages: `[pagelist offset="5"]`; by default there is no offset (offset="");
* **post_type** - list associated with a certain hierarchical Post Type `[pagelist post_type="page"]`; by default: (post_type="page"); possible values: page, revision, Hierarchical Custom Post Types ('post' is not a Hierarchical Post Type);
* **post_status** - a comma-separated list of all post status types: `[pagelist post_status="private"]`; by default: (post_status="publish"); possible values: publish, private, draft;
* **meta_key** and **meta_value** - only include the pages that have this Custom Field Key and this Custom Field Value: `[pagelist meta_key="metakey" meta_value="metaval"]`;
* **show_date** - display creation or last modified date next to each Page: `[pagelist show_date="created"]`; possible values: created, modified, updated;
* **date_format** - the format of the Page date set by the show_date parameter: `[pagelist date_format="l, F j, Y"]`; by default use the date format configured in your WordPress options;
* **sort_column** - sort the list of pages by column: `[pagelist sort_column="menu_order"]`; by default: (sort_column="menu_order, post_title"); possible values: post_title, menu_order, post_date (sort by creation time), post_modified, ID, post_author, post_name (sort by page slug);
* **sort_order** - the sort order of the list of pages (either ascending or descending): `[pagelist sort_order="desc"]`; by default: (sort_order="asc"); possible values: asc, desc;
* **link_before** - sets the text or html that precedes the link text inside link tag: `[pagelist link_before="<span>"]`; you may specify html tags only in the `HTML` tab in your Rich-text editor;
* **link_after** - sets the text or html that follows the link text inside link tag: `[pagelist link_after="</span>"]`; you may specify html tags only in the `HTML` tab in your Rich-text editor;
* **class** - the CSS class for list of pages: `[pagelist class="listclass"]`; by default the class is empty (class="");
* columns - for splitting list of pages into columns: `[pagelist class="page-list-cols-2"]`; available classes: page-list-cols-2, page-list-cols-3, page-list-cols-4, page-list-cols-5; works in all modern browsers and IE10+; columns are responsive and become 1 column at less than 768px;

More [info about params](http://codex.wordpress.org/Function_Reference/wp_list_pages#Parameters) for [pagelist], [subpages], [siblings].

= Parameters for [pagelist_ext]: =
* **[pagelist_ext]** - by default shows list of subpages to current page; but if there is no subpages than all pages will be shown;
* **show_image** - show or hide featured image `[pagelist_ext show_image="0"]`; "show_image" have higher priority than "show_first_image"; by default: show_image="1";
* **show_first_image** - show or hide first image from content if there is no featured image `[pagelist_ext show_first_image="1"]`; by default: show_first_image="0";
* **show_title** - show or hide title `[pagelist_ext show_title="0"]`; by default: show_title="1";
* **show_content** - show or hide content `[pagelist_ext show_content="0"]`; by default: show_content="1";
* **more_tag** - output all content before and after more tag: `[pagelist_ext more_tag="0"]`; this parameter does not add "more-link" to the end of content, it just cut content before more-tag; "more_tag" parameter have higher priority than "limit_content"; by default the more_tag is enabled (more_tag="1") and showing only content before more tag;
* **limit_content** - content is limited by "more-tag" if it is exist or by "limit_content" parameter `[pagelist_ext limit_content="100"]`; by default: limit_content="250";
* **image_width** - width of the image `[pagelist_ext image_width="80"]`; by default: image_width="50";
* **image_height** - height of the image `[pagelist_ext image_height="80"]`; by default: image_height="50";
* **child_of** - displays the sub-pages of a single Page by ID: `[pagelist_ext child_of="4"]`; by default it shows subpages to the current page;
* **parent** - list those pages that have the provided single page only ID as parent: `[pagelist_ext parent="4"]`; by default parent="-1" and depth is unlimited;
* **sort_column** - sort the list of pages by column: `[pagelist_ext sort_column="menu_order"]`; by default: (sort_column="menu_order, post_title"); possible values: post_title, menu_order, post_date (sort by creation time), post_modified, ID, post_author, post_name (sort by page slug);
* **sort_order** - the sort order of the list of pages (either ascending or descending): `[pagelist_ext sort_order="desc"]`; by default: (sort_order="asc"); possible values: asc, desc;* **hierarchical** - display subpages below their parent page `[pagelist_ext hierarchical="0"]`; by default: hierarchical="1";
* **hierarchical** - display subpages below their parent page `[pagelist_ext hierarchical="0"]`; by default: hierarchical="1";
* **exclude** - define a comma-separated list of Page IDs to be excluded from the list: `[pagelist_ext exclude="6,7,8"]`;
* **exclude_tree** - define a comma-separated list of parent Page IDs and all its subpages to be excluded: `[pagelist_ext exclude_tree="7,10"]`;
* **include** - include a comma-separated list of Page IDs into the list: `[pagelist_ext include="6,7,8"]`;
* **meta_key** and **meta_value** - only include the pages that have this Custom Field Key and this Custom Field Value: `[pagelist_ext meta_key="metakey" meta_value="metaval"]`;
* **authors** - only include the pages written by the given author(s) `[pagelist_ext authors="6,7,8"]`;
* **number** - sets the number of pages to display: `[pagelist_ext number="10"]`; by default the number is unlimited (number="");
* **offset** - the number of pages to pass over (or displace) before collecting the set of pages: `[pagelist_ext offset="5"]`; by default there is no offset (offset="");
* **post_type** - list associated with a certain hierarchical Post Type `[pagelist_ext post_type="page"]`; by default: (post_type="page"); possible values: page, revision, Hierarchical Custom Post Types ('post' is not a Hierarchical Post Type);
* **post_status** - a comma-separated list of all post status types: `[pagelist_ext post_status="private"]`; by default: (post_status="publish"); possible values: publish, private, draft;
* **class** - the CSS class for list of pages: `[pagelist_ext class="listclass"]`; by default the class is empty (class="");
* **strip_tags** - strip tags or not: `[pagelist_ext strip_tags="0"]`; by default the tags are stripped (strip_tags="1");
* **strip_shortcodes** - strip registered shortcodes or not: `[pagelist_ext strip_shortcodes="0"]`; by default shortcodes are stripped (strip_shortcodes="1") and all registered shortcodes are removed;
* **show_child_count** - show count of subpages: `[pagelist_ext show_child_count="1"]`; by default the child_count is disabled (show_child_count="0"); If show_child_count="1", but count of subpages=0, than child count is not shown;
* **child_count_template** - the template of child_count: `[pagelist_ext show_child_count="1" child_count_template="Subpages: %child_count%"]`; by default child_count_template="Subpages: %child_count%";
* **show_meta_key** - show or hide meta key: `[pagelist_ext show_meta_key="your_meta_key"]`; by default the show_meta_key is empty (show_meta_key=""); If show_meta_key is enabled, but meta_value is empty, than meta_key is not shown;
* **meta_template** - the template of meta: `[pagelist_ext show_meta_key="your_meta_key" meta_template="Meta: %meta%"]`; by default meta_template="%meta%";
* columns - for splitting list of pages into columns: `[pagelist_ext class="page-list-cols-2"]`; available classes: page-list-cols-2, page-list-cols-3, page-list-cols-4, page-list-cols-5; works in all modern browsers and IE10+;  columns are responsive and become 1 column at less than 768px;

More [info about params](http://codex.wordpress.org/Function_Reference/get_pages#Parameters) for [pagelist_ext].

== Frequently Asked Questions ==

= How to show the list of posts? =

To show list of posts you can use [List Category Posts](http://wordpress.org/plugins/list-category-posts/) plugin.

= On what functions shortcodes are based? =

Shortcodes [pagelist], [subpages], [siblings] are based on [wp_list_pages()](http://codex.wordpress.org/Template_Tags/wp_list_pages) function.
Shortcode [pagelist_ext] is based on [get_pages()](http://codex.wordpress.org/Function_Reference/get_pages) function.

= What is the difference between [pagelist], [subpages] and [siblings]? =

Shortcodes [pagelist], [subpages] and [siblings] accept the same parameters. The only difference is that [subpages] and [siblings] not accept `child_of` parameter, because [subpages] shows subpages to the current page and [siblings] shows subpages to the parent page.

= How to create sitemap.xml? =
To create sitemap.xml you can use [Google XML Sitemaps](http://wordpress.org/plugins/google-sitemap-generator/) plugin.

= Is there "more-link" feature in the plugin? =
No, there is no "more-link" feature in the plugin. Because "[more-link](http://web-profile.net/web/web-principles/more-link/ "do not use more-link")":

* **bad for SEO.** Nobody will search your site with the word "more". "rel=nofollow" will not solve it too.
* **bad for usability.** There is already link on title and "more-link" is an extra no needed element on page. If user cannot understand that the title is the link, than there is a problem in css styles and not in plugin's templates.

= What to do if you need to change the plugin's code? =
When you changed the plugin's code you should also change the plugin's version to '100' (for example) to avoid updates, which could override and delete your code.

== Screenshots ==

1. [pagelist] shortcode
2. [pagelist_ext] shortcode

== Changelog ==

= 5.1 - 2015.07.01 =
* added columns feature

= 5.0 - 2015.01.25 =
* code refactoring
* update docs
* added 'authors', 'post_type', 'post_status', 'date_format' params to [pagelist], [subpages], [siblings] shortcodes (thanks to Nick Ciske)

= 4.3 - 2015.01.15 =
* use wp_enqueue_scripts hook instead of wp_print_styles to enqueue scripts and styles (thanks to sireneweb)

= 4.2 - 2013.02.16 =
* fix in css styles (clearfix added to .page-list-ext)
* make default image size 150x150 like default thumbnail size

= 4.1 - 2013.01.27 =
* change the type of output the image thumbnail in [pagelist_ext] shortcode

= 4.0 - 2012.10.30 =
* remove conflict between Pagelist and Sitemap plugins
* remove preg_match_all notice
* minor changes

= 3.8 =
* fixed default [pagelist_ext] behaviour - showing all pages if there is no subpages

= 3.7 =
* executing shortcodes in [pagelist_ext  strip_shortcodes="0"] in content

= 3.6 =
* fixing bug with shortcode in sidebar - shortcode in comment start to execute

= 3.5 =
* showing all pages for [pagelist_ext child_of="0"] shortcode

= 3.4 =
* remove esc_attr() from title in [pagelist_ext] shortcode

= 3.3 =
* rename "get_first_image" function to "page_list_get_first_image" for avoiding conflicts

= 3.2 =
* fixed bug with "more_tag" and non english chars

= 3.1 =
* fixed bug with empty image in "show_first_image" parameter
* added "more_tag" higher priority than "limit_content" (thanks to BobyDimitrov)

= 3.0 =
* added "show_first_image" parameter for showing first image from content if there is no featured image

= 2.9 =
* added "more_tag" parameter and more tag support
* hiding password protected content of the pages

= 2.8 =
* added "strip_shortcodes" parameter

= 2.7 =
* make excerpt link if there is no title

= 2.6 =
* fixed [pagelist_ext] "parent" parameter

= 2.5 =
* adding spaces between lines when tags are stripped in [pagelist_ext]

= 2.4 =
* escaping attributes in title in [pagelist_ext]

= 2.3 =
* fixed [pagelist_ext] with showing excerpt of the page if it is not empty, else showing content

= 2.2 =
* fixed offset parameter

= 2.1 =
* fixed number parameter

= 2.0 =
* fixed crash bug with [pagelist_ext] if theme does not have thumbnail feature

= 1.9 =
* added show_child_count parameter
* added show_meta_key parameter

= 1.8 =
* added screenshots
* improved parameter parsing

= 1.7 =
* added strip_tags parameter

= 1.6 =
* improved [pagelist_ext] shortcode: added content to list, added toggle show and limit content parameters

= 1.5 =
* added [pagelist_ext] shortcode - list of pages with featured image

= 1.4 =
* added exclude="current" parameter

= 1.3.0 =
* added class to ul elements by default
* added "class" option (thanks to Arvind)

= 1.2.0 =
* added [subpages] and [siblings] shortcodes

= 1.0.0 =
* initial release

== Installation ==

1. install and activate the plugin on the Plugins page
2. add shortcodes to pages: `[pagelist]`, `[subpages]`, `[siblings]`, `[pagelist_ext]`
