@php
    $projects = is_array($page->s7_proud_projects)
        ? $page->s7_proud_projects
        : json_decode($page->s7_proud_projects, true);
@endphp

@if (!empty($projects) && ($projects['status'] ?? '') === 'active')

    <section class="tj-project-section section-gap">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="sec-heading-wrap">

                        @if (!empty($projects['sub_title']))
                            <span class="sub-title wow fadeInUp" data-wow-delay=".3s">
                                <i class="tji-box"></i>{{ $projects['sub_title'] }}
                            </span>
                        @endif

                        <div class="heading-wrap-content">

                            <div class="sec-heading">
                                <h3 class="sec-title">
                                    {{ $projects['title'] ?? '' }}
                                </h3>
                            </div>

                            @if (!empty($projects['description']))
                                <p class="desc wow fadeInUp" data-wow-delay=".5s">
                                    {{ $projects['description'] }}
                                </p>
                            @endif

                            @if (!empty($projects['button_text']) && !empty($projects['button_url']))
                                <div class="btn-wrap wow fadeInUp" data-wow-delay=".6s">
                                    <a class="tj-primary-btn">
                                        <span class="btn-text">
                                            <span>{{ $projects['button_text'] }}</span>
                                        </span>
                                        <span class="btn-icon">
                                            <i class="tji-arrow-right-long"></i>
                                        </span>
                                    </a>
                                </div>
                            @endif

                        </div>

                    </div>
                </div>
            </div>

            @if (!empty($projects['items']))
                <div class="row">
                    <div class="col-12">
                        <div class="project-area tj-arrange-container">

                            @foreach ($projects['items'] as $item)
                                <div class="project-item tj-arrange-item">

                                    <div class="project-img"
                                        data-bg-image="{{ asset('storage/' . ($item['image_path'] ?? '')) }}">
                                    </div>

                                    <div class="project-content">

                                        @if (!empty($item['category']))
                                            <span class="categories">
                                                <a>
                                                    {{ $item['category'] }}
                                                </a>
                                            </span>
                                        @endif

                                        <div class="project-text">

                                          <span class="span-title-white">
                                                <a style="color:white">
                                                    {{ $item['name'] ?? '' }}
                                                </a>
                                            </span>

                                            <a class="project-btn">
                                                <i class="tji-arrow-right-long"></i>
                                            </a>

                                        </div>

                                    </div>

                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>

@endif
