<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function login()
    {
        return view('account.login');
    }

    public function post_login(Request $request)
    {
        // Handle login logic here
        // Validate the request, authenticate the user, etc.
        
        // For now, just redirect back to the login page
        return redirect()->route('index')->with('message', 'Login successful!');
    }

    public function register()
    {
        return view('account.register');
        return redirect()->route('account.register')->with('message', 'Register successful!');
    }

    public function post_register(Request $request)
    {
    //    validate dữ liệu trên form
        $rules = [
            'name' => 'required|max:100',
            'email' => 'required|unique:accounts|max:100',
            'phone' => 'required|max:50',
            'address' => 'required|max:200',
            'password' => 'required|min:6|max:12',
            'password_confirmation' => 'required|same:password',
        ];
        $message = [
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Email đã tồn tại',
            'phone.required' => 'Số điện thoại không được để trống',
            'address.required' => 'Địa chỉ không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.max' => 'Mật khẩu chỉ được tối đa 12 ký tự',
            'password_confirmation.required' => 'Xác nhận mật khẩu không được để trống',
            'password_confirmation.same' => 'Xác nhận mật khẩu chưa đúng',
        ];
        $request->validate($rules, $message);
        // Lưu thông in vào bảng accounts
        $add = Account::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'password' => bcrypt($request->password)
        ]);
        // kiểm tra thêm mới thành công hay không
        if(!$add){
            return redirect()->back()->with('error','Đăng ký không thành công vui lòng thử lại');
        }
        return redirect()->route('account.login');

    }

}
