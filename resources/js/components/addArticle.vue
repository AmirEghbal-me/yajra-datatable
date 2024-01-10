<template>
    <form @submit.prevent="submitForm">
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
            <label class="typo__label">Category</label>
            <multiselect
                v-model="categories"
                :options="optionsCategory"
                :loading="isLoading"
                :limit="3">
            </multiselect>
        </div>
        <div class="row">
            <div>
                <label class="typo__label">Tag</label>
                <MultiselectTag name="tags[]" :multiple="true" v-model="tags" :options="optionsTag" :preserve-search="true" placeholder="Pick some" label="title" track-by="id" :preselect-first="true">
                    <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                </MultiselectTag>

            </div>
        </div>
        <div class="row">
            <lable for="isActive">Is Active</lable>
            <select id="isActive" class="isActive" name="isActive" v-model="isActive" style="width: 100%">
                <option value="0">no</option>
                <option value="1">yes</option>
            </select>
        </div>


        <button type="submit">Submit</button>
    </form>
</template>

<script>

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
import axios from 'axios';
import Multiselect from 'vue-multiselect'
import MultiselectTag from 'vue-multiselect'

export default {
    components: {
        MultiselectTag,
        Multiselect
    },
    data() {
        return {
            title: '',
            description: '',
            category: '',
            isActive: '',
            categories: null,
            tags: [],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            selected: null,
            optionsCategory: ['1'],
            optionsTag: [
                { title: 'طوفان الاقصی', id: '1' },
                { title: 'تیم ملی', id: '2' },
                { title: 'رضا عطاران', id: '3' }
            ]
        }
    },
    mounted() {
        this.fetchOptions()
    },
    methods: {
        submitForm() {console.log(this.tags);
            var id = $('#article_id').val();
            var title = this.title;
            var description = this.description;
            var categories = this.categories;
            var tags = this.tags;
            var isActive = $('#isActive').val();
            this.$emit('form-add-submitted', {
                id: id,
                categories: categories,
                tags: tags,
                isActive: isActive,
                title: title,
                description: description,
            });
        },
        fetchOptions() {
            axios.get('/article/categories')
                .then(response => {console.log(response.data);

                    this.optionsCategory = response.data;
                })
                .catch(error => {
                    console.error(error)
                })
        }
    }
}
</script>
