
<script>
export default {
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
    currentStatus() {
      return this.$store.state.currentStatus;
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
.card .header {
  display: flex;
  align-items: center;
}
.header .img {
  height: 75px;
  width: 75px;
  background: #d9d9d9;
  border-radius: 50%;
  position: relative;
  overflow: hidden;
}
.header .details {
  margin-left: 20px;
}
.details span {
  display: block;
  background: #d9d9d9;
  border-radius: 10px;
  overflow: hidden;
  position: relative;
}
.details .name {
  height: 15px;
  width: 100px;
}
.details .about {
  height: 13px;
  width: 150px;
  margin-top: 10px;
}
.card .description {
  margin: 25px 0;
}
.description .line {
  background: #d9d9d9;
  border-radius: 10px;
  height: 13px;
  margin: 10px 0;
  overflow: hidden;
  position: relative;
}
.description .line-1 {
  width: calc(100% - 15%);
}
.description .line-3 {
  width: calc(100% - 40%);
}
.card .btns {
  display: flex;
}
.card .btns .btn {
  height: 45px;
  width: 100%;
  background: #d9d9d9;
  border-radius: 25px;
  position: relative;
  overflow: hidden;
}
.btns .btn-1 {
  margin-right: 8px;
}
.btns .btn-2 {
  margin-left: 8px;
}
.header .img::before,
.details span::before,
.description .line::before,
.btns .btn::before {
  position: absolute;
  content: "";
  height: 100%;
  width: 100%;
  background-image: linear-gradient(
    to right,
    #d9d9d9 0%,
    rgba(0, 0, 0, 0.05) 20%,
    #d9d9d9 40%,
    #d9d9d9 100%
  );
  background-repeat: no-repeat;
  background-size: 450px 400px;
  animation: shimmer 1s linear infinite;
}
.header .img::before {
  background-size: 650px 600px;
}
.details span::before {
  animation-delay: 0.2s;
}
.btns .btn-2::before {
  animation-delay: 0.22s;
}
@keyframes shimmer {
  0% {
    background-position: -450px 0;
  }
  100% {
    background-position: 450px 0;
  }
}
</style>

<template>
  <b-card no-body class="card bg-white shadow border-0">
    <div v-if="customer[0]" class="card-body mt-4">
      <div
        class="text-center"
        style="position: absolute; top: 9px; right: 18px"
      >
        <span
          class="badge"
          :style="'color: #ffffff; background-color:#007bff'"
          >{{
            customer[0].customer_oportudata.ESTADO != ""
              ? customer[0].customer_oportudata.ESTADO
              : "SIN ESTADO"
          }}</span
        >
      </div>
      <div class="text-center">
        <h5 class="h4">
          {{
            `${customer[0].customer_oportudata.NOMBRES} ${customer[0].customer_oportudata.APELLIDOS} `
          }}
        </h5>
        <div class="h5 mt-4">
          <i class="ni business_briefcase-24 mr-2"></i>
          Ciudad de Nacimiento:
          {{
            customer[0].customer_oportudata.CIUD_NAC != ""
              ? customer[0].customer_oportudata.CIUD_NAC
              : "NA"
          }}
        </div>
        <div style="font-size: 14px">
          <i class="ni education_hat mr-2"></i>
          Fecha de Nacimiento:
          {{ customer[0].customer_oportudata.FEC_NAC }}
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="card-profile-stats d-flex justify-content-center">
            <div>
              <span class="heading" style="font-size: 14px">{{
                customer[0].customer_oportudata.EDAD
              }}</span>
              <span class="description">Edad</span>
            </div>
            <div>
              <span class="heading" style="font-size: 14px">{{
                customer[0].customer_oportudata.SEXO
              }}</span>
              <span class="description">Genero</span>
            </div>
            <div>
              <span class="heading" style="font-size: 14px">{{
                customer[0].customer_oportudata.ESTADOCIVIL
              }}</span>
              <span class="description">Estado Civil</span>
            </div>
            <div>
              <span class="heading" style="font-size: 14px">{{
                customer[0].customer_oportudata.PROFESION != ""
                  ? customer[0].customer_oportudata.PROFESION
                  : "NA"
              }}</span>
              <span class="description">Profesión</span>
            </div>
          </div>
        </div>
      </div>
      <div class="text-right">
        <a v-b-modal.addComment class="btn btn-sm bg-success">
          <i class="fas fa-comments text-white"></i>
        </a>
        <a href="#" class="btn btn-sm btn-primary">
          <i class="fas fa-user"></i> Editar
        </a>
      </div>
      <b-overlay :show="show" no-wrap></b-overlay>
    </div>
    <div v-else>
      <div class="card">
        <div class="header">
          <div class="img"></div>
          <div class="details">
            <span class="name"></span>
            <span class="about"></span>
          </div>
        </div>
        <div class="description">
          <div class="line line-1"></div>
          <div class="line line-2"></div>
          <div class="line line-3"></div>
        </div>
        <div class="btns">
          <div class="btn btn-1"></div>
          <div class="btn btn-2"></div>
        </div>
      </div>
    </div>
    <!-- <div class="card-body">
      <div class="row">
        <div class="col-9">
          <h2 class="lead mb-2">
            <b>{{customer.name}} {{customer.last_name}}</b>
          </h2>
          <ul class="ml-4 mb-0 fa-ul text-muted">
            <li class="small mt-2">
              <span class="fa-li">
                <i class="fas fa-lg fa-building"></i>
              </span>
              Fecha de Nacimiento: {{customer.birthday}}
            </li>
            <li v-if="customer.city" class="small mt-2">
              <span class="fa-li">
                <i class="fas fa-lg fa-phone"></i>
              </span>
              Ciudad de Nacimiento: {{customer.city.city}}
            </li>
            <li class="small mt-2">
              <span class="fa-li">
                <i class="fas fa-lg fa-phone"></i>
              </span>
              Edad: {{customer.age}}
            </li>
            <li v-if="customer.civil_status" class="small mt-2">
              <span class="fa-li">
                <i class="fas fa-lg fa-phone"></i>
              </span>
              Estado Civil: {{customer.civil_status.civil_status}}
            </li>
            <li v-if="customer.genre" class="small mt-2">
              <span class="fa-li">
                <i class="fas fa-lg fa-phone"></i>
              </span>
              Genero: {{customer.genre.genre}}
            </li>
            <li v-if="customer.scholarity" class="small mt-2">
              <span class="fa-li">
                <i class="fas fa-lg fa-phone"></i>
              </span>
              Escolaridad: {{customer.scholarity.scholarity}}
            </li>
            <li v-if="customer.customerLead" class="small mt-2">
              <span class="fa-li">
                <i class="fas fa-lg fa-phone"></i>
              </span>
              Lead: {{customer.customerLead.lead}}
            </li>
          </ul>
        </div>
        <div class="col-3 text-center">
          <span
            class="badge"
            :style="'color: #ffffff; background-color:'+ currentStatus.color"
          >{{currentStatus.status}}</span>
        </div>
      </div>
     
    </div>-->
  </b-card>
</template>


