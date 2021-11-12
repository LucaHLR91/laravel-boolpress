<template>
    <div class="container">
        <Header />
        <Main />
    </div>
</template>

<script>
import '../components/Header.vue';
import '../components/Main.vue';

export default {
    name: 'App',
    components: {
        Header,
        Main,
    }
}
</script>

<style lang="scss" scoped>

</style>