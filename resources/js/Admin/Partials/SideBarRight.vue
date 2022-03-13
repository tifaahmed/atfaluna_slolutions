<template>

    <div>
        <!-- main-sidebar -->
        <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
        <aside class="app-sidebar sidebar-scroll">
            <div class="main-sidebar-header active" style="padding: 0;">
                <a class="desktop-logo logo-light active" href="#"><img :src="'/images/logo.png'" class="main-logo" alt="logo" style="height: 60px;"></a>
                <a class="desktop-logo logo-dark active" href="#"><img :src="'/images/logo.png'" class="main-logo dark-theme" alt="logo" style="height: 60px;"></a>
                <a class="logo-icon mobile-logo icon-light active" href="#"><img :src="'/images/logo.png'" class="logo-icon" alt="logo" style="height: 60px;"></a>
                <a class="logo-icon mobile-logo icon-dark active" href="#"><img :src="'/images/logo.png'" class="logo-icon dark-theme" alt="logo" style="height: 60px;" ></a>
            </div>
            <div class="main-sidemenu">
                <div class="app-sidebar__user clearfix">
                    <div class="dropdown user-pro-body">
                        <div class="">
                            <img alt="user-img" class="avatar avatar-xl brround" :src="User.avatar">
                        </div>
                        <div class="user-info">
                            <h4 class="font-weight-semibold mt-3 mb-0">atfaluna</h4>
                            <span class="mb-0 text-muted">{{User.name}} </span>
                        </div>
                    </div>
                </div>
                <ul class="side-menu">
                    <li class="slide">
                        <router-link class="side-menu__item" data-toggle="slide" :to = "{ name : 'User.ShowAll' }">
                            <svg   class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
                                <path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
                            </svg>
                            <span class="side-menu__label">User</span>
                        </router-link>
                    </li>
                </ul>
                <ul class="side-menu">
                    <li class="slide">
                        <router-link class="side-menu__item" data-toggle="slide" :to = "{ name : 'SubUser.ShowAll' }">
                            <svg   class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
                                <path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
                            </svg>
                            <span class="side-menu__label">Children</span>
                        </router-link>
                    </li>
                </ul>
                <ul class="side-menu">
                    <li class="slide">
                        <router-link class="side-menu__item" data-toggle="slide" :to = "{ name : 'Avatar.ShowAll' }">
                            <svg   class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
                                <path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
                            </svg>
                            <span class="side-menu__label">Avatar</span>
                        </router-link>
                    </li>
                </ul>

                <ul class="side-menu">
                    <li class="slide">
                        <router-link class="side-menu__item" data-toggle="slide" :to = "{ name : 'Role.ShowAll' }">
                            <svg  class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
                                <path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
                            </svg>
                            <span class="side-menu__label">Roles</span>
                        </router-link>
                    </li>
                </ul>

                <ul class="side-menu">
                    <li class="slide">
                        <router-link class="side-menu__item" data-toggle="slide" :to = "{ name : 'Language.ShowAll' }">
                            <svg  class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
                                <path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
                            </svg>
                            <span class="side-menu__label">Languages</span>
                        </router-link>
                    </li>
                </ul>
                <ul class="side-menu">
                    <li class="slide">
                        <router-link class="side-menu__item" data-toggle="slide" :to = "{ name : 'Store.ShowAll' }">
                            <svg  class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
                                <path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
                            </svg>
                            <span class="side-menu__label">Stores</span>
                        </router-link>
                    </li>
                </ul>
                <ul class="side-menu">
                    <li class="slide">
                        <router-link class="side-menu__item" data-toggle="slide" :to = "{ name : 'Subscription.ShowAll' }">
                            <svg  class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
                                <path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
                            </svg>
                            <span class="side-menu__label">Subscriptions</span>
                        </router-link>
                    </li>
                </ul>
                <ul class="side-menu">
                    <li class="slide">
                        <router-link class="side-menu__item" data-toggle="slide" :to = "{ name : 'Accessory.ShowAll' }">
                            <svg  class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
                                <path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
                            </svg>
                            <span class="side-menu__label">Accessories</span>
                        </router-link>
                    </li>
                </ul>
                <ul class="side-menu">
                    <li class="slide">
                        <router-link class="side-menu__item" data-toggle="slide" :to = "{ name : 'AgeGroup.ShowAll' }">
                            <svg  class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
                                <path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
                            </svg>
                            <span class="side-menu__label">AgeGroup</span>
                        </router-link>
                    </li>
                </ul>
                <ul class="side-menu">
                    <li class="slide">
                        <router-link class="side-menu__item" data-toggle="slide" :to = "{ name : 'Age.ShowAll' }">
                            <svg  class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
                                <path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
                            </svg>
                            <span class="side-menu__label">Age</span>
                        </router-link>
                    </li>
                </ul>

                  <ul class="side-menu">
                    <li class="slide">
                        <router-link class="side-menu__item" data-toggle="slide" :to = "{ name : 'Subject.ShowAll' }">
                            <svg  class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
                                <path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
                            </svg>
                            <span class="side-menu__label">Subject</span>
                        </router-link>
                    </li>
                </ul>

            <ul class="side-menu">
                    <li class="slide">
                        <router-link class="side-menu__item" data-toggle="slide" :to = "{ name : 'SubSubject.ShowAll' }">
                            <svg  class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
                                <path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
                            </svg>
                            <span class="side-menu__label">Sub Subject</span>
                        </router-link>
                    </li>
                </ul>


                  <ul class="side-menu">
                    <li class="slide">
                        <router-link class="side-menu__item" data-toggle="slide" :to = "{ name : 'Quiz.ShowAll' }">
                            <svg  class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
                                <path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
                            </svg>
                            <span class="side-menu__label">Quiz</span>
                        </router-link>
                    </li>
        </ul>

                <ul class="side-menu">
                    <li class="slide">
                        <router-link class="side-menu__item" data-toggle="slide" :to = "{ name : 'Country.ShowAll' }">
                            <svg  class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
                                <path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
                            </svg>
                            <span class="side-menu__label">Countries</span>
                        </router-link>
                    </li>
                </ul>
            </div>
        </aside>
    </div>
</template>
<!-- main-sidebar -->

<script>
import jwt   from './../../Services/jwt' ;
// jwt.User
    export default {

        mounted() {
            console.log( 'side_bar_right ' )
            console.log( jwt.User )
        },
        data( ) { return {
            User :jwt.User ,
            logo: ''

        } } ,

        
    }
</script>