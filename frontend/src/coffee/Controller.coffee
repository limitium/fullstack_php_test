class GalleryController extends Marionette.Controller
  initialize:(opt)->
    @app = opt.app
  albums: ->
    albumCollection = new AlbumCollection()

    @app.trigger('progress:show')
    albumCollection.fetch(success:=>
      @app.trigger('progress:hide')
    )

    view = new AlbumsCollectionView(
      collection: albumCollection
      childView: AlbumsItemView
    )
    App.content.show(view)

  album: (id, page)->
    paginator = new Paginator(id: id)
    album = new Album(id: id, page: page ? 1)

    @app.trigger('progress:show');
    album.fetch(success: (model, response)=>
      @app.trigger('progress:hide');
      paginator.set response.paginator.data
    )

    layoutView = new AlbumLayoutView()
    App.content.show(layoutView)

    layoutView.getRegion('menu').show(new AlbumMenuView(model: album));
    layoutView.getRegion('images').show(new AlbumImagesView(model: album));
    layoutView.getRegion('paginator').show(new AlbumPaginatorView(model: paginator));

  404: ->
    Backbone.history.navigate('', trigger: on)