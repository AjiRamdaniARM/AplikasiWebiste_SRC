
<div class="footer w-full bg-yellow-300 py-2">
    <div class="text-center inter text-black font-bold lg:text-[15px] text-[10px]">
        © 2024 SRC Sukabumi robotik Competition. All Rights Reserved Sukarobot Academy
    </div>
</div>

{{-- Bootstrap core JavaScript--}}
<script src="{{ asset('panel/vendor/jquery/jquery.js') }}"></script>
<script src="{{ asset('panel/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

{{-- Core plugin JavaScript--}}
<script src="{{ asset('panel/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

{{-- Custom scripts for all pages--}}
<script src="{{ asset('panel/js/sb-admin-2.min.js') }}"></script>

{{-- Page level plugins --}}
<script src="{{ asset('panel/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('panel/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

@stack('extra-script')