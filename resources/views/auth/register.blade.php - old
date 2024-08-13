<x-auth.app>

    <x-slot name="title">
        Register
    </x-slot>
    {{-- Outer Row  --}}
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ asset('favicon/android-chrome-192x192.png') }}" alt="SRC Logo" class="img-profile mb-3">
                        <h4 class="text-gray-900 mb-4"><strong>Register !!!</strong></h4>
                    </div>
                    <form action="{{ url('/register') }}" class="user" method="POST">
                        @csrf
                        <div class="row row-cols-1 row-cols-sm-2">
                            <div class="col">
                                <x-forms.input name="name" label="Full Name" required="true" />
                            </div>
                            <div class="col">
                                <x-forms.input name="email" label="E-mail" required="true" type="email" />
                            </div>
                        </div>

                        <div class="row row-cols-1 row-cols-sm-2">
                            <div class="col">
                                <x-forms.input name="community" label="School/Team" required="true" help="Enter school or team name"/>
                            </div>
                            <div class="col">
                                <x-forms.input name="pob" label="Place of birth" required="true"/>
                            </div>
                        </div>

                        <div class="row row-cols-1 row-cols-sm-2">
                            <div class="col">
                                <x-forms.input name="dob" label="date of birth" required="true" type="date"/>
                            </div>
                            <div class="col">
                                <x-forms.input name="address" label="Full address" required="true"/>
                            </div>
                        </div>

                        <x-forms.input name="phone" label="Phone number" required="true"/>

                        <div class="row row-cols-1 row-cols-sm-2">
                            <div class="col">
                                <x-forms.input name="password" label="password" required="true" type="password" help="Min 8 character"/>
                            </div>
                            <div class="col">
                                <x-forms.input name="password_confirmation" label="confirmation password" required="true" type="password" help="Re-enter of password"/>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                        <div class="text-center">
                            <a class="small" href="{{ url('/login') }}">Have an Account!</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</x-auth.app>

