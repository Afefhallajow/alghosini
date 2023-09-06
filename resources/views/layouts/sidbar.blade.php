<aside class="sidbar">

    <hr>

    <div id="sidbar-img">
        <div class="row">
        <img src="{{asset('flexassests/image/1.jpg')}}">
        </div>
    </div>
    <hr>

    <div id="sidbar-title">
        <div class="row">
            <div class="col-2">
                <span  class="fa fa-home"></span>
            </div>
            <div class="col-10 ">
                <h2>حلويات الغصيني</h2>
            </div>
        </div>
    </div>


    <div id="sidbar-item">
        <div style="" class="d-flex mt-2 menu-item">
            <span  class="fa fa-home"></span>
           <a href="{{route('products')}}"> <h4 dir="ltr">الوصفات</h4></a>
            <span class="uil uil-angle-left-b"></span>
        </div>

        <div style="" class="d-flex mt-2 menu-item">
            <span  class="fa fa-home"></span>
            <a href="{{route('items')}}"> <h4 dir="ltr">المواد الاولية</h4></a>
            <span class="uil uil-angle-left-b"></span>
        </div>
        <div style="" class="d-flex mt-2 menu-item">
            <span  class="fa fa-home"></span>
            <a href="{{route('products')}}"> <h4 dir="ltr">الموظفين</h4></a>
            <span class="uil uil-angle-left-b"></span>
        </div>

    </div>
</aside>
