
<div class="left-side-bar">
			<div class="brand-logo">
				<a href="index.html">
					<img src="vendors/images/deskapp-logo.svg" alt="" class="dark-logo" />
					<img
						src="vendors/images/deskapp-logo-white.svg"
						alt=""
						class="light-logo"
					/>
				</a>
				<div class="close-sidebar" data-toggle="left-sidebar-close">
					<i class="ion-close-round"></i>
				</div>
			</div>
			<div class="menu-block customscroll">
				<div class="sidebar-menu">
					<ul id="accordion-menu">
						<li>
							<a href="{{url('welcome')}}" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-house"></span
								><span class="mtext">Dashboard</span>
							</a>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-gear-fill"></span
								><span class="mtext">Setting</span>
							</a>
							<ul class="submenu">
								<li><a href="{{url('setting/user-privilege')}}">User Privilege</a></li>
								<li><a href="{{url('setting/user')}}">User</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-table"></span
								><span class="mtext">Master Data</span>
							</a>
							<ul class="submenu">
								<li><a href="{{url('master/municipio')}}">Municipio</a></li>
								<li><a href="{{url('master/posto')}}">Posto</a></li>
								<li><a href="{{url('master/suco')}}">Suco</a></li>
								<li><a href="{{url('master/aldeia')}}">Aldeia</a></li>
								<li><a href="{{url('master/comm-activity-auth')}}">Commercial activity authorized</a></li>
								<li><a href="{{url('master/corporate')}}">Corporate</a></li>
								<li><a href="{{url('master/position')}}">Position</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-receipt-cutoff"></span
								><span class="mtext">Transaction</span>
							</a>
							<ul class="submenu">
								<li><a href="{{url('transaction/local-foreign-worker')}}">Local / Foreign Worker</a></li>
								<li><a href="{{url('transaction/supervision')}}">Supervision</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-files"></span
								><span class="mtext">Report</span>
							</a>
							<ul class="submenu">
								<li><a href="{{url('user')}}">---</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="mobile-menu-overlay"></div>