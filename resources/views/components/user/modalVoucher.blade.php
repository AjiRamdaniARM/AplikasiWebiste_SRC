<dialog id="dialogVoucher">
    <form id="formId" action="{{url('payment/kode/'.$invoice->id)}}" method="POST">
    @csrf
        <h2 class="poppins-bold">Masukkan Kode Voucher</h2>
        <div style="border: 2px solid #0080ff" class="block bg-white shadow-md rounded-2xl px-10 py-3 ">
            <h1 class="poppins-semibold text-start "> Voucher Diskon Hanya Bisa Dipakai 1 Kali <span>

            </span></h1>
        </div>
     <div class="block p-5 bg-blue-300 rounded-2xl relative mt-4">
        <h6 class=" text-2xl text-blue-800 font-bold">Code Voucher</h6>
        <input type="text" name="code"  class="relative mt-2 rounded-xl"   required>
     </div>


    <button type="submit" class="block bg-blue-400 relative mt-4 rounded-xl w-full py-3 text-white font-bold hover:bg-blue-300 ">
      Dapatkan Diskon
     </button>

    </form>
        <button onclick="window.dialogVoucher.close();" aria-label="close" class="x">❌</button>
</dialog>



<style>
.slide-top {
	-webkit-animation: slide-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
	        animation: slide-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940)
}
    @-webkit-keyframes slide-top {
    0% {
      -webkit-transform: translateY(0);
              transform: translateY(0);
    }
    100% {
      -webkit-transform: translateY(-5px);
              transform: translateY(-5px);
    }
  }
  @keyframes slide-top {
    0% {
      -webkit-transform: translateY(0);
              transform: translateY(0);
    }
    100% {
      -webkit-transform: translateY(-5px);
              transform: translateY(-5px);
    }
  }

  :root {
    --vs-primary: 29 92 255;
    }

    dialog {
    padding: 1rem 3rem;
    background: white;
    max-width: 400px;
    padding-top: 2rem;
    border-radius: 20px;
    border: 0;
    box-shadow: 0 5px 30px 0 rgba(0, 0, 0, 0.1);
    -webkit-animation: fadeIn 1s ease both;
            animation: fadeIn 1s ease both;
    }
    dialog::-webkit-backdrop {
    -webkit-animation: fadeIn 1s ease both;
            animation: fadeIn 1s ease both;
    background: rgba(255, 255, 255, 0.4);
    z-index: 2;
    -webkit-backdrop-filter: blur(20px);
            backdrop-filter: blur(20px);
    }
    dialog::backdrop {
    -webkit-animation: fadeIn 1s ease both;
            animation: fadeIn 1s ease both;
    background: rgba(255, 255, 255, 0.4);
    z-index: 2;
    -webkit-backdrop-filter: blur(20px);
            backdrop-filter: blur(20px);
    }
    dialog .x {
    filter: grayscale(1);
    border: none;
    background: none;
    position: absolute;
    top: 15px;
    right: 10px;
    transition: ease filter, transform 0.3s;
    cursor: pointer;
    transform-origin: center;
    }
    dialog .x:hover {
    filter: grayscale(0);
    transform: scale(1.1);
    }
    dialog h2 {
    font-weight: 600;
    font-size: 2rem;
    padding-bottom: 1rem;
    }
    dialog p {
    font-size: 1rem;
    line-height: 1.3rem;
    padding: 0.5rem 0;
    }
    dialog p a:visited {
    color: rgb(var(--vs-primary));
    }

    button.primary {
    display: inline-block;
    font-size: 0.8rem;
    color: #fff !important;
    background: rgb(var(--vs-primary)/100%);
    padding: 13px 25px;
    border-radius: 17px;
    transition: background-color 0.1s ease;
    box-sizing: border-box;
    transition: all 0.25s ease;
    border: 0;
    cursor: pointer;
    box-shadow: 0 10px 20px -10px rgb(var(--vs-primary)/50%);
    }
    button.primary:hover {
    box-shadow: 0 20px 20px -10px rgb(var(--vs-primary)/50%);
    transform: translateY(-5px);
    }

    @-webkit-keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
    }

    @keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
    }


    </style>



{{-- modal --}}

 <script>
document.addEventListener('DOMContentLoaded', function() {
    @if (session()->has('participants'))
        document.getElementById('dialog').showModal();
    @endif
});


</script>
