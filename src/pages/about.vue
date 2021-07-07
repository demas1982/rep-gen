<template>
  <div class="content">
    <div class="md-layout">
      <div class="md-layout-item">
        <md-card>
          <md-card-header data-background-color="green">
            <h4 class="title">История версий</h4>
          </md-card-header>
          <md-card-content>
            <div id="typography">
              <h3>06.2020</h3>
              - Бэкэнд сменен с PHP на NODE.js<br />
              - Подключено внутреннее хранилище<br />
              - Пагинация отчетов<br />
              <br />
              <h3>12.2019</h3>
              - Добавлен отчет по не гармонизированным ОКС<br />
              <br />
              <h3>09.2019</h3>
              - Возможность выполнения нескольких запросов в ТИР<br />
              - Выгрузка отчетов в CSV<br />
              <br />
              <h3>07.2019</h3>
              - Основа<br />
            </div>
          </md-card-content>
        </md-card>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    dataBackgroundColor: {
      type: String,
      default: '',
    },
  },
};
</script>
