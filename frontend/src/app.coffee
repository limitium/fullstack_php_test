App = new Marionette.Application()

App.on "start", ->
  App.addRegions
    content: '#content'

  App.router = new MainRouter(
    controller: new GalleryController(app:App)
  )

  new ProgressView(
    app:App
  )

  Backbone.history.start(pushState: true)

$ ->
  App.start()
