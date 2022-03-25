<?php

namespace App\Http\Controllers;

use App\Fair;
use App\Http\Requests\MyFormRequest;
use App\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::id();
            $items = User::find($user)->fairs()->paginate(5);

            // somando os valores dos itens | adding the values of the items
            $total_value = Fair::where('user_id', $user)->sum('total_value');

            return view('app.home', compact('items', 'total_value'));

        } catch (Exception $err) {

            toastr()->warning($err->getMessage());
            return view('app.home');
        }

    }

    public function store(MyFormRequest $request)
    {
        $request->validated();

        try {
            $data = $request->all();
            $data['total_value'] = ($data['price'] * $data['amount']);

            $item = new Fair();
            $item->create($data);

            toastr()->success('Produto adicionado com sucesso!');
            return redirect()->route('home');

        } catch (Exception $err) {

            toastr()->warning($err->getMessage());
            return redirect()->route('home');
        }

    }

    public function edit($id)
    {
        $item = Fair::Find($id);
        return view('app.edit', compact('item'));
    }

    public function update(MyFormRequest $request, $id)
    {
        $request->validated();

        try {
            $data = $request->all();
            $data['total_value'] = ($data['price'] * $data['amount']);

            $item = Fair::findOrFail($id);
            $item->update($data);

            toastr()->success('Produto editado com sucesso!');
            return redirect()->route('item.edit', ['id' => $id]);

        } catch (Exception $err){

            toastr()->warning($err->getMessage());
            return redirect()->route('item.edit', ['id' => $id]);
        }
    }

    public function destroy($id)
    {
        try {
            $items = Fair::findOrFail($id);
            $items->delete();

            toastr()->success('Produto removido com sucesso!');
            return redirect()->route('home');

        } catch (Exception $err) {

            toastr()->warning($err->getMessage());
            return redirect()->route('home');
        }
    }


    public function impress()
    {
        $user = Auth::id();
        $items = User::find($user)->fairs;

        // somando os valores dos itens | adding the values of the items
        $total_value = Fair::where('user_id', $user)->sum('total_value');

        $pdf = PDF::loadView('app.impress.list', compact('items', 'total_value'));

        // Se for preciso -> alterando layout da página | If necessary -> changing page layout
        $pdf->setPaper('a4', 'portrait'); // portrait -> retrato - landscape -> paisagem

        return $pdf->stream('feira_mensal.pdf');
    }
}
