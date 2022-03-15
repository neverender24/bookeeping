<template>
    <div id="reports_modal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reports</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                        @click="close_modal()"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="justify-center">
                        <div class="row g-2">
                            <div class="col-md">
                                <label for="">From</label>
                                <input type="date" class="form-control mt-1 pt-1 mb-1" v-model="filterData.from" @click="runFilter()">
                            </div>
                            <div class="col-md">
                                <label for="">To</label>
                                <input type="date" class="form-control mt-1 pt-1 mb-1" v-model="filterData.to" @click="runFilter()">
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md">
                                <label for="colFormLabelSm" class="col-sm-2 col-form-label">Fund</label>
                                <select class="form-select mt-1 pt-1 mb-1" v-model="filterData.FUND_SCODE" @click="runFilter()">
                                    <option v-for="item in funds" :value="item.FUND_SCODE" :key="item.recid"> {{ item.FUNDDETAIL_NAME}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label">Jev Type</label>
                            <select class="form-select mt-1 pt-1 mb-1" v-model="filterData.FJEVTYP" @click="runFilter()">
                                <option v-for="(item,index) in jevtype" :value="item.value" :key="index"> {{ item.name}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                    class="btn btn-secondary"
                    type="button"
                    >
                    Generate
                    </button>
                    <button
                        type="button"
                        class="btn btn-secondary"
                        @click="close_modal()"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>  
</template>
<script>
import { Modal } from 'bootstrap'
import { mapState } from "vuex";

export default {
    data() {
        return {
            myReportsModal: null,
            funds: {},
            jevtype:[
                {value:1, name:"Collection"},
                {value:2, name:"Check Disbursement"},
                {value:3, name:"Cash Disbursement"},
                {value:4, name:"General"},
                {value:5, name:"ADA"},
                {value:6, name:"Procurement"},
            ],
            filterData: {}
        }
    }, 
    mounted() {
        this.myReportsModal = new Modal(document.getElementById('reports_modal'))
        this.myReportsModal.show()

        this.getAllFunds()
    },
    computed: {
        ...mapState({
            report: state => state.report,
        }),
    },
    methods: {
        getAllFunds() {
            axios.post('get-fund-details').then( response => {
                this.funds = response.data
            })
        },

        close_modal(){
            this.myReportsModal.hide()
            this.$store.commit('reportsModalSate', {title:"", isOpen:false})
        },

        async runFilter() {
            await this.$store.commit('setFilterData', this.filterData)
            await this.$store.commit('refreshTheTable')
        }
    }
}
</script>