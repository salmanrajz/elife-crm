<h4 class="card-title">Reporting</h4>
<div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>S#</th>
                                                <th>Lead No</th>
                                                <th>Customer Name</th>
                                                <th>Plan Name</th>
                                                <th>Product Type</th>
                                                <th>C.M. No</th>
                                                <th>Lead Generate Time</th>
                                                <th>Status</th>
                                                <th>SR #</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($operation as $key => $item)

                                            <tr>
                                                <td>{{$key}}</td>
                                                <td>{{$item->lead_no}}</td>
                                                <td>{{$item->customer_name}}</td>
                                                <td>
                                                @if ($item->lead_type != 'ITProducts')
                                                    @if ($item->sim_type == 'Elife')
                                                    @php( $plan = \App\elife_plan::whereId($item->select_plan)->first())
                                                    {{$plan->plan_name}}
                                                    @else
                                                    @php( $plan = \App\plan::whereId($item->select_plan)->first())
                                                    {{$plan->plan_name}}
                                                    @endif
                                                @else
                                                    @php( $plan = \App\itproductplans::whereId($item->select_plan)->first())
                                                    {{$plan->name}}
                                                @endif
                                                </td>
                                                <td>
                                                    @if ($item->sim_type == 'Elife' || $item->sim_type == 'New' || $item->sim_type == 'MNP')
                                                    {{$item->sim_type}}
                                                    @else
                                                    @php( $st = \App\it_products::whereId($item->sim_type)->first())
                                                    {{$st->name}}
                                                    @endif
                                                </td>
                                                <td>{{$item->customer_number}}</td>
                                                <td>{{$item->lead_generate_time}}</td>
                                                <td>{{$item->status_name}}</td>
                                                <td>
                                                    @if ($item->status == '1.02')
                                                     @php( $sr = \App\activation_form::whereLeadId($item->id)->first())
                                                        {{$sr->activation_sr_no}}
                                                    @else
                                                        Not Active yet
                                                         <a href="{{route('view.lead',$item->id)}}">
                                                        View remarks
                                                    </a>
                                                    @endif
                                                </td>

                                            </tr>
                                            @endforeach

                                        </tbody>

                                    </table>
                                </div>
<script src="{{asset('assets/plugins/tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/tables/js/datatable-init/datatable-basic.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-mask/jasny-bootstrap.min.js')}}"></script>
