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

<template>
  <div class="card">
    <div class="card-body">
      <form>
        <h6 class="heading-small text-muted mb-4">Actividad Económica</h6>
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username"
                  >Actividad</label
                >
                <input
                  type="text"
                  id="input-username"
                  class="form-control"
                  placeholder="Actividad"
                  :value="
                    customer[0]
                      ? customer[0].customer_oportudata.ACTIVIDAD != ''
                        ? customer[0].customer_oportudata.ACTIVIDAD
                        : 'NA'
                      : ''
                  "
                />
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-email"
                  >Empresa</label
                >
                <input
                  type="email"
                  id="input-email"
                  class="form-control"
                  placeholder="Empresa"
                  :value="
                    customer[0]
                      ? customer[0].customer_oportudata.RAZON_SOC != ''
                        ? customer[0].customer_oportudata.RAZON_SOC
                        : 'NA'
                      : ''
                  "
                />
              </div>
            </div>
          </div>
          <div class="row">
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
                    customer[0]
                      ? customer[0].customer_oportudata.CARGO != ''
                        ? customer[0].customer_oportudata.CARGO
                        : 'NA'
                      : ''
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
                    customer[0]
                      ? customer[0].customer_oportudata.TIPO_CONT != ''
                        ? customer[0].customer_oportudata.TIPO_CONT
                        : 'NA'
                      : ''
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
                    customer[0]
                      ? customer[0].customer_oportudata.SUELDO != ''
                        ? customer[0].customer_oportudata.SUELDO
                        : 'NA'
                      : ''
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
                    customer[0]
                      ? customer[0].customer_oportudata.DIR_EMP != ''
                        ? customer[0].customer_oportudata.DIR_EMP
                        : 'NA'
                      : ''
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
                    customer[0]
                      ? customer[0].customer_oportudata.TEL_EMP != ''
                        ? customer[0].customer_oportudata.TEL_EMP
                        : 'NA'
                      : ''
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
                    customer[0]
                      ? customer[0].customer_oportudata.TEL2_EMP != ''
                        ? customer[0].customer_oportudata.TEL2_EMP
                        : 'NA'
                      : ''
                  "
                />
              </div>
            </div>
          </div>
        </div>
        <hr class="my-4" />
        <!-- Address -->
        <h6 class="heading-small text-muted mb-4">Contact information</h6>
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="form-control-label" for="input-address"
                  >Address</label
                >
                <input
                  id="input-address"
                  class="form-control"
                  placeholder="Home Address"
                  value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09"
                  type="text"
                />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label" for="input-city">City</label>
                <input
                  type="text"
                  id="input-city"
                  class="form-control"
                  placeholder="City"
                  value="New York"
                />
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label" for="input-country"
                  >Country</label
                >
                <input
                  type="text"
                  id="input-country"
                  class="form-control"
                  placeholder="Country"
                  value="United States"
                />
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label" for="input-country"
                  >Postal code</label
                >
                <input
                  type="number"
                  id="input-postal-code"
                  class="form-control"
                  placeholder="Postal code"
                />
              </div>
            </div>
          </div>
        </div>
        <hr class="my-4" />
        <!-- Description -->
        <h6 class="heading-small text-muted mb-4">About me</h6>
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
        </div>
      </form>
    </div>
  </div>
</template>
