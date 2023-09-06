@foreach($data as $data1)
    <div style="display: flex;flex-direction: row ;justify-content: space-between"  >

        <div class="col-3">
            <p>{{$data1["name"]}}</p>
        </div>
        <div class="col-5">
            <p>الكمية (g)</p>
        </div>
        <div class="col-4">
            <p>{{$data1["percent"]}}</p>
        </div>
    </div>

    @endforeach
