@extends('dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>المنتجات</h1>

            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i>الرئيسيه</a></li>
                <li><a href=""> المنتجات</a></li>
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
                    <form action="{{ route('prodects.store') }}" method="post" enctype="multipart/form-data">

                        @csrf
                        {{ method_field('post') }}

                        <div class="form-group">
                            <label>الاقسام</label>
                            <select name="category_id" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        

                            <div class="form-group">
                                <label>الاسم</label>
                                <input type="text" name="name" class="form-control" value="">
                            </div>


                
                 

                        <div class="form-group">
                            <label>الصوره</label>
                            <input type="file" name="image" class="form-control image">
                        </div>

                

                        <div class="form-group">
                            <label>سعر الشراء</label>
                            <input type="number" name="purchase_price" step="0.01" class="form-control" value="{{ old('purchase_price') }}">
                        </div>

                        <div class="form-group">
                            <label>سعر البيع</label>
                            <input type="number" name="sale_price" step="0.01" class="form-control" value="{{ old('sale_price') }}">
                        </div>

                        <div class="form-group">
                            <label>العدد</label>
                            <input type="number" name="stock" class="form-control" value="{{ old('stock') }}">
                        </div>

                        <div class="form-group">
                            <label>الكود</label>
                            <input type="text" name="barcode" class="form-control" value="{{ old('barcode') }}">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> اضافه</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection