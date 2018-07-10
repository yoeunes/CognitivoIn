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
      <thead>
        <tr>
          <th>@lang('global.Date')</th>
          <th>@lang('global.Name')</th>
          <th>@lang('global.Description')</th>
          <th>@lang('global.Customer')</th>
          <th>@lang('global.quantity')</th>
          <th class="number">@lang('global.Value')</th>
          <th>@lang('global.Currency')</th>

        </tr>
      </thead>
      @foreach ($data as $row)
        <tr>
          <td>{{ $row->date }}</td>
          <td>{{ $row->name }}</td>
          <td>{{ $row->description }}</td>
          <td>{{ $row->relationship->customer_alias }}</td>
          <td>{{ $row->carts->first()->quantity }}</td>
          <td class="number">{{ $row->value }}</td>
          <td>{{ $row->currency }}</td>

        </tr>
      @endforeach
    </tbody>
  </table>



@endsection
@section('script')
  <script >
  function Click() {
    var start_date=document.getElementById('start_date').value;
    var end_date=document.getElementById('end_date').value;
    window.location.href = "/reports/opportunities/we-paraguay/" + start_date + "/" +  end_date;
  }
  </script>
@endsection
