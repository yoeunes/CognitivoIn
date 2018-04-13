
    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="content">
            <!-- Hero -->
            <div class="block block-rounded">
                <div class="block-content bg-pattern" style="background-image: url('assets/img/various/bg-pattern-inverse.png');">
                    <div class="py-20 text-center">
                        <h1 class="h3 mb-5">ACME Inc</h1>
                        <p class="mb-10 text-muted">
                            <em>Deadline: July 19, 2022</em>
                        </p>
                        <p>
                            Web Design and Development of ACME’s website. Brand identity as well as promo mobile app development for their projects.
                        </p>
                    </div>
                </div>
            </div>
            <!-- END Hero -->

            <!-- Tasks Content -->
            <div class="row">
                <div class="col-md-5 col-xl-3">
                    <!-- Toggle Tasks Navigation on mobile -->
                    <button type="button" class="btn btn-block btn-primary d-md-none mb-10" data-toggle="class-toggle" data-target=".js-tasks-nav" data-class="d-none d-md-block">Menu</button>

                    <!-- Collapsible Tasks Navigation -->
                    <div class="js-tasks-nav d-none d-md-block">
                        <!-- Tasks Info -->
                        <div class="block block-rounded">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Tasks</h3>
                            </div>
                            <div class="block-content">
                                <ul class="list-group push">
                                    <li class="list-group-item">
                                        <span class="js-task-badge badge badge-primary float-right animated bounceIn"></span>
                                        <i class="fa fa-fw fa-tasks mr-5"></i> Active
                                    </li>
                                    <li class="list-group-item">
                                        <span class="js-task-badge-starred badge badge-warning float-right animated bounceIn"></span>
                                        <i class="fa fa-fw fa-star mr-5"></i> Starred
                                    </li>
                                    <li class="list-group-item">
                                        <span class="js-task-badge-completed badge badge-success float-right animated bounceIn"></span>
                                        <i class="fa fa-fw fa-check mr-5"></i> Completed
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- END Tasks Info -->

                        <!-- People -->
                        <div class="block block-rounded">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">People</h3>
                                <div class="block-options">
                                    <div class="dropdown">
                                        <button type="button" class="btn-block-option" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="si si-settings"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0)">
                                                <i class="fa fa-fw fa-eye mr-5"></i>Make Private
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="javascript:void(0)">
                                                <i class="fa fa-fw fa-pencil mr-5"></i>Edit People
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block-content">
                                <ul class="nav-users push">
                                    <li>
                                        <a href="be_pages_generic_profile.html">
                                            <img class="img-avatar" src="assets/img/avatars/avatar8.jpg" alt="">
                                            <i class="fa fa-circle text-success"></i> Megan Fuller
                                            <div class="font-w400 font-size-xs text-muted"><i class="fa fa-location-arrow"></i> New York</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="be_pages_generic_profile.html">
                                            <img class="img-avatar" src="assets/img/avatars/avatar13.jpg" alt="">
                                            <i class="fa fa-circle text-success"></i> Brian Stevens
                                            <div class="font-w400 font-size-xs text-muted"><i class="fa fa-location-arrow"></i> San Fransisco</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="be_pages_generic_profile.html">
                                            <img class="img-avatar" src="assets/img/avatars/avatar8.jpg" alt="">
                                            <i class="fa fa-circle text-warning"></i> Andrea Gardner
                                            <div class="font-w400 font-size-xs text-muted"><i class="fa fa-location-arrow"></i> Beijing</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="be_pages_generic_profile.html">
                                            <img class="img-avatar" src="assets/img/avatars/avatar15.jpg" alt="">
                                            <i class="fa fa-circle text-warning"></i> Brian Cruz
                                            <div class="font-w400 font-size-xs text-muted"><i class="fa fa-location-arrow"></i> Tokyo</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="be_pages_generic_profile.html">
                                            <img class="img-avatar" src="assets/img/avatars/avatar13.jpg" alt="">
                                            <i class="fa fa-circle text-danger"></i> Justin Hunt
                                            <div class="font-w400 font-size-xs text-muted"><i class="fa fa-location-arrow"></i> London</div>
                                        </a>
                                    </li>
                                </ul>
                                <form class="push" action="be_pages_generic_todo.html" method="post" onsubmit="return false;">
                                    <div class="input-group">
                                        <input class="form-control" type="text" placeholder="Invite more people..">
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="submit">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- END People -->
                    </div>
                    <!-- END Collapsible Tasks Navigation -->
                </div>
                <div class="col-md-7 col-xl-9">
                    <!-- Tasks -->
                    <!-- Tasks functionality (initialized in js/pages/be_pages_generic_todo.js) -->
                    <div class="js-tasks">
                        <!-- Add task -->
                        <form id="js-task-form" action="be_pages_generic_todo.html" method="post">
                            <div class="input-group input-group-lg">
                                <input class="form-control" type="text" id="js-task-input" name="js-task-input" placeholder="Add a task and press enter..">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-plus"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <!-- END Add task -->

                        <!-- Tasks List -->
                        <h2 class="content-heading mb-10">Active</h2>
                        <div class="js-task-list">
                            <!-- Task -->
                            <div class="js-task block block-rounded mb-5 animated fadeIn" data-task-id="9" data-task-completed="false" data-task-starred="false">
                                <table class="table table-borderless table-vcenter mb-0">
                                    <tr>
                                        <td class="text-center" style="width: 50px;">
                                            <label class="js-task-status css-control css-control-primary css-checkbox py-0">
                                                <input type="checkbox" class="css-control-input">
                                                <span class="css-control-indicator"></span>
                                            </label>
                                        </td>
                                        <td class="js-task-content font-w600">
                                            Implement the main layout
                                        </td>
                                        <td class="text-right" style="width: 100px;">
                                            <button class="js-task-star btn btn-sm btn-alt-warning" type="button">
                                                <i class="fa fa-star-o"></i>
                                            </button>
                                            <button class="js-task-remove btn btn-sm btn-alt-danger" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <!-- END Task -->

                            <!-- Task -->
                            <div class="js-task block block-rounded mb-5 animated fadeIn" data-task-id="8" data-task-completed="false" data-task-starred="false">
                                <table class="table table-borderless table-vcenter mb-0">
                                    <tr>
                                        <td class="text-center" style="width: 50px;">
                                            <label class="js-task-status css-control css-control-primary css-checkbox py-0">
                                                <input type="checkbox" class="css-control-input">
                                                <span class="css-control-indicator"></span>
                                            </label>
                                        </td>
                                        <td class="js-task-content font-w600">
                                            Create new pages
                                        </td>
                                        <td class="text-right" style="width: 100px;">
                                            <button class="js-task-star btn btn-sm btn-alt-warning" type="button">
                                                <i class="fa fa-star-o"></i>
                                            </button>
                                            <button class="js-task-remove btn btn-sm btn-alt-danger" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <!-- END Task -->

                            <!-- Task -->
                            <div class="js-task block block-rounded mb-5 animated fadeIn" data-task-id="7" data-task-completed="false" data-task-starred="false">
                                <table class="table table-borderless table-vcenter mb-0">
                                    <tr>
                                        <td class="text-center" style="width: 50px;">
                                            <label class="js-task-status css-control css-control-primary css-checkbox py-0">
                                                <input type="checkbox" class="css-control-input">
                                                <span class="css-control-indicator"></span>
                                            </label>
                                        </td>
                                        <td class="js-task-content font-w600">
                                            Fix mobile Safari
                                        </td>
                                        <td class="text-right" style="width: 100px;">
                                            <button class="js-task-star btn btn-sm btn-alt-warning" type="button">
                                                <i class="fa fa-star-o"></i>
                                            </button>
                                            <button class="js-task-remove btn btn-sm btn-alt-danger" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <!-- END Task -->

                            <!-- Task -->
                            <div class="js-task block block-rounded mb-5 animated fadeIn" data-task-id="6" data-task-completed="false" data-task-starred="false">
                                <table class="table table-borderless table-vcenter mb-0">
                                    <tr>
                                        <td class="text-center" style="width: 50px;">
                                            <label class="js-task-status css-control css-control-primary css-checkbox py-0">
                                                <input type="checkbox" class="css-control-input">
                                                <span class="css-control-indicator"></span>
                                            </label>
                                        </td>
                                        <td class="js-task-content font-w600">
                                            Design the logo
                                        </td>
                                        <td class="text-right" style="width: 100px;">
                                            <button class="js-task-star btn btn-sm btn-alt-warning" type="button">
                                                <i class="fa fa-star-o"></i>
                                            </button>
                                            <button class="js-task-remove btn btn-sm btn-alt-danger" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <!-- END Task -->
                        </div>
                        <!-- END Tasks List -->

                        <!-- Starred Tasks List -->
                        <h2 class="content-heading mb-10">Starred</h2>
                        <div class="js-task-list-starred">
                            <!-- Task -->
                            <div class="js-task block block-rounded mb-5 animated fadeIn" data-task-id="5" data-task-completed="false" data-task-starred="true">
                                <table class="table table-borderless table-vcenter mb-0">
                                    <tr>
                                        <td class="text-center" style="width: 50px;">
                                            <label class="js-task-status css-control css-control-primary css-checkbox py-0">
                                                <input type="checkbox" class="css-control-input">
                                                <span class="css-control-indicator"></span>
                                            </label>
                                        </td>
                                        <td class="js-task-content font-w600">
                                            UX design and implementation
                                        </td>
                                        <td class="text-right" style="width: 100px;">
                                            <button class="js-task-star btn btn-sm btn-alt-warning" type="button">
                                                <i class="fa fa-star"></i>
                                            </button>
                                            <button class="js-task-remove btn btn-sm btn-alt-danger" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <!-- END Task -->

                            <!-- Task -->
                            <div class="js-task block block-rounded mb-5 animated fadeIn" data-task-id="4" data-task-completed="false" data-task-starred="true">
                                <table class="table table-borderless table-vcenter mb-0">
                                    <tr>
                                        <td class="text-center" style="width: 50px;">
                                            <label class="js-task-status css-control css-control-primary css-checkbox py-0">
                                                <input type="checkbox" class="css-control-input">
                                                <span class="css-control-indicator"></span>
                                            </label>
                                        </td>
                                        <td class="js-task-content font-w600">
                                            On-board processing
                                        </td>
                                        <td class="text-right" style="width: 100px;">
                                            <button class="js-task-star btn btn-sm btn-alt-warning" type="button">
                                                <i class="fa fa-star"></i>
                                            </button>
                                            <button class="js-task-remove btn btn-sm btn-alt-danger" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <!-- END Task -->
                        </div>
                        <!-- END Starred Tasks List -->

                        <!-- Tasks List Completed -->
                        <h2 class="content-heading mb-10">Completed</h2>
                        <div class="js-task-list-completed">
                            <!-- Completed Task -->
                            <div class="js-task block block-rounded mb-5 animated fadeIn" data-task-id="3" data-task-completed="true" data-task-starred="false">
                                <table class="table table-borderless table-vcenter bg-body-light mb-0">
                                    <tr>
                                        <td class="text-center" style="width: 50px;">
                                            <label class="js-task-status css-control css-control-primary css-checkbox py-0">
                                                <input type="checkbox" class="css-control-input" checked>
                                                <span class="css-control-indicator"></span>
                                            </label>
                                        </td>
                                        <td class="js-task-content font-w600">
                                            <del>Mobile wireframes</del>
                                        </td>
                                        <td class="text-right" style="width: 100px;">
                                            <button class="js-task-star btn btn-sm btn-alt-warning" type="button">
                                                <i class="fa fa-star-o"></i>
                                            </button>
                                            <button class="js-task-remove btn btn-sm btn-alt-danger" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <!-- END Completed Task -->

                            <!-- Completed Task -->
                            <div class="js-task block block-rounded mb-5 animated fadeIn" data-task-id="2" data-task-completed="true" data-task-starred="false">
                                <table class="table table-borderless table-vcenter bg-body-light mb-0">
                                    <tr>
                                        <td class="text-center" style="width: 50px;">
                                            <label class="js-task-status css-control css-control-primary css-checkbox py-0">
                                                <input type="checkbox" class="css-control-input" checked>
                                                <span class="css-control-indicator"></span>
                                            </label>
                                        </td>
                                        <td class="js-task-content font-w600">
                                            <del>Contract Signing</del>
                                        </td>
                                        <td class="text-right" style="width: 100px;">
                                            <button class="js-task-star btn btn-sm btn-alt-warning" type="button">
                                                <i class="fa fa-star-o"></i>
                                            </button>
                                            <button class="js-task-remove btn btn-sm btn-alt-danger" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <!-- END Completed Task -->

                            <!-- Completed Task -->
                            <div class="js-task block block-rounded mb-5 animated fadeIn" data-task-id="1" data-task-completed="true" data-task-starred="false">
                                <table class="table table-borderless table-vcenter bg-body-light mb-0">
                                    <tr>
                                        <td class="text-center" style="width: 50px;">
                                            <label class="js-task-status css-control css-control-primary css-checkbox py-0">
                                                <input type="checkbox" class="css-control-input" checked>
                                                <span class="css-control-indicator"></span>
                                            </label>
                                        </td>
                                        <td class="js-task-content font-w600">
                                            <del>Explore ideas</del>
                                        </td>
                                        <td class="text-right" style="width: 100px;">
                                            <button class="js-task-star btn btn-sm btn-alt-warning" type="button">
                                                <i class="fa fa-star-o"></i>
                                            </button>
                                            <button class="js-task-remove btn btn-sm btn-alt-danger" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <!-- END Completed Task -->
                        </div>
                        <!-- END Tasks List Completed -->
                    </div>
                    <!-- END Tasks -->
                </div>
            </div>
            <!-- END Tasks Content -->
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
