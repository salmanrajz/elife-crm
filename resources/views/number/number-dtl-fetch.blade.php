@if (auth()->user()->agent_code == 'ARF')
<div class="" id="broom">
    <table class="table ">
        <thead>
            <tr>
                <th>Number</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td style="font-size:18px;">
                    {{$item->number}}
                </td>
                <td style="font-size:18px;">
                    {{$item->type}}
                </td>
                <td>
                <a href="#" onclick="BookNum('{{$item->id}}','{{route('ajaxRequest.BookNum')}}')" class="btn btn-success">Reserve Now</a>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>
@else
<div class="table-responsive" id="broom">
    <table class="table table-striped table-bordered zero-configuration">
        <thead>
            <tr>
                <th>Number</th>
                <th>Type</th>
                <th>Channel</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                @php
                    $date = \Carbon\Carbon::parse($item->created_at);
                    $now = \Carbon\Carbon::now();
                    $diff = $date->diffInDays($now);
                @endphp
                @if ($diff <= 5)
                <td style="font-size:18px;color:red">
                    {{-- {{\Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans()}} --}}
                    {{$item->number}} | (NEW)
                </td>
                @else
                <td style="font-size:18px;">
                    {{-- {{\Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans()}} --}}
                    {{$item->number}}
                </td>
                @endif
                <td style="font-size:18px;">
                    {{$item->type}}
                </td>
                <td style="font-size:18px;">
                    {{$item->channel_type}}
                </td>
                <td>
                <a href="#" onclick="BookNum('{{$item->id}}','{{route('ajaxRequest.BookNum')}}','{{$item->channel_type}}')" class="btn btn-success">Reserve Now</a>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endif

    <script src="{{asset('assets/plugins/tables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/tables/js/datatable-init/datatable-basic.min.js')}}"></script>
