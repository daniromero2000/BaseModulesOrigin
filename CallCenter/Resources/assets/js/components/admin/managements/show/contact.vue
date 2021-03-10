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
    <h6 class="heading-small text-muted mb-4">INFORMACIÓN DE CONTACTO</h6>
    <div class="pl-lg-4">
      <div class="row">
        <div class="col-lg-4">
          <div class="form-group">
            <label class="form-control-label" for="input-city">Celular</label>
            <input
              type="text"
              id="input-city"
              class="form-control"
              :value="
                customer[0].customer_oportudata.CELULAR != ''
                  ? customer[0].customer_oportudata.CELULAR
                  : 'NA'
              "
            />
          </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group">
            <label class="form-control-label" for="input-country"
              >Telefono</label
            >
            <input
              type="text"
              id="input-country"
              class="form-control"
              placeholder="Country"
              :value="
                customer[0].customer_oportudata.TELFIJO != ''
                  ? customer[0].customer_oportudata.TELFIJO
                  : 'NA'
              "
            />
          </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group">
            <label class="form-control-label" for="input-country">Correo</label>
            <input
              type="text"
              id="input-postal-code"
              class="form-control"
              :value="
                customer[0].customer_oportudata.EMAIL != ''
                  ? customer[0].customer_oportudata.EMAIL
                  : 'NA'
              "
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>