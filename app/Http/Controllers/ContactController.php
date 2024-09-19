<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Session;


class ContactController extends Controller
{
    public function index(Contact $contact)
    {
        $contact_list=Contact::OrderBy($contact->customer->customer_name)->paginate(10);

        return view('contact.index',compact('contact_list'));
    }


    public function create()
    {
        return view('contact.create');
    }


    public function store(Request $request)
    {
        Contact::create($request->all());
        Session::flash('flash_message', 'Data berhasil disimpan.');

        return redirect()->route('contact_index');

    }

    public function show($id)
    {
        //
    }


    public function edit(Contact $contact)
    {
        return view('contact.edit',compact('contact'));
    }


    public function update(Contact $contact, Request $request)
    {
        $contact->update($request->all());
        Session::flash('flash_message', 'Data berhasil diupdate.');

        return redirect()->route('contact_index');
    }


    public function destroy(Contact $contact)
    {
        $contact->delete();
        Session::flash('flash_message', 'Data  berhasil dihapus.');
        Session::flash('penting', true);

        return redirect()->route('contact_index');
    }
}