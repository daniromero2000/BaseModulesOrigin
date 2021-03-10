<script>
export default {
  components: {},
  data() {
    return {
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
<style>
.form-group {
  margin-bottom: 1.1rem !important;
}

.form-control-label {
  font-size: 0.8rem !important;
}

.form-control {
  font-size: 0.8rem;
  height: calc(1.3em + 1.25rem + 5px);
  transition: all 0.15s ease-in-out;
}

.card-profile-stats > div .description {
  font-size: 0.8rem;
  color: #adb5bd;
}
</style>
<template>
  <div v-if="customer[0]">
    <h6 class="heading-small text-muted mb-4">INFORMACIÓN DE IDENTIFICACIÓN</h6>
    <div class="pl-lg-2">
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label" for="input-country"
              >Tipo de Documento</label
            >
            <input
              type="text"
              id="input-country"
              class="form-control"
              placeholder="Country"
              :value="
                customer[0].customer_oportudata.TIPO_DOC != ''
                  ? customer[0].customer_oportudata.TIPO_DOC == 1
                    ? 'Cédula'
                    : 'NA'
                  : 'NA'
              "
            />
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label" for="input-city"
              >Numero de documento</label
            >
            <input
              type="text"
              id="input-city"
              class="form-control"
              :value="customer[0].customer_oportudata.CEDULA"
            />
          </div>
        </div>

        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label" for="input-country">Fecha de expedición</label>
            <input
              type="date"
              id="input-postal-code"
              class="form-control"
              :value="
                customer[0].customer_oportudata.FEC_EXP != ''
                  ? customer[0].customer_oportudata.FEC_EXP
                  : 'NA'
              "
            />
          </div>
        </div>
         <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label" for="input-country">Ciudad de expedición</label>
            <input
              type="text"
              id="input-postal-code"
              class="form-control"
              :value="
                customer[0].customer_oportudata.CIUD_EXP != ''
                  ? customer[0].customer_oportudata.CIUD_EXP
                  : 'NA'
              "
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>