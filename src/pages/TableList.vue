<template>
  <div class="content">
    <div class="md-layout">
      <div  class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
        <md-card style="z-index: 2;">
          <md-card-content sty>
            <div class="row">
            
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="label-control">Начало периода</label>
                    <input type="text" class="form-control datetimepicker" value="01/01/2019"/>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="label-control">Окончание периода</label>
                    <input id="datetimepicker7" type="text" class="form-control datetimepicker" value="01/07/2019"/>
                  </div>
                </div>
                <div class="col-md-4" style="margin-top: 12px;">
                  <md-button class="md-success">Добавить отчет</md-button>
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
import { SimpleTable } from "@/components";

export default {
  components: {
    SimpleTable
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

today = mm + '/' + dd + '/' + yyyy;
  alert(today);
  $('#datetimepicker7').data("DateTimePicker").maxDate(today);
 }
};
</script>
