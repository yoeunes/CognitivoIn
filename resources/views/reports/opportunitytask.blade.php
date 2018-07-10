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
          <th>@lang('global.Title')</th>
          <th>@lang('global.Started Date')</th>
          <th>@lang('global.End Date')</th>
        </tr>
      </thead>
      @foreach ($data as $row)
        <tr>
          <td>{{ $row->created_date }}</td>
          <td>{{ $row->name }}</td>
          <td>{{ $row->description }}</td>
          <td>{{ $row->title }}</td>
          <td>{{ $row->date_started }}</td>
          <td>{{ $row->date_ended }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
