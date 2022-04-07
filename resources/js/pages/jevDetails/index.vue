<template>
   <div id="details" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-xl" style="max-width: 1300px !important">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Journal Entry Vouchers</h5>
                    <button data-bs-toggle="tooltip" data-bs-placement="top" title="Close"
                        type="button"
                        class="btn-close"
                        @click="close_modal()"
                        aria-label="Close"
                    ></button>
                </div>
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
                                                    
                                                    <td>{{ item.FTITLE}}</td>
                                                    <td>{{ item.FACTCODE}}</td>
                                                    <td>{{ item.FSTITLE}}</td>
                                                    <td>{{ item.FSUBCDE}}</td>
                                                    <td>{{ item.FSTITLE2}}</td>
                                                    <td>{{ item.FSUBCDE2}}</td>
                                                    
                                                    <td>{{ item.FRESPCTR}}</td>
                                                    <td>{{ item.FVOUCHNO}}</td>
                                                    <td>{{ item.FALOBNO}}</td>
                                                    <td>{{ item.FPRNO}}</td>
                                                    <td>{{ item.jevdDebit}}</td>
                                                    <td>{{ item.jevdCredit }}</td>
                                                    <td>{{ item.FREMARKS }}</td>
                                                    <td>
                                                        <div class="app-card-actions">
                                                            <div class="dropdwon">
                                                                <div class="dropdown-toggle no-toggle-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                    <path path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
                                                                    </svg>
                                                            </div>
                                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-end-lg-start" style="font-size: .8125rem">
                                                                <li>
                                                                    <button class="dropdown-item" @click="edit_details(item)">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                                        </svg>Edit
                                                                    </button>
                                                                    <button class="dropdown-item" @click="delete_details(item, item.recid)">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                                        </svg>Delete
                                                                    </button>
                                                                </li>
                                                            </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </datatable>
                                        <div class="row justify-content-end">
                                            <div class="col-2">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control fw-bold" style="width: 150px; height:55px;" readonly v-model="sum.totalDebit">
                                                    <label for="floatingInputGrid">Total Debit</label>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control fw-bold" style="width: 150px; height:55px;" readonly v-model="sum.totalCredit">
                                                    <label for="floatingInputGrid">Total Credit</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
				    </div>
			        <edit-jevd-modal v-if="editDetailsModal.editJevdModal" :detailed ="this.details"></edit-jevd-modal>

			        <modal v-if="primaryModal"></modal>
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
import EditModal from "../jevDetails/modal.vue"

export default {
    components: {
        datatable: Datatable,
        editJevdModal: EditModal,

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

            { width: "10%", label: "ActCode Title", name: "FTITLE "},
            { width: "10%", label: "ActCode", name: "FACTCODE"},
            { width: "10%", label: "SubCode Title", name: "FTITLE"},
            { width: "5%", label: "SubCode", name: "SubCode"},
            { width: "10%", label: "SubCode2 Title", name: "FTITLE2 "},
            { width: "5%", label: "SubCode2", name: "SubCode2 "},
            { width: "10%", label: "RespCtr", name: "FRESPCTR"},
            { width: "10%", label: "Voucher", name: "FVOUCHNO"},
            { width: "10%", label: "OBR #", name: "FALOBNO"},
            { width: "10%", label: "PR #", name: "FPRNO"},
            { width: "10%", label: "Debit", name: "FDEBIT"},
            { width: "10%", label: "Credit", name: "FCREDIT"},
            { width: "10%", label: "Remarks", name: "FREMARKS"},
            { width: "5%", label: "Action", name: "Action"},
            
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
            editDetailsModal: state => state.editDetailsModal,
            refreshTable: state => state.refreshTable,
            sum: state => state.totalSum,

        }),

        ...mapGetters([
            'isAdmin'
        ]),

    },

    watch: {
        refreshTable() {
            this.getData()
            this.getTotal()
        }
    },

    mounted() {

        this.myModal = new Modal(document.getElementById('details'))
        this.myModal.show();

        this.getData();
        this.getFundDetails()
        this.getTotal()
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

        getTotal() {
            axios.post('jevd/jevdTotal',  { FJEVNO: this.details.FJEVNO , FUND_SCODE:  this.details.FUND_SCODE, fiscalyear: this.details.fiscalyear }).then(response => {
                this.$store.commit('total', response.data)
            })
        },

        async getFundDetails(url = "fundDetails/getFundDetails") {
                await axios.get(url).then(response => {
                    this.fundDetails = response.data
                });

            },
        

        advance_filtering() {
            this.filtering = !this.filtering
        },

        // Crud for JEVD

        async edit_details(item) {
            this.item = item;
            await axios.post('edit_jdetails', { id: this.item.recid }).then( response => {
                this.$store.commit('edit', { title: 'Edit Journal', data:response.data})
            })
        },

        delete_details(item,id) {
            this.item = item;
            return this.$snotify.confirm(
                "Are you sure you want to delete?",
                "Deletion",
                {
                    position: "centerCenter",
                    backdrop: 0.4,
                    buttons: [
                        {
                            text: "Yes",
                            action: async (toast) => {
                                await axios
                                    .post("/delete_details/", { id: id })
                                    .then((response) => {
                                        this.$snotify.success(
                                            "Deleted successfully",
                                            "Done"
                                        );
                                        this.$snotify.remove(toast.id);
                                        this.getData();
                                    })
                                    .catch((error) => {
                                        this.$snotify.error(
                                            error.response.data.message,
                                            "Error"
                                        );
                                        this.$snotify.remove(toast.id);
                                    });
                            },
                        },
                        {
                            text: "No",
                            action: (toast) => {
                                this.$snotify.remove(toast.id);
                            },
                            bold: true,
                        },
                    ],
                }
            );
        }
      
    },
};
</script>
