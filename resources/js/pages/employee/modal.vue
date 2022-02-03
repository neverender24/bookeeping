<template>
    <div id="add_employee_modal" class="modal fade" tabindex="-1" data-keyboard="false" aria-labelledby="importLabel">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ modalTitle }}</h5>
                    <button
                        type="button"
                        class="btn-close"
                        @click="close_modal()"
                    ></button>
                </div>
                <div class="modal-body">

        <div class="tab-content" id="pills-tabContent">
               <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-employee-tab" data-bs-toggle="pill" data-bs-target="#pills-employee" type="button" role="tab" aria-controls="pills-employee" aria-selected="true">Employees Profile</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" :class="{disabled : disable_item}" id="pills-bmi-tab" data-bs-toggle="pill" data-bs-target="#pills-bmi" type="button" role="tab" aria-controls="pills-bmi" aria-selected="false">BMI Information</button>
                                </li>
                            </ul>


                    <div class="container">
                        <div class="row">
                            <div class="col-sm-5 col-md-6">
                                <label for="colFormLabelSm" class="col-sm-2 col-form-label">Cats #</label>
                                <input type="text" v-model="formData.cats_number" class="form-control form-control-sm" autocomplete="chrome-off">
                            </div>
                            <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0">
                                <label for="colFormLabelSm" class="col-sm-2 col-form-label">Last Name</label>
                                <input type="text" v-model="formData.last_name" class="form-control form-control-sm" autocomplete="chrome-off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5 col-md-6">
                                <label for="colFormLabelSm" class="col-sm-2 col-form-label">First Name</label>
                                <input type="text" v-model="formData.first_name" class="form-control form-control-sm" autocomplete="chrome-off">
                            </div>
                          <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0">
                                <label for="colFormLabelSm" class="col-sm-2 col-form-label">Middle</label>
                                <input type="text" v-model="formData.middle_name" class="form-control form-control-sm" autocomplete="chrome-off">
                            </div>
                        </div>

                          <div class="row">
                            <div class="col-sm-5 col-md-6">
                                <label for="colFormLabelSm" class="col-sm-2 col-form-label">Address</label>
                                <input type="text" v-model="formData.address" class="form-control form-control-sm" autocomplete="chrome-off">
                            </div>
                          <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0">
                                <label for="colFormLabelSm" class="col-sm-2 col-form-label">Gender</label>
                            
                            <select v-model="formData.gender" class="form-control" autocomplete="chrome-off">
                            <option value="Male">Male</option>        
                            <option value="Female">Female</option>
                            </select>

                            </div>
                        </div>
                          <div class="row">
                            <div class="col-sm-5 col-md-6">
                                <label for="colFormLabelSm" class="col-sm-2 col-form-label">Birthdate</label>
                                <input type="date" v-model="formData.birthdate" class="form-control form-control-sm" autocomplete="chrome-off">
                            </div>
                          
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">
  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
</svg>
                        Close

                    </button>


                    <button 
                        type="button" 
                        class="btn btn-primary"
                        @click="save_user()"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save-fill" viewBox="0 0 16 16">
  <path d="M8.5 1.5A1.5 1.5 0 0 1 10 0h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h6c-.314.418-.5.937-.5 1.5v7.793L4.854 6.646a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l3.5-3.5a.5.5 0 0 0-.708-.708L8.5 9.293V1.5z"/>
</svg>
                        Save
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
            myModal: null,
            formData: {
                cats_number: "",
                last_name: "",
                first_name: "",
                middle_name: "",
                 address: "",
                  gender: "",
                   birthdate: ""
            }
        }
    },

    mounted() {
        this.myModal = new Modal(document.getElementById('add_employee_modal'))
        this.myModal.show()

        if ( this.is_edit() ) {
            this.formData = this.editData
        }
    },

    computed: {
        ...mapState({
            primaryModal: state => state.primaryModal,
            modalTitle: state => state.primaryModalTitle,
            editData: state => state.editData,
        }),
    },

    methods: {
        close_modal() {
            this.myModal.hide()
            this.$store.commit('setPrimaryModalState')
            this.$store.commit('clearEditData')
        },

        save_user() {

            if ( this.is_edit() ) {
                axios.patch('employee/update', this.formData).then( response => {
                    this.$snotify.success("Record updated", "Success!");
                    this.close_modal()
                    this.$store.commit('refreshTheTable')
                })
            } else {
                      
                axios.post('employee/store', this.formData).then( response => {
                    
                    this.$snotify.success("Record added", "Success!");
                    this.close_modal()
                    this.$store.commit('refreshTheTable')
                })
            } 
        },

        is_edit() {
            return this.editData.length != 0
        }
    }
};
</script>