<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ForgetPassMail;
use App\Models\Admin;
use App\Models\Country;
use App\Models\Gender;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator ;
use Propaganistas\LaravelPhone\PhoneNumber;
use Propaganistas\LaravelPhone\Rules\Phone;

class AdminController extends Controller
{

    public function adminLogin()
    {
        $datas = Country::all();
        $genders = Gender::all();
        return view('auth.admin.login',compact('datas','genders'));

    }

    public function loadForgetMyPass()
    {
        $datas = Country::all();
        return view('auth.admin.forget',compact('datas'));

    }

    public function findUser(Request $request)
    {
        $countryIso = Country::where('id',18)->first();

        $validated = $request->validate([
            'email_or_phone' => ['bail','required'],
            ],
            [
                'email_or_phone.regex' => 'The phone number must contain only English digits (0-9).',
                'email_or_phone.required' => 'The phone number is required',
            ]
        );

        if (filter_var($request->email_or_phone, FILTER_VALIDATE_EMAIL)) {
            $credential = array("email" => $request->email_or_phone);
        }
        else
        {
            $phoneNumber = validationMobileNumber($request->email_or_phone,$countryIso->iso);
            $credential = array("phone" => $phoneNumber);
            $email = false;
        }

        $admin = Admin::where($credential)->first();

        if ($admin) {
            $toster = array(
                'message' => 'User Found',
                'alert-type' => 'success'
            );

            return redirect()->route('otpLoad')->with('uuid', $admin->id)->with($toster);

        }
        else
        {
            $toster = array(
                'message' => 'User Not Found',
                'alert-type' => 'error'
            );

            return back()->with( $toster);
        }
    }



    public function adminValidateLogin(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'email_or_phone' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Check if input is email format
        if (filter_var($request->email_or_phone, FILTER_VALIDATE_EMAIL)) {
            $credential = [
                'email' => $request->email_or_phone, 
                'password' => $request->password
            ];
        } else {
            // Try phone number login
            try {
                $countryIso = Country::where('id', 18)->first();
                if ($countryIso) {
                    $phoneNumber = validationMobileNumber($request->email_or_phone, $countryIso->iso);
                    $credential = [
                        'phone' => $phoneNumber, 
                        'password' => $request->password
                    ];
                } else {
                    // If country not found, treat as phone directly
                    $credential = [
                        'phone' => $request->email_or_phone, 
                        'password' => $request->password
                    ];
                }
            } catch (\Exception $e) {
                // If validation fails, try direct phone number
                $credential = [
                    'phone' => $request->email_or_phone, 
                    'password' => $request->password
                ];
            }
        }

        if (Auth::guard('admin')->attempt($credential)) {
            $user = Auth::guard('admin')->user();

            if ($user->status == 0) {
                $toster = [
                    'message' => 'This account is blacklisted',
                    'alert-type' => 'error'
                ];

                Auth::guard('admin')->logout();
                return back()->with($toster);
            }

            return redirect()->route('admin.dashboard');
        }

        $toster = [
            'message' => 'Wrong credentials. Please check your email/phone and password.',
            'alert-type' => 'error'
        ];

        return back()->with($toster)->withInput($request->only('email_or_phone'));
    }
    public function dashboard()
    {
        // Get statistics
        $totalOrders = \App\Models\Order::count();
        $pendingOrders = \App\Models\Order::where('status', 'pending')->count();
        $completedOrders = \App\Models\Order::where('status', 'completed')->count();
        $totalRevenue = \App\Models\Order::where('payment_status', 'paid')->sum('package_price');
        
        $totalPackages = \App\Models\Package::count();
        $activePackages = \App\Models\Package::where('status', true)->count();
        
        $totalUsers = \App\Models\User::count();
        $newsletterSubscribers = \App\Models\Newsletter::count();
        
        // Get recent orders
        $recentOrders = \App\Models\Order::with('package')
            ->latest()
            ->take(10)
            ->get();
        
        // Get order status breakdown
        $ordersByStatus = [
            'pending' => \App\Models\Order::where('status', 'pending')->count(),
            'confirmed' => \App\Models\Order::where('status', 'confirmed')->count(),
            'in_progress' => \App\Models\Order::where('status', 'in_progress')->count(),
            'completed' => \App\Models\Order::where('status', 'completed')->count(),
            'cancelled' => \App\Models\Order::where('status', 'cancelled')->count(),
        ];
        
        // Get payment status breakdown
        $paymentStats = [
            'paid' => \App\Models\Order::where('payment_status', 'paid')->count(),
            'unpaid' => \App\Models\Order::where('payment_status', 'unpaid')->count(),
            'refunded' => \App\Models\Order::where('payment_status', 'refunded')->count(),
        ];
        
        // Get monthly revenue data for chart (last 6 months)
        $monthlyRevenue = \App\Models\Order::where('payment_status', 'paid')
            ->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, SUM(package_price) as total')
            ->whereRaw('created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH)')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
        
        return view('admin.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'totalRevenue',
            'totalPackages',
            'activePackages',
            'totalUsers',
            'newsletterSubscribers',
            'recentOrders',
            'ordersByStatus',
            'paymentStats',
            'monthlyRevenue'
        ));
    }


    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('adminLogin');
    }


    public function otpLoad(Request $request)
    {
        $uuID = session('uuid') ?? $request->uuid;
        $admin = Admin::find($uuID);

        if (!$admin) {
            return back()->with([
                'message' => 'User Not Found',
                'alert-type' => 'error'
            ]);
        }

        $randCode = rand(100000,999999);
        $toster = array(
            'message' => 'User Found',
            'alert-type' => 'success'
        );
        $status = storeOtp($admin, $randCode);
        $name = $admin->name;
        $messageContent = "Your Reset Code is : {$randCode}";

        // Email Code
        if($admin->email != null && $status == true)
        {
            Mail::to($admin->email)->queue(new ForgetPassMail($name,$messageContent));
        }
        else
        {
            return back()->with([
                'message' => 'Error in otp sending',
                'alert-type' => 'error'
            ]);
        }

        return view('auth.admin.otp', compact('admin'))->with($toster);

    }

    public function validateOtp(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'otp' => 'required|array|size:6',
            'otp.*' => 'required|digits:1',
        ]);



        if ($validator->fails()) {
            $toster = array(
                'message' => 'Wrong OTP',
                'alert-type' => 'error'
            );
            return redirect()->route('loadForgetMyPass')->with( $toster);
        }

        $otp = preg_replace('/\D/', '', implode('', $request->input('otp')));


        $admin = Admin::find($request->uuid);

        // if ($admin->otp == $request->otp && $admin->otp_validate_time > now())
        if ($admin?->otp == $otp)
        {
            return view('auth.admin.confirmpass', compact('admin'));
        }
        else
        {
            $toster = array(
                'message' => 'Wrong OTP',
                'alert-type' => 'error'
            );

            return back()->with( $toster);
        }
    }

    public function updatePassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ],
        [
            'password.required' => 'The Password is required',
            'password_confirmation.required' => 'The Confirm Password is required',
            'password_confirmation.same' => 'The Confirm Password and Password must match',
        ]
    );

        if ($validator->fails()) {
            $toster = array(
                'message' => $validator->errors()->first(),
                'alert-type' => 'error'
            );
            return redirect()->route('adminLogin')->with( $toster);
        }


        $admin = Admin::find($request->uuid);
        $admin->password = Hash::make($request->password);
        $admin->save();

        $toster = array(
            'message' => 'Password Updated',
            'alert-type' => 'success'
        );

        return redirect()->route('adminLogin')->with($toster);
    }

}
