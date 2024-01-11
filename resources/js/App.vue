<template>
    <DataTable
        ref="dataTableRef"
        :columns="columns"
        :options="options"
        :ajax="fetchData"
        class="display nowrap"
    >
        <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        </thead>
    </DataTable>
</template>

<script setup lang="ts">
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';

import axios from "axios";

DataTable.use(DataTablesCore);

const columns = [
    { data: 'id' },
    { data: 'title' },
    { data: 'description' },
    {
        data: 'action',
        name: 'action',
        orderable: false,
        searchable: false,
        mRender(data, type, full) {
            var editButton = '<a href="#" class="btn btn-sm btn-success" data-id="' + full['id'] + '"><i class="fa-solid fa-pen-to-square"></i></a>';
            var deleteButton = '<a href="#" class="btn btn-sm btn-danger deleteArticle" data-id="' + full['id'] + '" onclick="jqueryConfirm(this);"><i class="fa-solid fa-trash"></i></a>';
            return deleteButton + '<br>' + editButton;
        }
    },
];

// Function to fetch data using Axios
const fetchData = async (data, callback, settings) => {
    try {
        const response = await axios.get('/article/data');
        callback({
            draw: data.draw,
            data: response.data.data,
            recordsTotal: response.data.recordsTotal,
            recordsFiltered: response.data.recordsFiltered,
        });
    } catch (error) {
        console.error(error);
    }
};
const confirmation = ()=>{
    alert(true);
}

const options = {};

</script>

<style>
@import 'datatables.net-dt';
</style>
