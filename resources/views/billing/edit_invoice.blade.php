@extends('include/navbar')
@section('body1')
<br/>

<div class=" bg-light p-3 d-flex justify-content-between">
<div class="d-flex justify-content-center">{{ __("messages.Edit the invoice  with Number") }} # {{ $invoice->invoice_number }}</div>
<a href="/display_bill" class=" btn btn-primary ">{{ __("messages.Back to Home") }}</a>
</div>
<form method="POST" action={{ url('/update_bill') }}>
    @csrf
<input name="id" type="hidden" value="{{ $invoice->id }}"/>
<div class="container bg-secondary">
        <div class="row text-center">
                 <div class="col-md-6  col-lg-4">
                        <div>
                            <label>{{ __('messages.Customer Name') }}</label>
                            <div class="mt-2">
                            <input required name="customer_name" value="{{ $invoice->customer_name }}"  class="form-control"/>
                            </div>
                        </div>

                 </div>


                 <div class="col-md-6  col-lg-4">
                    <div>
                        <label>{{ __("messages.Customer Email") }}</label>
                        <div class="mt-2">
                        <input required name="customer_email" value="{{ $invoice->customer_email }}" type="email" class="form-control"/>
                        </div>
                    </div>

                 </div>
           
                 <div class="col-md-6  col-lg-4">
                    <div>
                        <label>{{ __('messages.Customser Mobile') }}</label>
                        <div class="mt-2">
                        <input required name="customer_mobile" value="{{ $invoice->customer_number }}" type="number" class="form-control"/>
                        </div>
                    </div>

            </div>
           
            
                <div class="col-md-6  col-lg-4">
                        <div>
                            <label>{{ __('messages.Name Company') }}</label>
                            <div class="mt-2">
                            <input required name="company_name" value="{{ $invoice->company_name }}" class="form-control"/>
                            </div>
                        </div>

                </div>
                <div class="col-md-6  col-lg-4">
                        <div>
                            <label>{{ __('messages.Invoice Number') }}</label>
                            <div class="mt-2">
                            <input required type="number" value="{{ $invoice->invoice_number }}" name="invoice_number" class="form-control"/>
                            </div>
                        </div>

                </div>
                <div class="col-md-6  col-lg-4">
                        <div>
                            <label>{{ __('messages.Invoice Date') }}</label>
                            <div class="mt-2 pb-3">
                            <input required type="date" value="{{ $invoice->invoice_date }}" name="invoive_date" class="form-control"/>
                            </div>
                        </div>

                </div>
            
        </div>
<hr width="80% "  class="m-auto"/>
<table class="table text-center">
    <thead>
        <tr>
        <td class="text-weight-1">#</td>
        <td class="text-weight-1">{{ __('messages.Product Name') }}</td>
        <td class="text-weight-1">{{ __('messages.Unit') }}</td>
        <td class="text-weight-1">{{ __('messages.Quantity') }}</td>
        <td class="text-weight-1">{{ __('messages.Unit Price') }}</td>
        <td class="text-weight-1">{{ __('messages.Product Subtotal') }}</td>

        </tr>

    </thead>



    <tbody id="products">
        @foreach($invoice->invoice_details as $detail)
        <tr id="row{{$randomNumber = random_int(1000000,3000000 )}}">
            <input type="hidden" name="id1[]" value="{{ $detail->id }}"/>
            <td><button class="btn btn-danger" onclick="delete_product({{ $randomNumber }})">del</button></td>
            <td><input required class="form-control" value="{{ $detail->product_name }}" name="product_name[]"/></td>
            <td>    
                <input required name="product_unit[]" value="{{ $detail->product_unit }}" class="form-control"/>
            </td>
            <td><input required id="quantity{{ $randomNumber }}" value="{{ $detail->quantity }}" name="product_quantity[]" onkeyup="calcul({{ $randomNumber }})" class="form-control" type="number"/></td>
            <td><input required id="price{{ $randomNumber }}" value="{{ $detail->product_price }}" name="product_price[]"  onkeyup="calcul({{ $randomNumber }})" class="form-control" type="number"/></td>
            <td><input required id="subtotal{{ $randomNumber }}" value="{{ $detail->sub_total_product }}" type="number" name="product_subtotal[]"  class="form-control"  value="0" readonly/></td>

        </tr>

        @endforeach
        


    </tbody>




</table>
<div class="d-flex justify-content-center">
<a onclick="addproduct()" class="btn w-50 btn-primary">{{ __("messages.Add Another Product") }}</a>
</div>
<br/>
<div class="input-group  w-50 m-auto">
    <label class="input-group-text">{{ __('messages.Subtotal') }}</label>
    <input required id="subtotal" type="number" name="subtotal_all" class="form-control" readonly value="{{ $invoice->sub_total }}"/>
</div>
<hr/>
<div class="input-group w-50 m-auto d-flex justify-content-end">
    <label class="input-group-text">{{ __('messages.Discount precent') }}</label>
    <input required id="discount" name="discount" onkeyup="calcul_discount()" value="{{ $invoice->discount }}" type="number" class="form-control"/>
</div>
<hr/>
    
<div class="input-group w-50 m-auto">
    <label class="input-group-text">{{ __('messages.Vat precent') }}</label>
    <input required id="vat" name="vat" value="{{ $invoice->vat }}" readonly class="form-control"/>
</div>
<hr/>
<div class="input-group w-50 m-auto">
    <label class="input-group-text">{{ __("messages.Shipping") }}</label>
    <input required id="shipping" name="shipping" onkeyup="shipping_change()" value="{{ $invoice->shipping }}" type="number" class="form-control"/>
   
</div>
<hr/>
<div class="input-group w-50 m-auto">
    <label class="input-group-text">{{ __('messages.Total Due') }}</label>
    <input readonly required name="total" value="{{ $invoice->total }}" id="total" class="form-control"/>
</div>
<div class="d-flex justify-content-center mt-3">
<button class=" btn btn-primary w-50">{{ __("messages.save") }}</button>
</div>
<div>
<br/>
<br/>

</div>
</div>
</form>
@endsection



@section('script1')
<script>
 function calcul(id){

let quantity=document.getElementById('quantity'+id).value;
let unit_price=document.getElementById('price'+id).value;
let sub_total=document.getElementById('subtotal'+id).value;
let sub_total1=document.getElementById('subtotal').value;
let shipping=document.getElementById('shipping').value;
let vat=document.getElementById('vat').value;
if(quantity==''||unit_price==''){
    document.getElementById('subtotal'+id).value=0;
    
}else{
    document.getElementById('subtotal'+id).value=quantity*unit_price; 
}
    document.getElementById('subtotal').value=0;
    let products=document.getElementById('products');
    for(let i=0;i<products.childElementCount;i++){
        let value1=products.children[i].lastElementChild.firstElementChild.value;
        document.getElementById('subtotal').value=parseInt(value1)+parseInt(document.getElementById('subtotal').value);
    }
    document.getElementById('total').value=parseInt(document.getElementById('subtotal').value)+parseInt(document.getElementById('shipping').value)-parseInt(document.getElementById('vat').value)
    document.getElementById('vat').value=parseInt(document.getElementById('subtotal').value)*(parseInt(document.getElementById('discount').value)/100)
 }

function calcul_discount(){
    let discount=document.getElementById('discount').value;
    let vat=document.getElementById('vat').value;
    let sub_total=document.getElementById('subtotal').value;
    let shipping=document.getElementById('shipping').value;
    if(sub_total!=0){
        if(shipping==''){
        shipping=0;
    }
        vat=document.getElementById('vat').value=parseInt( sub_total*(discount/100));
        document.getElementById('total').value=-parseInt(vat)+parseInt(sub_total)+parseInt(shipping);
    }


}

function shipping_change(){
    let vat=document.getElementById('vat').value;
    let sub_total=document.getElementById('subtotal').value;
    let shipping=document.getElementById('shipping').value;
    if(shipping==''){
        shipping=0;
    }
    document.getElementById('total').value=parseInt(sub_total)+parseInt(shipping)-parseInt(vat);

}

function addproduct(){
    let counter2=parseInt(Math.random()*999999);
let products=document.getElementById('products');
let tr1=document.createElement('tr');
tr1.id="row"+counter2;
tr1.innerHTML=`
                <input type="hidden" name="id1[]"/>
            <td><buttun onclick="delete_product(${counter2})" class='btn btn-danger'>Del</button></td>
            <td><input required name='product_name[]' class="form-control"/></td>
            <td>

            <input name="product_unit[]" class="form-control"/>

            </td>
            <td><input required name="product_quantity[]" id="quantity${counter2}" onkeyup="calcul(${counter2})" class="form-control" type="number"/></td>
            <td><input required id="price${counter2}" name="product_price[]" onkeyup="calcul(${counter2})" class="form-control" type="number"/></td>
            <td><input required id="subtotal${counter2}" name="product_subtotal[]"  class="form-control"  value="0" readonly/></td>



`;
products.appendChild(tr1);

}

function delete_product(id){
let deleted_element=document.getElementById('row'+id);
deleted_element.remove();
document.getElementById('subtotal').value=0;
    let products=document.getElementById('products');
    for(let i=0;i<products.childElementCount;i++){
        let value1=products.children[i].lastElementChild.firstElementChild.value;
        document.getElementById('subtotal').value=parseInt(value1)+parseInt(document.getElementById('subtotal').value);
    }
let sub_total=document.getElementById('subtotal');
let discount=document.getElementById('discount');
let vat=document.getElementById('vat');
document.getElementById("total").value=0;
document.getElementById('total').value=parseInt(sub_total.value)-parseInt(vat.value)+parseInt(document.getElementById('shipping').value);



}


</script>

@endsection