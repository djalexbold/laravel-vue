<script setup lang="ts">
import {ref, shallowRef} from 'vue';
import {Link} from '@inertiajs/vue3';
import test from '../Components/list.vue'
import add from '../Components/add.vue'
import start from '../Components/start.vue'

const username = ref('Alex Bold');
const button = shallowRef(start)

</script>

<template>
    <v-app id="inspire">
        <v-app-bar scroll-behavior="hide">
            <Link href="/" class="title-main px-8">Hut IoT</Link>
            <v-btn-toggle v-model="button">
                <v-btn :value="start" stacked>start</v-btn>
                <v-btn :value="test" stacked>list</v-btn>
                <v-btn :value="add" stacked>Add</v-btn>
                <v-btn href="/about" stacked>About</v-btn>
            </v-btn-toggle>
            <v-spacer></v-spacer>
            <v-btn class="text-none" stacked>
                <v-badge inline color="error" content="12">
                    <v-icon>mdi-bell-outline</v-icon>
                </v-badge>
            </v-btn>
            <span class="pl-4">{{ username }}</span>
            <v-btn color="red" icon="mdi-login"/>
        </v-app-bar>

        <v-main class="flex align-center justify-center" style="min-height: 300px; background-color: #d2d7e1">
            <KeepAlive>
                <component :is="button"/>
            </KeepAlive>
        </v-main>

        <v-footer height="30" app class="bg-grey-lighten-2 justify-center">
            {{ new Date().getFullYear() }} &nbsp;<strong> &copy; Hut IoT </strong>
        </v-footer>
    </v-app>
</template>

<style>
::-webkit-scrollbar {
    width: 0;
}
.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}

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
