BcBootstrapBundle
=================

By [Florian Eckerstorfer](http://florianeckerstorfer.com)

[![Build Status](https://secure.travis-ci.org/braincrafted/bootstrap-bundle.png)](http://travis-ci.org/braincrafted/bootstrap-bundle)


About
-----

BcBootstrapBundle is [Bootstrap, from Twitter](http://twitter.github.com/bootstrap/) encapsulated in a [Symfony2](http://symfony.com) bundle.

This bundle is highly opiniated by how I use Twitter Bootstrap and Symfony.


Installation
------------

First you need to add `braincrafted/bootstrap-bundle` to `composer.json`:

    {
       "require": {
            "braincrafted/bootstrap-bundle": "dev-master"
        }
    }

Please note that `dev-master` points to the latest release. If you want to use the latest development version please use `dev-develop`. Of course you can also use an explicit version number, e.g., `1.3.*`.

You also have to add `BcBootstrapBundle` to your `AppKernel.php`:

    // app/AppKernel.php
    ...
    class AppKernel extends Kernel
    {
        ...
        public function registerBundles()
        {
            $bundles = array(
                ...
                new Bc\Bundle\BootstrapBundle\BcBootstrapBundle()
            );
            ...

            return $bundles;
        }
        ...
    }


Download Assets
---------------

This bundle does no longer contain the asset files from Twitter Bootstrap (images, stylesheets and JavaScripts). The best way to include those assets is to add Twitter Bootstrap to your `composer.json`:

    {
       "require": {
            "twbs/bootstrap": "2.3.*"
        }
    }

You can find a detailed description in the documentation.


Example layout
------------

There is created example layout using twitter bootstrap styles in resources.
After successful installation you can start with prepared example layout based on bootstrap's home page.

To do this, you need to extend your base layotu file in app/Resources/views/base.html.twig by:

```
    {% extends 'BcBootstrapBundle::examplelayout.html.twig' %}
```

And that's it.


CRUD generator
------------

Because CRUD generator in Symfony framework has own structure and after generating a developer should always change some classes and code inside the code there is created new generator command in command line.

It works in the same way as the oryginal enerator in Symfony, but generates templates dedicated for twitter bootstrap.


```
    bc:doctrine:crud
    bc:generate:crud
```

More Information
----------------

Check out the [documentation](http://bootstrap.braincrafted.com) to find out how you can use BcBootstrapBundle in your Symfony2 project.


Compatibility
-------------

- **BcBootstrapBundle v1.3.***
    - Twitter Bootstrap v2.3.*
    - Symfony 2.2.*
- **BcBootstrapBundle v1.4.***
    - Twitter Bootstrap v2.3.*
    - Symfony 2.2.*


Changelog
---------

### Version 1.4.0

- Changed namespace to `Bc\Bundle\BootstrapBundle`
- Automatically configure Twig
- Automatically configure KnpMenuBundle
- Automatically configure KnpPaginatorBundle
- Automatically configure Assetic
- Improved layout of error messages in compound fields
- Improved code style (usage of PHP_CodeSniffer and PHPMD)
- Support for `data-prototype` option in collection fields
- Helper and template for flash messages

### Version 1.4.1

- Added CRUD generator for example layout
- Added example layout

License
-------

- The bundle is licensed under the [MIT License](http://opensource.org/licenses/MIT)
- The CSS and Javascript from the Twitter Bootstrap are licensed under the [Apache License 2.0](http://www.apache.org/licenses/LICENSE-2.0)
