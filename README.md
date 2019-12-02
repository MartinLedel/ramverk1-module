Anax weather-module server
==================================

Install as Anax module
------------------------------------

This is how you install the module into an existing Anax installation.

1. Install using composer.

```
composer require martinl/weather-module
```

2. Copy the needed configuration and setup the module as a route handler for the routes `weather-api` and `weather2-api` for the REST api.

```
rsync -av vendor/martinl/weather-module/config/ ./config/
```

3. Copy the Controllers and Models required.

```
rsync -av vendor/martinl/weather-module/src/ ./src/
```

4. Now copy the views.

```
rsync -av vendor/martinl/weather-module/view/ ./view/
```

5. Now copy the API documentation for the route `weather-text`.

```
rsync -av vendor/martinl/weather-module/content/weather-text.md content/weather-text.md
```

6. Create config/api_keys.php that will contain all api keys, like so,

```
<?php

return ["key1" => "xxx",
"key2" => "xxx",
"key3" => "xxx"
];
```

Install using scaffold postprocessing file
------------------------------------

The module supports a postprocessing installation script, to be used with Anax scaffolding. The script executes the default installation, as outlined above.

```text
bash vendor/martinl/weather-module/.anax/scaffold/postprocess.d/710_weather_module.bash
```

The postprocessing script should be run after the `composer require` is done.



Install and setup Anax
------------------------------------

You need a Anax installation, before you can use this module. You can create a sample Anax installation, using the scaffolding utility [`anax-cli`](https://github.com/canax/anax-cli).

Scaffold a sample Anax installation `anax-site-develop` into the directory `a/`.

```
$ anax create a ramverk1-me-v2
$ cd a
```

Point your webserver to `a/htdocs` and Anax should display a Home-page.



Dependency
------------------

This is a Anax modulen and primarly intended to be used together with the Anax framework.



License
------------------

This software carries a MIT license. See [LICENSE.txt](LICENSE.txt) for details.



```
 .  
..:  Copyright (c) Martin Ledel
```
