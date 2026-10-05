<x-layouts.app>

    <div class="space-for-header"></div>

    @include('components.Home.hero', ['hero' => $gethero])

    @include('components.Home.client-logos', ['clientlogos' => $getclientlogo])

    @include('components.Home.solutions', ['solution' => $getoursolution])

    @include('components.Home.our-price', ['pricing' => $gethomePricing])

    @include('components.Home.industries', ['industry' => $gethomeindustry])

    @include('components.Home.recognitionAndPress', [
        'recognitionPress' => $getrecognitionpress
    ])

    @include('components.Home.company-overview', [
        'companyOverview' => $getcompanyoverview
    ])

    @include('components.Home.why-choose-us', [
        'getwhychoose' => $getwhychoose
    ])

    @include('components.Home.process', [
        'processData' => $getourprocess
    ])

    @include('components.Home.awards-recognition', [
        'getawardsrecognition' => $getawardsrecognition
    ])

    @include('components.Home.marketing', [
        'getmarketingsection' => $getmarketingsection
    ])

    @include('components.Home.portfolio', [
        'getportfolio' => $getportfolio
    ])

    @include('components.Home.outstanding-results', [
        'getoutstandingresult' => $getoutstandingresult
    ])

    @include('components.Home.clients-feedback', [
        'gettestimonial' => $gettestimonial
    ])

    @include('components.Home.client-recommend', [
        'getclientrecommend' => $getclientrecommend
    ])

    @include('components.Home.client-reviews', [
        'getreviewscreenshot' => $getreviewscreenshot
    ])

    @include('components.Home.faq', [
        'footerNumber' => $getnumber?->footer_number
    ])

    @include('components.Home.getintouch')

      @include('components.Home.blog', [
        'getblogs' => $getblogs
    ])

    @include('components.Home.cta', [
        'gethomecta' => $gethomecta
    ])

    <script src="{{ asset('home_assets/js/outstanding-results.js') }}"></script>
    <script src="{{ asset('home_assets/js/client-recommend.js') }}"></script>
    <script src="{{ asset('home_assets/js/why-choose-us.js') }}"></script>
    <script src="{{ asset('home_assets/js/client-reviews.js') }}"></script>

</x-layouts.app>