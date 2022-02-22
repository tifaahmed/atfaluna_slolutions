<template>
    <div class="main-header sticky side-header nav nav-item">
		<div class="container-fluid">
			<div class="main-header-left ">
				<div class="responsive-logo">
					<a href="index.html"><img src=" " class="logo-1" alt="logo"></a>
					<a href="index.html"><img src=" " class="dark-logo-1" alt="logo"></a>
					<a href="index.html"><img src=" " class="logo-2" alt="logo"></a>
					<a href="index.html"><img src=" " class="dark-logo-2" alt="logo"></a>
				</div>
				<div class="app-sidebar__toggle" data-toggle="sidebar">
					<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
					<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
				</div>
				<!-- <div class="main-header-center mr-3 d-sm-none d-md-none d-lg-block">
					<input class="form-control" placeholder="Search for anything..." type="search"> <button class="btn"><i class="fas fa-search d-none d-md-block"></i></button>
				</div> -->
			</div>
			<div class="main-header-right">
	
				<div class="nav nav-item  navbar-nav-right ml-auto">
					<div class="nav-link" id="bs-example-navbar-collapse-1">
						<form class="navbar-form" role="search">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Search">
								<span class="input-group-btn">
									<button type="reset" class="btn btn-default">
										<i class="fas fa-times"></i>
									</button>
									<button type="submit" class="btn btn-default nav-link resp-btn">
										
									</button>
								</span>
							</div>
						</form>
					</div>
					<!-- <div class="dropdown nav-item main-header-message ">
						<a class="new nav-link" href="#"><span class=" pulse-danger"></span></a>
						<div class="dropdown-menu">
							<div class="menu-header-content bg-primary text-right">
								<div class="d-flex">
									<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Messages</h6>
									<span class="badge badge-pill badge-warning mr-auto my-auto float-left">Mark All Read</span>
								</div>
								<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">You have 4 unread messages</p>
							</div>
							<div class="main-message-list chat-scroll">
								<a href="#" class="p-3 d-flex border-bottom">
									<div class="  drop-img  cover-image  " data-image-src=" ">
										<span class="avatar-status bg-teal"></span>
									</div>
									<div class="wd-90p">
										<div class="d-flex">
											<h5 class="mb-1 name">Petey Cruiser</h5>
										</div>
										<p class="mb-0 desc">I'm sorry but i'm not sure how to help you with that......</p>
										<p class="time mb-0 text-left float-right mr-2 mt-2">Mar 15 3:55 PM</p>
									</div>
								</a>
								<a href="#" class="p-3 d-flex border-bottom">
									<div class="drop-img cover-image" data-image-src=" ">
										<span class="avatar-status bg-teal"></span>
									</div>
									<div class="wd-90p">
										<div class="d-flex">
											<h5 class="mb-1 name">Jimmy Changa</h5>
										</div>
										<p class="mb-0 desc">All set ! Now, time to get to you now......</p>
										<p class="time mb-0 text-left float-right mr-2 mt-2">Mar 06 01:12 AM</p>
									</div>
								</a>
								<a href="#" class="p-3 d-flex border-bottom">
									<div class="drop-img cover-image" data-image-src=" ">
										<span class="avatar-status bg-teal"></span>
									</div>
									<div class="wd-90p">
										<div class="d-flex">
											<h5 class="mb-1 name">Graham Cracker</h5>
										</div>
										<p class="mb-0 desc">Are you ready to pickup your Delivery...</p>
										<p class="time mb-0 text-left float-right mr-2 mt-2">Feb 25 10:35 AM</p>
									</div>
								</a>
								<a href="#" class="p-3 d-flex border-bottom">
									<div class="drop-img cover-image" data-image-src=" ">
										<span class="avatar-status bg-teal"></span>
									</div>
									<div class="wd-90p">
										<div class="d-flex">
											<h5 class="mb-1 name">Donatella Nobatti</h5>
										</div>
										<p class="mb-0 desc">Here are some products ...</p>
										<p class="time mb-0 text-left float-right mr-2 mt-2">Feb 12 05:12 PM</p>
									</div>
								</a>
								<a href="#" class="p-3 d-flex border-bottom">
									<div class="drop-img cover-image" data-image-src=" ">
										<span class="avatar-status bg-teal"></span>
									</div>
									<div class="wd-90p">
										<div class="d-flex">
											<h5 class="mb-1 name">Anne Fibbiyon</h5>
										</div>
										<p class="mb-0 desc">I'm sorry but i'm not sure how...</p>
										<p class="time mb-0 text-left float-right mr-2 mt-2">Jan 29 03:16 PM</p>
									</div>
								</a>
							</div>
							<div class="text-center dropdown-footer">
								<a href="text-center">VIEW ALL</a>
							</div>
						</div>
					</div>
					<div class="dropdown nav-item main-header-notification">
						<a class="new nav-link" href="#">
						<span class=" pulse"></span></a>
						<div class="dropdown-menu">
							<div class="menu-header-content bg-primary text-right">
								<div class="d-flex">
									<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Notifications</h6>
									<span class="badge badge-pill badge-warning mr-auto my-auto float-left">Mark All Read</span>
								</div>
								<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">You have 4 unread Notifications</p>
							</div>
							<div class="main-notification-list Notification-scroll">
								<a class="d-flex p-3 border-bottom" href="#">
									<div class="notifyimg bg-pink">
										<i class="la la-file-alt text-white"></i>
									</div>
									<div class="mr-3">
										<h5 class="notification-label mb-1">New files available</h5>
										<div class="notification-subtext">10 hour ago</div>
									</div>
									<div class="mr-auto" >
										<i class="las la-angle-left text-left text-muted"></i>
									</div>
								</a>
								<a class="d-flex p-3" href="#">
									<div class="notifyimg bg-purple">
										<i class="la la-gem text-white"></i>
									</div>
									<div class="mr-3">
										<h5 class="notification-label mb-1">Updates Available</h5>
										<div class="notification-subtext">2 days ago</div>
									</div>
									<div class="mr-auto" >
										<i class="las la-angle-left text-left text-muted"></i>
									</div>
								</a>
								<a class="d-flex p-3 border-bottom" href="#">
									<div class="notifyimg bg-success">
										<i class="la la-shopping-basket text-white"></i>
									</div>
									<div class="mr-3">
										<h5 class="notification-label mb-1">New Order Received</h5>
										<div class="notification-subtext">1 hour ago</div>
									</div>
									<div class="mr-auto" >
										<i class="las la-angle-left text-left text-muted"></i>
									</div>
								</a>
								<a class="d-flex p-3 border-bottom" href="#">
									<div class="notifyimg bg-warning">
										<i class="la la-envelope-open text-white"></i>
									</div>
									<div class="mr-3">
										<h5 class="notification-label mb-1">New review received</h5>
										<div class="notification-subtext">1 day ago</div>
									</div>
									<div class="mr-auto" >
										<i class="las la-angle-left text-left text-muted"></i>
									</div>
								</a>
								<a class="d-flex p-3 border-bottom" href="#">
									<div class="notifyimg bg-danger">
										<i class="la la-user-check text-white"></i>
									</div>
									<div class="mr-3">
										<h5 class="notification-label mb-1">22 verified registrations</h5>
										<div class="notification-subtext">2 hour ago</div>
									</div>
									<div class="mr-auto" >
										<i class="las la-angle-left text-left text-muted"></i>
									</div>
								</a>
								<a class="d-flex p-3 border-bottom" href="#">
									<div class="notifyimg bg-primary">
										<i class="la la-check-circle text-white"></i>
									</div>
									<div class="mr-3">
										<h5 class="notification-label mb-1">Project has been approved</h5>
										<div class="notification-subtext">4 hour ago</div>
									</div>
									<div class="mr-auto" >
										<i class="las la-angle-left text-left text-muted"></i>
									</div>
								</a>
							</div>
							<div class="dropdown-footer">
								<a href="">VIEW ALL</a>
							</div>
						</div>
					</div> -->
					<div class="nav-item full-screen fullscreen-button">
						<a class="new nav-link full-screen-link" href="#">

                        </a>
					</div>
					<div class="dropdown main-profile-menu nav nav-item nav-link" :class="showMenu ? 'show' : ''">
						<a class="profile-user d-flex" @click="toggleShow()">
							<img alt="" src=" ">
						</a>
						<div class="dropdown-menu" style="">
							<div class="main-header-profile bg-primary p-3">
								<div class="d-flex wd-100p">
									<div class="main-img-user"><img alt="" src=" " class=""></div>
									<div class="mr-3 my-auto">
										<h6>Petey Cruiser</h6><span>Premium Member</span>
									</div>
								</div>
							</div>
							<a class="dropdown-item" href="profile.php"><i class="bx bx-user-circle"></i>Profile</a>
							<a class="dropdown-item" href="profile_edit.php"><i class="bx bx-cog"></i> Edit Profile</a>
							<!-- <a class="dropdown-item" href=""><i class="bx bxs-inbox"></i>Inbox</a> -->
							<!-- <a class="dropdown-item" href=""><i class="bx bx-envelope"></i>Messages</a> -->
							<!-- <a class="dropdown-item" href=""><i class="bx bx-slider-alt"></i> Account Settings</a> -->

							<!-- <router-link class="dropdown-item"  :to = "{ name : 'Auth.Login'  }"><i class="bx bx-log-out"></i> Sign Out</router-link> -->
							<a class="dropdown-item"   @click="logout()" href="#">
								<i class="bx bx-slider-alt"></i> 
								Sign Out
							</a>
                            <!-- <a class="dropdown-item" href="login.php"><i class="bx bx-log-out"></i> Sign Out</a> -->

						</div>
					</div>
					<div class="dropdown main-header-message right-toggle">
						<a class="nav-link pr-0" data-toggle="sidebar-left" data-target=".sidebar-left">

						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	import AuthModel     from 'AdminModels/Auth';
	import jwt   from 'MainServices/jwt' ;

    export default {
        mounted() {
            console.log( 'nav_bar ' )
        },
        data( ) { return {
            showMenu: false
        } } ,
          
        methods : {
        	toggleShow: function() {
				this.showMenu = !this.showMenu;
			},
        	async logout(){
        		let data = await (new AuthModel).logout();
        		this.$router.push({ name: 'Auth.Login' })
        		

        	}
        }

    }

    
</script>