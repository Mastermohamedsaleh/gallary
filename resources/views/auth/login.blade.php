@extends('layouts.app')

@section('content')

<link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"/>

<section class="vh-100" style="background-color:#3c8dbc">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;  padding:50px">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="{{ URL::asset('assets/images/undraw_makeup_artist_rxn8.svg') }}" style="height: 100%;"
                  alt="login form" class="img-fluid animated" style="border-radius: 1rem 0 0 1rem;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
  
                      <span class="h1 fw-bold  text-center">سجل الدخول </span>
                
                  <div class="main-signup-header text-center">
                                         
                                            @if ($errors->any())
                                                <div class="alert alert-danger mt-3">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
</div>
  
         

                                            {{--form admin--}}
                                       
                                                <form method="POST" action="{{ route('login') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>الاميل</label> <input  class="form-control" placeholder="Enter your email" type="email" name="email" :value="old('email')" required autofocus>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>الباسورد</label> <input class="form-control" placeholder="Enter your password"   type="password"name="password" required autocomplete="current-password" >
                                                    </div>
                                                    
                                      <button type="submit" class="btn btn-primary mt-3" style="background-color:#3c8dbc">سجل</button>
                                      

                                            </div>
                                            </form>






</div>
                                            


  
                
          
            </div>
          </div>
        </div>
      </div>
    </div>



</section>




@endsection
