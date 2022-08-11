<template>
<div id= "editJevd" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ editDetailsModal.editJevdModalTitle }}</h5>
                <button
                   type="button"
                    class="btn-close"
                    @click="close()"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <div class="row-mb-3">
                    <div class="col-md">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">Title/ActCode</label>
                            <select class="form-select mt-2 pt-2 mb-2" v-model="formData.FACTCODE" @change="getJDetails(), getJDetailssubcode()">
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
                            <input type="text" v-model="formData.FRESPCTR" class="form-control form-control-sm" autocomplete="chrome-off">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">Voucher</label>
                        <div class="col-sm-10">
                            <input type="text" v-model="formData.FVOUCHNO" class="form-control form-control-sm" autocomplete="chrome-off">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">OBR #</label>
                        <div class="col-sm-10">
                            <input type="text" v-model="formData.FALOBNO" class="form-control form-control-sm" autocomplete="chrome-off">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">PR #</label>
                        <div class="col-sm-10">
                            <input type="text" v-model="formData.FPRNO" class="form-control form-control-sm" autocomplete="chrome-off">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">Debit</label>
                        <div class="col-sm-10">
                            <input type="text" v-model="formData.FDEBIT" class="form-control form-control-sm" autocomplete="chrome-off">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">Credit</label>
                        <div class="col-sm-10">
                            <input type="text" v-model="formData.FCREDIT" class="form-control form-control-sm" autocomplete="chrome-off">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">Remarks</label>
                        <div class="col-sm-10">
                            <input type="text" v-model="formData.FREMARKS" class="form-control form-control-sm" autocomplete="chrome-off">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            @click="close()"
                        >
                            Close
                        </button>
                        <button
                        type="button"
                        class="btn btn-primary"
                        @click="save_edit()">Save
                        </button>
                    </div>
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
     props: {
            detailed: Object
        },
    data() {
        return {
            myModal2: null,
            details: {},
            subcde: {},
            subcde2: {},
            formData: {
                fiscalyear: this.detailed.fiscalyear,
                FUND_SCODE: this.detailed.FUND_SCODE,
                FJEVNO: this.detailed.FJEVNO,
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
        this.myModal2 = new Modal(document.getElementById('editJevd'))
        this.myModal2.show()

        if ( this.is_edit() ) {
            this.formData = this.editjev
        }

       this.getAllDetails(),
       this.getJDetails(),
       this.getJDetailssubcode()
       this.total = this.fromTotalState
    },

    computed: {
        ...mapState({
             editDetailsModal: state => state.editDetailsModal,
             editjev: state => state.editjevdData,
             fromTotalState: state => state.totalSum,
        }),
    },

    methods: {
        getAllDetails(){
            axios.post('get_all_details').then( response => {
                this.details = response.data
            })
        },

        getJDetails(){
            axios.post('getjDetails', {FACTCODE: this.formData.FACTCODE}).then( response => {
                this.subcde = response.data
            })
        },

        getJDetailssubcode(){
            axios.post('getDetailsSubcode', {FACTCODE: this.formData.FACTCODE}).then( response => {
                this.subcde2 = response.data
            })
        },

        save_edit() {
                 if ( this.is_edit() ){
                    axios.post('update_jdetails', this.formData).then( response => {
                        this.$snotify.success("Record added", "success!");
                        this.$store.commit('refreshTheTable')
                        this.close()
                    })
                } else {
                    axios.post('store_jdetails', this.formData).then( response => {
                        this.$snotify.success("Record Added", "Success!");
                        this.$store.commit('refreshTheTable')
                        this.close()
                    })
                }
        },

        close() {
            if (this.sum.totalDebit != this.sum.totalCredit) {
                 this.$snotify.error('Make sure the Debit and Credit are Equal');
             } else {
            this.myModal2.hide()
            this.$store.commit('setDetailsModalState', {title:"", isTrue:false})
             }
        },

        is_edit() {
            return this.editjev.length != 0    
        }

    }
  
}
</script>
