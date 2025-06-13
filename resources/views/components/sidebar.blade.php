<!-- Sidebar -->
<div class="w-64 bg-gradient-to-r from-green-500 to-green-400 text-white h-screen fixed top-0 left-0 p-5">
    <!-- Sidebar Brand -->
    <div class="flex items-center justify-center mb-10">
        <img src="{{ asset('img/logo.png') }}" class="w-1/2" />
        <div class="ml-3 text-2xl font-semibold">Festori</div>
    </div>

    <!-- Divider -->
    <hr class="my-4 border-gray-300">

    <!-- Dashboard Item -->
    <ul class="space-y-4">
        <li class="nav-item {{ request()->routeIs('admin.home') ? 'bg-green-700' : '' }}">
            <a href="{{ route('admin.home') }}" class="flex items-center space-x-2 py-2 px-4 rounded-lg hover:bg-green-600">
                <i class="fas fa-fw fa-tachometer-alt text-xl"></i>
                <span>{{ __('Dashboard') }}</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('admin.order') ? 'bg-green-700' : '' }}">
            <a href="{{ route('admin.order') }}" class="flex items-center space-x-2 py-2 px-4 rounded-lg hover:bg-green-600">
                <i class="fas fa-fw fa-box text-xl"></i>
                <span>{{ __('Order') }}</span>
            </a>
        </li>
    </ul>

    <!-- Divider -->
    <hr class="my-4 border-gray-300">

    <!-- Settings Heading -->
    <div class="text-lg font-semibold mb-4">
        {{ __('Settings') }}
    </div>

    <!-- Logout Item -->
    <ul>
        <li>
            <a href="#" data-toggle="modal" data-target="#logoutModal" class="flex items-center space-x-2 py-2 px-4 rounded-lg hover:bg-red-600">
                <i class="fas fa-sign-out-alt text-xl"></i>
                <span>{{ __('Logout') }}</span>
            </a>
        </li>
    </ul>

    <!-- Divider -->
    <hr class="my-4 border-gray-300">
    
    <!-- Sidebar Toggler -->
    <div class="text-center mt-5">
        <button class="bg-gray-200 p-2 rounded-full focus:outline-none" id="sidebarToggle">
            <i class="fas fa-chevron-left text-gray-800"></i>
        </button>
    </div>
</div>
<!-- End of Sidebar -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-white rounded-lg shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title text-lg font-semibold text-gray-700" id="exampleModalLabel">{{ __('Apakah Anda Yakin Untuk Logout?') }}</h5>
                <button class="close text-gray-600" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-sm text-gray-600">Pilih "Logout" di bawah jika Anda ingin untuk mengakhiri sesi Anda saat ini.</div>
            <div class="modal-footer">
                <button class="btn btn-link text-gray-600" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                <a class="btn btn-danger text-white bg-red-600 hover:bg-red-700 py-2 px-4 rounded-md"
                    href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
