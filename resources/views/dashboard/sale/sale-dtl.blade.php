<div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>S#</th>
                                                <th>Lead No</th>
                                                <th>Customer Name</th>
                                                <th>Plan Name</th>
                                                <th>Sim Type</th>
                                                <th>C.M. No</th>
                                                {{-- <th>Lead Generate Time</th> --}}
                                                <th>Status</th>
                                                <th>Remarks</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($operation as $key => $item)

                                            <tr>
                                                <td>{{$key}}</td>
                                                <td>{{$item->lead_no}}</td>
                                                <td>{{$item->customer_name}}</td>
                                                <td>{{$item->select_plan}}</td>
                                                <td>{{$item->sim_type}}</td>
                                                <td>{{$item->customer_number}}</td>
                                                {{-- <td>{{$item->lead_generate_time}}</td> --}}
                                                <td>{{$item->status_name}}</td>
                                                <td>{{$item->remarks}}</td>
                                                <td>
                                                @if($item->status == '1.03')
                                                <a href="{{route('lead.edit',$item->id)}}">
                                                <i class="fa fa-edit"></i>
                                                </a>
                                                @endif
                                                {{-- <td> --}}
                                                    <a href="{{route('view.lead',$item->id)}}">
                                                        View remarks
                                                    </a>
                                                {{-- </td> --}}
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>

                                    </table>
                                </div>
