@extends('dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>المشرفين</h1>

            @if(Session::has('success'))
<p class="alert alert-info">{{ Session::get('success') }}</p>
@endif


            <ol class="breadcrumb">
                <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> الرئيسيه</a></li>
                <li class="active">المشرفين</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">المشرفين <small></small></h3>

                    <form action="{{route('users.index')}}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"  value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                @if (auth()->user()->hasPermission('users_create'))              
                <a href="{{route('users.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> اضافه</a>
                @else
                <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>اضافه</a>
                @endif
                          
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($users->count() > 0)

                        <table class="table table-hover text-center">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                           
                                <th>الاميل</th>
                                <th>الصوره</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                            @foreach ($users as $index=>$user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><img src="{{ asset('uploads/users/' . $user->image ) }}" style="width: 100px;" class="img-thumbnail" alt=""></td>
                                    <td>
                                    @if (auth()->user()->hasPermission('users_update'))                
                        <a href="{{route('users.edit',$user->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                        @else
                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                        @endif
                                           
                                  
                                       @if (auth()->user()->hasPermission('users_delete'))
                                            <form action="{{route('users.destroy',$user->id)}}" method="post" style="display: inline-block">
                                                    @csrf
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                            </form><!-- end of form -->
                                            @else
                                            <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                        @endif                                
                                     
                                    </td>
                                </tr>
                            
                            @endforeach
                            </tbody>

                        </table><!-- end of table -->
                                
                        {{ $users->appends(request()->query())->links() }}
                      
                        
                    @else
                        
                        <h2>@lang('site.no_data_found')</h2>
                        
                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection