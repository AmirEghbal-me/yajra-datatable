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
        /*submitForm(event) {
            event.preventDefault();
            var id = $('#article_id').val();

            var title = $('#title').val().trim();
            var description = $('#description').val().trim();
            var categories = $('#categoryAdd').val();
            var tags = $('#tagAdd').val();
            var isActive = $('#isActive').val();
            $.ajax({
                url: "/article/createArticle",
                type: 'post',
                data: {_token: CSRF_TOKEN,id: id,title: title, description: description, categories: categories, tags: tags, isActive: isActive},
                dataType: 'json',
                success: function(response){
                    if(response.success == 1){
                        $('#edit-tab').hide();
                        $('.tab-pane').removeClass('active').removeClass('show');
                        $('#home').addClass('active').addClass('show');
                        $('#home-tab').addClass('active');

                    }else{
                        alert(response.msg);
                    }
                }
            });
            /!*axios.post('/article/createArticle', { title: this.title, description: this.description, category: this.category, isActive: this.isActive })
                .then(response => {
                    alert(response);
                })
                .catch(error => {
                    alert(error);
                });*!/
        },*/
        submitForm() {
            var id = $('#article_id').val();
            var title = $('#title').val().trim();
            var description = $('#description').val().trim();
            var categories = $('#categoryAdd').val();
            var tags = $('#tagAdd').val();
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
