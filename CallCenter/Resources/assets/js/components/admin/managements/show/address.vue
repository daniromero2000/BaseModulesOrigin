<template>
  <b-card no-body class="card bg-white shadow border-0">
    <b-card-header class="bg-white">
      <div class="row">
        <div class="col">
          <h3 class="mb-0 h4">Datos de Residencia</h3>
        </div>
        <div class="col text-right">
          <b-button variant="primary" class="btn-sm" v-b-modal.addAddress>Agregar</b-button>
        </div>
      </div>
    </b-card-header>
    <div>
      <div class="table-responsive">
        <table
          class="table align-items-center table-flush table-hover"
        >
          <thead class="small">
            <tr>
              <th class="text-center" scope="col">Tipo Vivienda</th>
              <th class="text-center" scope="col">Antiguedad</th>
              <th class="text-center" scope="col">Dirección</th>
              <th class="text-center" scope="col">Estrato SocioEconómico</th>
              <th class="text-center" scope="col">Ciudad</th>
              <th class="text-center" scope="col">Departamento</th>
            </tr>
          </thead>
          <tbody class="small text-center">
            <!-- <tr v-for="(customer_address, key) in customer.customer_addresses" :key="key"> -->
<tr>
              <td scope="row">test</td>
              <td scope="row">test</td>
              <td scope="row">test</td>
              <td
                scope="row"
              >test</td>
              <td scope="row">test</td>
              <td
                                scope="row"
              >test</td>
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
  data() {
    return {
      form: {
        from: "",
        to: "",
        search: ""
      },
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
