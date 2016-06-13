class AlbumsItemView extends Marionette.ItemView
  template: '#album-item'
  events:
    'click a': 'openAlbum'
  openAlbum: ->
    Backbone.history.navigate('album/' + @model.id, trigger: on)
