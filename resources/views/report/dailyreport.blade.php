@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <h3 class="text-left display-6">{{$channel->name}}</h3> --}}
</div>
<div class="container">
    <div class="row">
        <div class="md-offset-4">
            <div class="table-responsive">
                @foreach ($channel_partner as $channel)

                <table class=" table-bordered text-center" style="font-weight:400;">
                    @inject('provider', 'App\Http\Controllers\ReportController')
                    <thead>
                        <tr>
                            <th colspan="13" style="background:#FFC107">
                                <h3>
                                    Today Summary >>
                                    {{$day = \Carbon\Carbon::parse($date = \Carbon\Carbon::today())->format('l')}},
                                    {{$day = \Carbon\Carbon::parse($date = \Carbon\Carbon::today())->format('M, d, Y')}}
                                </h3>
                            </th>
                        </tr>
                        <tr style="background:black;color:#fff">
                            <th>S#</th>
                            <th>Name of Call Center</th>
                            <th>Paid</th>
                            {{-- <th>Agents</th> --}}
                            <th>All Leads</th>
                            <th>Verified
                                {{-- (1.03,1.05,1.07,1.08,1.09,1.10,1.02) --}}
                            </th>
                            <th>Non Verified
                                {{-- (1.01) --}}
                            </th>
                            <th>In Process
                                {{-- (1.03,1.05,1.07,1.08,1.09,1.10) --}}
                            </th>
                            <th>Activated
                                {{-- (1.02) --}}
                            </th>
                            <th>Rejected
                                {{-- (1.04) --}}
                            </th>
                            <th>Follow Up
                                {{-- (1.03) --}}
                            </th>
                            <th>Carry Forward</th>
                            <th>Point</th>
                            <th>Average</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($callcenter as $k => $cc)
                        {{-- {{$k == 1}} --}}
                        {{-- {{$i == 0}} --}}

                        <tr style="background:#6363d2;color:#fff">
                            <td>
                                {{++$k}}
                            </td>
                            {{-- <td>
                             {{$provider::NumberOfAgent($cc->call_center_code)}}
                            </td> --}}
                            <td>
                                {{$cc->call_center_name}}
                            </td>
                            <td>
                                {{$provider::TotalPaidCallAgent($cc->call_center_code,'postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::AllLeadsCallCenterToday($cc->call_center_code,'postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterLeadtypeDate($cc->call_center_code,'verified','postpaid',$channel->name)}}
                                {{-- {{$provider::CalCenterLeadtype($cc->call_center_code,'1.03,1.05,1.07,1.08,1.09,1.10','postpaid',$channel->name)}}
                                --}}
                            </td>
                            <td>
                                {{$provider::CalCenterLeadtypeDate($cc->call_center_code,'nonverified','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterLeadtypeDate($cc->call_center_code,'inprocess','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$a = $provider::CalCenterLeadtypeDate($cc->call_center_code,'1.02','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterLeadtypeDate($cc->call_center_code,'rejected','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterLeadtypeDate($cc->call_center_code,'followup','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{-- plan_sum --}}
                                {{-- 0 --}}
                                {{-- carry_forward --}}
                                {{$provider::carry_forward($cc->call_center_code,'postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::plan_sum($cc->call_center_code,'followup','postpaid',$channel->name)}}
                            </td>
                            <td>
                                @if($a != 0)
                                {{$k = number_format($provider::plan_sum($cc->call_center_code,'followup','postpaid',$channel->name) / $a,2)}}
                                @else
                                0
                                @endif
                            </td>

                        </tr>
                        @endforeach
                        <tr style="background:ffeb3b85;color:#000;font-weight:bold;border:none">
                            <td colspan="2" style="border:none;">
                                {{$channel->name}}
                            </td>
                            <td>
                                {{$provider::TotalPaid($cc->call_center_code,'postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::AllLeadsToday($cc->call_center_code,'postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterToday($cc->call_center_code,'verified','postpaid',$channel->name)}}
                                {{-- {{$provider::CalCenterLeadtype($cc->call_center_code,'1.03,1.05,1.07,1.08,1.09,1.10','postpaid',$channel->name)}}
                                --}}
                            </td>
                            <td>
                                {{$provider::CalCenterToday($cc->call_center_code,'nonverified','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterToday($cc->call_center_code,'inprocess','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterToday($cc->call_center_code,'1.02','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterToday($cc->call_center_code,'rejected','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterToday($cc->call_center_code,'followup','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{-- plan_sum --}}
                                0
                            </td>
                            <td>
                                {{$provider::plan_sum($cc->call_center_code,'followup','postpaid',$channel->name)}}
                            </td>
                            <td>
                                @if($a != 0)
                                {{$k = number_format($provider::plan_sum($cc->call_center_code,'followup','postpaid',$channel->name) / $a,2)}}
                                @else
                                0
                                @endif
                            </td>
                        </tr>


                    </tbody>
                </table>



                @endforeach
                @foreach ($channel_partner as $channel)

                {{--  --}}
                <table class=" table-bordered text-center" style="font-weight:400;">
                    @inject('provider', 'App\Http\Controllers\ReportController')
                    <thead>
                        <tr>
                            <th colspan="13" style="background:#FFC107">
                                <h3>
                                    {{$day = \Carbon\Carbon::parse($date = \Carbon\Carbon::today())->format('M, Y')}},
                                    Till
                                    {{$day = \Carbon\Carbon::parse($date = \Carbon\Carbon::today())->format('M, d, Y')}}
                                </h3>
                            </th>
                        </tr>
                        <tr style="background:black;color:#fff">
                            <th>S#</th>
                            {{-- <th>Agents</th> --}}
                            <th>Name of Call Center</th>
                            <th>All Leads</th>
                            <th>Paid</th>
                            <th>Verified
                                {{-- (1.03,1.05,1.07,1.08,1.09,1.10,1.02) --}}
                            </th>
                            <th>Non Verified
                                {{-- (1.01) --}}
                            </th>
                            <th>In Process
                                {{-- (1.03,1.05,1.07,1.08,1.09,1.10) --}}
                            </th>
                            <th>Activated
                                {{-- (1.02) --}}
                            </th>
                            <th>Rejected
                                {{-- (1.04) --}}
                            </th>
                            <th>Follow Up
                                {{-- (1.03) --}}
                            </th>
                            <th>Carry Forward</th>
                            <th>Point</th>
                            <th>Average</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($callcenter as $k => $cc)
                        {{-- {{$k == 1}} --}}
                        {{-- {{$i == 0}} --}}
                        <tr style="background:#009688;color:#fff">
                            <td>
                                {{++$k}}
                            </td>
                            {{-- <td>
                        {{$provider::NumberOfAgent($cc->call_center_code)}}
                            </td> --}}
                            <td>
                                {{$cc->call_center_name}}
                            </td>
                            <td>
                                {{$provider::AllLeadsCallCenter($cc->call_center_code,'postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::TotalPaidMonthlyCallCenter($cc->call_center_code,'postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterLeadtype($cc->call_center_code,'verified','postpaid',$channel->name)}}
                                {{-- {{$provider::CalCenterLeadtype($cc->call_center_code,'1.03,1.05,1.07,1.08,1.09,1.10','postpaid',$channel->name)}}
                                --}}
                            </td>
                            <td>
                                {{$provider::CalCenterLeadtype($cc->call_center_code,'nonverified','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterLeadtype($cc->call_center_code,'inprocess','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$a = $provider::CalCenterLeadtype($cc->call_center_code,'1.02','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterLeadtype($cc->call_center_code,'rejected','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterLeadtype($cc->call_center_code,'followup','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{-- plan_sum --}}
                                0
                            </td>
                            <td>
                                {{round($provider::plan_sum_monthly($cc->call_center_code,'followup','postpaid',$channel->name))}}
                            </td>
                            <td>
                                {{-- A | {{$a}} --}}
                                @if($a != 0)
                                {{$k = number_format($provider::plan_sum_monthly($cc->call_center_code,'followup','postpaid',$channel->name) / $a,2)}}
                                @else
                                0
                                @endif
                            </td>

                        </tr>
                        @endforeach
                        <tr style="background:ffeb3b85;color:#000;font-weight:bold">
                            <td colspan="2">
                                {{$channel->name}}
                            </td>
                            <td>
                                {{$provider::AllLeadsMonthly($cc->call_center_code,'postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::TotalPaidMonthly($cc->call_center_code,'postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterTotalMonth($cc->call_center_code,'verified','postpaid',$channel->name)}}
                                {{-- {{$provider::CalCenterLeadtype($cc->call_center_code,'1.03,1.05,1.07,1.08,1.09,1.10','postpaid',$channel->name)}}
                                --}}
                            </td>
                            <td>
                                {{$provider::CalCenterTotalMonth($cc->call_center_code,'nonverified','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterTotalMonth($cc->call_center_code,'inprocess','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$a= $provider::CalCenterTotalMonth($cc->call_center_code,'1.02','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterTotalMonth($cc->call_center_code,'rejected','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterTotalMonth($cc->call_center_code,'followup','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{-- plan_sum --}}
                                0
                            </td>
                            <td>
                                {{round($provider::plan_sum_monthly($cc->call_center_code,'followup','postpaid',$channel->name))}}
                            </td>
                            <td>
                                @if($a != 0)
                                {{$k = number_format($provider::plan_sum_monthly($cc->call_center_code,'followup','postpaid',$channel->name) / $a,2)}}
                                @else
                                0
                                @endif
                            </td>
                            {{-- CalCenterTotalMonth --}}
                        </tr>

                    </tbody>
                </table>
                @endforeach
                <div class="py-2"></div>
                <table class=" table-bordered text-center" style="font-weight:400;">
                    <thead>
                        @foreach ($channel_partner as $key => $channel)


                        <tr style="background:{{ $key == 1 ? '#673ab7' : '#000000' }};color:#fff">
                            <th style="width:130px;">{{$channel->name}}</th>
                            <th style="width:130px;">150 & Above</th>
                            <th style="width:130px;">
                                {{-- plan_below_150 --}}
                                {{$provider::plan_above_150($channel->name)}}
                            </th>
                            <th style="width:130px;">Less Than 150</th>
                            <th style="width:130px;">
                                {{$provider::plan_below_150($channel->name)}}
                            </th>
                            <th style="width:130px;">Total</th>
                            <th style="width:130px;">
                                {{$provider::plan_total($channel->name)}}
                            </th>
                        </tr>
                        @endforeach
                    </thead>
                </table>
            </div>
            <h4>COMBINE (HEADING WILL CHANGE/REMOVE LATER)</h4>
            <div class="table-responsive">
                <table class=" table-bordered text-center" style="font-weight:400;">
                    @inject('provider', 'App\Http\Controllers\ReportController')
                    <thead>
                        <tr>
                            <th colspan="13" style="background:#FFC107">
                                <h3>
                                    Today Summary >>
                                    {{$day = \Carbon\Carbon::parse($date = \Carbon\Carbon::today())->format('l')}},
                                    {{$day = \Carbon\Carbon::parse($date = \Carbon\Carbon::today())->format('M, d, Y')}}
                                </h3>
                            </th>
                        </tr>
                        <tr style="background:black;color:#fff">
                            <th>S#</th>
                            {{-- <th>Agents</th> --}}
                            <th>Name of Call Center</th>
                            <th>All Leads</th>
                            <th>Verified
                                {{-- (1.03,1.05,1.07,1.08,1.09,1.10,1.02) --}}
                            </th>
                            <th>Non Verified
                                {{-- (1.01) --}}
                            </th>
                            <th>In Process
                                {{-- (1.03,1.05,1.07,1.08,1.09,1.10) --}}
                            </th>
                            <th>Activated
                                {{-- (1.02) --}}
                            </th>
                            <th>Rejected
                                {{-- (1.04) --}}
                            </th>
                            <th>Follow Up
                                {{-- (1.03) --}}
                            </th>
                            <th>Carry Forward</th>
                            <th>Point</th>
                            <th>Average</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($callcenter as $k => $cc)
                        {{-- {{$k == 1}} --}}
                        {{-- {{$i == 0}} --}}

                        <tr style="background:#6363d2;color:#fff">
                            <td>
                                {{++$k}}
                            </td>
                            {{-- <td>
                    {{$provider::NumberOfAgent($cc->call_center_code)}}
                            </td> --}}
                            <td>
                                {{$cc->call_center_name}}
                            </td>
                            <td>
                                {{$provider::AllLeadsCallCenterTodayCombine($cc->call_center_code,'postpaid')}}
                            </td>
                            <td>
                                {{$provider::CalCenterLeadtypeDateCombine($cc->call_center_code,'verified','postpaid')}}
                                {{-- {{$provider::CalCenterLeadtype($cc->call_center_code,'1.03,1.05,1.07,1.08,1.09,1.10','postpaid',$channel->name)}}
                                --}}
                            </td>
                            <td>
                                {{$provider::CalCenterLeadtypeDateCombine($cc->call_center_code,'nonverified','postpaid')}}
                            </td>
                            <td>
                                {{$provider::CalCenterLeadtypeDateCombine($cc->call_center_code,'inprocess','postpaid')}}
                            </td>
                            <td>
                                {{$a = $provider::CalCenterLeadtypeDateCombine($cc->call_center_code,'1.02','postpaid')}}
                            </td>
                            <td>
                                {{$provider::CalCenterLeadtypeDateCombine($cc->call_center_code,'rejected','postpaid')}}
                            </td>
                            <td>
                                {{$provider::CalCenterLeadtypeDateCombine($cc->call_center_code,'followup','postpaid')}}
                            </td>
                            <td>
                                {{-- plan_sum --}}
                                0
                            </td>
                            <td>
                                {{round($provider::plan_sum_combine($cc->call_center_code,'followup','postpaid'))}}
                            </td>
                            <td>
                                @if($a != 0)
                                {{$k = number_format($provider::plan_sum_combine($cc->call_center_code,'followup','postpaid') / $a,2)}}
                                @else
                                0
                                @endif
                            </td>

                        </tr>
                        @endforeach
                        <tr style="background:ffeb3b85;color:#000;font-weight:bold;border:none">
                            <td colspan="2" style="border:none;">
                                {{-- {{$channel->name}} --}}
                                ALL COMBINE
                            </td>
                            <td>
                                {{$provider::AllLeadsTodayCombine($cc->call_center_code,'postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterToday($cc->call_center_code,'verified','postpaid',$channel->name)}}
                                {{-- {{$provider::CalCenterLeadtype($cc->call_center_code,'1.03,1.05,1.07,1.08,1.09,1.10','postpaid',$channel->name)}}
                                --}}
                            </td>
                            <td>
                                {{$provider::CalCenterTodayCombine($cc->call_center_code,'nonverified','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterTodayCombine($cc->call_center_code,'inprocess','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterTodayCombine($cc->call_center_code,'1.02','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterTodayCombine($cc->call_center_code,'rejected','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterTodayCombine($cc->call_center_code,'followup','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{-- plan_sum --}}
                                0
                            </td>
                            <td>
                                {{round($provider::plan_sum_combine($cc->call_center_code,'followup','postpaid',$channel->name))}}
                            </td>
                            <td>
                                @if($a != 0)
                                {{$k = number_format($provider::plan_sum_combine($cc->call_center_code,'followup','postpaid',$channel->name) / $a,2)}}
                                @else
                                0
                                @endif
                            </td>
                        </tr>


                    </tbody>
                </table>
                {{--  --}}
                <table class=" table-bordered text-center" style="font-weight:400;">
                    @inject('provider', 'App\Http\Controllers\ReportController')
                    <thead>
                        <tr>
                            <th colspan="13" style="background:#FFC107">
                                <h3>
                                    {{$day = \Carbon\Carbon::parse($date = \Carbon\Carbon::today())->format('M, Y')}},
                                    Till
                                    {{$day = \Carbon\Carbon::parse($date = \Carbon\Carbon::today())->format('M, d, Y')}}
                                </h3>
                            </th>
                        </tr>
                        <tr style="background:black;color:#fff">
                            <th>S#</th>
                            {{-- <th>Agents</th> --}}
                            <th>Name of Call Center</th>
                            <th>All Leads</th>
                            <th>Verified
                                {{-- (1.03,1.05,1.07,1.08,1.09,1.10,1.02) --}}
                            </th>
                            <th>Non Verified
                                {{-- (1.01) --}}
                            </th>
                            <th>In Process
                                {{-- (1.03,1.05,1.07,1.08,1.09,1.10) --}}
                            </th>
                            <th>Activated
                                {{-- (1.02) --}}
                            </th>
                            <th>Rejected
                                {{-- (1.04) --}}
                            </th>
                            <th>Follow Up
                                {{-- (1.03) --}}
                            </th>
                            <th>Carry Forward</th>
                            <th>Point</th>
                            <th>Average</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($callcenter as $k => $cc)
                        {{-- {{$k == 1}} --}}
                        {{-- {{$i == 0}} --}}
                        <tr style="background:#009688;color:#fff">
                            <td>
                                {{++$k}}
                            </td>
                            {{-- <td>
                            {{$provider::NumberOfAgent($cc->call_center_code)}}
                            </td> --}}
                            <td>
                                {{$cc->call_center_name}}
                            </td>
                            <td>
                                {{$provider::AllLeadsCallCenterCombine($cc->call_center_code,'postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterLeadtypeCombine($cc->call_center_code,'verified','postpaid',$channel->name)}}
                                {{-- {{$provider::CalCenterLeadtype($cc->call_center_code,'1.03,1.05,1.07,1.08,1.09,1.10','postpaid',$channel->name)}}
                                --}}
                            </td>
                            <td>
                                {{$provider::CalCenterLeadtypeCombine($cc->call_center_code,'nonverified','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterLeadtypeCombine($cc->call_center_code,'inprocess','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$a = $provider::CalCenterLeadtypeCombine($cc->call_center_code,'1.02','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{round($provider::CalCenterLeadtypeCombine($cc->call_center_code,'rejected','postpaid',$channel->name))}}
                            </td>
                            <td>
                                {{$provider::CalCenterLeadtypeCombine($cc->call_center_code,'followup','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{-- plan_sum --}}
                                0
                            </td>
                            <td>
                                {{$provider::plan_sum_monthly_combine($cc->call_center_code,'followup','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{-- A | {{$a}} --}}
                                @if($a != 0)
                                {{$k = number_format($provider::plan_sum_monthly_combine($cc->call_center_code,'followup','postpaid',$channel->name) / $a,2)}}
                                @else
                                0
                                @endif
                            </td>

                        </tr>
                        @endforeach
                        <tr style="background:ffeb3b85;color:#000;font-weight:bold;border:none">
                            <td colspan="2" style="border:none;">
                                ALL COMBINE
                            </td>
                            <td>
                                {{$provider::AllLeadsMonthlyCombine($cc->call_center_code,'postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterMonthlyCombine($cc->call_center_code,'verified','postpaid',$channel->name)}}
                                {{-- {{$provider::CalCenterLeadtype($cc->call_center_code,'1.03,1.05,1.07,1.08,1.09,1.10','postpaid',$channel->name)}}
                                --}}
                            </td>
                            <td>
                                {{$provider::CalCenterMonthlyCombine($cc->call_center_code,'nonverified','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterMonthlyCombine($cc->call_center_code,'inprocess','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterMonthlyCombine($cc->call_center_code,'1.02','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterMonthlyCombine($cc->call_center_code,'rejected','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{$provider::CalCenterMonthlyCombine($cc->call_center_code,'followup','postpaid',$channel->name)}}
                            </td>
                            <td>
                                {{-- plan_sum --}}
                                0
                            </td>
                            <td>
                                {{round($provider::plan_sum_combine($cc->call_center_code,'followup','postpaid',$channel->name))}}
                            </td>
                            <td>
                                @if($a != 0)
                                {{$k = number_format($provider::plan_sum_combine($cc->call_center_code,'followup','postpaid',$channel->name) / $a,2)}}
                                @else
                                0
                                @endif
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- @endforeach --}}
@endsection
