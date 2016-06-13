class AlbumMenuView extends Marionette.ItemView
  template: '#album-menu'
  events:
    'click a': 'back'
  back: ->
    Backbone.history.navigate('albums', trigger: on)
  modelEvents:
    'change': ->
      @render()
