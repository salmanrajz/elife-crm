@php
$channel = \App\channel_partner::whereStatus('1')->get();
$r = \Anumberdetail::select('numberdetails.type')->where('status','Available')->groupBy('numberdetails.type')->get();
@endphp
<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">Main</li>
            <li><a href="{{route('admin.dashboard')}}"><i class=" mdi mdi-view-dashboard"></i> <span
                        class="nav-text">Dashboard</span></a>
            </li>
            @if(auth()->user()->role == 'Admin' || auth()->user()->role == 'SuperAdmin')
            <li><a href="{{route('admin.feedback')}}"><i class=" mdi mdi-email"></i> <span class="nav-text">Feedback
                        Data</span></a>
            </li>
            @endif
            @inject('HomeCount', 'App\Http\Controllers\HomeController')
            @role('NumberController')
            <li class="nav-label">All Number</li>
            @foreach ($r as $item)

            <li><a href="{{route('number-all-cleaner',$item->type)}}" target="_blank"><i class=" mdi mdi-view-dashboard"></i> <span
                class="nav-text">{{$item->type}}</span></a>
            @endforeach
            </li>
            @endrole
            @role('DataEntry')
            <li class="nav-label">Data Entry</li>

            <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                        class="nav-text">Data Entry</span> </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('old-data.create')}}">Add</a>

                </ul>
            </li>
            @endrole
            @role('Manager|NumberSuperAdmin')
            {{-- lorem --}}
            <li class="nav-label">Lead Reports</li>

            {{-- <li><a href="{{route('number-system.index')}}" target="_blank"><i class=" mdi mdi-view-dashboard"></i>
            <span class="nav-text">Number System</span></a> --}}
            @foreach ($channel as $item)
            <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                        class="nav-text">{{$item->name}} Leads</span> <span class="badge badge-warning nav-badge">
                        {{$HomeCount::TotalLeadManagerChannel($item->name)}}
                    </span></a>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.mygrouplead',$item->name)}}">All {{$item->name}} Lead <span
                                class="badge badge-warning nav-badge">
                                {{$HomeCount::TotalLeadManagerChannel($item->name)}}
                            </span></a>
                    </li>
                    <li><a href="{{route('showCampaignProductDetails',['id'=>'1.01','channel'=>$item->name])}}">Pending
                            Lead <span class="badge badge-warning nav-badge">
                                {{$HomeCount::TotalLeadManagerChannelStatus($item->name,'1.01')}}
                            </span></a>
                    </li>
                    <li><a href="{{route('showCampaignProductDetails',['id'=>'1.03','channel'=>$item->name])}}">Follow
                            Lead <span class="badge badge-warning nav-badge">
                                {{$HomeCount::TotalLeadManagerChannelStatus($item->name,'1.03')}}
                            </span></a>
                    </li>
                    <li><a href="{{route('showCampaignProductDetails',['id'=>'1.02','channel'=>$item->name])}}">Activated
                            Lead <span class="badge badge-warning nav-badge">
                                {{$HomeCount::TotalLeadManagerChannelStatus($item->name,'1.02')}}
                            </span></a>
                    </li>
                    <li><a href="{{route('showCampaignProductDetails',['id'=>'reject','channel'=>$item->name])}}">Rejected
                            Lead <span class="badge badge-warning nav-badge">
                                {{$HomeCount::TotalLeadManagerChannelStatusVerified($item->name,'rejected')}}
                            </span></a>
                    </li>
                    <li><a href="{{route('showCampaignProductDetails',['id'=>'verified','channel'=>$item->name])}}">Verified
                            Lead <span class="badge badge-warning nav-badge">
                                {{$HomeCount::TotalLeadManagerChannelStatusVerified($item->name,'verified')}}
                            </span></a>
                    </li>
                </ul>
            </li>
            <li><a href="{{route('number-system-ttf',$item->name)}}" target="_blank"><i
                        class=" mdi mdi-view-dashboard"></i> <span class="nav-text">{{$item->name}} Numbers</span></a>
            </li>
            @endforeach
            {{-- <li><a href="{{route('number-system-ttf','ttf')}}" target="_blank"><i
                class=" mdi mdi-view-dashboard"></i> <span class="nav-text">TTF Numbers</span></a>
            </li> --}}

            @endrole
            @role('Elife Manager')
            {{-- lorem --}}
            <li class="nav-label">Lead Reports</li>

            {{-- <li><a href="{{route('number-system.index')}}" target="_blank"><i class=" mdi mdi-view-dashboard"></i>
            <span class="nav-text">Number System</span></a> --}}
            <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                        class="nav-text">Elife Leads</span> <span class="badge badge-warning nav-badge">
                        {{$HomeCount::TotalLeadManagerChannel('elifa')}}
                    </span></a>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.mygrouplead','Elife')}}">All Elife Lead <span
                                class="badge badge-warning nav-badge">
                                {{$HomeCount::TotalLeadManagerChannel('elifa')}}
                            </span></a>
                    </li>
                    <li><a href="{{route('showCampaignProductDetails',['id'=>'1.01','channel'=>'elifa'])}}">Pending
                            Lead <span class="badge badge-warning nav-badge">
                                {{$HomeCount::TotalLeadManagerChannelStatus('elifa','1.01')}}
                            </span></a>
                    </li>
                    <li><a href="{{route('showCampaignProductDetails',['id'=>'1.03','channel'=>'elifa'])}}">Follow
                            Lead <span class="badge badge-warning nav-badge">
                                {{$HomeCount::TotalLeadManagerChannelStatus('elifa','1.03')}}
                            </span></a>
                    </li>
                    <li><a href="{{route('showCampaignProductDetails',['id'=>'1.02','channel'=>'elifa'])}}">Activated
                            Lead <span class="badge badge-warning nav-badge">
                                {{$HomeCount::TotalLeadManagerChannelStatus('elifa','1.02')}}
                            </span></a>
                    </li>
                    <li><a href="{{route('showCampaignProductDetails',['id'=>'1.18','channel'=>'elifa'])}}">Final Activated
                            Lead <span class="badge badge-warning nav-badge">
                                {{$HomeCount::TotalLeadManagerChannelStatus('elifa','1.18')}}
                            </span></a>
                    </li>
                    <li><a href="{{route('showCampaignProductDetails',['id'=>'1.15','channel'=>'elifa'])}}">Final Rejected
                            Lead <span class="badge badge-warning nav-badge">
                                {{$HomeCount::TotalLeadManagerChannelStatus('elifa','1.15')}}
                            </span></a>
                    </li>
                    <li><a href="{{route('showCampaignProductDetails',['id'=>'reject','channel'=>'elifa'])}}">Rejected
                            Lead <span class="badge badge-warning nav-badge">
                                {{$HomeCount::TotalLeadManagerChannelStatusVerified('elifa','rejected')}}
                            </span></a>
                    </li>
                    <li><a href="{{route('showCampaignProductDetails',['id'=>'verified','channel'=>'elifa'])}}">Verified
                            Lead <span class="badge badge-warning nav-badge">
                                {{$HomeCount::TotalLeadManagerChannelStatusVerified('elifa','verified')}}
                            </span></a>
                    </li>
                </ul>
            </li>
            {{-- <li><a href="{{route('number-system-ttf',$item->name)}}" target="_blank"><i
                        class=" mdi mdi-view-dashboard"></i> <span class="nav-text">{{$item->name}} Numbers</span></a>
            </li> --}}
            {{-- <li><a href="{{route('number-system-ttf','ttf')}}" target="_blank"><i
                class=" mdi mdi-view-dashboard"></i> <span class="nav-text">TTF Numbers</span></a>
            </li> --}}

            @endrole


            {{-- <li><a href="calender-event.html"><i class="mdi mdi-calendar-check"></i> <span class="nav-text">Calendar</span></a></li> --}}
            @role('sale|NumberAdmin')
            <li class="nav-label">Sale</li>

            <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                        class="nav-text">Leads</span> <span class="badge badge-warning nav-badge">0</span></a>
                <ul aria-expanded="false">

                    <li><a href="{{route('lead.show',1)}}">New Lead </a>
                    </li>
                    <li><a href="{{route('lead.index')}}">In Process Lead <span
                                class="badge badge-warning nav-badge">0</span></a>
                    </li>
                    <li><a href="{{url('admin/leads/rejected')}}">Rejected Lead <span
                                class="badge badge-warning nav-badge">0</span></a>
                    </li>

                    <li><a href="{{url('admin/leads/active')}}">Activated Lead <span
                                class="badge badge-warning nav-badge">0</span></a>
                    </li>
                </ul>
            </li>
            <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-email"></i> <span
                        class="nav-text">Follow</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{url('admin/leads/follow')}}">In Process Follow <span
                                class="badge badge-warning nav-badge">0</span></a>
                        {{-- <li><a href="{{url('admin/leads/rejected')}}">Rejected Follow <span
                            class="badge badge-warning nav-badge">0</span></a> --}}

                </ul>
            </li>
            <li><a href="{{route('admin.mylead')}}" target="_blank"><i class=" mdi mdi-account"></i> <span
                        class="nav-text">My Leads</span></a>
            </li>
            @endrole
            @can('manage postpaid')

            @foreach ($channel as $item)
            <li><a href="{{route('number-system-ttf',$item->name)}}" target="_blank"><i
                        class=" mdi mdi-view-dashboard"></i> <span class="nav-text">{{$item->name}} Numbers</span></a>
            </li>
            @endforeach
            @endcan
            @can('manage elife')
            <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                        class="nav-text">Call Log</span> </a>
                <ul aria-expanded="false">

                    <li><a href="{{route('elife-log.create')}}">Add Call Log</a>
                    </li>
                    <li><a href="{{route('my.log')}}" style="color:#000">View Call Log</a>
                    </li>
                    {{-- <li><a href="{{route('call-log-mnp.create')}}">Add MNP</a>
            </li> --}}
            {{-- <li><a href="{{route('call-log-mnp.create')}}">Add P2P</a>
            </li> --}}
            {{-- <li><a href="{{route('call-log-mnp.index')}}" style="color:#000">View P2P</a>
            </li> --}}
        </ul>
        </li>
        <li><a href="{{route('elife.log.NoAnswer')}}" target="_blank"><i class=" mdi mdi-view-dashboard"></i>
                <span class="nav-text">Elife No Numbers</span></a>
        </li>
        {{-- Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat iure distinctio tempora quae aliquam sequi placeat deserunt, quis laborum numquam corrupti rem impedit reprehenderit. Aliquam voluptatum nostrum ut autem sunt! --}}
        {{-- @foreach ($channel as $item)
                    <li><a href="{{route('number-system-ttf',$item->name)}}" target="_blank"><i
            class=" mdi mdi-view-dashboard"></i> <span class="nav-text">{{$item->name}} Numbers</span></a>
        </li>
        @endforeach --}}

        @endcan
        @can('verify lead')

        <li class="nav-label">Verification</li>

        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                    class="nav-text">Leads</span> <span class="badge badge-warning nav-badge">0</span></a>
            <ul aria-expanded="false">
                <li><a href="{{route('verification.index')}}">Total Pending Lead</a>
                </li>
                <li><a href="{{route('admin.verify')}}">Total Verified Lead</a>
                </li>
                <li><a href="{{route('admin.later')}}">Total Later Lead</a>
                </li>
                <li><a href="{{route('admin.reject')}}">Total Reject Lead</a>
                </li>
                <li><a href="{{url('admin/leads/reverify')}}">Total Re Verify Lead</a>
                </li>
            </ul>
        </li>

        @endcan
        @role('elif-Verification')
        <li class="nav-label">Verification</li>

        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                    class="nav-text">Leads</span> <span class="badge badge-warning nav-badge">0</span></a>
            <ul aria-expanded="false">
                <li><a href="{{route('verification.index')}}">Total Pending Lead</a>
                </li>
                <li><a href="{{route('admin.verify')}}">Total Verified Lead</a>
                </li>
                <li><a href="{{route('admin.later')}}">Total Later Lead</a>
                </li>
                <li><a href="{{route('admin.reject')}}">Total Reject Lead</a>
                </li>
                <li><a href="{{url('admin/leads/reverify')}}">Total Re Verify Lead</a>
                </li>
            </ul>
        </li>
        @endrole
        @can('cordination leads')
        <li class="nav-label">Coordination</li>
        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                    class="nav-text">Coordination</span> <span class="badge badge-warning nav-badge">0</span></a>
            <ul aria-expanded="false">

                <li><a href="{{route('all.pending','AllCord')}}">All Leads</a>
                </li>
                <li><a href="{{route('verification.final-cord-lead')}}">Total Pending</a>
                </li>
                <li><a href="{{route('all.pending','CordFollow')}}">Follow Pending</a>
                </li>
                <li><a href="{{route('activation.proceed')}}">Processed Leads</a>
                </li>
                {{-- <li><a href="{{url('admin/leads/follow')}}">Total Follow Up Lead</a> --}}
        </li>
        </ul>
        </li>
        <li class="nav-label">Call Log</li>

        <li><a href="{{route('import_elife')}}" target="_blank"><i class=" mdi mdi-account"></i> <span
                    class="nav-text">Data Uploader</span></a>
        <li><a href="{{route('elife.log')}}" target="_blank"><i class=" mdi mdi-account"></i> <span
                    class="nav-text">View Log </span></a>
        <li><a href="{{route('elife.log.user')}}" target="_blank"><i class=" mdi mdi-account"></i> <span
                    class="nav-text">Summary </span></a>
        </li>
        @endcan
        @can('activate lead')
        <li class="nav-label">Activation</li>
        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                    class="nav-text">Activation</span> <span class="badge badge-warning nav-badge">0</span></a>
            <ul aria-expanded="false">

                <li><a href="{{route('all.pending','AllActive')}}">All Request</a>
                </li>
                <li><a href="{{route('activation.index')}}">Pending Request</a>
                </li>
                <li><a href="{{route('all.pending','CordActive')}}">Follow Request</a>
                </li>
                <li><a href="{{route('myactive')}}">Total Actived Request</a>
                </li>
                {{-- <li><a href="{{url('admin/leads/follow')}}">Total Follow Up Lead</a> --}}
        </li>
        </ul>
        </li>
        @endcan
        @role('Elife Active')
        <li class="nav-label">Activation</li>
        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                    class="nav-text">Activation</span> <span class="badge badge-warning nav-badge">0</span></a>
            <ul aria-expanded="false">

                <li><a href="{{route('all.pending','AllActive')}}">All Request</a>
                </li>
                <li><a href="{{route('activation.index')}}">Pending Request</a>
                </li>
                <li><a href="{{route('all.pending','CordActive')}}">Follow Request</a>
                </li>
                <li><a href="{{route('myactive')}}">Total Actived Request</a>
                </li>
                {{-- <li><a href="{{url('admin/leads/follow')}}">Total Follow Up Lead</a> --}}
        </li>
        </ul>
        </li>
        @endrole
        {{-- @can('manage reporting')
                    <li class="nav-label">Reports</li>
                    <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span class="nav-text">Reports</span> <span class="badge badge-warning nav-badge">14</span></a>
                        <ul aria-expanded="false">

                            <li><a href="{{route('postpaid.reporting')}}">Postpaid Reports</a>
        </li>
        <li><a href="{{route('elife.reporting')}}">Elife Reports</a>
        </li>
        <li><a href="{{route('it.reporting')}}">IT Products Reports</a>
        </li>
        </li>
        </ul>
        </li>
        @endcan --}}
        @can('manage users')
        <li class="nav-label">Number System</li>
        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                    class="nav-text">Number System</span> <span class="badge badge-warning nav-badge">14</span></a>
            <ul aria-expanded="false">

                <li><a href="{{route('number-zone.index')}}">All Reserved Number</a>
                </li>
                <li><a href="{{route('active-number')}}">All Active Number</a>
                </li>
                <li><a href="{{route('number-all')}}">All Number List</a>
                </li>
                <li><a href="{{route('user-number-all')}}">All User List</a>
                </li>
                {{-- <li><a href="{{url('admin/leads/follow')}}">Total Follow Up Lead</a> --}}
        </li>
        </ul>
        </li>
        <li class="nav-label">Device</li>
        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                    class="nav-text">Device</span> <span class="badge badge-warning nav-badge">14</span></a>
            <ul aria-expanded="false">

                <li><a href="{{route('imei.create')}}">Add Device (IMEI)</a>
                </li>
                <li><a href="{{route('imei.index')}}">All Device (IMEI)</a>
                </li>
                {{-- <li><a href="{{url('admin/leads/follow')}}">Total Follow Up Lead</a> --}}
        </li>
        </ul>
        </li>

        <li class="nav-label">Emirate</li>
        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                    class="nav-text">Emirate</span> <span class="badge badge-warning nav-badge">14</span></a>
            <ul aria-expanded="false">

                <li><a href="{{route('emirate.create')}}">Add Emirate</a>
                </li>
                <li><a href="{{route('emirate.index')}}">All Emirate</a>
                </li>
                {{-- <li><a href="{{url('admin/leads/follow')}}">Total Follow Up Lead</a> --}}
        </li>
        </ul>
        </li>
        <li class="nav-label">IT Products</li>
        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                    class="nav-text">IT Products</span> <span class="badge badge-warning nav-badge">14</span></a>
            <ul aria-expanded="false">

                <li><a href="{{route('IT-product.create')}}">Add IT Products</a>
                </li>
                <li><a href="{{route('IT-product.index')}}">All IT Products</a>
                </li>
                {{-- <li><a href="{{url('admin/leads/follow')}}">Total Follow Up Lead</a> --}}
        </li>
        </ul>
        </li>
        <li class="nav-label">IT Products Plans</li>
        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                    class="nav-text">IT Products Plans</span> <span class="badge badge-warning nav-badge">14</span></a>
            <ul aria-expanded="false">

                <li><a href="{{route('IT-Plan.create')}}">Add IT Products Plan</a>
                </li>
                <li><a href="{{route('IT-Plan.index')}}">All IT Products Plan</a>
                </li>
                {{-- <li><a href="{{url('admin/leads/follow')}}">Total Follow Up Lead</a> --}}
        </li>
        </ul>
        </li>
        <li class="nav-label">Plan</li>
        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                    class="nav-text">Plan</span> <span class="badge badge-warning nav-badge">14</span></a>
            <ul aria-expanded="false">

                <li><a href="{{route('plan.create')}}">Add Plan</a>
                </li>
                <li><a href="{{route('plan.index')}}">All Plan</a>
                </li>
                {{-- <li><a href="{{url('admin/leads/follow')}}">Total Follow Up Lead</a> --}}
        </li>
        </ul>
        </li>
        <li class="nav-label">Channel Partner</li>
        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                    class="nav-text">Channel Partner</span> <span class="badge badge-warning nav-badge">14</span></a>
            <ul aria-expanded="false">

                <li><a href="{{route('partner.create')}}">Add Channel Partner</a>
                </li>
                <li><a href="{{route('partner.index')}}">All Channel Partner</a>
                </li>
                {{-- <li><a href="{{url('admin/leads/follow')}}">Total Follow Up Lead</a> --}}
        </li>
        </ul>
        </li>
        <li class="nav-label">Elife Plan</li>
        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                    class="nav-text">Plan</span> <span class="badge badge-warning nav-badge">14</span></a>
            <ul aria-expanded="false">

                <li><a href="{{route('elife.create')}}">Add Elife Plan</a>
                </li>
                <li><a href="{{route('elife.index')}}">All Elife Plan</a>
                </li>
                {{-- <li><a href="{{url('admin/leads/follow')}}">Total Follow Up Lead</a> --}}
        </li>
        </ul>
        </li>
        <li class="nav-label">Elife Addon</li>
        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                    class="nav-text">Plan</span> <span class="badge badge-warning nav-badge">14</span></a>
            <ul aria-expanded="false">

                <li><a href="{{route('elife-addon.create')}}">Add Elife Plan</a>
                </li>
                <li><a href="{{route('elife-addon.index')}}">All Elife Plan</a>
                </li>
                {{-- <li><a href="{{url('admin/leads/follow')}}">Total Follow Up Lead</a> --}}
        </li>
        </ul>
        </li>
        <li class="nav-label">Users</li>
        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                    class="nav-text">Users</span> <span class="badge badge-warning nav-badge">14</span></a>
            <ul aria-expanded="false">

                <li><a href="{{route('user.create')}}">Add Users</a>
                </li>
                <li><a href="{{route('user-index')}}">All Users</a>
                </li>
                {{-- <li><a href="{{url('admin/leads/follow')}}">Total Follow Up Lead</a> --}}
        </li>
        </ul>
        </li>
        @endcan
        @can('manage callgroups')
        <li class="nav-label">Call Center</li>
        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                    class="nav-text">Call Center</span> <span class="badge badge-warning nav-badge">14</span></a>
            <ul aria-expanded="false">

                <li><a href="{{route('call-center.create')}}">Add Call Center</a>
                </li>
                <li><a href="{{route('call-center.index')}}">All Call Center</a>
                </li>
                {{-- <li><a href="{{url('admin/leads/follow')}}">Total Follow Up Lead</a> --}}
        </li>
        </ul>
        </li>
        @endcan
        {{-- <li><a href="widget-basic-card.html"><i class="mdi mdi-widgets"></i> <span class="nav-text">Widget</span></a>
                    </li> --}}



        </ul>
    </div>
    <!-- #/ nk nav scroll -->
</div>
