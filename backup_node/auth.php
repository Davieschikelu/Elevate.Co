namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthComponent extends Component
{
public $isLogin = true;
public $email, $password, $first_name, $last_name;

public function toggleMode()
{
$this->isLogin = !$this->isLogin;
$this->resetErrorBag();
}

public function authenticate()
{
$this->validate([
'email' => 'required|email',
'password' => 'required|min:6',
]);

if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
return redirect()->route('dashboard');
}

addError('email', 'Invalid credentials.');
}

public function register()
{
$this->validate([
'first_name' => 'required',
'email' => 'required|email|unique:users',
'password' => 'required|min:6',
]);

$user = User::create([
'name' => $this->first_name . ' ' . $this->last_name,
'email' => $this->email,
'password' => bcrypt($this->password),
]);

Auth::login($user);
return redirect()->route('dashboard');
}

public function render()
{
return view('livewire.auth-component');
}
}