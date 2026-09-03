<?php 
 namespace App\Http\Controllers\Auth; 
 use App\Http\Controllers\Controller;
  use App\Models\User; 
  use Illuminate\Http\Request;
  
  use Illuminate\Support\Facades\Auth;
   use Illuminate\Validation\Rules\Password; 
   class AuthController extends Controller 
   {  public function showRegister() 
     {
        return view('auth.register');
     }
     
     public function register(Request $request) 
     { $validated = $request->validate([ 'name' => ['required', 'string', 'max:255'], 'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'], 'password' => ['required', 'confirmed', Password::min(8)], 'terms' => ['accepted'], ]); 
        $user = User::create([ 'name' => $validated['name'], 'email' => $validated['email'], 'password' => $validated['password'], ]); 
        Auth::login($user);
         $request->session()->regenerate();
          return redirect('/'); 
      }
         public function showLogin() 
         { return view('auth.login'); 
                   }
          public function login(Request $request) 
              { $credentials = $request->validate([ 'email' => ['required', 'email'], 'password' => ['required'], ]);
                  $remember = $request->boolean('remember'); 
                  if (! Auth::attempt($credentials, $remember))
                   { return back()->withErrors([ 'email' => 'Identifiants incorrects.', ])->onlyInput('email');
                      } 
                     $request->session()->regenerate(); 
                      return redirect('/'); 
                }
              public function logout(Request $request) 
              { 
                
                Auth::logout(); $request->session()->invalidate(); 
                $request->session()->regenerateToken(); 
                return redirect('/login');
             } 
            
            
            }