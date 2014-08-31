[BraincraftedBootstrapBundle](http://bootstrap.braincrafted.com)
=================

BraincraftedBootstrapBundle helps you integrate [Bootstrap](http://getbootstrap.com) in your [Symfony2](http://symfony.com) project. BootstrapBundle also supports the official Sass port of Bootstrap and Font Awesome.

[![Build Status](https://secure.travis-ci.org/braincrafted/bootstrap-bundle.png)](http://travis-ci.org/braincrafted/bootstrap-bundle)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/braincrafted/bootstrap-bundle/badges/quality-score.png?s=28e07378182fddc3cdf2c764437a72b6eaf55a45)](https://scrutinizer-ci.com/g/braincrafted/bootstrap-bundle/)
[![Code Coverage](https://scrutinizer-ci.com/g/braincrafted/bootstrap-bundle/badges/coverage.png?s=6258b68071860a349841a0450f39e7cc6ad5da23)](https://scrutinizer-ci.com/g/braincrafted/bootstrap-bundle/)

[![Latest Stable Version](https://poser.pugx.org/braincrafted/bootstrap-bundle/v/stable.png)](https://packagist.org/packages/braincrafted/bootstrap-bundle)
[![Total Downloads](https://poser.pugx.org/braincrafted/bootstrap-bundle/downloads.png)](https://packagist.org/packages/braincrafted/bootstrap-bundle)

Developed by [Florian Eckerstorfer](http://florian.ec) and amazing [contributors](https://github.com/braincrafted/bootstrap-bundle/contributors).


Installation
------------

First you need to add `braincrafted/bootstrap-bundle` to `composer.json`:

```json
{
   "require": {
        "braincrafted/bootstrap-bundle": "dev-master"
    }
}
```

Please note that `dev-master` points to the latest release. If you want to use the latest development version please use `dev-develop`. Of course you can also use an explicit version number, e.g., `2.1.*`.

You also have to add `BraincraftedBootstrapBundle` to your `AppKernel.php`:

```php
// app/AppKernel.php
//...
class AppKernel extends Kernel
{
    //...
    public function registerBundles()
    {
        $bundles = array(
            ...
            new Braincrafted\Bundle\BootstrapBundle\BraincraftedBootstrapBundle()
        );
        //...

        return $bundles;
    }
    //...
}
```
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
            <td>v3.0.* (very basic)</td>
            <td>v1.9.*</td>
        </tr>
        <tr>
            <td><strong>v2.0.*</strong><br><strong>v2.1.*</strong></td>
            <td>v2.3.*<br>v2.4.*</td>
            <td>v3.0.*<br>v3.1.*</td>
            <td>v1.10.*<br>v1.11.*</td>
        </tr>
        <tr>
            <td><strong>v2.1.*</strong></td>
            <td>v2.3.*<br>v2.4.*<br>v2.5.*</td>
            <td>v3.0.*<br>v3.1.*<br>v3.2.*<br>sass v3.2.*</td>
            <td>v1.10.*<br>v1.11.*</td>
        </tr>
    </tbody>
</table>


Changelog
---------

### Version 2.1.0 (31 August 2014)

- [#298](https://github.com/braincrafted/bootstrap-bundle/pull/298) Fixed path to assets dir in bootstrap-sass v3.2 (by [florianeckerstorfer](https://github.com/florianeckerstorfer))

### Version 2.1.0-beta2 (21 August 2014)

- [#237](https://github.com/braincrafted/bootstrap-bundle/issues/237) Pass `label_attr` to `checkbox_row` and `radio_row` in `choice_widget_expanded` (by [florianeckerstorfer](https://github.com/florianeckerstorfer))
- [#241](https://github.com/braincrafted/bootstrap-bundle/pull/241) Remove wrong button spacing when collection is empty (by [sandello-alkr](https://github.com/sandello-alkr))
- [#241](https://github.com/braincrafted/bootstrap-bundle/issues/242) Make `web` directory configurable in `install` command (by [florianeckerstorfer](https://github.com/florianeckerstorfer))
- [#245](https://github.com/braincrafted/bootstrap-bundle/issues/245) Add support for `symfony-bin-dir` (by [nifr](https://github.com/nifr))
- [#249](https://github.com/braincrafted/bootstrap-bundle/pull/249) Add `nav` class based on depth (by [bkosborne](https://github.com/bkosborne))
- [#251](https://github.com/braincrafted/bootstrap-bundle/pull/251) Add support for static form controls (by [bdm-benzor](https://github.com/bdm-benzor))
- [#252](https://github.com/braincrafted/bootstrap-bundle/pull/252) Fix behaviour when `label = false` (by [rdohms](https://github.com/rdohms))
- [#254](https://github.com/braincrafted/bootstrap-bundle/pull/254) Remove whitespace in menu root block (by [dirkluijk](https://github.com/dirkluijk))
- [#260](https://github.com/braincrafted/bootstrap-bundle/pull/260) Updated default jQuery path (by [sprankhub](https://github.com/sprankhub))
- [#263](https://github.com/braincrafted/bootstrap-bundle/pull/264) Fixed global error CSS class (by [althaus](https://github.com/althaus))
- [#266](https://github.com/braincrafted/bootstrap-bundle/pull/266) Fix column size of label is `false` (by [jeroenvds](https://github.com/jeroenvds))
- [#274](https://github.com/braincrafted/bootstrap-bundle/pull/274) Added missing space in `bootstrap-collection (by [bdm-benzor](https://github.com/bdm-benzor))
- [#275](https://github.com/braincrafted/bootstrap-bundle/pull/275) Add help text to single checkbox and radio (by [bostaf](https://github.com/bostaf))
- [#276](https://github.com/braincrafted/bootstrap-bundle/pull/276) Add support for `leafo/scssphp` (by [stefanosala](https://github.com/stefanosala))
- [#279](https://github.com/braincrafted/bootstrap-bundle/issues/279) Do not render value in `file` widget (by [florianeckerstorfer](https://github.com/florianeckerstorfer))
- [#281](https://github.com/braincrafted/bootstrap-bundle/pull/281) Add additional CSS classes to icons (by [wodka](https://github.com/wodka))
- [#283](https://github.com/braincrafted/bootstrap-bundle/pull/283) Make icon tag configurable (by [wodka](https://github.com/wodka))
- [#286](https://github.com/braincrafted/bootstrap-bundle/pull/286) Add support for form actions (by [derpue](https://github.com/derpue))
- [#287](https://github.com/braincrafted/bootstrap-bundle/pull/287) Add support for input group buttons (by [rdohms](https://github.com/rdohms))
- [#289](https://github.com/braincrafted/bootstrap-bundle/pull/289) Removed trailing whitespace for checkbox and radio widget (by [morticue](https://github.com/morticue))
- [#290](https://github.com/braincrafted/bootstrap-bundle/pull/290) Add form type for static control (by [derpue](https://github.com/derpue))


### Version 2.1.0-beta1 (29 May 2014)

- [#238](https://github.com/braincrafted/bootstrap-bundle/pull/238) Add empty `value` field when `empty_value` is not null in choice field
- [#239](https://github.com/braincrafted/bootstrap-bundle/pull/239) Removed translation_domain from error messages
- [#214](https://github.com/braincrafted/bootstrap-bundle/pull/214) Check for `preSubmit` errors (by [sandello-alkr](https://github.com/sandello-alkr))
- [#240](https://github.com/braincrafted/bootstrap-bundle/pull/240) Include `head` block in default layout

### Version 2.1.0-alpha1 (16 May 2014)

- [#203](https://github.com/braincrafted/bootstrap-bundle/issues/203) Add support for `bootstrap-sass` (by [sandello-alkr](https://github.com/sandello-alkr) and [florianeckerstorfer](https://github.com/florianeckerstorfer))
- [#160](https://github.com/braincrafted/bootstrap-bundle/issues/160) Add support for Font Awesome (by [florianeckerstorfer](https://github.com/florianeckerstorfer))
- [#229](https://github.com/braincrafted/bootstrap-bundle/pull/229) Fix `bootstrap.js` path in default layout (by [nonlux](https://github.com/nonlux))
- [#221](https://github.com/braincrafted/bootstrap-bundle/issues/221) Fix generated key for nested collections (by [sandello-alkr](https://github.com/sandello-alkr))
- [#220](https://github.com/braincrafted/bootstrap-bundle/pull/220) Add option to configure icon prefix (by [llwt](https://github.com/llwt))
- [#206](https://github.com/braincrafted/bootstrap-bundle/issues/206) Use `raw` filter for form labels (by [sandello-alkr](https://github.com/sandello-alkr))
- [#209](https://github.com/braincrafted/bootstrap-bundle/issues/209) Fixed compatibility issues with KnpMenu (by [mbutkereit](https://github.com/mbutkereit))

### Version 2.0.1 (3 April 2014)

- #168 Removed CSS class `row` from form-group
- #182 Added support for form actions (row with multiple buttons) (by [rdohms](https://github.com/rdohms))
- #187 Made default button class changable (by [sandello-alkr](https://github.com/sandello-alkr))
- #188 Added icons to form buttons (by [mvrhov](https://github.com/mvrhov))
- #190 Added support for stacked tabs (by [aur1mas](https://github.com/aur1mas))
- #192 Added method to reset flash bag (by [JulienRamel](https://github.com/JulienRamel))
- #196 Removed CSS class `nav` from child elements (by [dylanschoenmakers](https://github.com/dylanschoenmakers))
- #198 Added parsing of icons in prepend and append input groups (by [yvh](https://github.com/yvh))
- Fixed `file` form type (by [hsz](https://github.com/hsz))

### Version 2.0.0-alpha1

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
- Fixed trailing slash in `braincrafted_bootstrap.output_dir` option
- Fixed undefined variable in pagination template
- Better tested

#### Version 2.0.0-beta1

- Fixed duplicate `div.form-group` in `choice_widget_expanded` (Fixes [#131](https://github.com/braincrafted/bootstrap-bundle/issues/131))
- Use correct assets when not using LESS (Fixes [#128](https://github.com/braincrafted/bootstrap-bundle/issues/128)) [[amcgowanca](https://github.com/amcgowanca)]
- Add `col_size` option to set the column size for form widgets (Fixes [#127](https://github.com/braincrafted/bootstrap-bundle/issues/127))
- Add support for `simple_col` options in `textarea_widget`
- Renamed views
- Add error messages in `checkbox_row` and `radio_widget` (Fixes [#118](https://github.com/braincrafted/bootstrap-bundle/issues/118))

#### Version 2.0.0-beta2 (9 December 2013)

- #133: Fix `label_col`, `widget_col`, `col_size` and `simple_col` options in collection widgets
- #136: Added translation to `bootstrap_collection` widget
- #137: Removed `cssrewrite` filter from default Assetic configuration
- #139: Fix JavaScript for nested `bootstrap_collection` widgets (by [wizart](https://github.com/wizart))
- #140: Improved dependency list in `composer.json` (by [hason](https://github.com/hason))
- #142: Added translation for help block and error messages
- #143: Added translation to flash message template (by [rdohms](https://github.com/rdohms))
- #144: Fix class attribute for checkbox widget (by [squaye85](https://github.com/squaye85))
- #145: Added possibility to style global error messages
- Renamed `customize_variables` configuration option into `customize`

#### Version 2.0.0-stable (2 January 2014)

- #152: Add form name attribute (by [nonlux](https://github.com/nonlux))
- #154: Fix Bootstrap Collection form type for nested types
- #155: Use `braincrafted_bootstrap.output_dir` option when installing icon font
- #52: Add class option for pagination
- #148: Add `label_col` and `widget_col` option for the whole form (by [florianeckerstorfer](https://github.com/florianeckerstorfer) and [dirkluijk](https://github.com/dirkluijk))
- #156: Add support for error messages with parameters (by [thanosp](https://github.com/thanosp))
- #157: Use print shiv instead of standard shiv (by [mvrhov](https://github.com/mvrhov))
- #161: Set `style` option in FormBuilder
- #162: Set depth of navigation.

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
- The CSS and Javascript files from Twitter Bootstrap are licensed under the [Apache License 2.0](http://www.apache.org/licenses/LICENSE-2.0) for all versions before 3.1
- The CSS and Javascript files from Twitter Bootstrap are licensed under the [MIT License](http://opensource.org/licenses/MIT) for 3.1 and after

