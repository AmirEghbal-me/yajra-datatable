<template>
    <form action="/article/createArticle" method="post">
        <input type="hidden" name="_token" v-bind:value="csrf">
        <div class="row">
            <label for="title" class="col-form-label">Title:</label>
            <input type="text" name="title" id="title"  v-model="title">
        </div>
        <div class="row">
            <label for="description" class="col-form-label">Description:</label>
            <input type="text" name="description" id="description"  v-model="description">
        </div>
        <div class="row">
            <label for="categoryAdd" class="col-form-label">Category:</label>
            <select id="categoryAdd" name="categories" v-model="categories" style="width: 100%;">
                <option v-for="(title, id) in categories" :value="id" :key="id">{{ title }}</option>
            </select>
        </div>
        <div class="row">
            <label for="tagAdd" class="col-form-label">Tag:</label>
            <select id="tagAdd" name="tags[]" v-model="tags" style="width: 100%;" multiple="multiple">
                <option v-for="(title, id) in tags" :value="id" :key="id">{{ title }}</option>
            </select>
        </div>
        <div class="row">
            <lable for="isActive">Is Active</lable>
            <select class="isActive" name="isActive" v-model="isActive" style="width: 100%">
                <option value="0">no</option>
                <option value="1">yes</option>
            </select>
        </div>


        <button type="submit">Submit</button>
    </form>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            title: '',
            description: '',
            category: '',
            isActive: '',
            categories: [],
            tags: [],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },
    mounted() {
        this.getCategories();
        this.getTags();
    },
    methods: {
        submitForm() {

            axios.post('/article/createArticle', { title: this.title, description: this.description, category: this.category, isActive: this.isActive })
                .then(response => {
                    alert(response);
                })
                .catch(error => {
                    alert(error);
                });
        },
        getCategories() {
            axios.get('/article/categories')
                .then(response => {
                    this.categories = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getTags() {
            axios.get('/article/tags')
                .then(response => {
                    this.tags = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
    }
}
</script>
