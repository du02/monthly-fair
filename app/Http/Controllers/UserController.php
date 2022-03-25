<?php

namespace App\Http\Controllers;

use App\User;
use Dompdf\Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('app.user.index', compact('user'));
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
        try {
            $data = $request->all();
            $data['password'] = bcrypt($data['password']);

            $user = User::findOrFail($id);
            $user->update($data);

            toastr()->success('Usuário editado com sucesso!', 'Usuário', ['positionClass' => 'toast-bottom-right']);
            return redirect()->route('home');

        } catch (Exception $err) {

            toastr()->warning($err->getMessage());
            return redirect()->route('home');
        }
    }

}
