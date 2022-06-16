# mdcms

mdcms, aka Markdown Content Management System, is yet another Markdown-based flat-file CMS powered by PHP.

## Features

* Cross-platform
* Web pages in Markdown, HTML and PHP
* Draft pages
* Nested sections
* Breadcrumb (Bootstrap 5 based)
* Pagination (Bootstrap 5 based)
* Table of Contents
* Sitemap
* PWA (progressive web application)
* Asset management (SCSS and Babel)

## Synopsis

### Windows

```shell
> choco install php --version=7.4.30
> choco install composer
> choco install nodejs --version=16.15.1
> choco install rsync
> choco install sed
```

```shell
> git clone https://github.com/cwchentw/mdcms.git mysite
> cd mysite
> .\tools\bin\serve.bat
```

```shell
> git remote set-url origin https://example.com/user/mysite.git
> .\tools\bin\migrate.bat
> git add .
> git commit -m "Migrate to a new site"
> git push -u origin master
```

### MacOS

```shell
$ brew install php@7.4
$ brew install composer
$ brew install node@16
```

```shell
$ git clone https://github.com/cwchentw/mdcms.git mysite
$ cd mysite
$ ./tools/bin/serve
```

```shell
$ git remote set-url origin https://example.com/user/mysite.git
$ ./tools/bin/migrate
$ git add .
$ git commit -m "Migrate to a new site"
$ git push -u origin master
```

### Ubuntu

```shell
$ sudo apt install php php-xml php-mbstring php-zip unzip
```

```shell
$ curl -o composer-setup.php https://getcomposer.org/installer
$ php composer-setup.php --install-dir=$HOME/bin --filename=composer
```

Install [nvm](https://github.com/nvm-sh/nvm). Install Node.js with `nvm`:

```shell
$ nvm install 16.15.1
$ nvm use 16.15.1
```

```shell
$ git clone https://github.com/cwchentw/mdcms.git mysite
$ cd mysite
$ ./tools/bin/serve
```

```shell
$ git remote set-url origin https://example.com/user/mysite.git
$ ./tools/bin/migrate
$ git add .
$ git commit -m "Migrate to a new site"
$ git push -u origin master
```

## Warning

mdcms is still *experimental* and *evolving*.

## Why not another Static Site Generator?

There have been more than enough static site generators currently. It is not ideal to reinvent one more wheel. Therefore, we create a dynamic one.

Website owners prefer flat files over relational databases. Nonetheless, static sites are suboptimal for some types of websites, like a membership site or a mix of a blog and web application. mdcms combines the best of two worlds - PHP-powered dynamic websites with Markdown files as contents.

## System Requirements

### Back End

* Production
  * GNU/Linux is recommended
  * A web server like Apache or Nginx
  * PHP 7.4
  * FastCGI Process Manager (FPM) of PHP
  * [FrontYAML](https://github.com/mnapoli/FrontYAML)
  * (Optional) Perl (for global replacement)
* Development
  * [Composer](https://getcomposer.org)
  * [PHP Code Sniffer](https://github.com/squizlabs/PHP_CodeSniffer) (for linting)
  * [PHPMD](https://phpmd.org) (for linting)

PHP 8.x is neither tested nor recommended because major GNU/Linux distributions still utilize PHP 7.x mostly.

### Front End

* Production
  * A [modern browser](https://browsehappy.com) like Chrome or Firefox
  * [Normalize.css](https://necolas.github.io/normalize.css/)
  * [Bootstrap 5](https://getbootstrap.com)
  * [Bootstrap.Native](https://thednp.github.io/bootstrap.native/)
  * (Optional) [highlight.js](https://highlightjs.org)
* Development
  * Node.js 16.x
  * [Gulp](https://gulpjs.com/)
  * [Sass](https://sass-lang.com/)
  * [Autoprefixer](https://github.com/postcss/autoprefixer)
  * [stylelint](https://stylelint.io/)
  * [Babel](https://babeljs.io/)
  * [Flow](https://flow.org/en/)

The dependencies mentioned here are based on *default* theme of mdcms. If you adapt another theme, your dependencies of the Web may vary.

## Usage

We assume GNU/Linux as both development and production environments. If you use Windows, see [this article](/content/howto/how-to-run-mdcms-on-windows.md).

Clone the repo locally:

```shell
$ git clone https://github.com/cwchentw/mdcms.git mysite
```

Change your working directory to root path of the cloned repo:

```shell
$ cd mysite
```

(Optional) Install Composer:

```shell
$ curl -o composer-setup.php https://getcomposer.org/installer
$ php composer-setup.php --install-dir=$HOME/bin --filename=composer
```

Install dependencies of mdcms with Composer:

```shell
$ composer install --no-dev
```

If you don't want to update your mdcms snapshot, you may safely remove all sample posts in *content* directory but not the directory itself, adding your awesome ones.

Instead, if you are going to update your mdcms copy, follow [this guide](/content/howto/how-to-upgrade-mdcms.md).

You can run a mdcms site locally with builtin web server of PHP:

```shell
$ ./tools/bin/serve
```

[Deploy](/content/deployment.md) the cloned repo to a web hosting service supporting PHP 7.4:

```shell
$ sudo ./tools/bin/sync-to /path/to/www
```

If you modify anything locally, repeat the above command to update your change(s) in a production environment.

Set the configuration of a web server accordingly. [Here](/tools/etc/nginx.conf) is a sample Nginx configuration to run mdcms sites.

(Optional) Save your local repo to a remote site:

```
$ git remote set-url origin https://example.com/user/mysite.git
$ git push -u origin master
```

## Breaking Changes

* 2022/02/01
  * Drop support to PHP 7.3
* 2022/01/03
  * Remove ESLint
* 2022/01/01
  * Add `SCRIPT_DIRECTION` in *config/parameters.template.php*
  * Add `SITE_ORIENTATION` in *config/parameters.template.php*
* 2021/12/29
  * Add `THEME_COLOR` in *config/parameters.template.php*
* 2021/12/26
  * Remove *tools/bin/install-composer* script
* 2021/07/25
  * Add `METADATA_DRAFT` in *config/internal.template.php*
  * Add `METADATA_NOINDEX` in *config/internal.template.php*

## Copyright

Copyright (c) 2021-2022 Michelle Chen. Licensed under MIT
