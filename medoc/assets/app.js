/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

import { createApp } from 'vue';
import App from './js/App.vue';
import router from './router';

// app.mount('#vue-app');
createApp(App)
.use(router)
.mount('#vue-app');
// console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
