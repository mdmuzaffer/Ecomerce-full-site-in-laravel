<aside class="left-sidebar" data-sidebarbg="skin5">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav" class="p-t-30">
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('/admin/dashboard')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
				
				<!--category module start-->
				@if(Session::get('adminDetail')->categories_access ==1)
				<li class="sidebar-item"><a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Category</span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="{{url('admin/category')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Add Category</span></a></li>
						<li class="sidebar-item"><a href="{{url('/admin/view-category')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu">View Category</span></a></li>
					</ul>
				</li>
				@endif
				<!--category module end -->
				
				<!--Products module start -->
				@if(Session::get('adminDetail')->products_access ==1)
				<li class="sidebar-item"><a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-product-hunt"></i><span class="hide-menu">Products</span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="{{url('/admin/add-products')}}" class="sidebar-link"><i class="fa fa-amazon"></i><span class="hide-menu">Add Products</span></a></li>
						<li class="sidebar-item"><a href="{{url('/admin/view-products')}}" class="sidebar-link"><i class="fa fa-apple"></i><span class="hide-menu">View Products</span></a></li>
					</ul>
				</li>
				@endif
				<!--Products module  end-->
				
				<!--Order module start-->
				@if(Session::get('adminDetail')->orders_access ==1)
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-first-order"></i><span class="hide-menu">Order</span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="{{url('/admin/order-view')}}" class="sidebar-link"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="hide-menu">All Order</span></a></li>
						<li class="sidebar-item"><a href="{{url('/admin/order-view-chart')}}" class="sidebar-link"><i class="fas fa-chart-line" aria-hidden="true"></i><span class="hide-menu">Order Chart</span></a></li>
					</ul>
				</li>
				@endif
				<!--Order module end -->
				
				<!--Admin module start-->
				@if(Session::get('adminDetail')->users_access ==1)
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Admin</span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="{{url('admin/add-admin')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Admin /Sub-admin</span></a></li>
						<li class="sidebar-item"><a href="{{url('admin/admin-view')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> View Admin/Sub-admin </span></a></li>
					</ul>
				</li>
				@endif
				<!--Admin module end-->
				
				<!--Coupon module  start-->
				@if(Session::get('adminDetail')->categories_access ==1 && Session::get('adminDetail')->products_access ==1 && Session::get('adminDetail')->orders_access ==1 && Session::get('adminDetail')->users_access ==1)
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-bullhorn" aria-hidden="true"></i><span class="hide-menu">Coupon</span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="{{url('admin/add_coupon')}}" class="sidebar-link"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i><span class="hide-menu"> Add Coupon</span></a></li>
						<li class="sidebar-item"><a href="{{url('admin/view-coupons/')}}" class="sidebar-link"><i class="fa fa-cog fa-spin fa-3x fa-fw"></i><span class="hide-menu">View Coupon</span></a></li>
					</ul>
				</li>
				<!--Coupon module end-->
				
				<!--Users module start-->
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Users</span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="{{url('/admin/user-view')}}" class="sidebar-link"><i class="fa fa-user"></i><span class="hide-menu">All Users</span></a></li>
						<li class="sidebar-item"><a href="{{url('/admin/user-view-chart')}}" class="sidebar-link"><i class="fas fa-chart-line"></i><span class="hide-menu">Users Chart</span></a></li>
						<li class="sidebar-item"><a href="{{url('/admin/user-view-country')}}" class="sidebar-link"><i class="fa fa-fighter-jet" aria-hidden="true"></i><span class="hide-menu">Country Chart</span></a></li>
					</ul>
				</li>
				<!--Users module end-->
				
				<!--Banner module start-->
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-pencil"></i><span class="hide-menu">Banner</span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="{{url('admin/banner-add')}}" class="sidebar-link"><i class="fab fa-pagelines"></i><span class="hide-menu">Add Banner</span></a></li>
						<li class="sidebar-item"><a href="{{url('admin/banner-edit')}}" class="sidebar-link"><i class="fas fa-tree"></i><span class="hide-menu">View Banner</span></a></li>
					</ul>
				</li>
				<!--Banner module end-->
				
				<!--CMS Page module start-->
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">CMS Page</span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="{{url('/admin/cms-page')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Add CMS Page</span></a></li>
						<li class="sidebar-item"><a href="{{url('/admin/view-cms-page')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu">View CMS Page</span></a></li>
					</ul>
				</li>
				<!--CMS Page module end-->
				
				<!--Currency module  start-->
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-money" aria-hidden="true"></i><span class="hide-menu">Currency</span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="{{url('/admin/add-currency')}}" class="sidebar-link"><i class="fa fa-dollar"></i><span class="hide-menu">Add Currency</span></a></li>
						<li class="sidebar-item"><a href="{{url('/admin/view-currency')}}" class="sidebar-link"><i class="fa fa-inr"></i></i><span class="hide-menu">View Currency</span></a></li>
					</ul>
				</li>
				<!--Currency module end -->
				
				<!--Shipping module  start-->
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-shipping-fast"></i></i><span class="hide-menu">Shipping</span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="{{url('/admin/shipping')}}" class="sidebar-link"><i class="fas fa-percent"></i><span class="hide-menu">Shipping Charge</span></a></li>
					</ul>
				</li>
				<!--Shipping module end-->
				
								
				<!--News letter module  start-->
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-envelope"></i></i><span class="hide-menu">News letter</span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="{{url('admin/news-letter')}}" class="sidebar-link"><i class="fas fa-arrow-right"></i><span class="hide-menu">News view</span></a></li>
					</ul>
				</li>
				<!--News letter module end-->
				
				@endif
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Forms </span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="{{url('#')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Form Basic </span></a></li>
						<li class="sidebar-item"><a href="{{url('#')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Form Wizard </span></a></li>
					</ul>
				</li>

			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>