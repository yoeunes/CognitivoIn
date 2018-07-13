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
                    <td>
                        <h5>{{ $groupedRow->first()->pipeline->name }}</h5>
                    </td>
                </tr>
                <tr>
                    <th>@lang('back-office.Opportunities')</th>
                    <th>@lang('back-office.Customer')</th>
                    <th>@lang('global.Date')</th>

                    <th>@lang('back-office.Status')</th>
                    <th>@lang('back-office.Task')</th>

                    <th class="number">@lang('global.Quantity')</th>
                    <th class="number">@lang('global.Value')</th>
                </tr>

                @foreach ($groupedRow as $row)
                    <tr>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->relationship->customer_alias ?? '' }}</td>
                        <td>{{ $row->date }}</td>

                        '1 = Active; 2 = On Hold; 3 = Won; 4 = Lost'

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

                        <td class="number">{{ $row->carts->sum('quantity') }}</td>
                        <td class="number">{{ ($row->carts->sum('quantity') * $row->carts->sum('unit_price')) ?? $row->value }} <b>{{ $row->currency }}</b></td>
                    </tr>
                    @foreach ($row->tasks->where('completed', 0)->take(5) as $task)
                        <tr>
                            <td></td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->date_started }}</td>
                            <td>
                                @if ($task->sentiment == 2)
                                    <img src="/img/icons/emojiHappy.svg" width="16" alt="">
                                @elseif ($task->sentiment == 0)
                                    <img src="/img/icons/emojiSad.svg" width="16" alt="">
                                @else
                                    <img src="/img/icons/emojiOk.svg" width="16" alt="">
                                @endif
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
