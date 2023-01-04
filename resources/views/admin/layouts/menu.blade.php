<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">

    <li class="treeview {{ active_menu('settings')[0] }}">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>{{ trans('admin.Dashboard') }}</span>
            <span class="pull-right-container">
            </span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('settings')[1] }}">
            <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i>{{ trans('admin.Dashboard') }}</a></li>
            <li><a href="{{ url('admin/settings') }}"><i class="fa fa-cog"></i>{{ trans('admin.settings') }}</a>
            </li>
        </ul>
    </li>

    <li class="treeview {{ active_menu('categories')[0] }}">
        <a href="#">
            <i class="fa fa-align-justify"></i> <span>{{ trans('admin.categories') }}</span>
            <span class="pull-right-container"></span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('categor')[1] }}">
            <li class=""><a href="{{ url('admin/categories') }}">

                    <i class="fa fa-globe"></i>{{ trans('admin.categories') }}</a></li>
            <li class=""><a href="{{ url(route('admin.categories.create')) }}"><i class="fa fa-plus"></i>{{ trans('admin.add') }}</a></li>
        </ul>
    </li>




    <li class="treeview {{ active_menu('questions')[0] }}">
        <a href="#">
            <i class="fa fa-bars"></i> <span>{{ trans('admin.questions') }}</span>
            <span class="pull-right-container"></span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('question')[1] }}">
            <li class=""><a href="{{ url('admin/questions') }}"><i class="fa fa-globe"></i>{{ trans('admin.questions') }}</a></li>
            <li class=""><a href="{{ url(route('admin.questions.create')) }}"><i class="fa fa-plus"></i>{{ trans('admin.add') }}</a></li>
        </ul>
    </li>

    <li class="treeview {{ active_menu('pages')[0] }}">
        <a href="#">
            <i class="fa fa-paper-plane"></i> <span>{{ trans('admin.pages') }}</span>
            <span class="pull-right-container"></span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('posts')[1] }}">
            <li class=""><a href="{{ url('admin/pages') }}"><i class="fa fa-globe"></i>{{ trans('admin.pages') }}</a></li>
            <li class=""><a href="{{ url(route('admin.pages.create')) }}"><i class="fa fa-plus"></i>{{ trans('admin.add') }}</a></li>
        </ul>
    </li>


    <li class="treeview {{ active_menu('users')[0] }}">
        <a href="#">
            <i class="fa fa-users"></i> <span>{{ trans('admin.users') }}</span>
            <span class="pull-right-container"></span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('user')[1] }}">
            <li class=""><a href="{{ url('admin/users') }}"><i class="fa fa-globe"></i>{{ trans('admin.users') }}</a></li>
            <li class=""><a href="{{ url(route('admin.users.create')) }}"><i class="fa fa-plus"></i>{{ trans('admin.add') }}</a></li>
        </ul>
    </li>


    <li class="treeview {{ active_menu('locations')[0] }}">
        <a href="#">
            <i class="fa fa-globe"></i> <span>{{ trans('admin.locations') }}</span>
            <span class="pull-right-container"></span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('location')[1] }}">
            <li class=""><a href="{{ url('admin/locations') }}"><i class="fa fa-globe"></i>{{ trans('admin.locations') }}</a></li>
            <li class=""><a href="{{ url(route('admin.locations.create')) }}"><i class="fa fa-plus"></i>{{ trans('admin.add') }}</a></li>
        </ul>
    </li>
    <li class="treeview {{ active_menu('departments')[0] }}">
        <a href="#">
            <i class="fa fa-adn"></i> <span>{{ trans('admin.departments') }}</span>
            <span class="pull-right-container"></span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('department')[1] }}">
            <li class=""><a href="{{ url('admin/departments') }}"><i class="fa fa-globe"></i>{{ trans('admin.departments') }}</a></li>
            <li class=""><a href="{{ url(route('admin.departments.create')) }}"><i class="fa fa-plus"></i>{{ trans('admin.add') }}</a></li>
        </ul>
    </li>

    @if(auth()->user()->id == 2)
        <li class="treeview {{ active_menu('reports')[0] }}">
            <a href="#">
                <i class="fa fa-bar-chart"></i> <span>{{ trans('admin.reports') }}</span>
                <span class="pull-right-container"></span>
            </a>
            <ul class="treeview-menu" style="{{ active_menu('report')[1] }}">
                <li class=""><a href="{{ url('admin/reports') }}"><i class="fa fa-globe"></i>{{ trans('admin.reports') }}</a></li>
            </ul>
        </li>


        <li class="treeview {{ active_menu('admins')[0] }}">
            <a href="#">
                <i class="fa fa-user"></i> <span>{{ trans('admin.admins') }}</span>
                <span class="pull-right-container"></span>
            </a>
            <ul class="treeview-menu" style="{{ active_menu('admin')[1] }}">
                <li class=""><a href="{{ url('admin/admins') }}"><i class="fa fa-globe"></i>{{ trans('admin.admins') }}</a></li>
                <li class=""><a href="{{ url(route('admin.admins.create')) }}"><i class="fa fa-plus"></i>{{ trans('admin.add') }}</a></li>
            </ul>
        </li>

    @endif

</ul>
