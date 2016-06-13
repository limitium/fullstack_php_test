class ProgressView extends Marionette.ItemView
  el: "#progress",
  initialize:(opt)->
    @bindUIElements()
    opt.app.on 'progress:show',=>
      @$el.show()
    opt.app.on 'progress:hide',=>
      @$el.hide()