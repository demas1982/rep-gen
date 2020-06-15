import Vue from 'vue';
import Vuex from 'vuex';
import { http } from '../http.js';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    reports: {},
    elements: {},
    currentReport: '',
  },
  getters: {
    currentElements: (state) => {
      return state.elements.filter(
        (elements) => elements.reportid == state.currentReport,
      );
    },
  },
  mutations: {
    setReports(state, payload) {
      state.reports = payload;
    },
    setElements(state, payload) {
      state.elements = payload;
    },
    setCurrentReport(state, payload) {
      state.currentReport = payload;
    },
  },
  actions: {
    getReports({ commit, state }) {
      http.get(`getReports`).then((response) => {
        commit('setReports', response.data);
      });
    },
    getElements({ commit }, state) {
      http.get('getElements').then((response) => {
        commit('setElements', response.data);
      });
    },
  },
});
