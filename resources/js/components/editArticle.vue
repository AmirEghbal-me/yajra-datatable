<template>
    <form method="post" action="/article/editArticle">
        <input type="hidden" name="_token" v-bind:value="csrf">
        <div class="row">
            <label for="title" class="col-form-label" >Title:</label>
            <input type="text" id="titleTab" name="title">
        </div>
        <div class="row">
            <label for="description" class="col-form-label">Description:</label>
            <input type="text" name="description" id="descriptionTab">
        </div>
        <div class="row">
            <label for="category" class="col-form-label">Category:</label>
            <select id="categoryTab" name="category">
                <option v-for="(title, id) in categories" :value="id" :key="id">{{ title }}</option>
            </select>
        </div>
        <div class="row">
            <label for="tagEdit" class="col-form-label">Tag:</label>
            <select id="tagEdit" name="tags[]" v-model="tags" style="width: 100%;" multiple="multiple">
                <option v-for="(title, id) in tags" :value="id" :key="id">{{ title }}</option>
            </select>
        </div>
        <div class="row">
            <label for="isActive">Is Active</label>
            <select class="isActive" id="isActiveTab" name="isActive" style="width: 100%">
                <option value="0">no</option>
                <option value="1">yes</option>
            </select>
        </div>

        <input type="hidden" name="id" id="tab_article_vue_id">
        <button type="submit">Submit</button>
    </form>
</template>

<script>

import axios from 'axios';
export default {
    data() {
        return {
            id: '',
            titles: '',
            description: '',
            category: '',
            isActive: '',
            categories: [],
            tags: [],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        };
    },
    mounted() {
        this.getCategories();
        this.getTags();
    },
    methods: {
        /*submitForm() {
            const formData = {
                title: $('#titleTab').val(),
                id: $('#tab_article_id').val(),
                description: $('#descriptionTab').val(),
                category: $('#categoryTab').val(),
                tags: $('#tagEdit').val(),
                isActive: $('#isActiveTab').val(),

            };
            axios.post('/article/editArticle', formData)
                .then(response => {
                    $('#edit-tab').hide();
                    $('.tab-pane').removeClass('active').removeClass('show');
                    $('#home').addClass('active').addClass('show');
                    $('#home-tab').addClass('active');
                })
                .catch(error => {
                    alert(error);
                });
        },*/
        submitForm() {
            var id = $('#tab_article_vue_id').val();
            var title = $('#titleTab').val().trim();
            var description = $('#descriptionTab').val().trim();
            var categories = $('#categoryTab').val();
            var tags = $('#tagEdit').val();
            var isActive = $('#isActiveTab').val();
            this.$emit('form-edit-submitted', {
                id: id,
                categories: categories,
                tags: tags,
                isActive: isActive,
                title: title,
                description: description,
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
