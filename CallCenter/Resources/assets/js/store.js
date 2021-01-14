import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        save: false
    },
    mutations: {
        saved(state) {
            state.save = true;
        },
    },
    actions: {
        saveQuestionnaire(context, newnotification) {
            // axios.post("/admin/saveNotification", newnotification).then(response => {
                // if (response.data) {
            context.commit("saved");
                    // newnotification = "";
                // }
            // });
        },
    },
});
