@extends('frontend.layouts.app')

@section('content')
    <section class="gry-bg py-4">
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8 mx-auto">
                        <div class="card">
                            <div class="text-center pt-4">
                                <h1 class="h4 fw-600">
                                    {{ translate('Create an account.')}}
                                </h1>
                            </div>
                            <div class="px-4 py-3 py-lg-4">
                                <div class="">
                                    <form id="reg-form" class="form-default" role="form" action="{{ route('register') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="{{  translate('Full Name') }}" name="name">
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        @if (addon_is_activated('otp_system'))
                                            <div class="form-group phone-form-group mb-1">
                                                <input type="tel" id="phone-code" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" placeholder="" name="phone" autocomplete="off">
                                            </div>

                                            <input type="hidden" name="country_code" value="">

                                            <div class="form-group email-form-group mb-1 d-none">
                                                <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email"  autocomplete="off">
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group text-right">
                                                <button class="btn btn-link p-0 opacity-50 text-reset" type="button" onclick="toggleEmailPhone(this)">{{ translate('Use Email Instead') }}</button>
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        @endif

                                        <div class="form-group position-relative">
                                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{  translate('Password') }}" name="password" style="padding-right: 2rem;">
                                            <svg style="position: absolute; right: 5px; top: 10px; fill: currentColor;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                                                <path off d="M17.882 19.297A10.949 10.949 0 0 1 12 21c-5.392 0-9.878-3.88-10.819-9a10.982 10.982 0 0 1 3.34-6.066L1.392 2.808l1.415-1.415 19.799 19.8-1.415 1.414-3.31-3.31zM5.935 7.35A8.965 8.965 0 0 0 3.223 12a9.005 9.005 0 0 0 13.201 5.838l-2.028-2.028A4.5 4.5 0 0 1 8.19 9.604L5.935 7.35zm6.979 6.978l-3.242-3.242a2.5 2.5 0 0 0 3.241 3.241zm7.893 2.264l-1.431-1.43A8.935 8.935 0 0 0 20.777 12 9.005 9.005 0 0 0 9.552 5.338L7.974 3.76C9.221 3.27 10.58 3 12 3c5.392 0 9.878 3.88 10.819 9a10.947 10.947 0 0 1-2.012 4.592zm-9.084-9.084a4.5 4.5 0 0 1 4.769 4.769l-4.77-4.769z"/>
                                                <path on style="display: none" d="M12 3c5.392 0 9.878 3.88 10.819 9-.94 5.12-5.427 9-10.819 9-5.392 0-9.878-3.88-10.819-9C2.121 6.88 6.608 3 12 3zm0 16a9.005 9.005 0 0 0 8.777-7 9.005 9.005 0 0 0-17.554 0A9.005 9.005 0 0 0 12 19zm0-2.5a4.5 4.5 0 1 1 0-9 4.5 4.5 0 0 1 0 9zm0-2a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                                            </svg>
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group position-relative">
                                            <input type="password" class="form-control" placeholder="{{  translate('Confirm Password') }}" name="password_confirmation" style="padding-right: 2rem;">
                                            <svg style="position: absolute; right: 5px; top: 10px; fill: currentColor;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                                                <path off d="M17.882 19.297A10.949 10.949 0 0 1 12 21c-5.392 0-9.878-3.88-10.819-9a10.982 10.982 0 0 1 3.34-6.066L1.392 2.808l1.415-1.415 19.799 19.8-1.415 1.414-3.31-3.31zM5.935 7.35A8.965 8.965 0 0 0 3.223 12a9.005 9.005 0 0 0 13.201 5.838l-2.028-2.028A4.5 4.5 0 0 1 8.19 9.604L5.935 7.35zm6.979 6.978l-3.242-3.242a2.5 2.5 0 0 0 3.241 3.241zm7.893 2.264l-1.431-1.43A8.935 8.935 0 0 0 20.777 12 9.005 9.005 0 0 0 9.552 5.338L7.974 3.76C9.221 3.27 10.58 3 12 3c5.392 0 9.878 3.88 10.819 9a10.947 10.947 0 0 1-2.012 4.592zm-9.084-9.084a4.5 4.5 0 0 1 4.769 4.769l-4.77-4.769z"/>
                                                <path on style="display: none" d="M12 3c5.392 0 9.878 3.88 10.819 9-.94 5.12-5.427 9-10.819 9-5.392 0-9.878-3.88-10.819-9C2.121 6.88 6.608 3 12 3zm0 16a9.005 9.005 0 0 0 8.777-7 9.005 9.005 0 0 0-17.554 0A9.005 9.005 0 0 0 12 19zm0-2.5a4.5 4.5 0 1 1 0-9 4.5 4.5 0 0 1 0 9zm0-2a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                                            </svg>
                                        </div>

                                        @if(get_setting('google_recaptcha') == 1)
                                            <div class="form-group">
                                                <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <label class="aiz-checkbox">
                                                <input type="checkbox" name="checkbox_example_1" required>
                                                <span class=opacity-60>{{ translate('By signing up you agree to our terms and conditions.')}}</span>
                                                <span class="aiz-square-check"></span>
                                            </label>
                                        </div>

                                        <div class="mb-5">
                                            <button type="submit" class="btn btn-primary btn-block fw-600">{{  translate('Create Account') }}</button>
                                        </div>
                                    </form>
                                    @if(get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1 || get_setting('apple_login') == 1)
                                        <div class="separator mb-3">
                                            <span class="bg-white px-3 opacity-60">{{ translate('Or Join With')}}</span>
                                        </div>
                                        <ul class="list-inline social colored text-center mb-5">
                                            @if (get_setting('facebook_login') == 1)
                                                <li class="list-inline-item">
                                                    <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
                                                        <i class="lab la-facebook-f"></i>
                                                    </a>
                                                </li>
                                            @endif
                                            @if(get_setting('google_login') == 1)
                                                <li class="list-inline-item">
                                                    <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">
                                                        <i class="lab la-google"></i>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (get_setting('twitter_login') == 1)
                                                <li class="list-inline-item">
                                                    <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">
                                                        <i class="lab la-twitter"></i>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (get_setting('apple_login') == 1)
                                                <li class="list-inline-item">
                                                    <a href="{{ route('social.login', ['provider' => 'apple']) }}"
                                                        class="apple">
                                                        <i class="lab la-apple"></i>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <p class="text-muted mb-0">{{ translate('Already have an account?')}}</p>
                                    <a href="{{ route('user.login') }}">{{ translate('Log In')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection


@section('script')
    @if(get_setting('google_recaptcha') == 1)
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif

    <script type="text/javascript">
        $('.form-group.position-relative svg').click(function(){
            var input = $(this).parent().find('input');
            if(input.attr('type') == 'password'){
                input.attr('type', 'text');
                $(this).parent().find('[off]').hide();
                $(this).parent().find('[on]').show();
            } else {
                input.attr('type', 'password');
                $(this).parent().find('[on]').hide();
                $(this).parent().find('[off]').show();
            }
        });
        @if(get_setting('google_recaptcha') == 1)
        // making the CAPTCHA  a required field for form submission
        $(document).ready(function(){
            // alert('helloman');
            $("#reg-form").on("submit", function(evt)
            {
                var response = grecaptcha.getResponse();
                if(response.length == 0)
                {
                //reCaptcha not verified
                    alert("please verify you are humann!");
                    evt.preventDefault();
                    return false;
                }
                //captcha verified
                //do the rest of your validations here
                $("#reg-form").submit();
            });
        });
        @endif

        var isPhoneShown = true,
            countryData = window.intlTelInputGlobals.getCountryData(),
            input = document.querySelector("#phone-code");

        for (var i = 0; i < countryData.length; i++) {
            var country = countryData[i];
            if(country.iso2 == 'bd'){
                country.dialCode = '88';
            }
        }

        var iti = intlTelInput(input, {
            separateDialCode: true,
            utilsScript: "{{ static_asset('assets/js/intlTelutils.js') }}?1590403638580",
            onlyCountries: @php echo json_encode(\App\Models\Country::where('status', 1)->pluck('code')->toArray()) @endphp,
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                if(selectedCountryData.iso2 == 'bd'){
                    return "01xxxxxxxxx";
                }
                return selectedCountryPlaceholder;
            }
        });

        var country = iti.getSelectedCountryData();
        $('input[name=country_code]').val(country.dialCode);

        input.addEventListener("countrychange", function(e) {
            // var currentMask = e.currentTarget.placeholder;

            var country = iti.getSelectedCountryData();
            $('input[name=country_code]').val(country.dialCode);

        });

        function toggleEmailPhone(el){
            if(isPhoneShown){
                $('.phone-form-group').addClass('d-none');
                $('.email-form-group').removeClass('d-none');
                isPhoneShown = false;
                $(el).html('{{ translate('Use Phone Instead') }}');
            }
            else{
                $('.phone-form-group').removeClass('d-none');
                $('.email-form-group').addClass('d-none');
                isPhoneShown = true;
                $(el).html('{{ translate('Use Email Instead') }}');
            }
        }
    </script>
@endsection
