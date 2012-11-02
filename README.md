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

```json
{
   "require": {
        "braincrafted/bootstrap-bundle": "dev-master"
    }
}
```

and you have to add the bundle to your `AppKernel.php`:

```php
// app/AppKernel.php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Braincrafted\BootstrapBundle\BraincraftedBootstrapBundle()
        );

        return $bundles;
    }
}
```

Go to `app/config/config.yml` and add the following:

```yaml
// app/config/config.yml
assetic:
    debug:          "%kernel.debug%"
    use_controller: false
    bundles:        ["BraincraftedBootstrapBundle"]
    #java: /usr/bin/java
    filters:
        cssrewrite: ~
        lessphp:
            file: %kernel.root_dir%/../vendor/leafo/lessphp/lessc.inc.php
            apply_to: "\.less$"
```

This tells assetic to process any less files it comes across.

Finally we need to tell assetic to dump some assets.

```bash
./app/console assetic:dump
```

Then you can check out the documentation to find out one way you can use BraincraftedBootstrapBundle in your Symfony2 project.

Alternatives
------------

To get started quickly just extend the `base.html.twig` layout from your twig file.

```html+django
// src/name/nameBundle/resources/views/Default/default.twig
{% extends "BraincraftedBootstrapBundle::base.html.twig" %}
```

You can place any content into the container block:

```html+django
// src/name/nameBundle/resources/view/Default/default.twig
{% block container %}
  <div class="container">
    <h1>Trial and error are your friend</h1>
    <h3>They are not mine</h3>
  </div>
{% endblock %}
```

If you load your route in a browser you should now see your content inside of a Twitter Bootstrap

The navbar at the top is from the Twitter Bootstrap example file. It can be overwritten by adding a navigation
block to your own template:

```html+django
// src/name/nameBundle/resources/view/Default/index.html.twig
{% block navigation %}
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
          <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#">My Project</a>
            <div class="nav-collapse collapse">
              <ul class="nav">
                <li class="active"><a href="#">Is</a></li>
                <li><a href="#about">Awesome</a></li>
                <li><a href="#contact">Contact</a></li>
              </ul>
            </div>
          </div>
        </div>
     </div>
{% endblock %}
```

Advanced
--------

If you want to take full control of Less you can import the `bootstrap.less` file and start extending it from inside of your own bundle.

First we need to modify assetic in our `config.yml` to include our own Bundle:

```yaml
// app/config/config.yml
assetic:
    bundles:        ["BraincraftedBootstrapBundle", "$MyAwesomeBundle"]
```

Now in our `.less` file we are going to include the base `bootstrap.less` and the `responsive.less`:

```css
// src/name/nameBundle/resources/public/less/tidri.less
@import "../../../../../../vendor/twitter/bootstrap/less/bootstrap.less";
    body {
        padding-top: 60px;
    }
@import "../../../../../../vendor/twitter/bootstrap/less/responsive.less";

// Your Styles Here
```

Now in our template `index.html.twig` we are going to add the stylesheets block:

```html+django
// src/name/nameBundle/resources/view/Default/index.html.twig
{% extends "BraincraftedBootstrapBundle::base.html.twig" %}

{% stylesheets '@MyAwesomeBundle/Resources/public/less/my.less' %}
    <link href="{{ asset_url }}" type="text/css" rel="stylesheet" media="all" />
{% endstylesheets %}
```

Twitter Bootstrap is now extendable and we can use mixins inside of our .less file:

```css
// src/name/nameBundle/resources/public/less/my.less
@import "../../../../../../vendor/twitter/bootstrap/less/bootstrap.less";
    body {
        padding-top: 60px;
    }
@import "../../../../../../vendor/twitter/bootstrap/less/responsive.less";

h1 {
    margin: 0px;
    padding: 0px;
    .alert();
}
```


License
-------

- The bundle is licensed under the [MIT License](http://opensource.org/licenses/MIT)
- The CSS and Javascript from the Twitter Bootstrap are licensed under the [Apache License 2.0](http://www.apache.org/licenses/LICENSE-2.0)
