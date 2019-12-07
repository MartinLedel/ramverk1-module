Anax weather-module server
==================================

[![Build Status](https://travis-ci.org/MartinLedel/ramverk1-module.svg?branch=master)](https://travis-ci.org/MartinLedel/ramverk1-module)
[![CircleCI](https://circleci.com/gh/MartinLedel/ramverk1-module.svg?style=svg)](https://circleci.com/gh/MartinLedel/ramverk1-module)

[![Build Status](https://scrutinizer-ci.com/g/MartinLedel/ramverk1-module/badges/build.png?b=master)](https://scrutinizer-ci.com/g/MartinLedel/ramverk1-module/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/MartinLedel/ramverk1-module/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/MartinLedel/ramverk1-module/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/MartinLedel/ramverk1-module/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/MartinLedel/ramverk1-module/?branch=master)

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/c702bccb174a44e7800f444e91fe157b)](https://www.codacy.com/manual/MartinLedel/ramverk1-module?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=MartinLedel/ramverk1-module&amp;utm_campaign=Badge_Grade)

Install as Anax module
------------------------------------

This is how you install the module into an existing Anax installation.

1.  Install using composer.

```bash
composer require martinl/weather-module
```

2.  Copy the needed configuration and setup the module as a route handler for the routes `weather-api` and `weather2-api` for the REST api.

```bash
rsync -av vendor/martinl/weather-module/config/ ./config/
```

3.  Copy the Controllers and Models required.

```bash
rsync -av vendor/martinl/weather-module/src/ ./src/
```

4.  Now copy the views.

```bash
rsync -av vendor/martinl/weather-module/view/ ./view/
```

5.  Now copy the API documentation for the route `weather-text`.

```bash
rsync -av vendor/martinl/weather-module/content/weather-text.md content/weather-text.md
```

6.  Create config/api_keys.php that will contain all api keys, like so,

```text
<?php

return ["key1" => "xxx",
"key2" => "xxx",
"key3" => "xxx"
];
```

Install using scaffold postprocessing file
------------------------------------

The module supports a postprocessing installation script, to be used with Anax scaffolding. The script executes the default installation, as outlined above.

```bash
bash vendor/martinl/weather-module/.anax/scaffold/postprocess.d/710_weather_module.bash
```

The postprocessing script should be run after the `composer require` is done.

Install and setup Anax
------------------------------------

You need a Anax installation, before you can use this module. You can create a sample Anax installation, using the scaffolding utility [`anax-cli`](https://github.com/canax/anax-cli).

Scaffold a sample Anax installation `anax-site-develop` into the directory `a/`.

```bash
anax create a ramverk1-me-v2
cd a
```

Point your webserver to `a/htdocs` and Anax should display a Home-page.

Dependency
------------------

This is a Anax modulen and primarly intended to be used together with the Anax framework.

License
------------------

This software carries a MIT license. See [LICENSE.txt](LICENSE.txt) for details.

```text
 .  
..:  Copyright (c) Martin Ledel
```
