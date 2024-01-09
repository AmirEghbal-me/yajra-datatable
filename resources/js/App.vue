<script setup lang="ts">
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import 'datatables.net-select';
import 'datatables.net-responsive';

DataTable.use(DataTablesCore);

const columns = [
    { data: 'id' },
    { data: 'title' },
    { data: 'description' },
    {data: 'action', name: 'action', orderable: false, searchable: false,
        mRender: function (data, type, full){
            /*var addButton = '<a href="/addArticle" class="btn btn-sm btn-danger addArticle"  data-id="'+full['id']+'">Add</a>';*/
            var editButton = '<a href="#" class="btn btn-sm btn-success "  data-id="'+full['id']+'" onclick="editFunction(this)"><i class="fa-solid fa-pen-to-square"></i></a>';
            var deleteButton = '<a href="#" class="btn btn-sm btn-danger deleteArticle"  data-id="'+full['id']+'" onclick="jqueryConfirm(this);"><i class="fa-solid fa-trash"></i></a>';

            return /*addButton+'<br>'+*/deleteButton+'<br>'+editButton;
        }
    },
];

</script>

<template>

    <DataTable
        :columns="columns"
        :options="options"
        ajax="/article/data"
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

<style>
@import 'datatables.net-dt';
</style>

