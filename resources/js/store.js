import 'es6-promise/auto'
import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        report:{
            reportsModal:false,
            reportsModalTitle:"",
        },

        searchBox: "",
        user: [],
        totalSum: "",
        filterData: {},
        primaryModal: false,
        primaryModalTitle: "",
        refreshTable: false,
        editData: [],
        jevModalTitle:"",
        jevModal:false,
        ppmpItems: {
            editDataPpmpItem: [],
            editModal: false,
            id_ppmp: null,
        },

        // charlie state
        editDetailsModal:{
            editJevdModal: false,
            editJevdModalTitle: ""
        }
        
   
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
        reportsModalSate(state, payload){
            state.report.reportsModalTitle = payload.title
            state.report.reportsModal = payload.isTrue
        },

        setFilterData(state, payload) {
            state.filterData = payload
        },

        setPrimaryModalState(state, payload) {
            state.primaryModalTitle = payload
            state.primaryModal = true
        },
        
        setJevhModalState(state, payload){
            state.jevModalTitle = payload.title
            state.jevModal = payload.isOpen
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

        total(state, payload){
            state.totalSum = payload
        },

        refreshTheTable(state) {
            state.refreshTable = !state.refreshTable
        },

        // cha mutations
        setDetailsModalState(state, payload) {
            state.editDetailsModal.editJevdModalTitle = payload.title
            state.editDetailsModal.editJevdModal = payload.isTrue;
        },

        edit(state, payload) {
            state.editDetailsModal.editJevdModal = true;
            state.editDetailsModal.editJevdModalTitle = payload.title
            state.editData = payload.data
        },


    },
    actions: {

    },
})
