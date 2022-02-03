<template>
<div class="table-responsive" style="min-height: 350px;">
    <table class="table app-table-hover mb-0 text-left">
        <thead>
            <tr>
                <th v-for="column in columns"
                    :key="column.name"
                    :style="'width:'+column.width+';'"
                >
                    {{ column.label}}
                </th>
            </tr>
        </thead>
        <slot></slot>
    </table>
</div>
</template>

<style>


</style>

<script>
    export default {
        props: ['columns']
    }
</script>
