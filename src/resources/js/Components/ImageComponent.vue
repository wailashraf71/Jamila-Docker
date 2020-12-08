<template>
    <img class="product-image" ref="image" :src="src" alt="">
</template>

<script>
export default {
    props: {
        src: String
    }
}
</script>
