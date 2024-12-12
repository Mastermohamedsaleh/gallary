@extends('dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>المشرفين</h1>

            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i> الرئيسيه</a></li>
                <li><a href=""> المشرفين</a></li>
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


 

                    <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">

                        @csrf
                     

                        <div class="form-group">
                            <label>الاسم</label>
                            <input type="text" name="name" class="form-control" >
                        </div>



        

                        <div class="form-group">
                            <label>الاميل</label>
                            <input type="email" name="email" class="form-control" >
                        </div>


                        <div class="form-group">
                            <img src="{{ asset('uploads/users/default.png') }}"  style="width: 100px" class="img-thumbnail image-preview" alt="">
                        </div>

                        <div class="form-group">
                            <label>الباسورد</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>تأكيد الباسورد</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>التصريحات</label>
                            <div class="nav-tabs-custom">

                                @php
                                    $models = ['users', 'categories', 'products', 'clients', 'orders'];
                                    $maps = ['create', 'read', 'update', 'delete'];
                                @endphp

                                <ul class="nav nav-tabs">
                                    @foreach ($models as $index=>$model)
                                        <li class="{{ $index == 0 ? 'active' : '' }}"><a href="#{{ $model }}" data-toggle="tab">@lang('site.' . $model)</a></li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">

                                    @foreach ($models as $index=>$model)

                                        <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{ $model }}">

                                            @foreach ($maps as $map)
                                                <label><input type="checkbox" name="permissions[]" value="{{ $model . '_' . $map  }}"> @lang('site.' . $map)</label>
                                            @endforeach

                                        </div>

                                    @endforeach

                                </div><!-- end of tab content -->
                                
                            </div><!-- end of nav tabs -->
                            
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection