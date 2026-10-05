

<?php $__env->startSection('title', 'Users'); ?>

<?php $__env->startPush('css'); ?>
    <link href="/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
    <style>
        /* Role select styling */
        .role-select {
            min-width: 130px;
            font-size: 13px;
            padding: 4px 8px;
            border-radius: 6px;
            border: 1px solid #dee2e6;
            cursor: pointer;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .role-select:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 2px rgba(78, 115, 223, 0.25);
            outline: none;
        }

        /* Saving spinner state */
        .role-select.saving {
            opacity: 0.6;
            pointer-events: none;
        }

        /* Success flash on select */
        .role-select.role-saved {
            border-color: #1cc88a !important;
            box-shadow: 0 0 0 2px rgba(28, 200, 138, 0.3) !important;
            transition: all 0.3s ease;
        }

        /* Error flash on select */
        .role-select.role-error {
            border-color: #e74a3b !important;
            box-shadow: 0 0 0 2px rgba(231, 74, 59, 0.3) !important;
        }

        /* Inline toast */
        .role-toast {
            display: inline-block;
            font-size: 11px;
            margin-left: 6px;
            padding: 2px 8px;
            border-radius: 12px;
            font-weight: 600;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .role-toast.show {
            opacity: 1;
        }

        .role-toast.success {
            background: #d4edda;
            color: #155724;
        }

        .role-toast.error {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="/assets/plugins/datatables.net/js/dataTables.min.js"></script>
    <script src="/assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>

    <script src="/assets/plugins/@highlightjs/cdn-assets/highlight.min.js"></script>
    <script src="/assets/js/demo/render.highlight.js"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb float-xl-end">
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.home')); ?>">Home</a></li>
        <li class="breadcrumb-item active"><a href="<?php echo e(route('admin.users.index')); ?>">Users</a></li>
    </ol>
    <!-- END breadcrumb -->

    <h1 class="page-header">Users</h1>

    <div class="panel panel-inverse">
        <!-- BEGIN panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-create')): ?>
                    <a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-primary w-100px" title="Add User">
                        Add User
                    </a>
                <?php endif; ?>
            </h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand">
                    <i class="fa fa-expand"></i>
                </a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload">
                    <i class="fa fa-redo"></i>
                </a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse">
                    <i class="fa fa-minus"></i>
                </a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <!-- END panel-heading -->

        <!-- BEGIN panel-body -->
        <div class="panel-body">

            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <table id="data-table-default" width="100%"
                class="table table-striped table-bordered align-middle text-nowrap">
                <thead>
                    <tr>
                        <th width="1%">#</th>
                        <th width="1%" data-orderable="false">Photo</th>
                        <th class="text-nowrap">Name</th>
                        <th class="text-nowrap">Email</th>
                        <th class="text-nowrap">Phone</th>
                        <th class="text-nowrap">Role</th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="odd gradeX">

                            
                            <td width="1%" class="fw-bold"><?php echo e($key + 1); ?></td>

                            
                            <td width="1%" class="with-img">
                                <?php if($user->profile_image): ?>
                                    <img class="rounded h-30px my-n1 mx-n1"
                                        src="<?php echo e(asset('storage/' . $user->profile_image)); ?>" alt="<?php echo e($user->name); ?>" />
                                <?php else: ?>
                                    <img src="/assets/img/user/user-13.jpg" class="rounded h-30px my-n1 mx-n1"
                                        alt="Default" />
                                <?php endif; ?>
                            </td>

                            
                            <td><?php echo e($user->name); ?></td>

                            
                            <td><?php echo e($user->email); ?></td>

                            
                            <td><?php echo e($user->phone ?? 'N/A'); ?></td>

                            
                            
                            <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-assign-role')): ?>
                                    <div class="d-flex align-items-center">
                                        <select class="form-control role-select" data-user-id="<?php echo e($user->id); ?>"
                                            data-current-role="<?php echo e($user->roles->first()?->id ?? ''); ?>"
                                            data-update-url="<?php echo e(route('admin.users.update-role', $user->id)); ?>"
                                            title="Change role">
                                            <option value="" disabled <?php echo e($user->roles->isEmpty() ? 'selected' : ''); ?>>
                                                Select Role
                                            </option>
                                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($role->id); ?>"
                                                    <?php echo e($user->roles->first()?->id == $role->id ? 'selected' : ''); ?>>
                                                    <?php echo e(ucfirst($role->name)); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        
                                        <span class="role-toast" id="toast-<?php echo e($user->id); ?>"></span>
                                    </div>
                                <?php endif; ?>
                            </td>

                            
                            <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-edit')): ?>
                                    <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" class="btn btn-warning btn-sm"
                                        title="Edit User">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-view')): ?>
                                    <a href="<?php echo e(route('admin.users.show', $user->id)); ?>" class="btn btn-info btn-sm"
                                        title="Show User">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-delete')): ?>
                                    <form action="<?php echo e(route('admin.users.destroy', $user->id)); ?>" method="POST"
                                        style="display:inline-block;" class="delete-form">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete User">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

        </div>
        <!-- END panel-body -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // =========================================
            // DELETE FORM — confirmation
            // =========================================
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    if (confirm('Are you sure you want to delete this user?')) {
                        form.submit();
                    }
                });
            });

            // =========================================
            // ROLE SELECT — AJAX save to users table
            // Select karte hi turant save ho jayega
            // =========================================
            document.querySelectorAll('.role-select').forEach(function(select) {

                select.addEventListener('change', function() {

                    const userId = this.dataset.userId;
                    const roleId = this.value;
                    const previousRole = this.dataset.currentRole;
                    const updateUrl = this.dataset.updateUrl;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                    const toast = document.getElementById('toast-' + userId);

                    if (!roleId) return;

                    // Skip if same role is selected (no change needed)
                    if (String(roleId) === String(previousRole)) {
                        if (toast) {
                            toast.className = 'role-toast success show';
                            toast.textContent = 'Already saved';
                        }
                        setTimeout(() => {
                            if (toast) toast.classList.remove('show');
                        }, 1500);
                        return;
                    }

                    this.classList.add('saving');
                    this.disabled = true;
                    if (toast) {
                        toast.className = 'role-toast';
                        toast.textContent = 'Saving...';
                        toast.classList.add('show');
                    }

                    fetch(updateUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({
                                role_id: roleId
                            }),
                        })
                        .then(async response => {
                            this.classList.remove('saving');
                            const contentType = response.headers.get('content-type');
                            const isJson = contentType && contentType.includes(
                                'application/json');
                            if (!response.ok) {
                                if (isJson) {
                                    const err = await response.json();
                                    throw err;
                                }
                                throw new Error('HTTP error ' + response.status);
                            }
                            return isJson ? response.json() : {
                                success: true
                            };
                        })
                        .then(data => {
                            this.disabled = false;
                            this.classList.remove('role-saved', 'role-error');
                            if (data.success) {
                                this.dataset.currentRole = roleId;
                                this.classList.add('role-saved');
                                if (toast) {
                                    toast.className = 'role-toast success show';
                                    toast.textContent = 'Saved!';
                                }
                                setTimeout(() => {
                                    this.classList.remove('role-saved');
                                    if (toast) toast.classList.remove('show');
                                }, 2000);
                            } else {
                                throw new Error(data.message || 'Update failed');
                            }
                        })
                        .catch(error => {
                            this.disabled = false;
                            this.classList.remove('saving', 'role-saved');
                            this.classList.add('role-error');
                            this.value = previousRole;
                            this.dataset.currentRole = previousRole;
                            const message = error.message || 'Something went wrong';
                            console.error('Role update error:', message, error);
                            if (toast) {
                                toast.className = 'role-toast error show';
                                toast.textContent = typeof message === 'string' ? message :
                                    'Error';
                            }
                            setTimeout(() => {
                                this.classList.remove('role-error');
                                if (toast) toast.classList.remove('show');
                            }, 3000);
                        });

                }); // change end

            }); // forEach end

        }); // DOMContentLoaded end
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\backend\unify-wizards-new\resources\views/admin/pages/users/index.blade.php ENDPATH**/ ?>