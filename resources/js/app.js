require('./bootstrap');

import Vue from 'vue'

import AgentLogin from './components/agent/Login.vue'
import TicketCreate from './components/ticket/Create.vue'
import ReplyCreate from './components/ticket/Reply.vue'

Vue.component('hd-agent-login', AgentLogin)
Vue.component('hd-ticket-create', TicketCreate)
Vue.component('hd-ticket-reply', ReplyCreate)

const app = new Vue({el : '#app'});