<template>
    <div id="editJevh" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{jevhDetailsModal.editJevhModalTitle}}</h5>
                     <button
                   type="button"
                    class="btn-close"
                    @click="close_modal()"
                    aria-label="Close"
                ></button>
                </div>
                <div class="modal-body">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="nav-item"><a href="#jevh" class="nav-link active" data-bs-toggle="tab">Jevh Entry</a></li>
                                <li class="nav-item"><a href="#jevd" class="nav-link" data-bs-toggle="tab">Jevd Entry</a></li>
                            </ul>

                            <div class="tab-content">
                                    <div class="tab-pane fade show active" id="jevh"> 
                                    <div class="row mb-3">
                                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">Fiscal Year</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-sm" autocomplete="chrome-off">
                                            </div>
                                    </div>

                                    <div class="col-md">
                                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">Fund Details Code</label>
                                        <select class="form-select mt-2 pt-2 mb-2" v-model="fDetails.FUND_SCODE">
                                                <option v-for="items in funds" :value="items.FUND_SCODE" :key="items.recid">{{ items.FUNDDETAIL_NAME}}</option>
                                            </select>
                                    </div>

                                    <div class="col-md">
                                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">Jev Type</label>
                                            <select class="form-select mt-2 pt-2 mb-2" v-model="fDetails.FJEVTYP">
                                                <option v-for="(items,index) in jevtype" :value="items.value" :key="index"> {{ items.name}}</option>
                                            </select>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">Payee</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm" autocomplete="chrome-off">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">JEV Number</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm" autocomplete="chrome-off">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">JEV Date</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control form-control-sm" autocomplete="chrome-off">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">Check No</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm" autocomplete="chrome-off">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">Particulars</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm" autocomplete="chrome-off">
                                        </div>
                                    </div>
                                </div>

                            <div class="tab-pane fade" id="jevd">
                                <div class="col-md">
                                    <label for="colFormLabelSm" class="col-sm-2 col-form-label">Title/ActCode</label>
                                        <select class="form-select mt-2 pt-2 mb-2" v-model="formData.FACTCODE" @change="getJevDetailscode(), getJevDetailssubcde()">
                                            <option v-for="item in details" :value="item.FACTCODE" :key="item.recid">{{ item.FTITLE}}</option>
                                        </select>
                                </div>

                                <div class="col-md">
                                    <label for="colFormLabelSm" class="col-sm-2 col-form-label">Title/Subcode</label>
                                        <select class="form-select mt-2 pt-2 mb-2" v-model="formData.FSUBCDE">
                                            <option v-for="item in subcde" :value="item.FSUBCDE" :key="item.recid">{{ item.FSTITLE}}</option>
                                    </select>
                                </div>

                                <div class="col-md">
                                    <label for="colFormLabelSm" class="col-sm-2 col-form-label">Title/Subcode2</label>
                                        <select class="form-select mt-2 pt-2 mb-2" v-model="formData.FSUBCDE2">
                                            <option v-for="item in subcde2" :value="item.FSUBCDE2" :key="item.recid">{{ item.FSTITLE2}}</option>
                                    </select>
                                </div>

                                <div class="row mb-3">
                                    <label for="colFormLabelSm" class="col-sm-2 col-form-label">Resptcr</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" autocomplete="chrome-off">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="colFormLabelSm" class="col-sm-2 col-form-label">Voucher</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" autocomplete="chrome-off">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="colFormLabelSm" class="col-sm-2 col-form-label">OBR #</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" autocomplete="chrome-off">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="colFormLabelSm" class="col-sm-2 col-form-label">PR #</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" autocomplete="chrome-off">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="colFormLabelSm" class="col-sm-2 col-form-label">Debit</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" autocomplete="chrome-off">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="colFormLabelSm" class="col-sm-2 col-form-label">Credit</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" autocomplete="chrome-off">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="colFormLabelSm" class="col-sm-2 col-form-label">Remarks</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" autocomplete="chrome-off">
                                    </div>
                                </div>
                            </div>   
                        </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            @click="close_modal()"
                        >
                            Close
                        </button>
                        <button
                        type="button"
                        class="btn btn-primary"
                        @click="next()">Next
                        </button>
                    </div>
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
            myJevhModal: null,
            funds:"",
            payee:"",
            jevtype:[
                {value:1, name:"Collection"},
                {value:2, name:"Check Disbursement"},
                {value:3, name:"Cash Disbursement"},
                {value:4, name:"General"},
                {value:5, name:"ADA"},
                {value:6, name:"Procurement"},
            ],
            fDetails: {
                FUND_SCODE:"",
                FJEVTYP:"",
                FPAYEE:"",
            },

            // for JEVD tab
            details: {},
            subcde: {},
            subcde2: {},
            formData: {
                FACTCODE:"",
                FRESPCTR:"",
                FVOUCHNO:"",
                FALOBNO:"",
                FPRNO:"",
                FDEBIT:"",
                FCREDIT:"",
                FREMARKS:"",
            },
        }
    }, 
    mounted() {
        this.myJevhModal = new Modal(document.getElementById('editJevh'))
        this.myJevhModal.show()

        this.getJevhdetails(),
        this.getJevtypdetails(),
        this.getPayeedetails(),

        this.getAllJDetails(),
        this.getJevDetailscode(),
        this.getJevDetailssubcde()

    },
    computed: {
        ...mapState({
           jevhDetailsModal: state => state.jevhDetailsModal
        }),
    },
    methods: {
        getJevhdetails(){
            axios.post('get_jevtyp_details').then( response => {
                this.funds = response.data
            })
        },

        getJevtypdetails(){
            axios.post('getJevtypdetails').then( response => {
                this.type = response.data
            })
        },

        getPayeedetails(){
            axios.post('payee_details').then( response => {
                this.payee = response.data
            })
        },

         getAllJDetails(){
            axios.post('get_jev_details').then( response => {
                this.details = response.data
            })
        },

        getJevDetailscode(){
            axios.post('getjevDetails', {FACTCODE: this.formData.FACTCODE}).then( response => {
                this.subcde = response.data
            })
        },

        getJevDetailssubcde(){
            axios.post('getjevDetailssbcde', {FACTCODE: this.formData.FACTCODE}).then( response => {
                this.subcde2 = response.data
            }) 
        },

        close_modal(){
            this.myJevhModal.hide()
            this.$store.commit('setJevhDetailsModalState', {title:"", isOpen:false})
        },
    }
}
</script>