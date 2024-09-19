<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Contact;
use Session;

class CustomerController extends Controller
{

    public function index()
    {
        $customer_list =Customer::paginate(10);
    
        return view('customer.index',compact('customer_list'));
    }


    public function create()
    {
        return view('customer.create');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $customer = Customer::create($input);
         //insert Contact
        // $data = $request->input();
        // for($i = 0; $i < count($data['contact_name']); $i++) {
        //     $c = new Contact();
        //     $c->contact_name    = $data['contact_name'][$i];
        //     $c->contact_address = $data['contact_address'][$i];
        //     $c->contact_phone   = $data['contact_phone'][$i];
        //     $c->contact_email   = $data['contact_email'][$i];
        //     $c->contact_others = $data['contact_others'][$i];

        //     $customer->contact()->save($c); 
        // }
        Session::flash('flash_message', 'Data customer berhasil disimpan.');

        return redirect()->route('customer_index');

    }

    public function show(Customer $customer)
    {
        return view('customer.show',compact('customer'));
    }


    public function edit(Customer $customer)
    {
        return view('customer.edit',compact('customer'));
    }


    public function update(Customer $customer, Request $request)
    {
        $customer->update($request->all());
        Session::flash('flash_message', 'Data customer berhasil diupdate.');

        return redirect()->route('customer_index');
    }


    public function destroy(Request $request)
    {
        $id = $request->id;
        $customer=Customer::find($id);
        $customer->delete();
        Session::flash('flash_message', 'Data customer berhasil dihapus.');
        Session::flash('penting', true);

        // return redirect()->route('customer_index');
    }

     // ================================================

    public function add(Request $request)
        {
            $data = new Contact;
            $data ->id_customer = $request ->id_customer;
            $data ->contact_name = $request ->contact_name;
            $data ->contact_address = $request ->contact_address;
            $data ->contact_phone = $request ->contact_phone;
            $data ->contact_email = $request ->contact_email;
            $data ->contact_others = $request ->contact_others;
            $data ->save();
            Session::flash('flash_message', 'Data berhasil ditambah.');
            return back();
        }
 
        /*
         * View data
         */
        public function view(Request $request)
        {
            if($request->ajax()){
                $id = $request->id;
                $info = Contact::find($id);
                //echo json_decode($info);
                return response()->json($info);
            }
        }
 
        /*
        *   Update data
        */
        public function updateContact(Request $request)
        {
            $id = $request ->edit_id;
            $data = Contact::find($id);
            $data ->id_customer = $request ->id_customer;
            $data ->contact_name = $request ->contact_name;
            $data ->contact_address = $request ->contact_address;
            $data ->contact_phone = $request ->contact_phone;
            $data ->contact_email = $request ->contact_email;
            $data ->contact_others = $request ->contact_others;
            $data -> save();

            return back();
        }
 
        /*
        *   Delete record
        */
        public function deleteContact(Request $request)
        {
            $id = $request->id;
            $data = Contact::find($id);
            $response = $data ->delete();
            if($response)
                echo "Record Deleted successfully.";
            else
                echo "There was a problem. Please try again later.";
        }
}
