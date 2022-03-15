<template>
   <div id="details" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Journal Entry Vouchers</h5>
                    <button
                        type="button"
                        class="btn-close"
                        @click="close_modal()"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="pt-2"></div>
                    <button class="btn app-btn-secondary " @click="print_report()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                        </svg>
                    </button>
                <div class="modal-body">
                    <div class="app-card app-card-orders-table shadow-sm mb-2">
			            <div class="card-body">
                            <div class="form-group row">
                                <div class = "row">
                                    <div class = "col-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control fw-bold"  readonly id="floatingInput"  v-model="jevtype[details.FJEVTYP]">
                                            <label for="floatingInput">JEV TYPE</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control fw-bold"  readonly id="floatingInput"  v-model="fundDetailsName" >
                                            <label for="floatingInput">FUND</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control fw-bold"  readonly id="floatingInput"   v-model="details.FJEVNO" >
                                            <label for="floatingInput">JEV Number</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control fw-bold"  readonly id="floatingInput"    v-model="details.FJEVDATE" >
                                            <label for="floatingInput">JEV Date</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control fw-bold"  readonly id="floatingInput"    v-model="details.FCHKNO" >
                                            <label for="floatingInput">CHECK #</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control fw-bold"  readonly id="floatingInput"    v-model="details.FREFNO" >
                                            <label for="floatingInput">REF #</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control fw-bold"  readonly id="floatingInput"     v-model="details.FPAYEE" >
                                            <label for="floatingInput">PAYEE</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <textarea class="form-control fw-bold" style="height: 200px" readonly  v-model="details.FREMK"></textarea>
                                            <label for="floatingInput">DESCRIPTION</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control fw-bold"  readonly id="floatingInput"    v-model="details.FPREPBY" >
                                            <label for="floatingInput">PREPARED BY</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control fw-bold"  readonly id="floatingInput"     v-model="details.FPREPD" >
                                            <label for="floatingInput">POSITION</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control fw-bold"  readonly id="floatingInput"     v-model="details.FAPPVBY" >
                                            <label for="floatingInput">APPROVED BY</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control fw-bold"  readonly id="floatingInput"    v-model="details.FAPPVD" >
                                            <label for="floatingInput">POSITION</label>
                                        </div>
                                    </div>
                                    <div class = "col-9">
                                        <datatable :columns="columns">
                                            <tbody>
                                                <tr v-for="item in data" :key="item.id">
                                                    <td>
                                                        <span v-if="item.FTITLE && item.FACTCODE">
                                                            {{ item.FTITLE }} , ({{ item.FACTCODE }})
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span v-if="item.FSTITLE && item.FSUBCDE">
                                                            {{ item.FSTITLE }} , ({{ item.FSUBCDE }})
                                                        </span>
                                                    </td>
                                                    <td >
                                                        <span v-if="item.FSUBCDE && item.FSTITLE2">
                                                            {{ item.FSTITLE2 }} , ({{ item.FSUBCDE2 }})
                                                        </span> 
                                                    </td>
                                                    <td>{{ item.FRESPCTR}}</td>
                                                    <td>{{ item.FVOUCHNO}}</td>
                                                    <td>{{ item.FALOBNO}}</td>
                                                    <td>{{ item.FPRNO}}</td>
                                                    <td>{{ item.jevdDebit}}</td>
                                                    <td>{{ item.jevdCredit }}</td>
                                                    <td>{{ item.FREMARKS }}</td>
                                                </tr>
                                            </tbody>
                                        </datatable>
                                    </div>
                                </div>
                            </div>
                        </div>
				    </div>
			        <modal v-if="primaryModal"></modal>
                    <print-reports-modal v-if="printReport.isTrue"></print-reports-modal>


		    </div>
                   
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        @click="close_modal()"
                    >
                        Close
                    </button>
                    <!-- <button 
                        type="button" 
                        class="btn btn-primary"
                        @click="save_user()"
                    >
                        Save
                    </button> -->
                </div>
                </div>
            </div>
        </div>

</template>


<script>
import { Modal } from 'bootstrap'
import Datatable from "../../helpers/datatable";
import { mapState, mapGetters } from "vuex";
import printModal from "./printmodal.vue"

export default {
    components: {
        datatable: Datatable,
        printReportsModal: printModal,
      
        
    },
    
     props: {
            details: Object
        },

    data() {
        /**
         * This are the variables used for the pagination
         * you can copy paste this
         *
         * sortOrders - you can send here the sort order of fields
         * columns - will be hand in hand with the datatable <td>.
         *            it will tell the <td> what information it should
         *             have.
         */

        let columns = [
            
            { width: "10%", label: "Title/ActCode", name: "FACTCODE "},
            { width: "10%", label: "Title/SubCode", name: "FSTITLE"},
            { width: "10%", label: "Title/SubCode2", name: "FSTITLE2 "},
            { width: "10%", label: "RespCtr", name: "FRESPCTR"},
            { width: "10%", label: "Voucher", name: "FVOUCHNO"},
            { width: "10%", label: "OBR #", name: "FALOBNO"},
            { width: "10%", label: "PR #", name: "FPRNO"},
            { width: "10%", label: "Debit", name: "FDEBIT"},
            { width: "10%", label: "Credit", name: "FCREDIT"},
            { width: "10%", label: "Remarks", name: "FREMARKS"},
            
        ];

        //end of pagination variables

        return {
            /**
             * Datatable variables, you can copy/paste
             * these directly to your component.
             *
             * tableData will be passed in the controller
             * you may add additional variable in the obj.
             */
            columns: columns,
            tableData: {
                draw: 0,
                length: 5,
                search: "",
            },
            
            fundDetailsName:"",
            data: [],
            filtering: false,
            fundDetails: [],
            jevtype:{
                1:"Collection",
                2:"Check Disbursement",
                3:"Cash Disbursement",
                4:"General",
                5:"ADA",
                6:"Procurement"
            },
            //end of datatable variables.
            //you can add below other variables.
        };
    },

    computed: {
        ...mapState({
            primaryModal: state => state.primaryModal,
            refreshTable: state => state.refreshTable,
            printReport: state => state.printReportSecond
        }),

        ...mapGetters([
            'isAdmin'
        ]),

    },

    watch: {
        refreshTable() {
            this.getData()
        }
    },

    mounted() {

        this.myModal = new Modal(document.getElementById('details'))
        this.myModal.show();

        this.getData();
        this.getFundDetails()
    },

    methods: {

        close_modal() {
            this.myModal.hide();
            this.$store.commit('setJevhModalState', {title:"", isOpen:false})
            
        },

        async getData(url = "jevd/jevDetails") {
           
            let loader = this.$loading.show();
            await axios.post(url, this.details).then((response) => {
                let data = response.data;
                
                // if (this.tableData.draw == data.draw) {
                    this.data = data;
                    // this.configPagination(response);
                // }
    
                 loader.hide()
            });
            this.fundDetailsName = this.data[0].FUNDDETAIL_NAME
        
        },

        async getFundDetails(url = "fundDetails/getFundDetails") {
                await axios.get(url).then(response => {
                    this.fundDetails = response.data
                });

            },

        // end of datatable pagination functions
       
        advance_filtering() {
            this.filtering = !this.filtering
        },

        print_report(){
            this.$store.commit('printReportSecondModalState', {title:"Print Report", isTrue:true, filterData:[this.details.FJEVNO,this.details.FUND_SCODE ]})
        },

    },
};
</script>