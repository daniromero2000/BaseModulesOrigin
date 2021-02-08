<script>
require("../../../../../css/app.css");
import generals from "./show/generals.vue";
import customerIds from "./show/ids.vue";
import economicActivities from "./show/economicActivities.vue";
import addressCustomer from "./show/address.vue";
import phonesCustomer from "./show/phones.vue";
import epssCustomer from "./show/eps.vue";
import emailCustomer from "./show/email.vue";
import factoryRequest from "./show/factoryRequest.vue";
import purchasesMade from "./show/purchasesMade.vue";
import campaign from "./show/campaign.vue";

export default {
  components: {
    generals,
    customerIds,
    economicActivities,
    addressCustomer,
    phonesCustomer,
    epssCustomer,
    emailCustomer,
    factoryRequest,
    purchasesMade,
    campaign,
  },
  data() {
    return {
      data: {
        campaign: "",
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
    this.$store.dispatch("getCampaigns");
  },
  mounted() {},
  methods: {
    searchCampaign() {
      this.$store.dispatch("getCustomerCampaign", this.data.campaign);
    },
  },
  computed: {
    show() {
      return false;
      // return this.$store.state.loader;
    },
    showAlert() {
      return this.$store.state.showAlert;
    },
    showAlert() {
      return this.$store.state.showAlert;
    },
    campaigns() {
      return this.$store.state.campaigns;
    },
    customer() {
      return this.$store.state.customer;
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

<template>
  <div class="">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="form-group col-6">
                <label class="form-control-label" for="">Campaña</label>
                <select
                  v-model="data.campaign"
                  name=""
                  id=""
                  @change="searchCampaign"
                  class="form-control"
                >
                  <option value="">Seleccione</option>
                  <option
                    v-for="(data, key) in campaigns"
                    :key="key"
                    :value="data.id"
                  >
                    {{ data.name }}
                  </option>
                </select>
              </div>
              <div class="form-group col-6">
                <label class="form-control-label" for="">Cedula</label>
                <input
                  type="text"
                  class="form-control"
                  id="exampleFormControlInput1"
                />
              </div>
            </div>
            <ul
              v-show="data.campaign != ''"
              class="pagination justify-content-center mb-0 py-2"
            >
              <!-- <li class="page-item">
            <a class="page-link" tabindex="-1">
              <i class="fas fa-angle-left"></i>
              <i class="fas fa-angle-left"></i>
              <span class="sr-only">Previous</span>
            </a>
          </li> -->
              <li class="page-item">
                <a class="page-link" tabindex="-1">
                  <i class="fas fa-angle-left"></i>
                  <span class="sr-only">Previous</span>
                </a>
              </li>

              <li class="page-item active">
                <a class="page-link">1</a>
              </li>
              <div></div>

              <li class="page-item">
                <a class="page-link">2</a>
              </li>
              <div></div>

              <li class="page-item">
                <a class="page-link">3</a>
              </li>
              <div></div>

              <li class="page-item">
                <a class="page-link">4</a>
              </li>
              <div></div>

              <li class="page-item">
                <a class="page-link">
                  <i class="fas fa-angle-right"></i>
                  <span class="sr-only">Next</span>
                </a>
              </li>

              <!-- <li class="page-item">
            <a class="page-link">
              <i class="fas fa-angle-right"></i>
              <i class="fas fa-angle-right"></i
            ></a>
          </li> -->
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div v-show="data.campaign != ''">
      <div class="nav-wrapper">
        <ul
          class="nav nav-pills nav-fill flex-column flex-md-row"
          id="tabs-icons-text"
          role="tablist"
        >
          <li class="nav-item">
            <a
              class="nav-link mb-sm-3 mb-md-0 active"
              id="tabs-icons-text-1-tab"
              data-toggle="tab"
              href="#tabs-icons-text-1"
              role="tab"
              aria-controls="tabs-icons-text-1"
              aria-selected="true"
              ><i class="ni ni-cloud-upload-96 mr-2"></i>Información basica</a
            >
          </li>
          <li class="nav-item">
            <a
              class="nav-link mb-sm-3 mb-md-0"
              id="tabs-icons-text-2-tab"
              data-toggle="tab"
              href="#tabs-icons-text-2"
              role="tab"
              aria-controls="tabs-icons-text-2"
              aria-selected="false"
              ><i class="ni ni-bell-55 mr-2"></i>Gestión</a
            >
          </li>
          <li class="nav-item">
            <a
              class="nav-link mb-sm-3 mb-md-0"
              id="tabs-icons-text-3-tab"
              data-toggle="tab"
              href="#tabs-icons-text-3"
              role="tab"
              aria-controls="tabs-icons-text-3"
              aria-selected="false"
              ><i class="ni ni-calendar-grid-58 mr-2"></i>Llamadas entrantes</a
            >
          </li>
        </ul>
      </div>
      <div class="tab-content" id="myTabContent">
        <div
          class="tab-pane fade show active"
          id="tabs-icons-text-1"
          role="tabpanel"
          aria-labelledby="tabs-icons-text-1-tab"
        >
          <b-row>
            <b-col sm="5">
              <generals></generals>
              <epssCustomer></epssCustomer>
              <emailCustomer></emailCustomer>
            </b-col>
            <b-col sm="7">
              <!-- <customer-ids></customer-ids> -->
              <economicActivities></economicActivities>
              <addressCustomer></addressCustomer>
              <phonesCustomer></phonesCustomer>
            </b-col>
          </b-row>
        </div>
        <div
          class="tab-pane fade"
          id="tabs-icons-text-2"
          role="tabpanel"
          aria-labelledby="tabs-icons-text-2-tab"
        >
          <factoryRequest></factoryRequest>
          <purchasesMade></purchasesMade>
          <campaign></campaign>
        </div>
        <div
          class="tab-pane fade"
          id="tabs-icons-text-3"
          role="tabpanel"
          aria-labelledby="tabs-icons-text-3-tab"
        >
          <p class="description">
            Raw denim you probably haven't heard of them jean shorts Austin.
            Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache
            cliche tempor, williamsburg carles vegan helvetica. Reprehenderit
            butcher retro keffiyeh dreamcatcher synth.
          </p>
        </div>
      </div>
    </div>
  </div>
</template>



