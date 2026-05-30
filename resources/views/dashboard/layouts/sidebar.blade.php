<aside
    class="ease-nav-brand z-990 fixed inset-y-0 my-4 ml-4 block w-64 -translate-x-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 bg-white p-0 antialiased shadow-xl transition-transform duration-200 dark:bg-slate-900 dark:shadow-slate-900 xl:left-0 xl:translate-x-0"
    aria-expanded="false">

    {{-- Logo / Brand --}}
    <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800">
        <i class="ri-close-large-fill absolute right-4 top-4 cursor-pointer text-slate-400 xl:hidden" sidenav-close></i>
        <a href="{{ route('pemagang.dashboard') }}" class="flex items-center gap-3">
            <div
                class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-500 to-sky-500 flex items-center justify-center shadow-lg flex-shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z">
                    </path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="font-bold text-slate-900 dark:text-white text-sm leading-tight">SIMWEB</p>
                <p class="text-[10px] text-slate-400 uppercase tracking-wider">Kemenkumham Jambi</p>
            </div>
        </a>
    </div>

    {{-- User Info --}}
    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800">
        <div class="flex items-center gap-3">
            <div
                class="w-9 h-9 rounded-full bg-gradient-to-br from-emerald-400 to-sky-500 flex items-center justify-center text-white font-bold text-sm flex-shrink-0 overflow-hidden">
                @if (Auth::guard('pemagang')->user()->foto)
                    <img src="{{ asset('storage/unggah/pemagang/' . Auth::guard('pemagang')->user()->foto) }}"
                        class="w-full h-full object-cover" />
                @else
                    {{ strtoupper(substr(Auth::guard('pemagang')->user()->nama_lengkap, 0, 1)) }}
                @endif
            </div>
            <div class="min-w-0">
                <p class="text-sm font-semibold text-slate-800 dark:text-white truncate">
                    {{ Auth::guard('pemagang')->user()->nama_lengkap }}</p>
                <p class="text-xs text-slate-400 truncate">Pemagang</p>
            </div>
        </div>
    </div>

    {{-- Navigation Menu --}}
    <div class="px-4 py-4 overflow-y-auto">
        <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-widest px-2 mb-3">Menu Utama</p>
        <ul class="space-y-1">

            {{-- Dashboard --}}
            <li>
                <a href="{{ route('pemagang.dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                    {{ Request::routeIs('pemagang.dashboard')
                        ? 'bg-gradient-to-r from-sky-500 to-sky-600 text-white shadow-md shadow-sky-500/25'
                        : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                    <div
                        class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 {{ Request::routeIs('pemagang.dashboard') ? 'bg-white/20' : 'bg-slate-100 dark:bg-slate-800' }}">
                        <svg class="w-4 h-4 {{ Request::routeIs('pemagang.dashboard') ? 'text-white' : 'text-sky-500' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </div>
                    <span>Dashboard</span>
                </a>
            </li>

            {{-- Logbook --}}
            <li>
                <a href="{{ route('pemagang.logbook') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                    {{ Request::routeIs('pemagang.logbook')
                        ? 'bg-gradient-to-r from-emerald-500 to-emerald-600 text-white shadow-md shadow-emerald-500/25'
                        : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                    <div
                        class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 {{ Request::routeIs('pemagang.logbook') ? 'bg-white/20' : 'bg-slate-100 dark:bg-slate-800' }}">
                        <svg class="w-4 h-4 {{ Request::routeIs('pemagang.logbook') ? 'text-white' : 'text-emerald-500' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span> Logbook</span>
                </a>
            </li>

            {{-- Presensi --}}
            <li>
                <a href="{{ route('pemagang.presensi') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                    {{ Request::routeIs('pemagang.presensi')
                        ? 'bg-gradient-to-r from-emerald-500 to-emerald-600 text-white shadow-md shadow-emerald-500/25'
                        : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                    <div
                        class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 {{ Request::routeIs('pemagang.presensi') ? 'bg-white/20' : 'bg-slate-100 dark:bg-slate-800' }}">
                        <svg class="w-4 h-4 {{ Request::routeIs('pemagang.presensi') ? 'text-white' : 'text-emerald-500' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span>Presensi</span>
                </a>
            </li>

            {{-- History --}}
            {{-- <li>
                <a href="{{ route('pemagang.history') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                    {{ Request::routeIs('pemagang.history')
                        ? 'bg-gradient-to-r from-violet-500 to-violet-600 text-white shadow-md shadow-violet-500/25'
                        : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 {{ Request::routeIs('pemagang.history') ? 'bg-white/20' : 'bg-slate-100 dark:bg-slate-800' }}">
                        <svg class="w-4 h-4 {{ Request::routeIs('pemagang.history') ? 'text-white' : 'text-violet-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span>History</span>
                </a>
            </li> --}}

            {{-- Izin --}}
            {{-- <li>
                <a href="{{ route('pemagang.izin') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                    {{ Request::routeIs(['pemagang.izin', 'pemagang.izin.create'])
                        ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-md shadow-amber-500/25'
                        : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                    <div
                        class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 {{ Request::routeIs(['pemagang.izin', 'pemagang.izin.create']) ? 'bg-white/20' : 'bg-slate-100 dark:bg-slate-800' }}">
                        <svg class="w-4 h-4 {{ Request::routeIs(['pemagang.izin', 'pemagang.izin.create']) ? 'text-white' : 'text-amber-500' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <span>Izin</span>
                </a>
            </li> --}}

            {{-- Profile --}}
            <li>
                <a href="{{ route('pemagang.profile') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                    {{ Request::routeIs('pemagang.profile')
                        ? 'bg-gradient-to-r from-rose-500 to-pink-500 text-white shadow-md shadow-rose-500/25'
                        : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                    <div
                        class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 {{ Request::routeIs('pemagang.profile') ? 'bg-white/20' : 'bg-slate-100 dark:bg-slate-800' }}">
                        <svg class="w-4 h-4 {{ Request::routeIs('pemagang.profile') ? 'text-white' : 'text-rose-500' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <span>Profile</span>
                </a>
            </li>
        </ul>

        {{-- Logout --}}
        <div class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-800">
            <form method="POST" action="{{ route('logout.auth') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 transition-all duration-200">
                    <div
                        class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-800 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                    </div>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>
