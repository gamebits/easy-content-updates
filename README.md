# Easy Updates for Old Content 

> Your site has been running on auto-pilot for years. Its theme has been retired, the site looks dated, and it’s impossible to navigate on mobile. You want to switch the theme... but new themes use excerpts, featured images, and blocks, none of which your old posts do. Never fear — with the tools and strategies outlined in this talk, you can quickly and easily give your old content everything it needs to look modern and slick. ([WordCamp Rochester 2023](https://rochester.wordcamp.org/2023/session/an-easy-update-for-old-content/)\)

The contents of this repo are provided by me as an individual, not as a representative of Automattic. No guarantees, express or implied, are provided as to the use and consequences of this code. As always, take a backup first.

## Featured Images
Featured images were introduced in [WordPress 2.9](https://wordpress.org/news/2009/12/wordpress-2-9/), released December 2009. Many themes display the featured image at the top of the post, in category archives, on the homepage, in SEO snippets, and elsewhere. If you do not have a featured image assigned to each post, the absence can be glaring.

If there are images in the body of your post, this script will find the first one and assign it as the featured image. Posts that already have featured images will be skipped.

Choose only one of the following three ways to run this script:

* `fix-featured-images.code-snippets.json`: Import this file into [WPCode](https://wordpress.org/plugins/insert-headers-and-footers/) and run it once.
* `fix-featured-image-code-snippet.php`: Upload this file to your WordPress directory and use the WP-CLI command `wp eval-file` to execute it.
* `fix-featured-image-code-snippet.zip`: Install this plugin, activate it, then deactivate and uninstall.

This script was adapted with permission from [Newspack](https://newspack.com/)'s internal tooling.

## Excerpts

Excerpts have been present since the first release of WordPress ([v0.7](https://wordpress.org/news/2003/05/wordpress-now-available/)) in May 2003. But not all themes have used excerpts in a meaningful way — and, in the absence of a manually crafted excerpt, one will be automatically generated from the beginning of the post body. As a result, many early bloggers overlooked this field entirely, creating technical debt that now needs to be addressed.

But if you've paid more attention to SEO than to excerpts, then you're in luck! This script will take the SEO descriptions you've already written and will repurpose them for the theme excerpt. It defaults to using information from [Yoast](https://wordpress.org/plugins/wordpress-seo/) first; if none is present, it will look for [All In One SEO](https://wordpress.org/plugins/all-in-one-seo-pack/) (AIOSEO) next. Posts that already have excerpts will be skipped.

Choose only one of the following three ways to run this script:

* `seo-to-excerpt.code-snippets.json`: Import this file into [WPCode](https://wordpress.org/plugins/insert-headers-and-footers/) and run it once.
* `seo-to-excerpt.php`: Upload this file to your WordPress root directory (the same location as `wp-load.php`) and run it with the WP-CLI command `wp eval-file`.
* `seo-to-excerpt.zip`: Install this plugin, activate it, then deactivate and uninstall.

While post excerpts and SEO descriptions serve slightly different purposes, you may find it helpful to set [Yoast](https://yoast.com/help/list-available-snippet-variables-yoast-seo/#basic-variables) or [AIOSEO](https://aioseo.com/docs/all-in-one-seo-pack-advanced-settings/#use-content-for-autogenerated-descriptions) to use your excerpt as the default SEO description going forward; should you ever forget to write an SEO description, at least there will be something in that field.

This script was adapted from a [StackExchange answer](https://wordpress.stackexchange.com/a/71014) by [Rodolfo Buaiz](https://profiles.wordpress.org/brasofilo/).

## Block Conversion
The block editor, codenamed Gutenberg, was introduced in December 2018 with [WordPress 5.0](https://wordpress.org/news/2018/12/bebo/). Content written before this (or with the [Classic Editor](https://wordpress.org/plugins/classic-editor/) plugin) will display as one large classic block. The editor will provide the option to "Convert to Blocks" — but this must be done on a per-post basis.

If you want to convert all your old content to blocks en masse, Newspack's [Custom Content Migrator](https://github.com/Automattic/newspack-content-converter/releases) automates this process to a degree. When run (ideally in Chrome), it will open each post one-by-one, convert it to blocks, and save it. See [that plugin's readme file](https://github.com/Automattic/newspack-content-converter/blob/master/README.md) for more details about operation and options.

If you prefer to convert posts yourself, the 10up plugin [Convert to Blocks](https://wordpress.org/plugins/convert-to-blocks/) can provide some assistance with this process:

> When an editor goes to edit a classic post, the content will be parsed into blocks. When the editor saves the post, the new structure will be saved into the database. This strategy reduces risk as you are only altering database values for content that needs to be changed.