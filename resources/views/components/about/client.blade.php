@if ($clients->count())

    @php
        $sectionTitle = $clients->first()->client_title;
        $sectionHeading = $clients->first()->client_heading;
    @endphp

    <section class="au-clients-section">

        <div class="au-clients-head sr up">

            <div class="au-label">
                Our Clients
            </div>

            <h2 class="au-h2">
                {{ $sectionTitle }}
            </h2>

            <p class="au-p">
                {{ $sectionHeading }}
            </p>

        </div>

        <div class="au-marquee-outer">

            <div class="au-marquee-track" id="au-track">

                @foreach ($clients as $client)
                    <div class="au-client-chip">

                        @if (!empty($client->website) && $client->website != '#')
                            <a href="{{ $client->website }}" target="_blank"
                                style="display:flex;align-items:center;gap:12px;text-decoration:none;color:inherit;">
                        @endif

                        <div class="au-client-icon">

                            @if (!empty($client->logo))
                                <img src="{{ asset('uploads/clients/' . $client->logo) }}" alt="{{ $client->name }}"
                                    style="width:40px;height:40px;object-fit:contain;">
                            @else
                                {{ strtoupper(substr($client->name, 0, 1)) }}
                            @endif

                        </div>

                        <span class="au-client-name">
                            {{ $client->name }}
                        </span>

                        @if (!empty($client->website) && $client->website != '#')
                            </a>
                        @endif

                    </div>
                @endforeach

                {{-- Duplicate Items For Infinite Marquee --}}
                @foreach ($clients as $client)
                    <div class="au-client-chip">

                        @if (!empty($client->website) && $client->website != '#')
                            <a href="{{ $client->website }}" target="_blank"
                                style="display:flex;align-items:center;gap:12px;text-decoration:none;color:inherit;">
                        @endif

                        <div class="au-client-icon">

                            @if (!empty($client->logo))
                                <img src="{{ asset('uploads/clients/' . $client->logo) }}" alt="{{ $client->name }}"
                                    style="width:40px;height:40px;object-fit:contain;">
                            @else
                                {{ strtoupper(substr($client->name, 0, 1)) }}
                            @endif

                        </div>

                        <span class="au-client-name">
                            {{ $client->name }}
                        </span>

                        @if (!empty($client->website) && $client->website != '#')
                            </a>
                        @endif

                    </div>
                @endforeach

            </div>

        </div>

    </section>

@endif
