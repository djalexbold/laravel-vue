<script setup lang="ts">
import {ref} from 'vue';


const greeting = ref('Welcome to Your Vue.js + TypeScript App');

</script>

<template>
    <v-app id="inspire">
        <v-system-bar height="30" app>
            {{ greeting }}
<v-btn>dsf</v-btn>
            <v-badge inline color="error" content="12">
                <v-icon>mdi-bell-outline</v-icon>
            </v-badge>

            <v-badge inline color="error" content="3">
                <v-icon>mdi-email-outline</v-icon>
            </v-badge>

            <v-spacer></v-spacer>
            <span>User Name</span>
            <v-icon class="ml-2" color="red">mdi-login</v-icon>
        </v-system-bar>
        <v-footer height="30" app class="bg-grey-lighten-2 justify-center red--text">
            {{ new Date().getFullYear() }} &nbsp;<strong> &copy; test </strong>
        </v-footer>
    </v-app>
</template>
