<script lang="ts">
import axios from "axios";
export default {
    data() {
        return {
            id: '',
            articleData : ''
        }
    },

    mounted() {
        this.getData()
    },
    methods:{
        confirmation(id){
            this.$emit('articleIdSubmit',id)
        },
        getData(){
            axios.get('/article/data')
                .then(response => {
                    this.articleData = response.data.data;
                })
                .catch(error => {
                    console.error(error)
                })
        }
    }
}
</script>
<template>
    <table>
        <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="data in articleData">
            <td>{{ data.id }}</td>
            <td>{{ data.title }}</td>
            <td>{{ data.description }}</td>
            <td><button data-id="{{ data.id }}" @click="confirmation(data.id)" onclick="editFunction(this);">edit</button></td>
        </tr>
        </tbody>
    </table>
</template>

