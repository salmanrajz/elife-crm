@php
$channel = \App\channel_partner::whereStatus('1')->get();
$r = \App\numberdetail::select('numberdetails.type')->where('status','Available')->groupBy('numberdetails.type')->get();
@endphp
<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">Main</li>
            <li><a href="{{route('admin.dashboard')}}"><i class=" mdi mdi-view-dashboard"></i> <span
                        class="nav-text">Dashboard</span></a>
            </li>
            @role('Saler')
            <li><a href="{{route('saler.entry')}}"><i class=" mdi mdi-view-dashboard"></i> <span
                        class="nav-text">Add Entry</span></a>
            </li>
            <li><a href="{{route('saler.data')}}"><i class=" mdi mdi-view-dashboard"></i> <span
                        class="nav-text">View Entry</span></a>
            </li>
            @endrole
            @if(auth()->user()->role == 'Admin' || auth()->user()->role == 'SuperAdmin')
            <li><a href="{{route('admin.feedback')}}"><i class=" mdi mdi-email"></i> <span class="nav-text">Feedback
                        Data</span></a>
            </li>
            {{--  <div class="col-lg-2">
                        <div class="card" id="verified_div">
                            <div class="card-body text-center">
                            <a href="{{route('elife.index')}}"><h4 class="white" style="color:#fff;">All Elife Plan List</h4></a>
                            </div>
                        </div>
                    </div> --}}
            <li><a href="{{route('elife.index')}}"><i class=" mdi mdi-email"></i> <span class="nav-text">Elife Plan</span></a>
            <li><a href="{{route('agency.index')}}"><i class=" mdi mdi-email"></i> <span class="nav-text">Agency ID</span></a>
            <li><a href="{{route('wallet.index')}}"><i class=" mdi mdi-email"></i> <span class="nav-text">Manager Wallet</span></a>
            <li><a href="{{route('import_elife')}}"><i class=" mdi mdi-email"></i> <span class="nav-text">Import Number Bank</span></a>
            </li>
            @endif
            @inject('HomeCount', 'App\Http\Controllers\HomeController')


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
                    <li><a href="{{route('showCampaignProductDetails',['id'=>'1.18','channel'=>'elifa'])}}">Final
                            Activated
                            Lead <span class="badge badge-warning nav-badge">
                                {{$HomeCount::TotalLeadManagerChannelStatus('elifa','1.18')}}
                            </span></a>
                    </li>
                    <li><a href="{{route('showCampaignProductDetails',['id'=>'1.15','channel'=>'elifa'])}}">Final
                            Rejected
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
            {{-- {{auth()->user()->role}} --}}
            @role('Tele Sale|Team-Leader')
            <li class="nav-label">Sale</li>

            <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                        class="nav-text">Leads</span> <span class="badge badge-warning nav-badge">0</span></a>
                <ul aria-expanded="false">

                    {{-- <li><a href="{{route('partner.show','elifa-elife')}}">New Lead </a> --}}
                    <li><a href="{{route('lead.show','1')}}">New Lead </a>
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
            {{-- <li><a href="{{route('admin.mylead')}}" target="_blank"><i class=" mdi mdi-account"></i> <span
                class="nav-text">My Leads</span></a>
            </li> --}}
            <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                        class="nav-text">Call Log</span> </a>
                <ul aria-expanded="false">

                    <li><a href="{{route('elife-log.create')}}">Add Call Log</a>
                    </li>
                    <li><a href="{{route('my.log')}}" style="color:#000">View Call Log</a>
                    </li>

                </ul>
            </li>
            <li><a href="{{route('elife.log.NoAnswer')}}" target="_blank"><i class=" mdi mdi-view-dashboard"></i>
                    <span class="nav-text">Elife Data</span></a>
            </li>

            @endrole
            @role('DirectSale')
            <li class="nav-label">Sale</li>

            <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                        class="nav-text">Leads</span> <span class="badge badge-warning nav-badge">0</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{route('lead.show','1')}}">New Lead </a>
                        {{-- <li><a href="{{route('partner.show','elifa-elife')}}">New Lead </a> --}}
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
            @endrole
            @role('Team-Leader')
            <li class="nav-label">Team Lead</li>


            <li><a href="{{route('myteam')}}" target="_blank"><i class=" mdi mdi-account"></i> <span
                    class="nav-text">My Team</span></a></li>
            @endrole

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
            @role('Verification')
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
            @role('Coordination')
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
        @endrole
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
                    <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span class="nav-text">Reports</span> <span class="badge badge-warning nav-badge">0</span></a>
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

        <li class="nav-label">Device</li>
        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                    class="nav-text">Device</span> <span class="badge badge-warning nav-badge">0</span></a>
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
                    class="nav-text">Emirate</span> <span class="badge badge-warning nav-badge">0</span></a>
            <ul aria-expanded="false">

                <li><a href="{{route('emirate.create')}}">Add Emirate</a>
                </li>
                <li><a href="{{route('emirate.index')}}">All Emirate</a>
                </li>
                {{-- <li><a href="{{url('admin/leads/follow')}}">Total Follow Up Lead</a> --}}
        </li>
        </ul>
        </li>


        <li class="nav-label">Channel Partner</li>
        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                    class="nav-text">Channel Partner</span> <span class="badge badge-warning nav-badge">0</span></a>
            <ul aria-expanded="false">

                <li><a href="{{route('partner.create')}}">Add Channel Partner</a>
                </li>
                <li><a href="{{route('partner.index')}}">All Channel Partner</a>
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
        <li class="nav-label">Elife Plan</li>
        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                    class="nav-text">Plan</span> <span class="badge badge-warning nav-badge">0</span></a>
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
                    class="nav-text">Plan</span> <span class="badge badge-warning nav-badge">0</span></a>
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
                    class="nav-text">Users</span> <span class="badge badge-warning nav-badge">0</span></a>
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
                    class="nav-text">Call Center</span> <span class="badge badge-warning nav-badge">0</span></a>
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
        @role('General-Manager')
                <li class="nav-label">Call Log</li>

        <li><a href="{{route('import_elife')}}" target="_blank"><i class=" mdi mdi-account"></i> <span
                    class="nav-text">Data Uploader</span></a>
        <li><a href="{{route('elife.log')}}" target="_blank"><i class=" mdi mdi-account"></i> <span
                    class="nav-text">View Log </span></a>
        <li><a href="{{route('elife.log.user')}}" target="_blank"><i class=" mdi mdi-account"></i> <span
                    class="nav-text">Summary </span></a>
        </li>
        @endrole

        @role('Manager|General-Manager')
        @php
        $user = auth()->user();
        $permission = $user->getAllPermissions();
        @endphp
        @foreach ($permission as $channel)
        @can($channel->name)
        <li class="nav-label">{{$channel->name}}</li>
        @php
        $pawry = str_replace(' ', '-', $channel->name);
        @endphp
        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                    class="nav-text">Leads</span> <span class="badge badge-warning nav-badge">0</span></a>
            <ul aria-expanded="false">
                <li><a href="{{route('showCampaignProductDetails',['id'=>'1.01','channel'=>$pawry])}}">Pending</a>
                </li>
                <li><a href="{{route('showCampaignProductDetails',['id'=>'1.10','channel'=>$pawry])}}">In
                        Process</a>
                </li>
                <li><a href="{{route('showCampaignProductDetails',['id'=>'1.02','channel'=>$pawry])}}">Active</a>
                </li>
                <li><a href="{{route('showCampaignProductDetails',['id'=>'1.04','channel'=>$pawry])}}">Reject</a>
                </li>
                <li><a href="{{route('showCampaignProductDetails',['id'=>'1.00','channel'=>$pawry])}}">All
                        Leads</a>
                </li>
                {{-- <li><a href="{{url('admin/leads/follow')}}">Total Follow Up Lead</a> --}}
        </li>
        </ul>
        </li>
        @endcan
        @endforeach
        @can('Billing Kiosk')

        @role('Manager')
        <li><a href="{{route('BillingType.index')}}"><i class=" mdi mdi-view-dashboard"></i> <span
                        class="nav-text">Billing Type</span></a>
            </li>
        <li><a href="{{route('MyWallet')}}"><i class=" mdi mdi-view-dashboard"></i> <span
                        class="nav-text">My Wallet</span></a>
            </li>
        @endrole
        @endcan
        @can('Elife Telesales')
        @role('Manager')
        <li class="nav-label">Users</li>
        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                    class="nav-text">Users</span> <span class="badge badge-warning nav-badge">0</span></a>
            <ul aria-expanded="false">

                <li><a href="{{route('user.create')}}">Add Users</a>
                </li>
                <li><a href="{{route('my.agent')}}">All Users</a>
                </li>
                {{-- <li><a href="{{url('admin/leads/follow')}}">Total Follow Up Lead</a> --}}
        </li>

        </ul>
        </li>

        <li><a href="{{route('elife.index')}}"><i class=" mdi mdi-view-dashboard"></i> <span
                        class="nav-text">ELife Plan</span></a>
            </li>
        <li><a href="{{route('plan.index')}}"><i class=" mdi mdi-view-dashboard"></i> <span
                        class="nav-text">Postpaid Plan</span></a>
            </li>
        @endrole
        @endcan
        @endrole
        @can('Elife Telesales')
        @role('Manager')
        <li class="nav-label">Call Log</li>

        <li><a href="{{route('assign.number.bank')}}" target="_blank"><i class=" mdi mdi-account"></i> <span
                    class="nav-text">Data Uploader</span></a>
        <li><a href="{{route('elife.log')}}" target="_blank"><i class=" mdi mdi-account"></i> <span
                    class="nav-text">View Log </span></a>
        <li><a href="{{route('elife.log.user')}}" target="_blank"><i class=" mdi mdi-account"></i> <span
                    class="nav-text">Summary </span></a>
        </li>
        @endrole
        @endcan
        @role('Runner')
        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i> <span
                    class="nav-text">Leads</span> <span class="badge badge-warning nav-badge">0</span></a>
            <ul aria-expanded="false">

                <li><a href="{{route('showCampaignProductDetails',['id'=>'1.10','channel'=>'Elife-Telesales'])}}">In
                        Process</a>
                </li>
                <li><a href="{{route('showCampaignProductDetails',['id'=>'1.02','channel'=>'Elife-Telesales'])}}">Active</a>
                </li>
                <li><a href="{{route('showCampaignProductDetails',['id'=>'1.04','channel'=>'Elife-Telesales'])}}">Reject</a>
                </li>
                {{-- <li><a href="{{url('admin/leads/follow')}}">Total Follow Up Lead</a> --}}
        </li>
        </ul>
        </li>
        @endrole
        {{-- <li><a href="widget-basic-card.html"><i class="mdi mdi-widgets"></i> <span class="nav-text">Widget</span></a>
                    </li> --}}



        </ul>
    </div>
    <!-- #/ nk nav scroll -->
</div>
