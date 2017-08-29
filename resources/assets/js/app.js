
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});

$(document).ready(function () {

  $(document).on('click', '.content-item.is-new .delete', function () {
    console.log('remove');
    $(this).closest('.content-item').remove()
  })

  $('.delete-content').click(function () {
    var contentItem = $(this).closest('.content-item')
    var contentId = contentItem.find('input[name="content-id"]').val()
    var pageId = contentItem.closest('.page').find('input[name="page-id"]').val()
    window.axios.delete('/api/cms/page-methods/delete-content/' + pageId + '/' + contentId)
      .then(function (response) {
        contentItem.remove()
      }).then(function (err) {
        console.log(err)
      })
  })

  $('.save-content-manager').click(function () {
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

    console.log(pages)



    window.axios.post('/api/cms/page-methods/save-content-manager', {
      pages: pages
    }).then(function (response) {
      console.log(response)
    }).catch(function (err) {
      console.log(err)
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
        console.log(startOrder);
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
