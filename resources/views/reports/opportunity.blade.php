@extends('reports.master')

@section('reportName', 'Opportunity')

@section('data')
    <div>
        <input type="date" id="start_date"/>
        <input type="date" id="end_date"/>
        <a href="#" onclick="Click()" >
            ReGenerate
        </a>
    </div>

    <table class="u-full-width">
        <tbody>
            @foreach ($data->groupBy('pipeline_id') as $groupedRow)
                <tr>
                    <td colspan="6">
                        @if (isset($groupedRow->first()->pipeline))
                            <h5>{{ $groupedRow->first()->pipeline->name }}</h5>
                        @else
                            <h5>Missing Pipeline</h5>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>@lang('back-office.Opportunities')</th>
                    <th>@lang('back-office.Customer')</th>
                    <th>@lang('global.Date')</th>

                    <th>@lang('back-office.Status')</th>
                    <th>@lang('back-office.Task')</th>
                    <th>@lang('back-office.Sentiment')</th>
                    
                    <th class="number">@lang('global.Quantity')</th>
                    <th class="number">@lang('global.Value')</th>
                </tr>

                @foreach ($groupedRow as $row)
                    <tr>
                        <td>{{ $row->name }}</td>
                        <td> {{ $row->relationship_id }} </td>
                        <td>{{ $row->date }}</td>
                        <td>
                            @if ($row->status == 2)
                                @lang('back-office.OnHold')
                            @elseif ($row->status == 3)
                                @lang('back-office.Won')
                            @elseif ($row->status == 4)
                                @lang('back-office.Lost')
                            @else
                                @lang('back-office.Active')
                            @endif
                        </td>

                        <td>{{ $row->tasks->where('completed', 1)->count() }} / {{ $row->tasks->count() }}</td>
                        <td>{{ number_format (($row->tasks->sum('sentiment') / $row->tasks->where('completed', 1)->count()) / 3, 2, ',', '.') }} %</td>

                        <td class="number">{{ $row->carts->sum('quantity') }}</td>
                        <td class="number">{{ ($row->carts->sum('quantity') * $row->carts->sum('unit_price')) ?? $row->value }} <b>{{ $row->currency }}</b></td>
                    </tr>
                    @foreach ($row->tasks->where('completed', 0)->take(5) as $task)
                        <tr>
                            <td></td>
                            <td>
                                <b-icon icon="account" size="is-small"></b-icon>
                                @if ($task->activity_type == 1)
                                    <b-icon icon="format-list-checks"></b-icon>
                                @elseif ($task->activity_type == 2)
                                    <b-icon icon="phone"></b-icon>
                                @elseif ($task->activity_type == 3)
                                    <b-icon icon="video"></b-icon>
                                @elseif ($task->activity_type == 4)
                                    <b-icon icon="account-multiple"></b-icon>
                                @elseif ($task->activity_type == 5)
                                    <b-icon icon="map-marker-radius"></b-icon>
                                @elseif ($task->activity_type == 6)
                                    <b-icon icon="email"></b-icon>
                                @endif
                            </td>
                            <td>{{ $task->date_started }}</td>
                            <td>{{ $task->title }}</td>
                            <td>
                                {{-- @if ($task->sentiment == 2)
                                <img src="/img/icons/emojiHappy.svg" width="16" alt="">
                            @elseif ($task->sentiment == 0)
                            <img src="/img/icons/emojiSad.svg" width="16" alt="">
                        @elseif ($task->sentiment == 1) --}}
                        {{-- <img src="/img/icons/emojiOk.svg" width="16" alt=""> --}}
                        {{-- @endif --}}
                    </td>

                </tr>
            @endforeach
        @endforeach
    @endforeach
</tbody>
</table>
@endsection

@section('script')
    <script>
    function Click() {
        var start_date = document.getElementById('start_date').value;
        var end_date = document.getElementById('end_date').value;
        window.location.href = "/reports/opportunities/{{ $header->alias }}/" + start_date + "/" +  end_date;
    }
    </script>
@endsection
