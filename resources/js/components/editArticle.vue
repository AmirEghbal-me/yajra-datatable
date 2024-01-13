<template>
    <form method="post" @submit.prevent="submitForm">
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
            <multiselect
                v-model="categories"
                :options="optionsCategory"
                :loading="isLoading"
                label="title"
                track-by="id"
                :limit="3">
            </multiselect>
        </div>
        <div class="row">
            <label for="tagEdit" class="col-form-label">Tag:</label>
            <Multiselect
                v-model="tags"
                :options="optionsTag"
                :multiple="true"
                :taggable="true"
                @tag="addTag"
                label="title"
                track-by="id"
                :limit="3">
                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
            </Multiselect>
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
import Multiselect from "vue-multiselect";
export default {
    components: {
        Multiselect
    },
    data() {
        return {
            id: '',
            titles: '',
            description: '',
            category: '',
            isActive: '',
            categories: null,
            tags: [],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            optionsCategory: ['1'],
            optionsTag: ['1']
        };
    },
    mounted() {
        this.fetchCategoryOptions(),
            this.fetchTagOptions()
    },
    methods: {
        submitForm() {
            var id = $('#tab_article_vue_id').val();
            var title = $('#titleTab').val().trim();
            var description = $('#descriptionTab').val().trim();
            var categories = this.categories;
            var tags = this.tags;
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
        fetchCategoryOptions() {
            axios.get('/article/categories')
                .then(response => {
                    this.optionsCategory = response.data;
                    //this.categories = [{ id: '1', title: 'حادثه کرمان' }];
                })
                .catch(error => {
                    console.error(error)
                })
        },
        fetchTagOptions() {
            axios.get('/article/tags')
                .then(response => {
                    this.optionsTag = response.data;
                })
                .catch(error => {
                    console.error(error)
                })
        },
    }
}

</script>
