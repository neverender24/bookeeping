<template>
<div class="card ">
    <div class="card-header"> Advance Filter </div>
    <div class="card-body">
        <div class="row ">
            <div class="col">
                <label for="" class="mt-1 pt-1 mb-1">Fund</label>
                <select class="form-select" style="width: 300px"  v-model="filterData.FUND_SCODE">
                    <option v-for="item in funds" :value="item.FUND_SCODE" :key="item.recid"> {{ item.FUNDDETAIL_NAME}}</option>
                </select>
            </div>
            <div class="col">
                <label for="" class="mt-1 pt-1 mb-1">JEV No.</label>
                <input class="form-control" style="width: 300px" type="text" v-model="filterData.FJEVNO">
            </div>
            <div class="col">
                <label for="" class="mt-1 pt-1 mb-1">Check No.</label>
                <input class="form-control" style="width: 300px" type="text" v-model="filterData.FCHKNO">
            </div>
            <div class="col">
                <label for="" class="mt-1 pt-1 mb-1">Ref No.</label>
                <input class="form-control" style="width: 300px" type="text" v-model="filterData.FREFNO">
            </div>
            <div class="col">
                <label for="" class="mt-1 pt-1 mb-1">From</label>
                <input class="form-control" style="width: 300px" type="date" v-model="filterData.from">
            </div>
            <div class="col">
                <label for="" class="mt-1 pt-1 mb-1">To</label>
                <input class="form-control" style="width: 300px" type="date" v-model="filterData.to">
            </div>
            <div class="col"><label for="" class="mt-1 pt-1 mb-1">JEV Type.</label>
                <select class="form-select" style="width: 300px" v-model="filterData.FJEVTYP" >
                    <option v-for="(item,index) in jevtype" :value="item.value" :key="index"> {{ item.name}}</option>
                </select>
            </div>
            <div class="col">
                <label for="" class="mt-1 pt-1 mb-1">Payee</label>
                <input class="form-control" style="width: 300px" type="text" v-model="filterData.FPAYEE">
            </div>
            <div class="col pt-3 mt-4">
                <button class="form control btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh Filter" @click="refresh()"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                        <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                    </svg>
                </button>
                <button class="form control btn btn-warning sm" @click="runFilter()">
                    Find
                </button>
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
        async refresh() {
            var filterData1 = {
                
                FJEVNO:"",
                FUND_SCODE:"",
                FCHKNO:"",
                FREFNO:"",
                from:"",
                to:"",
                FJEVTYP:"",
                FPAYEE:"",

            };
            await this.$store.commit('setFilterData', filterData1)
            // await this.runFilter();
            this.$emit('refresh')
            this.filterData = {}
        },

        async runFilter() {
            await this.$store.commit('setFilterData', this.filterData)
            await this.$store.commit('refreshTheTable')
        }
    },

}
</script>