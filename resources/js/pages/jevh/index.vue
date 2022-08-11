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
					                        <button class="btn app-btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Advance Filter" v-bind:class="{'text-primary': filtering}" @click="advance_filtering()">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                                                <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
                                                </svg>
                                            </button>
					                    </div>
                                        <div class="col-auto">
                                            <button class="btn app-btn-secondary" @click="reports_filter()">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-fill" viewBox="0 0 16 16">
                                                    <path d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm5.5 1.5v2a1 1 0 0 0 1 1h2l-3-3z"/>
                                                </svg>
                                            </button>
                                        </div>
					                </div>
					                
							    </div><!--//col-->
						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->
                
                <!-- <div class="col-auto" align="right">
                            <button class="btn app-btn-secondary" @click="create()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-00lg" viewBox="0 0 16 16">
                                    <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>
                                </svg>
                                New Record
                            </button>
                </div> -->
			   <advanced-filter v-if="filtering" @refresh="getData()"></advanced-filter>
                <!-- <download-excel data-bs-toggle="tooltip" data-bs-placement="top" title="Download Data to Excel"
                    class="btn btn-warning"
                    :fetch = "_export" 
                    id="exportId"
                    type="xlsx"
                    :before-generate = "startDownload"
                    :before-finish   = "finishDownload"
                    :fields="fieldNames"
                >
                Download Data
                </download-excel> -->
                

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
                                        <div class="app-card-actions">
                                            <div class="dropdwon">
                                                <div class="dropdown-toggle no-toggle-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
                                                    </svg>
                                                </div>
                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-end-lg-start" style="font-size: .8125rem">
                                                <li>
                                                        <button class="dropdown-item" @click="show_details(item)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                            </svg> Show Details
                                                        </button>

                                                        <!-- <button class="dropdown-item" @click="print_report(item)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                                                                <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                                                                <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                                            </svg> Print Report
                                                        </button>

                                                        <button class="dropdown-item" @click="edit_jevh_details(item)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                            </svg> Edit
                                                        </button>

                                                        <button class="dropdown-item" @click="delete_jevh_entry(item, item.recid)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                        </svg> Delete
                                                        </button> -->
                                                </li>
                                            </ul>
                                            </div>
                                        </div>
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
			    <reports-modal v-if="report.reportsModal" ></reports-modal>

            <modal-details 
                v-if="jevModal" 
                :details="jev_details"
            ></modal-details>

            <jevh-modal v-if="jevhDetailsModal.jevhModal"></jevh-modal>

		    </div>
</template>

<script>
import Datatable from "../../helpers/datatable";
import Pagination from "../../helpers/pagination";
import { mapState, mapGetters } from "vuex";
import ModalDetails from "../jevDetails/index";
import AdvancedFilter from "./advanceFilter.vue";
import Modal from "./reportsmodal.vue"
import JevhdetailsModal from './jevhdetailsModal.vue';

export default {
    components: {
        datatable: Datatable,
        pagination: Pagination,
        modalDetails: ModalDetails,
        advancedFilter: AdvancedFilter,
        reportsModal: Modal,
        jevhModal: JevhdetailsModal,

        
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
            
            { width: "10%", label: "Fiscal Year", name: "fiscalyear" },
            { width: "15%", label: "Fund Detail Code", name: "FUND_SCODE" },
            { width: "10%", label: "JEV Number", name: "FJEVNO " },
            { width: "10%", label: "JEV Date", name: "FJEVDATE " },
            { width: "10%", label: "Check No.", name: ".FCHKNO " },
            { width: "10%", label: "Payee", name: "FPAYEE" },
            { width: "15", label: "Particulars", name: "FREMK" },
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
                length: 10,
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
            tempFilter: {},
            loaderExport:null,
            fieldNames: {
                "Fiscal Year": "fiscalyear",
                "Fund Detail Code": "FUND_SCODE",
                "Jev Number": "FJEVNO",
                "Date": "FJEVDATE",
                "Check No.": "FCHKNO",
                "Payee": "FPAYEE"    	

            },
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
            refreshTable: state => state.refreshTable,
            filterData: state => state.filterData,
            jevModal: state => state.jevModal,
            report: state => state.report,
            jevhDetailsModal: state => state.jevhDetailsModal
        }),

        ...mapGetters([
            'isAdmin'
        ]),
       
    },

    watch: {
        refreshTable: function() {
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
        print_report(data){
            window.open('http://122.54.19.171:8080/jasperserver/flow.html?pp=u%3DJamshasadid%7Cr%3DManager%7Co%3DEMEA,Sales%7Cpa1%3DSweden&_flowId=viewReportFlow&_flowId=viewReportFlow&ParentFolderUri=%2Freports%2Fjevdreport&reportUnit=%2Freports%2Fjevdreport%2Fjevdprintreport&standAlone=true&decorate=no&FJEVNO='+data.FJEVNO+'&FUND_SCODE='+data.FUND_SCODE+'&fiscalyear='+data.fiscalyear);
        },

        async _export(){
            

            _.assign(this.tableData, this.filterData) 
            let data = {};
            await axios.post('jevh/export', this.tableData).then((response) => {
                // console.log(response.data.data.data.length)
                data = response.data.data.map(row => {
                    return {
                        fiscalyear: row.fiscalyear,
                        FUND_SCODE: row.FUND_SCODE,
                        FJEVNO: row.FJEVNO,
                        FJEVDATE: row.FJEVDATE,
                        FCHKNO:row.FCHKNO,
                        FPAYEE: row.FPAYEE
                    }

                })
                
                
            });
            return data
        },

        startDownload(){
            this.loaderExport = this.$loading.show();
        },

        finishDownload(){
            this.loaderExport.hide();
        },
        // end of datatable pagination functions
       
        advance_filtering() {
            this.filtering = !this.filtering
        },
        
        reports_filter(){
            this.$store.commit('reportsModalSate', {title:"Filter Report", isTrue:true})
            
        },

        // Start of the CRUD

        create() {
            this.$store.commit('setJevhDetailsModalState', { title: "Add Journal Entry Voucher", isTrue:true})
        },

        close() 
        {
            this.myModal.hide();
            this.$store.commit('setJevhModalState', {title:"", isOpen:false})
        },
        

        async edit_jevh_details(item){
            this.item = item;
            await axios.post('edit_jevh_details', { id: this.item.recid }).then(response => {
                this.$store.commit('editjevh', { title: "Edit Jev Entry", data:response.data})
            })
        },
        
        delete_jevh_entry(item,id) {
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
                                    .post("/delete_jevh_entry/", { id: id })
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