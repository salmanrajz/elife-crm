@if($type == 'All')

<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Last Seen</th>
        </tr>
    </thead>
    <tbody>
    @php $users = DB::table('users')->orderBy('last_seen', 'desc')->get(); @endphp
    @foreach($users as $user)
            <tr>
                <td>
                    {{$user->name}}
                </td>
                <td>
                    {{$user->email}}
                </td>
                <td>
                    @if(Cache::has('is_online' . $user->id))
                <span class="text-success">Online</span>
                @else
                    <span class="text-secondary">Offline</span>
                @endif
                </td>
                <td>
                    {{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                </td>
            </tr>
            @endforeach

        </tbody>
</table>

@elseif($type == 'Online')

<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Last Seen</th>
        </tr>
    </thead>
    <tbody>
    @php $users = DB::table('users')->WhereBetween('last_seen',[now()->subMinutes(3), now()])->orderBy('last_seen', 'desc')->get(); @endphp
    @foreach($users as $user)
            <tr>
                <td>
                    {{$user->name}}
                </td>
                <td>
                    {{$user->email}}
                </td>
                <td>
                    @if(Cache::has('is_online' . $user->id))
                    <span class="text-success">Online</span>
                    @endif
                </td>
                <td>
                    {{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                </td>
            </tr>
            @endforeach

        </tbody>
</table>

@elseif($type == 'Offline')

<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Last Seen</th>
        </tr>
    </thead>
    <tbody>
    @php $users = DB::table('users')->where('last_seen','<',[now()->subMinutes(5)])->orderBy('last_seen', 'desc')->get(); @endphp

    {{-- @php $users = DB::table('users')->where('last_seen','<',Carbon\Carbon::now()->subMinutes(5)->toDateTimeString()); @endphp --}}
    @foreach($users as $user)
            <tr>
                <td>
                    {{$user->name}}
                </td>
                <td>
                    {{$user->email}}
                </td>
                <td>
                @if(!Cache::has('is_online' . $user->id))
                <span class="text-secondary">Offline</span>
                @endif
                </td>
                <td>
                    {{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                </td>
            </tr>
            @endforeach

        </tbody>
</table>

@endif


    <script src="{{asset('assets/plugins/tables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/tables/js/datatable-init/datatable-basic.min.js')}}"></script>
