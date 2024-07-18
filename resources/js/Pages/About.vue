<script setup lang="ts">
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
const greeting = ref('Welcome to About page');
</script>

<template>
    <h1>{{ greeting }}</h1>
    <Link href="/">Go to Welcome page</Link>
</template>

<style scoped>

</style>
