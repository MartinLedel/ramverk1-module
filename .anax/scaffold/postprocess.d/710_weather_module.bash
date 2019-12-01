#!/usr/bin/env bash
#
# martinl/weather-module

#Copy the needed configuration and setup the module as a route handler for the routes `weather-api` and `weather-api-json`.
rsync -av vendor/martinl/weather-module/config ./

# Now copy the src.
rsync -av vendor/martinl/weather-module/src/ ./

# Now copy the view.
rsync -av vendor/martinl/weather-module/view/ ./

# Now copy the API documentation for the route `weather-text`.
rsync -av vendor/martinl/weather-module/content/weather-text.md content/weather-text.md

# Now copy the views.
rsync -av vendor/martinl/weather-module/view/ view/
