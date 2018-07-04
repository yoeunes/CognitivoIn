@extends('reports.master')

@section('reportName', 'Opportunity')

@section('data')
    <table class="u-full-width">
        <tbody>
            <thead>
                <tr>
                    <th>@lang('global.Name')</th>
                    <th>@lang('global.Description')</th>
                    <th>@lang('global.Customer')</th>
                    <th class="number">@lang('global.Value')</th>
                    <th>@lang('global.Currency')</th>

                </tr>
            </thead>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->description }}</td>
                    <td>{{ $row->relationship->customer_alias }}</td>
                    <td class="number">{{ $row->value }}</td>
                    <td>{{ $row->currency }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
