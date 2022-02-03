import 'es6-promise/auto'
import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        searchBox: "",
        user: [],
        primaryModal: false,
        primaryModalTitle: "",
        refreshTable: false,
        editData: [],
        ppmpItems: {
            editDataPpmpItem: [],
            editModal: false,
            id_ppmp: null,
        },
    },
    getters: {
         isAdmin: async state => {
            await axios.get("get-user").then(response => {
                state.user = response.data;
            });

            return state.user
        },
    },
    mutations: {
        setPrimaryModalState(state, payload) {
            state.primaryModalTitle = payload
            state.primaryModal = true
        },
        clearEditData(state) {
            state.primaryModal = false
            state.editData = []
        },
        editing(state, payload) {
            state.primaryModalTitle = 'Edit Employee'
            state.editData = payload
            state.primaryModal = true
        },
        /*
        ** PPMP
        */
        createPpmpItems(state, payload) {
            state.ppmpItems.editModal = true
        },
        editingPpmpItems(state, payload) {
            state.ppmpItems.editDataPpmpItem = payload
            state.ppmpItems.editModal = true
        },
        clearPpmpItemEditData(state) {
            state.ppmpItems.editModal = false
            state.ppmpItems.editDataPpmpItem = []
            state.ppmpItems.id_ppmp = null
        },
        refreshTheTable(state) {
            state.refreshTable = !state.refreshTable
        },
        setPpmpId(state, payload) {
            state.ppmpItems.id_ppmp = payload
        },
        //end
    },
    actions: {

    },
})
