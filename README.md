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

and you have to add the bundle to your `AppKernel.php`:

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

Then you should check out the [documentation](http://bootstrap.braincrafted.com) to find out how you can use BraincraftedBootstrapBundle in your Symfony2 project.

License
-------

- The bundle is licensed under the [MIT License](http://opensource.org/licenses/MIT)
- The CSS and Javascript from the Twitter Bootstrap are licensed under the [Apache License 2.0](http://www.apache.org/licenses/LICENSE-2.0)
