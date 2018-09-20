<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clientcase;

class ClientcaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // echo "I'm in index method";

        $clientcases = Clientcase::orderBy('Case #', 'desc')->paginate(15);
        // dump($clientcases);

        // foreach ($clientcases as $clientcase) {
        //     echo $clientcase->{'Client Name'}."<br>";
        // }

        return view('clientcases.index')->withClientcases($clientcases);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientcases.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dump($request->all());
        // dd();

        $clientcase = new Clientcase;

        $clientcase->{'Case #'} = $request['case_num'];
        $clientcase->{'Client Name'} = $request['client_name'];

        $clientcase->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clientcase = Clientcase::find($id);

        return view('clientcases.show')->withClientcase($clientcase);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $clientcase = Clientcase::find($id);

        $clientcase->Caller = $request["Caller"];

        $clientcase->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
