<template>
       <div id="app-sidepanel" class="app-sidepanel" >
           
            <div id="sidepanel-drop" class="sidepanel-drop"></div>
            <div class="sidepanel-inner d-flex flex-column">
                <a
                    href="#"
                    id="sidepanel-close"
                    class="sidepanel-close d-xl-none"
                    >&times;</a
                >
                <div class="app-branding">
                    <a class="app-logo" href="#"
                        ><img
                            class="logo-icon me-2 mb-2"
                            src="assets/images/ddo_logo.png"
                            alt="logo"
                        /> 
                           

                        </a
                     >
                    
<p style="text-align:center; color:yellow; ">Accounting System</p>

                </div>
                <!--//app-branding-->

                       


                <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
                    <ul
                        class="app-menu list-unstyled accordion"
                        id="menu-accordion"
                    >
                        <li class="nav-item" >
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <router-link class="nav-link" active-class="active" to="/dashboard">
                                <span class="nav-icon">
                                    <svg
                                        width="1em"
                                        height="1em"
                                        viewBox="0 0 16 16"
                                        class="bi bi-house-door"
                                        fill="currentColor"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z"
                                        />
                                        <path
                                            fill-rule="evenodd"
                                            d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"
                                        />
                                    </svg>
                                </span>
                                <span class="nav-link-text">Overview</span> </router-link
                            ><!--//nav-link-->
                        </li>
                        <!--//nav-item-->
                         <!-- <li class="nav-item"> -->
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <!-- <router-link class="nav-link" active-class="active" to="/employees">
                                <span class="nav-icon">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                        <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                                        <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                                    </svg>
                                </span>
                            <span class="nav-link-text">Employees</span> </router-link>//nav-link -->
                            <!--//nav-link-->
                        <!-- </li> -->

                          <!-- <li class="nav-item"> -->
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <!-- <router-link class="nav-link" to="/#">
                                    <span class="nav-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                                        </svg>
                                    </span>
                                <span class="nav-link-text">Reports</span> </router-link> -->
                            <!--//nav-link-->
                               
                        <!-- </li>  -->

                        <li class="nav-item">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <router-link class="nav-link" to="/jevh">
                                <span class="nav-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark" viewBox="0 0 16 16">
                                        <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                                    </svg>
                                </span>
                                <span class="nav-link-text">Journal Entry Vouchers</span> </router-link>
                            <!--//nav-link-->
                        </li>
 
                        <!--//nav-item
                        <li class="nav-item has-submenu">
                            <//Bootstrap Icons: https://icons.getbootstrap.com/ 
                            <a
                                class="nav-link submenu-toggle"
                                href="#"
                                data-bs-toggle="collapse"
                                data-bs-target="#submenu-1"
                                aria-expanded="false"
                                aria-controls="submenu-1"
                            >
                                <span class="nav-icon">
                                    <//Bootstrap Icons: https://icons.getbootstrap.com/ 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                    </svg>
                                </span>
                                <span class="nav-link-text">Settings</span>
                                <span class="submenu-arrow">
                                    <svg
                                        width="1em"
                                        height="1em"
                                        viewBox="0 0 16 16"
                                        class="bi bi-chevron-down"
                                        fill="currentColor"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"
                                        />
                                    </svg> </span
                                >//submenu-arrow </a
                            ><!//nav-link
                            <div
                                id="submenu-1"
                                class="collapse submenu submenu-1"
                                data-bs-parent="#menu-accordion"
                            >
                                <ul class="submenu-list list-unstyled">
                                    <li class="submenu-item">
                                        <router-link
                                            class="submenu-link"
                                            to="/users"
                                            active-class="active"
                                            >Users</router-link
                                        >
                                    </li>
                                </ul>
                            </div>
                        </li> -->
                       
                    </ul>
                    <!--//app-menu-->
                </nav>
                <!--//app-nav-->
                <div class="app-sidepanel-footer" >
                    <nav class="app-nav app-nav-footer">
                        <ul class="app-menu footer-menu list-unstyled">
                            
                            <!--//nav-item-->
                            <li class="nav-item">
                                <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                <a
                                    class="nav-link"
                                    href="#"
                                >
                                    <span class="nav-icon">
                                        <svg
                                            width="1em"
                                            height="1em"
                                            viewBox="0 0 16 16"
                                            class="bi bi-file-person"
                                            fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M12 1H4a1 1 0 0 0-1 1v10.755S4 11 8 11s5 1.755 5 1.755V2a1 1 0 0 0-1-1zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"
                                            />
                                            <path
                                                fill-rule="evenodd"
                                                d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"
                                            />
                                        </svg>
                                    </span>
                                    <span class="nav-link-text"
                                        >User Manual</span
                                    > </a
                                ><!--//nav-link-->
                            </li>
                            <!--//nav-item-->
                        </ul>
                        <!--//footer-menu-->
                    </nav>
                </div>
                <!--//app-sidepanel-footer-->
            </div>
            <!--//sidepanel-inner-->
        </div>

</template>

<script>
export default {
    data() {
        return {
            data: [],
        };
    },
};
</script>
