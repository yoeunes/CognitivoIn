@extends('layouts.app')

@section('content')

  <div class="block">
    <div class="bg-image" style="background-image: url('/img/photos/photo3@2x.jpg');">
      <div class="block-content bg-primary-op text-center overflow-hidden">
        <div class="push-30-t push animated fadeInDown">

          @if ($profile->getMedia('images')->first()!=null)
            <img src='{{ asset($profile->getMedia('images')->first()->getUrl('thumb')) }}'/>
          @endif



        </div>
        <div class="push-30 animated fadeInUp">
          <h2 class="h1 font-w600 text-white push-5">{{ $profile->name }}</h2>
          <h3 class="h5 text-white-op">{{ $profile->taxid }}</h3>
        </div>
      </div>
    </div>
    <div class="block-content text-center">
      <div class="row items-push text-uppercase">
        <div class="col-xs-6 col-sm-3">

        </div>
        <div class="col-xs-6 col-sm-3">
          <div class="font-w700 text-gray-darker animated fadeIn">Following</div>
          <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)">
            {{ $profile->followings()->count() }}
          </a>
        </div>
        <div class="col-xs-6 col-sm-3">
          <div class="font-w700 text-gray-darker animated fadeIn">Followers</div>
          <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)">
            {{ $profile->followers()->count() }}
          </a>
        </div>
        <div class="col-lg-6">

          <!-- Top Products -->
          <div class="block block-opt-refresh-icon4">
            <div class="block-header bg-gray-lighter">
              <ul class="block-options">
                <li>
                  <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                </li>
              </ul>
              <h3 class="block-title">Top Products</h3>
            </div>
            <div class="block-content">
              <table class="table table-borderless table-striped table-vcenter">
                <tbody>
                  <tr>
                    <td class="text-center" style="width: 100px;"><a href="base_pages_ecom_product_edit.html"><strong>PID.965</strong></a></td>
                    <td><a href="base_pages_ecom_product_edit.html">Apple MacBook</a></td>
                    <td class="hidden-xs text-center">
                      <div class="text-warning">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center"><a href="base_pages_ecom_product_edit.html"><strong>PID.154</strong></a></td>
                    <td><a href="base_pages_ecom_product_edit.html">Laptop Sony</a></td>
                    <td class="hidden-xs text-center">
                      <div class="text-warning">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center"><a href="base_pages_ecom_product_edit.html"><strong>PID.523</strong></a></td>
                    <td><a href="base_pages_ecom_product_edit.html">iphone 5s (36)</a></td>
                    <td class="hidden-xs text-center">
                      <div class="text-warning">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center"><a href="base_pages_ecom_product_edit.html"><strong>PID.423</strong></a></td>
                    <td><a href="base_pages_ecom_product_edit.html">HardDisk 1 TB</a></td>
                    <td class="hidden-xs text-center">
                      <div class="text-warning">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center"><a href="base_pages_ecom_product_edit.html"><strong>PID.391</strong></a></td>
                    <td><a href="base_pages_ecom_product_edit.html">Mouse</a></td>
                    <td class="hidden-xs text-center">
                      <div class="text-warning">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center"><a href="base_pages_ecom_product_edit.html"><strong>PID.218</strong></a></td>
                    <td><a href="base_pages_ecom_product_edit.html">Keyboard</a></td>
                    <td class="hidden-xs text-center">
                      <div class="text-warning">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center"><a href="base_pages_ecom_product_edit.html"><strong>PID.995</strong></a></td>
                    <td><a href="base_pages_ecom_product_edit.html">Monitor 16'</a></td>
                    <td class="hidden-xs text-center">
                      <div class="text-warning">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center"><a href="base_pages_ecom_product_edit.html"><strong>PID.761</strong></a></td>
                    <td><a href="base_pages_ecom_product_edit.html">Apple airBook</a></td>
                    <td class="hidden-xs text-center">
                      <div class="text-warning">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center"><a href="base_pages_ecom_product_edit.html"><strong>PID.860</strong></a></td>
                    <td><a href="base_pages_ecom_product_edit.html">IPOD 16 GB</a></td>
                    <td class="hidden-xs text-center">
                      <div class="text-warning">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center"><a href="base_pages_ecom_product_edit.html"><strong>PID.952</strong></a></td>
                    <td><a href="base_pages_ecom_product_edit.html">Usb 16 GB</a></td>
                    <td class="hidden-xs text-center">
                      <div class="text-warning">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- END Top Products -->
        </div>
        <div class="col-lg-6">
          <!-- Latest Orders -->
          <div class="block block-opt-refresh-icon4">
            <div class="block-header bg-gray-lighter">
              <ul class="block-options">
                <li>
                  <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                </li>
              </ul>
              <h3 class="block-title">Latest Orders</h3>
            </div>
            <div class="block-content">
              <table class="table table-borderless table-striped table-vcenter">
                <tbody>
                  <tr>
                    <td class="text-center" style="width: 100px;"><a href="base_pages_ecom_order.html"><strong>ORD.7116</strong></a></td>
                    <td class="hidden-xs"><a href="base_pages_ecom_customer.html">Eugene Burke</a></td>
                    <td><span class="label label-success">Delivered</span></td>
                    <td class="text-right"><strong>$713,00</strong></td>
                  </tr>
                  <tr>
                    <td class="text-center"><a href="base_pages_ecom_order.html"><strong>ORD.7115</strong></a></td>
                    <td class="hidden-xs"><a href="base_pages_ecom_customer.html">Amanda Powell</a></td>
                    <td><span class="label label-danger">Canceled</span></td>
                    <td class="text-right"><strong>$904,00</strong></td>
                  </tr>
                  <tr>
                    <td class="text-center"><a href="base_pages_ecom_order.html"><strong>ORD.7114</strong></a></td>
                    <td class="hidden-xs"><a href="base_pages_ecom_customer.html">Vincent Sims</a></td>
                    <td><span class="label label-success">Delivered</span></td>
                    <td class="text-right"><strong>$957,00</strong></td>
                  </tr>
                  <tr>
                    <td class="text-center"><a href="base_pages_ecom_order.html"><strong>ORD.7113</strong></a></td>
                    <td class="hidden-xs"><a href="base_pages_ecom_customer.html">Keith Simpson</a></td>
                    <td><span class="label label-warning">Processing</span></td>
                    <td class="text-right"><strong>$798,00</strong></td>
                  </tr>
                  <tr>
                    <td class="text-center"><a href="base_pages_ecom_order.html"><strong>ORD.7112</strong></a></td>
                    <td class="hidden-xs"><a href="base_pages_ecom_customer.html">Joshua Munoz</a></td>
                    <td><span class="label label-success">Delivered</span></td>
                    <td class="text-right"><strong>$933,00</strong></td>
                  </tr>
                  <tr>
                    <td class="text-center"><a href="base_pages_ecom_order.html"><strong>ORD.7111</strong></a></td>
                    <td class="hidden-xs"><a href="base_pages_ecom_customer.html">Linda Moore</a></td>
                    <td><span class="label label-warning">Processing</span></td>
                    <td class="text-right"><strong>$982,00</strong></td>
                  </tr>
                  <tr>
                    <td class="text-center"><a href="base_pages_ecom_order.html"><strong>ORD.7110</strong></a></td>
                    <td class="hidden-xs"><a href="base_pages_ecom_customer.html">Denise Watson</a></td>
                    <td><span class="label label-success">Delivered</span></td>
                    <td class="text-right"><strong>$994,00</strong></td>
                  </tr>
                  <tr>
                    <td class="text-center"><a href="base_pages_ecom_order.html"><strong>ORD.7109</strong></a></td>
                    <td class="hidden-xs"><a href="base_pages_ecom_customer.html">Rebecca Reid</a></td>
                    <td><span class="label label-warning">Processing</span></td>
                    <td class="text-right"><strong>$927,00</strong></td>
                  </tr>
                  <tr>
                    <td class="text-center"><a href="base_pages_ecom_order.html"><strong>ORD.7108</strong></a></td>
                    <td class="hidden-xs"><a href="base_pages_ecom_customer.html">Julia Cole</a></td>
                    <td><span class="label label-success">Delivered</span></td>
                    <td class="text-right"><strong>$455,00</strong></td>
                  </tr>
                  <tr>
                    <td class="text-center"><a href="base_pages_ecom_order.html"><strong>ORD.7107</strong></a></td>
                    <td class="hidden-xs"><a href="base_pages_ecom_customer.html">Craig Stone</a></td>
                    <td><span class="label label-danger">Canceled</span></td>
                    <td class="text-right"><strong>$749,00</strong></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- END Latest Orders -->
        </div>
      </div>
    </div>
  </div>
  <form method="post" role="form" action="{{ route('portal.update', request()->route('profile')) }}" enctype="multipart/form-data">

    <div class="block">
      {{ method_field('PUT') }}
      {{ csrf_field() }}
      <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs">
        <li class="active">
          <a href="#btabs-alt-static-home">General</a>
        </li>
        <li class="">
          <a href="#btabs-alt-static-profile">Contact</a>
        </li>
      </ul>

      <div class="block-content tab-content">
        <div class="tab-pane active" id="btabs-alt-static-home">
          <h4 class="font-w300 push-15">General Information</h4>
          <div class="row items-push">
            <div class="col-sm-6 col-sm-offset-3 form-horizontal">

              <div class="form-group">
                <div class="col-xs-12">
                  <input type="file" name="profile_name">
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-12">
                  <label for="profile-firstname">Company Name</label>
                  <input class="form-control input-lg" type="text" id="name" name="name" placeholder="Enter your name.." value="{{$profile->name}}">
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-6">
                  <label for="profile-lastname">Alias (Nickname)</label>
                  <input class="form-control input-lg" type="text" id="alias" name="alias" placeholder="Enter your alias.." value="{{$profile->alias}}">
                </div>
                <div class="col-xs-6">
                  <label for="profile-lastname">TaxID</label>
                  <input class="form-control input-lg" type="text" id="taxid" name="taxid" placeholder="Enter your Tax.." value="{{$profile->taxid}}">
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-12">
                  <label for="profile-bio">Long Description</label>
                  <textarea class="form-control input-lg" id="bio" name="long_description" rows="8" placeholder="Enter a few details about yourself..">
                    {{$profile->long_description}}
                  </textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-12">
                  <label for="profile-bio">Short Description</label>
                  <textarea class="form-control input-lg" id="bio" name="short_description" rows="4" placeholder="Enter details about yourself..">
                    {{$profile->short_description}}
                  </textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane" id="btabs-alt-static-profile">
          <h4 class="font-w300 push-15">Contact Information</h4>
          <div class="row">
            <div class="form-group">
              <div class="col-xs-6">
                <label for="profile-email">Email Address</label>
                <input class="form-control input-lg" type="email" id="email" name="email" placeholder="Enter your email.." value="{{$profile->email}}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <div class="col-xs-6">
                <label for="profile-email">Website</label>
                <input class="form-control input-lg" type="website" id="website" name="website" placeholder="Enter your website.." value="{{$profile->website}}">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="block-content block-content-full bg-gray-lighter text-center">
        <button class="btn btn-primary" type="submit"><i class="fa fa-check push-5-r"></i> Update</button>
        <a class="btn btn-warning" href="{{ route('portal.show', request()->route('profile')) }}"><i class="fa fa-refresh push-5-r"></i> Cancel</a>
      </div>
    </div>
  </form>
@endsection
