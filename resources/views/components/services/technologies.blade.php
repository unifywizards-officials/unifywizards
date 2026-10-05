@props(['page'])

@php
    $technologies = is_array($page->s13_technologies)
        ? $page->s13_technologies
        : json_decode($page->s13_technologies, true);
@endphp

@if (!empty($technologies) && ($technologies['status'] ?? '') === 'active')

    <section class="tj-technologies-section bg-light section-gap">
        <div class="container">

            <div class="row align-items-center justify-content-center">
                <div class="col-lg-8">

                    <div class="section-heading mb-50 text-center">

                        @if (!empty($technologies['sub_title']))
                            <span class="sub-title wow fadeInUp" data-wow-delay=".2s">
                                <i class="fa fa-code"></i>
                                {{ $technologies['sub_title'] }}
                            </span>
                        @endif

                        <h2 class="section-title wow fadeInUp" data-wow-delay=".4s">
                            {{ $technologies['title'] ?? '' }}
                        </h2>

                        @if (!empty($technologies['description']))
                            <p class="section-desc wow fadeInUp" data-wow-delay=".6s">
                                {{ $technologies['description'] }}
                            </p>
                        @endif

                    </div>

                </div>
            </div>

            <div class="row g-4">

                @foreach ($technologies['technology_groups'] ?? [] as $groupIndex => $group)
                    @if (!empty($group['heading']))
                        <div class="col-md-6 col-lg-3">

                            <div class="tech-card wow fadeInUp" data-wow-delay="{{ ($groupIndex + 1) * 0.2 }}s">

                                <span class="tech-title">
                                    {{ $group['heading'] }}
                                </span>

                                <div class="tech-items">

                                    @foreach ($group['items'] ?? [] as $item)
                                        @if (!empty($item['name']))
                                            <div class="tech-item">

                                                @if (!empty($item['icon']))
                                                    {!! $item['icon'] !!}
                                                @else
                                                    <i class="fa fa-code"></i>
                                                @endif

                                                <span>
                                                    {{ $item['name'] }}
                                                </span>

                                            </div>
                                        @endif
                                    @endforeach

                                </div>

                            </div>

                        </div>
                    @endif
                @endforeach

            </div>

        </div>
    </section>

@endif
