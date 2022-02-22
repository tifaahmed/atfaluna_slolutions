import Vue       from 'vue'                           ;
import VueRouter from 'vue-router'                    ;

import routes    from './Routes'             ;

import layout    from '@/layout.vue' ;

// notification
import Swal from 'sweetalert2'
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  window.Toast = Toast;



window.Vue = require('vue').default;





Vue.use( VueRouter ) ;

const app = new Vue({
    el: '#app',
    router  :  new VueRouter( routes ) ,
    render  : h => h( layout ),

    data: {
        query: {
            CurrentPage:1,
        }
    //     messages: [],
    //     newMessage: '',
    //     user: '',
    //     typing: false
    },
    // methods: {
    //     sendMessage() {
    //         // add new message to messages array
    //         this.messages.push({
    //             user: Laravel.user,
    //             message: this.newMessage
    //         });

    //         // clear input field
    //         this.newMessage = '';

    //         // persist to database
    //     }
    // }
});


