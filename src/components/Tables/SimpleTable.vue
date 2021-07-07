<template>
  <div>
    <md-table v-model="itemsOnPageArray" :table-header-color="tableHeaderColor">
      <md-table-row slot="md-table-row" slot-scope="{ item }">
        <md-table-cell md-label="ID отчета">{{ item.id }}</md-table-cell>
        <md-table-cell md-label="Дата отчета">{{ item.created }}</md-table-cell>
        <md-table-cell md-label="Начало периода">{{
          item.s_date
        }}</md-table-cell>
        <md-table-cell md-label="Конец периода">{{
          item.e_date
        }}</md-table-cell>
        <md-table-cell md-label="Отчет">
          <a
            :id="'yourId' + item.id"
            :href="item.file"
            target="_blank"
            style="display: none;"
          ></a>
          <md-button
            v-show="item.state"
            v-if="(download = item.state)"
            class="md-primary md-sm"
            @click="openfile(item.id)"
            >WEB</md-button
          >
          <md-button v-show="!item.state" class="md-sm"
            ><md-icon>history</md-icon> WEB</md-button
          >

          <a
            :id="'yourId2' + item.id"
            :href="item.file2"
            target="_blank"
            style="display: none;"
          ></a>
          <md-button
            v-show="item.state"
            v-if="(download = item.state)"
            class="md-primary md-sm"
            @click="openfile2(item.id)"
            >CSV</md-button
          >
          <md-button v-show="!item.state" class="md-sm"
            ><md-icon>history</md-icon> CSV</md-button
          >
        </md-table-cell>
        <md-table-cell md-label="Статус">
          <md-button
            class="md-success md-just-icon"
            @click="play(item.id, item.state)"
            ><md-icon>{{ item.icon }}</md-icon
            ><md-tooltip md-direction="top">Статус</md-tooltip></md-button
          >
          <md-button class="md-simple" @click="deleteItem(item.id)"
            ><md-icon>clear</md-icon
            ><md-tooltip md-direction="top">Удалить</md-tooltip></md-button
          >
        </md-table-cell>
      </md-table-row>
    </md-table>
    <br />
    <center v-if="totalTabs > 1">
      <div
        width="100%"
        style="display: flex;align-items: center; justify-content: center;"
      >
        <ul class="pagination nav nav-pills nav-pills-primary" role="tablist">
          <template v-for="index in totalTabs">
            <li
              class="page-item"
              :class="{ active: currentTab == index }"
              :key="index"
              @click="currentTab = index"
            >
              <a
                class="page-link"
                data-toggle="tab"
                :href="'#tab' + index"
                role="tablist"
                aria-expanded="true"
                >{{ index }}</a
              >
            </li>
          </template>
        </ul>
      </div>
    </center>
  </div>
</template>

<script>
import _ from 'lodash';
import { http } from './../../http';
import { eventEmitter } from './../../main';

export default {
  name: 'simple-table',
  data() {
    return {
      currentTab: 1,
      itemsOnPage: 10,
      selected: [],
      icon: 'play_arrow',
      download: true,
    };
  },
  props: {
    tableHeaderColor: {
      type: String,
      default: '',
    },
  },
  computed: {
    elements() {
      return this.$store.getters.currentElements;
    },
    totalTabs: function() {
      return Math.ceil(
        this.$store.getters.currentElements.length / this.itemsOnPage,
      );
    },
    itemsOnPageArray: function() {
      console.log(this.$store.getters.currentElements);
      return _.slice(
        this.$store.getters.currentElements,
        this.itemsOnPage * this.currentTab - this.itemsOnPage,
        this.itemsOnPage * this.currentTab,
      );
    },
  },
  methods: {
    openfile(value) {
      document.getElementById('yourId' + value).click();
    },
    openfile2(value) {
      document.getElementById('yourId2' + value).click();
    },
    deleteItem(value) {},

    play(value, state) {
      if (state == '') {
        http
          .get('addtowork', {
            params: {
              id: value,
            },
          })
          .then(() => {
            alert('Задание добавлено в работу. Ожидайте.');
          });
      } else {
        alert('Задание уже в работе или выполнено');
      }
    },
  },
};
</script>
