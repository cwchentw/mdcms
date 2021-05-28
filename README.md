# mdcms

Markdown-based content management system powered by PHP.

## System Requirements

* PHP 7
* mbstring extension of PHP
* [Parsedown](https://github.com/erusev/parsedown) and [Parsedown Extra](https://github.com/erusev/parsedown-extra)
* Composer (only for development)

## Usage

Clone the repo:

```
$ git clone https://github.com/cwchentw/mdcms.git mysite
```

Change your working directory to the root of the cloned repo:

```
$ cd mysite
```

(Optional) Install Composer:

```
$ sh scripts/install-composer
```

Install dependencies with Composer:

```
$ composer install
```

Remove all sample articles in *content*, adding your awesome ones.

Deploy the cloned repo to a web hosting service supporting PHP 7. Set the configuration of the web server accordingly.

(Optional) Save the cloned repo to another remote repo:

```
$ git remote set-url origin https://example.com/user/mysite.git
$ git push -u origin master
```

## Copyright

Copyright (c) 2021, Michael Chen. Licensed under MIT
