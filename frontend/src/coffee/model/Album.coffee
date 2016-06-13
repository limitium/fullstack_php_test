class Album extends Backbone.Model
  urlRoot: '/api/album/'
  url: ->
    @urlRoot + @id + '/page/' + @get('page')
  defaults:
    id: 0
    name: ''
    images: []
  parse: (response)->
    if response.album? then response.album else response
