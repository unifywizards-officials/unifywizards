@php
    $projects = is_array($getportfolio->projects_json)
        ? $getportfolio->projects_json
        : json_decode($getportfolio->projects_json, true);
@endphp

<section class="tj-project-section section-gap">
    <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="sec-heading-wrap">

                    <span class="sub-title google-red-text wow fadeInUp" data-wow-delay=".3s">
                        <i class="tji-box google-red-text"></i>
                        {{ $getportfolio->sub_title }}
                    </span>

                    <div class="heading-wrap-content">

                        <div class="sec-heading">
                            <h3 class="sec-title">
                                {{ $getportfolio->title }}

                                @if (!empty($getportfolio->highlight_text))
                                    <span>{{ $getportfolio->highlight_text }}</span>
                                @endif
                            </h3>
                        </div>

                        <p class="desc wow fadeInUp" data-wow-delay=".5s">
                            {{ $getportfolio->description }}
                        </p>

                        @if ($getportfolio->button_text)
                            <div class="btn-wrap wow fadeInUp" data-wow-delay=".6s">
                                <a class="tj-primary-btn" href="{{ $getportfolio->button_link ?? '#' }}">

                                    <span class="btn-text">
                                        <span>{{ $getportfolio->button_text }}</span>
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

        <div class="row">
            <div class="col-12">

                <div class="project-area tj-arrange-container">

                    @foreach ($projects as $project)
                        <div class="project-item tj-arrange-item">

                            <div class="project-img" data-bg-image="{{ asset($project['image']) }}">
                            </div>

                            <div class="project-content">

                                <span class="categories">
                                    <a  class="google-text">

                                        {{ $project['category'] ?? '' }}

                                    </a>
                                </span>

                                <div class="project-text">

                                    <span class="span-title-white">
                                        <a style="color:#fff;">
                                            {{ $project['title'] ?? '' }}
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

    </div>
</section>
