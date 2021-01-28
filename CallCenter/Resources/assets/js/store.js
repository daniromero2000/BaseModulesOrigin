import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        loader: false,
        showModalSave: false
    },
    mutations: {
        saved(state, value) {
            state.loader = value;
        },
    },
    actions: {
        saveQuestionnaire(context, data) {
            axios.post("/admin/questionnaires", data).then(response => {
                if (response.data) {
                    context.commit("saved", false);
                    data = "";
                }
            });
        },
        loaderPage(context) {
            context.commit("saved", true);
        },
    },
});
