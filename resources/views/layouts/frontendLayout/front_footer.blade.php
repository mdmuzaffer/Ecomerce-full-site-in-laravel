<footer id="footer"><!--Footer-->
	<div class="footer-top">
		<div class="container">
			<div class="row">
				<div class="col-sm-2">
					<div class="companyinfo">
						<h2><span>e</span>-shopper</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
					</div>
				</div>
				<div class="col-sm-7">
					<div class="col-sm-3">
						<div class="video-gallery text-center">
							<a href="#">
								<div class="iframe-img">
									<img src="{{asset('frontend/images/home/iframe1.png')}}" alt="" />
								</div>
								<div class="overlay-icon">
									<i class="fa fa-play-circle-o"></i>
								</div>
							</a>
							<p>Circle of Hands</p>
							<h2>24 DEC 2014</h2>
						</div>
					</div>
					
					<div class="col-sm-3">
						<div class="video-gallery text-center">
							<a href="#">
								<div class="iframe-img">
									<img src="{{asset('frontend/images/home/iframe2.png')}}" alt="" />
								</div>
								<div class="overlay-icon">
									<i class="fa fa-play-circle-o"></i>
								</div>
							</a>
							<p>Circle of Hands</p>
							<h2>24 DEC 2014</h2>
						</div>
					</div>
					
					<div class="col-sm-3">
						<div class="video-gallery text-center">
							<a href="#">
								<div class="iframe-img">
									<img src="{{asset('frontend/images/home/iframe3.png')}}" alt="" />
								</div>
								<div class="overlay-icon">
									<i class="fa fa-play-circle-o"></i>
								</div>
							</a>
							<p>Circle of Hands</p>
							<h2>24 DEC 2014</h2>
						</div>
					</div>
					
					<div class="col-sm-3">
						<div class="video-gallery text-center">
							<a href="#">
								<div class="iframe-img">
									<img src="{{asset('frontend/images/home/iframe4.png')}}" alt="" />
								</div>
								<div class="overlay-icon">
									<i class="fa fa-play-circle-o"></i>
								</div>
							</a>
							<p>Circle of Hands</p>
							<h2>24 DEC 2014</h2>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="address">
						<img src="{{asset('frontend/images/home/map.png')}}" alt="" />
						<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="footer-widget">
		<div class="container">
			<div class="row">
				<div class="col-sm-2">
					<div class="single-widget">
						<h2>Service</h2>
						<ul class="nav nav-pills nav-stacked">
							<li><a href="{{url('page/online-help')}}">Online Help</a></li>
							<li><a href="{{url('pages/contact-us')}}">Contact Us</a></li>
							<li><a href="{{url('page/about-us')}}">Abou Us</a></li>
							<li><a href="{{url('page/order-status')}}">Order Status</a></li>
							<li><a href="{{url('page/faq')}}">FAQ’s</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="single-widget">
						<h2>Quock Shop</h2>
						<ul class="nav nav-pills nav-stacked">
							<li><a href="#">T-Shirt</a></li>
							<li><a href="#">Mens</a></li>
							<li><a href="#">Womens</a></li>
							<li><a href="#">Gift Cards</a></li>
							<li><a href="#">Shoes</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="single-widget">
						<h2>Policies</h2>
						<ul class="nav nav-pills nav-stacked">
							<li><a href="{{url('page/term-condition')}}">Terms & condition</a></li>
							<li><a href="{{url('page/privecy-policy')}}">Privecy Policy</a></li>
							<li><a href="{{url('page/refund-policy')}}">Refund Policy</a></li>
							<li><a href="{{url('page/billing-system')}}">Billing System</a></li>
							<li><a href="{{url('page/ticket-system')}}">Ticket System</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="single-widget">
						<h2>About Shopper</h2>
						<ul class="nav nav-pills nav-stacked">
							<li><a href="{{url('page/company-information')}}">Company Information</a></li>
							<li><a href="{{url('page/careers')}}">Careers</a></li>
							<li><a href="{{url('page/store-location')}}">Store Location</a></li>
							<li><a href="{{url('page/affillate-program')}}">Affillate Program</a></li>
							<li><a href="{{url('page/copyright')}}">Copyright</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-3 col-sm-offset-1">
					<div class="single-widget">
						<h2>Our Newsletter</h2>
						<form action="javascript:void(0);" class="searchform" method="post">
						{{ csrf_field() }}
							<input style="color:#000" type="email" placeholder="Your email address" name="neswletter" id="neswletter"/>
							<button type="submit" class="btn btn-default" id="newsletterForm"><i class="fa fa-arrow-circle-o-right"></i></button>
							<br><div id="newsletterMsg"></div>
							<p>Get the most recent updates from <br />our site and be updated your self...</p>
						</form>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
				<p class="pull-right">Designed and develop by <span><a target="_blank" href="http://www.themeum.com">Muzaffer</a></span></p>
			</div>
		</div>
	</div>
	
</footer><!--/Footer-->