@extends('layouts.app')

@section('main')
    <reports inline-template>
            <div class="m-portlet m-portlet--tabs">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                @lang('global.DateRange')
                                <el-date-picker v-model="dateRange"
                                type="daterange"
                                align="right"
                                unlink-panels
                                range-separator="|"
                                start-placeholder="@lang('global.StartDate')"
                                end-placeholder="@lang('global.EndDate')"
                                format = "dd/MM/yyyy"
                                value-format = "yyyy-MM-dd"
                                :picker-options="pickerOptions2"></el-date-picker>
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="nav nav-tabs m-tabs-line m-tabs-line--right m-tabs-line--brand" role="tablist">
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#commercial" role="tab" aria-selected="false">
                                    <i class="la la-briefcase"></i>
                                    @lang('global.Commercial')
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#accounting" role="tab" aria-selected="false">
                                    <i class="la la-calculator"></i>
                                    @lang('accounting.Accounting')
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#audit" role="tab" aria-selected="true">
                                    <i class="la la-search"></i>
                                    @lang('global.Audits')
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="commercial" role="tabpanel">
                            <div class="row">
                                <div class="col-6">
                                    <h3> @lang('commercial.Sales') </h3>
                                    <p class="lead"> Basic reports giving you information regarding your sales. </p>

                                    <div class="m-widget4">
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__img m-widget4__img--icon">
                                                <img src="/img/icons/sales.svg" alt="">
                                            </div>
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__text">
                                                    <a target="_blank" :href="'reports/opportunities/'+dateRange[0]+'/'+dateRange[1]">
                                                        @lang('commercial.SalesBook')
                                                    </a>
                                                    <br>
                                                    <small>Basic list of sales invoices</small>
                                                </span>
                                            </div>
                                            <div class="m-widget4__ext">
                                                <a target="_blank" href="#" class="m-widget4__icon">
                                                    <i class="la la-download"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__img m-widget4__img--icon">
                                                <img src="/img/icons/sales.svg" alt="">
                                            </div>
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__text">
                                                    <a target="_blank" :href="'reports/sales-byVATs/'+dateRange[0]+'/'+dateRange[1]">
                                                        @lang('commercial.SalesByVAT')
                                                    </a>
                                                    <br>
                                                    <small>List of invoices grouped by sales tax</small>
                                                </span>
                                            </div>
                                            <div class="m-widget4__ext">
                                                <a target="_blank" href="#" class="m-widget4__icon">
                                                    <i class="la la-download"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__img m-widget4__img--icon">
                                                <img src="/img/icons/sales.svg" alt="">
                                            </div>
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__text">
                                                    <a target="_blank" :href="'reports/sales-byCustomers/'+dateRange[0]+'/'+dateRange[1]">
                                                        @lang('commercial.SalesByCustomer')
                                                    </a>
                                                    <br>
                                                    <small>List of invoices grouped by customers</small>
                                                </span>
                                            </div>
                                            <div class="m-widget4__ext">
                                                <a target="_blank" href="#" class="m-widget4__icon">
                                                    <i class="la la-download"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__img m-widget4__img--icon">
                                                <img src="/img/icons/credit-note.svg" alt="">
                                            </div>
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__text">
                                                    <a target="_blank" :href="'reports/credit_notes/'+dateRange[0]+'/'+dateRange[1]">
                                                        @lang('commercial.CreditNotes')
                                                    </a>
                                                    <br>
                                                    <small>List of credit returns made</small>
                                                </span>
                                            </div>
                                            <div class="m-widget4__ext">
                                                <a target="_blank" href="#" class="m-widget4__icon">
                                                    <i class="la la-download"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__img m-widget4__img--icon">
                                                <img src="/img/icons/account-receivable.svg" alt="">
                                            </div>
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__text">
                                                    <a target="_blank" :href="'reports/account-receivable/'+dateRange[0]+'/'+dateRange[1]">
                                                        @lang('commercial.AccountsReceivable')
                                                    </a>
                                                    <br>
                                                    <small>List of accounts receivables</small>
                                                </span>
                                            </div>
                                            <div class="m-widget4__ext">
                                                <a target="_blank" href="#" class="m-widget4__icon">
                                                    <i class="la la-download"></i>
                                                </a>
                                            </div>
                                        </div>
                                        {{-- <div class="m-widget4__item">
                                            <div class="m-widget4__img m-widget4__img--icon">
                                                <img src="/img/icons/sales.svg" alt="">
                                            </div>
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__text">
                                                    <a target="_blank" href="#">@lang('commercial.VATDebit')</a>
                                                    <br>
                                                    <small>List of VAT Debit (sales invoice plus debit notes)</small>
                                                </span>
                                            </div>
                                            <div class="m-widget4__ext">
                                                <a target="_blank" href="#" class="m-widget4__icon">
                                                    <i class="la la-download"></i>
                                                </a>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>

                            </div>

                            <hr>


                        </div>



                    </div>
                </div>
            </div>
        </reports>
@endsection
