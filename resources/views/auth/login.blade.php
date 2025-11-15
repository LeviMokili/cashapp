@extends('layouts.app')
@section('content')
    <div class="mb-0 w-screen lg:mx-auto lg:w-[500px] card shadow-lg border-none shadow-slate-100 relative">
        <div class="!px-10 !py-12 card-body">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="px-4 py-3 mb-3 text-sm text-green-500 border border-green-200 rounded-md bg-green-50 dark:bg-green-400/20 dark:border-green-500/50">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="px-4 py-3 mb-3 text-sm text-red-500 border border-red-200 rounded-md bg-red-50 dark:bg-red-400/20 dark:border-red-500/50">
                    {{ session('error') }}
                </div>
            @endif
            
            <!-- Validation Errors -->
            @if($errors->any())
                <div class="px-4 py-3 mb-3 text-sm text-red-500 border border-red-200 rounded-md bg-red-50 dark:bg-red-400/20 dark:border-red-500/50">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mt-8 text-center">
                <h4 class="mb-1 dark:custom-black-500 dark:text-custom-500">TIC-TAC Cash Transfer </h4>
                <p class="text-slate-500 dark:text-zink-200">Sign in to continue</p>
            </div>

            <form action="{{ route('login.post') }}" class="mt-10" id="" method="POST">
                @csrf
                
                <!-- Remove the hidden successAlert div since we're using dynamic flash messages -->
                
                <div class="mb-3">
                    <label for="name" class="inline-block mb-2 text-base font-medium">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Enter email address">
                    @error('name')
                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="password" class="inline-block mb-2 text-base font-medium">Password</label>
                    <input type="password" id="password" name="password" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Enter password">
                    @error('password')
                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                
                <div>
                    <div class="flex items-center gap-2">
                        <!-- <input id="remember" name="remember" class="border rounded-sm appearance-none size-4 bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500 dark:checked:bg-custom-500 dark:checked:border-custom-500 checked:disabled:bg-custom-400 checked:disabled:border-custom-400" type="checkbox" value="1" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="inline-block text-base font-medium align-middle cursor-pointer">Remember me</label> -->
                    </div>
                </div>
                
                <div class="mt-10">
                    <button type="submit" class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Sign In</button>
                </div>

                <!-- Rest of your form remains the same -->
               
<!-- 
                <div class="mt-10 text-center">
                    <p class="mb-0 text-slate-500 dark:text-zink-200">Don't have an account ?
                        <a href="{{ route('register') }}" class="font-semibold underline transition-all duration-150 ease-linear text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500"> SignUp</a>
                    </p>
                </div> -->
            </form>
        </div>
    </div>
@endsection