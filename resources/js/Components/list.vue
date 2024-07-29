<script lang="ts">
import {defineComponent} from "vue";
import axios from "axios";

interface deviceType {
    name: string;
    udi: string;
    id?: number | null
}

export default defineComponent({
    data() {
        return {
            hasDelete: false,
            devices: <any>[],
        }
    },
    activated() {
        this.$nextTick(function () {
            this.fetchDeviceList();
        })

    },
    methods: {
        fetchDeviceList() {
            axios.get('api/devices')
                .then((res) => {
                    this.devices = res.data;
                })
                .catch((err) => console.error(err));
        },

        deleteDevice(id: deviceType) {
            this.hasDelete = true
            axios.delete('api/devices/' + id)
                .then((res) => {
                    console.log(res);
                    this.fetchDeviceList()
                    this.hasDelete = false
                })
                .catch((err) => console.error(err));
        }
    }

})

const items = [
    {
        id: 1,
        state: 1,
        model: true,
        name: 'wert',
        udi: 12345678,
        readings: [25, 27, 28, 14, 16, 32, 31, 30, 28, 10, 8, 12, 15, 5, 14, 3, 26]
    },
    {
        id: 2,
        state: 1,
        model: false,
        name: 'dsfdfv dfdd',
        udi: 4444444,
        readings: [5, 15, 3, 24, 35, 31, 15, 23, 12, 12, 2, 0, -1, -5, -14, -13, 0]
    },
    {id: 3, state: 0, model: false, name: 'fdfdd sdfsdfsd', udi: 5555555},
    {
        id: 4,
        state: 1,
        model: true,
        name: 'vgggfg',
        udi: 77777777,
        readings: [5, 23, 3, 24, 35, 31, 15, 23, 12, 12, 2, 0, -1, -5, -14, -13, 0]
    },
    {id: 5, state: 0, name: 'vgggfg', udi: 77777777},
    {id: 6, state: 0, name: 'vgggfg', udi: 77777777},
    {
        id: 7,
        state: 1,
        name: 'vgggfg dfgfdgdfgdf',
        udi: 77777777,
        readings: [5, 11, 3, 24, 35, 31, 15, 23, 12, 12, 2, 0, -1, -5, -14, -13, 0]
    },
    {id: 8, state: 0, name: 'vgggfg dfgfdfgfdgdfgdfdfgfgdf dfgfd', udi: 565565656},
    {
        id: 9,
        state: 1,
        name: 'vgggfg',
        udi: 77777777,
        readings: [5, 10, 3, 24, 35, 31, 15, 23, 12, 12, 2, 0, -1, -5, -14, -13, 0]
    },

];

</script>

<template>
    <v-row dense>
        <v-col
            v-for="item in devices"
            :key="item.id"
            cols="12"
            md="2"
        >
            <v-card class="ma-2">
                <v-toolbar class="px-2" flat>
                    <v-icon size="40" :color="item.state ? 'green' : 'red'" icon="mdi-chip"/>
                    <v-toolbar-title style="line-height:18px;">
                        <div>{{ item.name }}</div>
                        <small class="text-grey-darken-1 text-subtitle-2 text-mono"> UDI: {{ item.udi }}</small>
                    </v-toolbar-title>
                    <v-btn slim color="gray" icon="mdi-delete" @click="deleteDevice(item.id)"></v-btn>
                </v-toolbar>
                <v-card-text>
                    <v-sparkline
                        :model-value="item.readings"
                        color="gray"
                        line-width="3"
                        padding="8"
                    ></v-sparkline>
                </v-card-text>
                <v-card-actions class="px-2">
                    <div class="icon-card">
                        <v-icon icon="mdi-home-thermometer-outline"/>
                        {{ item.readings?.at(1) }}&deg;
                    </div>
                    <div class="icon-card">
                        <v-icon icon="mdi-waves-arrow-up"/>
                        {{ item.readings?.at(5) }}
                    </div>
                    <div class="icon-card">
                        <v-icon icon="mdi-signal"/>
                        {{ item.readings?.at(8) }}
                    </div>
                </v-card-actions>
            </v-card>
            <v-snackbar
                v-model="hasDelete"
                location="bottom left"
                position="absolute"
                attach
            >Device {{ item.name }} added successfully
            </v-snackbar>
        </v-col>
    </v-row>
</template>

<style>
.icon-card {
    margin: 0 10px 0 10px;
}
</style>


