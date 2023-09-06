@extends('layouts.Master')
@section('content')
<div class="container">
    <div class="row  mb-4">
<div class="col-s-4 ">
    <button class="btn btn-primary" id="addButton"  data-bs-toggle="modal" data-bs-target="#addModal">اضافة مواد جديدة</button>
</div>
</div>
<div class="modal" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ضافة عناصر جديدة </h5>
            </div>
            <form method="post" action="{{route('saveItem')}}">
@csrf
            <div class="modal-body">



                    <div class="repeater">
                        <!--
                            The value given to the data-repeater-list attribute will be used as the
                            base of rewritten name attributes.  In this example, the first
                            data-repeater-item's name attribute would become group-a[0][text-input],
                            and the second data-repeater-item would become group-a[1][text-input]
                                    -->
                        <div data-repeater-list="items">
                            <div data-repeater-item>

                                <div class="row mb-3">
                                    <div class="col-s-4">
                                    <label for="name" class="form-label">اسم المادة</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder=" اسم المادة">
                                </div>
                                    <div class="col-s-4">
                                        <label for="quantity" class="form-label"> الكمية (kg)</label>
                                        <input type="number" step="0.1" class="form-control" id="quantity" name="quantity" placeholder=" كمية المادة">
                                    </div>
                                    <div class="col-s-4">
                                        <label for="price" class="form-label">سعر المادة</label>
                                        <input type="number" class="form-control" step="0.1" id="price" name="price" placeholder=" سعر المادة">
                                    </div>


                                </div>

                                <input data-repeater-delete type="button" class="btn btn-danger my-1" value="حذف"/>
                            </div>
                        </div>

                        <input data-repeater-create type="button" class="btn btn-primary my-1" value="اضافة"/>


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
</div>
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعديل عنصر </h5>

            </div>
<form method="post" action="{{route('updateItem')}}">
@csrf            <div id="editItem" class="modal-body">



            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
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
            <form method="post" action="{{route('deleteitem')}}">
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
                ajax: "{{ route('getItem') }}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'price', name: 'price'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
////// delete/////
            $('body').on('click', '.deletePost', function () {
                var id = $(this).data('id');
                $('#deleteProduct').empty();
                var item='<input type="hidden" value="'+id+'" name="id" >'+
                    '<p>انت متأكد من الحذف </p>'
                $('#deleteProduct').append(item);

                $('#deleteModal').modal('show');


            });
////// edite/////
            $('body').on('click', '.editPost', function () {
                var id = $(this).data('id');
console.log('edite');
                $.get("{{ route('items') }}" + '/' + id + '/edit', function (data) {

                    $('#editItem').empty();
var h='<div class="row mb-3">'+
'    <div class="col-s-4">'+
    '       <label for="name" class="form-label">اسم المادة</label>'+
' <input type="text" class="form-control" id="name" value="'+data.name+'" name="name" placeholder=" اسم المادة">  </div>' +
    ' <input type="hidden" class="form-control" id="name" value="'+data.id+'" name="id" placeholder=" اسم المادة">  </div>' +

'<div class="col-s-4">'+
'<label for="quantity" class="form-label">الكمية (kg) </label>'+
'<input type="number" step="0.1" class="form-control" id="quantity" value="1" name="quantity" placeholder=" كمية المادة">'+
'</div>'+
'<div class="col-s-4">'+
'<label for="price" class="form-label">سعر المادة</label>'+
'<input type="number" class="form-control" step="0.1" id="price" value="'+data.price+'" name="price" placeholder=" سعر المادة">'+
'</div>'+


'</div>';

               $('#editItem').append(h)
                    $('#editModal').modal('show')

                })
            });


        })
        $(function () {
            'use strict';

            // form repeater jquery
            $('.repeater, .repeater-default').repeater({
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

</script>

@endsection
