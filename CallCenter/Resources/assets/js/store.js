import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        loader: false,
        showAlert: false,
        questionnaire: {},
        isBusy: false,
        campaigns: {},
        customer: {}
    },
    mutations: {
        saved(state, value) {
            state.loader = value;
        },
        showAlert(state, value) {
            state.showAlert = value;
        },
        getQuestionnaire(state, object) {
            state.questionnaire = object;
        },
        toggleBusy(state, isBusy) {
            state.isBusy = isBusy;
        },
        getCampaigns(state, campaigns) {
            state.campaigns = campaigns;
        },
        getCustomerCampaign(state, customer) {
            state.customer = customer;
        },
    },
    actions: {
        getCampaigns(context) {
            axios.get("/admin/api/getActiveCampaigns").then(response => {
                if (response.data) {
                    context.commit("getCampaigns", response.data);
                }
            });
        },
        getCustomerCampaign(context, id) {
            axios.get("/admin/api/getCustomerCampaign/" + id).then(response => {
                if (response.data) {
                    context.commit("getCustomerCampaign", response.data);
                }
            });
        },
        saveQuestionnaire(context, data) {
            axios.post("/admin/questionnaires", data).then(response => {
                if (response.data) {
                    context.commit("saved", false);
                    context.commit("showAlert", true);
                    data = "";
                }
            });
        },
        updateQuestionnaire(context, data) {
            axios.put("/admin/questionnaires/" + data.id, data).then(response => {
                if (response.data) {
                    context.commit("saved", false);
                    context.commit("showAlert", true);
                    data = "";
                }
            });
        },
        getQuestionnaire(context, id) {
            axios.get("/admin/getQuestionnaire/" + id).then(response => {
                if (response.data) {
                    context.commit("getQuestionnaire", response.data);
                    context.commit("saved", false);
                }
            });
        },
        loaderPage(context, status) {
            context.commit("saved", status);
        },
        showAlert(context) {
            context.commit("showAlert", false);
        },
    },
});
