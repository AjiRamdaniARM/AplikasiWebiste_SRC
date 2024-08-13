<x-auth.app>

    <x-slot name="title">
        Register
    </x-slot>
    {{-- Outer Row  --}}
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body">
                    <div class="text-center ">
                        <img src="assets/logo-src.png" alt="SRC Logo" class="img-profile mb-3 w-96 ">
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
                                   @if ($errors->has('email'))
                                <span class="text-danger">Email nya sudah terdaftar!!</span>
                                @endif
                            </div>
                        </div>

                        <div class="row row-cols-1 row-cols-sm-2">
                            <div class="col">
                                <x-forms.input name="community" label="School/Team" required="true" help="Enter school or team name"/>
                            </div>
                             <div class="col">
                                <x-forms.input name="address" label="Full address" required="true"/>
                            </div>
                           
                               <x-forms.input hidden value="true" name="pob"  required="true"/>
                         
                        </div>

                        <!--<div class="row row-cols-1 row-cols-sm-2">-->
                        <!--    <div class="col">-->
                                <x-forms.input name="dob" label="date of birth" required="true" type="date"/>
                        <!--    </div>-->
                           
                        <!--</div>-->

                        <x-forms.input name="phone" label="Phone number" required="true"/>
                          @if ($errors->has('phone'))
                                <span class="text-danger">Nomor Telephone nya sudah terdaftar!!</span>
                                @endif

                        <div class="row row-cols-1 row-cols-sm-2">
                             <div class="col">
                                <div class="password-wrapper">
                                    <label for="password">Password</label>
                                    <div class="input-container">
                                        <input id="password" name="password" required="true" type="password" aria-describedby="passwordHelp" class="py-1 px-2 rounded-lg border-2 border-gray-200" required placeholder="Enter New Password" />
                                        <span class="toggle-password" data-target="password">👁️</span>
                                    </div>
                                    <small id="passwordHelp" class="form-text text-muted">Min 8 characters</small>
                                </div>
                            </div>
                            <div class="col">
                                <div class="password-wrapper">
                                    <label for="confirm_password">Confirm Password</label>
                                    <div class="input-container">
                                        <input id="confirm_password" name="password_confirmation" required="true" type="password" aria-describedby="confirmPasswordHelp" class="py-1 px-2 rounded-lg border-2 border-gray-200" required placeholder="Confirm New Password" />
                                        <span class="toggle-password" data-target="confirm_password">👁️</span>
                                    </div>
                                    <small id="confirmPasswordHelp" class="form-text text-muted">Min 8 characters</small>
                                </div>
                                 <script>
                                document.querySelectorAll('.toggle-password').forEach(function(toggle) {
                                    toggle.addEventListener('click', function () {
                                        const targetId = this.getAttribute('data-target');
                                        const passwordInput = document.getElementById(targetId);
                                        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                                        passwordInput.setAttribute('type', type);
                                        this.textContent = type === 'password' ? '👁️' : '🙈';
                                    });
                                });
                            </script>
                            </div>
                            <!--<div class="col">-->
                            <!--    <x-forms.input name="password" label="password" required="true" type="password" help="Min 8 character"/>-->
                            <!--</div>-->
                            <!--<div class="col">-->
                            <!--    <x-forms.input name="password_confirmation" label="confirmation password" required="true" type="password" help="Re-enter of password"/>-->
                            <!--</div>-->
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


<style>
    .password-wrapper {
    display: flex;
    flex-direction: column;
    margin-bottom: 1em;
}

    .input-container {
        display: flex;
        align-items: center;
        position: relative;
    }

    .input-container input {
        flex: 1;
        padding-right: 2em; /* Add space for the toggle icon */
    }

    .toggle-password {
        position: absolute;
        right: 0.5em;
        cursor: pointer;
        user-select: none;
        color: #000;
    }

    .form-text {
        font-size: 0.875em;
        color: #6c757d;
    }

</style>

