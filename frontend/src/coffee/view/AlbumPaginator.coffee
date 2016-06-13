class AlbumPaginatorView extends Marionette.ItemView
  template: '#album-paginator'
  events:
    'click a': 'changePage'
  modelEvents:
    'change': ->
      @render()

  changePage: (e)->
    Backbone.history.navigate('album/' + @model.id + '/page/' + (e.target.dataset.page ? e.target.parentNode.dataset.page), trigger: on)
