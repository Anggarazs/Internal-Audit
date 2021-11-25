<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Department;
use App\Models\Audit;
use DB;

class AccountController extends Controller
{   
    public function index_account(){
        $department = Department::all();
        $account = DB::table('users')
            ->join('department','users.id_department','=','department.id')
            ->select('users.*','department.nama_department')
            ->get();
        return view('account.account_index',['department' => $department, 'account' => $account]);
    }

    public function insert_account(Request $request){
        $validateData = $request->validate([
            "username" => 'required|max:255|unique:users',
            "id_department" => 'required',
            "role" => 'required',
            "password" => 'required|min:6|max:255'
        ]);
        $validateData['password'] = bcrypt($validateData['password']);
        Account::create($validateData);
        session()->flash('berhasil', 'Akun Berhasil Ditambahkan');
        return redirect('/account');
    }

    public function edit_account($id){
        $account =Account::where("id", $id)->first();
        $department = Department::all();
        return view('account.edit_account', ['department' => $department,'account' => $account]);
    }

    public function edit_account_process(Request $request){
        $validateData = $request->validate([
            "username" => 'required|max:255',
            "id_department" => 'required',
            "role" => 'required',
            "password" => 'required|min:6|max:255'
        ]);
        if ($validateData) {
            $account = Account::where('id', $request['id'])->update(['username' => $request["username"], 'id_department' => $request["id_department"],'role' => $request["role"], 'password' => bcrypt($request["password"])]);

            if ($account) {
                session()->flash('berhasil', 'Akun Berhasil Diubah');
                return redirect('/account');
            } else {
                session()->flash('gagal', 'Akun Gagal Diubah');
                return redirect('/edit_account/' . $request["id"]);
            }
        }
    }

    public function delete_account($id){
        $account =Account::where("id", $id);
        $account->delete();
        session()->flash('berhasil', 'Akun Berhasil Dihapus');
        return redirect('/account');
    }

}
