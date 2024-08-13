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
                    <div class="row flex justify-center items-center">
                        <div class="col-lg-6 d-none d-lg-block">
                            <img src="assets/logo-src.png" alt="src logo" class="w-75  d-block mx-auto relative py-10  ">
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
                                     <div class="password-wrapper">
                                    <label for="password">Password</label>
                                    <div class="input-container">
                                        <input id="password" name="password" required="true" type="password" aria-describedby="passwordHelp" class="py-1 px-2 rounded-lg border-2 border-gray-200" required placeholder="Enter New Password" />
                                        <span class="toggle-password" data-target="password">👁️</span>
                                    </div>
                                    <small id="passwordHelp" class="form-text text-muted">Min 8 characters</small>
                                </div>
                                    <!--<x-forms.input name="password"-->
                                    <!--    label="password"-->
                                    <!--    required="true"-->
                                    <!--    type="password"-->
                                    <!--/>-->

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

