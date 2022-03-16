<template>
    <div id="print_reports_modal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ printReportSecond.title }}</h5>
                    <button
                        type="button"
                        class="btn-close"
                        aria-label="Close"
                        @click="close_modal()"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="justify-center">
                        <div class="row g-2">
                            <div class="col-md">
                                <label for="">JEV No.</label>
                                <input type="text" class="form-control mt-1 pt-1 mb-1" v-model="data.FJEVNO" readonly>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md">
                                <label for="">Fund code</label>
                                <input type="text" class="form-control mt-1 pt-1 mb-1" v-model="data.FUND_SCODE" readonly>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md">
                                <label for="">Fiscal Year</label>
                                <input type="text" class="form-control mt-1 pt-1 mb-1" v-model="data.fiscalyear">
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
                        Close
                    </button>
                    <button
                        type="button"
                        class="btn btn-warning"
                        @click="print()"
                    >
                        Print
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
    data()  {
        return {
            data:{
                FJEVNO:"",
                FUND_SCODE:"",
                fiscalyear:"",
            },
            printReportsModal: null,
        }
    },

    mounted() {
        this.printReportsModal = new Modal(document.getElementById('print_reports_modal'))
        this.printReportsModal.show()
        this.data.FJEVNO = this.printReportSecond.filterData[0]
        this.data.FUND_SCODE = this.printReportSecond.filterData[1]
    },
    
    computed: {
        ...mapState({
            printReportSecond: state => state.printReportSecond
        }),
    },
    methods: {
        close_modal(){
            this.printReportsModal.hide()
            this.$store.commit('printReportSecondModalState', {title:"", isTrue:false})
        },

        print() {
            window.open('http://192.168.7.26:8081/jasperserver/flow.html?pp=u%3DJamshasadid%7Cr%3DManager%7Co%3DEMEA,Sales%7Cpa1%3DSweden&_flowId=viewReportFlow&_flowId=viewReportFlow&ParentFolderUri=%2Freports%2Fjevdreport&reportUnit=%2Freports%2Fjevdreport%2Fjevdreports&standAlone=true&decorate=no&FJEVNO='+this.data.FJEVNO+'&FUND_SCODE='+this.data.FUND_SCODE+'&fiscalyear='+this.data.fiscalyear);
        }
    },
}
</script>