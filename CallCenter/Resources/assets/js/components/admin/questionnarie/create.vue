<template>
  <div class="card">
    <form @submit.stop.prevent="onSubmit" class="form">
      <div class="card-body">
        <h2>Crear Questionario</h2>
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="form-control-label" for="name"
                >Nombre del questionario<span class="text-danger"
                  >*</span
                ></label
              >
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"
                    ><i class="fa fa-check"></i
                  ></span>
                </div>
                <input
                  type="text"
                  name="name"
                  id="name"
                  v-model="data.name"
                  placeholder="Nombre"
                  validation-pattern="name"
                  class="form-control"
                  value=""
                  required
                />
              </div>
            </div>
          </div>
          <div class="col-sm-6" v-for="(input, k) in inputs" :key="k">
            <div class="form-group">
              <label class="form-control-label" for="script"
                >Pregunta {{ k + 1 }}</label
              >
              <input
                type="text"
                name="name"
                id="name"
                placeholder="Nombre"
                validation-pattern="name"
                class="form-control"
                value=""
                v-model="data.questions[k]"
                required
              />

              <div class="mt-3" style="position: relative">
                <label class="form-control-label" for="script"
                  >Tipo de respuesta</label
                >
                <a
                  class="text-center info-tooltip"
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Test"
                >
                  ?
                </a>
              </div>

              <div class="custom-control custom-radio mt-2 mb-3">
                <input
                  type="radio"
                  :id="k + 'radioFirst'"
                  :name="'customRadio' + k"
                  v-model="data.typeAnswer[k]"
                  class="custom-control-input"
                  value="0"
                  required
                />
                <label class="custom-control-label" :for="k + 'radioFirst'"
                  >Respuesta abierta</label
                >
              </div>
              <div class="custom-control custom-radio mb-3">
                <input
                  type="radio"
                  :id="k + 'radioSecond'"
                  :name="'customRadio' + k"
                  v-model="data.typeAnswer[k]"
                  class="custom-control-input"
                  value="1"
                />
                <label class="custom-control-label" :for="k + 'radioSecond'"
                  >Respuesta cerrada</label
                >
              </div>

              <div class="custom-control custom-radio">
                <input
                  type="radio"
                  :id="k + 'radioThird'"
                  :name="'customRadio' + k"
                  v-model="data.typeAnswer[k]"
                  class="custom-control-input"
                  value="2"
                />
                <label class="custom-control-label" :for="k + 'radioThird'"
                  >Respuesta de calificación</label
                >
              </div>

              <div class="mt-2 row mx-0 justify-content-end">
                <i
                  class="fas fa-minus-circle px-1"
                  @click="remove(k)"
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Eliminar pregunta"
                  v-show="k || (!k && inputs.length > 1)"
                ></i>
                <i
                  class="fas fa-plus-circle"
                  @click="add(k)"
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Agregar pregunta"
                  v-show="k == inputs.length - 1"
                ></i>
              </div>
            </div>
          </div>
        </div>
        <input type="hidden" name="is_active" id="is_active" value="1" />
      </div>
      <div class="card-footer text-right">
        <div class="btn-group">
          <div class="btn-group">
            <a href="/admin/questionnaires" class="btn btn-sm btn-default"
              >Regresar</a
            >
            <button type="submit" class="btn btn-primary btn-sm">Crear</button>
          </div>
        </div>
      </div>
    </form>
    <div
      class="modal fade"
      id="modal-alert"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modal-default"
      aria-hidden="true"
    >
      <div
        class="modal-dialog modal- modal-dialog-centered modal-"
        role="document"
      >
        <div class="modal-content">
          <div class="modal-header"></div>
          <div class="modal-body text-center">
            <sweetalert-icon icon="success" />
            <p>Registro creado exitosamente</p>
          </div>
          <div class="modal-footer">
            <a href="/admin/questionnaires" class="btn btn-primary">Salir</a>
            <button
              type="button"
              @click="add(dataEmpty())"
              class="btn btn-link ml-auto"
              data-dismiss="modal"
            >
              Crear nuevo guión
            </button>
          </div>
        </div>
      </div>
    </div>
    <b-overlay :show="show" no-wrap></b-overlay>
  </div>
</template>


<script>
require("../../../../../css/app.css");

export default {
  data() {
    return {
      data: {
        questions: [],
        typeAnswer: [],
      },
      inputs: [
        {
          id: "",
        },
      ],
    };
  },
  created() {},
  mounted() {},
  methods: {
    add() {
      this.inputs.push({ id: "" });
    },
    remove(index) {
      this.inputs.splice(index, 1);
    },
    dataEmpty() {
      this.data = {
        questions: [],
        typeAnswer: [],
      };
      this.inputs = [];
    },
    onSubmit() {
      this.$store.dispatch("showAlert");
      this.$store.dispatch("loaderPage", true);
      this.$store.dispatch("saveQuestionnaire", {
        data: this.data,
        items: this.inputs,
      });
    },
  },
  computed: {
    show() {
      return this.$store.state.loader;
    },
    showAlert() {
      return this.$store.state.showAlert;
    },
  },
  watch: {
    showAlert() {
      if (this.$store.state.showAlert) {
        $("#modal-alert").modal("show");
      }
    },
  },
};
</script>
