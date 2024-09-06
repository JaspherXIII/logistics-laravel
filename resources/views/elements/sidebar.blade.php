<div class="wrapper">

    <div class="iq-sidebar  sidebar-default ">
        <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
            @if (auth()->user()->role == 1)
            <a href="/admin/dashboard" class="header-logo">
                <img src="/logistic-assets/images/logo.png" class="img-fluid rounded-normal light-logo" alt="logo">
                <h5 class="logo-title light-logo ml-2">save</h5>
            </a>
            @endif
            @if (auth()->user()->role == 2)
            <a href="/user/dashboard" class="header-logo">
                <img src="/logistic-assets/images/logo.png" class="img-fluid rounded-normal light-logo" alt="logo">
                <h5 class="logo-title light-logo ml-2">save</h5>
            </a>
            @endif
            <div class="iq-menu-bt-sidebar ml-2">
                <i class="las la-bars wrapper-menu"></i>
            </div>
        </div>
        <div class="data-scrollbar" data-scroll="1">
            <nav class="iq-sidebar-menu">
                <ul id="iq-sidebar-toggle" class="iq-menu">
                    @if (auth()->user()->role == 1)
                        <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                            <a href="/admin/dashboard" class="svg-icon">
                                <svg class="svg-icon" id="p-dash1" width="20" height="20"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                                    </path>
                                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                </svg>
                                <span class="ml-3">Dashboard</span>
                            </a>
                        </li>

                        <li class=" ">
                            <a href="#order" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                <svg class="svg-icon" id="p-dash5" width="20" height="20"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M17 2V4H20.0066C20.5552 4 21 4.44495 21 4.9934V21.0066C21 21.5552 20.5551 22 20.0066 22H3.9934C3.44476 22 3 21.5551 3 21.0066V4.9934C3 4.44476 3.44495 4 3.9934 4H7V2H17ZM7 6H5V20H19V6H17V8H7V6ZM9 16V18H7V16H9ZM9 13V15H7V13H9ZM9 10V12H7V10H9ZM15 4H9V6H15V4Z">
                                    </path>
                                </svg>

                                <span class="ml-3">Purchases</span>
                                <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polyline points="10 15 15 20 20 15"></polyline>
                                    <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                </svg>
                            </a>
                            <ul id="order" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                <li class="{{ request()->is('admin/orderForm') ? 'active' : '' }}">
                                    <a href="/admin/orderForm">
                                        <i class="las la-minus"></i><span>Order Form</span>
                                    </a>
                                </li>

                                <li class="{{ request()->is('admin/orders') ? 'active' : '' }}">
                                    <a href="/admin/orders">
                                        <i class="las la-minus"></i><span>Order List</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class=" ">
                            <a href="#product" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                <svg class="svg-icon" id="p-dash2" width="20" height="20"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M4 5H20V3H4V5ZM20 9H4V7H20V9ZM3 11H10V13H14V11H21V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V11ZM16 13V15H8V13H5V19H19V13H16Z">
                                    </path>
                                </svg>
                                <span class="ml-3">Warehouse</span>&nbsp;&nbsp;<span class="mr-3">Inventory</span>
                                <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polyline points="10 15 15 20 20 15"></polyline>
                                    <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                </svg>
                            </a>
                            <ul id="product" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                <li class="{{ request()->is('admin/receivedstocks') ? 'active' : '' }}">
                                    <a href="/admin/receivedstocks">
                                        <i class="las la-minus"></i><span>Received Stock</span>
                                    </a>
                                </li>
                                <li class="{{ request()->is('admin/inventories') ? 'active' : '' }}">
                                    <a href="/admin/inventories">
                                        <i class="las la-minus"></i><span>Product Inventory</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="">
                            <a href="#supplier" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                <svg class="svg-icon" id="p-dash6" width="20" height="20"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M4 22C4 17.5817 7.58172 14 12 14C16.4183 14 20 17.5817 20 22H4ZM13 16.083V20H17.6586C16.9423 17.9735 15.1684 16.4467 13 16.083ZM11 20V16.083C8.83165 16.4467 7.05766 17.9735 6.34141 20H11ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.2104 11 16 9.21043 16 7C16 4.78957 14.2104 3 12 3C9.78957 3 8 4.78957 8 7C8 9.21043 9.78957 11 12 11Z">
                                    </path>
                                </svg>

                                <span class="ml-3">Suppliers</span>
                                <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polyline points="10 15 15 20 20 15"></polyline>
                                    <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                </svg>
                            </a>
                            <ul id="supplier" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                <li class="{{ request()->is('admin/products') ? 'active' : '' }}">
                                    <a href="/admin/products">
                                        <i class="las la-minus"></i><span>Product List</span>
                                    </a>
                                </li>
                                <li class="{{ request()->is('admin/suppliers') ? 'active' : '' }}">
                                    <a href="/admin/suppliers">
                                        <i class="las la-minus"></i><span>Suppliers</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class=" ">
                            <a href="#transfer" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                <svg class="svg-icon" id="p-dash6" width="20" height="20"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M8.96456 18C8.72194 19.6961 7.26324 21 5.5 21C3.73676 21 2.27806 19.6961 2.03544 18H1V6C1 5.44772 1.44772 5 2 5H16C16.5523 5 17 5.44772 17 6V8H20L23 12.0557V18H20.9646C20.7219 19.6961 19.2632 21 17.5 21C15.7368 21 14.2781 19.6961 14.0354 18H8.96456ZM15 7H3V15.0505C3.63526 14.4022 4.52066 14 5.5 14C6.8962 14 8.10145 14.8175 8.66318 16H14.3368C14.5045 15.647 14.7296 15.3264 15 15.0505V7ZM17 13H21V12.715L18.9917 10H17V13ZM17.5 19C18.1531 19 18.7087 18.5826 18.9146 18C18.9699 17.8436 19 17.6753 19 17.5C19 16.6716 18.3284 16 17.5 16C16.6716 16 16 16.6716 16 17.5C16 17.6753 16.0301 17.8436 16.0854 18C16.2913 18.5826 16.8469 19 17.5 19ZM7 17.5C7 16.6716 6.32843 16 5.5 16C4.67157 16 4 16.6716 4 17.5C4 17.6753 4.03008 17.8436 4.08535 18C4.29127 18.5826 4.84689 19 5.5 19C6.15311 19 6.70873 18.5826 6.91465 18C6.96992 17.8436 7 17.6753 7 17.5Z">
                                    </path>
                                </svg>
                                <span class="ml-3">Inventory</span>&nbsp;&nbsp;<span>Transfer</span>
                                <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polyline points="10 15 15 20 20 15"></polyline>
                                    <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                </svg>
                            </a>
                            <ul id="transfer" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                <li class="{{ request()->is('admin/picklistForm') ? 'active' : '' }}">
                                    <a href="/admin/picklistForm">
                                        <i class="las la-minus"></i><span>Pick List Form</span>
                                    </a>
                                </li>
                                <li class="{{ request()->is('admin/picklists') ? 'active' : '' }}">
                                    <a href="/admin/picklists">
                                        <i class="las la-minus"></i><span>Pick List</span>
                                    </a>
                                </li>
                                <li class="{{ request()->is('admin/deliveryreceipts') ? 'active' : '' }}">
                                    <a href="/admin/deliveryreceipts">
                                        <i class="las la-minus"></i><span>Delivery Receipts</span>
                                    </a>
                                </li>
                            </ul>

                        </li>

                        <li class=" ">
                            <a href="#return" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                <svg class="svg-icon" id="p-dash6" width="20" height="20"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polyline points="4 14 10 14 10 20"></polyline>
                                    <polyline points="20 10 14 10 14 4"></polyline>
                                    <line x1="14" y1="10" x2="21" y2="3"></line>
                                    <line x1="3" y1="21" x2="10" y2="14"></line>
                                </svg>
                                <span class="ml-3">Returns</span>
                                <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polyline points="10 15 15 20 20 15"></polyline>
                                    <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                </svg>
                            </a>
                            <ul id="return" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                <li class="{{ request()->is('admin/returnForm') ? 'active' : '' }}">
                                    <a href="/admin/returnForm">
                                        <i class="las la-minus"></i><span>Return Form</span>
                                    </a>
                                </li>
                                <li class="{{ request()->is('admin/returns') ? 'active' : '' }}">
                                    <a href="/admin/returns">
                                        <i class="las la-minus"></i><span>Return List</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if (auth()->user()->role == 2)
                    <li class=" ">
                        <a href="#order" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <svg class="svg-icon" id="p-dash5" width="20" height="20"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M17 2V4H20.0066C20.5552 4 21 4.44495 21 4.9934V21.0066C21 21.5552 20.5551 22 20.0066 22H3.9934C3.44476 22 3 21.5551 3 21.0066V4.9934C3 4.44476 3.44495 4 3.9934 4H7V2H17ZM7 6H5V20H19V6H17V8H7V6ZM9 16V18H7V16H9ZM9 13V15H7V13H9ZM9 10V12H7V10H9ZM15 4H9V6H15V4Z">
                                </path>
                            </svg>

                            <span class="ml-3">Purchases</span>
                            <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="10 15 15 20 20 15"></polyline>
                                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                            </svg>
                        </a>
                        <ul id="order" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="{{ request()->is('user/orders') ? 'active' : '' }}">
                                <a href="{{ route('user/orders.index') }}">
                                    <i class="las la-minus"></i><span>Order List</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class=" ">
                        <a href="#product" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <svg class="svg-icon" id="p-dash2" width="20" height="20"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M4 5H20V3H4V5ZM20 9H4V7H20V9ZM3 11H10V13H14V11H21V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V11ZM16 13V15H8V13H5V19H19V13H16Z">
                                </path>
                            </svg>
                            <span class="ml-3">Warehouse</span>&nbsp;&nbsp;<span class="mr-3">Inventory</span>
                            <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="10 15 15 20 20 15"></polyline>
                                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                            </svg>
                        </a>
                        <ul id="product" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="{{ request()->is('user/receivedstocks') ? 'active' : '' }}">
                                <a href="{{ route('user/receivedstocks.index') }}">
                                    <i class="las la-minus"></i><span>Received Stock</span>
                                </a>
                            </li>
                            <li class="{{ request()->is('user/inventories') ? 'active' : '' }}">
                                <a href="{{ route('user/inventories.index') }}">
                                    <i class="las la-minus"></i><span>Product Inventory</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="">
                        <a href="#supplier" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <svg class="svg-icon" id="p-dash6" width="20" height="20"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M4 22C4 17.5817 7.58172 14 12 14C16.4183 14 20 17.5817 20 22H4ZM13 16.083V20H17.6586C16.9423 17.9735 15.1684 16.4467 13 16.083ZM11 20V16.083C8.83165 16.4467 7.05766 17.9735 6.34141 20H11ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.2104 11 16 9.21043 16 7C16 4.78957 14.2104 3 12 3C9.78957 3 8 4.78957 8 7C8 9.21043 9.78957 11 12 11Z">
                                </path>
                            </svg>

                            <span class="ml-3">Suppliers</span>
                            <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="10 15 15 20 20 15"></polyline>
                                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                            </svg>
                        </a>
                        <ul id="supplier" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="{{ request()->is('user/products') ? 'active' : '' }}">
                                <a href="{{ route('user/products.index') }}">
                                    <i class="las la-minus"></i><span>Product List</span>
                                </a>
                            </li>
                            <li class="{{ request()->is('user/suppliers') ? 'active' : '' }}">
                                <a href="{{ route('user/suppliers.index') }}">
                                    <i class="las la-minus"></i><span>Suppliers</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class=" ">
                        <a href="#transfer" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <svg class="svg-icon" id="p-dash6" width="20" height="20"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M8.96456 18C8.72194 19.6961 7.26324 21 5.5 21C3.73676 21 2.27806 19.6961 2.03544 18H1V6C1 5.44772 1.44772 5 2 5H16C16.5523 5 17 5.44772 17 6V8H20L23 12.0557V18H20.9646C20.7219 19.6961 19.2632 21 17.5 21C15.7368 21 14.2781 19.6961 14.0354 18H8.96456ZM15 7H3V15.0505C3.63526 14.4022 4.52066 14 5.5 14C6.8962 14 8.10145 14.8175 8.66318 16H14.3368C14.5045 15.647 14.7296 15.3264 15 15.0505V7ZM17 13H21V12.715L18.9917 10H17V13ZM17.5 19C18.1531 19 18.7087 18.5826 18.9146 18C18.9699 17.8436 19 17.6753 19 17.5C19 16.6716 18.3284 16 17.5 16C16.6716 16 16 16.6716 16 17.5C16 17.6753 16.0301 17.8436 16.0854 18C16.2913 18.5826 16.8469 19 17.5 19ZM7 17.5C7 16.6716 6.32843 16 5.5 16C4.67157 16 4 16.6716 4 17.5C4 17.6753 4.03008 17.8436 4.08535 18C4.29127 18.5826 4.84689 19 5.5 19C6.15311 19 6.70873 18.5826 6.91465 18C6.96992 17.8436 7 17.6753 7 17.5Z">
                                </path>
                            </svg>
                            <span class="ml-3">Inventory</span>&nbsp;&nbsp;<span>Transfer</span>
                            <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="10 15 15 20 20 15"></polyline>
                                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                            </svg>
                        </a>
                        <ul id="transfer" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="{{ request()->is('user/picklists') ? 'active' : '' }}">
                                <a href="{{ route('user/picklists.index') }}">
                                    <i class="las la-minus"></i><span>Pick List</span>
                                </a>
                            </li>
                            <li class="{{ request()->is('user/deliveryreceipts') ? 'active' : '' }}">
                                <a href="{{ route('user/deliveryreceipts.index') }}">
                                    <i class="las la-minus"></i><span>Delivery Receipts</span>
                                </a>
                            </li>
                        </ul>

                    </li>

                    <li class=" ">
                        <a href="#return" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <svg class="svg-icon" id="p-dash6" width="20" height="20"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="4 14 10 14 10 20"></polyline>
                                <polyline points="20 10 14 10 14 4"></polyline>
                                <line x1="14" y1="10" x2="21" y2="3"></line>
                                <line x1="3" y1="21" x2="10" y2="14"></line>
                            </svg>
                            <span class="ml-3">Returns</span>
                            <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="10 15 15 20 20 15"></polyline>
                                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                            </svg>
                        </a>
                        <ul id="return" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="{{ request()->is('user/returns') ? 'active' : '' }}">
                                <a href="{{ route('user/returns.index') }}">
                                    <i class="las la-minus"></i><span>Return List</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                </ul>
            </nav>
            <div class="p-3"></div>
        </div>
    </div>
</div>
