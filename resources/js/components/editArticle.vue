<template>
    <form action="/article/editArticle" method="post">
        <input type="hidden" name="_token" v-bind:value="csrf">
        <div class="row">
            <label for="title" class="col-form-label">Title:</label>
            <input type="text" name="title" id="titleTab"  v-model="title">
        </div>
        <div class="row">
            <label for="description" class="col-form-label">Description:</label>
            <input type="text" name="description" id="descriptionTab"  v-model="description">
        </div>
        <div class="row">
            <label for="category" class="col-form-label">Category:</label>
            <select id="categoryTab" name="category" v-model="category">
                <option v-for="(title, id) in categories" :value="id" :key="id">{{ title }}</option>
            </select>
        </div>
        <div class="row">
            <lable for="isActive">Is Active</lable>
            <select class="isActive" id="isActiveTab" name="isActive" v-model="isActive" style="width: 100%">
                <option value="0">no</option>
                <option value="1">yes</option>
            </select>
        </div>

        <input type="hidden" name="id" id="tab_article_id">
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
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },
    mounted() {
        this.getCategorie();
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
        getCategorie() {
            axios.get('/article/categories')
                .then(response => {
                    this.categories = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
    }
}
</script>
