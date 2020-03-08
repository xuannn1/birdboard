/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VModal from 'vue-js-modal'
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

import {
    faArrowUp,
    faPlus,
    faPen
} from '@fortawesome/free-solid-svg-icons';

library.add(
    faArrowUp,
    faPlus,
    faPen
);

Vue.use(VModal)

Vue.component('font-awesome-icon', FontAwesomeIcon);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('theme-switcher', require('./components/ThemeSwitcher.vue').default);
Vue.component('project-create', require('./components/ProjectCreate.vue').default);
Vue.component('project-edit', require('./components/ProjectEdit.vue').default);
Vue.component('dropdown', require('./components/Dropdown.vue').default);
Vue.component('scroll-link', require('./components/ScrollLink.vue').default);
Vue.component('count-down', require('./components/CountDown.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
