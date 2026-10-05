<x-layouts.app>
    <div class="space-for-header"></div>
    <!-- start: Banner Section -->
    <x-about.hero :hero="$hero" />

    <!-- ██ INTRO and states section-->

    <x-about.introduction :introductions="$introductions" />




 
    <x-about.whychoose :whyChooses="$whyChooses" />

   
    <x-about.client :clients="$clients" />

    
    <x-about.industries :industries="$industries" />

 
    <div class="au-g-divider"></div>

    <x-about.reviews :review="$review" />
    
     @include('components.Home.clients-feedback', [
        'gettestimonial' => $gettestimonial
    ])


    <x-about.cta :cta="$cta" />
    <!-- end: Cta Section -->
</x-layouts.app>

<style>
    
    .tj-footer-section {
    padding-top: 0px !important;
  
}
 
</style>