@if ($reportName == 'postpaid')
<div class="table-responsive">
    <table class="table table-striped table-bordered zero-configuration">
        @inject('provider', 'App\Http\Controllers\HomeController')
        <thead>
            <tr>
                {{-- <th>S#</th>
                <th>Agent Name</th> --}}
                <th>Total Postpaid Verified</th>
                <th>Total Postpaid Pending</th>
                <th>Total Postpaid Follow Up</th>
                <th>Total Postpaid Reject</th>
                <th>Total Postpaid Activation</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                {{-- <td>
                    Salman
                </td>
                <td>
                    Ahmed
                </td> --}}
                        {{-- POSTPAID START --}}
        <td>
            <a onclick="DetailReport('{{$userId}}','{{route('ajaxRequest.DtlReport')}}','verified','postpaid')">
                {{$provider::PostPaidVerified($userId)}}
            </a>
        </td>
        <td>
            <a onclick="DetailReport('{{$userId}}','{{route('ajaxRequest.DtlReport')}}','pending','postpaid')">
                {{$provider::PostPaidPending($userId)}}
            </a>
        </td>
        <td>
            <a onclick="DetailReport('{{$userId}}','{{route('ajaxRequest.DtlReport')}}','follow','postpaid')">
                {{$provider::PostPaidFollow($userId)}}
            </a>
        </td>
        <td>
            <a onclick="DetailReport('{{$userId}}','{{route('ajaxRequest.DtlReport')}}','reject','postpaid')">
                {{$provider::PostPaidReject($userId)}}
            </a>
        </td>
        <td>
            <a onclick="DetailReport('{{$userId}}','{{route('ajaxRequest.DtlReport')}}','active','postpaid')">
                {{$provider::PostPaidActive($userId)}}
            </a>
        </td>
        {{-- POSTPAIDEND --}}

            </tr>

        </tbody>
    </table>
</div>
@elseif($reportName == 'Elife')
<div class="table-responsive">
    <table class="table table-striped table-bordered zero-configuration">
        @inject('provider', 'App\Http\Controllers\HomeController')
        <thead>
            <tr>
                {{-- <th>S#</th>
                <th>Agent Name</th> --}}
                <th>Total Elife Verified</th>
                <th>Total Elife Pending</th>
                <th>Total Elife Follow Up</th>
                <th>Total Elife Reject</th>
                <th>Total Elife Activation</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                {{-- <td>
                    Salman
                </td>
                <td>
                    Ahmed
                </td> --}}
                {{-- ELIFE START --}}
                <td>
            <a onclick="DetailReport('{{$userId}}','{{route('ajaxRequest.DtlReport')}}','verified','elife')">

                    {{$provider::ElifeVerified($userId)}}
            </a>
                </td>
                <td>
            <a onclick="DetailReport('{{$userId}}','{{route('ajaxRequest.DtlReport')}}','pending','elife')">

                    {{$provider::ElifePending($userId)}}
            </a>
                </td>
                <td>
            <a onclick="DetailReport('{{$userId}}','{{route('ajaxRequest.DtlReport')}}','follow','elife')">

                    {{$provider::ElifeFollow($userId)}}
            </a>

                </td>
                <td>
            <a onclick="DetailReport('{{$userId}}','{{route('ajaxRequest.DtlReport')}}','reject','elife')">

                    {{$provider::ElifeReject($userId)}}
            </a>

                </td>
                <td>
            <a onclick="DetailReport('{{$userId}}','{{route('ajaxRequest.DtlReport')}}','active','elife')">

                    {{$provider::ElifeActive($userId)}}
            </a>

                </td>
                {{-- ELIFE END --}}

            </tr>

        </tbody>
    </table>
</div>
@elseif($reportName == 'ITProducts')
<div class="table-responsive">
    <table class="table table-striped table-bordered zero-configuration">
        @inject('provider', 'App\Http\Controllers\HomeController')
        <thead>
            <tr>
                {{-- <th>S#</th>
                <th>Agent Name</th> --}}
                <th>Total IT Products Verified</th>
                <th>Total IT Products Pending</th>
                <th>Total IT Products Follow Up</th>
                <th>Total IT Products Reject</th>
                <th>Total IT Products Activation</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                {{-- <td>
                    Salman
                </td>
                <td>
                    Ahmed
                </td> --}}
                        {{-- IT PRODUCT START --}}
                                <td>
            <a onclick="DetailReport('{{$userId}}','{{route('ajaxRequest.DtlReport')}}','verified','ITProducts')">

                                    {{$provider::ITProductVerified($userId)}}
            </a>
                                </td>
                                <td>
            <a onclick="DetailReport('{{$userId}}','{{route('ajaxRequest.DtlReport')}}','pending','ITProducts')">

                                    {{$provider::ITProductPending($userId)}}
            </a>

                                </td>
                                <td>
            <a onclick="DetailReport('{{$userId}}','{{route('ajaxRequest.DtlReport')}}','follow','ITProducts')">

                                    {{$provider::ITProductFollow($userId)}}
            </a>

                                </td>
                                <td>
            <a onclick="DetailReport('{{$userId}}','{{route('ajaxRequest.DtlReport')}}','reject','ITProducts')">

                                    {{$provider::ITProductReject($userId)}}
            </a>

                                </td>
                                <td>
            <a onclick="DetailReport('{{$userId}}','{{route('ajaxRequest.DtlReport')}}','active','ITProducts')">

                                    {{$provider::ITProductActive($userId)}}
            </a>

                                </td>
                                {{-- IT PRODUCT End --}}

            </tr>

        </tbody>
    </table>
</div>
@endif
