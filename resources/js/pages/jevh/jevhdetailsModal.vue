<template>
    <div id="editJevh" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{jevhDetailsModal.editJevhModalTitle}}</h5>
                     <button
                   type="button"
                    class="btn-close"
                    @click="close()"
                    aria-label="Close"
                ></button>
                </div>
                <div class="modal-body">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="nav-item"><a href="#jevh" class="nav-link active" data-bs-toggle="tab">Jevh Entry</a></li>
                                <li class="nav-item"><a href="#jevd" id="jevdLink" class="nav-link" data-bs-toggle="tab"  :aria-disabled="isDisabled" :class="{'disabled':isDisabled}">Jevd Entry</a></li>
                            </ul>

                            <div class="tab-content">
                                    <div class="tab-pane fade show active" id="jevh">
                                    <div class="row mb-3">
                                        <label for="colFormLabelSm"  class="col-sm-2 col-form-label">Fiscal Year</label>
                                            <div class="col-sm-9">
                                                <input type="text" v-model="formData.fiscalyear" class="form-control form-control-sm" autocomplete="chrome-off">
                                            </div>
                                    </div>

                                    <div class="col-md">
                                        <label for=""  class="mt-1 pt-1 mb-1">Fund Details Code</label>
                                        <select 
                                            class="form-select mt-2 pt-2 mb-2"
                                            :class="{ 'is-invalid': $v.formData.FUND_SCODE.$error }"  
                                            v-model.trim="$v.formData.FUND_SCODE.$model">
                                            <option v-for="items in funds" :value="items.FUND_SCODE" :key="items.recid">{{ items.FUNDDETAIL_NAME}}</option>
                                        </select>
                                        <div class="text-danger" v-if="$v.formData.FUND_SCODE.$error">
                                                Required
                                        </div>
                                    </div>

                                    <div class="col-md">
                                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">Jev Type</label>
                                        <select 
                                            class="form-select mt-2 pt-2 mb-2"
                                            :class="{ 'is-invalid': $v.formData.FJEVTYP.$error }"
                                             v-model.trim="$v.formData.FJEVTYP.$model">
                                            <option v-for="(items,index) in jevtype" :value="items.value" :key="index"> {{ items.name}}</option>
                                        </select>
                                        <div class="text-danger" v-if="$v.formData.FJEVTYP.$error">
                                                Required
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">JEV Number</label>
                                        <div class="col-sm-10">
                                            <input type="text" 
                                            v-model="formData.FJEVNO" 
                                            class="form-control form-control-sm"
                                             :class="{ 'is-invalid': $v.formData.FJEVNO.$error }"
                                            v-model.trim="$v.formData.FJEVNO.$model"
                                            autocomplete="chrome-off">
                                        </div>
                                        <div class="text-danger" v-if="$v.formData.FJEVNO.$error">
                                                Required
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">Payee</label>
                                        <div class="col-sm-10">
                                            <input type="text" 
                                            class="form-control form-control-sm" 
                                            :class="{ 'is-invalid': $v.formData.FPAYEE.$error }"
                                             v-model.trim="$v.formData.FPAYEE.$model"
                                            autocomplete="chrome-off">
                                        </div>
                                         <div class="text-danger" v-if="$v.formData.FPAYEE.$error">
                                                Required
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">JEV Date</label>
                                        <div class="col-sm-10">
                                            <input type="date"  v-model="formData.FJEVDATE" class="form-control form-control-sm" autocomplete="chrome-off">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="colFormLabelSm"  class="col-sm-2 col-form-label">Check No</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                            class="form-control form-control-sm" 
                                            :class="{ 'is-invalid': $v.formData.FCHKNO.$error }"
                                             v-model.trim="$v.formData.FCHKNO.$model"
                                            autocomplete="chrome-off">
                                        </div>
                                         <div class="text-danger" v-if="$v.formData.FCHKNO.$error">
                                                Required
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">Particulars</label>
                                        <div class="col-sm-10">
                                            <input type="text" v-model="formData.FREMK" class="form-control form-control-sm" autocomplete="chrome-off">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">Ref #</label>
                                        <div class="col-sm-10">
                                            <input type="text" 
                                            class="form-control form-control-sm" 
                                             :class="{ 'is-invalid': $v.formData.FREFNO.$error }"
                                             v-model.trim="$v.formData.FREFNO.$model"
                                            autocomplete="chrome-off">
                                        </div>
                                         <div class="text-danger" v-if="$v.formData.FREFNO.$error">
                                                Required
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">Prepared By</label>
                                        <div class="col-sm-10">
                                            <input type="text" v-model="formData.FPREPBY" class="form-control form-control-sm" autocomplete="chrome-off">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">Positon</label>
                                        <div class="col-sm-10">
                                            <input type="text" v-model="formData.FPREPD" class="form-control form-control-sm" autocomplete="chrome-off">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">Approved By</label>
                                        <div class="col-sm-10">
                                            <input type="text" v-model="formData.FAPPVBY" class="form-control form-control-sm" autocomplete="chrome-off">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">Position</label>
                                        <div class="col-sm-10">
                                            <input type="text" v-model="formData.FAPPVD" class="form-control form-control-sm" autocomplete="chrome-off">
                                        </div>
                                    </div>
                                    
                                </div>
                                    <div class="tab-pane fade" id="jevd">
                                        <jev-tab :jevdformdata="this.formData" v-if="!isDisabled"></jev-tab>
                                    </div>   
                                <!-- end of jevh tab -->

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
                        @click="save()">save
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
import { required } from "vuelidate/lib/validators";
import JevTab from "./jevd-tab.vue"

export default {
    components:{
        JevTab
    },
    data() {    
        return {
            myJevhModal: null,
            funds:"",
            jevtype:[
                {value:1, name:"Collection"},
                {value:2, name:"Check Disbursement"},
                {value:3, name:"Cash Disbursement"},
                {value:4, name:"General"},
                {value:5, name:"ADA"},
                {value:6, name:"Procurement"},
            ],

            // for JEVD tab
            formData: {
                fiscalyear: new Date().getFullYear(),
                FUND_SCODE:"",
                FJEVNO:"",
                FJEVTYP:"",
                FJEVDATE:"",
                FPAYEE:"",
                FCHKNO:"",
                FREMK:"",
                FREFNO: "",
                FPREPBY:"",
                FPREPD:"",
                FAPPVBY:"",
                FAPPVD:"",

            },
            isDisabled: true,
        }
    }, 
    mounted() {
        this.myJevhModal = new Modal(document.getElementById('editJevh'))
        this.myJevhModal.show()
        
        if (this.is_edit() ) {
            this.isDisabled = false
            this.formData = this.editjev
        }
        
        this.getJevhdetails(),
        this.getJevtypdetails()
    },

    computed: {
        ...mapState({
           jevhDetailsModal: state => state.jevhDetailsModal,
           editjev: state => state.editData,
           sum: state => state.totalSum,
        }),
    },
    methods: {
        save() {
        this.$v.$touch();
        if (this.$v.$invalid) {
            return false;
        }
        this.save_edit();
    
        },

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

        save_edit() {
            this.isDisabled = false;
            if( this.is_edit() ){
                axios.post('update_jevh_details', this.formData).then(response => {
                    this.$snotify.success("Record Added", "success");
                    this.$store.commit('refreshTheTable')
                    this.close_modal()
                })
            } else {
                axios.post('store_jevh', this.formData).then( response => {
                    this.$snotify.success("Record Added", "Success!");

                    setTimeout( () => { 
                        document.getElementById('jevdLink').click();
                    }, 100) 

                    this.$store.commit('refreshTheTable')
                })
            }  
        },

        close(){
            if(this.sum.totalDebit != this.sum.totalCredit) {
                this.$snotify.error("Debit is not equal to credit", "error");
            } else {
                this.myJevhModal.hide()
                this.$store.commit('refreshTheTable');
                this.$store.commit('setJevhDetailsModalState', {title:"", isTrue:false,  data:{}})
            }
        },

        is_edit() {
            return this.editjev.length != 0
        }
    },

    validations: {
            formData: {
                FUND_SCODE: {
                    required,
                },
                FJEVTYP: {
                    required,
                },
                FJEVNO:{
                    required,
                },
                FPAYEE: {
                    required,
                },
                FCHKNO: {
                    required,
                },
                FREFNO: {
                    required,
                }   
            },
        },
}
</script>