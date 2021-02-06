<template>
  <b-card no-body class="card bg-white shadow border-0">
    <b-card-header class="bg-white">
      <div class="row">
        <div class="col">
          <h3 class="mb-0 h4">Campaña</h3>
        </div>
        <div class="col text-right">
          <b-button variant="primary" class="btn-sm" v-b-modal.addIdentification
            >Agregar</b-button
          >
        </div>
      </div>
    </b-card-header>
    <div>
      <div class="row">
        <div class="col-12">
          <div class="card-body">
            <div class="form-group">
              <label for="">Articulo</label>
              <input
                type="text"
                name=""
                id=""
                class="form-control"
                placeholder=""
                aria-describedby="helpId"
              />
            </div>
            <div class="form-group">
              <label for="">Observaciónes</label>
              <textarea
                name=""
                id=""
                class="form-control"
                cols="10"
                rows="10"
              ></textarea>
            </div>
            <div class="form-group">
              <label for="">Indicadores de gestion</label>
              <select name="" id="" class="form-control">
                <option value="">Example</option>
              </select>
            </div>
            <div class="form-group">
              <label for="">Calificación</label>
              <select name="" id="" class="form-control">
                <option value="">Example</option>
              </select>
            </div>
            <div class="form-group">
              <label for="">Quien contesta</label>
              <input
                type="text"
                name=""
                id=""
                class="form-control"
                placeholder=""
                aria-describedby="helpId"
              />
            </div>
          </div>
        </div>
      </div>
      <b-overlay :show="show" no-wrap></b-overlay>
    </div>
  </b-card>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      form: {
        from: "",
        to: "",
        search: "",
      },
      show: false,
    };
  },
  mounted() {
    this.$store.commit("toggleBusy", true);
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
      this.$store.commit("toggleBusy", true);
    },
  },
  computed: {
    customer() {
      return this.$store.state.customer;
    },
  },
  watch: {
    customer() {
      this.show = false;
    },
  },
};
</script>
