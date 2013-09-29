BcBootstrapBundle
=================

By [Florian Eckerstorfer](http://florianeckerstorfer.com)

[![Build Status](https://secure.travis-ci.org/braincrafted/bootstrap-bundle.png)](http://travis-ci.org/braincrafted/bootstrap-bundle)


Note
----

There is currently no stable release that supports Bootstrap 3.0. I'm working on a 2.0 release, which supports Bootstrap 3 and generally improves the bundle. However, it will take some time for get a stable release ready. Please be patient.

In the meantime you can use the bundle, but you should have an understanding on how Symfony2 (especially configuration), Assetic and Composer works to get everything running.

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
            "twbs/bootstrap": "3.0.*"
        }
    }

You can find a detailed description in the documentation.


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
- **BcBootstrapBundle v1.5.***
    - Bootstrap v3.0.*
    - Symfony 2.2.*


Changelog
---------

### Version 1.5.0

- Works with new Bootstrap repository `twbs/bootstrap`
- Basic support for Bootstrap v3.0
- Allow override options in menus
- Extend from base form layout
- Fixed problems with removing elemnts in JavaScript collection form type
- Various other bugfixes

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

License
-------

- The bundle is licensed under the [MIT License](http://opensource.org/licenses/MIT)
- The CSS and Javascript from the Twitter Bootstrap are licensed under the [Apache License 2.0](http://www.apache.org/licenses/LICENSE-2.0)
