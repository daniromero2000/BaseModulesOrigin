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
                />
                <label class="custom-control-label" :for="k + 'radioFirst'"
                  >Respuesta abierta</label
                >
              </div>
              <div class="custom-control custom-radio">
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

              <div class="mt-2 row mx-0 justify-content-end">
                <i
                  class="fas fa-minus-circle px-1"
                  @click="remove(k)"
                  v-show="k || (!k && inputs.length > 1)"
                ></i>
                <i
                  class="fas fa-plus-circle"
                  @click="add(k)"
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
            <a href="" class="btn btn-sm btn-default">Regresar</a>
            <button @click="onSubmit" class="btn btn-primary btn-sm">
              Crear
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>
<style >
label.checkbox-inline {
  padding: 10px 5px;
  display: block;
  margin-bottom: 5px;
}
label.checkbox-inline > input[type="checkbox"] {
  margin-left: 10px;
}
ul.attribute-lists > li {
  margin-bottom: 10px;
}
.center {
  left: 50%;
  transform: translateX(0) !important;
}
.info-tooltip {
  position: absolute;
  top: 3px;
  right: 18px;
  border-radius: 20px;
  background: #5e72e4;
  width: 18px;
  cursor: pointer;
  font-size: 12px;
  text-decoration: none;
  color: #fff !important;
}
.relative {
  position: relative;
}
.remove-img {
  position: absolute;
  top: 5px;
  width: 29px;
  right: 5px;
}
@media (max-width: 700px) {
  .remove-img {
    width: 0;
    padding-right: 12px;
    right: 0;
    font-size: 8px;
  }
}
</style>
<script>
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
  created() {
    // alert('hola');
  },
  mounted() {},
  methods: {
    add(index) {
      this.inputs.push({ id: "" });
    },
    remove(index) {
      this.inputs.splice(index, 1);
    },
    onSubmit() {
      this.$store.dispatch("saveQuestionnaire", {
        data: this.data,
        items: this.inputs,
      });
    },
  },
  computed: {},
};
</script>
