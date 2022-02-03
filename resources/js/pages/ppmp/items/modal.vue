<template>
    <div id="items_modal" class="modal fade" tabindex="-1" aria-hidden="false"  data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">NEW MODAL</h5>
                    <button
                        type="button"
                        class="btn-close"
                         @click="close_modal()"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" v-model="formData.qty1" class="form-control form-control-sm" autocomplete="chrome-off">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" v-model="formData.qty2" class="form-control form-control-sm" autocomplete="chrome-off">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button 
                        type="button" 
                        class="btn btn-primary"
                        @click="save_ppmp_item()"
                    >
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import { mapState } from "vuex";

export default {
    data() {
        return {
            myModal2: null,
            formData: {
                qty1: "",
                qty2: "",
            }
        }
    },

    mounted() {
        this.myModal2 = new bootstrap.Modal(document.getElementById('items_modal'))
        this.myModal2.show()

        if ( this.is_edit() ) {
            this.formData = this.editData
        }
    },

    computed: {
        ...mapState({
            modalTitle: state => state.primaryModalTitle,
            editData: state => state.ppmpItems.editDataPpmpItem,
            id_ppmp: state => state.ppmpItems.id_ppmp,
        }),
    },



    methods: {
        close_modal() {
            this.$store.commit('clearPpmpItemEditData')
            this.myModal2.hide()
        },

        save_ppmp_item() {

            if ( this.is_edit() ) {
                axios.patch('/ppmp/items/update', this.formData).then( response => {
                    this.$snotify.success("Record added", "Success!");
                    this.$emit('refresh')
                    this.close_modal()
                })
            } else {
                _.assign(this.formData, {id_ppmp: this.id_ppmp});
                axios.post('/ppmp/items/store', this.formData).then( response => {
                    this.$snotify.success("Record added", "Success!");
                    this.$emit('refresh')
                })
            } 
        },

        is_edit() {
            return this.editData.length != 0
        }
    }
}
</script>