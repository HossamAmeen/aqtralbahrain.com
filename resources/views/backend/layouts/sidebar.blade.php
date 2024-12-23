<ul class="navbar-nav navigation bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin')}}">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">{{ __('admin.dashboard') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active" >
      <a class="nav-link" href="{{route('admin')}}">
      <span >{{ __('admin.dashboard') }}</span>  
      <i class="fas fa-fw fa-tachometer-alt"></i>
        </a>
    </li>
       <!-- Nav Item - Settings -->
       <li class="nav-item active">
      <a class="nav-link" href="{{route('settings')}}">
        <i class="fas fa-cog"></i>
        <span>{{ __('admin.settings') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('admin.banner') }}
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- Nav Item - Media Manager -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('file-manager')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>{{ __('admin.media_manager') }}</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-image"></i>
        <span>{{ __('admin.banners') }}</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">{{ __('admin.banner_options') }}:</h6>
          <a class="collapse-item" href="{{route('banner.index')}}">{{ __('admin.banners') }}</a>
          <a class="collapse-item" href="{{route('banner.create')}}">{{ __('admin.add_banners') }}</a>
        </div>
      </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('admin.shop') }}
    </div>

    <!-- Categories -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categoryCollapse" aria-expanded="true" aria-controls="categoryCollapse">
          <i class="fas fa-sitemap"></i>
          <span>{{ __('admin.categories') }}</span>
        </a>
        <div id="categoryCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">{{ __('admin.category_options') }}:</h6>
            <a class="collapse-item" href="{{route('category.index')}}">{{ __('admin.categories') }}</a>
            <a class="collapse-item" href="{{route('category.create')}}">{{ __('admin.add_category') }}</a>
          </div>
        </div>
    </li>

    <!-- Products -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#productCollapse" aria-expanded="true" aria-controls="productCollapse">
          <i class="fas fa-cubes"></i>
          <span>{{ __('admin.products') }}</span>
        </a>
        <div id="productCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">{{ __('admin.product_options') }}:</h6>
            <a class="collapse-item" href="{{route('product.index')}}">{{ __('admin.products') }}</a>
            <a class="collapse-item" href="{{route('product.create')}}">{{ __('admin.add_product') }}</a>
          </div>
        </div>
    </li>

    <!-- Brands -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#brandCollapse" aria-expanded="true" aria-controls="brandCollapse">
          <i class="fas fa-table"></i>
          <span>{{ __('admin.brands') }}</span>
        </a>
        <div id="brandCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">{{ __('admin.brand_options') }}:</h6>
            <a class="collapse-item" href="{{route('brand.index')}}">{{ __('admin.brands') }}</a>
            <a class="collapse-item" href="{{route('brand.create')}}">{{ __('admin.add_brand') }}</a>
          </div>
        </div>
    </li>

    <!-- Shipping -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#shippingCollapse" aria-expanded="true" aria-controls="shippingCollapse">
          <i class="fas fa-truck"></i>
          <span>{{ __('admin.shipping') }}</span>
        </a>
        <div id="shippingCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">{{ __('admin.shipping_options') }}:</h6>
            <a class="collapse-item" href="{{route('shipping.index')}}">{{ __('admin.shipping') }}</a>
            <a class="collapse-item" href="{{route('shipping.create')}}">{{ __('admin.add_shipping') }}</a>
          </div>
        </div>
    </li>

    <!-- Orders -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('order.index')}}">
            <i class="fas fa-hammer fa-chart-area"></i>
            <span>{{ __('admin.orders') }}</span>
        </a>
    </li>

    <!-- Reviews -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('review.index')}}">
            <i class="fas fa-comments"></i>
            <span>{{ __('admin.reviews') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      {{ __('admin.posts') }}
    </div>

    <!-- Posts -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#postCollapse" aria-expanded="true" aria-controls="postCollapse">
        <i class="fas fa-fw fa-folder"></i>
        <span>{{ __('admin.posts') }}</span>
      </a>
      <div id="postCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">{{ __('admin.post_options') }}:</h6>
          <a class="collapse-item" href="{{route('post.index')}}">{{ __('admin.posts') }}</a>
          <a class="collapse-item" href="{{route('post.create')}}">{{ __('admin.add_post') }}</a>
        </div>
      </div>
    </li>

     <!-- Category -->
     <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#postCategoryCollapse" aria-expanded="true" aria-controls="postCategoryCollapse">
          <i class="fas fa-sitemap fa-folder"></i>
          <span>{{ __('admin.category') }}</span>
        </a>
        <div id="postCategoryCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">{{ __('admin.category_options') }}:</h6>
            <a class="collapse-item" href="{{route('post-category.index')}}">{{ __('admin.categories') }}</a>
            <a class="collapse-item" href="{{route('post-category.create')}}">{{ __('admin.add_category') }}</a>
          </div>
        </div>
      </li>

      <!-- Tags -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tagCollapse" aria-expanded="true" aria-controls="tagCollapse">
            <i class="fas fa-tags fa-folder"></i>
            <span>{{ __('admin.tags') }}</span>
        </a>
        <div id="tagCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">{{ __('admin.tag_options') }}:</h6>
            <a class="collapse-item" href="{{route('post-tag.index')}}">{{ __('admin.tags') }}</a>
            <a class="collapse-item" href="{{route('post-tag.create')}}">{{ __('admin.add_tag') }}</a>
            </div>
        </div>
    </li>

      <!-- Comments -->
      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#commentCollapse" aria-expanded="true" aria-controls="commentCollapse">
              <i class="fas fa-comments fa-folder"></i>
              <span>{{ __('admin.comments') }}</span>
          </a>
          <div id="commentCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">{{ __('admin.comment_options') }}:</h6>
              <a class="collapse-item" href="{{route('comment.index')}}">{{ __('admin.comments') }}</a>
              </div>
          </div>
      </li>

</ul>
<style>


</style>