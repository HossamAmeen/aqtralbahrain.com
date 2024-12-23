<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('user') }}">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">{{ __('user.user') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">



    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('user.shop') }}
    </div>

    <!-- Orders -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.order.index') }}">
            <i class="fas fa-hammer fa-chart-area"></i>
            <span>{{ __('user.orders') }}</span>
        </a>
    </li>

    <!-- Reviews -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.productreview.index') }}">
            <i class="fas fa-comments"></i>
            <span>{{ __('user.reviews') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      {{ __('user.posts') }}
    </div>

    <!-- Comments -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('user.post-comment.index') }}">
          <i class="fas fa-comments fa-chart-area"></i>
          <span>{{ __('user.comments') }}</span>
      </a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>