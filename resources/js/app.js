/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
//qui è nostro sopra tutta merda laravel

$(document).ready(function(){

  $('html').click(
    function(){
    $('div.dropcontent').hide();
    }
  );

  $('.dropdown').click(function(e){
      e.stopPropagation();
  });

  $('.dropdown').click(function() {
    $('div.dropcontent').fadeToggle();
  });


  $('.posta').on('click', '.text', function() {
    $(this).siblings('div.textintero').fadeIn();
  });

  $('.fa-times').click(
    function(){
    $('div.textintero').fadeOut();
    }
  );

  $( function() {
    $('services').tooltip();
  } );

  $('.container').keypress(function(enter) {
    if ( enter.which == 13 ) {
    $('#bottone').click();
    }
  });

});
