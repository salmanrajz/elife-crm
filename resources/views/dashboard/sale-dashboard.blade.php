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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
                @can('manage postpaid')
                {{-- @inject('name', 'class') --}}
                @inject('provider', 'App\Http\Controllers\HomeController')

                @foreach ($channel_partner as $cp)

                <h2 class="text-left display-6">
                    PostPaid ({{$cp->name}})
                </h2>
                <div class="row mt-3">
                    <div class="col-lg-2">
                        <div class="card" id="active_div">
                            <div class="card-body text-center" onclick="reportChannel('{{auth()->user()->id}}','{{route('ajaxRequest.ChannelReport')}}','1.02','{{$cp->name}}')">
                                <h4 class="white" style="color:#fff;">Total Activations</h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" onclick="reportChannel('{{auth()->user()->id}}','{{route('ajaxRequest.ChannelReport')}}','1.02','{{$cp->name}}')">
                                    {{$provider::TotalChannelLead('1.01','postpaid',$cp->name)}}
                                </h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="verified_div">
                            <div class="card-body text-center" onclick="reportChannel('{{auth()->user()->id}}','{{route('ajaxRequest.ChannelReport')}}','1.07','{{$cp->name}}')">
                                <h4 class="white" style="color:#fff;">Total Verified</h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" onclick="reportChannel('{{auth()->user()->id}}','{{route('ajaxRequest.ChannelReport')}}','1.07','{{$cp->name}}')">
                                    {{$provider::TotalChannelLead('1.09','postpaid',$cp->name)}}
                                </h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="rejected_div">
                            <div class="card-body text-center">
                                <h4 class="white" style="color:#fff;">Total Rejected</h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" onclick="reportChannel('{{auth()->user()->id}}','{{route('ajaxRequest.ChannelReport')}}','1.04','{{$cp->name}}')" >

                                    {{$provider::TotalChannelLead('1.04','postpaid',$cp->name)}}
                                </h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="follow_up_div">
                            <div class="card-body text-center" onclick="reportChannel('{{auth()->user()->id}}','{{route('ajaxRequest.ChannelReport')}}','1.03','{{$cp->name}}')">
                                <h4 class="white" style="color:#fff;">Total Follow Up </h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" onclick="reportChannel('{{auth()->user()->id}}','{{route('ajaxRequest.ChannelReport')}}','1.03','{{$cp->name}}')">
                                    {{$provider::TotalChannelLead('1.03','postpaid',$cp->name)}}
                                </h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="pending_div">
                            <div class="card-body text-center" onclick="report('{{auth()->user()->id}}','{{route('ajaxRequest.ChannelReport')}}','1.01','{{$cp->name}}')">
                                <h4 class="white" style="color:#fff;">Total Pending </h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" onclick="report('{{auth()->user()->id}}','{{route('ajaxRequest.ChannelReport')}}','1.01','{{$cp->name}}')">
                                    {{$provider::TotalChannelLead('1.01','postpaid',$cp->name)}}
                                </h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="process_div">
                            <div class="card-body text-center" onclick="reportChannel('{{auth()->user()->id}}','{{route('ajaxRequest.ChannelReport')}}','1.10','{{$cp->name}}')">
                                <h4 class="white" style="color:#fff;">Total In Process </h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" onclick="reportChannel('{{auth()->user()->id}}','{{route('ajaxRequest.ChannelReport')}}','1.10','{{$cp->name}}')">
                                    {{$provider::TotalChannelLead('1.10','postpaid',$cp->name)}}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                {{--  --}}
                @endcan
                @can('manage elife')

                <h2 class="text-left display-6">Elife</h2>
                <div class="row">
                    <div class="col-lg-2">
                        <div class="card" style="background:#5858ea">
                            <div class="card-body text-center" onclick="report('{{auth()->user()->id}}','{{route('ajaxRequest.report')}}','1.02')">
                                <h4 class="white" style="color:#fff;">Total Activation</h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" onclick="report('{{auth()->user()->id}}','{{route('ajaxRequest.report')}}','1.02')">
                                    {{$elife_activation}}
                                </h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="verified_div">
                            <div class="card-body text-center" onclick="report('{{auth()->user()->id}}','{{route('ajaxRequest.report')}}','1.07')">
                                <h4 class="white" style="color:#fff;">Total Verified</h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" onclick="report('{{auth()->user()->id}}','{{route('ajaxRequest.report')}}','1.07')"> {{$elife_verified}}</h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="rejected_div">
                            <div class="card-body text-center">
                                <h4 class="white" style="color:#fff;">Total Rejected</h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" onclick="report('{{auth()->user()->id}}','{{route('ajaxRequest.report')}}','1.04')" > {{$elife_rejected}}</h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="follow_up_div">
                            <div class="card-body text-center" onclick="report('{{auth()->user()->id}}','{{route('ajaxRequest.report')}}','1.03')">
                                <h4 class="white" style="color:#fff;">Total Follow Up </h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" onclick="report('{{auth()->user()->id}}','{{route('ajaxRequest.report')}}','1.03')"> {{$elife_follow_up}}</h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="pending_div">
                            <div class="card-body text-center" onclick="report('{{auth()->user()->id}}','{{route('ajaxRequest.report')}}','1.01')">
                                <h4 class="white" style="color:#fff;">Total Pending </h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" onclick="report('{{auth()->user()->id}}','{{route('ajaxRequest.report')}}','1.01')"> {{$elife_pending}}</h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="process_div">
                            <div class="card-body text-center" onclick="report('{{auth()->user()->id}}','{{route('ajaxRequest.report')}}','1.10')">
                                <h4 class="white" style="color:#fff;">Total In Process </h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" onclick="report('{{auth()->user()->id}}','{{route('ajaxRequest.report')}}','1.10')"> {{$elife_in_process}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                @endcan
                @can('manage itproducts')
                <h2 class="text-left display-6">IT Products</h2>
                <div class="row">
                    <div class="col-lg-2">
                        <div class="card" style="background:#5858ea" id="active_div">
                            <div class="card-body text-center" onclick="report('{{auth()->user()->id}}','{{route('ajaxRequest.report')}}','1.02')">
                                <h4 class="white" style="color:#fff;">Total Activation</h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" onclick="report('{{auth()->user()->id}}','{{route('ajaxRequest.report')}}','1.02')">
                                    {{$it_activation}}
                                </h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="verified_div" id="pending_div">
                            <div class="card-body text-center" onclick="report('{{auth()->user()->id}}','{{route('ajaxRequest.report')}}','1.07')">
                                <h4 class="white" style="color:#fff;">Total Verified</h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" onclick="report('{{auth()->user()->id}}','{{route('ajaxRequest.report')}}','1.07')"> {{$it_verified}}</h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="rejected_div" id="rejected_div">
                            <div class="card-body text-center">
                                <h4 class="white" style="color:#fff;">Total Rejected</h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" onclick="report('{{auth()->user()->id}}','{{route('ajaxRequest.report')}}','1.04')" > {{$it_rejected}}</h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="follow_up_div" id="follow_up_div">
                            <div class="card-body text-center" onclick="report('{{auth()->user()->id}}','{{route('ajaxRequest.report')}}','1.03')">
                                <h4 class="white" style="color:#fff;">Total Follow Up </h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" onclick="report('{{auth()->user()->id}}','{{route('ajaxRequest.report')}}','1.03')"> {{$it_follow_up}}</h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="pending_div" id="pending_div">
                            <div class="card-body text-center" onclick="report('{{auth()->user()->id}}','{{route('ajaxRequest.report')}}','1.01')">
                                <h4 class="white" style="color:#fff;">Total Pending </h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" onclick="report('{{auth()->user()->id}}','{{route('ajaxRequest.report')}}','1.01')"> {{$it_pending}}</h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="process_div" id="process_div">
                            <div class="card-body text-center" onclick="report('{{auth()->user()->id}}','{{route('ajaxRequest.report')}}','1.10')">
                                <h4 class="white" style="color:#fff;">Total In Process </h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" onclick="report('{{auth()->user()->id}}','{{route('ajaxRequest.report')}}','1.10')"> {{$it_in_process}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                @endcan
                <div class="row">
                    <div class="col-12">
                        <div class="card" >
                            <div class="card-body text-center" id="data">

                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-xl-7">
                        <div class="card" style="background:#5858ea">
                            <div class="card-body text-center">
                                <h4 class=" card-title">Monthly Income</h4>
                                <div class="f-s-30 f-w-300 text-success">$3500 <span class="f-s-16 text-uppercase">USD</span>
                                </div>
                                <a href="#" class="btn btn-outline-dark btn-flat m-t-5 m-b-30 f-s-14">View Details</a>
                                <canvas id="sales-graph-top"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5">
                        <div class="card" style="background:#5858ea">
                            <div class="card-body text-center">
                                <h4 class="card-title">Messages</h4>
                                <div class="media border-bottom-1 p-t-15 p-b-15">
                                    <img src="../../assets/images/avatar/1.jpg" class="mr-3 rounded-circle" alt="">
                                    <div class="media-body">
                                        <h5>John Tomas</h5>
                                        <p class="m-b-0">I shared this on my fb wall a few months back,</p>
                                    </div><span class="text-muted f-s-12">April 24, 2018</span>
                                </div>
                                <div class="media border-bottom-1 p-t-15 p-b-15">
                                    <img src="../../assets/images/avatar/2.jpg" class="mr-3 rounded-circle" alt="">
                                    <div class="media-body">
                                        <h5>John Tomas</h5>
                                        <p class="m-b-0">I shared this on my fb wall a few months back,</p>
                                    </div><span class="text-muted f-s-12">April 24, 2018</span>
                                </div>
                                <div class="media p-t-15 p-b-15">
                                    <img src="../../assets/images/avatar/3.jpg" class="mr-3 rounded-circle" alt="">
                                    <div class="media-body">
                                        <h5>John Tomas</h5>
                                        <p class="m-b-0">I shared this on my fb wall a few months back,</p>
                                    </div><span class="text-muted f-s-12">April 24, 2018</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card" style="background:#5858ea">
                            <div class="card-body text-center">
                                <h2 class="f-s-30 m-b-0">$6,932.60</h2><span class="f-w-600">Total Revenue</span>
                                <div class="m-t-30">
                                    <h4 class="f-w-600">2,365</h4>
                                    <h6 class="m-t-10 text-muted">Online Earning <span class="pull-right">50%</span></h6>
                                    <div class="progress m-t-15 h-6px">
                                        <div class="progress-bar bg-primary wow animated progress-animated w-50pc h-6px" role="progressbar"></div>
                                    </div>
                                </div>
                                <div class="m-t-20 m-b-20">
                                    <h4 class="f-w-600">1,250</h4>
                                    <h6 class="m-t-10">Offline Earning <span class="pull-right">50%</span></h6>
                                    <div class="progress m-t-15 h-6px">
                                        <div class="progress-bar bg-success wow animated progress-animated w-50pc h-6px" role="progressbar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card" style="background:#5858ea">
                            <div class="card-body text-center p-0">
                                <a href="#">
                                    <div class="card-bg-img-1">
                                        <div class="card-img-overlay dark-overlay-5 text-white" style="color:#fff;">
                                            <div class="position-absolute left-20 bottom-20"><span class="label label-primary label-rounded">News</span>
                                                <h4 class="text-white  style="color:#fff;"m-t-20 m-b-10">The science<br>behind the dress</h4>
                                                <div><span class="f-s-16"><i class="ti-comment m-r-10 f-s-13"></i>74</span> <span class="p-l-10 p-r-10">|</span> <span class="f-s-16"><i class="ti-heart m-r-10 f-s-13"></i>210</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card" style="background:#5858ea">
                            <div class="card-body text-center">
                                <div class="text-center"><i class="icon ion-ios-paper-outline f-s-75 text-success"></i>
                                    <h4 class="m-b-2">Knowledge Base</h4>
                                    <p class="p-l-30 p-r-30 m-t-15 m-b-30">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</p><a href="#" class="btn btn-sm btn-success btn-block m-t-15">Browse Article</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-xl-12">
                        <div class="card" style="background:#5858ea">
                            <div class="card-body text-center">
                                <div class="active-member">
                                    <div class="table-responsive">
                                        <table class="table table-xs">
                                            <thead>
                                                <tr>
                                                    <th>Top Active Members</th>
                                                    <th>Views</th>
                                                    <th>Country</th>
                                                    <th>Status</th>
                                                    <th>Comments</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="../../assets/images/avatar/1.jpg" class="w-40px rounded-circle m-r-10" alt="">Arden Karn</td>
                                                    <td><span>125</span>
                                                    </td>
                                                    <td>United States</td>
                                                    <td><i class="fa fa-circle-o text-success f-s-12 m-r-10"></i> Active</td>
                                                    <td><span>84</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="../../assets/images/avatar/2.jpg" class="w-40px rounded-circle m-r-10" alt="">Arden Karn</td>
                                                    <td><span>547</span>
                                                    </td>
                                                    <td>Canada</td>
                                                    <td><i class="fa fa-circle-o text-success f-s-12 m-r-10"></i> Active</td>
                                                    <td><span>36</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="../../assets/images/avatar/3.jpg" class="w-40px rounded-circle m-r-10" alt="">Arden Karn</td>
                                                    <td><span>557</span>
                                                    </td>
                                                    <td>Germany</td>
                                                    <td><i class="fa fa-circle-o text-danger f-s-12 m-r-10"></i> Inactive</td>
                                                    <td><span>55</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="../../assets/images/avatar/4.jpg" class="w-40px rounded-circle m-r-10" alt="">Arden Karn</td>
                                                    <td><span>753</span>
                                                    </td>
                                                    <td>England</td>
                                                    <td><i class="fa fa-circle-o text-success f-s-12 m-r-10"></i> Active</td>
                                                    <td><span>45</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="../../assets/images/avatar/5.jpg" class="w-40px rounded-circle m-r-10" alt="">Arden Karn</td>
                                                    <td><span>453</span>
                                                    </td>
                                                    <td>China</td>
                                                    <td><i class="fa fa-circle-o text-danger f-s-12 m-r-10"></i> Inactive</td>
                                                    <td><span>63</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="../../assets/images/avatar/6.jpg" class="w-40px rounded-circle m-r-10" alt="">Arden Karn</td>
                                                    <td><span>658</span>
                                                    </td>
                                                    <td>Japan</td>
                                                    <td><i class="fa fa-circle-o text-success f-s-12 m-r-10"></i> Active</td>
                                                    <td><span>38</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card" style="background:#5858ea">
                            <div class="card-body text-center">
                                <div class="text-center">
                                    <img src="../../assets/images/users/2.jpg" class="rounded-circle m-t-15 w-75px" alt="">
                                    <h4 class="m-t-15 m-b-2">Paul Custard</h4>
                                    <p class="text-muted">Web Developer</p>
                                    <ul class="list-inline m-t-15">
                                        <li class="list-inline-item"><a href="#"><i class="fa fa-facebook-square f-s-20 text-muted"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="#"><i class="fa fa-twitter f-s-20 text-muted"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest f-s-20 text-muted"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="#"><i class="fa fa-linkedin f-s-20 text-muted"></i></a>
                                        </li>
                                    </ul>
                                    <div class="row">
                                        <div class="col-12 border-bottom-1 p-t-20 p-b-10"><span class="pull-left f-w-600">Name:</span> <span class="pull-right">Bob Springer</span>
                                        </div>
                                        <div class="col-12 border-bottom-1 p-t-10 p-b-10"><span class="pull-left f-w-600">Email:</span> <span class="pull-right">example@examplel.com</span>
                                        </div>
                                        <div class="col-12 p-t-10 p-b-10"><span class="pull-left f-w-600">Phone:</span> <span class="pull-right">+12 123 124 125</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card" style="background:#5858ea">
                            <div class="card-body text-center">
                                <h4 class="card-title">Activity Timeline</h4>
                                <div class="timeline-">
                                    <ul class="timeline">
                                        <li>
                                            <div class="timeline-badge primary"></div><a href="#" class="timeline-panel text-muted"><span>10 minutes ago</span><h6 class="m-t-5">Youtube, a video-sharing website, goes live.</h6></a>
                                        </li>
                                        <li>
                                            <div class="timeline-badge warning"></div><a href="#" class="timeline-panel text-muted"><span>20 minutes ago</span><h6 class="m-t-5">Mashable, a news website and blog, goes live.</h6></a>
                                        </li>
                                        <li>
                                            <div class="timeline-badge danger"></div><a href="#" class="timeline-panel text-muted"><span>30 minutes ago</span><h6 class="m-t-5">Google acquires Youtube.</h6></a>
                                        </li>
                                        <li>
                                            <div class="timeline-badge success"></div><a href="#" class="timeline-panel text-muted"><span>15 minutes ago</span><h6 class="m-t-5">StumbleUpon is acquired by eBay.</h6></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="card" style="background:#5858ea">
                            <div class="card-body text-center">
                                <div class="text-center">
                                    <img src="../../assets/images/users/1.jpg" class="rounded-circle m-t-10 w-50px" alt="">
                                    <h6 class="f-w-500 m-t-15">Bob Springer</h6>
                                    <p class="m-b-0 f-s-12">Status: <strong>Online</strong>
                                    </p>
                                    <p class="m-b-0 f-s-12">Response Time: <strong>3 Hours</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card" style="background:#5858ea">
                            <div class="card-body text-center">
                                <div class="text-center">
                                    <img src="../../assets/images/users/2.jpg" class="rounded-circle m-t-10 w-50px" alt="">
                                    <h6 class="f-w-500 m-t-15">Bob Springer</h6>
                                    <p class="m-b-0 f-s-12">Status: <strong>Online</strong>
                                    </p>
                                    <p class="m-b-0 f-s-12">Response Time: <strong>3 Hours</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
@endsection
