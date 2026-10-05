<x-layouts.app>
    <div class="space-for-header"></div>
    <!-- start: Banner Section -->


    <x-services.hero :page="$page" />

    {{-- Digital Marketing section --}}
    <x-services.digital-marketing :page="$page" />


    {{-- Extra fold 1 --}}

    <x-extra-fold :position="1" />

    {{-- Industries We Serve section --}}
    <x-services.industries-we-serve :page="$page" />

    {{-- get-to-know-us section --}}
      <x-extra-fold-2 :position="2" />

    <x-services.get-to-know-us :page="$page" />

    <!-- Technologies Section -->
    
    <x-services.technologies :page="$page" />

    {{-- our Pricing service section --}}
   

    <x-services.our-pricing :page="$page" />

    <!-- Client Testimonials Section -->
    <x-extra-fold :position="3" />
    <x-services.client-testimonials :page="$page" />

    {{-- Our Company section --}}

    <x-services.our-company :page="$page" />


    {{-- Proud Projects section --}}

    <x-services.proud-projects :page="$page" />

    {{-- Powered By section --}}

    <x-services.powered-by :page="$page" />

    {{-- Who Should Invest section --}}

    <x-services.who-should-invest :page="$page" />

    <x-extra-fold :position="4" />

    <!-- start: Why Choose Us Section -->

    <x-services.why-choose :page="$page" />
    <!-- end: Why Choose Us Section -->

    {{-- our process section --> --}}

    <x-services.our-process :page="$page" />

    {{-- Wizards Spell section --}}


    <x-services.wizards-spell :page="$page" />


    {{-- related blog service  --}}

    <x-services.related-blog :relatedBlogs="$relatedBlogs" />
    <br>
    <div class="row ">
        <span class="atm-main-title text-center">
            FAQ
        </span>
        <div class="col-2">

        </div>
        <div class="col-8">
            <x-faq-schemas />
        </div>
        <div class="col-2">

        </div>
    </div>
    <br>


    {{-- 
   Services CTA section --}}
    <x-services.services-cta :page="$page" />



  <script src="{{ asset('home_assets/js/service.js') }}"></script>
</x-layouts.app>
