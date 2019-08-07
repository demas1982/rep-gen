<template>
  <div>
    <md-table v-model="users" :table-header-color="tableHeaderColor">
      <md-table-row slot="md-table-row" slot-scope="{ item }">
        <md-table-cell md-label="Начало периода">{{ item.s_date }}</md-table-cell>
        <md-table-cell md-label="Конец периода">{{ item.e_date }}</md-table-cell>
        <md-table-cell md-label="Результат / статус">{{ item.state }}</md-table-cell>
        <md-table-cell md-label="Действия">
          <md-button class="md-success md-just-icon" @click="play(item.id, item.state)"><md-icon >{{ item.icon }}</md-icon></md-button>
        </md-table-cell>
      </md-table-row>
    </md-table>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: "simple-table",
  props: {
    tableHeaderColor: {
      type: String,
      default: ""
    }
  },
  methods:{
    play(value, state){
      if (state == ''){
      axios
      .get('public/rep_gen.php?action=addtowork&id=' + value)
      .then(response => {
        alert('Задание добавлено в работу. Ожидайте.');
        axios
      .get('public/rep_gen.php?action=getList')
      .then(response => {
        this.users = response.data;
    });
      });
      } else {
        alert('Задание уже в работе или выполнено');
      }
    }
  },
  mounted(){
    axios
      .get('public/rep_gen.php?action=getList')
      .then(response => {
        this.users = response.data;
    });
  },
  data() {
    return {
      selected: [],
      icon: 'play_arrow',
      users: [
        {
          name: "Mason Porter",
          salary: "$78,615",
          country: "Chile",
          city: "Gloucester"
        }
      ]
    };
  }
};
</script>
