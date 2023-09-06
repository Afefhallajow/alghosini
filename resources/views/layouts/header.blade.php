<div  id="header">
    <div id="header-elements">
        <a id="img-header" class="" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="true">
            <img src="{{asset('flexassests/image/1.jpg')}}">

        </a>
        <a  id="username"  style="display:inline-block;" class="mx-2 " href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"  aria-expanded="true" v-pre>
      {{auth()->user()->name}}
        </a>


        <ul   style="overflow: hidden;z-index: 150" class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li>                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                </a>

                <form id="logout-form" action="/" method="POST" class="d-none">
                    @csrf
                </form>
            </li>

        </ul>


    </div>
    <div id="header-elements-end">

        <a  onclick="openFullscreen()" id="fullscreen"  style="display:inline-block;" class="mx-4 " href="#" role="button"   aria-expanded="true" v-pre>
            <span id="fullscreenitem" class="uil uil-expand-arrows-alt"></span>
        </a>
<!--        <div id="nofication" class="">
            <a id="navbarDropdown" class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <i class="fa fa-bell"></i>
                <span class="badge badge-light bg-success badge-xs"></span>
            </a>
            <ul data-no-collapse="true" class="dropdown-menu">


            </ul>
        </div>
-->
        <div  id="dropdownbutton">
            <button id="menubutton" class="btn btn-dark">=</button>
        </div>

    </div>







</div>
