import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store/index.js';
import App from './App';

export const eventEmitter = new Vue();

// router setup
import routes from './routes/routes';

// Plugins
import GlobalComponents from './globalComponents';
import GlobalDirectives from './globalDirectives';
import Notifications from './components/NotificationPlugin';

// MaterialDashboard plugin
import MaterialDashboard from './material-dashboard';

import Chartist from 'chartist';

// configure router
const router = new VueRouter({
  routes, // short for routes: routes
  linkExactActiveClass: 'nav-item active',
});

Vue.prototype.$Chartist = Chartist;

Vue.use(VueRouter);
Vue.use(MaterialDashboard);
Vue.use(GlobalComponents);
Vue.use(GlobalDirectives);
Vue.use(Notifications);

/* eslint-disable no-new */
new Vue({
  store,
  el: '#app',
  render: (h) => h(App),
  router,
  data: {
    Chartist: Chartist,
  },
  created() {
    this.$store.dispatch('getReports');
  },
});
