
@extends('quiz_host.auth.layout.auth')

@section('title', 'Welcome')

@section('container_content')

<style>

.nav-tabs { border-bottom: 2px solid orange;}
/* .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover { border-width: 0; }
.nav-tabs > li > a { border: 1px solid orange; color: orange !important; }
.nav-tabs > li.active > a, .nav-tabs > li > a:hover { border: none; color: #4285F4 !important; background: transparent; }
.nav-tabs > li > a::after { content: ""; background: #dd0000; height: 2px; position: absolute; width: 100%; left: 0px; bottom: -1px; transition: all 250ms ease 0s; transform: scale(0); }
.nav-tabs > li.active > a::after, .nav-tabs > li:hover > a::after { transform: scale(1); }
.tab-nav > li > a::after { background: orange none repeat scroll 0% 0%; color: blue; } */

.tab-pane { padding: 5px 0; }
.tab-content{padding:5px}
.nav-link.active { background-color: orange !important; border: 1px solid #000 !important; color: #070764 !important;}
.nav-link:hover { border: 1px solid orange !important; border-bottom: none !important; }
.nav-link { color: orange !important; }

</style>

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">Link 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">Link 2</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Link 3</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Link 4</a>
                </li>
               	<li class="nav-item dropdown ml-auto">
            		<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Welcome, {{ Auth::user()->username }}</a>
            		<div class="dropdown-menu">
            			<a class="dropdown-item" href="#">Profile</a>
            			<a class="dropdown-item" href="#">Edit Account</a>
            			<div class="dropdown-divider"></div>
            			<a class="dropdown-item" href="{{ route('logout') }}?_token={{ csrf_token() }}">Logout</a>
            		</div>
            	</li>
            </ul>
        </div>
    </div>
<div class="tab-content">
    <div id="home" class="tab-pane fade in active">
         <h3>Today&apos;s Auction</h3>
        <p>Paste your content here.</p>
    </div>
    <div id="menu1" class="tab-pane fade">
         <h3>All Auctions</h3>
        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
            ut aliquip ex ea commodo consequat.</p>
    </div>
    <div id="menu2" class="tab-pane fade">
         <h3>My Saved Choices</h3>
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
            doloremque laudantium, totam rem aperiam.</p>
    </div>
</div>
@endsection