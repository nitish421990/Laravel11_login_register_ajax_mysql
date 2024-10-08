<?php
    
namespace App\Http\Controllers\Auth;
    
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Models\User;
use Hash;
    
class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }   
        
    /**  
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.register');
    } 
         
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
  
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);
  
        if ($validator->fails()){
            return response()->json([
                    "status" => false,
                    "errors" => $validator->errors()
                ]);
        } else {
            if (Auth::attempt($request->only(["username", "password"]))) {
                return response()->json([
                    "status" => true, 
                    "redirect" => url("dashboard"),
                    "name"=> Auth::user()->name,
                ]);
            } else {
                return response()->json([
                    "status" => false,
                    "errors" => ["Invalid credentials"]
                ]);
            }
        }
    }
        
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {  
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lastname'=> 'required',
             'email' => 'required|email|unique:users',
             'phone'=>'required',
             'username' =>'required|unique:users',
             'password' => 'required|min:6',
        ]);
  
        if ($validator->fails()){
            return response()->json([
                    "status" => false,
                    "errors" => $validator->errors()
                ]);
        }
  
        $data = $request->all();
        $user = $this->create($data);
  
        Auth::login($user);
  
        return response()->json([
            "status" => true, 
            "redirect" => url("dashboard")
        ]);
        
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
    
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'lastname'=> $data['lastname'],
        'email' => $data['email'],
        'phone' => $data['phone'],
        'username'=> $data['username'],
        'password' => Hash::make($data['password'])
      ]);
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
    
        return Redirect('login');
    }
}