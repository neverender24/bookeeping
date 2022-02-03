<template>
    <div id="add_user_modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ modalTitle }}</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" v-model="formData.name" class="form-control form-control-sm" autocomplete="chrome-off">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" v-model="formData.email" class="form-control form-control-sm" autocomplete="chrome-off">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        @click="close_modal()"
                    >
                        Close
                    </button>
                    <button 
                        type="button" 
                        class="btn btn-primary"
                        @click="save_user()"
                    >
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
                name: "",
                email: ""
            }
        }
    },

    mounted() {
        this.myModal = new Modal(document.getElementById('add_user_modal'))
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
            this.$store.commit('refreshTheTable')
        },

        save_user() {

            if ( this.is_edit() ) {
                axios.patch('update_users', this.formData).then( response => {
                    this.$snotify.success("Record added", "Success!");
                    this.close_modal()
                })
            } else {
                axios.post('store_users', this.formData).then( response => {
                    this.$snotify.success("Record added", "Success!");
                    this.close_modal()
                })
            } 
        },

        is_edit() {
            return this.editData.length != 0
        }
    }
}
</script>