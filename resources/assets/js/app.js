
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/*global Vue*/
/*global axios*/

//require('./bootstrap');
//window.Vue = require('vue');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example-component', require('./components/ExampleComponent.vue'));

//const app = new Vue({
    //el: '#app'
//});


//import VueRouter from 'vue-router'

//Vue.use(VueRouter)

//window.Vue=require('axios');



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

const likeButton={
  props:['enpost_id', 'like_count'],
  data(){
    return{
      flag:false,
      count:0
    };
  },
  template:`
    <div>
      <button v-if='flag' v-on:click="addLikes" class="btn btn-danger btn-block">
        いいね!!  {{count}}  
      </button>
       <button v-else v-on:click="addLikes" class="btn btn-default btn-block">
        いいね!!  {{count}}
      </button>
    </div>
  `,
  created(){
    this.getLikes();
  },
  methods:{
    addLikes(){
      axios.post('/addlike',{
        enpost_id:this.enpost_id
      }).then(e=>{
        this.flag=e.data.res;
        console.log(e.data.res);
        this.count=e.data.like_count;
      }).catch((error)=>{
        console.log("エラー");
      });
    },
    
    getLikes(){
      axios.post('/getlike',{
        enpost_id:this.enpost_id
      }).then(e=>{
        this.flag=e.data.res;
        console.log(e.data.res);
        this.count=e.data.like_count;
      }).catch((error)=>{
        console.log("エラー");
      });
    },
  },
};

new Vue({
  el:'#commons-enpostsdetails-like-button',
  components:{
    'like-button': likeButton,
  }
})

new Vue({
  el:'#enposts-create-tag',
  data(){
    return{
      isMouseOn:false,
    }
  },
  methods:{
    mouseover(){
      this.isMouseOn=true
    },
    mouseleave(){
      this.isMouseOn=false
    }
  }
})