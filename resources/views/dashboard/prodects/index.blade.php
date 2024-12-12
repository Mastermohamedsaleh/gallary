@extends('dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>المنتجات</h1>


            @if(Session::has('success'))
<p class="alert alert-info">{{ Session::get('success') }}</p>
@endif
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> الرئسيه</a></li>
                <li class="active">المنتجات</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">المنتجات</h3>

                    <form action="{{ Route('prodects.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>

               
                            
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> بحث</button>
                                @if (auth()->user()->hasPermission('products_create'))
                                    <a href="{{ route('prodects.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> اضافه</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> اضافه</a>
                                @endif
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($products->count() > 0)

                        <table class="table table-hover text-center">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>القسم</th>
                                <th>الصوره</th>
                                <th>سعر الشراء</th>
                                <th>سعر البيع</th>
                                <th>العدد</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                            @foreach ($products as $index=>$product)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td><img src="{{ asset('uploads/products/'.$product->image) }}" style="width: 100px"  class="img-thumbnail" alt=""></td>
                                    <td>{{ $product->purchase_price }}</td>
                                    <td>{{ $product->sale_price }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                        @if (auth()->user()->hasPermission('products_update'))
                                            <a href="{{ route('prodects.edit', $product->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> تعديل</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> تعديل</a>
                                        @endif
                                        @if (auth()->user()->hasPermission('products_delete'))
                                            <form action="{{ route('prodects.destroy', $product->id) }}" method="post" style="display: inline-block">
                                                 @csrf
                                                {{ method_field('delete') }}
                                                   <input type="hidden"  name="old_image" value="{{$product->image}}">

                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> حذف</button>
                                            </form><!-- end of form -->
                                        @else
                                            <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> حذف</button>
                                        @endif
                                    </td>
                                </tr>
                            
                            @endforeach
                            </tbody>

                        </table><!-- end of table -->
                        {{ $products->links() }} 
                        
                    @else
                        
                        <h2>لايوجد منتجات</h2>
                        
                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection