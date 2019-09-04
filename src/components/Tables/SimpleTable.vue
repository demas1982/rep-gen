<template>
  <div>
    <md-table v-model="users" :table-header-color="tableHeaderColor">
      <md-table-row slot="md-table-row" slot-scope="{ item }">
        <md-table-cell md-label="ID отчета">{{ item.id }}</md-table-cell>
        <md-table-cell md-label="Дата отчета">{{ item.created }}</md-table-cell>
        <md-table-cell md-label="Начало периода">{{ item.s_date }}</md-table-cell>
        <md-table-cell md-label="Конец периода">{{ item.e_date }}</md-table-cell>
        <md-table-cell md-label="Отчет">
          <a :id="'yourId'+item.id" :href="item.file" target="_blank" style="display: none;"></a>
          <md-button v-show="item.state" v-if="download = item.state" class="md-primary md-sm" @click="openfile(item.id)">WEB</md-button>
          <md-button v-show="!item.state" class="md-sm"><md-icon>history</md-icon> WEB</md-button>

          <a :id="'yourId2'+item.id" :href="item.file2" target="_blank" style="display: none;"></a>
          <md-button v-show="item.state" v-if="download = item.state" class="md-primary md-sm" @click="openfile2(item.id)">CSV</md-button>
          <md-button v-show="!item.state" class="md-sm"><md-icon>history</md-icon> CSV</md-button>
        </md-table-cell>
        <md-table-cell md-label="Статус">
          <md-button class="md-success md-just-icon" @click="play(item.id, item.state)"><md-icon >{{ item.icon }}</md-icon><md-tooltip md-direction="top">Статус</md-tooltip></md-button>
          <md-button class="md-simple" @click="deleteItem(item.id)"><md-icon>clear</md-icon><md-tooltip md-direction="top">Удалить</md-tooltip></md-button>
        </md-table-cell>
      </md-table-row>
    </md-table>
  </div>
</template>

<script>
import {http} from './../../http'
import {eventEmitter} from "./../../main"

export default {
  name: "simple-table",
  props: {
    tableHeaderColor: {
      type: String,
      default: ""
    }
  },
  methods:{
    openfile(value){
      document.getElementById("yourId" + value).click();
    },
    openfile2(value){
      document.getElementById("yourId2" + value).click();
    },
    deleteItem(value){
        http.get('delete', {
          params: {
            id: value
          }
      })
      .then(response => {
        eventEmitter.$emit('loadTable');
      });
    },
    play(value, state){
      if (state == ''){
        http.get('addtowork', {
          params: {
            id: value
          }
      })
      .then(response => {
        alert('Задание добавлено в работу. Ожидайте.');
         this.getList();
      });
      } else {
        alert('Задание уже в работе или выполнено');
      }
    },
    getList(value){
      http.get('getList', {
        params:{
          id: value
        }
      })
      .then(response => {
        this.users = response.data;
      });
    }
  },
  mounted(){
    // this.getList();
  },
  created(){
    eventEmitter.$on('loadTable', (value) => {
       this.getList(value);
    });
  },
  data() {
    return {
      selected: [],
      icon: 'play_arrow',
      download: true,
      users: []
    };
  }
};
</script>
