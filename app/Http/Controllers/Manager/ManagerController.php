<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\RegisterRequest;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $managers = Manager::paginate(10);

        return view('manager.managers', compact('managers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {

        $data = $request->all();
        $manager = Manager::create($data);

        return $manager ? back()->with('success', 'O manager foi cadastrado com sucesso!')
                        : back()->with('fail', 'Ocorreu algum problema ao tentar cadastrar o manager!');
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
        $manager = Manager::findOrFail($request->id);

        $manager->update($request->all());

        return $manager ? back()->with('success', 'Os dados do manager foram alterados com sucesso!')
                        : back()->with('fail', 'Ocorreu algum problema ao tentar editar os dados do manager!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $manager = Manager::findOrFail($request->id);

        // if () { // Regra de exclusão de manager.
        //     return redirect()->back()->with('fail', 'O manager não pode ser excluído porque ...!');
        // }

        $manager_id = $manager->id;

        $manager->delete();

        if ($manager_id == Auth::guard('professor')->user()->id) {
            Auth::guard('professor')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('manager.login');
        }

        return $manager ? back()->with('success', 'O manager foi excluído com sucesso!')
                        : back()->with('fail', 'Ocorreu algum problema ao tentar exlui o manager!');
    }

    public function search(Request $request)
    {
        if ($request->has('search')) {
            $managers = Manager::where('name', 'LIKE', '%' . $request->search . '%')->paginate(10);
        }

        $filters = $request->except('_token');

        return view('manager.managers', compact('managers', 'filters'));
    }
}
