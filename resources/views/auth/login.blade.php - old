<x-auth.app>

    <x-slot name="title">
        Login
    </x-slot>
    {{-- Outer Row  --}}
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    {{-- Nested Row within Card Body  --}}
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block">
                            <img src="{{ asset('favicon/android-chrome-512x512.png') }}" alt="src logo" class="w-75 d-block mx-auto">
                        </div>
                        <div class="col-lg-6">
                            <div class="py-5 px-3">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login !!!</h1>
                                </div>
                                <form action="{{ url('/login') }}" class="user" method="POST">
                                @csrf
                                    <x-forms.input name="email" 
                                        label="email"
                                        required="true"
                                    />
                                    <x-forms.input name="password" 
                                        label="password"
                                        required="true"
                                        type="password"
                                    />
                                    
                                    <button type="submit" class="btn btn-primary btn-block mb-3">Login</button>
                                    <div class="text-center">
                                        <a class="small" href="{{ url('/register') }}">Create an Account!</a>
                                        <br>
                                        <a class="small" href="{{ url('/') }}">Back to home !</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-auth.app>