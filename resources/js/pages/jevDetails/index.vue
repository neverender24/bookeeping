<template>
   <div id="details" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">JEV Details</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                     <div class="app-card app-card-orders-table shadow-sm mb-2">
			        <div class="card-body">
                        <div class="form-group row">
                            <div class = "row">
                                <div class = "col-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control"  readonly id="floatingInput"  v-model="details.FJEVTYP" >
                                        <label for="floatingInput">JEV TYPE</label>
                                    </div>

                                     <div class="form-floating mb-3">
                                        <input type="text" class="form-control"  readonly id="floatingInput"  v-model="details" >
                                        <label for="floatingInput">FUND</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control"  readonly id="floatingInput"   v-model="details.FJEVNO" >
                                        <label for="floatingInput">JEV Number</label>
                                    </div>

                                     <div class="form-floating mb-3">
                                        <input type="text" class="form-control"  readonly id="floatingInput"    v-model="details.FJEVDATE" >
                                        <label for="floatingInput">JEV Date</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control"  readonly id="floatingInput"    v-model="details.FCHKNO" >
                                        <label for="floatingInput">CHECK #</label>
                                    </div>

                                     <div class="form-floating mb-3">
                                        <input type="text" class="form-control"  readonly id="floatingInput"    v-model="details.FREFNO" >
                                        <label for="floatingInput">REF #</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control"  readonly id="floatingInput"     v-model="details.FPAYEE" >
                                        <label for="floatingInput">PAYEE</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" readonly style=" height:50%" v-model="details.FREMK" ></textarea>
                                        <label for="floatingInput">DESCRIPTION</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control"  readonly id="floatingInput"    v-model="details.FPREPBY" >
                                        <label for="floatingInput">PREPARED BY</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control"  readonly id="floatingInput"     v-model="details.FPREPD" >
                                        <label for="floatingInput">POSITION</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control"  readonly id="floatingInput"     v-model="details.FAPPVBY" >
                                        <label for="floatingInput">APPROVED BY</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control"  readonly id="floatingInput"    v-model="details.FAPPVD" >
                                        <label for="floatingInput">POSITION</label>
                                    </div>

                                </div>
                                 <div class = "col-8">
                                     <datatable
                            :columns="columns"
                        >
                            <tbody>
                                <tr v-for="item in data" :key="item.id">
                            
                                    <!-- <td>{{ item.fiscalyear }}</td> -->
                                    <!-- <td>{{ item.FUND_SCODE }}</td> -->
                                    <!-- <td>{{ item.FJEVNO }}</td> -->
                                    <td>{{ item.FSUBCDE }}</td>
                                    <td>{{ item.FSUBCDE2}}</td>
                                    <td>{{ item.FDEBIT }}</td>
                                    <td>{{ item.FCREDIT }}</td>

                                    
                                    <!-- <td>
                                       
                                            <button class="dropdown-item" @click="show_details()">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"></path>
                                                    <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>
                                                </svg>View</button>
                                            
                                       
                                    </td> -->
                                </tr>
                            </tbody>
                        </datatable>
                                 </div>
                            </div>
                        </div>
                        
                    </div>
				</div>
                <div class="row justify-content-evenly">
                    <div
                        class="col-auto me-auto"
                    >
                        <pagination
                            :pagination="pagination"
                            @prev="getData(pagination.prevPageUrl)"
                            @next="getData(pagination.nextPageUrl)"
                        ></pagination>
                    </div>
                    <div class="col-auto me-auto">
                        <p>
                            {{ pagination.from }} to {{ pagination.to }} of
                            {{ pagination.total }} entries
                        </p>
                    </div>
                    <div class="col-auto">
                        <select
                            v-model="tableData.length"
                            @change="getData()"
                            class="form-select form-select-sm col-lg-1"
                        >
                            <option value="10" selected="selected">
                                10
                            </option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>
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
import Pagination from "../../helpers/pagination";
import { mapState, mapGetters } from "vuex";

export default {
    components: {
        datatable: Datatable,
        pagination: Pagination,
      
        
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
            
            // { width: "50%", label: "Fund Detail Code", name: "FUND_SCODE" },
            { width: "10%", label: "SUBCODE", name: "FSUBCDE " },
            { width: "10%", label: "SUBCODE2", name: "FSUBCDE2 " },
            { width: "10%", label: "DEBIT", name: "FDEBIT " },
            { width: "10%", label: "CREDIT", name: "FCREDIT " },
           
         
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
            pagination: {
                lastPage: "",
                currentPage: "",
                total: "",
                lastPageUrl: "",
                nextPageUrl: "",
                prevPageUrl: "",
                from: "",
                to: "",
            },
            data: [],
            filtering: false,
            fundDetails: [],
            //end of datatable variables.
            //you can add below other variables.
        };
    },

    computed: {
        ...mapState({
            primaryModal: state => state.primaryModal,
            refreshTable: state => state.refreshTable
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
         $("#details").modal("show");
        this.getData();
        console.log (this.details)
        this.getFundDetails()
    },

    methods: {
        configPagination(data) {
            this.pagination.lastPage = data.last_page;
            this.pagination.currentPage = data.current_page;
            this.pagination.total = data.total;
            this.pagination.lastPageUrl = data.last_page_url;
            this.pagination.prevPageUrl = data.prev_page_url;
            this.pagination.nextPageUrl = data.next_page_url;
            this.pagination.from = data.from;
            this.pagination.to = data.to;
        },

        close_modal() {
            this.myModal.hide()
            this.$store.commit('setPrimaryModalState')
            this.$store.commit('clearEditData')
        },

        async getData(url = "jevd/jevDetails") {
           
            let loader = this.$loading.show();
            await axios.post(url, this.details).then((response) => {
                let data = response.data;
                console.log(response.data)

                // if (this.tableData.draw == data.draw) {
                    this.data = data;
                    // this.configPagination(response);
                // }

                // loader.hide()
            });
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

    },
};
</script>