@extends('include/navbar')
@section('body1')
<br/>
<div class="container">
    <div class="d-flex justify-content-around bg-light p-2">
        <h5 class="d-flex align-items-center ">{{ __("messages.Invoices") }}</h5>
        <a href="{{ url('/create_bill') }}" class="btn btn-primary">{{ __("messages.create invoices") }}</a>
    </div>
</div>
    <table class="table table-primary w-100 table-hover table-responsive text-center">
        <thead>
                <tr>
                    <th class="style_theader">{{ __("messages.Customer Name") }}</th>
                    <th class="style_theader">{{ __("messages.Invoice Date") }}</th>
                    <th class="style_theader">{{ __("messages.Total") }}</th>
                    <th class="style_theader">{{ __('messages.Action') }}</th>


                </tr>
        </thead>
<br/>
        <tbody >

            
                @foreach($invoices=App\Models\invoice::where('user_id',Auth::user()->id)->paginate(6) as $invoice)
                <tr class="" id="row{{ $invoice->id }}" >
                    <td ><div class="style-tbody"><a class="text-dark text-decoration-none" href="{{ url("/invoice/show/{$invoice->id}") }}">{{ $invoice->customer_name }}</a></div></td>
                    <td ><div class="style-tbody">{{ $invoice->invoice_date }}</div></td>
                    <td><div class="style-tbody">{{ $invoice->total }}</div></td>
                    <td><a href="{{ url("/invoice/edit/{$invoice->id}") }}" class="btn mb-1 btn-primary me-1">{{ __("messages.Edit") }}</a><a onclick="del_invoice({{ $invoice->id }})"  class="btn me-1  mb-1 btn-danger ">{{ __("messages.Del") }}</a></td>
                

                </tr>

                @endforeach
            


        </tbody>

    </table>

    <div class="d-flex justify-content-center">

        {{ $invoices->links() }}

    </div>











@endsection

@section('script1')

<script>

function del_invoice(id){
let status=confirm("are You sure?");
if(status){

let request=new XMLHttpRequest();
request.open("get","/del_invoice?id="+id,true);
request.send();
request.onreadystatechange=function(){
if(request.status==200&&request.readyState==4){
let del=document.getElementById('row'+id);
del.remove();



}



}










}


}




</script>



@endsection




@section("style1")

<link rel="stylesheet" href="{{ asset("css/display.css") }}"/>

@endsection