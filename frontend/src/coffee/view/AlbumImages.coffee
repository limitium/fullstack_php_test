class AlbumImagesView extends Marionette.ItemView
  template: '#album-images'
  modelEvents:
    'change': ->
      @render()
