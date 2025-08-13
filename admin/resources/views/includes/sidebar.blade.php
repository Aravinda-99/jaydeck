<section>
  <!-- Left Sidebar -->
  <aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
      <div>
        <img src="{{URL::asset('assets/img/main-logo.png')}}" width="100" alt="User" />
      </div>
      <div class="info-container">
        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{auth()->user()->name}}
        </div>
        <div class="btn-group user-helper-dropdown">
          <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
          <ul class="dropdown-menu pull-right">

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
            <li><a onclick="document.getElementById('logout-form').submit();"><i class="material-icons" type="submit">input</i>Sign Out</a> </li>
            <li><a href="#" data-toggle="modal" data-target="#userProfile"><i class="material-icons">account_box</i>Profile</a> </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
      <ul class="list">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{ \Request::is("dashboard") || Request::is("/") || Request::is("home")? 'active': ''}}">
          <a href="{{ url('/dashboard') }}">
            <i class="material-icons">dashboard</i>
            <span>Dashboard</span>
          </a>
        </li>

        <li class="header">PRODUCT MANAGEMENT</li>
        <li class="{{ \Request::is("products") || \Request::is("products/*") ? 'active': ''}}">
          <a href="{{ url('/products') }}">
            <i class="material-icons">layers</i>
            <span>Products</span>
          </a>
        </li>

        {{-- <li class="{{ \Request::is("brands") || \Request::is("brands/*") ? 'active': ''}}">
          <a href="{{ url('/brands') }}">
            <i class="material-icons">widgets</i>
            <span>Brands</span>
          </a>
        </li> --}}

        <li class="{{ \Request::is("main-category") || \Request::is("sub-category") || \Request::is("sub-category")? 'active': ''}}">
          <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">layers</i>
            <span>Product Categories</span>
          </a>
          <ul class="ml-menu">
            <li class="{{ \Request::is("main-category") ? 'active': ''}}">
              <a href="{{ url('/main-category') }}">
                <span>Main Categories</span>
              </a>
            </li>
            <li class="{{ \Request::is("sub-category1") ? 'active': ''}}">
              <a href="{{ url('/sub-category1') }}">
                <span>Sub Categories(Level 1)</span>
              </a>
            </li>
            <li class="{{ \Request::is("sub-category2") ? 'active': ''}}">
              <a href="{{ url('/sub-category2') }}">
                <span>Sub Categories(Level 2)</span>
              </a>
            </li>
          </ul>
        </li>

      </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
      <div class="copyright">
      </div>
      <div class="version">
        Copyrights, &copy; <a href="https://sltds.lk/">SLT Digital Info Services</a><br>
        <b>Version: </b> <i>1.0</i>
      </div>
    </div>
    <!-- #Footer -->
  </aside>
  <!-- #END# Left Sidebar -->
</section>
