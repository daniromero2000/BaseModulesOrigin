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
  <div>
    <h6 class="heading-small text-muted mb-4">Actividad Económica</h6>
    <div class="pl-lg-4">
      <div
        v-if="
          (customer[0] &&
            customer[0].customer_oportudata.ACTIVIDAD == 'EMPLEADO') ||
          customer[0].customer_oportudata.ACTIVIDAD ==
            'SOLDADO-MILITAR-POLICÍA' ||
          customer[0].customer_oportudata.ACTIVIDAD == 'PRESTACIÓN DE SERVICIOS'
        "
        class="row"
      >
        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label" for="input-username"
              >Actividad</label
            >
            <input
              type="text"
              class="form-control"
              placeholder="Actividad"
              :value="
                customer[0].customer_oportudata.ACTIVIDAD != ''
                  ? customer[0].customer_oportudata.ACTIVIDAD
                  : 'NA'
              "
            />
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label" for="input-email">Empresa</label>
            <input
              type="email"
              id="input-email"
              class="form-control"
              placeholder="Empresa"
              :value="
                customer[0].customer_oportudata.RAZON_SOC != ''
                  ? customer[0].customer_oportudata.RAZON_SOC
                  : 'NA'
              "
            />
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label" for="input-first-name"
              >Cargo</label
            >
            <input
              type="text"
              id="input-first-name"
              class="form-control"
              placeholder="Cargo"
              :value="
                customer[0].customer_oportudata.CARGO != ''
                  ? customer[0].customer_oportudata.CARGO
                  : 'NA'
              "
            />
          </div>
        </div>

        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label" for="input-first-name"
              >Tipo de contrato</label
            >
            <input
              type="text"
              id="input-first-name"
              class="form-control"
              placeholder="Tipo de contrato"
              :value="
                customer[0].customer_oportudata.TIPO_CONT != ''
                  ? customer[0].customer_oportudata.TIPO_CONT
                  : 'NA'
              "
            />
          </div>
        </div>

        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label" for="input-first-name"
              >Fecha de ingreso</label
            >
            <input
              type="date"
              id="input-first-name"
              class="form-control"
              placeholder="Tipo de contrato"
              :value="
                customer[0].customer_oportudata.FEC_ING != ''
                  ? customer[0].customer_oportudata.FEC_ING
                  : 'NA'
              "
            />
          </div>
        </div>

        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label" for="input-last-name"
              >Sueldo</label
            >
            <currency-input
              class="form-control"
              type="text"
              :value="
                customer[0].customer_oportudata.SUELDO != ''
                  ? customer[0].customer_oportudata.SUELDO
                  : 'NA'
              "
              currency="COP"
              locale="es"
            />
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label" for="input-last-name"
              >Direccion de la empresa</label
            >
            <input
              type="text"
              id="input-last-name"
              class="form-control"
              placeholder="Direccion de la empresa"
              :value="
                customer[0].customer_oportudata.DIR_EMP != ''
                  ? customer[0].customer_oportudata.DIR_EMP
                  : 'NA'
              "
            />
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label" for="input-last-name"
              >Telefono de empresa</label
            >
            <input
              type="text"
              id="input-last-name"
              class="form-control"
              placeholder="Telefono de empresa"
              :value="
                customer[0].customer_oportudata.TEL_EMP != ''
                  ? customer[0].customer_oportudata.TEL_EMP
                  : 'NA'
              "
            />
          </div>
        </div>

        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label" for="input-last-name"
              >Celular de empresa</label
            >
            <input
              type="text"
              id="input-last-name"
              class="form-control"
              placeholder="Celular de empresa"
              :value="
                customer[0].customer_oportudata.TEL2_EMP != ''
                  ? customer[0].customer_oportudata.TEL2_EMP
                  : 'NA'
              "
            />
          </div>
        </div>
      </div>
      <div
        v-else-if="
          (customer[0] &&
            customer[0].customer_oportudata.ACTIVIDAD ==
              'INDEPENDIENTE CERTIFICADO') ||
          customer[0].customer_oportudata.ACTIVIDAD == 'NO CERTIFICADO' ||
          customer[0].customer_oportudata.ACTIVIDAD == 'RENTISTA'
        "
        class="row"
      >
        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label" for="input-username"
              >Actividad</label
            >
            <input
              type="text"
              class="form-control"
              placeholder="Actividad"
              :value="
                customer[0].customer_oportudata.ACTIVIDAD != ''
                  ? customer[0].customer_oportudata.ACTIVIDAD
                  : 'NA'
              "
            />
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label" for="input-username"
              >Cámara de comercio</label
            >
            <input
              type="text"
              class="form-control"
              placeholder="Actividad"
              :value="
                customer[0].customer_oportudata.CAMARAC != ''
                  ? customer[0].customer_oportudata.CAMARAC
                  : 'NA'
              "
            />
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label" for="input-username"
              >Sector económico</label
            >
            <input
              type="text"
              class="form-control"
              placeholder="Actividad"
              :value="
                customer[0].customer_oportudata.RAZON_IND != ''
                  ? customer[0].customer_oportudata.RAZON_IND
                  : 'NA'
              "
            />
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label" for="input-username"
              >Dirección de la empresa</label
            >
            <input
              type="text"
              class="form-control"
              placeholder="Actividad"
              :value="
                customer[0].customer_oportudata.DIR_EMP != ''
                  ? customer[0].customer_oportudata.DIR_EMP
                  : 'NA'
              "
            />
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label" for="input-username"
              >Razon social</label
            >
            <input
              type="text"
              class="form-control"
              placeholder="Actividad"
              :value="
                customer[0].customer_oportudata.ACT_IND != ''
                  ? customer[0].customer_oportudata.ACT_IND
                  : 'NA'
              "
            />
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label" for="input-username"
              >Razon social</label
            >
            <input
              type="text"
              class="form-control"
              placeholder="Actividad"
              :value="
                customer[0].customer_oportudata.ACT_ECO != ''
                  ? customer[0].customer_oportudata.ACT_ECO
                  : 'NA'
              "
            />
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label" for="input-username"
              >Año desde el que desempeña la actividad</label
            >
            <input
              type="date"
              class="form-control"
              placeholder="Actividad"
              :value="
                customer[0].customer_oportudata.FEC_CONST != ''
                  ? customer[0].customer_oportudata.FEC_CONST
                  : 'NA'
              "
            />
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label" for="input-username"
              >Ingresos</label
            >
            <input
              type="text"
              class="form-control"
              placeholder="Actividad"
              :value="
                customer[0].customer_oportudata.SUELDOIND != ''
                  ? customer[0].customer_oportudata.SUELDOIND
                  : 'NA'
              "
            />
          </div>
        </div>
      </div>
      <div v-else></div>
    </div>

    <!-- Description -->
    <!-- <h6 class="heading-small text-muted mb-4">About me</h6>
    <div class="pl-lg-4">
      <div class="form-group">
        <label class="form-control-label">About Me</label>
        <textarea
          rows="4"
          class="form-control"
          placeholder="A few words about you ..."
        >
A beautiful premium dashboard for Bootstrap 4.</textarea
        >
      </div>
    </div> -->
  </div>
</template>
