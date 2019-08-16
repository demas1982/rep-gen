<template>
  <div class="content">
    <div class="md-layout">
      <div  class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
        <md-card style="z-index: 2;">
          <md-card-content sty>
            <div class="row">
            
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="label-control">Начало периода</label>
                    <input id="datetimepicker1" v-model="s_date" type="text" class="form-control datetimepicker">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="label-control">Окончание периода</label>
                    <input id="datetimepicker2" v-model="e_date" type="text" class="form-control datetimepicker"/>
                  </div>
                </div>
                <div class="col-md-3" style="margin-top: 12px;">
                  <md-button v-show="!inWork" @click="addReport()" class="md-success">Добавить отчет</md-button>
                  <md-button v-show="inWork">Добавить отчет</md-button>
                </div>
 
            </div>
            
          </md-card-content>
        </md-card>
        <md-card  style="z-index: 1;">
          <md-card-header data-background-color="green">
            <h4 class="title">Отчеты по сканированию МФЦ</h4>
            <p class="category">Тут отображаются сформированные отчеты относительно качества сканирования принимаемых документов МФЦ</p>
          </md-card-header>
          <md-card-content>
            <simple-table table-header-color="green"></simple-table>
          </md-card-content>
        </md-card>
      </div>
    </div>
  </div>
</template>

<script>
import {http} from './../http'
import { SimpleTable } from "@/components";
import {eventEmitter} from "./../main"

export default {
  components: {
    SimpleTable
  },
    data () {
    return {
      s_date: "01/08/2019",
      e_date: "05/08/2019",
      timer: '',
      inWork: false
     }
  },
  methods: {
    addReport(){
      this.inWork = true;
      eventEmitter.$emit('loadTable');
      this.s_date = document.getElementById("datetimepicker1").value;
      this.e_date = document.getElementById("datetimepicker2").value;
      http.get('addReport', {
        params: {
          s_date: this.s_date,
          e_date: this.e_date
        }
      })
      .then(response => {
        this.users = response.data;
      });
      eventEmitter.$emit('loadTable');
      http.get('startWork')
      .then(response => {
          this.inWork = false;
          eventEmitter.$emit('loadTable');
      });
    },
    reloadTable(){
      eventEmitter.$emit('loadTable');
    }
  },
  created(){
    this.reloadTable();
    var id = setInterval(() => this.reloadTable(), 3000);
  },
  mounted(){
    $('.datetimepicker').datetimepicker({
      format: 'L',
      locale: 'ru',
      icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'
      }
    });
  
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = dd + '/' + mm + '/' + yyyy;
    $('#datetimepicker2').data("DateTimePicker").maxDate(today);
 }
};
</script>
