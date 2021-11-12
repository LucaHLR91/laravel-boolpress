<template>
    <main>
        <div class="row">
            <div class="col-12">
                <ul>
                    <li :v-for="post in posts" :key="post.id">{{ post.title }}</li>
                </ul>    
            </div>
        </div>
    </main>
</template>

<script>
export default {
    name: 'Main',
    data() {
        return {
            url: 'http://127.0.0.1:8000/api/posts',
            posts: [],
        }
    },
    created() {
        this.gestPosts();
    },
    methods: {
        gestPosts() {
            axios.get(this.url)
                .then(response => {
                    this.posts = response.data.results;
                })
                .catch();
        }
    }
}
</script>

<style lang="scss" scoped>

</style>