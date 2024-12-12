@extends('dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>الاقسام</h1>

            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i> الرئيسيه</a></li>
                <li><a href=""> الاقسام</a></li>
                <li class="active">اضافه</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">اضافه</h3>
                </div><!-- end of box header -->
                <div class="box-body">


                
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


                    <form action="{{ route('categories.store') }}" method="post">

                       @csrf
                        {{ method_field('post') }}

                     
                        <div class="form-group">
                        <input type="text" class="form-control m-2" name="name" placeholder="اسم القسم" >
                        </div>
                        
  

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>اضافه</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection