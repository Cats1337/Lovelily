Using the wp-content/themes/lovelily_theme_fixed.zip

The actual website is in /cp

Admin credientials are in the text from Jess

Change the email to whatever

If you have any questions let me know/pester Jess who'll then bug me


ClassicPress › ReadMe 

[ClassicPress ReadMe](https://www.classicpress.net/)
====================================================

The CMS for Creators.  
Stable. Lightweight. Instantly Familiar.

Welcome to ClassicPress!
------------------------

You’ve just become part of a growing community of people who value the firm foundation WordPress provides for websites everywhere. [Guided by our community](https://www.classicpress.net/governance/), we can leverage our collective expertise to maintain and develop the ClassicPress platform as _the_ content management system of choice for professionals, hobbyists, developers, sole-traders and _all_ website creators worldwide.

Our purpose is to provide a stable, secure, and instantly familiar content management system driven by the needs of the community. We invite you to connect with us and [add your voice to the conversation.](#resources).

Installation
------------

For more information about installing ClassicPress, see our [installation documentation](https://docs.classicpress.net/installing-classicpress/).

1.  Download the latest release of ClassicPress from our [releases page](https://link.classicpress.net/releases/).
2.  Unzip the package in an empty directory and upload all the files to your server using a remote connection method such as SSH, SFTP, or FTP.
3.  Open [wp-admin/install.php](wp-admin/install.php) in the browser. It will take you through the process to set up a `wp-config.php` file with the database connection details.
    1.  If for some reason this doesn’t work: Open up `wp-config-sample.php` with a text editor and fill in the database connection details.
    2.  Save the file as `wp-config.php` and upload it.
    3.  Open [wp-admin/install.php](wp-admin/install.php) in the browser.
4.  Once the configuration file is set up, the installer will set up the tables needed for the website. If there is an error, double check the `wp-config.php` file, and try again. If it fails again, please go to the [support forums](https://forums.classicpress.net/c/support "ClassicPress support") with as much data as you can gather.
5.  **If you did not enter a password, note the password given to you.** If you did not provide a username, it will be `admin`.
6.  The installer should then go to the [login page](wp-login.php). Sign in with the username and password you chose during the installation. If a password was generated, it is possible to change it by clicking on the username in the top right corner after signing in. It is also possible to reach this Profile page by navigating to “Users” in the sidebar navigation and then selecting “Your Profile” from the sub-menu.

Updating
--------

### Automatic Updater

1.  Open [wp-admin/update-core.php](wp-admin/update-core.php) in your browser and follow the instructions.
2.  That’s it!

### Updating Manually

Updating manually can be done via remote connection methods such as SFTP (preferred) or FTP.

For more information, see our [manual update documentation](https://docs.classicpress.net/updating-classicpress/#updating-classicpress-manually).

1.  Before doing anything, **make sure you have a working backup of the entire site as well as the database**.
2.  Download the latest release of ClassicPress from our [releases page](https://link.classicpress.net/releases/).
3.  On your **local computer**, unzip the ClassicPress release file into a directory.
4.  On your **local computer**, remove the `wp-config-sample.php` file and the `wp-content` directory.
5.  Upload what's left over to your server, replacing the existing files (using either SSH or an application that connects over SFTP or FTP).
6.  Point the browser to [/wp-admin/upgrade.php](wp-admin/upgrade.php) and follow the instructions.

Migrating from WordPress
------------------------

With the ClassicPress migration plugin, it is very easy to migrate existing sites from WordPress to ClassicPress. Please follow the [migration documentation](https://docs.classicpress.net/installing-classicpress/#migrate-classicpress) for step-by-step instructions.

System Requirements
-------------------

*   [PHP](https://secure.php.net/) version **7.4** or greater.
*   [MySQL](https://www.mysql.com/) version **5.7** or greater, or MariaDB version **10.4** or greater.
*   [Apache](https://httpd.apache.org/), [Nginx](https://nginx.org/en/), [LiteSpeed](https://www.litespeedtech.com/) or another web server that supports PHP and MySQL/MariaDB.

### Recommended Setup

*   [PHP](https://secure.php.net/) version **8.3** or greater.
*   [MySQL](https://www.mysql.com/) version **5.7** or greater, or [MariaDB](https://mariadb.org/) version **10.4** or greater.
*   [Apache](https://httpd.apache.org/) with `mod_rewrite` module, [Nginx](https://nginx.org/en/), or [LiteSpeed](https://www.litespeedtech.com/) server.
*   An SSL certificate to support HTTPS (free from [Let’s Encrypt](https://letsencrypt.org/)).

Online Resources
----------------

If you have any questions that aren’t addressed in this document, please take advantage of ClassicPress’ numerous online resources:

[ClassicPress Homepage](https://www.classicpress.net/)

This is the starting point, with basic information about ClassicPress and links to all other resources in this list.

[ClassicPress Documentation](https://docs.classicpress.net/)

Here you'll find up-to-date reference information about ClassicPress.

[ClassicPress Blog](https://www.classicpress.net/blog/)

This is where you’ll find the latest updates and news related to ClassicPress as well as tutorials and other interesting snippets of information. Recent ClassicPress news appears in your administrative dashboard by default.

[ClassicPress Support Forums](https://forums.classicpress.net/c/support)

The support forums are a great way to get help from other ClassicPress users. Many community members and ClassicPress leaders are active here.

[ClassicPress Zulip Chat](https://www.classicpress.net/join-zulip/)

There is an active online chat channel that is used for discussion among people who use ClassicPress and plan its further development.

[ClassicPress Feature Requests](https://github.com/ClassicPress/ClassicPress/issues/new/choose)

Do you have an idea to make ClassicPress better? Consider sharing your idea on GitHub for the core team and the community to share feedback and, possibly, implement the feature.

[ClassicPress Governance](https://www.classicpress.net/governance/)

Last but not least, read about the ClassicPress governance structure to understand how we do things and how you can help. ClassicPress is a community-driven and funded fork of WordPress that enables all stakeholders to shape the direction that the project takes. This page aims to explain how we handle this process to ensure that power doesn't become centralised and that every voice can be heard.

Help Promote ClassicPress
-------------------------

ClassicPress has no multi-million dollar marketing campaign or celebrity sponsors, but we do have something even better: you and the rest of our community. If you enjoy ClassicPress, please consider:

*   Participating in our [forums](https://forums.classicpress.net/).
*   Telling a friend about ClassicPress or sharing it on social media.
*   Setting up a ClassicPress website for someone less knowledgeable than yourself.
*   Writing a blog post about why you chose to use ClassicPress for your website.
*   Writing to WordPress plugin and theme developers to ask them to support ClassicPress.

Community Funding
-----------------

ClassicPress is a community-driven and funded free, open-source project managed by 501(c)3 non-profit ClassicPress Initiative.

You contributions help ClassicPress pay infrastructure and administrative costs. There are several ways you can financially support ClassicPress:

*   [Making a donation](https://opencollective.com/classicpress) to help us run the project (donations in the US are tax-deductible).
*   [Become a sponsor](https://www.classicpress.net/sponsors/) to promote your business to ClassicPress community.
*   Visit [ClassicPress brand store](https://link.classicpress.net/merchandise/) to buy ClassicPress-branded merchandise to show your support.

Credits
-------

ClassicPress v2.0 is a hard fork of the [WordPress 6.2 branch](https://wordpress.org/download/releases/). WordPress itself is a fork of b2/cafélog from Michel Valdrighi.

License
-------

ClassicPress is free software, and is released under the terms of the GPL version 2 or (at your option) any later version. See [license.txt](license.txt).