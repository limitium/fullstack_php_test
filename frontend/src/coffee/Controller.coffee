class GalleryController extends Marionette.Controller
  albums: ->
    albumCollection = new AlbumCollection()
    albumCollection.fetch()

    view = new AlbumsCollectionView(
      collection: albumCollection
      childView: AlbumsItemView
    )
    App.content.show(view)

  album: (id, page)->
    paginator = new Paginator(id: id)

    album = new Album(id: id, page: page ? 1)
    album.fetch(success: (model, response)->
      paginator.set response.paginator.data
    )

    layoutView = new AlbumLayoutView()
    App.content.show(layoutView)

    layoutView.getRegion('menu').show(new AlbumMenuView(model: album));
    layoutView.getRegion('images').show(new AlbumImagesView(model: album));
    layoutView.getRegion('paginator').show(new AlbumPaginatorView(model: paginator));

  404: ->
    Backbone.history.navigate('', trigger: on)