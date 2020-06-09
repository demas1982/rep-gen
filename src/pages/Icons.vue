<template>
  <div class="content">
    <div class="md-layout">
      <div class="md-layout-item">
        <md-card style="z-index: 1;">
          <md-card-header data-background-color="green">
            <h4 class="title">Редактор запросов</h4>
            <p class="category">
              Тут вы можете добавить и отредактировать запросы. В дальнейшем
              пользователи смогут их запускать и получать готовые отчеты.
            </p>
          </md-card-header>

          <md-card-content>
            <md-table v-model="reports" :table-header-color="tableHeaderColor">
              <md-table-row slot="md-table-row" slot-scope="{ item }">
                <md-table-cell md-label="ID запроса">{{
                  item.id
                }}</md-table-cell>
                <md-table-cell md-label="Название">{{
                  item.name
                }}</md-table-cell>
                <md-table-cell>
                  <md-button class="md-just-icon md-simple md-primary">
                    <md-icon>edit</md-icon>
                    <md-tooltip md-direction="top">Редактировать</md-tooltip>
                  </md-button>
                </md-table-cell>
              </md-table-row>
            </md-table>
          </md-card-content>
        </md-card>
      </div>
    </div>
  </div>
</template>

<script>
import { http } from './../http';
import { eventEmitter } from './../main';

export default {
  name: 'simple-table',
  props: {
    tableHeaderColor: {
      type: String,
      default: '',
    },
  },
  computed: {
    reports() {
      return this.$store.state.reports;
    },
  },
  data() {
    return {
      selected: [],
      icon: 'play_arrow',
      download: true,
      users: [],
    };
  },
};
</script>
