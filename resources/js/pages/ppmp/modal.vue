<template>
    <div id="add_ppmp_modal" class="modal fade" tabindex="-1">
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
                                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Details</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" :class="{disabled : disable_item}" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Items</button>
                                </li>
                            </ul>
                                <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <div class="row mb-3">
                                    <label for="colFormLabelSm" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" v-model="formData.fiscalyear" class="form-control form-control-sm" autocomplete="chrome-off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" v-model="formData.ppmp_type" class="form-control form-control-sm" autocomplete="chrome-off">
                                        </div>
                                    </div>
                                    <button 
                                        type="button" 
                                        class="btn btn-primary"
                                        @click="save_ppmp()"
                                    >
                                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save-fill" viewBox="0 0 16 16">
  <path d="M8.5 1.5A1.5 1.5 0 0 1 10 0h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h6c-.314.418-.5.937-.5 1.5v7.793L4.854 6.646a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l3.5-3.5a.5.5 0 0 0-.708-.708L8.5 9.293V1.5z"/>
</svg>
                                        Save
                                    </button>
                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <items-modal v-if="!disable_item"></items-modal>
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
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
import { mapState } from "vuex";
import ItemsModal from "./items/index.vue";

export default {
    components: {
        itemsModal: ItemsModal,
    },

    data() {
        return {
            myModal: null,
            formData: {
                fiscalyear: "",
                ppmp_type: ""
            },
            disable_item: true //for nav-tab
        }
    },

    mounted() {
        this.myModal = new bootstrap.Modal(document.getElementById('add_ppmp_modal'))
        this.myModal.show()

        if ( this.is_edit() ) {
            this.disable_item = false
            this.formData = this.editData
        }
    },

    computed: {
        ...mapState({
            modalTitle: state => state.primaryModalTitle,
            editData: state => state.editData,
            id_ppmp: state => state.ppmpItems.id_ppmp,
        }),
    },

    methods: {
        close_modal() {
            this.disable_item = true
            this.$store.commit('setPrimaryModalState')
            this.$store.commit('clearEditData')
            this.$store.commit('refreshTheTable')
            this.$store.commit('clearPpmpItemEditData')
            this.myModal.hide()
        },

        save_ppmp() {
   
            if ( this.id_ppmp != null ) {
                _.assign(this.formData, {id: this.id_ppmp});
                axios.patch('/ppmp/update', this.formData).then( response => {
                    this.$snotify.success("Record added", "Success!");
                    //this.close_modal()
                })
            } else {
                axios.post('/ppmp/store', this.formData).then( response => {
                    this.$snotify.success("Record added", "Success!");
                    this.$store.commit('setPpmpId', response.data)
                   this.disable_item = false
                    setTimeout(() => {
                        document.getElementById("pills-profile-tab").click();
                    }, 100);
                })
            } 
        },

        is_edit() {
            return this.editData.length != 0
        }
    }
}
</script>