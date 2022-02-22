<template>
    <div>        
       
       <header class="site__header d-lg-none">
           <!-- data-sticky-mode - one of [pullToShow, alwaysOnTop] -->
           <div class="mobile-header mobile-header--sticky" data-sticky-mode="pullToShow">
               <div class="mobile-header__panel">
                   <div class="container">
                       <div class="mobile-header__body">
                           <button class="mobile-header__menu-button">
                               <svg width="18px" height="14px">
                                   <use xlink:href="images/sprite.svg#menu-18x14"></use>
                               </svg>
                           </button>
                           <a class="mobile-header__logo" href="index.html" style="margin: 0;    margin-left: 10px;">
                               <!-- mobile-logo -->
                               <svg xmlns="http://www.w3.org/2000/svg" width="120px" height="20px">
                                   <img  src="asset/img/logo_mob.jpg" style="    width: 200px; margin-top: -20px;margin-right: 10px;">
                               </svg>
                               <!-- mobile-logo / end -->
                           </a>
                           <div class="search search--location--mobile-header mobile-header__search">
                               <div class="search__body">
                                   <form class="search__form" action="">
                                       <input class="search__input" name="search" placeholder="Search over 10,000 products" aria-label="Site search" type="text" autocomplete="off">
                                       <button class="search__button search__button--type--submit" type="submit">
                                           <svg width="20px" height="20px">
                                               <use xlink:href="images/sprite.svg#search-20"></use>
                                           </svg>
                                       </button>
                                       <button class="search__button search__button--type--close" type="button">
                                           <svg width="20px" height="20px">
                                               <use xlink:href="images/sprite.svg#cross-20"></use>
                                           </svg>
                                       </button>
                                       <div class="search__border"></div>
                                   </form>
                                   <div class="search__suggestions suggestions suggestions--location--mobile-header"></div>
                               </div>
                           </div>
                           <div class="mobile-header__indicators">
                               <div class="indicator indicator--mobile-search indicator--mobile d-md-none">
                                   <button class="indicator__button">
                                       <span class="indicator__area">
                                           <svg width="20px" height="20px">
                                               <use xlink:href="images/sprite.svg#search-20"></use>
                                           </svg>
                                       </span>
                                   </button>
                               </div>
                               <div class="indicator indicator--mobile d-sm-flex d-none">
                                   <a href="wish_list.php" class="indicator__button">
                                       <span class="indicator__area">
                                           <svg width="20px" height="20px">
                                               <use xlink:href="images/sprite.svg#heart-20"></use>
                                           </svg>
                                           <span class="indicator__value">0</span>
                                       </span>
                                   </a>
                               </div>
                               <div class="indicator indicator--mobile">
                                   <a href="cart.html" class="indicator__button">
                                       <span class="indicator__area">
                                           <svg width="20px" height="20px">
                                               <use xlink:href="images/sprite.svg#cart-20"></use>
                                           </svg>
                                           <span class="indicator__value">3</span>
                                       </span>
                                   </a>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </header>
       <!-- mobile site__header / end -->

























       <!-- desktop site__header -->
       <header class="site__header d-lg-block d-none">
           <div class="site-header">
               <!-- .topbar -->
               <div class="site-header__topbar topbar">
                   <div class="topbar__container container">
                       <div class="topbar__row">
                           <div class="topbar__item topbar__item--link">
                               <a class="topbar-link" href="about.php">About Us</a>
                           </div>
                           <div class="topbar__item topbar__item--link">
                               <a class="topbar-link" href="track-order.php">Track Order</a>
                           </div>
                           <div class="topbar__item topbar__item--link">
                               <a class="topbar-link" href="questions.php">privesy policy</a>
                           </div>
                           <div class="topbar__item topbar__item--link">
                               <a class="topbar-link" href="terms_and_conditions.php">Terms And Conditions</a>
                           </div>
                           <div class="topbar__item topbar__item--link">
                               <a class="topbar-link" href="questions.php">common questions </a>
                           </div>
                           <div class="topbar__item topbar__item--link">
                               <a class="topbar-link" href="visitor_questions.php">visitor questions </a>
                           </div>
                       </div>
                   </div>
               </div>
               <!-- .topbar / end -->
               <div class="site-header__middle container">
                   <div class="site-header__logo">
                       <a href="index.html">
                           <!-- logo -->
                           <svg xmlns="http://www.w3.org/2000/svg" width="196px" height="26px">
                                   <img  src="asset/img/logo_gif2.gif" style="    width: 227px;height: 93px;margin-top: -12px;"  >
                           </svg>
                           <!-- logo / end -->
                       </a>
                   </div>
                   <div class="site-header__search">
                       <div class="search search--location--header ">
                           <div class="search__body">
                               <form class="search__form" action="">
                                   <select class="search__categories" aria-label="Category">
                                       <option value="all">All Categories</option>
                                       <option>category</option>
                                       <option>category</option>
                                       <option>category</option>
                                       <option>category</option>

                                   </select>
                                   <input class="search__input" name="search" placeholder="Search over 10,000 products" aria-label="Site search" type="text" autocomplete="off">
                                   <button class="search__button search__button--type--submit" type="submit">
                                       <svg width="20px" height="20px">
                                           <use xlink:href="images/sprite.svg#search-20"></use>
                                       </svg>
                                   </button>
                                   <div class="search__border"></div>
                               </form>
                               <div class="search__suggestions suggestions suggestions--location--header"></div>
                           </div>
                       </div>
                   </div>
                   <div class="site-header__phone">
                       <div class="site-header__phone-title">Customer Service</div>
                       <div class="site-header__phone-number">(800) 060-0730</div>
                   </div>
               </div>
               <div class="site-header__nav-panel">
                   <!-- data-sticky-mode - one of [pullToShow, alwaysOnTop] -->
                   <div class="nav-panel nav-panel--sticky" data-sticky-mode="pullToShow">
                       <div class="nav-panel__container container">
                           <div class="nav-panel__row">
                               <div class="nav-panel__departments">
                                   <!-- .departments -->

                                   <!-- .departments / end -->
                               </div>
                               <!-- .nav-links -->
                               <div class="nav-panel__nav-links nav-links">
                                   <ul class="nav-links__list">
                                       <li class="nav-links__item ">
                                           <a class="nav-links__item-link" href="contact-us.php">
                                               <div class="nav-links__item-body">
                                                  Contact Us
                                               </div>
                                           </a>
                                       </li>
                                       <li class="nav-links__item  nav-links__item--has-submenu ">
                                           <a class="nav-links__item-link" href="contest.php">
                                               <div class="nav-links__item-body">
                                                   contests
                                                   <svg class="nav-links__item-arrow" width="9px" height="6px">
                                                       <use xlink:href="images/sprite.svg#arrow-rounded-down-9x6"></use>
                                                   </svg>
                                               </div>
                                           </a>
                                           <div class="nav-links__submenu nav-links__submenu--type--menu">
                                               <!-- .menu -->
                                               <div class="menu menu--layout--classic ">
                                                   <div class="menu__submenus-container"></div>
                                                   <ul class="menu__list">
                                                       <li class="menu__item">
                                                           <!-- This is a synthetic element that allows to adjust the vertical offset of the submenu using CSS. -->
                                                           <div class="menu__item-submenu-offset"></div>
                                                           <a class="menu__item-link" href="about-us.html">
                                                              bla
                                                           </a>
                                                       </li>
                                                   </ul>
                                               </div>
                                               <!-- .menu / end -->
                                           </div>
                                       </li>


                                       <li class="nav-links__item  nav-links__item--has-submenu ">
                                           <a class="nav-links__item-link" href="blog.php">
                                               <div class="nav-links__item-body">
                                                   news
                                                   <svg class="nav-links__item-arrow" width="9px" height="6px">
                                                       <use xlink:href="images/sprite.svg#arrow-rounded-down-9x6"></use>
                                                   </svg>
                                               </div>
                                           </a>
                                           <div class="nav-links__submenu nav-links__submenu--type--menu">
                                               <!-- .menu -->
                                               <div class="menu menu--layout--classic ">
                                                   <div class="menu__submenus-container"></div>
                                                   <ul class="menu__list">
                                                       <li class="menu__item">
                                                           <!-- This is a synthetic element that allows to adjust the vertical offset of the submenu using CSS. -->
                                                           <div class="menu__item-submenu-offset"></div>
                                                           <a class="menu__item-link" href="blog-classic.html">
                                                              bla
                                                           </a>
                                                       </li>
                                                   </ul>
                                               </div>
                                               <!-- .menu / end -->
                                           </div>
                                       </li>

                                       <li class="nav-links__item  nav-links__item--has-submenu ">
                                        <router-link style="color:#fff" :to = "{ name : 'Shop'  }" > 

                                           <a class="nav-links__item-link" href="">
                                               <div class="nav-links__item-body">
                                                   Shop
                                                   <svg class="nav-links__item-arrow" width="9px" height="6px">
                                                       <use xlink:href="images/sprite.svg#arrow-rounded-down-9x6"></use>
                                                   </svg>
                                               </div>
                                           </a>
                                        </router-link>

                                           <div class="nav-links__submenu nav-links__submenu--type--menu">
                                               <!-- .menu -->
                                               <div class="menu menu--layout--classic ">
                                                   <div class="menu__submenus-container"></div>
                                                   <ul class="menu__list">
                                                       <li class="menu__item">
                                                           <!-- This is a synthetic element that allows to adjust the vertical offset of the submenu using CSS. -->
                                                           <div class="menu__item-submenu-offset"></div>
                                                           <a class="menu__item-link" href="shop-grid-3-columns-sidebar.html">
                                                               bla bla
                                                               <svg class="menu__item-arrow" width="6px" height="9px">
                                                                   <use xlink:href="images/sprite.svg#arrow-rounded-right-6x9"></use>
                                                               </svg>
                                                           </a>
                                                           <div class="menu__submenu">
                                                               <!-- .menu -->
                                                               <div class="menu menu--layout--classic ">
                                                                   <div class="menu__submenus-container"></div>
                                                                   <ul class="menu__list">
                                                                       <li class="menu__item">
                                                                           <!-- This is a synthetic element that allows to adjust the vertical offset of the submenu using CSS. -->
                                                                           <div class="menu__item-submenu-offset"></div>
                                                                           <a class="menu__item-link" href="shop-grid-3-columns-sidebar.html">
                                                                              bla
                                                                           </a>
                                                                       </li>
                                                                   </ul>
                                                               </div>
                                                               <!-- .menu / end -->
                                                           </div>
                                                       </li>
                                                   </ul>
                                               </div>
                                               <!-- .menu / end -->
                                           </div>
                                       </li>
                                       <li class="nav-links__item  nav-links__item--has-submenu ">
                                        <router-link style="color:#fff" :to = "{ name : 'Home'  }" > 
                                           <a class="nav-links__item-link" href="">
                                               <div class="nav-links__item-body">
                                                   Home
                                                    
                                               </div>
                                           </a>
                                        </router-link>
                                       </li>
                                   </ul>
                               </div>
                               <!-- .nav-links / end -->
                               <div class="nav-panel__indicators">
                                   <div class="indicator">
                                       <a href="compare.php" class="indicator__button">
                                           <span class="indicator__area">
                                               <svg width="20px" height="20px">
                                                   <use xlink:href="images/sprite.svg#compare-16"></use>
                                               </svg>
                                               <span class="indicator__value">0</span>
                                           </span>
                                       </a>
                                   </div>

                                   <div class="indicator">
                                       <a href="wish_list.php" class="indicator__button">
                                           <span class="indicator__area">
                                               <svg width="20px" height="20px">
                                                   <use xlink:href="images/sprite.svg#heart-20"></use>
                                               </svg>
                                               <span class="indicator__value">0</span>
                                           </span>
                                       </a>
                                   </div>

                                   <div class="indicator indicator--trigger--click">
                                       <a href="cart.html" class="indicator__button">
                                           <span class="indicator__area">
                                               <svg width="20px" height="20px">
                                                   <use xlink:href="images/sprite.svg#cart-20"></use>
                                               </svg>
                                               <span class="indicator__value">3</span>
                                           </span>
                                       </a>
                                       <div class="indicator__dropdown">
                                           <!-- .dropcart -->
                                           <div class="dropcart dropcart--style--dropdown">
                                               <div class="dropcart__body">
                                                   <div class="dropcart__products-list">
                                                       <!--  -->
                                                       <div class="dropcart__product">
                                                           <div class="product-image dropcart__product-image">
                                                               <a href="product_details.php" class="product-image__body">
                                                                   <img class="product-image__img" src="images/products/product-1.jpg" alt="">
                                                               </a>
                                                           </div>
                                                           <div class="dropcart__product-info">
                                                               <div class="dropcart__product-name"><a href="product_details.php">Electric Planer Brandix KL370090G 300 Watts</a></div>
                                                               <ul class="dropcart__product-options">
                                                                   <li>Color: Yellow</li>
                                                                   <li>Material: Aluminium</li>
                                                               </ul>
                                                               <div class="dropcart__product-meta">
                                                                   <span class="dropcart__product-quantity">2</span> ×
                                                                   <span class="dropcart__product-price">$699.00</span>
                                                               </div>
                                                           </div>
                                                           <button type="button" class="dropcart__product-remove btn btn-light btn-sm btn-svg-icon">
                                                               <svg width="10px" height="10px">
                                                                   <use xlink:href="images/sprite.svg#cross-10"></use>
                                                               </svg>
                                                           </button>
                                                       </div>
                                                       <!--  -->
                                                   </div>
                                                   <div class="dropcart__totals">
                                                       <table>
                                                           <tr>
                                                               <th>Subtotal</th>
                                                               <td>$5,877.00</td>
                                                           </tr>
                                                           <tr>
                                                               <th>Shipping</th>
                                                               <td>$25.00 ~ $25.00</td>
                                                           </tr>
                                                           <tr>
                                                               <th>Total</th>
                                                               <td>$5,902.00</td>
                                                           </tr>
                                                       </table>
                                                   </div>
                                                   <div class="dropcart__buttons">
                                                       <a class="btn btn-secondary" href="cart.php">View Cart</a>
                                                       <a class="btn btn-primary" href="checkout.php">Checkout</a>
                                                   </div>
                                               </div>
                                           </div>
                                           <!-- .dropcart / end -->
                                       </div>
                                   </div>
                                   <div class="indicator indicator--trigger--click">
                                       <a href="account-login.html" class="indicator__button">
                                           <span class="indicator__area">
                                               <svg width="20px" height="20px">
                                                   <use xlink:href="images/sprite.svg#person-20"></use>
                                               </svg>
                                           </span>
                                       </a>
                                       <div class="indicator__dropdown">
                                           <div class="account-menu">
                                               <form class="account-menu__form">
                                                   <div class="account-menu__form-title">Log In to Your Account</div>
                                                   <div class="form-group">
                                                       <label for="header-signin-email" class="sr-only">Email address</label>
                                                       <input id="header-signin-email" type="email" class="form-control form-control-sm" placeholder="Email address">
                                                   </div>
                                                   <div class="form-group">
                                                       <label for="header-signin-password" class="sr-only">Password</label>
                                                       <div class="account-menu__form-forgot">
                                                           <input id="header-signin-password" type="password" class="form-control form-control-sm" placeholder="Password">
                                                           <a href="" class="account-menu__form-forgot-link">Forgot?</a>
                                                       </div>
                                                   </div>
                                                   <div class="form-group account-menu__form-button">
                                                       <button type="submit" class="btn btn-primary btn-sm">Login</button>
                                                   </div>
                                                   <div class="account-menu__form-link"><a href="account-login.html">Create An Account</a></div>
                                               </form>
                                               <div class="account-menu__divider"></div>
                                               <a href="acount_dashpord.php" class="account-menu__user">
                                                   <div class="account-menu__user-avatar">
                                                       <img src="images/avatars/avatar-3.jpg" alt="">
                                                   </div>
                                                   <div class="account-menu__user-info">
                                                       <div class="account-menu__user-name">Helena Garcia</div>
                                                       <div class="account-menu__user-email">stroyka@example.com</div>
                                                   </div>
                                               </a>
                                               <div class="account-menu__divider"></div>
                                               <ul class="account-menu__links">
                                                   <li><a href="account-profile.html">Edit Profile</a></li>
                                                   <li><a href="account-orders.html">Order History</a></li>
                                                   <li><a href="account-addresses.html">Addresses</a></li>
                                                   <li><a href="account-password.html">Password</a></li>
                                               </ul>
                                               <div class="account-menu__divider"></div>
                                               <ul class="account-menu__links">
                                                   <li><a href="account-login.html">Logout</a></li>
                                               </ul>
                                           </div>
                                       </div>
                                   </div>

                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </header>
 
    </div>
</template>