<script setup lang="ts">
import {ref} from 'vue';
import {Link} from '@inertiajs/vue3';

const username = ref('Alex Bold');
</script>

<template>
    <v-app id="inspire">
        <v-app-bar scroll-behavior="hide">
            <Link href="/" class="title-main px-8">Hut IoT</Link>
            <v-btn stacked>list</v-btn>
            <v-btn stacked>Add</v-btn>
            <v-btn stacked>About</v-btn>
            <v-spacer></v-spacer>
            <v-btn class="text-none" stacked>
                <v-badge inline color="error" content="12">
                    <v-icon>mdi-bell-outline</v-icon>
                </v-badge>
            </v-btn>
            <span class="pl-4">{{ username }}</span>
            <v-btn color="red" icon="mdi-login"/>
        </v-app-bar>

        <v-main class="d-flex align-center justify-center" style="min-height: 300px;">
            <v-btn href="/about">dsf</v-btn>
        </v-main>

        <v-footer height="30" app class="bg-grey-lighten-2 justify-center">
            {{ new Date().getFullYear() }} &nbsp;<strong> &copy; Hut IoT </strong>
        </v-footer>
    </v-app>
</template>

<style>
.title-main {
    font-family: 'Arial Black', cursive;
    font-weight: bold;
    white-space: nowrap;
    text-decoration: none;
    cursor: pointer;
    font-size: 2rem;
    background-color: #666666;
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    text-shadow: rgba(255, 255, 255, 0.5) 0 3px 3px;
}

</style>
