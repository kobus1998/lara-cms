
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

})
