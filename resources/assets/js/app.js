
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/*global Vue*/

//require('./bootstrap');

//window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example-component', require('./components/ExampleComponent.vue'));

//const app = new Vue({
    //el: '#app'
//});

new Vue({
    el:'#user-tab',
    data:{
     activeTab:`enposts-tab`,
    },
});

new Vue({
  el:'#users-card-modal',
  data:{
    showContent: false
  },
  methods:{
    openModal:function(){
      this.showContent=true
    },
    closeModal:function(){
      this.showContent=false
    },
    stopEvent:function(){
      event.stop()
    }
  }
});
