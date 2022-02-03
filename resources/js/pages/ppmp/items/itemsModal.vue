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
                            <input type="text" v-model="formData.fiscalyear" class="form-control form-control-sm" autocomplete="chrome-off">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" v-model="formData.ppmp_type" class="form-control form-control-sm" autocomplete="chrome-off">
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
                fiscalyear: "",
                ppmp_type: ""
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
        },

        save_user() {

            if ( this.is_edit() ) {
                axios.patch('/ppmp/update', this.formData).then( response => {
                    this.$snotify.success("Record added", "Success!");
                    this.close_modal()
                    this.$store.commit('refreshTheTable')
                })
            } else {
                axios.post('/ppmp/store', this.formData).then( response => {
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
}
</script>