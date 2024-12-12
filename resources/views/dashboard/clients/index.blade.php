@extends('dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.clients')</h1>


            @if(Session::has('success'))
<p class="alert alert-info">{{ Session::get('success') }}</p>
@endif


            <ol class="breadcrumb">
                <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.clients')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.clients') </h3>

                    <form action="{{ route('clients.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                            
                                    <a href="{{ route('clients.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                               
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($clients->count() > 0)

                        <table class="table table-hover text-center">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.phone')</th>
                                <th>@lang('site.add_order')</th>
                                <th>@lang('site.address')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                            @foreach ($clients as $index=>$client)
                                <tr>
                                <td>{{ $index + 1 }}</td>
                                    <td>{{ $client->name }}</td>

                                    <td>
                                         @foreach($client->phone as $p)
                                                   {{-$p}}
                                         @endforeach
                                    </td>



                                    <td>
                                        @if (auth()->user()->hasPermission('orders_create'))
                                            <a href="{{url('orders_create',$client->id)}}" class="btn btn-primary btn-sm">@lang('site.add_order')</a>
                                           
                                        @else
                                            <a href="#" class="btn btn-primary btn-sm disabled">@lang('site.add_order')</a>
                                        @endif
                                    </td>

                                    <td>{{ $client->address }}</td>
                            
                                    <td>
                                        @if (auth()->user()->hasPermission('clients_update'))
                                            <a href="{{route('clients.edit', $client->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @endif
                                        @if (auth()->user()->hasPermission('clients_delete'))
                                            <form action="{{ route('clients.destroy', $client->id) }}" method="post" style="display: inline-block">
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
                        
          
                    

                        <div class="text-center">
                        {{$clients->links() }} 

                        </div>
                        
                    @else
                        
                        <h2>@lang('site.no_data_found')</h2>
                        
                    @endif
             

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection