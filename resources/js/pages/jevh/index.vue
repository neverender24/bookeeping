<template>
    <div class="container-xl">
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Journal Entry Vouchers</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							    <div class="col-auto">
								    <div class="table-search-form row gx-1 align-items-center" @submit.prevent>
					                    <div class="col-auto">
					                        <input 
                                                type="text" 
                                                name="searchorders" 
                                                class="form-control" 
                                                placeholder="Search...press enter"
                                                v-model="tableData.search"
                                                @change="getData()"
                                            >
					                    </div>
					                    <div class="col-auto">
					                        <button class="btn app-btn-secondary" v-bind:class="{'text-primary': filtering}" @click="advance_filtering()">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                                                <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
                                                </svg>
                                            </button>
					                    </div>
					                </div>
					                
							    </div><!--//col-->
						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->
                
			   <advanced-filter v-if="filtering" @refresh="getData()"></advanced-filter>
                <download-excel 
                    class="btn btn-warning d-none"
                    :data="exportData" 
                    id="exportId"
                    type="xlsx"
                >
                </download-excel>
                <button class="btn btn-sm btn-warning" @click="_export()"> Download Data </button>
			    <div class="app-card app-card-orders-table shadow-sm mb-2">
			        <div class="card-body">
                        <datatable
                            :columns="columns"
                        >
                            <tbody>
                                <tr v-for="item in data" :key="item.id">
                            
                                    <td>{{ item.fiscalyear }}</td>
                                    <td>{{ item.FUND_SCODE }}</td>
                                    <td>{{ item.FJEVNO }}</td>
                                    <td>{{ item.FJEVDATE }}</td>
                                    <td>{{ item.FCHKNO }}</td>
                                    <td>{{ item.FPAYEE }}</td>
                                    <td>{{ item.FREMK }}</td>
                                    <td>
                                        <button class="dropdown-item" @click="show_details(item)">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"></path>
                                                <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>
                                            </svg>View
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </datatable>
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
			    <modal v-if="primaryModal" ></modal>

            <modal-details v-if="jevModal" :details ="jev_details"></modal-details>
		    </div>
</template>

<script>
import Datatable from "../../helpers/datatable";
import Pagination from "../../helpers/pagination";
import { mapState, mapGetters } from "vuex";
import ModalDetails from "../jevDetails/index";
import AdvancedFilter from "./advanceFilter.vue";

export default {
    components: {
        datatable: Datatable,
        pagination: Pagination,
        modalDetails: ModalDetails,
        advancedFilter: AdvancedFilter,
        
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
            
            { width: "5%", label: "Fiscal Year", name: "fiscalyear" },
            { width: "10%", label: "Fund Detail Code", name: "FUND_SCODE" },
            { width: "10%", label: "JEV Number", name: "FJEVNO " },
            { width: "10%", label: "JEV Date", name: "FJEVDATE " },
             { width: "10%", label: "Check No.", name: ".FCHKNO " },
            { width: "10%", label: "Payee", name: "FPAYEE" },
            { width: "20", label: "Particulars", name: "FREMK" },
            { width: "10%", label: "Action", name: "action" }, 
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
             showDetails: "",
             jev_details: {},
             exportData:[],
             fieldNames:{},
                tempFilter: {}
            //end of datatable variables.
            //you can add below other variables.
        };
    },

    computed: {
        ...mapState({
            primaryModal: state => state.primaryModal,
            refreshTable: state => state.refreshTable,
            filterData: state => state.filterData,
            jevModal: state => state.jevModal,
        }),

        ...mapGetters([
            'isAdmin'
        ]),
       
    },

    watch: {
        refreshTable() {
            this.getData()
        },
    },

    mounted() {
        this.tempFilter = this.filterData
        this.getData();
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

        async getData(url = "jevh/index") {
              this.showDetails = "";
            let loader = this.$loading.show();

            // delete this.tableData.FJEVNO
            _.assign(this.tableData, this.filterData) 

            await axios.post(url, this.tableData).then((response) => {
                let data = response.data;

                if (this.tableData.draw == data.draw) {
                    this.data = data.data.data;
                    this.configPagination(data.data);
                }

                loader.hide()
            });
        },

            
        show_details(item) {

            this.$store.commit('setJevhModalState', {title:"Jevh Details", isOpen:true})
            this.jev_details = item
    
        },

        async _export(){
            let loader = this.$loading.show();
            var payload = this.filterData;
            _.assign(this.filterData, {length:""})
            await axios.post('jevh/index', payload).then((response) => {
                this.exportData = response.data.data.data.map(row => {
                    return {
                        'Fiscal Year': row.fiscalyear,
                        'Fund Detail Code': row.FUND_SCODE,
                        'Jev Number': row.FJEVNO,
                        'Date': row.FJEVDATE,
                        'Check No.': row.FCHKNO,
                        'Payee': row.FPAYEE
                    }

                })

                loader.hide()
            });
            this.fieldNames = {
                "Fiscal Year": "exportData.fiscalyear",
                "Fund Detail Code": "exportData.FUND_SCODE",
                "Jev Number": "exportData.FJEVNO",
                "Date": "exportData.FJEVDATE",
                "Check No.": "exportData.FCHKNO",
                "Payee": "exportData.FPAYEE"    	
                
            }
            var downloadData = document.getElementById('exportId');
            downloadData.click();
        },

        // end of datatable pagination functions
       
        advance_filtering() {
            this.filtering = !this.filtering
        },

    },
};
</script>