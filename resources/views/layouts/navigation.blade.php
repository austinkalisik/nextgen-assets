@php
    $currentUser = auth()->user();

    $navItems = [
        [
            'label' => 'Main',
            'items' => [
                [
                    'label' => 'Dashboard',
                    'route' => route('dashboard'),
                    'active' => request()->routeIs('dashboard'),
                ],
                [
                    'label' => 'Assets',
                    'route' => route('items.index'),
                    'active' => request()->routeIs('items.*'),
                ],
                [
                    'label' => 'Assignments',
                    'route' => route('assignments.index'),
                    'active' => request()->routeIs('assignments.*'),
                ],
                [
                    'label' => 'Inventory',
                    'route' => route('inventory.index'),
                    'active' => request()->routeIs('inventory.*'),
                ],
            ],
        ],
        [
            'label' => 'Operations',
            'items' => [
                [
                    'label' => 'Suppliers',
                    'route' => route('suppliers.index'),
                    'active' => request()->routeIs('suppliers.*'),
                ],
                [
                    'label' => 'Categories',
                    'route' => route('categories.index'),
                    'active' => request()->routeIs('categories.*'),
                ],
                [
                    'label' => 'Departments',
                    'route' => route('departments.index'),
                    'active' => request()->routeIs('departments.*'),
                ],
            ],
        ],
        [
            'label' => 'Personal',
            'items' => [
                [
                    'label' => 'Profile',
                    'route' => route('profile.edit'),
                    'active' => request()->routeIs('profile.*'),
                ],
            ],
        ],
    ];

    if ($currentUser && $currentUser->isAdmin()) {
        $navItems[] = [
            'label' => 'Administration',
            'items' => [
                [
                    'label' => 'User Administration',
                    'route' => route('users.index'),
                    'active' => request()->routeIs('users.*'),
                ],
                [
                    'label' => 'Settings',
                    'route' => route('settings.index'),
                    'active' => request()->routeIs('settings.*'),
                ],
            ],
        ];
    }

    $initials = strtoupper(substr($currentUser->name ?? 'U', 0, 1));
@endphp

<aside x-cloak :class="sidebarOpen ? 'translate-x-0 lg:w-72' : '-translate-x-full lg:translate-x-0 lg:w-20'"
    class="fixed inset-y-0 left-0 z-30 flex flex-col transition-all duration-300 border-r shadow-2xl w-72 border-slate-200 bg-slate-950 text-slate-200 lg:static lg:translate-x-0">
    <div class="flex items-center justify-between h-20 px-5 border-b border-slate-800">
        <div class="min-w-0">
            <h1 class="text-lg font-bold tracking-tight text-white truncate" x-show="sidebarOpen" x-transition>
                {{ $appSettings['system_name'] ?? 'NextGen Assets' }}
            </h1>
            <p class="text-xs truncate text-slate-400" x-show="sidebarOpen" x-transition>
                {{ $appSettings['system_tagline'] ?? 'Management System' }}
            </p>

            <div x-show="!sidebarOpen" x-transition
                class="flex items-center justify-center w-10 h-10 text-sm font-bold text-white bg-blue-600 rounded-2xl">
                {{ $initials }}
            </div>
        </div>

        <button type="button" @click="sidebarOpen = false"
            class="inline-flex items-center justify-center transition border h-9 w-9 rounded-xl border-slate-800 text-slate-400 hover:bg-slate-900 hover:text-white lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div class="px-4 py-4 border-b border-slate-800">
        <div class="flex items-center gap-3 px-3 py-3 border rounded-2xl border-slate-800 bg-slate-900">
            <div
                class="flex items-center justify-center text-sm font-bold text-white bg-blue-600 h-11 w-11 rounded-2xl">
                {{ $initials }}
            </div>

            <div x-show="sidebarOpen" x-transition class="min-w-0">
                <div class="text-sm font-semibold text-white truncate">{{ $currentUser->name ?? 'User' }}</div>
                <div class="text-xs truncate text-slate-400">
                    {{ ucfirst(str_replace('_', ' ', $currentUser->role ?? 'staff')) }}
                </div>
            </div>
        </div>
    </div>

    <nav class="flex-1 px-3 py-5 space-y-6 overflow-y-auto">
        @foreach($navItems as $group)
            <div>
                <div class="mb-2 px-3 text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-500"
                    x-show="sidebarOpen" x-transition>
                    {{ $group['label'] }}
                </div>

                <div class="space-y-1">
                    @foreach($group['items'] as $item)
                            <a href="{{ $item['route'] }}"
                                class="{{ $item['active']
                        ? 'bg-blue-600/15 text-white border-blue-500/40 shadow-sm'
                        : 'border-transparent text-slate-300 hover:bg-slate-900 hover:text-white'
                                        }} group flex items-center gap-3 rounded-2xl border px-3 py-3 text-sm font-medium transition">
                                <span
                                    class="{{ $item['active'] ? 'bg-blue-500 text-white' : 'bg-slate-800 text-slate-300 group-hover:bg-slate-700' }} flex h-9 w-9 shrink-0 items-center justify-center rounded-xl text-xs font-bold transition">
                                    {{ strtoupper(substr($item['label'], 0, 1)) }}
                                </span>

                                <span x-show="sidebarOpen" x-transition class="truncate">
                                    {{ $item['label'] }}
                                </span>
                            </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </nav>

    <div class="px-4 py-4 border-t border-slate-800">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center justify-center w-full px-4 py-3 text-sm font-semibold text-white transition bg-red-500 rounded-2xl hover:bg-red-600">
                <span x-show="sidebarOpen" x-transition>Logout</span>
                <span x-show="!sidebarOpen" x-transition>⎋</span>
            </button>
        </form>
    </div>
</aside>

<div x-cloak x-show="sidebarOpen" @click="sidebarOpen = false"
    class="fixed inset-0 z-20 bg-slate-950/50 backdrop-blur-sm lg:hidden"></div>