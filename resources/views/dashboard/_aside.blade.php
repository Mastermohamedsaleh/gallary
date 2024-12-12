<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">



       


                <img src="{{ asset('uploads/users/' .  image()   ) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{   substr(  auth()->user()->name , 0 , 20)  }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
        <li><a href="{{URL('/')}}"><i class="fa fa-th"></i><span>الرئيسيه</span></a></li>


            @if(auth()->user()->hasPermission('users_read'))
            <li><a href="{{URL('users')}}"><i class="fa fa-th"></i><span>المشرفين</span></a></li>
           @endif


           @if(auth()->user()->hasPermission('categories_read'))
           <li><a href="{{URL('categories')}}"><i class="fa fa-th"></i><span>الاقسام</span></a></li>
           @endif

           @if(auth()->user()->hasPermission('products_read'))
           <li><a href="{{URL('prodects')}}"><i class="fa fa-th"></i><span>المنتجات</span></a></li>         
           @endif
           @if(auth()->user()->hasPermission('clients_read'))
           <li><a href="{{URL('clients')}}"><i class="fa fa-th"></i><span>العملاء</span></a></li>         
           @endif



           @if(auth()->user()->hasPermission('orders_read'))
           <li><a href="{{URL('orders')}}"><i class="fa fa-th"></i><span>الطلبات</span></a></li>         
           @endif



        
           <li><a href="{{ URL('setting'  , auth()->user()->id ) }}"><i class="fa fa-th"></i><span>الاعدادات</span></a></li>         
    



        


            {{--<li><a href="{{ route('dashboard.categories.index') }}"><i class="fa fa-book"></i><span>@lang('site.categories')</span></a></li>--}}
            {{----}}
            {{----}}
            {{--<li><a href="#"><i class="fa fa-users"></i><span>@lang('site.users')</span></a></li>--}}

            {{--<li class="treeview">--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-pie-chart"></i>--}}
            {{--<span>الخرائط</span>--}}
            {{--<span class="pull-right-container">--}}
            {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
            {{--</a>--}}
            {{--<ul class="treeview-menu">--}}
            {{--<li>--}}
            {{--<a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="../charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</li>--}}
        </ul>

    </section>

</aside>

