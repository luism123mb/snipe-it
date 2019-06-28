<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
      @section('title')
      @show
      :: {{ $snipeSettings->site_name }}
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url(asset('js/plugins/select2/select2.min.css')) }}">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ url(asset('js/plugins/iCheck/all.css')) }}">

    <!-- bootstrap tables CSS -->
    <link rel="stylesheet" href="{{ url(asset('css/bootstrap-table.css')) }}">

    <link rel="stylesheet" href="{{ url(mix('css/dist/all.css')) }}">

    <link rel="shortcut icon" type="image/ico" href="{{ url(asset('favicon.ico')) }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script nonce="{{ csrf_token() }}">
      window.Laravel = { csrfToken: '{{ csrf_token() }}' };

    </script>


      @if (($snipeSettings) && ($snipeSettings->skin!=''))
          <link rel="stylesheet" href="{{ url('css/skins/skin-'.$snipeSettings->skin) }}.css">
      @endif

    <style nonce="{{ csrf_token() }}">
        @if (($snipeSettings) && ($snipeSettings->header_color!=''))
        .main-header .navbar, .main-header .logo {
        background-color: {{ $snipeSettings->header_color }};
        background: -webkit-linear-gradient(top,  {{ $snipeSettings->header_color }} 0%,{{ $snipeSettings->header_color }} 100%);
        background: linear-gradient(to bottom, {{ $snipeSettings->header_color }} 0%,{{ $snipeSettings->header_color }} 100%);
        border-color: {{ $snipeSettings->header_color }};
        }
        .skin-blue .sidebar-menu > li:hover > a, .skin-blue .sidebar-menu > li.active > a {
          border-left-color: {{ $snipeSettings->header_color }};
        }

        .btn-primary {
          background-color: {{ $snipeSettings->header_color }};
          border-color: {{ $snipeSettings->header_color }};
        }
        @endif



    @media (max-width: 400px) {
      .navbar-left {
       margin: 2px;
      }

      .nav::after {
        clear: none;
      }
    }
    </style>

      @if (($snipeSettings) && ($snipeSettings->custom_css))
          <style>
              {!! $snipeSettings->show_custom_css() !!}
          </style>
      @endif

    <script nonce="{{ csrf_token() }}">
          window.snipeit = {
              settings: {
                  "per_page": {{ $snipeSettings->per_page }}
              }
          };
    </script>
    <!-- Add laravel routes into javascript  Primarily useful for vue.-->
    @routes
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>

      @if ($snipeSettings->load_remote=='1')
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js" integrity="sha384-qFIkRsVO/J5orlMvxK1sgAt2FXT67og+NyFTITYzvbIP1IJavVEKZM7YWczXkwpB" crossorigin="anonymous"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js" integrity="sha384-ZoaMbDF+4LeFxg6WdScQ9nnR1QC2MIRxA1O9KWEXQwns1G8UNyIEZIQidzb0T1fo" crossorigin="anonymous"></script>

       @else
            <script src="{{ url(asset('js/html5shiv.js')) }}" nonce="{{ csrf_token() }}"></script>
            <script src="{{ url(asset('js/respond.js')) }}" nonce="{{ csrf_token() }}"></script>
       @endif
       <![endif]-->
  </head>
  <body class="sidebar-mini skin-blue {{ (session('menu_state')!='open') ? 'sidebar-mini sidebar-collapse' : ''  }}">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->


        <!-- Header Navbar: style can be found in header.less -->
         
         <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button above the compact sidenav -->
          <a href="#" style="color: white" class="sidebar-toggle btn btn-white" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <ul class="nav navbar-nav navbar-left" >
              <li class="left-navblock" style="" > 
                 @if ($snipeSettings->brand == '3')
                      <a class="logo navbar-brand no-hover"  href="{{ url('/') }}">
                          @if ($snipeSettings->logo!='')
                          <img class="navbar-brand-img" style="  padding-top: 15px;" src="{{ url('/') }}/uploads/{{ $snipeSettings->logo }}">
                          @endif
                          {{ $snipeSettings->site_name }}
                      </a>
                  @elseif ($snipeSettings->brand == '2')
                      <a class="logo navbar-brand no-hover" href="{{ url('/') }}">
                          @if ($snipeSettings->logo!='')
                          <img class="navbar-brand-img"  style="  padding-top: 15px;" src="{{ url('/') }}/uploads/{{ $snipeSettings->logo }}">
                          @endif
                      </a> 
                  @else
                      <a class="logo no-hover" href="{{ url('/') }}">
                          {{ $snipeSettings->site_name }}
                      </a>
                  @endif     
                    
                  
              </li>
              <a href="#" style="float: right; padding: 20px; padding-right: 15%; color: #fff;" class="sidebar-toggle-mobile visible-xs btn" data-toggle="offcanvas" role="button"><span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i></a>
            </ul> 
             
              
              
             
    
              
             
             
             

          <!-- Navbar Right Menu -->
            <div class="hidden-xs  navbar-custom-menu"  >
              <ul class="nav navbar-nav">
                  @can('index', \App\Models\Asset::class)
<!--
                  <li {!! (Request::is('hardware*') ? ' class="active"' : '') !!}>
                      <a href="{{ url('hardware') }}">
                          <i class="fa fa-barcode"></i>
                      </a>
                  </li>

                  @endcan
                  @can('view', \App\Models\License::class)
                  <li {!! (Request::is('licenses*') ? ' class="active"' : '') !!}>
                      <a href="{{ route('licenses.index') }}">
                          <i class="fa fa-floppy-o"></i>
                      </a>
                  </li>
                  @endcan
                  @can('index', \App\Models\Accessory::class)
                  <li {!! (Request::is('accessories*') ? ' class="active"' : '') !!}>
                      <a href="{{ route('accessories.index') }}">
                          <i class="fa fa-keyboard-o"></i>
                      </a>
                  </li>
                  
                  @endcan
                  @can('index', \App\Models\Consumable::class)
                  <li {!! (Request::is('consumables*') ? ' class="active"' : '') !!}>
                      <a href="{{ url('consumables') }}">
                          <i class="fa fa-tint"></i>
                      </a>
                  </li>
                  @endcan
                  @can('view', \App\Models\Component::class)
                  <li {!! (Request::is('components*') ? ' class="active"' : '') !!}>
                      <a href="{{ route('components.index') }}">
                          <i class="fa fa-hdd-o"></i>
                      </a>
                  </li>
                  -->   
                  @endcan

                  @can('index', \App\Models\Asset::class)
                  
                   
                     <form class="  navbar-left form-horizontal" role="search" action="{{ route('findbytag/hardware') }}" method="get" style="padding-top: 10px;">
                      <div class=" col-xs-12 col-md-12" style="width: 84%;">
                          <div class="col-xs-12 form-group" >
                              <label class="sr-only" for="tagSearch">{{ trans('general.lookup_by_tag') }}</label>
                              <input type="text" class="form-control" id="tagSearch" name="assetTag" placeholder="{{ trans('general.lookup_by_tag') }}">
                              <input type="hidden" name="topsearch" value="true">
                          </div>
                          <div class="col-xs-1">
                              <button type="submit" class="btn btn-primary pull-right" style="background-color: #4a558b;

border-color: #fff;"><i class="fa fa-search"></i></button>
                          </div> 
                      </div>
                  </form>
                  @endcan
 
                  
                  @can('admin')
                  <li class="dropdown">
<!--
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      {{ trans('general.create') }}
                      <b class="caret"></b>
                    </a>
-->
                   <ul class="dropdown-menu">
                     @can('create', \App\Models\Asset::class)
                      <li {!! (Request::is('hardware/create') ? 'class="active>"' : '') !!}>
                              <a href="{{ route('hardware.create') }}">
                                  <i class="fa fa-barcode fa-fw"></i>
                                  {{ trans('general.asset') }}
                              </a>
                      </li>
                       @endcan
                       @can('create', \App\Models\License::class)
                       <li {!! (Request::is('licenses/create') ? 'class="active"' : '') !!}>
                           <a href="{{ route('licenses.create') }}">
                               <i class="fa fa-floppy-o fa-fw"></i>
                               {{ trans('general.license') }}
                           </a>
                       </li>
                       @endcan
                       @can('create', \App\Models\Accessory::class)
                       <li {!! (Request::is('accessories/create') ? 'class="active"' : '') !!}>
                           <a href="{{ route('accessories.create') }}">
                               <i class="fa fa-keyboard-o fa-fw"></i>
                               {{ trans('general.accessory') }}</a>
                       </li>
                       @endcan
                       @can('create', \App\Models\Consumable::class)
<!--
                       <li {!! (Request::is('consunmables/create') ? 'class="active"' : '') !!}>
                           <a href="{{ route('consumables.create') }}">
                               <i class="fa fa-tint fa-fw"></i>
                               {{ trans('general.consumable') }}
                           </a>
                       </li>
--> 
                       @endcan
                       @can('create', \App\Models\Component::class)
                       <li {!! (Request::is('components/create') ? 'class="active"' : '') !!}>
                           <a href="{{ route('components.create') }}">
                           <i class="fa fa-hdd-o fa-fw"></i>
                           {{ trans('general.component') }}
                           </a>
                       </li>
                       @endcan
                         @can('create', \App\Models\User::class)
                             <li {!! (Request::is('users/create') ? 'class="active"' : '') !!}>
                                 <a href="{{ route('users.create') }}">
                                     <i class="fa fa-user fa-fw"></i>
                                     {{ trans('general.user') }}
                                 </a>
                             </li>
                         @endcan
                   </ul>
                </li>
               @endcan

               


               <!-- User Account: style can be found in dropdown.less -->
              
@if (Auth::check())
               <li class="dropdown user user-menu">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                   @if (Auth::user()->present()->gravatar())
                       <img src="{{ Auth::user()->present()->gravatar() }}" class="user-image" alt="User Image">
                   @else
                      <i class="fa fa-user fa-fws"></i>
                   @endif

                   <span class="hidden-xs">{{ Auth::user()->first_name }} <b class="caret"></b></span>
                 </a>
                 <ul class="dropdown-menu">
                   <!-- User image -->
                     <li {!! (Request::is('account/profile') ? ' class="active"' : '') !!}>
                       <a href="{{ route('view-assets') }}">
                             <i class="fa fa-check fa-fw"></i>
                             {{ trans('general.viewassets') }}
                       </a></li>

                     <li {!! (Request::is('account/requested') ? ' class="active"' : '') !!}>
                         <a href="{{ route('account.requested') }}">
                             <i class="fa fa-check fa-disk fa-fw"></i>
                             Requested Assets
                         </a></li>




                     <li>
                          <a href="{{ route('profile') }}">
                             <i class="fa fa-user fa-fw"></i>
                              {{ trans('general.editprofile') }}
                         </a>
                     </li>
                     <li>
                         <a href="{{ route('account.password.index') }}">
                             <i class="fa fa-asterisk fa-fw"></i>
                             {{ trans('general.changepassword') }}
                         </a>
                     </li>



                     @can('self.api')
                     <li>
                         <a href="{{ route('user.api') }}">
                             <i class="fa fa-user-secret fa-fw"></i> Manage API Keys
                         </a>
                     </li>
                     @endcan
                     <li class="divider"></li>
                     <li>
                         <a href="{{ url('/logout') }}">
                             <i class="fa fa-sign-out fa-fw"></i>
                             {{ trans('general.logout') }}
                         </a>
                     </li>
                 </ul>
               </li>
               @endif

              
            </ul>
          </div>
      </nav>
      
<!--
       <a href="#" style="float:left" class="sidebar-toggle-mobile visible-xs btn" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <i class="fa fa-bars"></i>
      </a>
-->
       <!-- Sidebar toggle button-->
      </header>

      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
       
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
         
           
                     
       
          <ul class="sidebar-menu" style="padding-top: 0px;">
      <li class="visible-xs">
                  <a data-toggle="modal" data-target="#myModal">
                    <i class="fa fa-search"></i>
                    <span>Search</span>
                    
                  </a>
                  
                  
              </li>
              
              
          
             
              
              
              @can('superadmin')
               <li>
                   <a href="{{ route('settings.index') }}">
                       <i class="fa fa-cogs fa-fw"></i> <span>Settings</span>
                   </a>
               </li>
               @endcan
            @can('admin')
            
             <li {!! (\Request::route()->getName()=='home' ? ' class="active"' : '') !!}>
              <a href="{{ route('home') }}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            @endcan
            @can('index', \App\Models\Asset::class)
            <li class="treeview{{ (Request::is('hardware*') ? ' active' : '') }}">
                <a href="#"><i class="fa fa-barcode"></i>
                  <span>{{ trans('general.assets') }}</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{ url('hardware') }}">
                        {{ trans('general.list_all') }}
                    </a>
                  </li>

                    <?php $status_navs = \App\Models\Statuslabel::where('show_in_nav', '=', 1)->get(); ?>
                    @if (count($status_navs) > 0)
                        <li class="divider">&nbsp;</li>
                        @foreach ($status_navs as $status_nav)
                            <li><a href="{{ route('statuslabels.show', ['id' => $status_nav->id]) }}"}> {{ $status_nav->name }}</a></li>
                        @endforeach
                    @endif


                  <li{!! (Request::query('status') == 'Deployed' ? ' class="active"' : '') !!}>
                    <a href="{{ url('hardware?status=Deployed') }}"><i class="fa fa-circle-o text-blue"></i>
                        {{ trans('general.all') }}
                        {{ trans('general.deployed') }}
                    </a>
                  </li>
                  <li{!! (Request::query('status') == 'RTD' ? ' class="active"' : '') !!}>
                    <a href="{{ url('hardware?status=RTD') }}">
                        <i class="fa fa-circle-o text-green"></i>
                        {{ trans('general.all') }}
                        {{ trans('general.ready_to_deploy') }}
                    </a>
                  </li>
                  <li{!! (Request::query('status') == 'Pending' ? ' class="active"' : '') !!}><a href="{{ url('hardware?status=Pending') }}"><i class="fa fa-circle-o text-orange"></i>
                          {{ trans('general.all') }}
                          {{ trans('general.pending') }}
                      </a>
                  </li>
                  <li{!! (Request::query('status') == 'Undeployable' ? ' class="active"' : '') !!} ><a href="{{ url('hardware?status=Undeployable') }}"><i class="fa fa-times text-red"></i>
                          {{ trans('general.all') }}
                          {{ trans('general.undeployable') }}
                      </a>
                  </li>
                  <li{!! (Request::query('status') == 'Archived' ? ' class="active"' : '') !!}><a href="{{ url('hardware?status=Archived') }}"><i class="fa fa-times text-red"></i>
                          {{ trans('general.all') }}
                          {{ trans('admin/hardware/general.archived') }}
                          </a>
                  </li>
                    <li{!! (Request::query('status') == 'Requestable' ? ' class="active"' : '') !!}><a href="{{ url('hardware?status=Requestable') }}"><i class="fa fa-check text-blue"></i>
                        {{ trans('admin/hardware/general.requestable') }}
                        </a>
                    </li>

                  <li class="divider">&nbsp;</li>
                    @can('checkout', \App\Models\Asset::class)
                    <li{!! (Request::is('hardware/bulkcheckout') ? ' class="active>"' : '') !!}>
                        <a href="{{ route('hardware/bulkcheckout') }}">
                            {{ trans('general.bulk_checkout') }}
                        </a>
                    </li>
                    <li{!! (Request::is('hardware/requested') ? ' class="active>"' : '') !!}>
                        <a href="{{ route('assets.requested') }}">
                            {{ trans('general.requested') }}</a>
                    </li>
                    @endcan

                    @can('create', \App\Models\Asset::class)
                      <li{!! (Request::query('Deleted') ? ' class="active"' : '') !!}>
                          <a href="{{ url('hardware?status=Deleted') }}">
                              {{ trans('general.deleted') }}
                          </a>
                      </li>
                      <li>
                          <a href="{{ route('maintenances.index') }}">
                            {{ trans('general.asset_maintenances') }}
                          </a>
                      </li>
                      <li>
                          <a href="{{ url('hardware/history') }}">
                            {{ trans('general.import-history') }}
                          </a>
                      </li>
                    @endcan
                    @can('audit', \App\Models\Asset::class)
                        <li>
                            <a href="{{ route('assets.bulkaudit') }}">
                                {{ trans('general.bulkaudit') }}
                            </a>
                        </li>
                    @endcan
                </ul>
              </li>
              @endcan
              @can('view', \App\Models\License::class)
              <li{!! (Request::is('licenses*') ? ' class="active"' : '') !!}>
                  <a href="{{ route('licenses.index') }}">
                    <i class="fa fa-floppy-o"></i>
                    <span>{{ trans('general.licenses') }}</span>
                  </a>
              </li>
              @endcan
              @can('index', \App\Models\Accessory::class)
              <li{!! (Request::is('accessories*') ? ' class="active"' : '') !!}>
                <a href="{{ route('accessories.index') }}">
                  <i class="fa fa-keyboard-o"></i>
                  <span>{{ trans('general.accessories') }}</span>
                </a>
              </li>
              @endcan
              @can('view', \App\Models\Consumable::class)
            <li{!! (Request::is('consumables*') ? ' class="active"' : '') !!}>
                <a href="{{ url('consumables') }}">
                  <i class="fa fa-tint"></i>
                  <span>{{ trans('general.consumables') }}</span>
                </a>
            </li>
             @endcan
             @can('view', \App\Models\Component::class)
            <li{!! (Request::is('components*') ? ' class="active"' : '') !!}>
                <a href="{{ route('components.index') }}">
                  <i class="fa fa-hdd-o"></i>
                  <span>{{ trans('general.components') }}</span>
                </a>
            </li>
            @endcan
            @can('view', \App\Models\User::class)
            <li{!! (Request::is('users*') ? ' class="active"' : '') !!}>
                  <a href="{{ route('users.index') }}">
                      <i class="fa fa-users"></i>
                      <span>{{ trans('general.people') }}</span>
                  </a>
            </li>
            @endcan
            @can('import')
                <li{!! (Request::is('import/*') ? ' class="active"' : '') !!}>
                    <a href="{{ route('imports.index') }}">
                        <i class="fa fa-cloud-download"></i>
                        <span>{{ trans('general.import') }}</span>
                    </a>
                </li>
            @endcan

            @can('backend.interact')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-gear"></i>
                        <span>{{ trans('general.settings') }}</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu">
                        @if(Gate::allows('view', App\Models\CustomField::class) || Gate::allows('view', App\Models\CustomFieldset::class))
                            <li {!! (Request::is('fields*') ? ' class="active"' : '') !!}>
                                <a href="{{ route('fields.index') }}">
                                    {{ trans('admin/custom_fields/general.custom_fields') }}
                                </a>
                            </li>
                        @endif

                        @can('view', \App\Models\Statuslabel::class)
                            <li {!! (Request::is('statuslabels*') ? ' class="active"' : '') !!}>
                                <a href="{{ route('statuslabels.index') }}">
                                    {{ trans('general.status_labels') }}
                                </a>
                            </li>
                        @endcan

                        @can('view', \App\Models\AssetModel::class)
                            <li>
                                <a href="{{ route('models.index') }}" {{ (Request::is('/assetmodels') ? ' class="active"' : '') }}>
                                    {{ trans('general.asset_models') }}
                                </a>
                            </li>
                        @endcan


                        @can('view', \App\Models\Category::class)
                            <li>
                                <a href="{{ route('categories.index') }}" {{ (Request::is('/categories') ? ' class="active"' : '') }}>
                                    {{ trans('general.categories') }}
                                </a>
                            </li>
                        @endcan

                        @can('view', \App\Models\Manufacturer::class)
                            <li>
                                <a href="{{ route('manufacturers.index') }}" {{ (Request::is('/manufacturers') ? ' class="active"' : '') }}>
                                    {{ trans('general.manufacturers') }}
                                </a>
                            </li>
                        @endcan

                        @can('view', \App\Models\Supplier::class)
                            <li>
                                <a href="{{ route('suppliers.index') }}" {{ (Request::is('/suppliers') ? ' class="active"' : '') }}>
                                    {{ trans('general.suppliers') }}
                                </a>
                            </li>
                        @endcan

                        @can('view', \App\Models\Department::class)
                            <li>
                                <a href="{{ route('departments.index') }}" {{ (Request::is('/departments') ? ' class="active"' : '') }}>
                                    {{ trans('general.departments') }}
                                </a>
                            </li>
                        @endcan

                        @can('view', \App\Models\Location::class)
                            <li>
                                <a href="{{ route('locations.index') }}" {{ (Request::is('/locations') ? ' class="active"' : '') }}>
                                    {{ trans('general.locations') }}
                                </a>
                            </li>
                        @endcan

                        @can('view', \App\Models\Company::class)
                            <li>
                                <a href="{{ route('companies.index') }}" {{ (Request::is('/companies') ? ' class="active"' : '') }}>
                                    {{ trans('general.companies') }}
                                </a>
                            </li>
                        @endcan

                        @can('view', \App\Models\Depreciation::class)
                            <li>
                                <a href="{{ route('depreciations.index') }}" {{ (Request::is('/depreciations') ? ' class="active"' : '') }}>
                                    {{ trans('general.depreciation') }}
                                </a>
                            </li>
                        @endcan

                    </ul>

                </li>
            @endcan

            @can('reports.view')
            <li class="treeview{{ (Request::is('reports*') ? ' active' : '') }}">
                <a href="#"  class="dropdown-toggle">
                    <i class="fa fa-bar-chart"></i>
                    <span>{{ trans('general.reports') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('reports.activity') }}" {{ (Request::is('reports/activity') ? ' class="active"' : '') }}>
                            {{ trans('general.activity_report') }}
                        </a>
                    </li>

                    <li><a href="{{ route('reports.audit') }}" {{ (Request::is('reports.audit') ? ' class="active"' : '') }}>
                            {{ trans('general.audit_report') }}</a>
                    </li>
                    <li>
                        <a href="{{ url('reports/depreciation') }}" {{ (Request::is('reports/depreciation') ? ' class="active"' : '') }}>
                            {{ trans('general.depreciation_report') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('reports/licenses') }}" {{ (Request::is('reports/licenses') ? ' class="active"' : '') }}>
                            {{ trans('general.license_report') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('reports/asset_maintenances') }}" {{ (Request::is('reports/asset_maintenances') ? ' class="active"' : '') }}>
                            {{ trans('general.asset_maintenance_report') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('reports/unaccepted_assets') }}" {{ (Request::is('reports/unaccepted_assets') ? ' class="active"' : '') }}>
                            {{ trans('general.unaccepted_asset_report') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('reports/accessories') }}" {{ (Request::is('reports/accessories') ? ' class="active"' : '') }}>
                            {{ trans('general.accessory_report') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('reports/custom') }}" {{ (Request::is('reports/custom') ? ' class="active"' : '') }}>
                            {{ trans('general.custom_report') }}
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            @can('viewRequestable', \App\Models\Asset::class)
            <li{!! (Request::is('account/requestable-assets') ? ' class="active"' : '') !!}>
            <a href="{{ route('requestable-assets') }}">
            <i class="fa fa-laptop"></i>
            <span>{{ trans('admin/hardware/general.requestable') }}</span>
            </a>
            </li>
            
            @endcan
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->

      <div class="content-wrapper">

          @if ($debug_in_production)
              <div class="row" style="margin-bottom: 0px; background-color: red; color: white; font-size: 15px;">
                  <div class="col-md-12" style="margin-bottom: 0px; background-color: #b50408 ; color: white; padding: 10px 20px 10px 30px; font-size: 16px;">
                      <i class="fa fa-warning fa-3x pull-left"></i> <strong>{{ strtoupper(trans('general.debug_warning')) }}:</strong>
                      {!! trans('general.debug_warning_text') !!}
                  </div>
              </div>
      @endif

        <!-- Content Header (Page header) -->
        <section class="content-header" style="padding-bottom: 30px; padding-top: 20px;">
          <h1 class="pull-left">
            @yield('title')


          </h1>
          <div class="pull-right">
            @yield('header_right')
          </div>



        </section>


        <section class="content">
          <!-- Notifications -->
          <div class="row">
              @if (config('app.lock_passwords'))
                  <div class="col-md-12">
                      <div class="callout callout-info">
                          {{ trans('general.some_features_disabled') }}
                      </div>
                  </div>
              @endif

          @include('notifications')
          </div>


          <!-- Content -->
            <div id="{!! (Request::is('*api*') ? 'app' : 'webui') !!}">
          @yield('content')
            </div>

        </section>

      </div><!-- /.content-wrapper -->

      <footer class="main-footer hidden-print">

      </footer>



    </div><!-- ./wrapper -->


    <!-- end main container -->

    <div class="modal  modal-danger fade" id="dataConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                <form method="post" id="deleteForm" role="form">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type="button" class="btn btn-default  pull-left" data-dismiss="modal">{{ trans('general.cancel') }}</button>
                    <button type="submit" class="btn btn-outline" id="dataConfirmOK">{{ trans('general.yes') }}</button>
                </form>
                </div>
            </div>
        </div>
    </div>



    <script src="{{ url(mix('js/dist/all.js')) }}" nonce="{{ csrf_token() }}"></script>

    @section('moar_scripts')
    @show

    <script nonce="{{ csrf_token() }}">
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
            $('.select2 span').addClass('needsclick');

            // This javascript handles saving the state of the menu (expanded or not)
            $('body').bind('expanded.pushMenu', function() {
                $.ajax({
                    type: 'GET',
                    url: "{{ route('account.menuprefs', ['state'=>'open']) }}",
                    _token: "{{ csrf_token() }}"
                });

            });

            $('body').bind('collapsed.pushMenu', function() {
                $.ajax({
                    type: 'GET',
                    url: "{{ route('account.menuprefs', ['state'=>'close']) }}",
                    _token: "{{ csrf_token() }}"
                });
            });

        });

        // Initiate the ekko lightbox
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });



    </script>

    @if ((Session::get('topsearch')=='true') || (Request::is('/')))
    <script nonce="{{ csrf_token() }}">
         $("#tagSearch").focus();
    </script>
    @endif

<!-- Modal -->
  <div class="modal fade" style="background: #32374f;" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        
        <div class="modal-body" style="height: 85px;
">
          
                     <form class="  navbar-left form-horizontal" role="search" action="{{ route('findbytag/hardware') }}" method="get" style="padding-top: 10px;">
                      <div class=" col-xs-12 col-md-12" style="width: 100%;">
                          <div class="col-xs-12 form-group" >
                              <label class="sr-only" for="tagSearch">{{ trans('general.lookup_by_tag') }}</label>
                              <input type="text" class="form-control" id="tagSearch" name="assetTag" placeholder="{{ trans('general.lookup_by_tag') }}">
                              <input type="hidden" name="topsearch" value="true">
                          </div>
                          <div class="col-xs-1">
                              <button type="submit" class="btn btn-primary pull-right" style="background-color: #4a558b;

border-color: #fff;"><i class="fa fa-search"></i></button>
                          </div> 
                      </div>
                  </form>
        </div>
        
      </div>
    </div>
  </div>

  </body>
</html>