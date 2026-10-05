<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startPush('css'); ?>
    <link href="/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <style>
        :root {
            --card-bg: #ffffff;
            --card-radius: 16px;
            --card-border: 1px solid rgba(0, 0, 0, .07);
            --text-primary: #1a1d23;
            --text-secondary: #6b7080;
            --text-muted: #9ea5b8;
            --shadow-sm: 0 1px 4px rgba(0, 0, 0, .06), 0 0 1px rgba(0, 0, 0, .04);
            --shadow-md: 0 6px 24px rgba(0, 0, 0, .10), 0 1px 4px rgba(0, 0, 0, .05);
        }

        .page-header {
            font-size: 22px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 45px;
            letter-spacing: -.3px;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin-bottom: 24px;
            font-size: 13px;
        }

        .breadcrumb-item a {
            color: var(--text-secondary);
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: var(--text-primary);
            font-weight: 500;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            color: var(--text-muted);
        }

        /* ── 4 cards per row ───────────────────────────────────── */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        /* ── Card ──────────────────────────────────────────────── */
        .stat-card {
            background: var(--card-bg);
            border-radius: var(--card-radius);
            border: var(--card-border);
            box-shadow: var(--shadow-sm);
            padding: 28px 24px 22px;
            position: relative;
            overflow: hidden;
            min-height: 180px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            cursor: default;
            transition: transform .18s ease, box-shadow .18s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        /* top accent stripe */
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            border-radius: var(--card-radius) var(--card-radius) 0 0;
        }

        /* background circle */
        .stat-card::after {
            content: '';
            position: absolute;
            right: -24px;
            top: -24px;
            width: 110px;
            height: 110px;
            border-radius: 50%;
            opacity: .06;
        }

        /* ── Themes ─────────────────────────────────────────────── */
        .theme-blue::before {
            background: #3b82f6;
        }

        .theme-blue::after {
            background: #3b82f6;
        }

        .theme-orange::before {
            background: #f97316;
        }

        .theme-orange::after {
            background: #f97316;
        }

        .theme-red::before {
            background: #ef4444;
        }

        .theme-red::after {
            background: #ef4444;
        }

        .theme-teal::before {
            background: #14b8a6;
        }

        .theme-teal::after {
            background: #14b8a6;
        }

        .theme-purple::before {
            background: #8b5cf6;
        }

        .theme-purple::after {
            background: #8b5cf6;
        }

        .theme-pink::before {
            background: #ec4899;
        }

        .theme-pink::after {
            background: #ec4899;
        }

        /* ── Top Row ────────────────────────────────────────────── */
        .stat-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .stat-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .07em;
            text-transform: uppercase;
            color: var(--text-secondary);
            line-height: 1.4;
            max-width: 70%;
        }

        /* ── Icon Badge ─────────────────────────────────────────── */
        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .theme-blue .stat-icon {
            background: #eff6ff;
            color: #2563eb;
        }

        .theme-orange .stat-icon {
            background: #fff7ed;
            color: #c2410c;
        }

        .theme-red .stat-icon {
            background: #fef2f2;
            color: #dc2626;
        }

        .theme-teal .stat-icon {
            background: #f0fdfa;
            color: #0f766e;
        }

        .theme-purple .stat-icon {
            background: #f5f3ff;
            color: #7c3aed;
        }

        .theme-pink .stat-icon {
            background: #fdf2f8;
            color: #be185d;
        }

        /* ── Value ──────────────────────────────────────────────── */
        .stat-value {
            font-size: 36px;
            font-weight: 700;
            color: var(--text-primary);
            line-height: 1;
            margin-bottom: 10px;
            letter-spacing: -1.5px;
        }

        /* ── Trend ──────────────────────────────────────────────── */
        .stat-trend {
            font-size: 12px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 14px;
        }

        .badge-up {
            background: #f0fdf4;
            color: #16a34a;
            border-radius: 20px;
            padding: 2px 8px;
            font-weight: 600;
            font-size: 11px;
        }

        .badge-down {
            background: #fef2f2;
            color: #dc2626;
            border-radius: 20px;
            padding: 2px 8px;
            font-weight: 600;
            font-size: 11px;
        }

        /* ── Sparkline ──────────────────────────────────────────── */
        .stat-sparkline {
            display: flex;
            align-items: flex-end;
            gap: 4px;
            height: 28px;
        }

        .stat-sparkline span {
            flex: 1;
            border-radius: 3px;
            opacity: .3;
            transition: opacity .15s;
        }

        .stat-card:hover .stat-sparkline span {
            opacity: .7;
        }

        .theme-blue .stat-sparkline span {
            background: #3b82f6;
        }

        .theme-orange .stat-sparkline span {
            background: #f97316;
        }

        .theme-red .stat-sparkline span {
            background: #ef4444;
        }

        .theme-teal .stat-sparkline span {
            background: #14b8a6;
        }

        .theme-purple .stat-sparkline span {
            background: #8b5cf6;
        }

        .theme-pink .stat-sparkline span {
            background: #ec4899;
        }

        /* ── Responsive ─────────────────────────────────────────── */
        @media (max-width: 1200px) {
            .stats-row {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 900px) {
            .stats-row {
                grid-template-columns: repeat(2, 1fr);
            }

            .stat-card {
                min-height: 160px;
            }
        }

        @media (max-width: 520px) {
            .stats-row {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .stat-value {
                font-size: 28px;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="/assets/plugins/gritter/js/jquery.gritter.js"></script>
    <script src="/assets/plugins/flot/source/jquery.canvaswrapper.js"></script>
    <script src="/assets/plugins/flot/source/jquery.colorhelpers.js"></script>
    <script src="/assets/plugins/flot/source/jquery.flot.js"></script>
    <script src="/assets/plugins/flot/source/jquery.flot.saturated.js"></script>
    <script src="/assets/plugins/flot/source/jquery.flot.browser.js"></script>
    <script src="/assets/plugins/flot/source/jquery.flot.drawSeries.js"></script>
    <script src="/assets/plugins/flot/source/jquery.flot.uiConstants.js"></script>
    <script src="/assets/plugins/flot/source/jquery.flot.time.js"></script>
    <script src="/assets/plugins/flot/source/jquery.flot.resize.js"></script>
    <script src="/assets/plugins/flot/source/jquery.flot.pie.js"></script>
    <script src="/assets/plugins/flot/source/jquery.flot.crosshair.js"></script>
    <script src="/assets/plugins/flot/source/jquery.flot.categories.js"></script>
    <script src="/assets/plugins/flot/source/jquery.flot.navigate.js"></script>
    <script src="/assets/plugins/flot/source/jquery.flot.touchNavigate.js"></script>
    <script src="/assets/plugins/flot/source/jquery.flot.hover.js"></script>
    <script src="/assets/plugins/flot/source/jquery.flot.touch.js"></script>
    <script src="/assets/plugins/flot/source/jquery.flot.selection.js"></script>
    <script src="/assets/plugins/flot/source/jquery.flot.symbol.js"></script>
    <script src="/assets/plugins/flot/source/jquery.flot.legend.js"></script>
    <script src="/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="/assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
    <script src="/assets/plugins/jvectormap-content/world-mill.js"></script>
    <script src="/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
    <script src="/assets/js/demo/dashboard.js"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    
    <ol class="breadcrumb float-xl-end">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    
    <h1 class="page-header">Dashboard</h1>

    
    <div class="stats-row">

        
        <div class="stat-card theme-blue">
            <div>
                <div class="stat-head">
                    <span class="stat-label">Total Forms</span>
                    <div class="stat-icon"><i class="fa fa-wpforms"></i></div>
                </div>
                <div class="stat-value"><?php echo e($totalBlogForms); ?></div>
                <div class="stat-trend">
                    <span class="badge-up">↑ 12%</span> this month
                </div>
            </div>
            <div class="stat-sparkline">
                <span style="height:40%"></span>
                <span style="height:55%"></span>
                <span style="height:45%"></span>
                <span style="height:70%"></span>
                <span style="height:60%"></span>
                <span style="height:85%"></span>
                <span style="height:100%"></span>
            </div>
        </div>

        
        <div class="stat-card theme-orange">
            <div>
                <div class="stat-head">
                    <span class="stat-label">Total Services</span>
                    <div class="stat-icon"><i class="fa fa-cogs"></i></div>
                </div>
                <div class="stat-value"><?php echo e($totalServices); ?></div>
                <div class="stat-trend">
                    <span class="badge-up">↑ 5%</span> this month
                </div>
            </div>
            <div class="stat-sparkline">
                <span style="height:50%"></span>
                <span style="height:60%"></span>
                <span style="height:55%"></span>
                <span style="height:65%"></span>
                <span style="height:75%"></span>
                <span style="height:70%"></span>
                <span style="height:100%"></span>
            </div>
        </div>

        
        <div class="stat-card theme-red">
            <div>
                <div class="stat-head">
                    <span class="stat-label">Total Blogs</span>
                    <div class="stat-icon"><i class="fa fa-newspaper-o"></i></div>
                </div>
                <div class="stat-value"><?php echo e($totalBlogs); ?></div>
                <div class="stat-trend">
                    <span class="badge-down">↓ 2%</span> this month
                </div>
            </div>
            <div class="stat-sparkline">
                <span style="height:80%"></span>
                <span style="height:65%"></span>
                <span style="height:90%"></span>
                <span style="height:70%"></span>
                <span style="height:75%"></span>
                <span style="height:60%"></span>
                <span style="height:100%"></span>
            </div>
        </div>

        
        <div class="stat-card theme-teal">
            <div>
                <div class="stat-head">
                    <span class="stat-label">Published Blogs</span>
                    <div class="stat-icon"><i class="fa fa-check-circle"></i></div>
                </div>
                <div class="stat-value"><?php echo e($publishedBlogs); ?></div>
                <div class="stat-trend">
                    <span class="badge-up">↑ 8%</span> this month
                </div>
            </div>
            <div class="stat-sparkline">
                <span style="height:45%"></span>
                <span style="height:55%"></span>
                <span style="height:65%"></span>
                <span style="height:60%"></span>
                <span style="height:85%"></span>
                <span style="height:90%"></span>
                <span style="height:100%"></span>
            </div>
        </div>

    </div>
    

    
    <div class="stats-row">

        
        <div class="stat-card theme-purple">
            <div>
                <div class="stat-head">
                    <span class="stat-label">Total Contacts</span>
                    <div class="stat-icon"><i class="fa fa-users"></i></div>
                </div>
                <div class="stat-value"><?php echo e($totalContacts); ?></div>
                <div class="stat-trend">
                    <span class="badge-up">↑ 18%</span> this month
                </div>
            </div>
            <div class="stat-sparkline">
                <span style="height:30%"></span>
                <span style="height:50%"></span>
                <span style="height:45%"></span>
                <span style="height:70%"></span>
                <span style="height:65%"></span>
                <span style="height:88%"></span>
                <span style="height:100%"></span>
            </div>
        </div>

        
        <div class="stat-card theme-pink">
            <div>
                <div class="stat-head">
                    <span class="stat-label">Newsletter Subscribers</span>
                    <div class="stat-icon"><i class="fa fa-envelope"></i></div>
                </div>
                <div class="stat-value"><?php echo e($totalNewsletters); ?></div>
                <div class="stat-trend">
                    <span class="badge-up">↑ 24%</span> this month
                </div>
            </div>
            <div class="stat-sparkline">
                <span style="height:25%"></span>
                <span style="height:40%"></span>
                <span style="height:55%"></span>
                <span style="height:60%"></span>
                <span style="height:75%"></span>
                <span style="height:85%"></span>
                <span style="height:100%"></span>
            </div>
        </div>

    </div>
    

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\backend\unify-wizards-new\resources\views/admin/home.blade.php ENDPATH**/ ?>