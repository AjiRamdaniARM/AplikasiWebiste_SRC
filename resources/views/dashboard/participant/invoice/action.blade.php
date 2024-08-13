
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@if($invoice->status == 'unpaid')
    {{-- <a href="{{ route('participant.invoice.show', $model->name) }}" class="btn btn-success btn-sm">Bayar</a> --}}
    <a id="pay-button" class="btn btn-success btn-sm">Bayar</a>
@endif

@if($invoice->status == 'paid')
   <a href="{{ route('participant.invoice.team.index', $invoice->id) }}" class="btn btn-primary btn-sm">Participant</a>
@endif


<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY')}}"></script>
<script type="text/javascript">
 document.getElementById('pay-button').onclick = function(){
   // SnapToken acquired from previous step
   snap.pay('{{$invoice->snap_token}}', {
     // Optional
     onSuccess: function(result){
     document.getElementById('transaction-result').value = JSON.stringify(result);
     document.getElementById('payment-form').submit();
     },
     // Optional
     onPending: function(result){
       /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
     },
     // Optional
     onError: function(result){
       /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
     }
   });
 };
</script>


