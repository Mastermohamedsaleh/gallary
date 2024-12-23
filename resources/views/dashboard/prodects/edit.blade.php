@extends('dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>المنتجات</h1>

            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i> الرئيسيه</a></li>
                <li><a href=""> المنتجات</a></li>
                <li class="active">تعديل</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">تعديل</h3>
                </div><!-- end of box header -->
                <div class="box-body">

              

                    <form action="{{ route('prodects.update', $product->id) }}" method="post" enctype="multipart/form-data">

                     @csrf    
                    {{ method_field('put') }}

                        <div class="form-group">
                            <label>الاقسام</label>
                            <select name="category_id" class="form-control">
                               
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

             
                        <div class="form-group">
                            <label>الاسم</label>
                            <input type="text" name="name" class="form-control" value="{{ $product->name }}">
                        </div>
                        



 


                        <div class="form-group">
                            <label>سعر الشراء</label>
                            <input type="number" name="purchase_price" step="0.01" class="form-control" value="{{ $product->purchase_price }}">
                        </div>

                        <div class="form-group">
                            <label>سعر البيع</label>
                            <input type="number" name="sale_price" step="0.01" class="form-control" value="{{ $product->sale_price }}">
                        </div>

                        <div class="form-group">
                            <label>العدد</label>
                            <input type="number" name="stock" class="form-control" value="{{ $product->stock}}">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> تعديل</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection