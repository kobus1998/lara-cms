
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

function showLoader (state) {
  if (state) {
    $('.notification-loading').show()
  } else if (!state) {
    $('.notification-loading').hide()
  }
}

function showNotification (type, message) {
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

  $(document).on('click', '.content-item.is-new .delete', function () {
    $(this).closest('.content-item').remove()
    showNotification('success', 'Content is removed')
  })

  $('.delete-content').click(function () {

    showLoader(true)

    var contentItem = $(this).closest('.content-item')
    var contentId = contentItem.find('input[name="content-id"]').val()
    var pageId = contentItem.closest('.page').find('input[name="page-id"]').val()
    window.axios.delete('/api/cms/page-methods/delete-content/' + pageId + '/' + contentId)
      .then(function (response) {
        contentItem.remove()
        showNotification('success', 'Content is removed')
        showLoader(false)
      }).then(function (err) {
        showLoader(false)
        if (err) showNotification('error', 'Something went wrong')
      })
  })

  $('.save-content-manager').click(function () {
    showLoader(true)
    var pages = []
    $('.page').each(function () {
      var currentPage = {
        'page-id': $(this).find('input[name="page-id"]').val(),
        'content': []
      }

      $(this).find('.content-item').each(function () {
        var isNew = false

        if ($(this).hasClass('is-new')) {
          isNew = true
        }

        currentPage.content.push({
          id: $(this).find('input[name="content-id"]').val(),
          order: $(this).find('input[name="order"]').val(),
          isNew: isNew,
        })

        $(this).removeClass('is-new')
      })

      pages.push(currentPage)
    })

    window.axios.post('/api/cms/page-methods/save-content-manager', {
      pages: pages
    }).then(function (response) {
      showNotification('success', 'Pages are saved')
      showLoader(false)
    }).catch(function (err) {
      showLoader(false)
      if (err) showNotification('error', 'Something went wrong')
    })

  })

  $('.draggable').draggable({
    connectToSortable: '.sortable',
    greedy: true,
    helper: 'clone',
    stop: function (ev, ui) {

    }
  })

  $('.sortable').sortable({
    stop: function (ev, ui) {
      var page = $(ui.item).closest('.page')
      var pageId = page.find('input[name="page-id"]').val()
      var contentItems = page.find('.content-item')

      var startOrder = 0

      contentItems.each(function () {
        $(this).find('input[name="order"]').val(startOrder)
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

})
