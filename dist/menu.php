<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
    <!--begin::Sidebar-->
    <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
        data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
        data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
        <!--begin::Logo-->
        <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
            <!--begin::Logo image-->
            <a href="index.php">
                <img alt="Logo" src="assets/media/stock/etc/logo_w.png" class="h-30px app-sidebar-logo-default" />
            </a>
            <!--end::Logo image-->
            <!--begin::Sidebar toggle-->
            <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-sm h-30px w-30px rotate"
                data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
                data-kt-toggle-name="app-sidebar-minimize">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
                <span class="svg-icon svg-icon-2 rotate-180">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.5"
                            d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                            fill="currentColor" />
                        <path
                            d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                            fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </div>
            <!--end::Sidebar toggle-->
        </div>
        <!--end::Logo-->
        <!--begin::sidebar menu-->
        <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
            <!--begin::Menu wrapper-->
            <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
                data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold px-3" id="#kt_app_sidebar_menu"
                    data-kt-menu="true" data-kt-menu-expand="false">


                    <div class="menu-item">
                        <a class="menu-link" href="dash.php">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-house fa-bounce"></i>
                                </span>
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </div>





                    <div class="menu-item pt-5">

                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">Management</span>
                        </div>

                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="r_table.php">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa fa-table" aria-hidden="true"></i>
                                </span>
                            </span>
                            <span class="menu-title">Table Data</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="r_menu.php">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                </span>
                            </span>
                            <span class="menu-title">Menu</span>
                        </a>
                    </div>
                    <?php  if (isset($_SESSION['usertype']) && $_SESSION['usertype'] === 'radmin') {   ?>
                    <div class="menu-item">
                        <a class="menu-link" href="orderswait.php">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fas fa-hamburger"></i>
                                </span>
                            </span>
                            <span class="menu-title">Orders</span>
                        </a>
                    </div>
                    <?php } ?>

                    <!-- <?php // if (isset($_SESSION['usertype']) == 'table') { ?>
                    <div class="menu-item">
                        <a class="menu-link" href="order.php">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa fa-cutlery" aria-hidden="true"></i>
                                </span>
                            </span>
                            <span class="menu-title">Order</span>
                        </a>
                    </div>
                    <?php // } ?> -->
                    <div class="menu-item pt-5">

                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">Users</span>
                        </div>

                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="profile.php">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                            </span>
                            <span class="menu-title">Profile</span>
                        </a>
                    </div>
                    <?php  if (isset($_SESSION['usertype']) && $_SESSION['usertype'] === 'admin') {   ?>
                    <div class="menu-item">
                        <a class="menu-link" href="new_radmin.php">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-user-plus"></i>
                                </span>
                            </span>
                            <span class="menu-title">Add Restaurent Admin</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="users.php">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-sharp fa-solid fa-users"></i>
                                </span>
                            </span>
                            <span class="menu-title">Restuarants</span>
                        </a>
                    </div>

                    <!-- <div class="menu-item">
                        <a class="menu-link" href="new_admin.php">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-user-tie"></i>
                                </span>
                            </span>
                            <span class="menu-title">Add Admin</span>
                        </a>
                    </div> -->
                    <div class="menu-item">
                        <a class="menu-link" href="u_log.php">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-file"></i>
                                </span>
                            </span>
                            <span class="menu-title">Login Logs</span>
                        </a>
                    </div>

                    <?php } ?>
                    <?php  if (isset($_SESSION['usertype']) && $_SESSION['usertype'] === 'radmin') {   ?>
                    <div class="menu-item">
                        <a class="menu-link" href="tableusers.php">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-table"></i>
                                </span>
                            </span>
                            <span class="menu-title">Table Users</span>
                        </a>
                    </div>


                    <?php } ?>


                    <div class="menu-item">
                        <a class="menu-link" href="logout.php">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                </span>
                            </span>
                            <span class="menu-title">Sign Out</span>
                        </a>
                    </div>

                </div>
                <!--end::Menu-->
            </div>
            <!--end::Menu wrapper-->
        </div>
        <!--end::sidebar menu-->
        <!--begin::Footer-->
        <?php if (isset($_SESSION['usertype']) && $_SESSION['usertype'] === 'admin') { ?>
        <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
            <a href="w_log.php"
                class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click" title="All logs of working">
                <span class="btn-label">Working Logs</span>
                <!--begin::Svg Icon | path: icons/duotune/general/gen005.svg-->
                <span class="svg-icon btn-icon svg-icon-2 m-0">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.3"
                            d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z"
                            fill="currentColor" />
                        <rect x="7" y="17" width="6" height="2" rx="1" fill="currentColor" />
                        <rect x="7" y="12" width="10" height="2" rx="1" fill="currentColor" />
                        <rect x="7" y="7" width="6" height="2" rx="1" fill="currentColor" />
                        <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </a>
        </div>
        <?php } ?>
        <!--end::Footer-->
    </div>
    <!--end::Sidebar-->
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">