import Vue from 'vue';
import Vuex from 'vuex';
import { http } from '../http.js';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    reports: {},
  },
  getters: {},
  mutations: {
    setReports(state, payload) {
      state.reports = payload;
    },
  },
  actions: {
    getReports({ commit, state }) {
      http.get(`/getReports`).then((response) => {
        commit('setReports', response.data);
      });
    },
  },
});
