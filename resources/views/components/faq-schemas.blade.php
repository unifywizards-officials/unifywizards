 @php
     $currentPage = request()->path() == '/' ? '/' : '/' . request()->path();

     $schema = \App\Models\Schema::where('status', 1)
         ->whereHas('pages', function ($q) use ($currentPage) {
             $q->where('page', $currentPage);
         })
         ->first();

     $faqSchema = $schema ? json_decode($schema->json_data, true) : [];

     $faqs = $faqSchema['faq']['mainEntity'] ?? [];
 @endphp

 @if (count($faqs))

     <div class="accordion tj-faq tj-arrange-item-2" id="faqOne">

         @foreach ($faqs as $i => $faq)
             <div class="accordion-item {{ $i == 0 ? 'active' : '' }}">

                 <button class="faq-title {{ $i != 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse"
                     data-bs-target="#faq-{{ $i }}" aria-expanded="{{ $i == 0 ? 'true' : 'false' }}">
                     {{ $faq['name'] }}
                 </button>

                 <div id="faq-{{ $i }}" class="collapse {{ $i == 0 ? 'show' : '' }}" data-bs-parent="#faqOne">
                     <div class="accordion-body faq-text">
                         <p>
                             {{ $faq['acceptedAnswer']['text'] }}
                         </p>
                     </div>
                 </div>

             </div>
         @endforeach

     </div>

 @endif
