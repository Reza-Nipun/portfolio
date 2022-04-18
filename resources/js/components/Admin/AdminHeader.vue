<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <router-link class="navbar-brand" :to="{name: 'Portfolio', params: { user_name: this.$store.state.logged_in_user_name }}" target="_blank">TechExpertsBD</router-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    
                    <li class="nav-item">
                        <router-link class="nav-link active" aria-current="page" :to="{name: 'Dashboard'}">Home</router-link>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Sections
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><router-link class="dropdown-item" :to="{name: '/'}">Tags</router-link></li>
                            <li><router-link class="dropdown-item" :to="{name: '/'}">Skills</router-link></li>
                            <li><router-link class="dropdown-item" :to="{name: '/'}">Certifications</router-link></li>
                            <li><router-link class="dropdown-item" :to="{name: '/'}">Services</router-link></li>
                            <li><router-link class="dropdown-item" :to="{name: '/'}">Projects</router-link></li>
                            <li><router-link class="dropdown-item" :to="{name: '/'}">Blogs</router-link></li>
                            <li><router-link class="dropdown-item" :to="{name: '/'}">Social Links</router-link></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            My-Profile
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><router-link class="dropdown-item" :to="{name: 'Profile'}">Profile</router-link></li>
                            <li><router-link class="dropdown-item" :to="{name: 'Logout'}">Logout</router-link></li>
                        </ul>
                    </li>
                    <!-- <li class="nav-item">
                        <router-link class="nav-link" aria-current="page" :to="{name: 'Portfolio', params: { user_name: this.$store.state.logged_in_user_name }}" target="_blank"> My-PortfolioSite</router-link>
                    </li> -->
                </ul>
                </div>
            </div>
        </nav>
    </div>
</template>