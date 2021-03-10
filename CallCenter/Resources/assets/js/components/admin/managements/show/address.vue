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
    <h6 class="heading-small text-muted mb-4">INFORMACIÓN DE RECIDENCIA</h6>
    <div class="pl-lg-2">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-control-label" for="input-address"
              >Ciudad de ubicación</label
            >
            <input
              id="input-address"
              class="form-control"
              :value="
                customer[0].customer_oportudata.CIUD_UBI != ''
                  ? customer[0].customer_oportudata.CIUD_UBI
                  : 'NA'
              "
              type="text"
            />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-control-label" for="input-address"
              >Tipo de vivienda</label
            >
            <input
              id="input-address"
              class="form-control"
              :value="
                customer[0].customer_oportudata.TIPOV != ''
                  ? customer[0].customer_oportudata.TIPOV
                  : 'NA'
              "
              type="text"
            />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-control-label" for="input-address"
              >Tiempo en vivienda</label
            >
            <input
              id="input-address"
              class="form-control"
              :value="
                customer[0].customer_oportudata.TIEMPO_VIV != ''
                  ? customer[0].customer_oportudata.TIEMPO_VIV
                  : 'NA'
              "
              type="text"
            />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-control-label" for="input-address"
              >Sucursal</label
            >
            <input
              id="input-address"
              class="form-control"
              :value="
                customer[0].customer_oportudata.SUC != ''
                  ? customer[0].customer_oportudata.SUC
                  : 'NA'
              "
              type="text"
            />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-control-label" for="input-address"
              >Tipo de población</label
            >
            <input
              id="input-address"
              class="form-control"
              :value="
                customer[0].customer_oportudata.DIRECCION3 != ''
                  ? customer[0].customer_oportudata.DIRECCION3
                  : 'NA'
              "
              type="text"
            />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-control-label" for="input-address"
              >Estrato</label
            >
            <input
              id="input-address"
              class="form-control"
              :value="
                customer[0].customer_oportudata.ESTRATO != ''
                  ? customer[0].customer_oportudata.ESTRATO
                  : 'NA'
              "
              type="text"
            />
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label class="form-control-label" for="input-address"
              >Dirección</label
            >
            <input
              id="input-address"
              class="form-control"
              :value="
                customer[0].customer_oportudata.DIRECCION != ''
                  ? customer[0].customer_oportudata.DIRECCION
                  : 'NA'
              "
              type="text"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>