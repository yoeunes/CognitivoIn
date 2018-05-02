
@extends('layouts.form')

@section('content')

        <div class="row">
            <div class="col-sm-6 col-md-3">
                <a class="block block-link-hover3 text-center" href="{{ route('teams.create', request()->route('profile')) }}">
                    <div class="block-content block-content-full">
                        <div class="h1 font-w700 text-success"><i class="fa fa-plus"></i></div>
                    </div>
                    <div class="block-content block-content-full block-content-mini bg-gray-lighter text-success font-w600">Add Team</div>
                </a>
            </div>

        </div>
        <div class="block">
            <div class="block-header bg-gray-lighter">
                <ul class="block-options">
                    <li class="dropdown">
                        <button type="button" data-toggle="dropdown">Filter <span class="caret"></span></button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a tabindex="-1" href="javascript:void(0)"><span class="badge pull-right">90</span>New</a>
                            </li>
                            <li>
                                <a tabindex="-1" href="javascript:void(0)"><span class="badge pull-right">15</span>Out of Stock</a>
                            </li>
                            <li>
                                <a tabindex="-1" href="javascript:void(0)"><span class="badge pull-right">8750</span>All</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <h3 class="block-title">All Teams</h3>
            </div>
            <div class="block-content">
                <table class="table table-bordered table-striped js-dataTable-full">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 100px;">Name</th>
                            <th class="visible-lg">Alias</th>

                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($teams as $team)
                          <tr>
                              <td class="text-center">
                                  <a class="font-" href="{{ route('teams.edit',[ request()->route('profile'),$team]) }}">
                                      <strong>{{$team->name}}</strong>
                                  </a>
                              </td>
                              <td class="hidden-xs text-center">{{$team->alias}}</td>

                              <td class="text-center">
                                  <div class="btn-group btn-group-xs">
                                      <a href="base_pages_ecom_product_edit.php" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="View"><i class="fa fa-eye"></i></a>
                                      <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Delete"><i class="fa fa-times text-danger"></i></a>
                                  </div>
                              </td>
                          </tr>
                      @endforeach


                    </tbody>
                </table>
                <nav class="text-right">
                    <ul class="pagination pagination-sm">
                        <li class="active">
                            <a href="javascript:void(0)">1</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">2</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">3</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">4</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">5</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="fa fa-angle-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

@endsection
@section('javascript')
        <script src="/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/js/pages/base_tables_datatables.js"></script>
@endsection
