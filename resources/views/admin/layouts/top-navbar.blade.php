<!-- Top Navigation Bar -->
<nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="px-6 py-4 flex items-center justify-between">
        <!-- Left Side - Greeting -->
        <div class="flex items-center space-x-3">
            <div>
                <h2 class="text-sm font-semibold text-gray-500">Selamat datang,</h2>
                <p class="text-lg font-bold text-gov-primary">{{ Auth::user()->name }}</p>
            </div>
        </div>

        <!-- Right Side - User Actions -->
        <div class="flex items-center space-x-4">
            <!-- Date & Time -->
            <div class="text-right hidden sm:block">
                <p class="text-sm font-medium text-gray-700" id="current-date"></p>
                <p class="text-xs text-gray-500" id="current-time"></p>
            </div>

            <!-- Divider -->
            <div class="border-l border-gray-300 h-8"></div>

            <!-- User Dropdown -->
            <div class="relative group">
                <button class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <div
                        class="w-8 h-8 bg-gradient-to-br from-gov-primary to-blue-900 rounded-full flex items-center justify-center text-white">
                        <i class="ri-user-line text-sm"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700">{{ substr(Auth::user()->name, 0, 1) }}</span>
                </button>

                <!-- Dropdown Menu -->
                <div
                    class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center space-x-2 px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-t-lg transition-colors">
                        <i class="ri-user-settings-line"></i>
                        <span>Edit Profile</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit"
                            class="w-full text-left flex items-center space-x-2 px-4 py-2 text-red-600 hover:bg-red-50 rounded-b-lg transition-colors">
                            <i class="ri-logout-box-line"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    // Update date and time
    function updateDateTime() {
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        const today = new Date().toLocaleDateString('id-ID', options);
        const time = new Date().toLocaleTimeString('id-ID');

        const dateEl = document.getElementById('current-date');
        const timeEl = document.getElementById('current-time');

        if (dateEl) dateEl.textContent = today;
        if (timeEl) timeEl.textContent = time;
    }

    updateDateTime();
    setInterval(updateDateTime, 1000);
</script>
