<template>
    <div class="container-xl">
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Users</h1>
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
                                                class="form-control form-control" 
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
							    
							    <div class="col-auto">						    
								    <button class="btn app-btn-secondary" @click="create()">
									    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                            <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>
                                        </svg>
									    New Record
									</button>
							    </div>
						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->
            
			   <advanced-filter v-if="filtering"></advanced-filter>

			    <div class="app-card app-card-orders-table shadow-sm mb-2">
			        <div class="card-body">
                        <datatable
                            :columns="columns"
                        >
                            <tbody>
                                <tr v-for="item in data" :key="item.id">
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.email }}</td>
                                    <td>
                                        <div class="app-card-actions" >
								    <div class="dropdown">
									    <div class="dropdown-toggle no-toggle-arrow" data-bs-toggle="dropdown" aria-expanded="false">
										    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
                                        </svg>
									    </div><!--//dropdown-toggle-->
									    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" style="font-size: .8125rem;">
										    <li>
                                                <a class="dropdown-item" href="#">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"></path>
                                                        <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>
                                                    </svg>View
                                                </a>
                                            </li>
											<li>
                                                <button class="dropdown-item" @click="edit_user(item.id)">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"></path>
                                                    </svg>Edit
                                                </button>
                                            </li>
	                                        <li><hr class="dropdown-divider"></li>
											<li>
                                                <button class="dropdown-item text-danger"  @click="delete_user(item.id)">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                                    </svg>Delete
                                                </button>
                                            </li>
										</ul>
								    </div><!--//dropdown-->
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
			    <modal v-if="primaryModal"></modal>
		    </div>
</template>

<script>
import Datatable from "../../helpers/datatable";
import Pagination from "../../helpers/pagination";
import Modal from "./modal.vue";
import AdvancedFilter from "./advanceFilter.vue";
import { mapState, mapGetters } from "vuex";

export default {
    components: {
        datatable: Datatable,
        pagination: Pagination,
        modal: Modal,
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
            { width: "10%", label: "Name", name: "name" },
            { width: "20%", label: "Email", name: "email" },
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

        async getData(url = "users") {
            let loader = this.$loading.show();
            await axios.post(url, this.tableData).then((response) => {
                let data = response.data;

                if (this.tableData.draw == data.draw) {
                    this.data = data.data.data;
                    this.configPagination(data.data);
                }

                loader.hide()
            });
        },
        // end of datatable pagination functions
        create() {
            this.$store.commit('setPrimaryModalState', "Add User")
        },

        advance_filtering() {
            this.filtering = !this.filtering
        },

        async edit_user(id) {
            await axios.post('edit_user', { id: id }).then( response => {
                this.$store.commit('editing', response.data)
            })    
        },

        delete_user(id) {
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
                                    .post("/delete_user/", { id: id })
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