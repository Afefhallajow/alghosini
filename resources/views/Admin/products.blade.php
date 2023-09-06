@extends('layouts.Master')
@section('content')
<div class="container">
<div class="row mb-4">
<div class="col-m-3 ">
<button class="btn btn-primary" id="addButton"  data-bs-toggle="modal" data-bs-target="#addModal">اضافة مواد جديدة</button>
</div>

</div>
<div class="modal" id="addModal" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">ضافة عناصر جديدة </h5>
</div>
<form method="post" action="{{route('saveproduct')}}">
@csrf
<div class="modal-body">



<div class="repeater">
<!--
The value given to the data-repeater-list attribute will be used as the
base of rewritten name attributes.  In this example, the first
data-repeater-item's name attribute would become group-a[0][text-input],
and the second data-repeater-item would become group-a[1][text-input]
-->
<div data-repeater-list="products">
<div data-repeater-item>

<div class="row mb-3">
<div class="col-4">
<label for="name" class="form-label">اسم الوصفة</label>
<input type="text" class="form-control" id="name" name="name" placeholder=" اسم الوصفة">
</div>

</div>
<div class="repeater1">
<!--
The value given to the data-repeater-list attribute will be used as the
base of rewritten name attributes.  In this example, the first
data-repeater-item's name attribute would become group-a[0][text-input],
and the second data-repeater-item would become group-a[1][text-input]
-->
<div data-repeater-list="items">
    <input data-repeater-create type="button" class="btn btn-primary my-1" value=" اضافة مادة جديدة"/>

    <div data-repeater-item>

<div class="row">
<div class="col-6">
<label for="name" class="form-label">اسم المادة</label>
<select type="text" class="form-control" id="item-name" name="item-name" placeholder=" اسم المادة">
@foreach($items as $item)
<option value="{{$item->id}}">

    {{$item->name}}
</option>
@endforeach
</select>
</div>
    <div class="col-6" >
        <label for="name" class="form-label">كمية المادة</label>
        <input type="text" class="form-control" id="item-quantity" name="item-quantity" placeholder=" كمية المادة">

    </div>
</div>
<input data-repeater-delete type="button" class="btn btn-danger my-1 " value="حذف"/>
<hr>

</div>

</div>




</div>

<input data-repeater-delete type="button" class="btn btn-danger my-1" value="حذف وصفة"/>
</div>
</div>

<input data-repeater-create type="button" class="btn btn-primary my-1" value="اضافة وصفة  "/>


</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">أغلاق</button>
<button type="submit"  class="btn btn-primary">حفظ</button>
</div>
</form>
</div>

</div>
</div>

<table  class="responsive nowrap" id="mytable">
<thead>
<th>
الاسم
</th>
<th>
(1kg)        السعر
</th>
<th>
عمليات
</th>

</thead>
<tbody>

</tbody>
</table>
    <div class="modal fade" id="showmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="staticBackdropLabel">اسم الوصفة</h5>

                </div>
                <div id="show_recipe" class="modal-body">



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                    <button type="button" class="btn btn-primary"  data-bs-dismiss="modal">فهمت</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- edit////////////////////////////////////////////////// -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
<form method="post" action="{{route('updateproduct')}}">
    @csrf
    <div id="editProduct" class="modal-body">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-primary">Save changes</button>
            </div>
</form>
        </div>
    </div>
</div>
<!-- delete////////////////////////////////////////////////// -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف عنصر</h5>
            </div>
            <form method="post" action="{{route('deleteproduct')}}">
            @csrf
                <div id="deleteProduct" class="modal-body">


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                <button type="submit" class="btn btn-danger">حذف</button>
            </div>

            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
$(function () {

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
console.log('afef');
var table = $('#mytable').DataTable({

responsive: true,
rowReorder: {
selector: 'td:nth-child(2)'
},

serverSide: true,
ajax: "{{ route('getproducts') }}",
columns: [
{data: 'name', name: 'name'},
{data: 'price', name: 'price'},
{data: 'action', name: 'action', orderable: false, searchable: false},
]
});

$('#createNewPost').click(function () {
$('#savedata').val("create-post");
$('#id').val('');
$('#postForm').trigger("reset");
$('#modelHeading').html("Create New Post");
$('#ajaxModelexa').modal('show');
});
////////// delete//////
    $('body').on('click', '.deletePost', function () {
        var id = $(this).data('id');
        $('#deleteProduct').empty();
var item='<input type="hidden" value="'+id+'" name="id" >'+
    '<p>انت متأكد من الحذف </p>'
        $('#deleteProduct').append(item);

        $('#deleteModal').modal('show');


    });

///// show the components////////
$('body').on('click', '.showRecipe', function () {
        var id = $(this).data('id');
//var url={{route('getTheRecipe',"id")}}
  //  url.replace("id",id);
console.log('1')
    $.ajax({
        url: '/products/recipe/'+id,
        type: 'GET',
        success: function(data) {
       console.log(data)
            $('#show_recipe').empty();
            $('#show_recipe').append(data);
            $('#showmodal').modal('show');

        },
        error: function (request, error) {
            console.log(arguments);
            alert(" Can't do because: " + error);
        },
    });
    });

///// edite ///////
$('body').on('click', '.editPost', function () {
    $('editProduct').empty();

    var id = $(this).data('id');

    $.ajax({
        url: '{{route('products')}}/'+id+"/edite",
        type: 'GET',
        success: function(data) {
            $('#editProduct').empty(temp);
            console.log(data)

var items='';

            for(i=0; i<data.items.length;i++)
            {
                items+="<div class='row'> <div class='col-6'>" +
                   '  <input disabled type="text" value="' + data.items[i].name+' " name=" '+data.items[i].name+'" class="form-control"> '
              +'</div>'
                    +"<div class='col-6'>" +
                    '  <input  type="text" value="' + data.items[i].percent+' " name=" '+data.items[i].id+'" class="form-control"> '
                    +'</div>'+'</div>'

console.log(items)

            }
            var temp='<div class="row">' +
                '<div class="col-m-6">' +
                '<input type="text" value="' + data.name+' " name="name" class="form-control "> ' +
                '<input type="hidden" value="' + data.id+' " name="id" class="form-control "> ' +

                '</div>'
+items+
                '</div>'
                $('#editProduct').append(temp);
            $('#editModal').modal('show');

        },
        error: function (request, error) {
            console.log(arguments);
            alert(" Can't do because: " + error);
        },
    });
});


})
$(function () {
'use strict';

// form repeater jquery
$('.repeater, .repeater-default').repeater({


        repeaters: [{
            selector: '.repeater1',
                        }]
     ,

    show: function () {
$(this).slideDown();
// Feather Icons
},
hide: function (deleteElement) {
if (confirm('Are you sure you want to delete this element?')) {
$(this).slideUp(deleteElement);
}
}
});

})

var table1 = $('#mytable1').DataTable({

    responsive: true,

});

</script>

@endsection
