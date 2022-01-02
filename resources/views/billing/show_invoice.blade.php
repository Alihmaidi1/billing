@extends('include/navbar')

@section("body1")
<br/>
<div class="container">
    <div class="d-flex bg-light p-2 justify-content-between">
        <h5 class="d-flex align-items-center">{{ __("messages.Invoice") }} # {{ $invoice->invoice_number }}</h5>
        <a class="btn btn-primary" href="/display_bill">{{ __("messages.Back To Home") }}</a>
    </div>
<hr/>
    <div class="d-flex justify-content-around">
        <h6 class=" text-center">{{ __("messages.Customer Name") }}</h6>
        <div class=" text-center">{{ $invoice->customer_name }}</div>
    </div>
    <hr/>
    <div class="d-flex justify-content-around">
        <h6 class="col-6 text-center">{{ __("messages.Customer Email") }}</h6>
        <div class="col-6 text-center">{{ $invoice->customer_email }}</div>
    </div>
    <hr/>

    <div class="d-flex justify-content-around">
        <h6 class="col-3 col-sm-6 text-center">{{ __("messages.Customer Mobile") }}</h6>
        <div class="col-3 col-sm-6 text-center">{{ $invoice->customer_number }}</div>
    </div>
    <hr/>

    <div class="d-flex justify-content-around">
        <h6 class="col-3 col-sm-6 text-center">{{ __("messages.Company Name") }}</h6>
        <div class="col-3 col-sm-6 text-center">{{ $invoice->company_name }}</div>
    </div>
    <hr/>

    <div class="d-flex justify-content-around">
        <h6 class="col-3 text-center">{{ __("messages.Invoice Number") }}</h6>
        <div class="col-3 text-center">{{ $invoice->invoice_number }}</div>
    </div>
    <hr/>
    <div class="d-flex justify-content-around">
        <h6 class="col-3 text-center">{{ __('messages.Invoice Date') }}</h6>
        <div class="col-3 text-center">{{ $invoice->invoice_date }}</div>
    </div>
    
    <hr/>
    <div class="d-flex bg-light p-2 justify-content-between">
        <h5 class="d-flex align-items-center">{{ __("messages.Invoice Details") }}</h5>
    </div>

    <table class="table">
    
        <thead class="table-dark">
            <tr>
                
                <td># </td>
                <th >{{ __("messages.Product Name") }}</th>
                <th>{{ __("messages.Unit") }}</th>
                <th>{{ __("messages.Quantity") }}</th>
                <th>{{ __("messages.Unit Price") }}</th>
                <th>{{ __("messages.Product Subtotal") }}</th>

            </tr>

        </thead>

        <tbody>

            @foreach($invoice_details1 as $invoice_detail_one)

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $invoice_detail_one->product_name }}</td>
                    <td>{{ $invoice_detail_one->product_unit }}</td>
                    <td>{{ $invoice_detail_one->quantity }}</td>
                    <td>{{ $invoice_detail_one->product_price }}</td>
                    <td>{{ $invoice_detail_one->sub_total_product }}</td>
                </tr>
            @endforeach

        </tbody>


    </table>
    
    
    <br/>
    <hr/>
    <div class="w-50 d-flex justify-content-between">

            <h6>{{ __("messages.Sub Total") }}</h6>
            <div>{{ $invoice->sub_total }}</div>

    </div>

    <hr/>
    <div class="w-50 d-flex justify-content-between">

            <h6>{{ __("messages.Discount") }}</h6>
            <div>{{ $invoice->discount }}</div>

    </div>

    <hr/>
    <div class="w-50 d-flex justify-content-between">

            <h6>{{ __("messages.Vat") }}</h6>
            <div>{{ $invoice->vat}}</div>

    </div>

    <hr/>
    <div class="w-50 d-flex justify-content-between">

            <h6>{{ __("messages.Shipping") }}</h6>
            <div>{{ $invoice->shipping }}</div>

    </div>

    <hr/>
    <div class="w-50 d-flex justify-content-between">

            <h6>{{ __("messages.Total Due") }}</h6>
            <div>{{ $invoice->total }}</div>

    </div>

    <hr/>
    <div class="">

        <a href="/print/{{ $invoice->id }}" class="btn btn-primary me-2">{{ __("messages.Print the Invoice") }}</a>
        <a href="/sendmail/{{ $invoice->id }}" class="btn btn-success">{{ __("messages.Send To the Email") }}</a>



    </div>



</div>

@endsection
