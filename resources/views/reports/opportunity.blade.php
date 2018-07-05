@extends('reports.master')

@section('reportName', 'Opportunity')

@section('data')
  <table class="u-full-width">
    <tbody>
      <thead>
        <tr>
          <th>@lang('global.Date')</th>
          <th>@lang('global.Name')</th>
          <th>@lang('global.Description')</th>
          <th>@lang('global.Customer')</th>
          <th>@lang('global.quantity')</th>
          <th>@lang('global.contact')</th>
          <th>@lang('global.email')</th>
          <th class="number">@lang('global.Value')</th>
          <th>@lang('global.Currency')</th>
          <th>@lang('global.Complete')</th>
          <th>@lang('global.completed Date')</th>
        </tr>
      </thead>
      @foreach ($data as $row)
        <tr>
            <td>{{ $row->date }}</td>
          <td>{{ $row->name }}</td>
          <td>{{ $row->description }}</td>
          <td>{{ $row->customer }}</td>
          <td>{{ $row->quantity }}</td>
          <td>{{ $row->contact }}</td>
          <td>{{ $row->email }}</td>
          <td class="number">{{ $row->value }}</td>
          <td>{{ $row->currency }}</td>
          <td>{{ $row->complete_by }}</td>
          <td>{{ $row->complete_date }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
