MASK WordPress Theme Framework
================================
<img align="right" src="https://raw.github.com/micalexander/mask/master/screenshot.png" alt="mask">

A transparent starter theme for WordPress forked from <a href="http://kylelarkin.com/" target="_blank">Kyle Larkin</a> and <a href="http://astockwell.com/" target="_blank">Alex Stockwell's</a> KL[AS] framework and re-imagined by <a href="http://micalexander.com/" target="_blank">Mic Alexander</a>.

The Sass folder structure has been removed in-favor of using "trident" to handle Sass, Compass, and Bower. More on this coming soon...

This theme has been modified to work closely with <a href="https://github.com/micalexander/obi" target="_blank">Obi</a>, a project management tool that simplifies WordPress development.

## Installation
1. Copy the repository to your /wp-content/themes folder
2. Move .htaccess and wp-config.php files out of the theme folder and into the wordpress root directory
3. Update your wp-config.php file as usual (add db credentials, salts, etc)
4. Refresh your permalinks

**Note for Shared Hosting:** The line `Options All -Indexes` in .htaccess may cause 4xx/5xx errors site-wide on some shared servers. Please remove this line if necessary.

## Usage
1. The `wp-config.php` file is intended for use with the following 3 project lifecycle environments, with the following naming conventions:
  - Development: [optional.]example.dev. Regex will detect this for you automagically.
  - Staging: any URL structure you'd like, e.g. preview.example.com. **You must define this in the `wp-config.php` file on line 23**.
  - Production: any URL, e.g. example.com. This is the default and the file will fallback to these credentials if the Development/Staging conditions aren't met.

## Taking inspiration from:
- [HTML5 Boilerplate](http://html5boilerplate.com/)
- [Starkers](http://viewportindustries.com/products/starkers/)
- [Roots](http://www.rootstheme.com/)
- [_s](https://github.com/Automattic/_s)
