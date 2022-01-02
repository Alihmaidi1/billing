<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
    @yield("style1")
</head>
<body>

    
<div class=" bg-secondary p-2">

<div class="d-flex justify-content-between">
        <a href="/display_bill" class="d-flex text-decoration-none align-items-center ms-5 text-white">{{ __('messages.my Billing') }}</a>

        <div class="d-flex">
            <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('messages.language') }}  
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                    <li class="p-1 text-center">
                                                        <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                            {{ $properties['native'] }}
                                                        </a>
                                                    </li>
                                                    @endforeach
                            
                            </ul>
            </div>
<a  href="/logout" class="ms-3 me-5 btn btn-danger">{{ __("messages.logout") }}</a>

        </div>



        

    </div>




</div>
<div class="container">
@yield('body1')


</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
@yield('script1')

</body>
</html>