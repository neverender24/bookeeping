<template>
    <span>
    <header class="app-header fixed-top">
        <navbar></navbar>
        <!--//app-header-inner-->
        <sidebar></sidebar>
        <!--//app-sidepanel-->
    </header>
    <!--//app-header-->

    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4" >
            <router-view></router-view>
            <!--//container-fluid-->
        </div>
        <footer></footer>
    </div>
    </span>
</template>

<script>
import Sidebar from "./components/sidebar.vue";
import Navbar from "./components/navbar.vue";
import Footer from "./components/footer.vue";
import { mapGetters } from "vuex";
export default {
    components: {
        sidebar: Sidebar,
        navbar: Navbar,
        AppFooter: Footer,
    },
    computed: {
        ...mapGetters([
            'isAdmin'
        ]),
    },
    mounted() {
        this.isAdmin
    },
    data() {
        return {
            data: [],
        };
    },
};
</script>
