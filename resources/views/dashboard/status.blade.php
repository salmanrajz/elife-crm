@extends('layouts.dashboard-app')

@section('main-content')
<div class="content-body">
    <div class="container">
        <div class="row page-titles">
            <div class="col p-0">
                        <h4>Hello, <span>Welcome {{auth()->user()->name}}</span></h4>

            </div>
            <div class="col p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Form</a>
                    </li>
                    <li class="breadcrumb-item active">Partner</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-info text-white text-center"><h2><b>Online Status</b></h2></div>
                    <div class="card-body">
                        <a class="btn btn-success" onclick="OnlineHandling('{{route('Online.Status.Ajax')}}','All')" style="color: white">All Users</a>
                        <a class="btn btn-yahoo" onclick="OnlineHandling('{{route('Online.Status.Ajax')}}','Online')" style="color: white">Online</a>
                        <a class="btn btn-info" onclick="OnlineHandling('{{route('Online.Status.Ajax')}}','Offline')" style="color: white">Recently Offline</a>

                        <div class="table-responsive" id="broom">
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
                                @php $users = DB::table('users')->get(); @endphp
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
                        </div>
                    </div>
                </div>
            </div>
            </div>

        </div>

    </div>
    <!-- #/ container -->
</div>
@endsection
