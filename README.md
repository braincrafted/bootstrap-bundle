BraincraftedBootstrapBundle
===========================

By [Florian Eckerstorfer](http://florianeckerstorfer.com)

[![Build Status](https://secure.travis-ci.org/braincrafted/bootstrap-bundle.png)](http://travis-ci.org/braincrafted/bootstrap-bundle)


About
-----

BraincraftedBootstrapBundle is [Bootstrap, from Twitter](http://twitter.github.com/bootstrap/) encapsulated in a [Symfony2](http://symfony.com) bundle.


Installation
------------

First you need to add BraincraftedBootstrapBundle to `composer.json`:

    {
       "require": {
            "braincrafted/bootstrap-bundle": "dev-master"
        }
    }

Please note that `dev-master` points to the latest release. If you want to use the latest development version please use `dev-develop`. Of course you can also use an explicit version number, e.g., `1.3.*`.

You also have to add BootstrapBundle to your `AppKernel.php`:

    // app/AppKernel.php
    ...
    class AppKernel extends Kernel
    {
        ...
        public function registerBundles()
        {
            $bundles = array(
                ...
                new Braincrafted\BootstrapBundle\BraincraftedBootstrapBundle()
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
            "twitter/bootstrap": "2.3.*"
        }
    }

You can find a detailed description in the documentation.


More Information
----------------

Check out the [documentation](http://bootstrap.braincrafted.com) to find out how you can use BraincraftedBootstrapBundle in your Symfony2 project.


Compatibility
-------------

- **BraincraftedBootstrapBundle v1.3.***
    - Twitter Bootstrap v2.3.1
    - Symfony 2.2.*


License
-------

- The bundle is licensed under the [MIT License](http://opensource.org/licenses/MIT)
- The CSS and Javascript from the Twitter Bootstrap are licensed under the [Apache License 2.0](http://www.apache.org/licenses/LICENSE-2.0)
