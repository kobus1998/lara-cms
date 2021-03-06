
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 (function ( $ ) {

  $.fn.toggleField = function (target, cb) {
    this.click(function (e) {
      e.preventDefault()
      $(target).toggleClass('is-active')
      if (typeof cb !== 'undefined') {
        cb($(target))
      }
    })
  }

  $.fn.makeReq = function(method, success, err, before) {
    this.submit(function (e) {
      e.preventDefault()

      if (typeof before !== 'undefined') {
        before()
      }

      let idName = $(this).attr('id')

      if (idName.includes('delete')) {
        let confirm = window.confirm('Are you sure?')
        if (!confirm) return
      }

      showLoader(true)

      let content = $(this).serialize()
      let url = $(this).attr('action')

      let formMethod = window.axios.get

      switch (method) {
        case 'post':
          formMethod = window.axios.post
          break;
        case 'put':
          formMethod = window.axios.put
          break;
        case 'delete':
          formMethod = window.axios.delete
          break;
        case 'patch':
          formMethod = window.axios.patch
          break;
        default:
          formMethod = window.axios.get
      }

      formMethod(url, content).then(response => {
        showLoader(false)
        success(response)
      }).catch(error => {
        showLoader(false)
        err(error)
      })
    })
    return this;
  }

 }( jQuery ));

Array.prototype.submitArray = function() {
  this.forEach(elem => {
    $(`${elem}`).submit()
  })
}

String.prototype.submitString = function () {
  $(`${this}`).submit()
};

function inputSwitcher (type, meta) {
  if (typeof meta.value === 'undefined') {
    meta.value = ''
  }

  switch (type) {
    case 'textfield':
      return `<input type="text" class="input" name="${meta.name}" value="${meta.value}">`
      break;
    case 'textarea':
      return `<textarea class="textarea" name="${meta.name}" rows="8" cols="80">${meta.value}</textarea>`
      break;
    case 'media':
      return `<input type="text" class="input" name="${meta.name}" value="${meta.value}">`
      break;
    default:
      return `<input type="text" class="input" name="${meta.name}" value="${meta.value}">`
  }
}

function updateContentManager (pages) {
  $('.page').each(function (pageIndex) {
    $(this).find('.content-item').each(function (contentIndex) {
      var pivot = pages[pageIndex][contentIndex]['pivot']
      $(this).find('input[name="content-id"]').val(pivot['content_id'])
      $(this).find('input[name="page-content-id"]').val(pivot['id'])
      $(this).find('input[name="order"]').val(pivot['order'])
      $(this).find('input[name="repeating"]').val(pivot['repeating'])
    })
  })
}

function showLoader (state) {
  if (state) {
    $('.notification-loading').show()
  } else if (!state) {
    $('.notification-loading').hide()
  }
}

function showNotification (type, message) {
  $('.notification-success, .notification-error, .notification-warning, .notification-info, .notification-loading').hide()
  switch (type) {
    case 'error':
      $('.notification-error').fadeIn()
      $('.notification-error').find('.text').html(message)
      break;
    case 'success':
      $('.notification-success').fadeIn()
      $('.notification-success').find('.text').html(message)
      break;
    case 'warning':
      $('.notification-warning').fadeIn()
      $('.notification-warning').find('.text').html(message)
      break;
    case 'info':
      $('.notification-info').fadeIn()
      $('.notification-info').find('.text').html(message)
      break;
    default:
  }

  setTimeout(function () {
    $('.notification-success, .notification-error, .notification-warning, .notification-info, .notification-loading').fadeOut()
  }, 2500);
}

$(document).ready(function () {

  $('.add-repeating-content').click(function (e) {
    e.preventDefault()

    let url = $(this).attr('data-action')

    window.axios.post(url, {}).then(response => {
      showNotification('success', 'Content is added!')
      if (url.includes('page')) {
        $('#update-page-content-form').submit()
      } else if (url.includes('collection')) {
        $('#update-post-content-form').submit()
      }
      setTimeout(function () {
        window.location.reload()
      }, 100);
    }).catch(err => {
      showNotification('error', 'Something went wrong')
    })

  })

  $(document).on('click', '.toggle-modal-add-media', function () {
    $('.toggle-add-media').toggleClass('is-active')
    let imgManager = $('.toggle-add-media').find('.img-manager')
    imgManager.attr('data-toggled-btn', $(this).attr('data-btn-id'))
  })

  $(document).on('click', '.img-manager-item', function () {
    let imgSrc = $(this).find('img').attr('src')
    let toggleId = $(this).closest('.img-manager').attr('data-toggled-btn')
    let imgId = $(this).attr('data-img-id')
    let root = $('body').find('[data-btn-id="'+toggleId+'"]').closest('.img-manager-root')
    root.find('.img-manager-target').val(imgId)
    root.find('.media-img').attr('src', imgSrc)
  })

  $('.toggle-modal-update-page-content').click(function () {
    $('.toggle-update-page-content').toggleClass('is-active')
  })

  $('.toggle-modal-create-collection').click(function () {
    $('.toggle-create-collection').toggleClass('is-active')
  })

  $('.toggle-modal-create-post').click(function () {
    $('.toggle-create-post').toggleClass('is-active')
  })

  $('.toggle-modal-add-collection-content').click(function () {
    $('.toggle-add-collection-content').toggleClass('is-active')
  })

  $('.toggle-modal-create-page').click(function () {
    $('.toggle-create-page').toggleClass('is-active')
  })

  $('#update-page-content-form').makeReq('put', response => {
    showNotification('success', 'Content updated!')
  }, err => {
    showNotification('error', 'Something went wrong')
  })

  $('.xy-delete-content').click(function (e) {
    e.preventDefault()

    let confirm = window.confirm('Are you sure?')
    if (!confirm) return

    showLoader(true)
    let action = $(this).attr('data-action')
    window.axios.delete(action).then(response => {
      showLoader(false)
      $(this).closest('.delete-root').remove()
      showNotification('success', 'Item deleted!')
    }).catch(err => {
      showNotification('error', 'Something went wrong')
      showLoader(false)
    })
  })

  $('#update-post-content-form').makeReq('put', response => {
    showNotification('success', 'Content is updated!')
  }, err => {
    showNotification('error', 'something went wrong')
  })

  $('#edit-update-page-content-form').makeReq('put', response => {
    showNotification('success', 'Order updated!')
  }, err => {
    showNotification('error', 'Something went wrong')
  }, () => {
    let start = 0;
    $('.sortable').find('.order').each(function (index, elem) {
      $(elem).val(start)
      start++
    })
  })

  $('#update-order-form').makeReq('put', response => {
    showNotification('success', 'Order is updated!')
  }, err => {
    showNotification('error', 'something went horribly wrong.')
  }, () => {
    let start = 0;
    $('.sortable').find('.order').each(function (index, elem) {
      $(elem).val(start)
      start++
    })
  })

  $('#add-page-content-form').makeReq('post', response => {
    showNotification('success', 'Content added!')
    $('#edit-update-page-content-form').submit()
    setTimeout(function () {
      window.location.reload()
    }, 100);
  }, err => {
    showNotification('error', 'Something went wrong')
  })

  $('#update-page-seo-form').makeReq('put', response => {
    showNotification('success', 'Seo updated!')
  }, err => {
    showNotification('error', 'Something went wrong')
  })

  $('#update-page-form').makeReq('put', response => {
    showNotification('success', 'Page updated!')
  }, err => {
    showNotification('error', 'Something went wrong')
  })

  $('#delete-pages-form').makeReq('post', response => {
    showNotification('success', 'Pages(s) removed')

    $(this).find('input[name="ids[]"]').each(function () {
      if ($(this).is(':checked')) {
        $(this).closest('tr').remove()
      }
    })

    let trs = $(this).find('tbody tr')

    if (trs.length === 0) {
      window.location.reload()
    }
  }, err => {
    showNotification('error', 'Something went wrong')
  })

  $('#create-page-form').makeReq('post', response => {
    if ($('.no-result').length > 0) {
      window.location.reload()
    }

    showNotification('success', 'Page is created!')

    let html = `
      <tr>
        <td><span class="checkbox"><input class="form-checkboxes" type="checkbox" name="ids[]" value="${response.data.id}"></span></td>
        <td><a href="/cms/page/${response.data.id}">${response.data.name}</a></td>
        <td><a target="_blank" href="/${response.data.url}">${response.data.url}</a></td>
        <td>${response.data.created_at}</td>
        <td></td>
      </tr>`

    let root = $('#create-page-form').closest('.page-content')
    let tableBody = root.find('table tbody')
    tableBody.append(html)
  }, err => {
    showNotification('error', 'Something went wrong')
  })

  $('#delete-multiple-collections-form').makeReq('put', response => {
    showNotification('success', 'Collection(s) removed')

    $(this).find('input[name="ids[]"]').each(function () {
      if ($(this).is(':checked')) {
        $(this).closest('tr').remove()
      }
    })

    let trs = $(this).find('tbody tr')

    if (trs.length === 0) {
      window.location.reload()
    }
  }, err => {
    showNotification('error', 'Something went wrong')
  })

  $('#delete-multiple-posts-form').makeReq('post', response => {
    $(this).find('input[name="ids[]"]').each(function () {
      if ($(this).is(':checked')) {
        $(this).closest('tr').remove()
      }
    })

    let trs = $(this).find('tbody tr')

    if (trs.length === 0) {
      window.location.reload()
    }
  }, err => {

  })

  $('#create-post-form').makeReq('post', response => {
    showNotification('success', 'Collection is created')
    let pageContent = $(this).closest('.page-content')

    if ($('.no-result').length > 0) {
      window.location.reload()
    }

    let table = pageContent.find('#delete-multiple-posts-form')
    let htmlContent = `
      <tr>
        <td><input class="form-checkboxes" type="checkbox" name="ids[]" value="${response.data.id}"></td>
        <td><a href="/cms/collection/${$(this).find('input[name="collection-id"]').val()}/post/${response.data.id}">${response.data.name}</a></td>
        <td>${response.data.created_at}</td>
        <td></td>
      </tr>
    `
    table.find('tbody').append(htmlContent)
  }, err => {
    showNotification('error', 'Something went wrong')
  })

  $(document).on('click', '.delete-content-field', function (e) {
    e.preventDefault()
    let root = $(this).closest('.draggable-field')
    let id = $(this).attr('content-id')

    let confirm = window.confirm('Are you sure?')
    if (!confirm) {
      return
    } else {
      showLoader(false)
    }

    window.axios.delete(`/cms/collection-content/${id}/remove-content`).then(response => {
      showLoader(false)
      showNotification('success', 'Field is removed')
      root.remove()
    }).catch(err => {
      showLoader(false)
      showNotification('error', 'Something went wrong')
    })
  })

  $('#update-collection-form').makeReq('put', response => {
    showNotification('success', 'Collection is updated!')
  }, err => {
    showNotification('error', 'Something went wrong')
  })

  $('#add-content-field-form').makeReq('post', response => {
    showNotification('success', 'Field is created')
    $('#update-order-form').submit()
    window.location.reload()
  }, err => {
    showNotification('error', 'Something went wrong')
  })

  $('#create-collection-form').makeReq('post', response => {
    if ($('.no-result').length > 0) {
      window.location.reload()
    }

    let html = `
      <tr class="has-pointer show-box-data">
        <td><input class="form-checkboxes" type="checkbox" name="ids[]" value="${response.data.id}"></td>
        <td><a href="/collection/${response.data.id}">${response.data.name}</a></td>
        <td>${response.data.created_at}</td>
        <td></td>
      </tr>
    `
    let root = $('#create-collection-form').closest('.page-content')
    let tbody = root.find('table tbody')
    tbody.append(html)

    showNotification('success', 'Collection is created')
  }, err => {
    showNotification('error', 'Something went wrong')
  })

  $(document).on('click', '.content-item.is-new .delete', function () {
    $(this).closest('.content-item').remove()
    showNotification('success', 'Content is removed')
  })

  // $(document).on('click', '.delete-content', function () {
  //
  //   showLoader(true)
  //
  //   var contentItem = $(this).closest('.content-item')
  //   var contentId = contentItem.find('input[name="page-content-id"]').val()
  //   var pageId = contentItem.closest('.page').find('input[name="page-id"]').val()
  //   var url = contentItem.closest('.pages-manager').find('input[name="delete-url"]').val()
  //   window.axios.delete(url + '/' + pageId + '/' + contentId)
  //     .then(function (response) {
  //       contentItem.remove()
  //       showNotification('success', 'Content is removed')
  //       showLoader(false)
  //     }).then(function (err) {
  //       showLoader(false)
  //       if (err) showNotification('error', 'Something went wrong')
  //     })
  // })

  $('.draggable').draggable({
    connectToSortable: '.sortable',
    greedy: true,
    // helper: 'clone',
    stop: function (ev, ui) {

    }
  })

  $('.sortable').sortable({
    stop: function (ev, ui) {
      let startOrder = 0
      let items = $(ui.item).closest('.sortable').find('.draggable')
      items.each(function () {
        $(this).find('.order').val(startOrder)
        startOrder++
      })
    },
  })

  $('.droppable').droppable({
    tolerance: "intersect",
    drop: function(ev, ui) {
      $(ui.draggable).detach().css({top: 0,left: 0, width: 'auto', height: 'auto'}).appendTo(this);
    }
  })

  $('.redirecter').click(function () {
    window.location.href = $(this).attr('data-href')
  })

  $('#page-name').keyup(function () {
    var pageName = $(this).val()
    pageName = pageName.replace(/\s+/g, '-').toLowerCase()
    $('#page-url').val(pageName)
  })

  $('.all-checkboxes').click(function () {
    if ($(this).is(':checked')) {
      $('.form-checkboxes').prop('checked', true)
    } else {
      $('.form-checkboxes').prop('checked', false)
    }
  })

  $('*[data-toggle]').click(function () {

    var dataToggle = $(this).attr('data-toggle')

    $(this).closest('.toggle-parent').find('.btn-toggle').removeClass('is-active')

    $(this).addClass('is-active')

    $('.' + dataToggle).closest('.toggle-content').find('.toggle-tab').removeClass('is-active')
    $('.' + dataToggle).addClass('is-active')

  })

  $('.media-manager img').on('click', function () {
    $('.media-manager').find('.modal').addClass('is-active')
    var src = $(this).attr('src')
    var modal = $('.media-manager').find('.modal .image')
    modal.attr('src', src)
  })

  $('.modal .modal-background, .modal .modal-close').on('click', function () {
    $(this).closest('.modal').removeClass('is-active')
  })

  // toggle modal
  $('*[data-modal]').click(function () {
    var dataModal = $(this).attr('data-modal')
    $('.' + dataModal).toggleClass('is-active')
  })

  $('.toggle-sidebar').click(function () {
    $('.sidebar').toggleClass('is-active')
  })

  $('.app-content').click(function () {
    $('.sidebar').removeClass('is-active')
  })

  $('#media').on('change', function (e) {
    var media = $(this)
    var fileInfo = media.closest('.media-form').find('.files-info')
    var files = e.target.files
    fileInfo.html(' ')
    for (var i = 0; i < files.length; i++) {
      var file = files[i]
      fileInfo.append(`<li>${i+1} | ${file.name}</li>`)
    }
  })

  $('.show-image-sidebar').on('click', function () {
    var tableMedia = $(this).closest('.table-media')
    var mediaEnlarged = tableMedia.find('.media-enlarged')
    var imageName = tableMedia.find('.image-name')
    var imageId = tableMedia.find('.image-id')
    var remove = tableMedia.find('.btn-remove-media')

    var modal = tableMedia.find('.modal')
    var modalBg = modal.find('.modal-background')
    modal.addClass('is-active')
    tableMedia.find('tr').removeClass('is-selected')



    var src = $(this).attr('src')
    var name = $(this).attr('name')
    var id = $(this).attr('img-id')
    var url = $(this).attr('url')

    $(this).closest('tr').addClass('is-selected')

    mediaEnlarged.attr('src', src)
    imageName.text(name)
    imageName.attr('href', url)
    imageId.val(id)
    remove.show()
  })

  $('.delete-selected-media').on('click', function () {

    var form = $(this).closest('.media-controller').find('.media-manager').find('.delete-media-form').submit()


  })

})
