Bootstrap Assets Importer
=========================

Installation
------------

Add requirements to composer.json:

``` json
{
  "require" : {
    "apnet/bootstrap" : "~3.1,<4.0"
  }
}
```

Configurations
--------------

Register `ApnetAsseticImporterBundle` bundle in the `AppKernel.php` file

``` php
// ...other bundles ...
$bundles[] = new Apnet\AsseticImporterBundle\ApnetAsseticImporterBundle();
```

Add Bootstrap importer to services.yml

``` yml
services:
    # bootstrap3 default css
    apnet.assetic.importer.bootstrap_css:
        parent: assetic.importer_path
        arguments:
            - %kernel.root_dir%/../vendor/apnet/bootstrap/app/Resources/assets/stylesheets
            - bootstrap
        tags:
            - { name: apnet.assetic.config_mapper }
    # bootstrap3 js
    apnet.assetic.importer.bootstrap_js:
        parent: assetic.importer_path
        arguments:
            - %kernel.root_dir%/../vendor/apnet/bootstrap/app/Resources/assets/javascripts
            - bootstrap
        tags:
            - { name: apnet.assetic.config_mapper }
```

Twig
----

To include Bootstrap into Twig template use **imported_asset** function:

``` html
<link href="{{ imported_asset('bootstrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
```

and

``` html
<script type="text/javascript" src="{{ imported_asset('bootstrap/bootstrap.min.js') }}"></script>
```
