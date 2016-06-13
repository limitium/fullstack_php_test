class MainRouter extends Marionette.AppRouter
  appRoutes:
    "": "albums"

    "albums": "albums"
    "album/:id": "album"
    "album/:id/page/:page": "album"

    "*notFound": "404"
