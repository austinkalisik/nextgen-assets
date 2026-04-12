

<?php $__env->startSection('content'); ?>
    <?php if($dashboardMode === 'operations'): ?>
        <div class="flex flex-col gap-4 mb-8 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Admin Dashboard</h1>
                <p class="mt-2 text-sm text-slate-500 sm:text-base">
                    Operational control center for assets, assignments, users, and system activity.
                </p>
            </div>

            <?php if(auth()->user()->isAdmin() || auth()->user()->isAssetOfficer()): ?>
                <div class="flex flex-wrap gap-3">
                    <a href="<?php echo e(route('items.create')); ?>"
                        class="inline-flex items-center rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                        + Add Asset
                    </a>
                    <a href="<?php echo e(route('assignments.create')); ?>"
                        class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                        + Assign Asset
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <div class="grid grid-cols-1 gap-4 mb-8 sm:grid-cols-2 xl:grid-cols-6">
            <div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
                <p class="text-sm font-medium text-slate-500">Total Assets</p>
                <h2 class="mt-3 text-3xl font-bold text-slate-900"><?php echo e($totalAssets); ?></h2>
            </div>

            <div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
                <p class="text-sm font-medium text-slate-500">Available</p>
                <h2 class="mt-3 text-3xl font-bold text-emerald-600"><?php echo e($availableAssets); ?></h2>
            </div>

            <div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
                <p class="text-sm font-medium text-slate-500">Assigned</p>
                <h2 class="mt-3 text-3xl font-bold text-amber-500"><?php echo e($assignedAssets); ?></h2>
            </div>

            <div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
                <p class="text-sm font-medium text-slate-500">Maintenance</p>
                <h2 class="mt-3 text-3xl font-bold text-rose-500"><?php echo e($maintenanceAssets); ?></h2>
            </div>

            <div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
                <p class="text-sm font-medium text-slate-500">Low Stock</p>
                <h2 class="mt-3 text-3xl font-bold text-orange-500"><?php echo e($lowStockAssets); ?></h2>
            </div>

            <div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
                <p class="text-sm font-medium text-slate-500">Overdue</p>
                <h2 class="mt-3 text-3xl font-bold text-red-600"><?php echo e($overdueAssignments); ?></h2>
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
                            <?php $__empty_1 = true; $__currentLoopData = $recentAssignments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assignment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-slate-50/70">
                                    <td class="px-6 py-4 text-slate-700"><?php echo e($assignment->item?->name ?? '-'); ?></td>
                                    <td class="px-6 py-4 text-slate-700"><?php echo e($assignment->user?->name ?? '-'); ?></td>
                                    <td class="px-6 py-4 text-slate-700"><?php echo e($assignment->assignedDepartment?->name ?? '-'); ?></td>
                                    <td class="px-6 py-4 text-slate-500"><?php echo e($assignment->assigned_at?->format('d M Y H:i')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-slate-500">No recent assignments.</td>
                                </tr>
                            <?php endif; ?>
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
                        <?php $__empty_1 = true; $__currentLoopData = $recentActivity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="pb-4 border-b border-slate-100 last:border-b-0 last:pb-0">
                                <p class="font-semibold text-slate-900">
                                    <?php echo e(ucfirst(str_replace('_', ' ', $activity->action))); ?>

                                </p>
                                <p class="mt-1 text-slate-600"><?php echo e($activity->item?->name ?? 'Unknown asset'); ?></p>
                                <p class="mt-1 text-xs text-slate-400">
                                    by <?php echo e($activity->user?->name ?? 'System'); ?> · <?php echo e($activity->created_at?->format('d M Y H:i')); ?>

                                </p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-slate-500">No recent activity.</p>
                        <?php endif; ?>
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
                    <?php $__currentLoopData = $categorySummary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center justify-between pb-2 border-b border-slate-100 last:border-b-0 last:pb-0">
                            <span class="text-slate-600"><?php echo e($category->name); ?></span>
                            <span class="font-semibold text-slate-900"><?php echo e($category->items_count); ?></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900">Department Summary</h2>
                </div>
                <div class="p-6 space-y-3 text-sm">
                    <?php $__currentLoopData = $departmentSummary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center justify-between pb-2 border-b border-slate-100 last:border-b-0 last:pb-0">
                            <span class="text-slate-600"><?php echo e($department->name); ?></span>
                            <span class="font-semibold text-slate-900"><?php echo e($department->items_count); ?></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900">User Roles</h2>
                </div>
                <div class="p-6 space-y-3 text-sm">
                    <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                        <span class="text-slate-600">Admins</span>
                        <span class="font-semibold text-slate-900"><?php echo e($usersByRole['admin'] ?? 0); ?></span>
                    </div>
                    <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                        <span class="text-slate-600">Managers</span>
                        <span class="font-semibold text-slate-900"><?php echo e($usersByRole['manager'] ?? 0); ?></span>
                    </div>
                    <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                        <span class="text-slate-600">Asset Officers</span>
                        <span class="font-semibold text-slate-900"><?php echo e($usersByRole['asset_officer'] ?? 0); ?></span>
                    </div>
                    <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                        <span class="text-slate-600">Staff</span>
                        <span class="font-semibold text-slate-900"><?php echo e($usersByRole['staff'] ?? 0); ?></span>
                    </div>
                    <div class="flex items-center justify-between pt-1">
                        <span class="text-slate-600">Active Assignments</span>
                        <span class="font-semibold text-slate-900"><?php echo e($activeAssignments); ?></span>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900">Unread Notifications</h2>
                </div>
                <div class="p-6 space-y-3 text-sm">
                    <?php $__empty_1 = true; $__currentLoopData = $unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <a href="<?php echo e(route('notifications.open', $notification)); ?>"
                            class="block px-3 py-3 transition border border-transparent rounded-xl hover:border-slate-200 hover:bg-slate-50">
                            <p class="font-medium text-slate-900"><?php echo e($notification->title); ?></p>
                            <p class="mt-1 text-slate-500"><?php echo e($notification->message); ?></p>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-slate-500">No unread notifications.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">My Workspace</h1>
            <p class="mt-2 text-sm text-slate-500 sm:text-base">
                Personal asset overview, assignment tracking, and recent activity.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-4 mb-8 sm:grid-cols-2 xl:grid-cols-4">
            <div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
                <p class="text-sm font-medium text-slate-500">My Active Assets</p>
                <h2 class="mt-3 text-3xl font-bold text-slate-900"><?php echo e($myAssignedAssetsCount); ?></h2>
            </div>

            <div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
                <p class="text-sm font-medium text-slate-500">Overdue Assets</p>
                <h2 class="mt-3 text-3xl font-bold text-red-600"><?php echo e($myOverdueAssignmentsCount); ?></h2>
            </div>

            <div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
                <p class="text-sm font-medium text-slate-500">Departments Used</p>
                <h2 class="mt-3 text-3xl font-bold text-blue-600"><?php echo e($myDepartmentCount); ?></h2>
            </div>

            <div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
                <p class="text-sm font-medium text-slate-500">Assets In Maintenance</p>
                <h2 class="mt-3 text-3xl font-bold text-amber-500"><?php echo e($myAssetsInMaintenance); ?></h2>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 mb-8 xl:grid-cols-2">
            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900">My Active Assignments</h2>
                </div>
                <div class="p-6 space-y-4 text-sm">
                    <?php $__empty_1 = true; $__currentLoopData = $myActiveAssignments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assignment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="p-4 border rounded-2xl border-slate-200">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                                <div>
                                    <p class="font-semibold text-slate-900"><?php echo e($assignment->item?->name ?? '-'); ?></p>
                                    <p class="mt-1 text-slate-500"><?php echo e($assignment->assignedDepartment?->name ?? '-'); ?></p>
                                    <p class="mt-2 text-xs text-slate-400">
                                        Assigned <?php echo e($assignment->assigned_at?->format('d M Y H:i')); ?>

                                    </p>
                                </div>

                                <?php if($assignment->item): ?>
                                    <a href="<?php echo e(route('items.show', $assignment->item)); ?>"
                                        class="inline-flex items-center px-3 py-2 text-xs font-semibold text-white transition rounded-xl bg-slate-900 hover:bg-slate-800">
                                        View Asset
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-slate-500">No active assignments.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900">My Recent Activity</h2>
                </div>
                <div class="p-6 space-y-4 text-sm">
                    <?php $__empty_1 = true; $__currentLoopData = $myRecentActivity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="pb-3 border-b border-slate-100 last:border-b-0 last:pb-0">
                            <p class="font-semibold text-slate-900"><?php echo e(ucfirst(str_replace('_', ' ', $activity->action))); ?></p>
                            <p class="text-slate-600"><?php echo e($activity->item?->name ?? 'Unknown asset'); ?></p>
                            <p class="text-xs text-slate-400"><?php echo e($activity->created_at?->format('d M Y H:i')); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-slate-500">No activity found.</p>
                    <?php endif; ?>
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
                            <?php $__empty_1 = true; $__currentLoopData = $myAssignmentHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assignment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-slate-50/70">
                                    <td class="px-6 py-4 text-slate-700"><?php echo e($assignment->item?->name ?? '-'); ?></td>
                                    <td class="px-6 py-4 text-slate-700"><?php echo e($assignment->assignedDepartment?->name ?? '-'); ?></td>
                                    <td class="px-6 py-4 text-slate-500"><?php echo e($assignment->assigned_at?->format('d M Y H:i')); ?></td>
                                    <td class="px-6 py-4 text-slate-500"><?php echo e($assignment->returned_at?->format('d M Y H:i') ?? '-'); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-slate-500">No assignment history.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900">My Notifications</h2>
                </div>
                <div class="p-6 space-y-3 text-sm">
                    <?php $__empty_1 = true; $__currentLoopData = $myNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <a href="<?php echo e(route('notifications.open', $notification)); ?>"
                            class="block px-3 py-3 transition border border-transparent rounded-xl hover:border-slate-200 hover:bg-slate-50">
                            <p class="font-medium text-slate-900"><?php echo e($notification->title); ?></p>
                            <p class="mt-1 text-slate-500"><?php echo e($notification->message); ?></p>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-slate-500">No notifications found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\akalisik\Project\backend\resources\views/dashboard/index.blade.php ENDPATH**/ ?>