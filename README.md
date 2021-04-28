# Starter-WP-Theme
Starter WordPress theme based on "underscores.me" adjusted for my needs to create custom themes.

# CSS
Stylesheet organized using GULP 4+ with SASS preprocessor and SCSS syntax. 
The main point of the style structure in this project is high readability and comfortable support.
Also there is availability to separate main.css from components .css and use them only when they needed.
In this case you can significantly improve page loading speed on big projects.

# CSS - Media Queries
I'm using em @media queries. If you're still using pixel @media queries I suggest to read this article: https://zellwk.com/blog/media-query-units/
Also I'm using very cool sass-mq node module which allows to use em @media queries comfortable. You can find it here: https://github.com/sass-mq/sass-mq

# JS / jQuery
Just regular jQuery functions with WP like comments before each function.

# PHP
PHP 7.4 Required. It's much faster and has a lot of cool features. 
Functions files uses strict typing mode. Also PHP 7.4 " ??= " syntax using in theme.
I'm trying to comment each PHP 7.4 expression with * REQUIRED PHP 7.4
All .php files has disabling direct acccess expression.
Theme has been written using phpcs with WordPress standard. You can find more information about it here: https://github.com/WordPress/WordPress-Coding-Standards

# Theme features
1. Theme includes custom functions in inc/post-functions.php which allows to receive default post informations like: 
  - Featured image with availability to crop image into square and load it through WordPress media uploader which creates smaller images. 
    Image returns in <img> tag with sizes and scrset attributes which upgrade you site loading speed;
  - Title;
  - Categories;
  - Author;
  - Date;
  - Comments;
  - Excerpt / Content with availability to set maximum chars length and added "Read more" button with changeable title.
2. Theme includes custom posts navigation in template-parts/content-navigation.php

# Multilanguage
I think that is the best way to create multilanguage theme is using
POEditor ( https://poeditor.com ) and 
Loco Translate WordPress Plugin ( https://wordpress.org/plugins/loco-translate/ )
