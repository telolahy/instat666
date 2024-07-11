<!DOCTYPE html>
<html lang="en">

<head>
    <title>Fichier Etablissement</title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Gradient Able Bootstrap admin template made using Bootstrap 4. The starter version of Gradient Able is completely free for personal project." />
    <meta name="keywords" content="free dashboard template, free admin, free bootstrap template, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="codedthemes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('assets/images/favicon.ico" type="image/x-icon')}}">
    <!-- Google font-->
    {{-- <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet"> --}}
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/google_font.css')}}">
    <!-- Chart font-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/chart_font.css')}}">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap/css/bootstrap.min.css')}}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/icon/themify-icons/themify-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/icon/font-awesome/css/font-awesome.min.css')}}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/icon/icofont/css/icofont.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/pages/notification/notification.css')}}">
    <!-- Animate.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/animate.css/css/animate.css')}}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/chartist/chartist.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery.mCustomScrollbar.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/select2/css/select2.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/select2/css/select2.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('gstatic/44/css/util/util.css')}}">
    <style>
        #logo {
            max-width: 70px;
            max-height: 70px;
        }

        #profil {
            max-width: 80px;
            max-height: 80px;
        }

        .navbar-logo{
            justify-content: center;
        }
        .btn-label-only {
            background-color: transparent;
            border: none;
            box-shadow: none;
            padding: 0;
            color: inherit;
            font-size: inherit;
        }
        .btn-label-only:hover,
        .btn-label-only:focus {
            background-color: transparent;
            box-shadow: none;
        }
    </style>
</head>

<body>

    <body>
        <!-- Pre-loader start -->
        <div class="theme-loader">
            <div class="loader-track">
                <div class="loader-bar"></div>
            </div>
        </div>
        <!-- Pre-loader end -->
        <div id="pcoded" class="pcoded">
            <div class="pcoded-overlay-box"></div>
            <div class="pcoded-container navbar-wrapper">

                <nav class="navbar header-navbar pcoded-header">
                    <div class="navbar-wrapper">
                        <div class="navbar-logo">
                            <a class="mobile-menu" id="mobile-collapse" href="#!">
                                <i class="ti-menu"></i>
                            </a>
                            <a href="{{url('https://www.instat.mg/')}}" target="blank" id='logo'>
                                <img class="img-fluid" src="{{asset('assets/images/logo.png')}}" alt="Theme-Logo" />
                            </a>
                            <a class="mobile-options">
                                <i class="ti-more"></i>
                            </a>
                        </div>

                        <div class="navbar-container container-fluid">
                            <ul class="nav-left">
                                <li>
                                    <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                                </li>
                                <li>
                                    <a href="#!" onclick="javascript:toggleFullScreen()">
                                        <i class="ti-fullscreen"></i>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav-right">
                                {{-- <li class="header-notification">
                               <a href="#!">
                                   <i class="ti-bell"></i>
                                   <span class="badge bg-c-pink"></span>
                               </a>
                               <ul class="show-notification">
                                   <li>
                                       <h6>Notifications</h6>
                                       <label class="label label-danger">New</label>
                                   </li>
                                   <li>
                                       {{-- <div class="media">
                                           <img class="d-flex align-self-center img-radius" src="assets/images/avatar-3.jpg" alt="Generic placeholder image">
                                           <div class="media-body">
                                               <h5 class="notification-user">Sara Soudein</h5>
                                               <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                               <span class="notification-time">30 minutes ago</span>
                                           </div>
                                       </div> 
                                   </li>
                               </ul>
                           </li> --}}

                                <li class="user-profile header-notification">
                                    <a href="#!">
                                        <img id="profil" src="assets/images/auth/{{auth()->user()->image}}" class="img-radius" alt="User-Profile-Image">
                                        <span>{{auth()->user()->name}} </span>
                                        <i class="ti-angle-down"></i>
                                    </a>
                                    <ul class="show-notification profile-notification list-unstyled">
                                        <li>
                                            <a href="{{URL::to('/profile')}}">
                                                <i class="ti-user"></i> Profile
                                            </a>
                                        </li>
                                        <li>
                                            
                                                <form action="{{route('logout')}}" method="post" id="logout_form">
                                                    {{@csrf_field()}}
                                                    <button  class="btn btn-label-only w-100 text-left" type="submit"><i class="ti-layout-sidebar-left"></i> Logout</button>
                                                </form>
                                                
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                        <nav class="pcoded-navbar">
                            <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>

                            @if (auth()->user()->role == "saisisseur")

                                <div class="pcoded-inner-navbar main-menu">
                                    {{-- <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation"></div> --}}
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="{{(request()->is('home')? 'active' : '')}}">
                                            <a href={{URL::to('/home')}}>
                                                <span class="pcoded-micon"><i class="ti-home"></i><b></b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.main">Acueil</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="pcoded-navigatio-lavel" data-i18n="nav.category.forms"></div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="pcoded-hasmenu ">
                                            <a href="javascript:void(0)">
                                                <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b></b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.menu-levels.main">Propietaire / <br> Etablissement</span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class="pcoded-hasmenu ">
                                                    <a href="javascript:void(0)">
                                                        <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                                                        <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main">Ajout</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                    <ul class="pcoded-submenu">
                                                        {{-- <li class="{{(request()->is('list_com_prop')? 'active' : '')}}"> --}}
                                                        <li>
                                                            <a href="{{route('ajout_saisisseur.index')}}">
                                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                                <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">Nouveau Proprietaire / Etablissement</span>
                                                                <span class="pcoded-mcaret"></span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <ul class="pcoded-submenu">
                                                        {{-- <li class="{{(request()->is('list_proprietaire')? 'active' : '')}}"> --}}
                                                            <li>
                                                            <a href="{{route('ajout_saisisseur_Existant.index')}}">
                                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                                <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">Déja une autre Entreprise</span>
                                                                <span class="pcoded-mcaret"></span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="#">
                                                    <a href={{URL::to('/saisie')}}>
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-23">Modification</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                                <li class="pcoded-hasmenu ">
                                                    <a href="javascript:void(0)">
                                                        <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                                                        <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main">Mutation</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                    <ul class="pcoded-submenu">
                                                        <li class="{{(request()->is('list_mutation')? 'active' : '')}}">
                                                            <a href={{URL::to('/mutation')}}>
                                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                                <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">Mutation à un Nouveau Proprietaire</span>
                                                                <span class="pcoded-mcaret"></span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <ul class="pcoded-submenu">
                                                        <li class="{{(request()->is('list_mutation_proprio_exist')? 'active' : '')}}">
                                                            <a href={{URL::to('/mutation_existant')}}>
                                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                                <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">Mutation à un Proprietaire existant</span>
                                                                <span class="pcoded-mcaret"></span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            @elseif(auth()->user()->role == "admin_par_region")
                            <div class="pcoded-inner-navbar main-menu">

                                {{-- <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Menu</div> --}}
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="{{(request()->is('home')? 'active' : '')}}">
                                        <a href={{URL::to('/home')}}>
                                            <span class="pcoded-micon"><i class="ti-home"></i><b></b></span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Acueil</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="pcoded-navigatio-lavel" data-i18n="nav.category.forms"></div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="pcoded-hasmenu ">
                                        <a href="javascript:void(0)">
                                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b></b></span>
                                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.main">Propietaire / <br> Etablissement</span>
                                        </a>
                                <ul class="pcoded-submenu">
                                            
                                <li class="{{(request()->is('list_etablissement')? 'active' : '')}}">
                                    {{-- <a href={{URL::to('/list_etablissement')}}> --}}
                                    <a href="{{route('reg_etab.index')}}">
                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-23">Liste des établissements</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="pcoded-hasmenu ">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main">Ajout</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="{{(request()->is('list_com_prop')? 'active' : '')}}">
                                            <a href="{{route('ajout_admin_reg_ft')}}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">Nouveau Proprietaire / Etablissement</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="pcoded-submenu">
                                        <li class="{{(request()->is('list_proprietaire')? 'active' : '')}}">
                                            <a href="{{route('add_reg_existant.index')}}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">Déja une autre Entreprise</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="{{(request()->is('list_modif_proprio_etablissement')? 'active' : '')}}">
                                    <a href="{{route('reg_modification.index')}}">
                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-23">Modification</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="pcoded-hasmenu ">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main">Mutation</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="{{(request()->is('list_mutation')? 'active' : '')}}">
                                            <a href="{{route('reg_mutation.index')}}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">Mutation à un Nouveau Proprietaire</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="pcoded-submenu">
                                        <li class="{{(request()->is('list_mutation_proprio_exist')? 'active' : '')}}">
                                            <a href={{route('admin_reg_mutation_existant.index')}}>
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">Mutation à un Proprietaire existant</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="{{(request()->is('list_annulation_etablissement')? 'active' : '')}}">
                                    <a href={{URL::to('/list_annulation_etablissement')}}>
                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-23">Annulation</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="{{(request()->is('list_reprise_etablissement')? 'active' : '')}}">
                                    <a href={{URL::to('/list_reprise_etablissement')}}>
                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-23">Reprise</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                </ul>
                                </li>
                                </ul>
                                {{-- <br> --}}

                                {{-- <div class="pcoded-navigatio-lavel" data-i18n="nav.category.forms"></div> --}}
                                {{-- <ul class="pcoded-item pcoded-left-item">
                                    <li class="pcoded-hasmenu">
                                        <a href="javascript:void(0)">
                                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Activité</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="{{(request()->is('form_activite')? 'active' : '')}}">
                                                <a href={{URL::to('/form_activite')}}>
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Nouvelle activité</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                            <li class="{{(request()->is('list_activite')? 'active' : '')}}">
                                                <a href={{URL::to('/list_activite')}}>
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Liste des Activités</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <div class="pcoded-navigatio-lavel" data-i18n="nav.category.forms"></div>
                                    <li class="pcoded-hasmenu">
                                        <a href="javascript:void(0)">
                                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Forme Juridique</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="{{(request()->is('form_juridique')? 'active' : '')}}">
                                                <a href={{URL::to('/form_juridique')}}>
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Nouvelle Forme Juridique</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                            <li class="{{(request()->is('list_juridique')? 'active' : '')}}">
                                                <a href={{URL::to('/list_juridique')}}>
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">liste des Formes Juridiques</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul> --}}

                                {{-- <div class="pcoded-navigatio-lavel" data-i18n="nav.category.other"></div> --}}
                                {{-- <ul class="pcoded-item pcoded-left-item">
                                    <li class="pcoded-hasmenu">
                                        <a href="javascript:void(0)">
                                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">LChef</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="{{(request()->is('form_lchef')? 'active' : '')}}">
                                                <a href={{URL::to('/form_lchef')}}>
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Nouvel Lchef</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                            <li class="{{(request()->is('list_lchef')? 'active' : '')}}">
                                                <a href={{URL::to('/list_lchef')}}>
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Liste des Lchefs</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul> --}}

                                {{-- <div class="pcoded-navigatio-lavel" data-i18n="nav.category.other"></div> --}}
                                {{-- <ul class="pcoded-item pcoded-left-item">
                                    <li class="pcoded-hasmenu">
                                        <a href="javascript:void(0)">
                                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Commune</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="{{(request()->is('form_commune')? 'active' : '')}}">
                                                <a href={{URL::to('/form_commune')}}>
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Nouvelle Commune</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                            <li class="{{(request()->is('list_commune')? 'active' : '')}}">
                                                <a href={{URL::to('/list_commune')}}>
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Liste des Communes</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul> --}}
                                {{-- <div class="pcoded-navigatio-lavel" data-i18n="nav.category.other"></div> --}}
                                {{-- <ul class="pcoded-item pcoded-left-item">
                                    <li class="pcoded-hasmenu">
                                        <a href="javascript:void(0)">
                                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Fokontany</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="{{(request()->is('form_fokontany')? 'active' : '')}}">
                                                <a href={{URL::to('/form_fokontany')}}>
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Nouvel Fokontany</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                            <li class="{{(request()->is('list_fokontany')? 'active' : '')}}">
                                                <a href={{URL::to('/list_fokontany')}}>
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Liste des Fokontany</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul> --}}

                                {{-- <div class="pcoded-navigatio-lavel" data-i18n="nav.category.other"></div> --}}
                                {{-- <ul class="pcoded-item pcoded-left-item">
                                    <li class="pcoded-hasmenu">
                                        <a href="javascript:void(0)">
                                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Nationalité</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="{{(request()->is('form_nationalite')? 'active' : '')}}">
                                                <a href={{URL::to('/form_nationalite')}}>
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Nouvel Nationalité</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                            <li class="{{(request()->is('list_nationalite')? 'active' : '')}}">
                                                <a href={{URL::to('/list_nationalite')}}>
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Liste des Nationalités</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul> --}}

                                {{-- <div class="pcoded-navigatio-lavel" data-i18n="nav.category.other"></div> --}}
                                <ul class="pcoded-item pcoded-left-item mt-5">
                                    <li class="pcoded-hasmenu">
                                        <a href="javascript:void(0)">
                                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Utilisateur</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="{{(request()->is('form_user')? 'active' : '')}}">
                                                <a href={{URL::to('/form_user')}}>
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Nouvel utilisateur</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                            <li class="{{(request()->is('list_user')? 'active' : '')}}">
                                                <a href={{URL::to('/list_user')}}>
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Liste des utilisateurs</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                {{-- <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation"></div> --}}
                                <ul class="pcoded-item pcoded-left-item mt-5">
                                    <li class="">
                                        <a href={{URL::to('/list_etab_certificat')}}>
                                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b></b></span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Obtenir de certificat d'existence</span>
                                        </a>
                                    </li>
                                </ul>
                                {{-- <br> --}}
                                {{-- <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation"></div> --}}
                                {{-- <ul class="pcoded-item pcoded-left-item">
                                    <li class="">
                                        <a href={{URL::to('/form_export_data')}}>
                                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b></b></span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Exporter des données <br> en Excel</span>
                                        </a>
                                    </li>
                                </ul> --}}
                                {{-- <br> --}}
                                {{-- <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation"></div> --}}
                                {{-- <ul class="pcoded-item pcoded-left-item">
                                    <li class="">
                                        <a href={{URL::to('/form_import_data')}}>
                                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b></b></span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Importer des données <br> en Excel</span>
                                        </a>
                                    </li>
                                </ul> --}}
                                {{-- <br> --}}
                                {{-- <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation"></div> --}}
                                <ul class="pcoded-item pcoded-left-item mt-5">
                                    <li class="pcoded-hasmenu">
                                        <a href="javascript:void(0)">
                                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Graphique</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="{{(request()->is('statistique')? 'active' : '')}}">
                                                <a href={{URL::to('/statistique')}}>
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Graphique du nombre d'établissement enregistré par mois</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                            <li class="{{(request()->is('statistique_quittance')? 'active' : '')}}">
                                                <a href={{URL::to('/statistique_quittance')}}>
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Graphique du nombre du quittance enregistré par type</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            @else

                                <div class="pcoded-inner-navbar main-menu">

                                    {{-- <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Menu</div> --}}
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="{{(request()->is('home')? 'active' : '')}}">
                                            <a href={{URL::to('/home')}}>
                                                <span class="pcoded-micon"><i class="ti-home"></i><b></b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.main">Acueil</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="pcoded-navigatio-lavel" data-i18n="nav.category.forms"></div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="pcoded-hasmenu ">
                                            <a href="javascript:void(0)">
                                                <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b></b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.menu-levels.main">Propietaire / <br> Etablissement</span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                {{-- <li class="pcoded-hasmenu ">
                                                <a href="javascript:void(0)">
                                                    <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main">Ajout</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                                <ul class="pcoded-submenu">
                                                    <li class="{{(request()->is('list_com_prop')? 'active' : '')}}">
                                                <a href={{URL::to('/list_com_prop')}}>
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">Nouveau Proprietaire / Etablissement</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                        </li>
                                    </ul>
                                    <ul class="pcoded-submenu">
                                        <li class="{{(request()->is('list_proprietaire')? 'active' : '')}}">
                                            <a href={{URL::to('/list_proprietaire')}}>
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">Déja une autre Entreprise</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                                    </li> --}}
                                    <li class="{{(request()->is('list_etablissement')? 'active' : '')}}">
                                        <a href={{URL::to('/list_etablissement')}}>
                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-23">Liste des établissements</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                    <li class="{{(request()->is('list_modif_proprio_etablissement')? 'active' : '')}}">
                                        <a href={{URL::to('/list_modif_proprio_etablissement')}}>
                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-23">Modification</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                    <li class="pcoded-hasmenu ">
                                        <a href="javascript:void(0)">
                                            <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main">Mutation</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="{{(request()->is('list_mutation')? 'active' : '')}}">
                                                <a href={{URL::to('/list_mutation')}}>
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">Mutation à un Nouveau Proprietaire</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                        </ul>
                                        <ul class="pcoded-submenu">
                                            <li class="{{(request()->is('list_mutation_proprio_exist')? 'active' : '')}}">
                                                <a href={{URL::to('/list_mutation_proprio_exist')}}>
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">Mutation à un Proprietaire existant</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="{{(request()->is('list_annulation_etablissement')? 'active' : '')}}">
                                        <a href={{URL::to('/list_annulation_etablissement')}}>
                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-23">Annulation</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                    <li class="{{(request()->is('list_reprise_etablissement')? 'active' : '')}}">
                                        <a href={{URL::to('/list_reprise_etablissement')}}>
                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-23">Reprise</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>

                                    </ul>
                                    </li>
                                    </ul>
                                    <br>

                                    <div class="pcoded-navigatio-lavel" data-i18n="nav.category.forms"></div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="pcoded-hasmenu">
                                            <a href="javascript:void(0)">
                                                <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Activité</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class="{{(request()->is('form_activite')? 'active' : '')}}">
                                                    <a href={{URL::to('/form_activite')}}>
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Nouvelle activité</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                                <li class="{{(request()->is('list_activite')? 'active' : '')}}">
                                                    <a href={{URL::to('/list_activite')}}>
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Liste des Activités</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.forms"></div>
                                        <li class="pcoded-hasmenu">
                                            <a href="javascript:void(0)">
                                                <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Forme Juridique</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class="{{(request()->is('form_juridique')? 'active' : '')}}">
                                                    <a href={{URL::to('/form_juridique')}}>
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Nouvelle Forme Juridique</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                                <li class="{{(request()->is('list_juridique')? 'active' : '')}}">
                                                    <a href={{URL::to('/list_juridique')}}>
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">liste des Formes Juridiques</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>

                                    <div class="pcoded-navigatio-lavel" data-i18n="nav.category.other"></div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="pcoded-hasmenu">
                                            <a href="javascript:void(0)">
                                                <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">LChef</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class="{{(request()->is('form_lchef')? 'active' : '')}}">
                                                    <a href={{URL::to('/form_lchef')}}>
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Nouvel Lchef</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                                <li class="{{(request()->is('list_lchef')? 'active' : '')}}">
                                                    <a href={{URL::to('/list_lchef')}}>
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Liste des Lchefs</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>

                                    <div class="pcoded-navigatio-lavel" data-i18n="nav.category.other"></div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="pcoded-hasmenu">
                                            <a href="javascript:void(0)">
                                                <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Commune</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class="{{(request()->is('form_commune')? 'active' : '')}}">
                                                    <a href={{URL::to('/form_commune')}}>
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Nouvelle Commune</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                                <li class="{{(request()->is('list_commune')? 'active' : '')}}">
                                                    <a href={{URL::to('/list_commune')}}>
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Liste des Communes</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <div class="pcoded-navigatio-lavel" data-i18n="nav.category.other"></div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="pcoded-hasmenu">
                                            <a href="javascript:void(0)">
                                                <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Fokontany</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class="{{(request()->is('form_fokontany')? 'active' : '')}}">
                                                    <a href={{URL::to('/form_fokontany')}}>
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Nouvel Fokontany</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                                <li class="{{(request()->is('list_fokontany')? 'active' : '')}}">
                                                    <a href={{URL::to('/list_fokontany')}}>
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Liste des Fokontany</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>

                                    <div class="pcoded-navigatio-lavel" data-i18n="nav.category.other"></div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="pcoded-hasmenu">
                                            <a href="javascript:void(0)">
                                                <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Nationalité</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class="{{(request()->is('form_nationalite')? 'active' : '')}}">
                                                    <a href={{URL::to('/form_nationalite')}}>
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Nouvel Nationalité</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                                <li class="{{(request()->is('list_nationalite')? 'active' : '')}}">
                                                    <a href={{URL::to('/list_nationalite')}}>
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Liste des Nationalités</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>

                                    <div class="pcoded-navigatio-lavel" data-i18n="nav.category.other"></div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="pcoded-hasmenu">
                                            <a href="javascript:void(0)">
                                                <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Utilisateur</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class="{{(request()->is('form_user')? 'active' : '')}}">
                                                    <a href={{URL::to('/form_user')}}>
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Nouvel utilisateur</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                                <li class="{{(request()->is('list_user')? 'active' : '')}}">
                                                    <a href={{URL::to('/list_user')}}>
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Liste des utilisateurs</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation"></div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="">
                                            <a href={{URL::to('/list_etab_certificat')}}>
                                                <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b></b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.main">Obtenir de certificat d'existence</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <br>
                                    <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation"></div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="">
                                            <a href={{URL::to('/form_export_data')}}>
                                                <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b></b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.main">Exporter des données <br> en Excel</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <br>
                                    <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation"></div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="">
                                            <a href={{URL::to('/form_import_data')}}>
                                                <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b></b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.main">Importer des données <br> en Excel</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <br>
                                    <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation"></div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="pcoded-hasmenu">
                                            <a href="javascript:void(0)">
                                                <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Graphique</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class="{{(request()->is('statistique')? 'active' : '')}}">
                                                    <a href={{URL::to('/statistique')}}>
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Graphique du nombre d'établissement enregistré par mois</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                                <li class="{{(request()->is('statistique_quittance')? 'active' : '')}}">
                                                    <a href={{URL::to('/statistique_quittance')}}>
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Graphique du nombre du quittance enregistré par type</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>

                            @endif

                        </nav>
                        <div class="pcoded-content">
                            <div class="pcoded-inner-content">
                                <div class="main-body">
                                    <div class="page-wrapper">

                                        <div class="page-body">
                                            <div class="row">
                                                @yield('contenu')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script type="text/javascript" src="{{asset('assets/js/jquery/jquery.min.js')}}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="{{asset('assets/js/jquery-ui/jquery-ui.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/popper.js/popper.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/bootstrap/js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/bootstrap-growl.min.js')}}"></script>
        <!-- jquery slimscroll js -->
        <script type="text/javascript" src="{{asset('assets/js/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
        <!-- modernizr js -->
        <script type="text/javascript" src="{{asset('assets/js/modernizr/modernizr.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/modernizr/css-scrollbars.js')}}"></script>
        <!-- am chart -->
        <script src="{{asset('assets/pages/widget/amchart/amcharts.min.js')}}"></script>
        <script src="{{asset('assets/pages/widget/amchart/serial.min.js')}}"></script>
        <!-- Morris Chart js  -->
        <script src="{{asset('assets/js/raphael/raphael.min.js')}}"></script>
        <script src="{{asset('assets/js//morris.js/morris.js')}}"></script>
        <!-- Chart js -->
        <script type="text/javascript" src="{{asset('assets/js/chart.js/Chart.js')}}"></script>
        <!-- Todo js -->
        <script type="text/javascript " src="{{asset('assets/pages/todo/todo.js ')}}"></script>
        <!-- Custom js -->
        <script type="text/javascript" src="{{asset('assets/pages/dashboard/custom-dashboard.min.js')}}"></script>

        <script type="text/javascript " src="{{asset('assets/js/SmoothScroll.js')}}"></script>
        <script src="{{asset('assets/js/pcoded.min.js')}}"></script>
        <script src="{{asset('assets/js/vartical-demo.js')}}"></script>
        <script src="{{asset('assets/js/bootbox.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
        <script type="text/javascript " src="{{asset('assets/js/script.js')}}"></script>

        <!-- notification js -->
        <script type="text/javascript" src="{{asset('assets/pages/notification/notification.js')}}"></script>

        <script src="{{ asset('assets/quicksearch/jquery.quicksearch.js') }}"></script>

        <script src="{{ asset('assets/select2/js/select2.min.js') }}"></script>

        <script src="{{ asset('assets/select2/js/select2.js') }}"></script>

        <script src="{{ asset('assets/amChart/core.js') }}"></script>

        <script src="{{ asset('assets/amChart/charts.js') }}"></script>

        <script src="{{ asset('assets/amChart/animated.js') }}"></script>

        <script type="text/javascript" src="{{asset('assets/js/loader.js')}}"></script>


        <script src="{{asset('js/activite.js')}}"></script>
        <script src="{{asset('js/juridique.js')}}"></script>
        <script src="{{asset('js/lchef.js')}}"></script>
        <script src="{{asset('js/nationalite.js')}}"></script>
        <script src="{{asset('js/commune.js')}}"></script>
        <script src="{{asset('js/fokontany.js')}}"></script>
        <script src="{{asset('js/user.js')}}"></script>
        <script src="{{asset('js/tab.js')}}"></script>
        <script src="{{asset('js/proprietaire_etablissement.js')}}"></script>
        <script src="{{asset('js/quitance.js')}}"></script>
        <script src="{{asset('js/select2.js')}}"></script>
        <script src="{{asset('js/cascade.js')}}"></script>
        @yield('script')

    </body>

</html>