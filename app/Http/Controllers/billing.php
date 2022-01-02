<?php

namespace App\Http\Controllers;
use App\Mail\invoice as invoice12;
use App\Models\Invoice  ;
use App\Models\invoice_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class billing extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('billing/displaybill');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('billing/createbill');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $data=["user_id"=>Auth::user()->id,"customer_name"=>$request->input("customer_name"),"customer_email"=>$request->input('customer_email'),"customer_number"=>$request->input('customer_mobile'),"company_name"=>$request->input('company_name'),"invoice_number"=>$request->input('invoice_number'),"invoice_date"=>$request->input("invoive_date"),"sub_total"=>$request->input('subtotal_all'),"discount"=>$request->input('discount'),"vat"=>$request->input('vat'),"shipping"=>$request->input('shipping'),"total"=>$request->input('total')];
         $invoice1=Invoice::create($data);
     
        for($i=0;$i<count($request->input('product_name'));$i++){
            invoice_details::create(
                [
                    'product_name'=>$request->input('product_name')[$i],
                    'product_unit'=>$request->input('product_unit')[$i],
                    'quantity'=>$request->input('product_quantity')[$i],
                    'product_price'=>$request->input('product_price')[$i],
                    'sub_total_product'=>$request->input('product_subtotal')[$i],
                    'invoice_id'=>$invoice1->id


        ]);

        }

        return redirect()->back()->with("status","success");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice=Invoice::find($id);
        $invoice_details1=$invoice->invoice_details;


        return view("billing/show_invoice",compact("invoice","invoice_details1"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $invoice=Invoice::find($id);
        return view("billing/edit_invoice",compact("invoice"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $invoice1=Invoice::find($request->input('id'));
        $invoice1->customer_name=$request->input('customer_name');
        $invoice1->customer_email=$request->input('customer_email');
        $invoice1->customer_number=$request->input('customer_mobile');
        $invoice1->company_name=$request->input('company_name');
        $invoice1->invoice_number=$request->input('invoice_number');
        $invoice1->invoice_date=$request->input('invoice_date');
        $invoice1->sub_total=$request->input('subtotal_all');
        $invoice1->discount=$request->input('discount');
        $invoice1->vat=$request->input('vat');
        $invoice1->shipping=$request->input('shipping');
        $invoice1->total=$request->input('total');
        $invoice1->save();
        invoice_details::where('invoice_id',$request->id)->delete();
        for($i=0;$i<count($request->input('product_name'));$i++){
            invoice_details::create([

                "product_name"=>$request->input('product_name')[$i],
                "product_unit"=>$request->input('product_unit')[$i],
                "quantity"=>$request->input('product_quantity')[$i],
                "product_price"=>$request->input('product_price')[$i],
                "sub_total_product"=>$request->input('product_subtotal')[$i],
                "invoice_id"=>$request->input('id')
            ]
            );


        }
        return redirect(url('/display_bill'));



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Invoice::find($request->id)->delete();
        return response()->json([
            'status'=>"ok"
        ]);
    }




    public function print($id){

        $invoice=Invoice::find($id);
        $invoice_details1=$invoice->invoice_details;

        return view("billing/print",compact("invoice","invoice_details1"));


    }

    public function sendemail($id){

        $invoice=Invoice::find($id);
        $invoice_details1=$invoice->invoice_details;
        Mail::to($invoice->customer_email)->send(new invoice12($invoice,$invoice_details1));
        return redirect()->back();


    }

}

