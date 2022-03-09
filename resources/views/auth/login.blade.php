@extends('layouts.app')
@section('style')
    <style>
        .invalid-feedback p {
            color: red
        }
    </style>
@endsection
@section('content')
    <div class="w-87/5 mx-auto">
        <header>
            <div class="w-full mx-0 bg-mocono-300 flex justify-between items-center py-5 px-5">
                <h1 class="text-white text-2xl xs:text-3xl sm:text-4xl font-semibold ">mocono</h1>
            </div>
        </header>
        <main class="bg-mocono-gray">
            <div class="w-full">
                <h4 class="text-2xl md:text-3xl text-center text-mocono-300 pt-16 pb-8 font-medium">Get your paywall
                    started</h4>
            </div>
            <div class="w-full flex justify-center">
                <div class="w-11/12  md:w-136 mb-20">
                        <form  method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="bg-white p-8 rounded shadow-sm mb-4">
                        <div class="flex flex-col mb-4">
                            <label class="font-medium text-mocono-text text-sm sm:text-base mb-2"
                                   for="email">Email</label>
                            <input type="email" name="email"
                                   class="w-full bg-mocono-gray border-none focus:border-none h-9 rounded"
                                   id="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <p>{{ $message }}</p>
                                    </span>
                            @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="font-medium text-mocono-text text-sm sm:text-base mb-2" for="password">Password</label>
                            <input type="password" name="password"
                                   class="w-full bg-mocono-gray border-none focus:border-none h-9 rounded"
                                   id="password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <p>{{ $message }}</p>
                                    </span>
                            @enderror
                        </div>
                        <div class="flex flex-col relative">
                            <label class="inline-flex items-center">
                                <input type="checkbox"
                                       class="form-checkbox rounded-none h-5 w-5 text-mocono-100 bg-mocono-gray border-gray-300">
                                <span class="ml-3 font-medium text-mocono-text text-sm sm:text-base">Remember me</span>
                            </label>
                        </div>
                            </div>
                             <div class="text-center flex gap-4">
                             <a href="{{url('register')}}" class="text-sm 2xl:text-base hover:text-gray-700">Create Account</a>
                             <a href="{{url('register')}}" class="text-sm 2xl:text-base text-blue-500 hover:text-blue-300">Forgot Password</a>
                             </div>
                            <div class="w-full flex justify-center md:justify-end mt-4 ">
                                <button type="submit" class="w-32 h-12 bg-mocono-200 text-white rounded-md focus:outline-none"
                                        aria-label="Create Account Button">Login
                                </button>
                            </div>
                    </form>

                </div>
            </div>
        </main>
    </div>
@endsection
