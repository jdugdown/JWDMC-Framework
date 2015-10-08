JWDMC-Framework
===============

Starter Theme for JWDMC Websites


##Changelog
###1.7.1
- Fixed login logo styling
- Added [Simple 301 Redirects](https://wordpress.org/plugins/simple-301-redirects/) to recommended plugins
- Removed [BruteProtect](https://wordpress.org/plugins/bruteprotect/) from recommended plugins
- Updated Slick to v1.5.7

###1.7.0
- Added [WooCommerce](https://wordpress.org/plugins/woocommerce/) and [Regenerate Thumbnails](https://wordpress.org/plugins/regenerate-thumbnails/) to array of TGM plugins
- Updated code to more closely follow [WordPress Coding Standards](https://codex.wordpress.org/WordPress_Coding_Standards)
- Removed full width template

###1.6.0
- Updated Bootstrap to v3.3.5
- Bootstrap files now served via CDN
- Replaced FlexSlider with [Slick](http://kenwheeler.github.io/slick/)
- Introduced [TGM Plugin Activation](https://github.com/TGMPA/TGM-Plugin-Activation) to streamline initial setup
- Moved custom login logo to style-login.css
- Various bug fixes

###1.5.5
- Reworked filter to change Gravity Forms buttons introduced in v1.5.0

###1.5.4
- Fixed typo in editor-style.css

###1.5.3
- Updated Flexslider to v2.4.0

###1.5.2
- Added filters for Next/Previous buttons in multi-page forms
- Added WooCommerce theme support declaration, no need to do this manually anymore
- Fixed column break point issue on a few page templates
- Updated the default copyright and credit in footer.php to more closely reflect the usual stuff we get from design
- Added rules for 5 even columns
- Added top margin to headings that come after paragraphs
- Updated editor-style.css for consistency

###1.5.1
- Fixed JS error caused by new smooth scrolling stuff in scripts.js

###1.5.0
- Updated Bootstrap to v3.3.4
- Added filter to change the default Gravity Forms submit button into a button element (Thanks Ollie)
- Fixed footer link spacing (Thanks Ollie)
- Changed menu containers to <code><nav></code> elements
- Added code to scripts.js to enable smooth scrolling to a <code>div</code> when linking to its ID
- Cleaned up several files, removed semantic elements where they were not needed
- Began adding Schema.org markup where applicable
- Added screen reader label to hamburger

###1.4.1
- Removed default favicon stuff from header.php

###1.4.0
- Cleaned up formatting in functions.php
- Added <code>if</code> statement to register and enqueue flexslider styles and script as they should only be loaded on pages with a flexslider (be sure to update with page IDs during code review)
- Moved JS to footer
- Removed homepage template jumbotron
- Added basic styling to footer links so they fall inline
- Updated Bootstrap to v3.3.2
- Updated FontAwesome to v4.3.0 and moved to functions.php so it can be inserted using <code>wp_head();</code>

###1.3.0
- Added .no-gutters class to use on your .row to remove the 15px padding on each side of contained columns
- Cleaned up scripts.js
- Cleaned up page templates
- Cleaned up sidebar code
- Removed page-left-sidebar.php because no one uses it
- Removed unused images left over from defunct theme options framework
- Updated default favicon metas
- Added theme-color meta to head (Android 5.0+) because we're just so bleeding edge around here
- Added function to move Yoast meta box to low priority because it's annoying
- Updated Modernizr to v2.8.3
- Updated Bootstrap to v3.3.1

###1.2.0
- Added common alignment classes to style.css
- Fixed some formatting erros in style.css
- Fixed typo in full-width page template

###1.1.0
- Updated Bootstrap files to v3.3.0
- Added basic styles to style.css
- Added Flexslider files
- Removed unused files

###1.0.0
- Initial Commit