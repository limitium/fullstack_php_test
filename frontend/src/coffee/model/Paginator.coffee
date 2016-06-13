class Paginator extends Backbone.Model
  defaults:
    id: 0
    last: 0
    current: 0
    numItemsPerPage: 0
    first: 0
    pageCount: 0
    totalCount: 0
    pageRange: 0
    startPage: 0
    endPage: 0
    next: 0
    pagesInRange: []
    firstPageInRange: 0
    lastPageInRange: 0
    currentItemCount: 0
    firstItemNumber: 0
    lastItemNumber: 0
