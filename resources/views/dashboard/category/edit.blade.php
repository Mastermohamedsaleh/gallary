@extends('dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>الاقسام</h1>

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> الرئيسيه</a></li>
                <li><a href="#"> الاقسام</a></li>
                <li class="active">تعديل</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">تعديل</h3>
                </div><!-- end of box header -->

                <div class="box-body">

              

                    <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">

                        @csrf
                        {{ method_field('put') }}

                  

                        <div class="form-group">
                            <label>الاسم</label>
                            <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                        </div>
                        
               


               
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection