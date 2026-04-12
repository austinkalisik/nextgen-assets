@extends('layouts.app')

@section('content')
    @if($dashboardMode === 'operations')
        <div class="flex flex-col gap-4 mb-8 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Admin Dashboard</h1>
                <p class="mt-2 text-sm text-slate-500 sm:text-base">
                    Operational control center for assets, assignments, users, and system activity.
                </p>
            </div>

            @if(auth()->user()->isAdmin() || auth()->user()->isAssetOfficer())
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('items.create') }}"
                        class="inline-flex items-center rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                        + Add Asset
                    </a>
                    <a href="{{ route('assignments.create') }}"
                        class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                        + Assign Asset
                    </a>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 gap-4 mb-8 sm:grid-cols-2 xl:grid-cols-6">
            <div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
                <p class="text-sm font-medium text-slate-500">Total Assets</p>
                <h2 class="mt-3 text-3xl font-bold text-slate-900">{{ $totalAssets }}</h2>
            </div>

            <div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
                <p class="text-sm font-medium text-slate-500">Available</p>
                <h2 class="mt-3 text-3xl font-bold text-emerald-600">{{ $availableAssets }}</h2>
            </div>

            <div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
                <p class="text-sm font-medium text-slate-500">Assigned</p>
                <h2 class="mt-3 text-3xl font-bold text-amber-500">{{ $assignedAssets }}</h2>
            </div>

            <div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
                <p class="text-sm font-medium text-slate-500">Maintenance</p>
                <h2 class="mt-3 text-3xl font-bold text-rose-500">{{ $maintenanceAssets }}</h2>
            </div>

            <div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
                <p class="text-sm font-medium text-slate-500">Low Stock</p>
                <h2 class="mt-3 text-3xl font-bold text-orange-500">{{ $lowStockAssets }}</h2>
            </div>

            <div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
                <p class="text-sm font-medium text-slate-500">Overdue</p>
                <h2 class="mt-3 text-3xl font-bold text-red-600">{{ $overdueAssignments }}</h2>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 mb-8 lg:grid-cols-3">
            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200 lg:col-span-2">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900">Recent Assignments</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-slate-50 text-slate-600">
                            <tr>
                                <th class="px-6 py-3 font-semibold text-left">Asset</th>
                                <th class="px-6 py-3 font-semibold text-left">User</th>
                                <th class="px-6 py-3 font-semibold text-left">Department</th>
                                <th class="px-6 py-3 font-semibold text-left">Assigned At</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($recentAssignments as $assignment)
                                <tr class="hover:bg-slate-50/70">
                                    <td class="px-6 py-4 text-slate-700">{{ $assignment->item?->name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-slate-700">{{ $assignment->user?->name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-slate-700">{{ $assignment->assignedDepartment?->name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-slate-500">{{ $assignment->assigned_at?->format('d M Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-slate-500">No recent assignments.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900">System Activity</h2>
                </div>

                <div class="p-6">
                    <div class="space-y-4 text-sm">
                        @forelse($recentActivity as $activity)
                            <div class="pb-4 border-b border-slate-100 last:border-b-0 last:pb-0">
                                <p class="font-semibold text-slate-900">
                                    {{ ucfirst(str_replace('_', ' ', $activity->action)) }}
                                </p>
                                <p class="mt-1 text-slate-600">{{ $activity->item?->name ?? 'Unknown asset' }}</p>
                                <p class="mt-1 text-xs text-slate-400">
                                    by {{ $activity->user?->name ?? 'System' }} · {{ $activity->created_at?->format('d M Y H:i') }}
                                </p>
                            </div>
                        @empty
                            <p class="text-slate-500">No recent activity.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-4">
            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900">Category Summary</h2>
                </div>
                <div class="p-6 space-y-3 text-sm">
                    @foreach($categorySummary as $category)
                        <div class="flex items-center justify-between pb-2 border-b border-slate-100 last:border-b-0 last:pb-0">
                            <span class="text-slate-600">{{ $category->name }}</span>
                            <span class="font-semibold text-slate-900">{{ $category->items_count }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900">Department Summary</h2>
                </div>
                <div class="p-6 space-y-3 text-sm">
                    @foreach($departmentSummary as $department)
                        <div class="flex items-center justify-between pb-2 border-b border-slate-100 last:border-b-0 last:pb-0">
                            <span class="text-slate-600">{{ $department->name }}</span>
                            <span class="font-semibold text-slate-900">{{ $department->items_count }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900">User Roles</h2>
                </div>
                <div class="p-6 space-y-3 text-sm">
                    <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                        <span class="text-slate-600">Admins</span>
                        <span class="font-semibold text-slate-900">{{ $usersByRole['admin'] ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                        <span class="text-slate-600">Managers</span>
                        <span class="font-semibold text-slate-900">{{ $usersByRole['manager'] ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                        <span class="text-slate-600">Asset Officers</span>
                        <span class="font-semibold text-slate-900">{{ $usersByRole['asset_officer'] ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                        <span class="text-slate-600">Staff</span>
                        <span class="font-semibold text-slate-900">{{ $usersByRole['staff'] ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between pt-1">
                        <span class="text-slate-600">Active Assignments</span>
                        <span class="font-semibold text-slate-900">{{ $activeAssignments }}</span>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900">Unread Notifications</h2>
                </div>
                <div class="p-6 space-y-3 text-sm">
                    @forelse($unreadNotifications as $notification)
                        <a href="{{ route('notifications.open', $notification) }}"
                            class="block px-3 py-3 transition border border-transparent rounded-xl hover:border-slate-200 hover:bg-slate-50">
                            <p class="font-medium text-slate-900">{{ $notification->title }}</p>
                            <p class="mt-1 text-slate-500">{{ $notification->message }}</p>
                        </a>
                    @empty
                        <p class="text-slate-500">No unread notifications.</p>
                    @endforelse
                </div>
            </div>
        </div>
    @else
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">My Workspace</h1>
            <p class="mt-2 text-sm text-slate-500 sm:text-base">
                Personal asset overview, assignment tracking, and recent activity.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-4 mb-8 sm:grid-cols-2 xl:grid-cols-4">
            <div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
                <p class="text-sm font-medium text-slate-500">My Active Assets</p>
                <h2 class="mt-3 text-3xl font-bold text-slate-900">{{ $myAssignedAssetsCount }}</h2>
            </div>

            <div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
                <p class="text-sm font-medium text-slate-500">Overdue Assets</p>
                <h2 class="mt-3 text-3xl font-bold text-red-600">{{ $myOverdueAssignmentsCount }}</h2>
            </div>

            <div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
                <p class="text-sm font-medium text-slate-500">Departments Used</p>
                <h2 class="mt-3 text-3xl font-bold text-blue-600">{{ $myDepartmentCount }}</h2>
            </div>

            <div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
                <p class="text-sm font-medium text-slate-500">Assets In Maintenance</p>
                <h2 class="mt-3 text-3xl font-bold text-amber-500">{{ $myAssetsInMaintenance }}</h2>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 mb-8 xl:grid-cols-2">
            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900">My Active Assignments</h2>
                </div>
                <div class="p-6 space-y-4 text-sm">
                    @forelse($myActiveAssignments as $assignment)
                        <div class="p-4 border rounded-2xl border-slate-200">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                                <div>
                                    <p class="font-semibold text-slate-900">{{ $assignment->item?->name ?? '-' }}</p>
                                    <p class="mt-1 text-slate-500">{{ $assignment->assignedDepartment?->name ?? '-' }}</p>
                                    <p class="mt-2 text-xs text-slate-400">
                                        Assigned {{ $assignment->assigned_at?->format('d M Y H:i') }}
                                    </p>
                                </div>

                                @if($assignment->item)
                                    <a href="{{ route('items.show', $assignment->item) }}"
                                        class="inline-flex items-center px-3 py-2 text-xs font-semibold text-white transition rounded-xl bg-slate-900 hover:bg-slate-800">
                                        View Asset
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-500">No active assignments.</p>
                    @endforelse
                </div>
            </div>

            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900">My Recent Activity</h2>
                </div>
                <div class="p-6 space-y-4 text-sm">
                    @forelse($myRecentActivity as $activity)
                        <div class="pb-3 border-b border-slate-100 last:border-b-0 last:pb-0">
                            <p class="font-semibold text-slate-900">{{ ucfirst(str_replace('_', ' ', $activity->action)) }}</p>
                            <p class="text-slate-600">{{ $activity->item?->name ?? 'Unknown asset' }}</p>
                            <p class="text-xs text-slate-400">{{ $activity->created_at?->format('d M Y H:i') }}</p>
                        </div>
                    @empty
                        <p class="text-slate-500">No activity found.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900">My Assignment History</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-slate-50 text-slate-600">
                            <tr>
                                <th class="px-6 py-3 font-semibold text-left">Asset</th>
                                <th class="px-6 py-3 font-semibold text-left">Department</th>
                                <th class="px-6 py-3 font-semibold text-left">Assigned At</th>
                                <th class="px-6 py-3 font-semibold text-left">Returned At</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($myAssignmentHistory as $assignment)
                                <tr class="hover:bg-slate-50/70">
                                    <td class="px-6 py-4 text-slate-700">{{ $assignment->item?->name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-slate-700">{{ $assignment->assignedDepartment?->name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-slate-500">{{ $assignment->assigned_at?->format('d M Y H:i') }}</td>
                                    <td class="px-6 py-4 text-slate-500">{{ $assignment->returned_at?->format('d M Y H:i') ?? '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-slate-500">No assignment history.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900">My Notifications</h2>
                </div>
                <div class="p-6 space-y-3 text-sm">
                    @forelse($myNotifications as $notification)
                        <a href="{{ route('notifications.open', $notification) }}"
                            class="block px-3 py-3 transition border border-transparent rounded-xl hover:border-slate-200 hover:bg-slate-50">
                            <p class="font-medium text-slate-900">{{ $notification->title }}</p>
                            <p class="mt-1 text-slate-500">{{ $notification->message }}</p>
                        </a>
                    @empty
                        <p class="text-slate-500">No notifications found.</p>
                    @endforelse
                </div>
            </div>
        </div>
    @endif
@endsection