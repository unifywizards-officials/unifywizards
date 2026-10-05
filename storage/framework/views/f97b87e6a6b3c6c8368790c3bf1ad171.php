<?php
    $isBuildingMenuActive =
        request()->routeIs('admin.buildings.index') ||
        request()->routeIs('admin.unit-types.index') ||
        request()->routeIs('admin.units.index') ||
        request()->routeIs('admin.assets-locations.index') ||
        request()->routeIs('admin.building-assets.index');
?>
<?php
    $appSidebarClass = !empty($appSidebarTransparent) ? 'app-sidebar-transparent' : '';
    $appSidebarAttr = !empty($appSidebarLight) ? '' : ' data-bs-theme=dark';
?>
<!-- BEGIN #sidebar -->
<div id="sidebar" class="app-sidebar <?php echo e($appSidebarClass); ?>" <?php echo e($appSidebarAttr); ?>>
    <!-- BEGIN scrollbar -->
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <div class="menu mt-3">
            <?php if(!$appSidebarSearch): ?>
                <!-- <div class="menu-profile">
    <a href="javascript:;" class="menu-profile-link" data-toggle="app-sidebar-profile" data-target="#appSidebarProfileMenu">
     <div class="menu-profile-cover with-shadow"></div>

     <div class="menu-profile-info">
      <div class="d-flex align-items-center">
       <div class="flex-grow-1">
        xfdgh
       </div>
       <div class="menu-caret ms-auto"></div>
      </div>
      <small>xcvx</small>
     </div>
    </a>
   </div> -->
                <!-- <div id="appSidebarProfileMenu" class="collapse">
    <div class="menu-item pt-5px">
     <a href="javascript:;" class="menu-link">
      <div class="menu-icon"><i class="fa fa-cog"></i></div>
      <div class="menu-text">Settings</div>
     </a>
    </div>
    <div class="menu-item">
     <a href="javascript:;" class="menu-link">
      <div class="menu-icon"><i class="fa fa-pencil-alt"></i></div>
      <div class="menu-text"> Send Feedback</div>
     </a>
    </div>
    <div class="menu-item pb-5px">
     <a href="javascript:;" class="menu-link">
      <div class="menu-icon"><i class="fa fa-question-circle"></i></div>
      <div class="menu-text"> Helps</div>
     </a>
    </div>
    <div class="menu-divider m-0"></div>
   </div> -->
            <?php endif; ?>

            <?php if($appSidebarSearch): ?>
                <div class="menu-search mb-n3">
                    <input type="text" class="form-control" placeholder="Sidebar menu filter..."
                        data-sidebar-search="true" />
                </div>
            <?php endif; ?>

            <!-- <div class="menu-header">Navigation</div> -->
            <div class="menu-item <?php echo e(isActiveRoute('admin.home')); ?>">
                <a href="<?php echo e(route('admin.home')); ?>" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-sitemap"></i>
                    </div>
                    <div class="menu-text">Dashboard</div>
                </a>
            </div>


            <div class="menu-item <?php echo e(isActiveRoute('media.index')); ?>">
                <a href="<?php echo e(route('media.index')); ?>" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-image"></i>
                    </div>
                    <div class="menu-text">Media</div>
                </a>
            </div>


            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users')): ?>
                <div class="menu-item <?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('admin.users.index')); ?>" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="menu-text">Users</div>
                    </a>
                </div>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view login history')): ?>
                <div class="menu-item <?php echo e(isActiveRoute('admin.login-history.index')); ?>">
                    <a href="<?php echo e(route('admin.login-history.index')); ?>" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-history"></i>
                        </div>
                        <div class="menu-text">Login History</div>
                    </a>
                </div>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['roles', 'permissions'])): ?>
                <?php
                    $isRolesActive = request()->routeIs('admin.roles.*');
                    $isPermissionsActive = request()->routeIs('admin.permissions.*');
                ?>
                <div
                    class="menu-item has-sub <?php echo e($isRolesActive || $isPermissionsActive ? 'active expand' : ''); ?>">

                    <a href="javascript:;" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-shield-alt"></i>
                        </div>

                        <div class="menu-text">
                            Roles & Permissions
                        </div>

                        <div class="menu-caret"></div>
                    </a>

                    <div class="menu-submenu">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles')): ?>
                            <div class="menu-item <?php echo e($isRolesActive ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('admin.roles.index')); ?>" class="menu-link">
                                    <div class="menu-text">
                                        <i class="fa fa-user-shield me-2"></i>
                                        Roles
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permissions')): ?>
                            <div class="menu-item <?php echo e($isPermissionsActive ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('admin.permissions.index')); ?>" class="menu-link">
                                    <div class="menu-text">
                                        <i class="fa fa-key me-2"></i>
                                        Permissions
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            <?php endif; ?>

            

            


            
            <?php
                $isHeroActive = isActiveRoute('admin.home.hero.edit') === 'active';
                $isClientsLogoActive = isActiveRoute('admin.home.clients-logo.edit') === 'active';
                $isOurSolutionsActive = isActiveRoute('admin.home.our-solutions.edit') === 'active';
                $isPricingActive = isActiveRoute('admin.home.pricing.edit') === 'active';
                $isIndustriesActive = isActiveRoute('admin.home.industries.edit') === 'active';
                $isRecognitionPressActive = isActiveRoute('admin.home.recognition.press.edit') === 'active';
                $isCompanyOverviewActive = isActiveRoute('admin.home.company.overview.edit') === 'active';
                $isWhyChooseActive = isActiveRoute('admin.home.why-choose.edit') === 'active';
                $isOurProcessActive = isActiveRoute('admin.home.our-process.edit') === 'active';
                $isAwardsRecognitionActive = isActiveRoute('admin.home.awards.recognition.edit') === 'active';
                $isMarketingSectionsActive = request()->routeIs('admin.home.marketing-sections.*');
                $isHomePortfolioActive = isActiveRoute('admin.home.portfolio.edit') === 'active';
                $isClientsFeedbackActive = isActiveRoute('admin.home.clients-feedback.edit') === 'active';
                $isOutstandingResultsActive = request()->routeIs('outstanding-results.*');
                $isClientRecommendActive = request()->routeIs('client-recommend.*');
                $isRecentAwardsActive = request()->routeIs('recent-awards.*');
                $isReviewScreenshotsActive = request()->routeIs('review-screenshots.*');
                $isBusinessChooseUsActive = request()->routeIs('business-choose-us.*');
                $isHomeCtaActive = request()->routeIs('admin.home.cta.*');

                $isHomeMenuActive =
                    request()->routeIs('admin.home.*') ||
                    $isOutstandingResultsActive ||
                    $isClientRecommendActive ||
                    $isRecentAwardsActive ||
                    $isReviewScreenshotsActive ||
                    $isBusinessChooseUsActive;
            ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('home-page')): ?>
                <div class="menu-item has-sub <?php echo e($isHomeMenuActive ? 'active expand' : ''); ?>">

                    <a href="javascript:;" class="menu-link">

                        <div class="menu-icon">
                            <i class="fa fa-home"></i>
                        </div>

                        <div class="menu-text">
                            Home Page
                        </div>

                        <div class="menu-caret"></div>

                    </a>

                    <div class="menu-submenu">

                        <!-- Hero Section -->
                        <div class="menu-item <?php echo e($isHeroActive ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.home.hero.edit')); ?>" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-image me-2"></i>
                                    Hero Section
                                </div>
                            </a>
                        </div>

                        <!-- Clients Logo -->
                        <div class="menu-item <?php echo e($isClientsLogoActive ? 'active' : ''); ?>">

                            <a href="<?php echo e(route('admin.home.clients-logo.edit')); ?>" class="menu-link">

                                <div class="menu-text">

                                    <i class="fa fa-users me-2"></i>

                                    Clients Logo

                                </div>

                            </a>

                        </div>

                        <!-- Our Solutions -->
                        <div class="menu-item <?php echo e($isOurSolutionsActive ? 'active' : ''); ?>">

                            <a href="<?php echo e(route('admin.home.our-solutions.edit')); ?>" class="menu-link">

                                <div class="menu-text">

                                    <i class="fa fa-cogs me-2"></i>

                                    Our Solutions

                                </div>

                            </a>

                        </div>

                        <!-- Plans & Pricing -->
                        <div class="menu-item <?php echo e($isPricingActive ? 'active' : ''); ?>">

                            <a href="<?php echo e(route('admin.home.pricing.edit')); ?>" class="menu-link">

                                <div class="menu-text">

                                    <i class="fa fa-dollar-sign me-2"></i>

                                    Plans & Pricing

                                </div>

                            </a>

                        </div>

                        <!-- Industries We Serve -->
                        <div class="menu-item <?php echo e($isIndustriesActive ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.home.industries.edit')); ?>" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-industry me-2"></i>
                                    Industries We Serve
                                </div>
                            </a>
                        </div>

                        <!-- Recognition & Press -->
                        <div class="menu-item <?php echo e($isRecognitionPressActive ? 'active' : ''); ?>">

                            <a href="<?php echo e(route('admin.home.recognition.press.edit')); ?>" class="menu-link">

                                <div class="menu-icon">
                                    <i class="fa fa-newspaper"></i>
                                </div>

                                <div class="menu-text">
                                    Recognition & Press
                                </div>

                            </a>

                        </div>

                        <!-- Company Overview -->
                        <div class="menu-item <?php echo e($isCompanyOverviewActive ? 'active' : ''); ?>">

                            <a href="<?php echo e(route('admin.home.company.overview.edit')); ?>" class="menu-link">

                                <div class="menu-text">
                                    <i class="fa fa-building me-2"></i>
                                    Company Overview
                                </div>

                            </a>

                        </div>

                        <!-- Why Choose Us (Homepage) -->
                        <div class="menu-item <?php echo e($isWhyChooseActive ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.home.why-choose.edit')); ?>" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-star me-2"></i>
                                    Why Choose Us
                                </div>
                            </a>
                        </div>

                        <!-- Our Process -->
                        <div class="menu-item <?php echo e($isOurProcessActive ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.home.our-process.edit')); ?>" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-project-diagram me-2"></i>
                                    Our Process
                                </div>
                            </a>
                        </div>

                        <!-- Awards & Recognition -->
                        <div class="menu-item <?php echo e($isAwardsRecognitionActive ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.home.awards.recognition.edit')); ?>" class="menu-link">

                                <div class="menu-text">
                                    <i class="fa fa-trophy me-2"></i>
                                    Awards & Recognition
                                </div>

                            </a>
                        </div>

                        <!-- Growth Marketing Strategy -->
                        <div class="menu-item <?php echo e($isMarketingSectionsActive ? 'active' : ''); ?>">

                            <a href="<?php echo e(route('admin.home.marketing-sections.index')); ?>" class="menu-link">

                                <div class="menu-text">

                                    <i class="fa fa-chart-line me-2"></i>

                                    Growth Marketing Strategy

                                </div>

                            </a>

                        </div>

                        <!-- Portfolio -->
                        <div class="menu-item <?php echo e($isHomePortfolioActive ? 'active' : ''); ?>">

                            <a href="<?php echo e(route('admin.home.portfolio.edit')); ?>" class="menu-link">

                                <div class="menu-text">

                                    <i class="fa fa-briefcase me-2"></i>

                                    Portfolio

                                </div>

                            </a>

                        </div>

                        <!-- Clients Feedback -->
                        <div class="menu-item <?php echo e($isClientsFeedbackActive ? 'active' : ''); ?>">

                            <a href="<?php echo e(route('admin.home.clients-feedback.edit')); ?>" class="menu-link">

                                <div class="menu-text">

                                    <i class="fa fa-comments me-2"></i>

                                    Clients Feedback

                                </div>

                            </a>

                        </div>

                        <!-- Insights Blog -->
                        


                        <div class="menu-item <?php echo e($isOutstandingResultsActive ? 'active' : ''); ?>">

                            <a href="<?php echo e(route('outstanding-results.edit')); ?>" class="menu-link">

                                <div class="menu-text">

                                    <i class="fa fa-trophy me-2"></i>

                                    Outstanding Results

                                </div>

                            </a>

                        </div>

                        <div class="menu-item <?php echo e($isClientRecommendActive ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('client-recommend.edit')); ?>" class="menu-link">

                                <div class="menu-text">
                                    <i class="fa fa-users me-2"></i>
                                    Clients Recommend
                                </div>

                            </a>

                        </div>

                        <div class="menu-item <?php echo e($isRecentAwardsActive ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('recent-awards.edit')); ?>" class="menu-link">
                                <div class="menu-text">

                                    <i class="fa fa-trophy me-2"></i>

                                    Recent Awards

                                </div>
                            </a>
                        </div>


                        <div class="menu-item <?php echo e($isReviewScreenshotsActive ? 'active' : ''); ?>">

                            <a href="<?php echo e(route('review-screenshots.edit')); ?>" class="menu-link">

                                <div class="menu-text">

                                    <i class="fa fa-images me-2"></i>

                                    Review Screenshots

                                </div>

                            </a>

                        </div>


                        <div class="menu-item <?php echo e($isBusinessChooseUsActive ? 'active' : ''); ?>">

                            <a href="<?php echo e(route('business-choose-us.edit')); ?>" class="menu-link">

                                <div class="menu-icon">
                                    <i class="fa fa-briefcase"></i>
                                </div>

                                <div class="menu-text">
                                    Businesses Choose Us
                                </div>

                            </a>

                        </div>


                        <div class="menu-item <?php echo e($isHomeCtaActive ? 'active' : ''); ?>">

                            <a href="<?php echo e(route('admin.home.cta.edit')); ?>" class="menu-link">

                                <div class="menu-text">

                                    <i class="fa fa-bullhorn me-2"></i>

                                    CTA Section

                                </div>

                            </a>

                        </div>

                    </div>

                </div>
            <?php endif; ?>


            
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('about-us')): ?>
                <?php
                    $isAboutHeroActive = isActiveRoute('admin.about-us.hero.index') === 'active';
                    $isAboutIntroActive = isActiveRoute('admin.about-us.introduction.index') === 'active';
                    $isAboutWhyChooseActive = isActiveRoute('admin.about-us.why-choose-us.index') === 'active';
                    $isAboutClientsActive = isActiveRoute('admin.about-us.clients.index') === 'active';
                    $isAboutIndustryActive = isActiveRoute('admin.about-us.industry.index') === 'active';
                    $isAboutReviewsActive = isActiveRoute('admin.about-us.reviews.index') === 'active';
                    $isAboutCtaActive = isActiveRoute('admin.about-us.cta.index') === 'active';
                ?>
                <div class="menu-item has-sub <?php echo e(request()->routeIs('admin.about-us.*') ? 'active expand' : ''); ?>">

                    <a href="javascript:;" class="menu-link">

                        <div class="menu-icon">
                            <i class="fa fa-info-circle"></i>
                        </div>

                        <div class="menu-text">
                            About Us CMS
                        </div>

                        <div class="menu-caret"></div>

                    </a>

                    <div class="menu-submenu">

                        
                        <div class="menu-item <?php echo e($isAboutHeroActive ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.about-us.hero.index')); ?>" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-image me-2"></i>
                                    Hero Section
                                </div>
                            </a>
                        </div>

                        
                        <div class="menu-item <?php echo e($isAboutIntroActive ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.about-us.introduction.index')); ?>" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-align-left me-2"></i>
                                    Introduction
                                </div>
                            </a>
                        </div>


                        
                        <div class="menu-item <?php echo e($isAboutWhyChooseActive ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.about-us.why-choose-us.index')); ?>" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-star me-2"></i>
                                    Why Choose Us
                                </div>
                            </a>
                        </div>

                        
                        <div class="menu-item <?php echo e($isAboutClientsActive ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.about-us.clients.index')); ?>" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-users me-2"></i>
                                    Clients
                                </div>
                            </a>
                        </div>

                        
                        <div class="menu-item <?php echo e($isAboutIndustryActive ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.about-us.industry.index')); ?>" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-briefcase me-2"></i>
                                    Industries
                                </div>
                            </a>
                        </div>

                        
                        <div class="menu-item <?php echo e($isAboutReviewsActive ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.about-us.reviews.index')); ?>" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-comments me-2"></i>
                                    Reviews
                                </div>
                            </a>
                        </div>

                        
                        <div class="menu-item <?php echo e($isAboutCtaActive ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.about-us.cta.index')); ?>" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-bullhorn me-2"></i>
                                    CTA Section
                                </div>
                            </a>
                        </div>

                    </div>

                </div>
            <?php endif; ?>

            
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('services')): ?>
                <div class="menu-item has-sub <?php echo e(request()->routeIs('admin.dm.*') ? 'active expand' : ''); ?>">

                    <a href="javascript:;" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-bullhorn"></i>
                        </div>

                        <div class="menu-text">Services</div>
                        <div class="menu-caret"></div>
                    </a>

                    <div class="menu-submenu">

                        <div class="menu-item <?php echo e(request()->routeIs('admin.dm.page.*') ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.dm.page.index')); ?>" class="menu-link">
                                <div class="menu-text">
                                    Manage Services
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            <?php endif; ?>


            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blogs')): ?>
                <div class="menu-item <?php echo e(request()->routeIs('admin.blogs.*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('admin.blogs.index')); ?>" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-blog"></i>
                        </div>
                        <div class="menu-text">Blogs</div>
                    </a>
                </div>
            <?php endif; ?>


            <?php
                $isSettingsPageActive = isActiveRoute('admin.settings.index') === 'active';
                $isSeoActive = request()->routeIs('admin.seo.*');
                $isSchemasActive = request()->routeIs('admin.schemas.*');
                $isExtrafoldActive = request()->routeIs('admin.extrafold.*');
                $isTermsActive = request()->routeIs('admin.terms_conditions*');
                $isPrivacyActive = request()->routeIs('admin.privacy_policy*');
                $isBlogFormActive = request()->routeIs('admin.blog.forms*');
                $isContactProposalActive = isActiveRoute('admin.contact-perposal.index') === 'active';
                $isContactInquiryActive = isActiveRoute('admin.contact-inquiry.index') === 'active';
                $isContactActive = isActiveRoute('admin.contact.index') === 'active';

                $settingsActive =
                    $isSettingsPageActive ||
                    $isSeoActive ||
                    $isSchemasActive ||
                    $isExtrafoldActive ||
                    $isTermsActive ||
                    $isPrivacyActive ||
                    $isBlogFormActive ||
                    $isContactProposalActive ||
                    $isContactInquiryActive ||
                    $isContactActive;
            ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('settings')): ?>
                <div class="menu-item has-sub <?php echo e($settingsActive ? 'active expand' : ''); ?>">

                    <a href="javascript:;" class="menu-link">

                        <div class="menu-icon">
                            <i class="fa fa-cogs"></i>
                        </div>

                        <div class="menu-text">
                            Settings
                        </div>

                        <div class="menu-caret"></div>

                    </a>

                    <div class="menu-submenu">

                        <!-- Settings Page -->
                        <div class="menu-item <?php echo e($isSettingsPageActive ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.settings.index')); ?>" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-sliders-h me-2"></i>
                                    Setting Pages
                                </div>
                            </a>
                        </div>

                        <!-- SEO Management -->
                        <div class="menu-item <?php echo e($isSeoActive ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.seo.index')); ?>" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-chart-line me-2"></i>
                                    SEO Management
                                </div>
                            </a>
                        </div>

                        <!-- Schema Management -->
                        <div class="menu-item <?php echo e($isSchemasActive ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.schemas.index')); ?>" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-chart-line me-2"></i>
                                    Schemas Management
                                </div>
                            </a>
                        </div>


                        <div class="menu-item <?php echo e($isExtrafoldActive ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.extrafold.index')); ?>" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-chart-line me-2"></i>
                                    Extra Fold
                                </div>
                            </a>
                        </div>

                        <!-- Terms -->
                        <div class="menu-item <?php echo e($isTermsActive ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.terms_conditions')); ?>" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-file-alt me-2"></i>
                                    Terms and Conditions
                                </div>
                            </a>
                        </div>

                        <!-- Privacy -->
                        <div class="menu-item <?php echo e($isPrivacyActive ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.privacy_policy')); ?>" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-user-shield me-2"></i>
                                    Privacy Policy
                                </div>
                            </a>
                        </div>

                        <div class="menu-item <?php echo e($isBlogFormActive ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.blog.forms')); ?>" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-user-shield me-2"></i>
                                    Blog Form
                                </div>
                            </a>
                        </div>


                        <div class="menu-item <?php echo e($isContactProposalActive ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.contact-perposal.index')); ?>" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-envelope me-2"></i>
                                    Contact Proposal
                                </div>
                            </a>
                        </div>


                        <div class="menu-item <?php echo e($isContactInquiryActive ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.contact-inquiry.index')); ?>" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-envelope me-2"></i>
                                    Contact Inquiry
                                </div>
                            </a>
                        </div>


                        <div class="menu-item <?php echo e($isContactActive ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.contact.index')); ?>" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-envelope me-2"></i>
                                    Contact
                                </div>
                            </a>
                        </div>


                    </div>

                </div>
            <?php endif; ?>

            <div class="menu-item <?php echo e(request()->routeIs('admin.password.*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('admin.password.change')); ?>" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-key"></i>
                    </div>
                    <div class="menu-text">Change Password</div>
                </a>
            </div>

            <!-- BEGIN minify-button -->
            <div class="menu-item d-flex">
                <a href="javascript:;" class="app-sidebar-minify-btn ms-auto" data-toggle="app-sidebar-minify"><i
                        class="fa fa-angle-double-left"></i></a>
            </div>
            <!-- END minify-button -->

        </div>
        <!-- END menu -->
    </div>
    <!-- END scrollbar -->
</div>
<div class="app-sidebar-bg" <?php echo e($appSidebarAttr); ?>></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile"
        class="stretched-link"></a></div>
<!-- END #sidebar -->
<?php /**PATH D:\backend\unify-wizards-new\resources\views/includes/sidebar.blade.php ENDPATH**/ ?>