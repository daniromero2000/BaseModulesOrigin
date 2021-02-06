<template>
  <b-card no-body class="card bg-white shadow border-0">
    <b-card-header class="bg-white">
      <div class="row">
        <div class="col">
          <h3 class="mb-0 h4">Actividades Económicas</h3>
        </div>
        <div class="col text-right">
          <b-button variant="primary" class="btn-sm" v-b-modal.addActivity>Agregar</b-button>
        </div>
      </div>
    </b-card-header>
    <div>
      <div class="table-responsive">
        <table
          class="table table-hover text-center"
        >
          <thead class="small">
            <tr>
              <th class="text-center" scope="col">Tipo Actividad</th>
              <th class="text-center" scope="col">Nombre Entidad</th>
              <th class="text-center" scope="col">Cargo</th>
              <th class="text-center" scope="col">Dirección Entidad</th>
              <th class="text-center" scope="col">Teléfono Entidad</th>
              <th class="text-center" scope="col">Ciudad</th>
            </tr>
          </thead>
          <tbody class="small">
            <!-- <tr v-for="(data, key) in customer.customer_economic_activities" :key="key"> -->
              <tr>
              <td
                scope="row"
              >test</td>
              <td scope="row">test</td>
              <td scope="row">test</td>
              <td scope="row">test</td>
              <td scope="row">test</td>
              <td scope="row">test</td>
            </tr>
          </tbody>
        </table>
      </div>
      <b-overlay :show="show" no-wrap></b-overlay>
    </div>
  </b-card>
</template>
<script>

export default {
  components: {
  },
  data() {
    return {
      show: false
    };
  },
  mounted() {
    this.$store.commit("toggleBusy", true);
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
      this.$store.commit("toggleBusy", true);
    }
  },
  computed: {
    customer() {
      return this.$store.state.customer;
    }
  },
  watch: {
    customer() {
      this.show = false;
    }
  }
};
</script>
