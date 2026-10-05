@php
    $isBuildingMenuActive =
        request()->routeIs('admin.buildings.index') ||
        request()->routeIs('admin.unit-types.index') ||
        request()->routeIs('admin.units.index') ||
        request()->routeIs('admin.assets-locations.index') ||
        request()->routeIs('admin.building-assets.index');
@endphp
@php
    $appSidebarClass = !empty($appSidebarTransparent) ? 'app-sidebar-transparent' : '';
    $appSidebarAttr = !empty($appSidebarLight) ? '' : ' data-bs-theme=dark';
@endphp
<!-- BEGIN #sidebar -->
<div id="sidebar" class="app-sidebar {{ $appSidebarClass }}" {{ $appSidebarAttr }}>
    <!-- BEGIN scrollbar -->
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <div class="menu mt-3">
            @if (!$appSidebarSearch)
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
            @endif

            @if ($appSidebarSearch)
                <div class="menu-search mb-n3">
                    <input type="text" class="form-control" placeholder="Sidebar menu filter..."
                        data-sidebar-search="true" />
                </div>
            @endif

            <!-- <div class="menu-header">Navigation</div> -->
            <div class="menu-item {{ isActiveRoute('admin.home') }}">
                <a href="{{ route('admin.home') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-sitemap"></i>
                    </div>
                    <div class="menu-text">Dashboard</div>
                </a>
            </div>


            <div class="menu-item {{ isActiveRoute('media.index') }}">
                <a href="{{ route('media.index') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-image"></i>
                    </div>
                    <div class="menu-text">Media</div>
                </a>
            </div>


            @can('users')
                <div class="menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="menu-text">Users</div>
                    </a>
                </div>
            @endcan

            @can('view login history')
                <div class="menu-item {{ isActiveRoute('admin.login-history.index') }}">
                    <a href="{{ route('admin.login-history.index') }}" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-history"></i>
                        </div>
                        <div class="menu-text">Login History</div>
                    </a>
                </div>
            @endcan

            @canany(['roles', 'permissions'])
                @php
                    $isRolesActive = request()->routeIs('admin.roles.*');
                    $isPermissionsActive = request()->routeIs('admin.permissions.*');
                @endphp
                <div
                    class="menu-item has-sub {{ $isRolesActive || $isPermissionsActive ? 'active expand' : '' }}">

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

                        @can('roles')
                            <div class="menu-item {{ $isRolesActive ? 'active' : '' }}">
                                <a href="{{ route('admin.roles.index') }}" class="menu-link">
                                    <div class="menu-text">
                                        <i class="fa fa-user-shield me-2"></i>
                                        Roles
                                    </div>
                                </a>
                            </div>
                        @endcan

                        @can('permissions')
                            <div class="menu-item {{ $isPermissionsActive ? 'active' : '' }}">
                                <a href="{{ route('admin.permissions.index') }}" class="menu-link">
                                    <div class="menu-text">
                                        <i class="fa fa-key me-2"></i>
                                        Permissions
                                    </div>
                                </a>
                            </div>
                        @endcan

                    </div>
                </div>
            @endcanany

            {{-- <div class="menu-item {{ isActiveRoute('admin.categories.index') }}">
                <a href="{{ route('admin.categories.index') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fas fa-list-alt"></i>
                    </div>
                    <div class="menu-text">Categories</div>
                </a>
            </div> --}}

            {{-- <div class="menu-item {{ isActiveRoute('admin.sub-categories.index') }}">
                <a href="{{ route('admin.sub-categories.index') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fas fa-sitemap"></i> <!-- Updated icon for Sub Categories -->
                    </div>
                    <div class="menu-text">Sub Categories</div>
                </a>
            </div> --}}


            {{-- Home page CMS Menu --}}
            @php
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
            @endphp

            @can('home-page')
                <div class="menu-item has-sub {{ $isHomeMenuActive ? 'active expand' : '' }}">

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
                        <div class="menu-item {{ $isHeroActive ? 'active' : '' }}">
                            <a href="{{ route('admin.home.hero.edit') }}" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-image me-2"></i>
                                    Hero Section
                                </div>
                            </a>
                        </div>

                        <!-- Clients Logo -->
                        <div class="menu-item {{ $isClientsLogoActive ? 'active' : '' }}">

                            <a href="{{ route('admin.home.clients-logo.edit') }}" class="menu-link">

                                <div class="menu-text">

                                    <i class="fa fa-users me-2"></i>

                                    Clients Logo

                                </div>

                            </a>

                        </div>

                        <!-- Our Solutions -->
                        <div class="menu-item {{ $isOurSolutionsActive ? 'active' : '' }}">

                            <a href="{{ route('admin.home.our-solutions.edit') }}" class="menu-link">

                                <div class="menu-text">

                                    <i class="fa fa-cogs me-2"></i>

                                    Our Solutions

                                </div>

                            </a>

                        </div>

                        <!-- Plans & Pricing -->
                        <div class="menu-item {{ $isPricingActive ? 'active' : '' }}">

                            <a href="{{ route('admin.home.pricing.edit') }}" class="menu-link">

                                <div class="menu-text">

                                    <i class="fa fa-dollar-sign me-2"></i>

                                    Plans & Pricing

                                </div>

                            </a>

                        </div>

                        <!-- Industries We Serve -->
                        <div class="menu-item {{ $isIndustriesActive ? 'active' : '' }}">
                            <a href="{{ route('admin.home.industries.edit') }}" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-industry me-2"></i>
                                    Industries We Serve
                                </div>
                            </a>
                        </div>

                        <!-- Recognition & Press -->
                        <div class="menu-item {{ $isRecognitionPressActive ? 'active' : '' }}">

                            <a href="{{ route('admin.home.recognition.press.edit') }}" class="menu-link">

                                <div class="menu-icon">
                                    <i class="fa fa-newspaper"></i>
                                </div>

                                <div class="menu-text">
                                    Recognition & Press
                                </div>

                            </a>

                        </div>

                        <!-- Company Overview -->
                        <div class="menu-item {{ $isCompanyOverviewActive ? 'active' : '' }}">

                            <a href="{{ route('admin.home.company.overview.edit') }}" class="menu-link">

                                <div class="menu-text">
                                    <i class="fa fa-building me-2"></i>
                                    Company Overview
                                </div>

                            </a>

                        </div>

                        <!-- Why Choose Us (Homepage) -->
                        <div class="menu-item {{ $isWhyChooseActive ? 'active' : '' }}">
                            <a href="{{ route('admin.home.why-choose.edit') }}" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-star me-2"></i>
                                    Why Choose Us
                                </div>
                            </a>
                        </div>

                        <!-- Our Process -->
                        <div class="menu-item {{ $isOurProcessActive ? 'active' : '' }}">
                            <a href="{{ route('admin.home.our-process.edit') }}" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-project-diagram me-2"></i>
                                    Our Process
                                </div>
                            </a>
                        </div>

                        <!-- Awards & Recognition -->
                        <div class="menu-item {{ $isAwardsRecognitionActive ? 'active' : '' }}">
                            <a href="{{ route('admin.home.awards.recognition.edit') }}" class="menu-link">

                                <div class="menu-text">
                                    <i class="fa fa-trophy me-2"></i>
                                    Awards & Recognition
                                </div>

                            </a>
                        </div>

                        <!-- Growth Marketing Strategy -->
                        <div class="menu-item {{ $isMarketingSectionsActive ? 'active' : '' }}">

                            <a href="{{ route('admin.home.marketing-sections.index') }}" class="menu-link">

                                <div class="menu-text">

                                    <i class="fa fa-chart-line me-2"></i>

                                    Growth Marketing Strategy

                                </div>

                            </a>

                        </div>

                        <!-- Portfolio -->
                        <div class="menu-item {{ $isHomePortfolioActive ? 'active' : '' }}">

                            <a href="{{ route('admin.home.portfolio.edit') }}" class="menu-link">

                                <div class="menu-text">

                                    <i class="fa fa-briefcase me-2"></i>

                                    Portfolio

                                </div>

                            </a>

                        </div>

                        <!-- Clients Feedback -->
                        <div class="menu-item {{ $isClientsFeedbackActive ? 'active' : '' }}">

                            <a href="{{ route('admin.home.clients-feedback.edit') }}" class="menu-link">

                                <div class="menu-text">

                                    <i class="fa fa-comments me-2"></i>

                                    Clients Feedback

                                </div>

                            </a>

                        </div>

                        <!-- Insights Blog -->
                        {{-- <div class="menu-item">
                        <a href="" class="menu-link">
                            <div class="menu-text">
                                <i class="fa fa-blog me-2"></i>
                                Insights Blog
                            </div>
                        </a>
                    </div> --}}


                        <div class="menu-item {{ $isOutstandingResultsActive ? 'active' : '' }}">

                            <a href="{{ route('outstanding-results.edit') }}" class="menu-link">

                                <div class="menu-text">

                                    <i class="fa fa-trophy me-2"></i>

                                    Outstanding Results

                                </div>

                            </a>

                        </div>

                        <div class="menu-item {{ $isClientRecommendActive ? 'active' : '' }}">
                            <a href="{{ route('client-recommend.edit') }}" class="menu-link">

                                <div class="menu-text">
                                    <i class="fa fa-users me-2"></i>
                                    Clients Recommend
                                </div>

                            </a>

                        </div>

                        <div class="menu-item {{ $isRecentAwardsActive ? 'active' : '' }}">
                            <a href="{{ route('recent-awards.edit') }}" class="menu-link">
                                <div class="menu-text">

                                    <i class="fa fa-trophy me-2"></i>

                                    Recent Awards

                                </div>
                            </a>
                        </div>


                        <div class="menu-item {{ $isReviewScreenshotsActive ? 'active' : '' }}">

                            <a href="{{ route('review-screenshots.edit') }}" class="menu-link">

                                <div class="menu-text">

                                    <i class="fa fa-images me-2"></i>

                                    Review Screenshots

                                </div>

                            </a>

                        </div>


                        <div class="menu-item {{ $isBusinessChooseUsActive ? 'active' : '' }}">

                            <a href="{{ route('business-choose-us.edit') }}" class="menu-link">

                                <div class="menu-icon">
                                    <i class="fa fa-briefcase"></i>
                                </div>

                                <div class="menu-text">
                                    Businesses Choose Us
                                </div>

                            </a>

                        </div>


                        <div class="menu-item {{ $isHomeCtaActive ? 'active' : '' }}">

                            <a href="{{ route('admin.home.cta.edit') }}" class="menu-link">

                                <div class="menu-text">

                                    <i class="fa fa-bullhorn me-2"></i>

                                    CTA Section

                                </div>

                            </a>

                        </div>

                    </div>

                </div>
            @endcan


            {{-- ABOUT US CMS MENU --}}
            @can('about-us')
                @php
                    $isAboutHeroActive = isActiveRoute('admin.about-us.hero.index') === 'active';
                    $isAboutIntroActive = isActiveRoute('admin.about-us.introduction.index') === 'active';
                    $isAboutWhyChooseActive = isActiveRoute('admin.about-us.why-choose-us.index') === 'active';
                    $isAboutClientsActive = isActiveRoute('admin.about-us.clients.index') === 'active';
                    $isAboutIndustryActive = isActiveRoute('admin.about-us.industry.index') === 'active';
                    $isAboutReviewsActive = isActiveRoute('admin.about-us.reviews.index') === 'active';
                    $isAboutCtaActive = isActiveRoute('admin.about-us.cta.index') === 'active';
                @endphp
                <div class="menu-item has-sub {{ request()->routeIs('admin.about-us.*') ? 'active expand' : '' }}">

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

                        {{-- Hero Section --}}
                        <div class="menu-item {{ $isAboutHeroActive ? 'active' : '' }}">
                            <a href="{{ route('admin.about-us.hero.index') }}" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-image me-2"></i>
                                    Hero Section
                                </div>
                            </a>
                        </div>

                        {{-- Introduction Section --}}
                        <div class="menu-item {{ $isAboutIntroActive ? 'active' : '' }}">
                            <a href="{{ route('admin.about-us.introduction.index') }}" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-align-left me-2"></i>
                                    Introduction
                                </div>
                            </a>
                        </div>


                        {{-- Why Choose Us --}}
                        <div class="menu-item {{ $isAboutWhyChooseActive ? 'active' : '' }}">
                            <a href="{{ route('admin.about-us.why-choose-us.index') }}" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-star me-2"></i>
                                    Why Choose Us
                                </div>
                            </a>
                        </div>

                        {{-- Clients --}}
                        <div class="menu-item {{ $isAboutClientsActive ? 'active' : '' }}">
                            <a href="{{ route('admin.about-us.clients.index') }}" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-users me-2"></i>
                                    Clients
                                </div>
                            </a>
                        </div>

                        {{-- Industries --}}
                        <div class="menu-item {{ $isAboutIndustryActive ? 'active' : '' }}">
                            <a href="{{ route('admin.about-us.industry.index') }}" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-briefcase me-2"></i>
                                    Industries
                                </div>
                            </a>
                        </div>

                        {{-- Reviews --}}
                        <div class="menu-item {{ $isAboutReviewsActive ? 'active' : '' }}">
                            <a href="{{ route('admin.about-us.reviews.index') }}" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-comments me-2"></i>
                                    Reviews
                                </div>
                            </a>
                        </div>

                        {{-- CTA Section --}}
                        <div class="menu-item {{ $isAboutCtaActive ? 'active' : '' }}">
                            <a href="{{ route('admin.about-us.cta.index') }}" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-bullhorn me-2"></i>
                                    CTA Section
                                </div>
                            </a>
                        </div>

                    </div>

                </div>
            @endcan

            {{-- Digital Marketing Service Menu --}}
            @can('services')
                <div class="menu-item has-sub {{ request()->routeIs('admin.dm.*') ? 'active expand' : '' }}">

                    <a href="javascript:;" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-bullhorn"></i>
                        </div>

                        <div class="menu-text">Services</div>
                        <div class="menu-caret"></div>
                    </a>

                    <div class="menu-submenu">

                        <div class="menu-item {{ request()->routeIs('admin.dm.page.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.dm.page.index') }}" class="menu-link">
                                <div class="menu-text">
                                    Manage Services
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            @endcan


            @can('blogs')
                <div class="menu-item {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.blogs.index') }}" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-blog"></i>
                        </div>
                        <div class="menu-text">Blogs</div>
                    </a>
                </div>
            @endcan


            @php
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
            @endphp

            @can('settings')
                <div class="menu-item has-sub {{ $settingsActive ? 'active expand' : '' }}">

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
                        <div class="menu-item {{ $isSettingsPageActive ? 'active' : '' }}">
                            <a href="{{ route('admin.settings.index') }}" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-sliders-h me-2"></i>
                                    Setting Pages
                                </div>
                            </a>
                        </div>

                        <!-- SEO Management -->
                        <div class="menu-item {{ $isSeoActive ? 'active' : '' }}">
                            <a href="{{ route('admin.seo.index') }}" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-chart-line me-2"></i>
                                    SEO Management
                                </div>
                            </a>
                        </div>

                        <!-- Schema Management -->
                        <div class="menu-item {{ $isSchemasActive ? 'active' : '' }}">
                            <a href="{{ route('admin.schemas.index') }}" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-chart-line me-2"></i>
                                    Schemas Management
                                </div>
                            </a>
                        </div>


                        <div class="menu-item {{ $isExtrafoldActive ? 'active' : '' }}">
                            <a href="{{ route('admin.extrafold.index') }}" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-chart-line me-2"></i>
                                    Extra Fold
                                </div>
                            </a>
                        </div>

                        <!-- Terms -->
                        <div class="menu-item {{ $isTermsActive ? 'active' : '' }}">
                            <a href="{{ route('admin.terms_conditions') }}" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-file-alt me-2"></i>
                                    Terms and Conditions
                                </div>
                            </a>
                        </div>

                        <!-- Privacy -->
                        <div class="menu-item {{ $isPrivacyActive ? 'active' : '' }}">
                            <a href="{{ route('admin.privacy_policy') }}" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-user-shield me-2"></i>
                                    Privacy Policy
                                </div>
                            </a>
                        </div>

                        <div class="menu-item {{ $isBlogFormActive ? 'active' : '' }}">
                            <a href="{{ route('admin.blog.forms') }}" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-user-shield me-2"></i>
                                    Blog Form
                                </div>
                            </a>
                        </div>


                        <div class="menu-item {{ $isContactProposalActive ? 'active' : '' }}">
                            <a href="{{ route('admin.contact-perposal.index') }}" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-envelope me-2"></i>
                                    Contact Proposal
                                </div>
                            </a>
                        </div>


                        <div class="menu-item {{ $isContactInquiryActive ? 'active' : '' }}">
                            <a href="{{ route('admin.contact-inquiry.index') }}" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-envelope me-2"></i>
                                    Contact Inquiry
                                </div>
                            </a>
                        </div>


                        <div class="menu-item {{ $isContactActive ? 'active' : '' }}">
                            <a href="{{ route('admin.contact.index') }}" class="menu-link">
                                <div class="menu-text">
                                    <i class="fa fa-envelope me-2"></i>
                                    Contact
                                </div>
                            </a>
                        </div>


                    </div>

                </div>
            @endcan

            <div class="menu-item {{ request()->routeIs('admin.password.*') ? 'active' : '' }}">
                <a href="{{ route('admin.password.change') }}" class="menu-link">
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
<div class="app-sidebar-bg" {{ $appSidebarAttr }}></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile"
        class="stretched-link"></a></div>
<!-- END #sidebar -->
