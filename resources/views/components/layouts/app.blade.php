<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AgroChemicals</title>
        <link rel="stylesheet" href="/assets/cssbundle/dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/avio-style.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link href="/assets/general_css.css" rel="stylesheet" />
        <link rel="stylesheet" href="/assets/plugins/fancy-file-uploader/fancy_fileupload.css" type="text/css" media="all" />
        @yield('style')
        @livewireStyles
    </head>
    <body data-avio="theme-green" class="" style="">
        <div class="avio">
            <!-- Start:: main body header -->
            <div class="body-header sticky-md-top">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between">
                        <!-- Header:: icon and user profile -->
                            <ul class="nav d-flex align-items-center mb-0 list-unstyled">
                            <!-- start: User dropdown-menu -->
                                <li>
                                    <div class="dropdown morphing scale-left user-profile mx-lg-3 mx-2">
                                        <a class="nav-link dropdown-toggle rounded-circle after-none p-0" href="#" role="button" data-bs-toggle="dropdown">
                                            <img class="avatar lg img-thumbnail rounded-circle shadow" src="./assets/img/profile_av.png" alt="">
                                        </a>
                                        <div class="dropdown-menu border-0 rounded-4 shadow p-0 ">
                                            <div class="card w240 overflow-hidden">
                                                <div class="card-body">
                                                    <h6 class="card-title mb-0">{{Auth::user()->name}}</h6>
                                                    <p class="text-muted">{{Auth::user()->email}}</p>
                                                    <a href="/logout" class="btn bg-secondary text-light text-uppercase w-100">خروج</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        <div class="menu-link flex-fill ">
                            <!-- Start:: users link -->
                            <div class="dropdown menu-apps users" >
                                <a href="{{route('users_list')}}" class="btn btn-link">
                                    <span>العملاء</span>
                                </a>
                            </div>
                    <!-- Start:: category link -->
                            <div class="dropdown menu-apps categories">
                                <a href="{{route('category_index')}}" class="btn btn-link">
                                    <span>التصنيفات</span>
                                </a>
                            </div>
                            <!-- Start:: products link -->
                            <div class="dropdown menu-apps products">
                                <a href="{{route('product_index')}}" class="btn btn-link ">
                                    <span>الاصناف</span>
                                </a>
                            </div>
                            <!-- Start:: orders link -->
                            <div class="dropdown menu-apps">
                                <a href="#" class="btn btn-link">
                                    <span>طلبات الشراء</span>
                                </a>
                            </div>
                            <!-- Start:: payment methods link -->
                            <div class="dropdown menu-apps payment_methods">
                                <a href="{{route('payment_method_index')}}" class="btn btn-link">
                                    <span>طرق الدفع</span>
                                </a>
                            </div>
                            <!-- Start:: shipping link -->
                            <div class="dropdown menu-apps shipping_fees">
                                <a href="{{route('shipping_fees_index')}}" class="btn btn-link">
                                    <span>الشحن</span>
                                </a>
                            </div>
                            <!-- Start:: company link -->
                            <div class="dropdown menu-apps company">
                                <a href="{{route('company_index')}}" class="btn btn-link" >
                                    <span>عن الشركة</span>
                                </a>
                            </div>
                            <!-- Start:: advertisment link -->
                            <div class="dropdown menu-apps advs">
                                <a href="{{route('adv_index')}}" class="btn btn-link">
                                    <span>اعلانات</span>
                                </a>
                            </div>
                            <!-- Start:: discount codes link -->
                            <div class="dropdown menu-apps discount_codes">
                                <a href="{{route('discount_codes_index')}}" class="btn btn-link">
                                    <span>اكواد الخصم</span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {{$slot}}
        </div>
        <script src="/assets/js/plugins.js"></script>
        <script src="/assets/js/theme.js"></script>
        <script src="/assets/js/bundle/apexcharts.bundle.js"></script>
        <script src="/assets/js/bundle/dataTables.bundle.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="/assets/scripts.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript" src="/assets/plugins/fancy-file-uploader/jquery.ui.widget.js"></script>
        <script type="text/javascript" src="/assets/plugins/fancy-file-uploader/jquery.fileupload.js"></script>
        <script type="text/javascript" src="/assets/plugins/fancy-file-uploader/jquery.iframe-transport.js"></script>
        <script type="text/javascript" src="/assets/plugins/fancy-file-uploader/jquery.fancy-fileupload.js"></script>
        @livewireScripts
    </body>
</html>