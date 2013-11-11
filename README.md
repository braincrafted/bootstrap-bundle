[BraincraftedBootstrapBundle](http://bootstrap.braincrafted.com)
=================

By [Florian Eckerstorfer](http://florianeckerstorfer.com)

[![Build Status](https://secure.travis-ci.org/braincrafted/bootstrap-bundle.png)](http://travis-ci.org/braincrafted/bootstrap-bundle)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/braincrafted/bootstrap-bundle/badges/quality-score.png?s=28e07378182fddc3cdf2c764437a72b6eaf55a45)](https://scrutinizer-ci.com/g/braincrafted/bootstrap-bundle/)
[![Code Coverage](https://scrutinizer-ci.com/g/braincrafted/bootstrap-bundle/badges/coverage.png?s=6258b68071860a349841a0450f39e7cc6ad5da23)](https://scrutinizer-ci.com/g/braincrafted/bootstrap-bundle/)


About
-----

BraincraftedBootstrapBundle helps you integrate [Bootstrap](http://getbootstrap.com) in your [Symfony2](http://symfony.com) project.


Installation
------------

First you need to add `braincrafted/bootstrap-bundle` to `composer.json`:

    {
       "require": {
            "braincrafted/bootstrap-bundle": "dev-master"
        }
    }

Please note that `dev-master` points to the latest release. If you want to use the latest development version please use `dev-develop`. Of course you can also use an explicit version number, e.g., `2.0.*`.

You also have to add `BraincraftedBootstrapBundle` to your `AppKernel.php`:

    // app/AppKernel.php
    ...
    class AppKernel extends Kernel
    {
        ...
        public function registerBundles()
        {
            $bundles = array(
                ...
                new Braincrafted\Bundle\BootstrapBundle\BraincraftedBootstrapBundle()
            );
            ...

            return $bundles;
        }
        ...
    }

Additionally you have to install Bootstrap and jQuery as dependencies and configure Assetic to compile the LESS files. You can find more information in the [Getting Started](http://bootstrap.braincrafted.com/getting-started.html) section of the documentation.


Compatibility
-------------

This bundle has two main dependencies, Symfony and Bootstrap. The following table shows which version of BraincraftedBootstrapBundle is compatible with which version of Symfony and Bootstrap.

<table>
    <thead>
        <tr>
            <th>BootstrapBundle</th>
            <th>Symfony</th>
            <th>Bootstrap</th>
            <th>jQuery</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><strong>v1.3.*</strong></td>
            <td>v2.2.*</td>
            <td>v2.3.*</td>
            <td>v1.9.*</td>
        </tr>
        <tr>
            <td><strong>v1.4.*</strong></td>
            <td>v2.2.*</td>
            <td>v2.3.*</td>
            <td>v1.9.*</td>
        </tr>
        <tr>
            <td><strong>v1.5.*</strong></td>
            <td>v2.2.*</td>
            <td>v2.3.*</td>
            <td>v1.9.*</td>
        </tr>
        <tr>
            <td><strong>v2.0.*</strong></td>
            <td>v2.3.*</td>
            <td>v3.0.*</td>
            <td>v1.10.*</td>
        </tr>
    </tbody>
</table>


Changelog
---------

### Version 2.0.0

- Updated to Symfony v2.3.6
- Updated to Bootstrap v3.0.1
- Updated to jQuery v1.10.2
- Remove `include_responsive` option because Bootstrap 3.0 no longer has a non responsive version
- Added `boostrap_money` form type that uses Bootstraps prepend or append style to display the currency
- `percent` form type uses Bootstraps append style to display the percent sign
- Changed namespace back to `Braincrafted\Bundle\BootstrapBundle`
- Support for custom `variables.less`
- Several Twig filters are now functions
- Added `bootstrap_set_style` and `bootstrap_get_style` Twig functions to globally set the style of forms
- Added command to generate custom `bootstrap.less` file
- Added command to copy icon fonts into `web/` directory
- Added Composer script handler for copying icon fonts
- Pagination now supports disabled links
- Added Twig function `badge`
- Removed Twig filters `badge_*` (Bootstrap v3.0 does not include multiply badge styles)
- Twig filters `label_*` are now Twig functions
- Twig filter `icon` is now a Twig function
- Added `braincrafted_collection` form type

#### Version 2.0.0-alpha2

- Fixed compatibility with PHP 5.3 (Fixes [#111](https://github.com/braincrafted/bootstrap-bundle/issues/111))
- Renamed `braincrafted_collection` to `bootstrap_collection`
- `widget_col`, `label_col` and `simple_col` can be defined in form builder (Fixes [#113](https://github.com/braincrafted/bootstrap-bundle/issues/113))
- Add support for input groups
- Fix bug with inline forms when no placeholder is defined

#### Version 2.0.0-alpha3

- Fixed configuration of input groups in form builder (Fixes [#115](https://github.com/braincrafted/bootstrap-bundle/issues/115))
- Pass `widget_col`, `label_col` and `simple_col` to form builder (Fixes [#113](https://github.com/braincrafted/bootstrap-bundle/issues/113))
- Fixed trailing slash in `braincrafted_bootstrap.output_dir` option
- Fixed undefined variable in pagination template
- Better tested

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

### Version 1.2.0

- Added support for Assetic


License
-------

- The bundle is licensed under the [MIT License](http://opensource.org/licenses/MIT)
- The CSS and Javascript from the Twitter Bootstrap are licensed under the [Apache License 2.0](http://www.apache.org/licenses/LICENSE-2.0)