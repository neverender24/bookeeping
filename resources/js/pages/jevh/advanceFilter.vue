<template>
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <label for="">Fund</label>
                    <select class="form-select" v-model="filterData.FUND_SCODE" @change="runFilter()">
                        <option v-for="item in funds" :value="item.FUND_SCODE" :key="item.recid"> {{ item.FUNDDETAIL_NAME}}</option>
                    </select>
                </div>
                <div class="col-4">
                    <label for="">JEV No.</label>
                    <input class="form-control" type="text" v-model="filterData.FJEVNO" @change="runFilter()">
                </div>
                <div class="col-4">
                    <label for="">Check No.</label>
                    <input class="form-control" type="text" v-model="filterData.FCHKNO" @change="runFilter()">
                </div>
                <div class="col-4">
                    <label for="">Ref No.</label>
                    <input class="form-control" type="text" v-model="filterData.FREFNO" @change="runFilter()">
                </div>
                <div class="col-4">
                    <label for="">From</label>
                    <input class="form-control" type="date" v-model="filterData.from" @change="runFilter()">
                </div>
                <div class="col-4">
                    <label for="">To</label>
                    <input class="form-control" type="date" v-model="filterData.to" @change="runFilter()">
                </div>
                <div class="col-4">
                    <label for="">JEV Type.</label>
                    <select class="form-select" v-model="filterData.FJEVTYP" @change="runFilter()">
                        <option v-for="(item,index) in jevtype" :value="item.value" :key="index"> {{ item.name}}</option>
                    </select>
                </div>
                <div class="col-4">
                    <label for="">Payee</label>
                    <input class="form-control" type="text" v-model="filterData.FPAYEE" @change="runFilter()">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            funds: {},
            jevtype:[
                {value:1, name:"Collection"},
                {value:2, name:"Check Disbursement"},
                {value:3, name:"Cash Disbursement"},
                {value:4, name:"General"},
                {value:5, name:"ADA"},
                {value:6, name:"Procurement"},
            ],
            filterData: {}
        }
    },

    mounted() {
        this.getAllFunds()
    },


    methods: {
        getAllFunds() {
            axios.post('get-fund-details').then( response => {
                this.funds = response.data
            })
        },

        async runFilter() {
            await this.$store.commit('setFilterData', this.filterData)
            await this.$store.commit('refreshTheTable')
        }
    },

}
</script>