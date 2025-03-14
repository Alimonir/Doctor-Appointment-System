<a href="{{route('locale.switch', app()->getLocale() == 'en' ? 'ar' : 'en')}}">
    <span>{{app()->getLocale() == 'en'?'عربي':'English'}}</span>
    <img alt="" class="inline-block size-3.5 rounded-full" 
    {{-- src="{{ asset('assets/media/flags/' . (app()->getLocale() == 'en' ? 'syria.svg' : 'united-states.svg')) }}" /> --}}
</a>