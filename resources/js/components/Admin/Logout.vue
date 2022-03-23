<template>
    <div>
        
    </div>
</template>

<script>
export default {
    name: "Logout",
    created() {
        this.$store.dispatch('logout').then(() => {
            this.$store.dispatch('removeToken')

            this.$router.push({
                name: 'Login'
            })
            location.reload();
        })
    }
}
</script>