<script setup>
import App from '../App.vue'
import edit from './editArticle.vue';
import add from './addArticle.vue';

</script>
<template>

    <div class="container">
        <div class="row">
            <div class="col-xs-10">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Management</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="add-tab" data-bs-toggle="tab" data-bs-target="#add" type="button" role="tab" aria-controls="profile" aria-selected="false">Add</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="edit-tab" data-bs-toggle="tab" data-bs-target="#edit" type="button" role="tab" aria-controls="profile" aria-selected="false" style="display: none">Edit</button>
                    </li>
                </ul>
                <div class="tab-content " id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <App/>
                    </div>
                    <div class="tab-pane fade" id="add" role="tabpanel" aria-labelledby="add-tab">
                        <add @form-add-submitted="handleAddFormSubmitted" />
                    </div>
                    <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                        <edit @form-edit-submitted="handleEditFormSubmitted"/>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
<script>

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
export default {
    components: {
        add,
        edit,
    },
    data() {
        return {
            ajaxUrl: '/article/categories',
            selectedValue: null,

        };
    },
    methods: {
        handleAddFormSubmitted(formData) {
            $.ajax({
                url: "/article/createArticle",
                type: 'post',
                data: {
                    _token: CSRF_TOKEN,
                    id: formData.id,
                    title: formData.title,
                    description: formData.description,
                    categories: formData.categories,
                    tags: formData.tags,
                    isActive: formData.isActive},
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
        },
        handleEditFormSubmitted(formData) {
            $.ajax({
                url: "/article/editArticle",
                type: 'post',
                data: {
                    _token: CSRF_TOKEN,
                    id: formData.id,
                    title: formData.title,
                    description: formData.description,
                    categories: formData.categories,
                    tags: formData.tags,
                    isActive: formData.isActive},
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
        },
    }
}
</script>
