<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Articles List in VueJs component</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
</head>
<body>
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
                    <div id="app"></div>
                </div>
                <div class="tab-pane fade" id="add" role="tabpanel" aria-labelledby="add-tab">
                    <div id="addArticle"></div>
                </div>
                <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                    <div id="editArticle"></div>
                </div>
            </div>

        </div>
    </div>
</div>


@vite('resources/js/app.js')
<script>
    $(document).ready(function() {
        $('#categoryAdd').select2();
        $('#tagAdd').select2();
    });
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    function editFunction(element){
        //alert($(element).data('id'));
        $('.tab-pane').removeClass('active').removeClass('show');
        $('.nav-link').removeClass('active');
        $('#edit').addClass('active').addClass('show');
        $('#edit-tab').addClass('active');
        $('#edit-tab').show();

        var id = $(element).data('id');
        $('#tab_article_id').val(id);
        $.ajax({
            url: "{{ route('getArticleData') }}",
            type: 'post',
            data: {_token: CSRF_TOKEN,id: id},
            dataType: 'json',
            success: function(response){

                if(response.success == 1){

                    $('#titleTab').val(response.title);
                    $('#descriptionTab').val(response.description);
                    $('#isActiveTab').val(response.isActive);

                    $('#categoryTab').select2().val(response.category).trigger("change");
                }else{
                    alert("Invalid ID.");
                }
            }
        });
    }
    function jqueryConfirm(element){
        var id = $(element).data('id');
        $.confirm({
            title: "Confirm!",
            content: "Are you sure?",
            buttons: {
                confirm: function(){
                    window.location = "/article/delete/"+id;
                },
                cancel: function(){
                    $.alert("Canceled!");
                },

            }
        });
    }
</script>
</body>
</html>