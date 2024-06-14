@php
    $segment = Request::segment(1);
@endphp

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">

            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David
                                    Williams</strong>
                            </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span>
                        </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>

            @foreach (config('app.module.module') as $key => $item)
                <li class="{{ $segment == $item['name'] ? 'active' : '' }}">
                    <a href="#"><i class="{{ $item['icon'] }}"></i> <span
                            class="nav-label">{{ $item['title'] }}</span>
                        <span class="fa arrow"></span></a>

                    <ul class="nav nav-second-level collapse in" style="">
                        @foreach ($item['subModule'] as $child)
                            <li class="{{ $segment == $child['title'] ? 'active' : '' }}">
                                <a href="{{ $child['route'] }}">{{ $child['title'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach

            {{-- <li>
                <a href="layouts.html"><i class="fa fa-diamond"></i> <span class="nav-label">Layouts</span></a>
            </li> --}}
        </ul>

    </div>
</nav>
